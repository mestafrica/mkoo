<?php

use App\Jobs\AddMealJob;
use App\Meal;
use Illuminate\Database\Seeder;

class MealsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meals = collect([
            'Tomato Srouce with Plain Rice',
            'Beef Fried Rice',
            'Yam Chips and Gizzard',
            'Chinese Stew and Plain Rice',
            'Assorted Jollof Rice',
            'Romonery Source and Victa Rice',
            'Plain Rice and Beans Stew',
            'Fried Plantain',
            'Jollof Rice and Spices Wings',
            'Kba and Okro Stew',
            'French Fries and Fried Chicken',
            'Stanfor Rice and Vegetable Stew',
            'Banku and Fish',
            'FuFu and Goat Meat',
            'Light Soup and Groundnut Soup With Plain Rice',
            'Fried Rice And Roasted Chicken',
            'Vegetable sauce with plain rice',
            'Macaroni and meat tomato sauce ',
            'Chinese stew and pasta',
            'Chicken and beef sauce with rice',
            'Chinese Noodles',
            'Red Red and plain rice',
            'Red red and fried plantains',
            'Hot wings and French Fries',
            'Lasagna',
            'Vegetable rice and egg stew',
            'Fried rice and roasted chicken',
            'Meat stew with potato skins',
            'Aplem Sauce and Palava',
            'Aplem Sauce and Plain Rice',
            'Vegetable Rice and Chicken Wings',
            'Boiled Plantian and Vegetable Stew',
            'Jollof Rice and Fish',
            'Fried Rice and Roasted Chicken',
            'Steamed Potato and Meat Ball Stew',
            'Vegetable Gizzard Sauce and Plain Rice',
            'Supagety Rice and Fried Fish',
            'Rosted Tilapa and Banku',
            'Roasted Tilapia and Plain Rice',
            'Kenkey and Fish',
            'Plain Rice',
            'Arrony Rice',
            'Jollof Rice and Roasted Chicken',
            'Acheke and Fish Stew',
            'Coconut Rice and Roasted Chicken stew',
            'Assorted Fried Rice',
            'Plain Rice and Chicken Sauce',
            'Banku and Okro Stew',
            'Meatball stew',
            'Waakye and Fish Stew',
            'Stanfor Rice',
            'Steamed Potatoes and Fish stew',
            'Kokonte and Groundnut soup',
            'Vegetable soup with Yam',
        ]);

        $meals->sort()
            ->each(function (string $meal) {
                Meal::firstOrCreate([
                    'name' => $meal,
                    'description' => $meal
                ]);
            });

    }
}
