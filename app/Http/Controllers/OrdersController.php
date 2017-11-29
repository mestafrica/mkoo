<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Jobs\AddOrderJob;
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
        $menu = Menu::with('meals')
            ->where("serving_at", Carbon::parse('next monday'))
            ->first();

        return view('dashboard.orders.create', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'meals' => 'required|array',
            'meals.*' => 'required|numeric',
            'menu_id' => 'bail|required|numeric|exists:menus,id'
        ]);

        try {
            $this->dispatch(new AddOrderJob($request));
            flash()->success('You have successfully placed your order');
        } catch (\Exception $exception) {
            logger()->error('Order could not be placed', compact('exception'));

            flash()->error('Order could not be placed. Error: '. $exception->getMessage());

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
}
