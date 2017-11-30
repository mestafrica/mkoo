<?php

namespace App\Http\Controllers;

use App\Entities\Menu;
use App\Entities\Order;
use App\Entities\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserOrdersController extends Controller
{
    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, User $user)
    {
        $user = $user->load('orders.items');

        $currentWeekOrder = $user->getCurrentWeekOrder();

        $nextWeekOrder = $user->getNextWeekOrder();

        $isNextWeekMenuAvailable = Menu::isAvailableForNextWeek();


        return view('dashboard.users.orders.index',
            compact( 'nextWeekOrder', 'currentWeekOrder', 'user', 'isNextWeekMenuAvailable')
        );
    }

    /**
     * @param Request $request
     * @param User $user
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, User $user, Order $order)
    {
        $order->load('items');

        $order = $order->getGroupedOrderItems();

        return view('dashboard.users.orders.show', compact('user', 'order'));
    }

}
