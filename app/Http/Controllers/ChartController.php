<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\ChartRequest;

class ChartController extends Controller
{
    public function chart()
    {
        return view("chart");
    }
    
    public function home()
    {
        return view("home");
    }
    
    public function check(ChartRequest $request)
    {
        $date1 = date('d-m-Y', strtotime( $request->input('datefirst') ) );
        $date2 = date('d-m-Y', strtotime( $request->input('datesecond') ) );
        return redirect()->route('home', ['date1' => $date1,'date2' => $date2 ] );
    }
}
