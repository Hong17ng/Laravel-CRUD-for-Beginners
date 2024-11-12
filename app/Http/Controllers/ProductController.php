<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('products.index', ['products' => $products]);
        
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required',
        'qty' => 'required|integer',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'attachment' => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:2048',
    ]);

    $productData = $request->only(['name', 'qty', 'price', 'description']);

    // Handle file upload
    if ($request->hasFile('attachment')) {
        $filePath = $request->file('attachment')->store('attachments', 'public');
        $productData['attachment'] = $filePath;
    }

    Product::create($productData);

    return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product){
        return view('products.edit', ['product' => $product]);
    }

    public function update(Product $product, Request $request){
        
        $request->validate([
            'name' => 'required',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:2048',
        ]);
    
        $productData = $request->only(['name', 'qty', 'price', 'description']);
    
        // Handle file upload
        if ($request->hasFile('attachment')) {
            $filePath = $request->file('attachment')->store('attachments', 'public');
            $productData['attachment'] = $filePath;
        }
    
        $product->update($productData);
        
    
        return redirect()->route('product.index')->with('success', 'Product Updated successfully.');

    }

    public function destroy(Product $product){
        $product->delete();
        return redirect(route('product.index'))->with('success', 'Product deleted Succesffully');
    }
}
