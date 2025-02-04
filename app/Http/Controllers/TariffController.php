<?php

namespace App\Http\Controllers;

use App\Models\Tariff;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tariffs = Tariff::all();
        return view('tariffs.index', compact('tariffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tariffs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ration_name' => 'required|string|max:255',
            'cooking_day_before' => 'required',
        ]);

        $validated['cooking_day_before'] = filter_var($validated['cooking_day_before'], FILTER_VALIDATE_BOOLEAN);

        Tariff::create($validated);

        return redirect()->route('tariffs.index')->with('success', 'Tariff created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tariff $tariff)
    {
        return view('tariffs.show', compact('tariff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tariff $tariff)
    {
        return view('tariffs.edit', compact('tariff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tariff $tariff)
    {
        $validated = $request->validate([
            'ration_name' => 'required|string|max:255',
            'cooking_day_before' => 'required|boolean',
        ]);

        $tariff->update($validated);

        return redirect()->route('tariffs.index')->with('success', 'Tariff updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tariff $tariff)
    {
        $tariff->delete();

        return redirect()->route('tariffs.index')->with('success', 'Tariff deleted successfully.');
    }
}
