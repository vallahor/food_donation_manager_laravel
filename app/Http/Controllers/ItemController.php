<?php

namespace App\Http\Controllers;

use App\Enums\Measurement;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Inertia\Inertia;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        return Inertia::render('Item/Index', ['items' => ItemResource::collection($items)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Item/Form', [
            'item' => ItemResource::make(new Item()),
            'edit' => false,
            'measurements' => Measurement::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        Item::create($request->validated());

        return to_route('item.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return Inertia::render('Item/Show', [
            'item' => ItemResource::make($item),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return Inertia::render('Item/Form', [
            'item' => ItemResource::make($item),
            'edit' => true,
            'measurements' => Measurement::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update($request->validated());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return back();
    }
}
