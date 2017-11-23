<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Entities\Menu;
use Illuminate\Http\Request;

class AddMenuJob
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Menu|null
     */
    private $menu;

    /**
     * Create a new job instance.
     *
     * @param Request $request
     * @param Menu|null $menu
     */
    public function __construct(Request $request, Menu $menu = null)
    {
        $this->request = $request;

        $this->menu = $menu ?? new Menu(['created_by' => $this->request->user()->id]);
    }

    /**
     * Execute the job.
     *
     * @return Menu
     */
    public function handle()
    {

        $allowedDates = config('allowed_dates')['menu'];
        
        if (!in_array(Carbon::now()->format('l'), $allowedDates)) {
            throw new \Exception('Sorry you may not create menus at this time', 1001);
        }
        
        $this->menu->serving_at = Carbon::parse('next monday')->toDateString();
        $savedMenu = $this->menu->save();
        $menu_id = $this->menu->id;

        $output1 = $output2 = false;
        $entireMealSelection = [];
        $dailyMenu = collect($this->request->all())->except('_token');
          $mapChoices = function ($choices, $day, $type) use ($menu_id) {

            $dailySelection = [
                 [
                    "menu_id" =>$menu_id,
                    "serves_at"=> Carbon::parse('this '.$day)->toDateString(),
                    "meal_id" => $choices[0],
                    "type" => $type
                 ],
                 [
                    "menu_id" =>$menu_id,
                    "serves_at"=> Carbon::parse('this '.$day)->toDateString(),
                    "meal_id" => $choices[1],
                    "type" => $type
                 ]
            ];
            return $dailySelection;
          };

        foreach ($dailyMenu as $day => $type) {
            $entireMealSelection[] = $mapChoices($type["lunch"], $day, "lunch") + $mapChoices($type["dinner"], $day, "dinner");
        }
        $savedItems = \DB::table('menu_items')->insert($entireMealSelection[0]);

        return ($savedMenu && $savedItems)? $this->menu : false ;
    }
}
