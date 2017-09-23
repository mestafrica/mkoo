<?php

namespace App\Http\Controllers;

use App\Jobs\AddMealJob;
use App\Meal;
use Illuminate\Http\Request;

class MealsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meals = Meal::all();

        return view('dashboard.meals.index', compact('meals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meal = new Meal;

        return view('dashboard.meals.create', compact('meal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param Meal $meal
     * @return \Illuminate\Http\Response
     */
    public function edit(Meal $meal)
    {
        $title = 'Update meal';
        $action = route('meals.update', compact('meal'));
        $buttonText = 'Save changes';

        return view('dashboard.meals.create', compact('meal', 'title', 'action', 'buttonText'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Meal $meal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meal $meal)
    {
        try {
            $this->dispatch(new AddMealJob($request, $meal));
            flash()->success('You have updated the meal successfully');
        } catch (\Exception $exception) {
            logger('Error occurred while updating meal', compact('exception'));
            flash()->error('The meal was not updated. Error: '. $exception->getMessage());
        }

        return back();
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
