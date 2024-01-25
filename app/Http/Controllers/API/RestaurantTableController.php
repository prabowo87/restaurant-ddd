<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\RestaurantTableInterface;
use App\Http\Requests\RestaurantTableRequest;

class RestaurantTableController extends Controller
{
    protected $restaurantTableInteface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(RestaurantTableInterface $restaurantTableInteface)
    {
        $this->restaurantTableInteface = $restaurantTableInteface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->restaurantTableInteface->getAllRestaurantTables();
    }

    public function getAvailableRestaurantTables()
    {
        return $this->restaurantTableInteface->getAvailableRestaurantTables();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RestaurantTableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RestaurantTableRequest $request)
    {
        return $this->restaurantTableInteface->createRestaurantTable($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->restaurantTableInteface->getRestaurantTableById($id);
    }

  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->restaurantTableInteface->deleteRestaurantTable($id);
    }

   
}
