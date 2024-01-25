<?php

namespace App\Interfaces;

use App\Http\Requests\ReservationRequest;
use App\Http\Requests\RestaurantTableRequest;

interface ReservationInterface
{
    /**
     * Get all Reservations
     * 
     * @method  GET api/reservations
     * @access  public
     */
    public function getAllReservations();

    /**
     * Get Reservations By ID
     * 
     * @param   integer     $id
     * 
     * @method  GET api/reservations/{id}
     * @access  public
     */
    public function getReservationById($id);

    /**
     * Create 
     * 
     * @param   \App\Http\Requests\ReservationeRequest    $request
     
     * 
     * @method  POST    api/tables       For Create
     * @access  public
     */
    public function createReservation(ReservationRequest $request);

    /**
     * Delete user
     * 
     * @param   integer     $id
     * 
     * @method  DELETE  api/tables/{id}
     * @access  public
     */
    public function deleteReservation($id);

  
}