<?php

namespace App\Http\Livewire\Order;

use App\Models\Color;
use App\Models\Order;
// use Laracasts\Flash\Flash;
use App\Models\Client;
use Livewire\Component;

class Form extends Component
{
    public $order,
        $client_id,
        $desc,
        $quantity,
        $total_price,
        $notes,
        $clients,
        $colors;

    public function mount($order = null)
    {
        if ($order) {
            $this->fill([
                'client_id' => $order->client_id,
                'desc' => $order->desc,
                'quantity' => $order->quantity,
                'notes' => $order->notes,
                'colors' => $order->colorItems,
            ]);
        }
        $this->clients = Client::pluck('name', 'id');
        $this->colors = Color::get();
        // dd($this->colors);
    }

    protected function rules()
    {
        $rules = [
            'client_id' => 'required',
            'desc' => 'required',
            'quantity' => 'required|integer',
            'notes' => 'nullable|string',
            'colors.*.quantity' => 'required|integer',
            'colors.*.price' => 'required|numeric',
        ];

        return $rules;
    }

    public function updated($name)
    {
        $this->validateOnly($name);
    }

    public function save()
    {
        $data = $this->validate();

        $order = $this->order;
        if ($order) {
            $order->update($data);
        } else {
            $order = Order::create($data);
        }

        request()->flash('Order saved successfully.');

        redirect(route('admin.orders.index'));
    }

    public function render()
    {
        return view('livewire.order.form');
    }
}
