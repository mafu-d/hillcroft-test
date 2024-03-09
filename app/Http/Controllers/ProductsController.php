<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Jobs\ImportProducts;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::query()->orderByDesc('updated_at')->paginate(12);
        return view('products', compact('products'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xml'],
        ]);

        $file = $request->file('file')->store('uploads');
        session()->flash('success', 'File uploaded successfully');

        dispatch(new ImportProducts($file));

        return back();
    }
}
