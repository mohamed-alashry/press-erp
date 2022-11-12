<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Order;
use App\Models\Client;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->flash();
        $query = Order::with('client');

        if (request()->filled('client_id')) {
            $query->where('client_id', request('client_id'));
        }
        if (request()->filled('desc')) {
            $query->where('desc', 'like', '%' . request('desc') . '%');
        }
        if (request()->filled('from') && request()->filled('to')) {
            $query->whereBetween('created_at', [request('from'), request('to')]);
        }

        $totalSum = $query->sum('total_price');
        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        $clients = Client::pluck('name', 'id');

        return view('sections.orders.index', compact('orders', 'totalSum', 'clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::get();
        $colors = Color::get();

        return view('sections.orders.create', compact('clients', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\OrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $order = Order::create($request->all());

        $totalPrice = 0;
        foreach (request('colors') as $colorId => $colorItem) {
            $colorItem['color_id'] = $colorId;
            $colorItem['total_price'] = $itemTotalPrice = $colorItem['quantity'] * $colorItem['price'];
            $totalPrice += $itemTotalPrice;
            $order->colorItems()->create($colorItem);
        }
        $order->update(['total_price' => $totalPrice]);

        return redirect()->route('admin.orders.index')->with('status', __('lang.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order->load('colorItems');

        return view('sections.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $order->load('colorItems.color');
        $colors = $order->colorItems;

        return view('sections.orders.edit', compact('order', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\OrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $order)
    {
        $order->update($request->all());

        $totalPrice = 0;
        foreach (request('colors') as $colorId => $colorItem) {
            $colorItem['color_id'] = $colorId;
            $colorItem['total_price'] = $itemTotalPrice = $colorItem['quantity'] * $colorItem['price'];
            $totalPrice += $itemTotalPrice;
            $order->colorItems()->where('color_id', $colorId)->update($colorItem);
        }
        $order->update(['total_price' => $totalPrice]);

        return redirect()->route('admin.orders.index')->with('status', __('lang.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return back()->with('status', __('lang.deleted'));
    }
}
