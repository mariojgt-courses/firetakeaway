<?php

namespace Mariojgt\Firetakeaway\Controllers;

use File;
use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Mariojgt\Firetakeaway\Models\Product;
use Mariojgt\Firetakeaway\Helpers\media;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->route = 'product';
    }

    public function index()
    {
        // Load products with pagination
        $products = Product::paginate(10);
        return view('firetakeaway::content.' . $this->route . '.index', compact('products'));
    }

    public function create()
    {
        dd(Request()->all());
    }

    public function store(Request $request)
    {
        // Validate the product
        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'file'  => 'mimes:jpg,bmp,png',
        ]);

        // Call the image helper
        $mediaHelper = new media();
        // Call the function that uploadthe image and return the path
        $imagePath = $mediaHelper->mediaUpload($request);

        // Save the product
        $product              = new Product();
        $product->name        = Request('name');
        $product->description = Request('description');
        $product->price       = Request('price');
        $product->img_path    = $imagePath;              //Get the server site file path
        $product->save();

        // Return to the old view
        return Redirect::back()->with('success', 'Product Created with success.');
    }

    public function edit(Request $request, Product $product)
    {
        // Return the edit view with data
        return view('firetakeaway::content.' . $this->route . '.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Validate the product
        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'file'  => 'mimes:jpg,bmp,png',
        ]);

        // will only work if the user try to upload a file
        if (!empty(Request('file'))) {
            // Find the image to delete
            $fileToDele = public_path($product->img_path);
            // Check if the file exist
            if (file_exists($fileToDele) == true) {
                // If yes we delete the old file
                unlink(public_path($product->img_path));
            }
            // Call the image helper
            $mediaHelper = new media();
            // Call the function that uploadthe image and return the path
            $imagePath = $mediaHelper->mediaUpload($request);
            // add the new iamge path to the product
            $product->img_path    = $imagePath;
        }

        // Update the product
        $product->name        = Request('name');
        $product->description = Request('description');
        $product->price       = Request('price');
        $product->save();

        // Return to the old view
        return Redirect::back()->with('success', 'Product Updated with success.');
    }

    public function destroy(Product $product)
    {
        // Find the image to delete
        $fileToDele = public_path($product->img_path);
        // Check if the file exist
        if (file_exists($fileToDele) == true) {
            // If yes we delete the old file
            unlink(public_path($product->img_path));
        }
        // Delete The product
        $product->delete();

        // Return to the old view
        return Redirect::back()->with('success', 'Product Deleted with success.');
    }
}
