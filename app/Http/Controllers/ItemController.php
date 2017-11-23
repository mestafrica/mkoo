<?php

namespace App\Http\Controllers;

use App\Entities\Item;
use App\Jobs\AddItemJob;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();

        return view('dashboard.item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $item = $this->dispatch(new AddItemJob($request));

            flash()->success(sprintf('Item "%s" has been created successfully.', $item->name));
        } catch (\Exception $exception) {
            logger()->error('The item could not be created.', compact('exception'));

            flash()->error('The item could not be created. Please try again. Error: '. $exception->getMessage());

            return back();
        }

        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Item $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $title = 'Update item';
        $action = route('items.update', compact('item'));
        $buttonText = 'Save changes';

        return view('dashboard.item.create', compact('item', 'title', 'action', 'buttonText'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Item $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        try {
            $item = $this->dispatch(new AddItemJob($request, $item));

            flash()->success(sprintf('Item "%s" has been updated successfully.', $item->name));
        } catch (\Exception $exception) {
            logger()->error('The item could not be updated.', compact('exception'));

            flash()->error('The item could not be updated. Please try again. Error: '. $exception->getMessage());

            return back();
        }

        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
