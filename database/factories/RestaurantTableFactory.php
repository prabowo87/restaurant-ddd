<?php

namespace Database\Factories;

use App\Models\RestaurantTable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RestaurantTable>
 */
class RestaurantTableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = RestaurantTable::class;
    private static $tableNumber = 1;
    public function definition(): array
    {
        return [
            'name' => 'Table '.self::$tableNumber++,
            
        ];
    }
}
