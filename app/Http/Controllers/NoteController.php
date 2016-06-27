<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\Note;
use App\Http\Requests;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class NoteController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth', ['except' => ['index', 'show', 'notesDataTable']]);
	}

	public function index(){
		if(Auth::user()){
            return $this->show(Note::wherePublic()->first());
        }
        else{
            return view('home');
        }
	}

	public function show(Note $note){
        return view('note')->with([
            'note' => $note,
            'readOnly' => !$note->belongsToCurrentUser()
        ]);
	}

    public function store(Request $request){
    	$this->validate($request, [
    		'problem' => 'required|string',
    		'solution' => 'required|string'
    	]);

    	$note = new Note;
	    $note->user_id = Auth::user()->id;
	    $note->problem = $request->problem;
	    $note->solution = $request->solution;
	    $note->save();

	    Session::flash('noteSaveSuccess', 'Your Note was created successfully!');
        return redirect('/');
    }

    public function create(){
    	return view('note')->with([
            'showCreate' => true,
            'note' => new Note
        ]);
    }

    public function update(Note $note, Request $request){
    	if(!$note->belongsToCurrentUser()){
    		Session::flash('noteSaveError', 'There was a problem with your request!');
        	return redirect()->back();
    	}

    	$this->validate($request, [
    		'problem' => 'required|string',
    		'solution' => 'required|string',
            'privateNote' => 'in:true,false'
    	]);

    	$note->problem = $request->problem;
    	$note->solution = $request->solution;
        $note->private = $note->resolvePrivateValue($request->privateNote);
    	$note->save();
    }

    public function notesDataTable($noteId){
        if($noteId == 0){
            $note = Note::first();
        }
        else{
            $note = Note::find($noteId);
        }

        $notesList = Note::select('id','problem', 'updated_at')
            ->where('user_id', $note->user_id)
            ->orderBy('updated_at', 'desc')
            ->get();
    	
    	return Datatables::of($notesList)
        //Set active row class
    	->setRowClass(function ($notesList) use($note){
    		if($notesList->id == $note->id){
    			return "active-row";
    		}
    	})
        //Reduce problem line length
        ->editColumn('problem', function($note){
            return '<div class="notes-text-limit">'.$note->problem.'</div>';
        })
    	->make(true);
    }
}
