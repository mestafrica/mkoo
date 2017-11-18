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

        $dailyMenu = collect($this->items)->except('menu_id', '_token');
        
          $mapChoices = function ($choices, $day, $type) use ($menu_id) {
            $option1 = new MenuItem();
            $option2 = new MenuItem();

            $option1->menu_id = $menu_id;
            $option1->serves_at = Carbon::parse('this '.$day)->toDateString();
            $option1->type = $type;
            $option1->meal_id = $choices[0];
            
            $option2->menu_id = $menu_id;
            $option2->serves_at = Carbon::parse('this '.$day)->toDateString();
            $option2->type = $type;
            $option2->meal_id = $choices[1];
            
            return ($option1->save() && $option2->save());
          };

        foreach ($dailyMenu as $day => $type) {
            $output1 = $mapChoices($type["lunch"], $day, "lunch");
            $output2 = $mapChoices($type["dinner"], $day, "dinner");
        }
          return ($output1 && $output2);
    }
}
