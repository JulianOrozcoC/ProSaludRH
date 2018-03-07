<?php

namespace App\Http\Controllers;
use App\Models\Test;
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
        $data['tests'] = Test::all();
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
