<?php

namespace App\Http\Controllers;

use Session;
use Crypt;
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
             'password' => 'required|confirmed',
             'password_confirmation' => 'required',
        ]);
            $user->password = $request->input('password');
            $user->confirmed_on = Carbon::now();
            $user->save();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/login')->withErrors(['email' => 'The confirmation email link appears to be invalid.']);
        }
        return redirect('/');
    }

    public function confirmationEmail($token)
    {
        try {
            $user = User::where('email', Crypt::decrypt($token))->firstOrFail();
            return view('auth.passwords.password', $user);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/login')->withErrors(['email' => 'The confirmation email link appears to be invalid.']);
        }
        return redirect('/');
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
