<?php

namespace App\Http\Controllers;

use Session;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class StaffController extends Controller
{

    /*
     * Lists users filtered by role and optional query
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        $data['users'] = User::all();
        $data['organizations'] = Organization::orderBy('name')->get();
            
        return view('staff.index', $data);
    }

    /**
      * Store the user.
      *
      * @param  Request  $request
      * @return Response
      */
    public function postIndex(Request $request)
    {
        $this->validate($request, [
             'email' => 'required',
             'organization' => 'required|exists:organizations,id',
        ]);
         
        // try {
        // $user = User::onlyTrashed()->where('email', $request->get('email'))->first();
        // if ($user) {
        //     $user->email =  $user->id;
        //     $user->username = $user->id;
        //     $user->save();
        // }
        $user = User::where('email', $request->get('email'))->first();
        if ($user) {
            return back()->withErrors(['Email already in use.']);
        }

        $user = new User([
                'email' => $request->get('email'),
            ]);

            
        $organization = Organization::findOrFail($request->get('organization'));
        $organization->users()->save($user);
        $user->save();
        // } catch (\Exception $e) {
        //     return back()->withErrors(['Something went wrong creating the user. Please try again.']);
        // }
 
        Session::flash('flash_message', 'User "' . $user->email . '" added to staff!');
         
        return redirect('/staff');
    }
}
