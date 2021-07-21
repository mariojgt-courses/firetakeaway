<?php

namespace Mariojgt\Firetakeaway\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mariojgt\Firetakeaway\Models\User;
use Mariojgt\Firetakeaway\Models\Order;
use Mariojgt\Firetakeaway\Models\Status;
use Mariojgt\Firetakeaway\Models\Orderline;
use Mariojgt\Firetakeaway\Resource\UserResource;
use Mariojgt\Firetakeaway\Resource\ProductResources;
use Mariojgt\Firetakeaway\Resource\OrdersResources;

class OrderApiController extends Controller
{
    public function orderCreate(Request $request)
    {
        // Validate the product
        $request->validate([
            'userid'   => ['required', 'numeric', 'max:255'],
            'products' => ['required'],
        ]);

        $total = 0;
        // Get the order Total
        foreach (Request('products') as $key => $product) {
            $total = $total + $product['price'];
        }

        // If anything inside fail will not create the record on teh database
        DB::transaction(function () use ($total) {
            // Create the order
            $order            = new Order();
            $order->user_id   = Request('userid');
            $order->status_id = Config('firetakeaway.default_status');
            $order->total     = $total;
            $order->save();

            // Save the order lines
            foreach (Request('products') as $key => $product) {
                $orderline             = new Orderline();
                $orderline->order_id   = $order->id;
                $orderline->product_id = $product['id'];
                $orderline->price      = $product['price'];
                $orderline->save();
            }
        });


        // Return the data as json
        return json_encode([
            'message' => 'Product Created',
            'status'  => true
        ]);
    }

    public function newOrders()
    {
        // Return the placed orders
        $order = Order::where('status_id', Config('firetakeaway.default_status'))->get();
        // Return using a resources
        return OrdersResources::collection($order);
    }

    public function oldOrders()
    {
        // Return the placed orders
        $order = Order::where('status_id','!=', Config('firetakeaway.default_status'))->get();
        // Return using a resources
        return OrdersResources::collection($order);
    }

    public function destroy($id)
    {
        // You can delete the order in here
        dd($id);
    }

    public function confirmOrder(Request $request)
    {
        // Validate the product
        $request->validate([
            'order_id'   => ['required', 'numeric', 'max:255'],
        ]);

        $order = Order::findOrFail(Request('order_id'));
        $order->status_id = Config('firetakeaway.confirm_status');
        $order->save();

        return response()->json([
            'status' => true,
        ]);
    }

    public function userOrders()
    {
        return OrdersResources::collection(Auth::user()->orders);
    }
}
