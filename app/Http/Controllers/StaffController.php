<?php

namespace App\Http\Controllers;

use Auth;
use Crypt;
use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;

class StaffController extends Controller
{

    /*
     * Lists users filtered by role and optional query
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request, User $user)
    {
        $user_type = Auth::user()->user_type;
        $organization_id = Auth::user()->organization_id;
        $users = User::all();
        switch (true) {
            case $user_type == 1:
                $data['users'] = User::all();
                $data['organizations'] = Organization::orderBy('name')->get();
                $data['roles'] = Role::all();
                break;
            case $user_type == 2:
                $data['users'] = User::where('organization_id', $organization_id)->get();
                $data['organizations'] = Organization::where('id', $organization_id)->get();
                $data['roles'] = Role::where('name', '!=', 'admin')->get();
                break;
            case $user_type == 3:
                $data['users'] = [];
                break;
        }
            
        return view('staff.index', $data);
    }

    public function deleteUser(Request $request, User $user)
    {
        $user_type = Auth::user()->user_type;
        $userId = $user->id;
        $userOrgId = $user->organization_id;

        if($user_type == 3) {
            return back()->withErrors(["This user doesn't have that privilege."]);
        }
        return $userOrgId;
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
             'user_type' => 'required'
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
                'user_type' => $request->get('user_type'),
            ]);

            
        $organization = Organization::findOrFail($request->get('organization'));
        $organization->users()->save($user);

        $user->save();
        $user->assignRole($request->get('user_type'));
        $this->sendConfirmationEmail($user);

        // } catch (\Exception $e) {
        //     return back()->withErrors(['Something went wrong creating the user. Please try again.']);
        // }
        Session::flash('flash_message', 'User "' . $user->email . '" added to staff!');
        return redirect('/staff');
    }

    public function postPassword(Request $request, User $user)
    {
        try {
            $this->validate($request, [
                'email' => 'required|min:6',
                'password' => 'required|same:password',
                'password_confirmation' => 'required',
            ]);
            $user->password = bcrypt($request->input('password'));
            $user->confirmed_on = Carbon::now();
            $user->save();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/login')->withErrors(['email' => 'The confirmation email link appears to be invalid.']);
        }

        Session::flash('flash_message', 'Password successfully saved!');
        return redirect('/login');
    }

    public function confirmationEmail($token)
    {
        try {
            $data['user'] = User::where('email', Crypt::decrypt($token))->firstOrFail();
            return view('auth.passwords.password', $data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/login')->withErrors(['email' => 'The confirmation email link appears to be invalid.']);
        }
        return redirect('/login');
    }

    public function sendConfirmationEmail($userInfo)
    {
        $encrypt_token = Crypt::encrypt($userInfo->email);
        $url = route('email-confirmation', ['token' => $encrypt_token]);
        Mail::send([], [], function ($message) use ($userInfo, $url) {
            $message->from('noreply@myapp.com', 'MyApp');
            $message->to($userInfo['email'])->subject('Confirmation Email');
            $message->setbody($url);
        });
    }
}
