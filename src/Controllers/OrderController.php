<?php

namespace Mariojgt\Firetakeaway\Controllers;

use File;
use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Mariojgt\Firetakeaway\Models\Order;
use Mariojgt\Firetakeaway\Helpers\media;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->route = 'order';
    }

    public function index()
    {
        // Load status with pagination
        $orders = Order::paginate(10);
        return view('firetakeaway::content.' . $this->route . '.index', compact('orders'));
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
            'color' => ['required', 'string'],
        ]);

        // Save the product
        $status        = new Status();
        $status->name  = Request('name');
        $status->color = Request('color');
        $status->save();

        // Return to the old view
        return Redirect::back()->with('success', 'Status Created with success.');
    }

    public function edit(Request $request, Status $status)
    {
        // Return the edit view with data
        return view('firetakeaway::content.' . $this->route . '.edit', compact('status'));
    }

    public function update(Request $request, Status $status)
    {
        // Validate the product
        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'color' => ['required', 'string'],
        ]);

        // Save the product
        $status->name  = Request('name');
        $status->color = Request('color');
        $status->save();

        // Return to the old view
        return Redirect::back()->with('success', 'Status Updated with success.');
    }

    public function destroy(Order $order)
    {
        // Delete the order Lines
        $order->lines()->delete();
        // Delete The product
        $order->delete();

        // Return to the old view
        return Redirect::back()->with('success', 'Order Deleted with success.');
    }
}
