<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use App\Models\Supplier;
use App\Http\Requests\SupplyRequest;

class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->flash();
        $query = Supply::with('supplier');

        if (request()->filled('supplier_id')) {
            $query->where('supplier_id', request('supplier_id'));
        }
        if (request()->filled('name')) {
            $query->where('name', 'like', '%' . request('name') . '%');
        }
        if (request()->filled('from') && request()->filled('to')) {
            $query->whereBetween('created_at', [request('from'), request('to')]);
        }

        $priceSum = $query->sum('price');
        $baseSum = $query->sum('base_price');
        $discountSum = $query->sum('discount');
        $totalSum = $query->sum('total_price');
        $supplies = $query->orderBy('created_at', 'desc')->paginate(10);

        $suppliers = Supplier::pluck('name', 'id');

        return view('sections.supplies.index', compact('supplies', 'priceSum', 'baseSum', 'discountSum', 'totalSum', 'suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::get();

        return view('sections.supplies.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SupplyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplyRequest $request)
    {
        $request['base_price'] = $request['price'] * $request['quantity'];
        $request['total_price'] = $request['base_price'] - $request['discount'];
        $supply = Supply::create($request->all());

        return redirect()->route('admin.supplies.index')->with('status', __('lang.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supply  $supply
     * @return \Illuminate\Http\Response
     */
    public function show(Supply $supply)
    {
        $supply->load('supplier');

        return view('sections.supplies.show', compact('supply'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supply  $supply
     * @return \Illuminate\Http\Response
     */
    public function edit(Supply $supply)
    {
        return view('sections.supplies.edit', compact('supply'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SupplyRequest  $request
     * @param  \App\Models\Supply  $supply
     * @return \Illuminate\Http\Response
     */
    public function update(SupplyRequest $request, Supply $supply)
    {
        $request['base_price'] = $request['price'] * $request['quantity'];
        $request['total_price'] = $request['base_price'] - $request['discount'];
        $supply->update($request->all());

        return redirect()->route('admin.supplies.index')->with('status', __('lang.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supply  $supply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supply $supply)
    {
        $supply->delete();

        return back()->with('status', __('lang.deleted'));
    }
}
