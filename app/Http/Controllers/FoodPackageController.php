<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFoodPackageRequest;
use App\Http\Requests\UpdateFoodPackageRequest;
use App\Http\Resources\FoodPackageResource;
use App\Http\Resources\ItemResource;
use App\Models\FoodPackage;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
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
            'items' => ItemResource::collection(Item::all()),
            'edit' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodPackageRequest $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();

            $items = $data['items'];
            unset($data['items']);

            $package = FoodPackage::create($data);

            $pivotData = collect($items)->mapWithKeys(fn($item) => [
                $item['id'] => ['package_quantity' => $item['package_quantity'] ?? 1],
            ]);

            $package->items()->attach($pivotData);
        });

        return to_route('package.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodPackage $foodPackage)
    {
        return Inertia::render('Package/Show', [
            'food_package' => FoodPackageResource::make($foodPackage->load('items')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodPackage $foodPackage)
    {
        return Inertia::render('Package/Form', [
            'food_package' => FoodPackageResource::make($foodPackage->load('items')),
            'items' => ItemResource::collection(Item::all()),
            'edit' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodPackageRequest $request, FoodPackage $foodPackage)
    {
        DB::transaction(function () use ($request, $foodPackage) {
            $data = $request->validated();

            $items = $data['items'] ?? [];
            unset($data['items']);

            $foodPackage->update($data);

            $pivotData = collect($items)->mapWithKeys(fn($item) => [
                $item['id'] => ['package_quantity' => $item['package_quantity'] ?? 1],
            ]);

            $foodPackage->items()->sync($pivotData);
        });

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
