<?php

namespace App\Repositories;

use DB;
use App\Models\RestaurantTable;
use App\Traits\ResponseAPI;
use App\Interfaces\RestaurantTableInterface;
use App\Http\Requests\RestaurantTableRequest;

class RestaurantTableRepository implements RestaurantTableInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    public function getAllRestaurantTables()
    {
        try {
            $restaurantTables = RestaurantTable::all();
            return $this->success("All Restaurant Tables", $restaurantTables);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getAvailableRestaurantTables()
    {
        try {
            $restaurantTables = RestaurantTable::where('is_booked','no')->get();
            return $this->success("Available Restaurant Tables", $restaurantTables);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getRestaurantTableById($id)
    {
        try {
            $restaurantTable = RestaurantTable::find($id);
            
            // Check the user
            if(!$restaurantTable) return $this->error("No Restaurant Table with ID $id", 404);

            return $this->success("Restaurant Table Detail", $restaurantTable);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function createRestaurantTable(RestaurantTableRequest $request)
    {
        DB::beginTransaction();
        try {
            // create RestaurantTable.
            $restaurantTable = new RestaurantTable;

            $restaurantTable->name = $request->name;
            

            // Save the RestaurantTable
            $restaurantTable->save();

            DB::commit();
            
            return $this->success(
                "Restaurant Table created",
                $restaurantTable);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    

    public function deleteRestaurantTable($id)
    {
        DB::beginTransaction();
        try {
            $restaurantTable = RestaurantTable::find($id);

            // Check the RestaurantTable
            if(!$restaurantTable) return $this->error("No Restaurant Table with ID $id", 404);

            // Delete the RestaurantTable
            $restaurantTable->delete();

            DB::commit();
            return $this->success("Restaurant Table deleted", $restaurantTable);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}