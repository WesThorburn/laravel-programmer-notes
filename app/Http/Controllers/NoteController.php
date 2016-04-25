<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Note;

class NoteController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth');
	}

	public function index(){
		return $this->show();
	}

	public function show($id = null){
		$notes = Note::where('user_id', \Auth::user()->id)->orderBy('updated_at', 'desc')->get();
		if($id){
			$selectedNote = Note::find($id);
		}
		else{
			$selectedNote = $notes->first();
		}
		return view('home')->with(compact('notes', 'selectedNote'));
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
    	$notes = Note::where('user_id', \Auth::user()->id)->orderBy('updated_at', 'desc')->get();
    	$showCreate = true;
    	return view('home')->with(compact('notes', 'showCreate'));
    }
}
