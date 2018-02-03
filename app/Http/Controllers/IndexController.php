<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\todo;

class IndexController extends Controller
{	
	
	// Main ToDo List View
    public function index(){
		
		$todos = todo::select(['id','title','description','state'])->orderBy('state', 'ASC')->orderBy('id', 'DESC')->get();
		
		return view('todoMain')->with([
			'todos'=>$todos
		]);
		
	}
	
	// Store & Validation ( Real Time ) ToDo with AJAX 
	public function storePost(Request $request){
		
		// VALIDATION
		$validator = Validator::make($request->all(), [
			'title' => 'required|max:100',
			'description' => 'required|max:500'
		]); 
		
		if ($validator->fails()) {
			
			return response()->json(['error'=>$validator->errors()->all()]);
			
        }
		else{
			
			// Store in DB
			$data = $request->all();
			$todos = new todo;
			$todos->fill($data);
			$todos->save();
			
			return response()->json(['success'=>'ToDo stored!']);
			
		}	

	}
	
	// Perform the TODO with AJAX 
	public function statePost(Request $request){

		$data = $request->all();
		$todos = Todo::findorfail($request->id);
		$updateNow = $todos->update($data);
		
		return response()->json(['success'=>'ToDo state updated!']);
		
	}
	
	// Edit TODO with AJAX 
	public function editPost(Request $request){

		$data = $request->all();
		$todos = Todo::findorfail($request->id);
		$updateNow = $todos->update($data);
		
		return response()->json(['success'=>'ToDo updated!']);
		
	}
	
}
