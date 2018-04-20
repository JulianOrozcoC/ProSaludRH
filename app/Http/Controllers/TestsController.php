<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\Test;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;

class TestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $user_type = Auth::user()->user_type;
        $organization_id = Auth::user()->organization_id;
        $users = User::all();
        switch (true) {
            case $user_type == 1:
                $data['organizations'] = Organization::orderBy('name')->get();
                $data['tests'] = Test::all();
                break;
            case $user_type == 2:
                $data['organizations'] = Organization::where('id', $organization_id)->get();
                $data['tests'] = Test::all();
                break;
            case $user_type == 1:
                $data['users'] = [];
                break;
        }

        return view('tests.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postEditName(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $test = Test::where('name', $request->get('name'))->first();
        if ($test) {
            return back()->withErrors(['Test name already in use.']);
        }

        $test = Test::find($id);
        $test->name = $request->input('name');
        $test->save();

        return redirect('/tests');
    }
}
