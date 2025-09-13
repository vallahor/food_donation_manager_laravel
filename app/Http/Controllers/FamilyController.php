<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFamilyRequest;
use App\Http\Requests\UpdateFamilyRequest;
use App\Http\Resources\FamilyResource;
use App\Models\Family;
use Inertia\Inertia;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $families = Family::all();
        return Inertia::render('Family/Index', ['families' => FamilyResource::collection($families)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Family/Form', [
            'family' => FamilyResource::make(new Family()),
            'edit' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFamilyRequest $request)
    {
        Family::create($request->validated());

        return to_route('family.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Family $family)
    {
        return Inertia::render('Family/Show', [
            'family' => FamilyResource::make($family),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Family $family)
    {
        return Inertia::render('Family/Form', [
            'family' => FamilyResource::make($family),
            'edit' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFamilyRequest $request, Family $family)
    {
        $family->update($request->validated());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family)
    {
        $family->delete();

        return back();
    }
}
