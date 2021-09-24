<?php

namespace App\Http\Controllers;
use App\Models\Time;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;

class timeController extends Controller
{
    public function getTime(Request $request){

        if(Time::where('id', 2) -> exists()){
            $time = Time::find(2);
            return response() -> json($time);
        } else{
            return response() -> json (["Message", "Could not find Time"]);
        }
    }
    public function setTime (Request $request, $id){
        
        if(Time::where('id', $id) -> exists()){
            $gotTime = Time::find($id);  //finding time with id =1
            $t = time();                    //getting current time
            $time_hours = date("h", $t);    //parsing hours
            $time_minutes = date("i", $t);
            $time_seconds = date('s', $t) + 10;   //parsing seconds
            
            //Updating time in table DB
            $gotTime->hours = $time_hours;
            $gotTime->minutes = $time_minutes;
            $gotTime->seconds = $time_seconds;
            $gotTime->save();       //saving table
            return response() -> json($gotTime);
        }
            return response() -> json(["Message" => "Could not find category with the id" ]);
    }
}
