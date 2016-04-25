<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Note;

class NoteController extends Controller
{
	public function index($showCreate = false, $selectedNote = null){
		$notes = Note::where('user_id', \Auth::user()->id)->orderBy('updated_at', 'desc')->get();
		if(!$showCreate && !$selectedNote){
			$selectedNote = $notes->first();
		}
		return view('home')->with(compact('notes', 'showCreate', 'selectedNote'));
	}

	public function show($id){
		return $this->index(false, Note::find($id));
	}

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

    public function create(){
    	return $this->index(true);
    }
}
