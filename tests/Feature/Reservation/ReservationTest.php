<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;
use App\Models\Reservation;
use App\Models\RestaurantTable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_reservation_walkIn_can_transaction(): void
    {
        $user = User::factory()->create();
        $restaurantTable = RestaurantTable::factory()->create();

        $token = $user->createToken('api-token')->plainTextToken;

        // $this->assertAuthenticated();
        // $this->withToken($token)->getJson(route('reservations.store'));
        $headers = array(
            'Authorization' => 'Bearer '.$token,
            'Accept' => 'application/json'
        );
        $data=[
            // 'data' => [
                // [
                    'user_id' => $user->id,
                    'table_id' => $restaurantTable->id,
                    'reservation_time' => date('Y-m-d H:i:s'),
                    'is_walk_in' => true,
                // ]
            // ]
        ];
        $response =  $this->withHeaders($headers)->post(route('reservations.store'),$data);
        $response->assertStatus(200);
        // expect($response->status())->toBeOneOf([200, 201]); 
        /* ->assertStatus(200)
        ->assertJson(
                [
                    'user_id' => $user->id,
                    'table_id' => $restaurantTable->id,
                    'reservation_time' => date('Y-m-d H:i:s'),
                    'is_walk_in' => true,
                ]
            
                ); */
    }
}
