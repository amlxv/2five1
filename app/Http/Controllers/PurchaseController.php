<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $purchases = Purchase::where('buyer_id', $user->id)->latest()->get();

        foreach ($purchases as $purchase) {
            $product = Product::findOrFail($purchase->product_id);
            $purchase->product_name = $product->name;
        }

        return view('purchases.index', compact('user', 'purchases'));
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
        $purchase = Purchase::where('id', $id)->where('buyer_id', Auth::user()->id)->first();
        $product = Product::findOrFail($purchase->product_id);
        $seller = User::findOrFail($product->seller_id);

        $purchase->product_name = $product->name;
        $purchase->seller_name = $seller->name;
        $purchase->when = $purchase->created_at->diffForHumans();

        return $purchase;
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

    /**
     * Received the payment result from the payment gateway.
     * 
     * @var status_id (1: success, 2: pending, 3: failed)
     */
    public function paymentResult(Request $request)
    {
        if ($request->status_id == null || $request->billcode == null || $request->transaction_id == null) {
            return redirect()->route('purchases.index')->withErrors([
                'message' => 'Invalid request.'
            ]);
        }

        $status_id = $this->paymentStatus($request->status_id);
        $billcode = $request->billcode;
        $transaction_id = $request->transaction_id;

        $transaction = $this->getTransaction($billcode);
        if ($transaction == null) {
            return redirect()->route('purchases.index')->withErrors([
                'message' => 'Something went wrong. Please try again.'
            ]);
        }

        // Integrity check
        $result = $this->billRequestIntegrityCheck($transaction, $status_id);

        if (!$result) {
            return redirect()->route('purchases.index')->withErrors([
                'message' => 'Invalid request.'
            ]);
        }

        $purchase = Purchase::where('billcode', $billcode)->first();
        $purchase->status = $status_id;
        $purchase->transaction_id = $transaction_id;
        $purchase->save();

        if ($status_id == 'pending') {
            return redirect()->route('purchases.index')->with('success', 'Payment is pending. Please check your email for payment confirmation.');
        } else if ($status_id == 'failed') {
            return redirect()->route('purchases.index')->withErrors([
                'message' => 'Payment failed. Please try again.'
            ]);
        }

        $product = Product::findOrFail($purchase->product_id);
        $product->quantity -= $product->quantity;

        if ($product->save()) {
            return redirect()->route('purchases.index')->with('success', 'Payment has been received. Thank you for your purchase.');
        }

        return redirect()->route('purchases.index')->withErrors([
            'message' => 'Something went wrong. Please try again.'
        ]);
    }

    /**
     * Return the payment status
     * 
     */
    public function paymentStatus($status)
    {
        return ($status == 1) ? 'success' : (($status == 2) ? 'pending' : 'failed');
    }

    /**
     * Bill Request Integrity Check
     * 
     */
    public function billRequestIntegrityCheck($transaction, $status_id)
    {
        if ($this->paymentStatus($transaction[0]->billpaymentStatus) != $status_id) {
            return false;
        }

        return true;
    }

    /**
     * Get the transaction details from the billcode
     * 
     */
    public function getTransaction($billcode)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/getBillTransactions');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, ['billCode' => $billcode]);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = json_decode(curl_exec($curl));
        curl_close($curl);

        return $result;
    }
}