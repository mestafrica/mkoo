<?php
/**
 * Author: Francis Addai <me@faddai.com>
 * Date: 23/09/2017
 * Time: 8:03 PM
 */
namespace App\Jobs;

use App\Entities\Meal;
use Illuminate\Http\Request;

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
        foreach ($this->meal->getFillable() as $fillable) {
            if ($this->request->has($fillable)) {
                $this->meal->{$fillable} = $this->request->get($fillable);
            }
        }

        $this->meal->save();

        return $this->meal;
    }
}
