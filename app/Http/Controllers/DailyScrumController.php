<?php

namespace App\Http\Controllers;
use Auth;
// use App\DailyScram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DailyScrumController extends Controller
{
    public function daily() {
        $data = "Data All";
        return response()->json($data);
    }

    public function dailyAuth(){
        $data ="Welcome" . Auth::user()->Firstname;
        return response()->json($data);
    }
}
