<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Tariff;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all()->sortByDesc('created_at');
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $validated = $request->validated();

        $tariff = Tariff::find($validated['tariff_id']);

        $order = Order::create([
            'client_name' => $validated['client_name'],
            'client_phone' => $validated['client_phone'],
            'tariff_id' => $validated['tariff_id'],
            'schedule_type' => $validated['schedule_type'],
            'comment' => $validated['comment'],
            'first_date' => collect($validated['date_ranges'])->min('from'),
            'last_date' => collect($validated['date_ranges'])->max('to'),
        ]);

        foreach ($validated['date_ranges'] as $range) {
            $deliveryDates = $this->generateDeliveryDates($range['from'], $range['to'], $validated['schedule_type']);

            foreach ($deliveryDates as $deliveryDate) {

                $cookingDate = $tariff->cooking_day_before
                    ? date('Y-m-d', strtotime('-1 day', strtotime($deliveryDate)))
                    : $deliveryDate;

                Meal::create([
                    'order_id' => $order->id,
                    'cooking_date' => $cookingDate,
                    'delivery_date' => $deliveryDate,
                ]);
            }
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function generateDeliveryDates($from, $to, $scheduleType)
    {
        $dates = [];
        $current = strtotime($from);
        $end = strtotime($to);

        while ($current <= $end) {
            $dates[] = date('Y-m-d', $current);

            switch ($scheduleType) {
                case 'EVERY_DAY':
                    $current = strtotime('+1 day', $current);
                    break;
                case 'EVERY_OTHER_DAY':
                    $current = strtotime('+2 days', $current);
                    break;
                case 'EVERY_OTHER_DAY_TWICE':
                    $current = strtotime('+1 day', $current);
                    break;
            }
        }

        return $dates;
    }
}
