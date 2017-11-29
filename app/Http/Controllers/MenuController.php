<?php

namespace App\Http\Controllers;

use App\Entities\Meal;
use App\Entities\Menu;
use App\Exceptions\InvalidDayForMenuCreationException;
use App\Jobs\AddMenuJob;
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
        $menu = new Menu;

        $meals = Meal::all();

        $meals->prepend(new Meal(['name' => '-- Select a meal --', 'id' => '']));

        $dates = get_dates_for_the_week();

        return view('dashboard.menu.create', compact('menu', 'meals', 'dates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'meals.*.*' => 'required|array|size:2',
            'meals.*.*.*' => 'required|numeric',
        ]);

        try {
            $this->dispatch(new AddMenuJob($request));

            flash()->success('ou have successfully added the menu for the specified week');

            return redirect()->route('menu.index');

        } catch (InvalidDayForMenuCreationException $exception) {
            logger()->error('Menu could not be created', compact('exception'));

            flash()->error('Menu could not be created. ' . $exception->getMessage());

        } catch (\Exception $exception) {
            logger()->error('Menu could not be created', compact('exception'));

            flash()->error('The Menu could not be created. An unexpected error occurred');

        }

        return back();
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
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
