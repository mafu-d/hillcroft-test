<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::query()->paginate(12);
        return view('products', compact('products'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xml'],
        ]);

        $request->file('file')->store('uploads');
        session()->flash('success', 'File uploaded successfully');

        return back();
    }
}
