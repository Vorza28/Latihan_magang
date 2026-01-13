<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spps = Spp::all();
        return view('spp.index', compact('spps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('spp.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|unique:spps,tahun',
            'nominal' => 'required|numeric',
        ]);

        Spp::create($request->all());

        return redirect()->route('spp.index')
                        ->with('success', 'SPP created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Spp $spp)
    {
        return view('spp.show', compact('spp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spp $spp)
    {
        return view('spp.edit', compact('spp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spp $spp)
    {
        $request->validate([
            'tahun' => 'required|unique:spps,tahun,' . $spp->id,
            'nominal' => 'required|numeric',
        ]);

        $spp->update($request->all());

        return redirect()->route('spp.index')
                        ->with('success', 'SPP updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spp $spp)
    {
        $spp->delete();

        return redirect()->route('spp.index')
                        ->with('success', 'SPP deleted successfully.');
    }
}
