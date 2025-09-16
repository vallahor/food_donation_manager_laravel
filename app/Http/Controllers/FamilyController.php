<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFamilyRequest;
use App\Http\Requests\UpdateFamilyRequest;
use App\Http\Resources\FamilyResource;
use App\Models\Family;
use App\Models\FoodPackage;
use Illuminate\Support\Facades\DB;
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
            'food_packages' => [],
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
            'family' => FamilyResource::make($family->load('foodPackages')),
            'food_packages' => FoodPackage::all()->select(['id', 'name']),
            'edit' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFamilyRequest $request, Family $family)
    {
        DB::transaction(function () use ($request, $family) {
            $data = $request->validated();

            $food_packages = $data['food_packages'] ?? [];
            unset($data['food_packages']);

            $family->update($data);

            if (!$data['visited']) {
                $family->foodPackages()->detach();
                return;
            }

            $startDate = now()->startOfMonth();

            $family->foodPackages()->detach();

            $startDate = now()->startOfMonth();

            foreach ($food_packages as $index => $foodPackage) {
                $foodPackageId = $foodPackage['id'];

                $family->foodPackages()->attach($foodPackageId, [
                    'delivery_date' => $startDate->copy()->addMonths($index + 1)->toDateString(),
                ]);
            }
        });

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
