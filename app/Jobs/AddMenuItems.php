<?php

namespace App\Jobs;

use App\Entities\MenuItem;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AddMenuItems
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $items;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $output1 = $output2 = false;
        $menu_id = $this->items['menu_id'];
        $entireMealSelection = [];
        $dailyMenu = collect($this->items)->except('menu_id', '_token');
        
          $mapChoices = function ($choices, $day, $type) use ($menu_id) {

            $dailSelection = [
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
            return $dailSelection;
          };

        foreach ($dailyMenu as $day => $type) {
            $entireMealSelection[] = $mapChoices($type["lunch"], $day, "lunch") + $mapChoices($type["dinner"], $day, "dinner");
        }
        return \DB::table('menu_items')->insert($entireMealSelection[0]);
    }
}
