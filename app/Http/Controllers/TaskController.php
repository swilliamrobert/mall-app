<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Task;

class TaskController extends Controller
{
	/**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
      $tasks = Task::all();
      return \View::make('welcome')->with('tasks',$tasks);
    }
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	*/
    public function store(Request $request){
    	 $task = Task::create($request->all());
    	 return \Response::json($task);
    }
    /**
    * Display the specified resource.
    *
    * @param  int $id
    * @return Response
    */
    public function show($task_id)
    {
       $task = Task::find($task_id);
       return \Response::json($task);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$task_id)
	{
	 
		$task = Task::find($task_id);
		$task->task = $request->task;
	    $task->description = $request->description;
	    $task->save();
	    return \Response::json($task);
	}
	/**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($task_id)
    {
       $task = Task::destroy($task_id);
       return \Response::json($task);
    }
}
