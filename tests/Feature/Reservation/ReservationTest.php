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
                    'is_walk_in' => 'yes',
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
    /* public function test_rc_reservation_can_transaction(): void
    {
        // it('checks for race condition in your API', function () {
            // Arrange
            $user = User::factory()->create();
            $restaurantTable = RestaurantTable::factory()->create();
            $token = $user->createToken('api-token')->plainTextToken;

            $user2 = User::factory()->create();
            // $restaurantTable2 = RestaurantTable::factory()->create();
            $token2 = $user->createToken('api-token')->plainTextToken;

            $headers = array(
                'Authorization' => 'Bearer '.$token,
                'Accept' => 'application/json'
            );
            $headers2 = array(
                'Authorization' => 'Bearer '.$token2,
                'Accept' => 'application/json'
            );
            $data=[
                    'user_id' => $user->id,
                    'table_id' => $restaurantTable->id,
                    'reservation_time' => date('Y-m-d H:i:s'),
                    'is_walk_in' => 'yes',
            ];
            $data2=[
                'user_id' => $user2->id,
                'table_id' => $restaurantTable->id,
                'reservation_time' => date('Y-m-d H:i:s'),
                'is_walk_in' => 'no',
            ];
        
            // Act
            parallel([
                fn () => $response1 = $this->withHeaders($headers)->post(route('reservations.store'),$data),
                fn () => $response2 = $this->withHeaders($headers2)->post(route('reservations.store'),$data),
            ]);
        
            // Assert
            expect($response1->status())->toBeOneOf([200, 201]); // Check if the first request was successful
            expect($response2->status())->toBeOneOf([200, 201]); // Check if the second request was successful
        
            // Optionally, assert other conditions related to the race condition
            // For example, if your application should prevent duplicate records, you could check the count of records.
           // expect(YourModel::where('data', 'new data')->count())->toBe(1);
        // });
    } */
}
