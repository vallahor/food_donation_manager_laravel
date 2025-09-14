<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFoodPackageRequest;
use App\Http\Requests\UpdateFoodPackageRequest;
use App\Http\Resources\FoodPackageResource;
use App\Models\FoodPackage;
use App\Models\Item;
use Inertia\Inertia;

class FoodPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $food_packages = FoodPackage::all();
        return Inertia::render('Package/Index', [
            'food_packages' => FoodPackageResource::collection($food_packages),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Package/Form', [
            'food_package' => FoodPackageResource::make(new FoodPackage()),
            'items' => Item::all(),
            'edit' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodPackageRequest $request)
    {
        FoodPackage::create($request->validated());
        return to_route('package.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodPackage $foodPackage)
    {
        return Inertia::render('Package/Show', [
            'food_package' => FoodPackageResource::make($foodPackage),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodPackage $foodPackage)
    {
        return Inertia::render('Package/Form', [
            'food_package' => FoodPackageResource::make($foodPackage),
            'items' => Item::all(),
            'edit' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodPackageRequest $request, FoodPackage $foodPackage)
    {
        $foodPackage->update($request->validated());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodPackage $foodPackage)
    {
        $foodPackage->delete();

        return back();
    }
}
