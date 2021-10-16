<?php

namespace App\Http\Controllers\Api\Lesson;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Reservation;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    public function __invoke(Lesson $lesson)
    {
        $user = Auth::user();
        $reservation = Reservation::create(['lesson_id' => $lesson->id, 'user_id' => $user->id]);

        return response()->json($reservation, Response::HTTP_CREATED);
    }
}