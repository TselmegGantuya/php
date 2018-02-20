<?php

namespace App\Http\Controllers;
use Response;
use Auth;
use App;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = App\info::where('user_id','=',Auth::user()->id)->get();

        return view('home',compact('lists'));
    }
    public function newList()
    {
        $list = new App\Info;
        $list->user_id = Auth::user()->id;
        $list->name = "New list";
        $list->tasks = "1|||New task";
        $list->save(); 
        return Response::json(array('success' => true,'last_inserted_id' => $list->id), 200);
    }
    public function listChange(Request $request, $id)
    {
        $list = App\Info::FindOrFail($id);
        if($request->input('name') == 'name')
        {
            $list->name = $request->input('value');
        }
        $list->update();
    }
        public function newTask(Request $request, $id)
    {
        $list = App\Info::FindOrFail($id);
        $tasks = explode('/|/', $list->tasks);
        $id = sizeof($tasks)+1;
        $list->tasks = $list->tasks . '/|/' . $id . '|||New task';
        
        $list->update();
    }
    public function taskChange(Request $request, $id)
    {
        $list = App\Info::FindOrFail($id);
        if($request->input('name') == 'task')
        {

            $tasks = explode('/|/', $list->tasks); 

            for($i=0;$i<sizeof($tasks);$i++){
                $task = explode('|||', $tasks[$i]);

                if($task[0] == $request->input('id')){
                    $tasks[$i] = implode('|||',[$task[0], $request->input('value')]);
                }
            }

            $list->tasks = implode('/|/', $tasks);
            
        }
        $list->Update();
        return Response::json(array('success' => true,'last_inserted_id' => $list, 'hr' => $list->tasks), 200);
    }
    public function listDelete($id)
    {
        $list = App\Info::FindOrFail($id);
        $list->delete();

    }
    public function taskDelete(Request $request,$id)
    {
        $list = App\Info::FindOrFail($id);

        $tasks = explode('/|/', $list->tasks); 

            for($i=0;$i<sizeof($tasks);$i++){
                $task = explode('|||', $tasks[$i]);

                if($task[0] == $request->input('id')){
                    unset($tasks[$i]);
                }
            }
        $list->tasks = implode('/|/', $tasks);
        $list->save();
        return Response::json(array('success' => true,'last_inserted_id' => $list, 'hr' => $request->input()), 200);
    }
}
