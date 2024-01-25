<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\ReservationInterface;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    protected $reservationInteface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(ReservationInterface $reservationInteface)
    {
        $this->reservationInteface = $reservationInteface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->reservationInteface->getAllReservations();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ReservationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        return $this->reservationInteface->createReservation($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->reservationInteface->getReservationById($id);
    }

  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->reservationInteface->deleteReservation($id);
    }
}
