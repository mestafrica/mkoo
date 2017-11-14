<?php

namespace App\Jobs;

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
        foreach ($this->menu->getFillable() as $fillable) {
            if ($this->request->has($fillable)) {
                $this->menu->{$fillable} = $this->request->get($fillable);
            }
        }

        $this->menu->save();

        return $this->menu;
    }
}
