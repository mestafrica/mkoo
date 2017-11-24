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
        $this->menu->serving_at = Carbon::parse('this monday')->toDateString();
        $this->menu->save();
        
        foreach ($this->request->get('meals') as $date => $types) {
            foreach ($types as $type => $meals) {
                foreach ($meals as $meal) {
                    $this->menu->meals()->attach($meal, ['serves_at' => $date, 'type' => $type]);
                }
            }
        }
        
        return $this->menu;
    }
}
