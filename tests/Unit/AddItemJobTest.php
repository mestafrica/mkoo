<?php

namespace Tests\Unit;

use App\Entities\Item;
use App\Jobs\AddItemJob;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AddItemJobTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_add_an_item()
    {
        $this->setRequestUser()
            ->merge([
                'name' => 'plantain',
                'description' => 'Lorem'
            ]);

        $item = dispatch_now(new AddItemJob($this->request));

        self::assertInstanceOf(Item::class, $item);
        self::assertEquals('Plantain', $item->name);
        self::assertEquals('Lorem', $item->description);
        self::assertNotNull($item->createdBy);

    }

    public function test_can_update_an_item()
    {
        $this->setRequestUser()
            ->merge([
                'name' => 'plantain',
                'description' => 'Lorem'
            ]);

        $item = dispatch_now(new AddItemJob($this->request));

        $this->request->replace(['name' => 'Green plantain']);

        $updatedItem = dispatch_now(new AddItemJob($this->request, $item));

        self::assertInstanceOf(Item::class, $item);
        self::assertEquals('Green Plantain', $updatedItem->name);
        self::assertEquals('Lorem', $item->description);
        self::assertNotNull($item->createdBy);

    }
}
