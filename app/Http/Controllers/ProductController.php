<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $products = Product::where('seller_id', Auth::user()->id)->latest()->get();
        return view('settings.products', compact(['user', 'products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::find(Auth::user()->id);
        $categories = Category::all();
        return view('settings.products-create', compact(['user', 'categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:14|max:255',
            'description' => 'required|min:40|max:5000',
            'category' => 'required',
            'price' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'quantity' => 'required|numeric|min:1',
            'sku' => 'max:21',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['seller_id'] = Auth::user()->id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name =  Auth::user()->id . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $image_name);
            $validated['image'] = 'images/products/' . $image_name;
        }

        $product = new Product();

        if (Product::create($validated)) {
            return redirect()->route('products.index')->with('success', 'Product created successfully');
        }

        return redirect()->route('products.index')->withErrors(['error' => 'Something went wrong when creating the product']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(Auth::user()->id);
        $product = Product::find($id);
        $categories = Category::all();
        return view('settings.products-edit', compact(['user', 'product', 'categories']));
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
        $validated = $request->validate([
            'name' => 'required|min:14|max:255',
            'description' => 'required|min:40|max:5000',
            'category' => 'required',
            'price' => 'required|numeric|min:1',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'quantity' => 'required|numeric|min:1',
            'sku' => 'max:21',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name =  Auth::user()->id . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $image_name);
            $validated['image'] = 'images/products/' . $image_name;
        }


        $product = Product::find($id);

        if ($product->update($validated)) {
            return redirect()->route('products.index')->with('success', 'Product updated successfully');
        }

        return redirect()->route('products.index')->withErrors(['error' => 'Something went wrong when updating the product']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product->delete()) {
            return redirect()->route('products.index')->with('success', 'Product deleted successfully');
        }

        return redirect()->route('products.index')->withErrors(['error' => 'Something went wrong when deleting the product']);
    }
}