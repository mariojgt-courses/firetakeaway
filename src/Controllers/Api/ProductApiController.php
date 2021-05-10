<?php

namespace Mariojgt\Firetakeaway\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mariojgt\Firetakeaway\Models\User;
use Illuminate\Support\Facades\Hash;
use Mariojgt\Firetakeaway\Resource\UserResource;
use Mariojgt\Firetakeaway\Models\Product;
use Mariojgt\Firetakeaway\Resource\ProductResources;

class ProductApiController extends Controller
{
    public function productSearch(Request $request)
    {
        // Validate the product
        $request->validate([
            'search'  => ['required', 'string', 'max:255'],
        ]);
        // Find the products
        $product = Product::Where('name', 'like', '%' . Request('search') . '%')->get();
        // Use a resource to make the data ready to use in a api
        $product = ProductResources::collection($product);
        // Return the data as json
        return json_encode([
            'data' => $product
        ]);
    }
}
