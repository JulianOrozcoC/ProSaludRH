<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Test;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreditsController extends Controller
{
    public function getIndex() {
        $data['organizations'] = Organization::with('tests')->get();
        $data['tests'] = Test::all();
        return view('credits.index', $data);
    }

    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'organization' => 'required|exists:organizations,id',
            'quantity' => 'required|integer',
            'test' => 'required|exists:tests,id',
        ]);

        if ($request->input('quantity') == 0) {
            return back()->withErrors([@lang('errors.quantity_cero')]);
        }


        try {
            $organization = Organization::findOrFail($request->input('organization'));
            $organization->tests()->attach($request->input('test'), ['amount' => $request->input('quantity')]);

        } catch (\Exception $e) {
            return back()->withErrors(['Something went wrong creating the credit. Please try again.']);
        }

        return redirect('/credits');
    }

}
