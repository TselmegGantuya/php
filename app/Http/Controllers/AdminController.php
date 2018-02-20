<?php

namespace App\Http\Controllers;
use Response;
use Auth;
use App;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {	
    	if(!Auth::user()->role == 'admin'){
    		return '404';
    	}
    	$users = App\User::all();
    	return view('admin.index',compact('users'));
    }
    public function view($id)
    {
    	    	if(!Auth::user()->role == 'admin'){
    		return '404';
    	}
    	$lists = App\Info::where('user_id','=',$id)->get();
    	return view('home',compact('lists'));
    }
}