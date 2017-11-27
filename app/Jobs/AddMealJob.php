<?php
/**
 * Author: Francis Addai <me@faddai.com>
 * Date: 23/09/2017
 * Time: 8:03 PM
 */
namespace App\Jobs;

use App\Entities\Meal;
use App\Exceptions\NoMealItemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddMealJob
{
    /**
     * @var Request
     */

    private $request;
    /**
     * @var Meal|null
     */
    private $meal;

    /**
     * Create a new job instance.
     *
     * @param Request $request
     * @param Meal|null $meal
     */
    public function __construct(Request $request, Meal $meal = null)
    {
        $this->request = $request;

        $this->meal = $meal ?? new Meal(['created_by' => $this->request->user()->id]);
    }

    /**
     * Execute the job.
     *
     * @return Meal
     */
    public function handle()
    {
        return DB::transaction(function () {
            $meal = $this->saveMeal();

            $this->saveMealItems();

            return $meal;
        });
    }

    private function saveMealItems()
    {
        if (! $this->request->get('meal_items')) {
            throw new NoMealItemException;
        }

        $this->meal->items()->sync($this->request->get('meal_items'));
    }

    /**
     * @return Meal|null
     */
    private function saveMeal()
    {
        foreach ($this->meal->getFillable() as $fillable) {
            if ($this->request->has($fillable)) {
                $this->meal->{$fillable} = $this->request->get($fillable);
            }
        }

        $this->meal->save();

        return $this->meal;
    }
}
