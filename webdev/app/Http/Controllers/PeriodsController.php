<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Period;
use App\Match;

class PeriodsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index($id) {
        // Find match
        if (!$match = Match::find($id)) {
            return abort(404);
        }

        // Find maych periods.
        $periods = Period::where('match_id', $match->id)->get();

        // Get latest period
        $latestPeriod = Period::orderBy('end', 'DESC')->first();

        // Let's view periods list.
        return view("periods.index", compact('periods', 'match', 'latestPeriod'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id) {
        // Find match
        if (!$match = Match::find($id)) {
            return abort(404);
        }


        if ($match->periods->count() < 4) {
            // validation
            $this->validate($request, [
                'title' => 'required',
                'start' => 'required|date|after_or_equal:' . \Carbon\Carbon::today(),
                'end' => 'required|date|after_or_equal:start',
            ]);

            // Check if this period not added to this match before.
            if ($res = Period::whereBetween('start', [$request->start, $request->end])->orWhereBetween('end', [$request->start, $request->end])->count()) {
                return back()->withInput()->withErrors(['This period added  before !']);
            }

            // Get the latest period for this match
            if ($latestPeriod = Period::orderBy('end', 'DESC')->first()) {

                if ($latestPeriod->end >= $request->get('start') || $latestPeriod->end >= $request->get('end')) {
                    return back()->withInput()->withErrors(['This period start/end is exist !']);
                }
            }


            // $now = Carbon::now();
            // if($request->start < $now){
            //     $active = 1;
            // }else{
            //     $active = 0;
            // }
            // Add new period
            if ($match->periods()->create(['title' => $request->get('title'), 'start' => $request->start, 'end' => $request->get('end')])) {
                session()->flash('success', 'Period added successfuly !!');
            } else {
                session()->flash('error', 'Period not added successfully !!');
            }
        } else {
            session()->flash('error', 'You can not add more that 4 period per match !!');
        }


        // Redirect to periods list
        return redirect()->route('periods.index', $id);
    }

    public function edit($id) {
        $period = Period::find($id);

        return view('periods.edit')->withPeriod($period);
    }

    public function update(Request $request, $id) {
        // validation
        $this->validate($request, [
            'title' => 'required',
            'start' => 'required|date|after_or_equal:' . \Carbon\Carbon::today(),
            'end' => 'required|date|after_or_equal:start_at',
        ]);

        if ($period = Period::find($id)) {
            $period->update([
                'title' => $request->get('title'),
                'start' => $request->get('start'),
                'end' => $request->get('end'),
            ]);

            session()->flash('success', 'Period edited successfuly !!');
        } else {
            session()->flash('error', 'Period not found !!');
        }


        // Redirect to periods index page.
        return redirect()->back();
    }

    public function delete($id) {
        if ($period = Period::withTrashed()->where('id', $id)->first()) {
            if ($period != null && $period->deleted_at == null) {
                $period->delete();
                return "ok";
            } else {
                return "no";
            }
        } else {
            session()->flash('error', 'Period not found !!');
        }

        // Redirect to matches index page.
        return redirect()->route('periods.index', $id);
    }

}
