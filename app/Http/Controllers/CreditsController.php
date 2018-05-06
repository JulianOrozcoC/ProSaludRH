<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Test;
use App\Models\User;
use App\Models\TestApplication;
use App\Models\Organization;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class CreditsController extends Controller
{
    public function getIndex()
    {
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
            $test = $organization->tests()->wherePivot('test_id', $request->input('test'))->first();
            if ($test) {
                $organization->tests()->updateExistingPivot($test->id, ['amount' => $request->input('quantity') + $test->pivot->amount]);
            } else {
                $organization->tests()->attach($request->input('test'), ['amount' => $request->input('quantity')]);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['Something went wrong creating the credit. Please try again.']);
        }

        return redirect('/credits');
    }

    public function creditsAssignation()
    {
        $data['tests'] = \Auth::user()->organization->tests()->wherePivot('amount', '>', 0)->get();
        $users = Role::where('name', 'user')->first()->users()->where('organization_id', \Auth::user()->organization->id)->get();
        foreach ($users as $user) {
            $data['users'][$user->email] = null;
        }
        $data['users'] = json_encode($data['users']);
        return view('credits.assignation', $data);
    }
    
    public function postCreditsAssignation(Request $request)
    {
        $test = \Auth::user()->organization->tests()->find($request->get('test'));
        if ($test->pivot->amount < 1) {
            return back()->withErrors(['Not enough credits']);
        }
        $user = User::where('email', $request->get('user'))->first();
        $testApplication = TestApplication::where('user_id', $user->id)->where('test_id', $test->id)->whereNull('completed_on')->first();
        if ($testApplication) {
            return back()->withErrors(['User has already an active test']);
        }
        TestApplication::create(['user_id' => $user->id, "test_id" => $test->id]);
        $test->organizations()->updateExistingPivot($user->organization->id, ['amount' => $test->pivot->amount - 1]);
        Session::flash('flash_message', 'Credit assigned succesfully!');

        return back();
    }
}
