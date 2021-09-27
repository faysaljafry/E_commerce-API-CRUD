<?php

namespace App\Http\Controllers;
use App\Models\Time;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;

class timeController extends Controller
{
    public function getTime(Request $request){

        if(Time::where('id', 1) -> exists()){
            $time = Time::find(1);
            return response() -> json($time);
        } else{
            return response() -> json (["Message", "Could not find Time"]);
        }
    }
    public function setTime (Request $request, $id){
        
        if(Time::where('id', $id) -> exists()){
            $gotTime = Time::find($id);  //finding time with id =1
            $t = time();                    //getting current time
           // $difference = $gotTime -> seconds;
            $gotTime->seconds += 30;
            if($gotTime->seconds > 60){
                $gotTime->seconds = $gotTime -> seconds - 60;
                $gotTime -> minutes += 1; 
            }
            
            //Updating time in table DB
            $gotTime->hours = 0;
            
            $gotTime->save();       //saving table
            return response() -> json ($gotTime);
        }
            return response() -> json(["Message" => "Could not find category with the id" ]);
    }
    public function updateTime(Request $request){
        if(Time::where('id', 1) -> exists()){
            $time = Time::find(1);
            $time->minutes = $request->minutes;
            $time -> seconds = $request -> seconds;
            $time->save(); 
            return response() -> json($request);
        } else{
            return response() -> json (["Message", "Could not find Time"]);
        }
    }
}
