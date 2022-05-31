<?php

namespace Src\Controllers;

use App\Http\Controllers\Controller;
use Src\Models\Dev;
use Src\Models\Task;

class ScheduleController extends Controller
{
    const WEEK_HOURS = 42;

    public function index()
    {

        $devs = Dev::with('tasks')->get();

        $minWeeks = ceil ( max( $devs->pluck('busy_hours')->toarray() ) / self::WEEK_HOURS ) ;

        return view('index', compact('devs' , 'minWeeks'));

    }
}
