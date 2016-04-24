<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Note;

class NoteController extends Controller
{
    public function store(Request $request){
    	$this->validate($request, [
    		'problem' => 'required|string',
    		'solution' => 'required|string'
    	]);

    	$note = new Note;
	    $note->user_id = \Auth::user()->id;
	    $note->problem = $request->problem;
	    $note->solution = $request->solution;
	    $note->save();

	    \Session::flash('noteSaveSuccess', 'Your Note was created successfully!');
        return redirect('/');
    }
}
