<?php

namespace App\Jobs;

use App\Entities\Item;
use Illuminate\Http\Request;

class AddItemJob
{
    /*
     * @var Request
     */
    private $request;

    /*
     * @var Item|null
     */
    private $item;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $request, Item $item = null)
    {
        //
        $this->request = $request;
        $this->item = $item ?? new Item(['created_by' => $this->request->user()->id()]);
    }

    /**
     * Execute the job.
     *
     * @return Item
     */
    public function handle()
    {
        //
        foreach ($this->item->getFillable() as $fillable) {
            if ($this->request->has($fillable)){
                $this->item->{$fillable} = ($fillable === 'name')? ucwords($this->request->get($fillable)) : $this->request->get($fillable);
            }
        }

        $this->item->save();
        return $this->item;
    }
}
