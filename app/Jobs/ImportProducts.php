<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Flowgistics\XML\XML;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductsUploaded;

class ImportProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $file)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Read the XML file
        $xml = simplexml_load_file(storage_path('app/' . $this->file));
        $json = json_encode($xml);
        $products = json_decode($json, true);

        // Loop through them all
        foreach ($products['ExportData'] as $productData) {
            // Find or create the category the product belongs to
            $category = Category::firstOrCreate(['name' => $productData['cat']]);
            // Find or create the product
            $product = Product::firstOrNew(['code' => $productData['code']]);
            // Update the product data
            $product->name = $productData['name'];
            $product->price_ex_vat = $productData['price_ex_vat'];
            $product->price_inc_vat = $productData['price_inc_vat'];
            $product->stock = $productData['stock'];
            $product->short_description = $productData['short_desc'];
            // Associate the product with the category
            $product->category_id = $category->id;
            // Save the product
            $product->save();
        }

        // Send a confirmation email
        Mail::send(new ProductsUploaded());
    }
}
