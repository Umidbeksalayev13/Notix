<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $events = \App\Helper\Telegram::getEvents($startDate, $endDate, Auth::id());

        return response()->json($events);
    }
}
