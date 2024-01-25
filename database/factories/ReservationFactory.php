<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Reservation::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100), // Assuming you have users in the database
            'table_id' => $this->faker->numberBetween(1, 100),
            'reservation_time' => $this->faker->dateTimeBetween('+1 day', '+7 days'),
            'is_walk_in' => 'yes',
        ];
    }
}
