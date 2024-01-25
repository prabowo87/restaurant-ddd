<?php

namespace App\Repositories;

use DB;
use App\Models\Reservation;
use App\Traits\ResponseAPI;
use App\Models\RestaurantTable;
use App\Interfaces\ReservationInterface;
use App\Http\Requests\ReservationRequest;

class ReservationRepository implements ReservationInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    public function getAllReservations()
    {
        try {
            $reservation = Reservation::all();
            return $this->success("All Reservation", $reservation);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getReservationById($id)
    {
        try {
            $reservation = Reservation::find($id);
            
            // Check the user
            if(!$reservation) return $this->error("No Reservation with ID $id", 404);

            return $this->success("Reservation Detail", $reservation);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
    

    public function createReservation(ReservationRequest $request)
    {
        DB::beginTransaction();
        try {
            // If restaurant table is_booked = yes when we find it
            // Then create Reservation
            // Else cant create reservation.

            //lockForUpdate to prevent race condition

            $restaurantTableCheck=RestaurantTable::lockForUpdate()->where('id',$request->table_id)->first();
            if ($restaurantTableCheck){
                if ($restaurantTableCheck->is_booked=='no'){
                    
                    $reservation = new Reservation;
                    $reservation->user_id = $request->user_id;
                    $reservation->table_id = $request->table_id;
                    $reservation->is_walk_in = $request->is_walk_in;
                    if ($request->is_walk_in=='no')
                        $reservation->reservation_time = $request->reservation_time;
                    else $reservation->reservation_time = date('Y-m-d H:i:s');
                   
                    

                    // Save the Reservation
                    $reservation->save();
                    DB::commit();
           
                    return $this->success(
                        "Reservation created",
                        $reservation,200);
                }else{
                    DB::rollBack();
                    return $this->error("Table has booked", 402);
                }
            }else{
                DB::rollBack();
                return $this->error("Table Not Found", 404);
            }
            

            
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    

    public function deleteReservation($id)
    {
        DB::beginTransaction();
        try {
            $reservation = Reservation::find($id);

            // Check the user
            if(!$reservation) return $this->error("No Reservation  with ID $id", 404);

            // Delete the user
            $reservation->delete();

            DB::commit();
            return $this->success("Reservation deleted", $reservation);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}