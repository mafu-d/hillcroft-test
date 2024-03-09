<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Jobs\ImportProducts;

class ProductsController extends Controller
{
    /**
     * Show the home page listing all products and an upload form
     */
    public function index()
    {
        $products = Product::query()->orderByDesc('updated_at')->paginate(12);
        return view('products', compact('products'));
    }

    /**
     * Upload an XML file of product data
     */
    public function upload(Request $request)
    {
        // Check the incoming file is in XML format
        $request->validate([
            'file' => ['required', 'file', 'mimes:xml'],
        ]);

        // Store the file
        $file = $request->file('file')->store('uploads');
        session()->flash('success', 'File uploaded successfully');

        // Import the products
        dispatch(new ImportProducts($file));

        return back();
    }
}
