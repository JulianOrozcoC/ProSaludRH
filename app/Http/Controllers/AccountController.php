<?php

namespace App\Http\Controllers;

use Auth;
use Crypt;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['user'] = Auth::user();
        return view('account', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postIndex(Request $request)
    {
        $user = \Auth::user();
        $action = '';
        $userPassword = $user->password;
        $this->validate($request, [
            'name' => 'max:255|required',
        ]);

        if ($user->email != $request->get('email')) {
            $this->validate($request, [
                'email' => 'email|max:255|unique:users|filled',
            ]);
        }

        if($request->get('old_password') && $request->get('new_password') && $request->get('new_password_confirmation')) {
            $this->validate($request, [
                'old_password' => 'min:6|required',
                'new_password' => 'min:6|required|confirmed',
                'new_password_confirmation' => 'min:6|required',
            ]);
            // check if the old password matches with the one in the database
            if(!Hash::check($request->get('old_password'), $user->password)){
                Session::flash('flash_message', 'The old password doesn\'t match!');
                return back();
            }
            // check if the password old and new are the same
            if(Hash::check($request->get('new_password'), $user->password)) {
                Session::flash('flash_message', 'The old password is the same as the new one, this should be different!');
                return back();
            }

            $action = 'change';
        }

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if($action == 'change'){
            $user->password = bcrypt($request->get('new_password'));
        }
        try {
            $user->save();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('account-settings')->withErrors();
        }
        Session::flash('flash_message', 'The account has been modified successfully!');
        return redirect()->route('account-settings');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
