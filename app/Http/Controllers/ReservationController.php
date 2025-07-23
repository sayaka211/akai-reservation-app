<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\JsonResponse;

class ReservationController extends Controller
{

    public function index(): JsonResponse
    {
        return response()->json(Reservation::orderBy('date', 'desc')->orderBy('start_time')->get());
    }
}
