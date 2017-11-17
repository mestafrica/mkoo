<?php

namespace App\Http\Controllers;

use App\Entities\Meal;
use App\Jobs\AddMenuJob;
use App\Entities\Menu;
use App\Jobs\AddMenuItems;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::orderBy('serving_at', 'desc')->paginate(10);
        return view('dashboard.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**
         * Create menu for the days in next week
         * For each day in the week,
         * - add 2 meal options to be selected by a user
         * Figure out which week this is and
         */
        $menu = new Menu;

        $meals = Meal::all();

        $meals->prepend(new Meal(['name' => '-- Select a meal --', 'id' => '']));

        return view('dashboard.menu.create', compact('menu', 'meals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = 'required|array|size:2';
        $fields = ['monday.dinner','tuesday.dinner',
        'wednesday.dinner','thursday.dinner', 'friday.dinner', 'saturday.dinner']+
        
        ['monday.lunch','tuesday.lunch',
        'wednesday.lunch','thursday.lunch', 'friday.lunch', 'saturday.lunch'];

        $input = array_fill_keys($fields, $rule);
        $validator = \Validator::make($request->all(), $input);

        if (!$validator->fails()) {
            flash()->error('Please be sure to fill out every field');
            return back();
        }
        
        try {
            $requestPayload = $this->dispatch(new AddMenuJob($request));
            $this->dispatch(new AddMenuItems($requestPayload));
            flash()->success('You have successfully added a menu for the coming week');
        } catch (\Exception $exception) {
            logger()->error('Menu could not be created', compact('exception'));

            flash()->error('The menu could not be created. Error: '. $exception->getMessage());

            return back();
        }

        return redirect()->route('menu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return view('dashboard.menu.create', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('dashboard.menu.create', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
