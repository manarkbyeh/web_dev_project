<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use App\Period;
use Illuminate\Support\Facades\Auth;

class MatchesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $matches = Match::withTrashed()->get();
        $matche = Match::all();
        return view("home.index", ["matches" => $matches, "matche" => $matche]);
    }

    public function create() {
        
    }

    public function store(Request $request) {
        // validation
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required|max:255',
            'condition'=>'required|max:255',
        ]);

        // Let's create new match
        if (Match::create([
                    'title' => $request->get('title'),
                    'body' => $request->get('body'),
                    'condition' => $request->get('condition'),
                    'user_id' => Auth::user()->id,
                ])) {
            session()->flash('success', 'Match added successfuly !!');
        } else {
            session()->flash('error', 'Failed to add new match !!');
        }

        // Redirect to matches index page
        return redirect('/match');
    }

    public function show($id) {
        
    }

    public function edit($id) {
        $match = Match::find($id);

        return view('home.edit')->withMatch($match);
    }

    public function update(Request $request, $id) {
        // validation
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required|max:255',
            'condition'=>'required|max:255',
        ]);

        if ($match = Match::find($id)) {
            $match->update([
                'title' => $request->get('title'),
                'body' => $request->get('body'),
                'condition' => $request->get('condition'),
            ]);

            session()->flash('success', 'Match edited successfuly !!');
        } else {
            session()->flash('error', 'Match not found !!');
        }


        // Redirect to matches index page.
        return redirect('/match');
    }

    public function destroy($id) {
        if ($match = Match::withTrashed()->where('id', $id)->first()) {
            if ($match != null && $match->deleted_at == null) {
                $match->delete();
                return "ok";
            } else {
                return "no";
            }
        } else {
            session()->flash('error', 'Match not found !!');
        }

        // Redirect to matches index page.
        return redirect('/match');
    }

}
