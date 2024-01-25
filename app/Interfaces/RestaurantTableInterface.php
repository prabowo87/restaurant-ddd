<?php

namespace App\Interfaces;

use App\Http\Requests\RestaurantTableRequest;

interface RestaurantTableInterface
{
    /**
     * Get all Restaurant Table
     * 
     * @method  GET api/tables
     * @access  public
     */
    public function getAllRestaurantTables();

    /**
     * Get all available Restaurant Table
     * 
     * @method  GET api/tables
     * @access  public
     */
    public function getAvailableRestaurantTables();

    /**
     * Get Restaurant Table By ID
     * 
     * @param   integer     $id
     * 
     * @method  GET api/tables/{id}
     * @access  public
     */
    public function getRestaurantTableById($id);

    /**
     * Create 
     * 
     * @param   \App\Http\Requests\RestaurantTableRequest    $request
     
     * 
     * @method  POST    api/tables       For Create
     * @access  public
     */
    public function createRestaurantTable(RestaurantTableRequest $request);

    /**
     * Delete Restaurant Table
     * 
     * @param   integer     $id
     * 
     * @method  DELETE  api/tables/{id}
     * @access  public
     */
    public function deleteRestaurantTable($id);

  
}