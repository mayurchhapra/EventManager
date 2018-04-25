<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Event;
use Carbon;
use DateTime;

class UserController extends Controller
{
    //
    public function save(Request $req){
    	echo "<style>
				.loader {
					margin-top:25%;
				  border: 16px solid #f3f3f3;
				  border-radius: 50%;
				  border-top: 16px solid #3498db;
				  width: 120px;
				  height: 120px;
				  -webkit-animation: spin 2s linear infinite; /* Safari */
				  animation: spin 2s linear infinite;
				}

				/* Safari */
				@-webkit-keyframes spin {
				  0% { -webkit-transform: rotate(0deg); }
				  100% { -webkit-transform: rotate(360deg); }
				}

				@keyframes spin {
				  0% { transform: rotate(0deg); }
				  100% { transform: rotate(360deg); }
				}
			</style> 
			<center><div class='loader'></div></center>
			";
    	
    	$dataToSave=array(
    		"name"=>$req->input('name'),
    		"email"=>$req->input('email'),
    		"contact"=>$req->input('contact'),
    		"gender"=>$req->input('gender'),
    		"date_of_birth"=>$req->input('date_of_birth'),
    		"password"=>$req->input('password')
    	);

    	if($req->input('id')){
    		User::where('id',$req->input('id'))->update($dataToSave);
    	}
    	else{
    		User::create($dataToSave);
    	}
    	return redirect()->route('login',[]);
    }

    public function authenticate(Request $req){
    	$email = $req->input('email');
    	$password = $req->input('password');

    	$dataToAuth = array(
    		"email"=>$email,
    		"password"=>$password
    	);

    	$data = User::where($dataToAuth)->get();
    	if(count($data)>0){
    		$req->session()->put('id',$data[0]->id);
    		$req->session()->put('name',$data[0]->name);
    		return redirect()->route('dashboard');
    	}
    	else
    	{
    		return redirect()->route('login',['error'=>'Error']);
    	}
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function logout(Request $req){
    	$req->session()->forget('id');
    	$req->session()->forget('name');
    	return redirect('/');
    }

    public function eventSave(Request $req){

    	$eventToSave=array(
    		'user_id' => $req->session()->get('id'),
    		'task'=>$req->input('task'),
    		'date_of_event'=> $req->input('date_of_event'),
    		'disc'=>$req->input('desc')
    	);

    	Event::create($eventToSave);

    	return redirect()->route('eventRegister',['save'=>'Saved']);
    }

    public function today()
    {
        $date_today = Carbon\Carbon::today()->format('Y-m-d');
        json_encode($obj_event = Event::where('date_of_event','like','%'.$date_today.'%')
                                ->orWhere(function ($query){
                                $day_month = Carbon\Carbon::today()->format('m-d');
                                $query->where('date_of_event','like','%'.$day_month.'%')
                                      ->where('task','Birthday');
                            })
                            ->get());

        $today_data = array(
                'status'=>true,
                'message'=>"This Contains Tomorrow's event list.",
                'data'=>$obj_event
           ); 

        return json_encode($today_data);
    }

    public function tomorrow()
    {
        $date_tomorrow = Carbon\Carbon::tomorrow()->format('Y-m-d');
        json_encode($obj_event = Event::where('date_of_event','like','%'.$date_tomorrow.'%')
                                ->orWhere(function ($query){
                                            $day_month = Carbon\Carbon::tomorrow()->format('m-d');
                                            $query->where('date_of_event','like','%'.$day_month.'%')
                                                  ->where('task','Birthday');
                                        })
                            ->get());
            $tomorrow_data = array(
                'status'=>true,
                'message'=>"This Contains Tomorrow's event list.",
                'data'=>$obj_event
           ); 

           return json_encode($tomorrow_data);
    }

    public function all(){
        $date_today = Carbon\Carbon::today()->format('Y-m-d');
        json_encode($obj_event = Event::where('date_of_event','>=',$date_today)
                                    ->orWhere(function($q){
                                        $day_month = Carbon\Carbon::today()->format('m-d');
                                        $q  ->where('date_of_event','>=','%'.$day_month.'%')
                                            ->where('task','Birthday');
                                    })
                                    ->get());
           $all_data = array(
                'status'=>true,
                'message'=>"this Contains all the event list.",
                'data'=>$obj_event
           ); 

           return json_encode($all_data);

    }


}
