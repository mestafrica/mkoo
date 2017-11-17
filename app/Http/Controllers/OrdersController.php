<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Jobs\AddOrder;
use App\Entities\Order;
use App\Entities\Menu;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = collect();

        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        return view('dashboard.orders.index', compact('orders', 'daysOfWeek'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $menu = Menu::where("serving_at", Carbon::parse('this monday')
            ->toDateString())->with('menuItems')->get();

        $menuItems = (count($menu))?$menu->first()->menuItems : [];

        $getItem = function ($day, $type) use ($menuItems) {
            $date = Carbon::parse('this '.$day)->toDateString();
            $item = (count($menuItems))?$menuItems->where('serves_at', $date)
                ->where('type', $type)->all() : [];
            return $item;
        };
       
        return view('dashboard.orders.create', compact('menu', 'getItem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->orderExists()) {
              flash()->warning('Sorry but you already placed your order');
              return redirect()->route('orders.index');
        }
        $rule = 'required';
        $fields = ['monday.dinner','tuesday.dinner',
        'wednesday.dinner','thursday.dinner', 'friday.dinner', 'saturday.dinner']+
        
        ['monday.lunch','tuesday.lunch',
        'wednesday.lunch','thursday.lunch', 'friday.lunch', 'saturday.lunch'];

        $input = array_fill_keys($fields, $rule);
        $validator = \Validator::make($request->all(), $input);
        if ($validator->fails()) {
            flash()->error('Please be sure to fill out every field');
            return back();
        }

        try {
            $this->dispatch(new AddOrder($request->all()));
            flash()->success('You have successfully placed your order');
        } catch (\Exception $exception) {
            logger()->error('Menu could not be created', compact('exception'));

            flash()->error('The menu could not be created. Error: '. $exception->getMessage());

            return back();
        }

        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Order $order)
    {
        $order->load('items');

        return view('dashboard.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    private function orderExists()
    {
           return Order::where('serving_at', Carbon::parse('this monday')
        ->toDateString())->where('user_id', \Auth::id())->get();
    }
}
