<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Note;
use Yajra\Datatables\Datatables;

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
		if($id){
			$selectedNote = Note::find($id);
		}
		else{
			$selectedNote = Note::orderBy('updated_at', 'DESC')->first();
		}

        //Show view, based on auth status
        if(\Auth::user()){
            return view('home')->with(compact('selectedNote'));
        }
        return view('public')->with(compact('selectedNote'));
		
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
    	$showCreate = true;
    	return view('home')->with(compact('showCreate'));
    }

    public function update($id, Request $request){
    	//Check that requested note belongs to current user
    	if(Note::find($id)->user_id != \Auth::user()->id){
    		\Session::flash('noteSaveError', 'There was a problem with your request!');
        	return redirect()->back();
    	}

    	$this->validate($request, [
    		'problem' => 'required|string',
    		'solution' => 'required|string'
    	]);

    	$note = Note::find($id);
    	$note->problem = $request->problem;
    	$note->solution = $request->solution;
    	$note->save();
    }

    public function notesDataTable($selectedNote = null){
    	$notes = Note::select('id','problem', 'updated_at')->where('user_id', \Auth::user()->id)->orderBy('updated_at', 'desc')->get();
    	return Datatables::of($notes)
    	->setRowClass(function ($note) use($selectedNote){
    		if(isset($selectedNote) && $selectedNote == $note->id){
    			return "active-row";
    		}
    	})
        ->editColumn('problem', function($note){
                return '<div class="notes-text-limit">'.$note->problem.'</div>';
            })
    	->make(true);
    }

    public function noteSettings(Request $request){
        //Check that requested note belongs to current user
        if(Note::find($request->id)->user_id != \Auth::user()->id){
            \Session::flash('noteSaveError', 'There was a problem with your request!');
            return redirect()->back();
        }

        $this->validate($request, [
            'privateNote' => 'in:on,off',
        ]);

        if($request->privateNote == "on"){
            $privateStatus = 1;
        }
        else{
            $privateStatus = 0;
        }

        $note = Note::find($request->id);
        $note->private = $privateStatus;
        $note->save();

        \Session::flash('noteSaveSuccess', 'Your Note settings were saved successfully!');
        return redirect('/');
    }
}
