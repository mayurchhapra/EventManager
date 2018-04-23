<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Event;
use Carbon\Carbon;
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

    public function today(){

        $date = date_create('01/15/2022');
        $epoch = date_format($date, 'U');
        echo trim($epoch);

        echo "<br>";
        $date = new DateTime();
        $year =  $date->format('Y');

        echo gettype((integer)$year);
        echo "<br>";

        $start_date_of_year = $date->setDate((integer)$year,1,1);
        echo date_format($start_date_of_year, 'U');
        // echo "  ".$start_date_of_year->format('d-m-y');

        echo "<br>";

        $current_date = date_create(Carbon::now());
        $current = date_format($current_date, 'U');
        echo ($current);

        echo "<br>";

        $interval = $start_date_of_year->diff($current_date);

        $gape = (integer)$interval->format('%a');

        echo "Gape = ".$gape;



    }
}
