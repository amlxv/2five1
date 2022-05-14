<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Redirect;

class MarketplaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get()->where('status', 'active');
        return view('marketplace.index', compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $seller = User::findOrFail($product->seller_id);
        return view('marketplace.show', compact(['product', 'seller']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function buy($id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);
        $seller = User::findOrFail($product->seller_id);

        if ($product->status == 'inactive')
            return abort(404);

        if ($user->id == $seller->id)
            return redirect()->back()->with('error', 'You cannot buy your own product');

        if ($product->quantity == 0)
            return redirect()->back()->with('error', 'Product is out of stock');

        if ($user->address == null || $user->phone == null)
            return redirect()->back()->with('error', 'Please update your profile before buying');

        try {
            $payment_url = $this->createPayment($user, $product, $seller);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } finally {
            if ($payment_url == null)
                return redirect()->back()->with('error', 'Something went wrong');

            return Redirect::to($payment_url);
        }
    }

    /**
     * Create a payment bill
     * 
     * @see https://toyyibpay.com/apireference
     * 
     * [billCallbackUrl] will send POST request when payment made
     * so, it doesn't work in localhost environment/ not hosted
     * 
     */
    public function createPayment($user, $product, $seller)
    {
        $order_id = $user->id . time() . $product->id;

        $payment_data = array(
            'userSecretKey'             => env('TOYYIBPAY_SECRET_KEY'),
            'categoryCode'              => '6u2ur9oi',
            'billName'                  => '2five1 E-Commerce Bill',
            'billDescription'           => Str::limit($product->name, 90),
            'billPriceSetting'          => 1,
            'billPayorInfo'             => 1,
            'billAmount'                => bcmul($product->price, 100),
            'billReturnUrl'             => url('/purchases/payment/result'),
            // 'billCallbackUrl'           => url('/purchases/toyyibpay/callback'), 
            'billExternalReferenceNo'   => $order_id,
            'billTo'                    => $user->name,
            'billEmail'                 => $user->email,
            'billPhone'                 => $user->phone,
            'billPaymentChannel'        => 0,
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payment_data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($curl);
        $result = json_decode($result);
        curl_close($curl);

        $purchase = new Purchase;
        $purchase->buyer_id = $user->id;
        $purchase->product_id = $product->id;
        $purchase->order_id = $order_id;
        $purchase->billcode = $result[0]->BillCode;
        $purchase->total_price = $product->price;

        $purchase->save();

        return 'https://dev.toyyibpay.com/' . $result[0]->BillCode;
    }
}