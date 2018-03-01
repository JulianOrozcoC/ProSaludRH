<?php

namespace App\Http\Controllers;

use Session;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Organization;

class OrganizationsController extends Controller
{
     
    /**
     * Show the organizations index.
     *
     * @return Response
     */
    public function getIndex()
    {
        $data['organizations'] = Organization::with('users')->orderBy('name')->get();
        return view('organizations.index', $data);
    }

    /**
     * Store the organization.
     *
     * @param  Request  $request
     * @return Response
     */
    public function postIndex(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:organizations',
        ]);
        
        try {
            $organization = new Organization([
                'name' => $request->get('name'),
            ]);

            $organization->save();
        } catch (\Exception $e) {
            app()->make("lern")->record($e);
            return back()->withErrors(['Something went wrong creating organization. Please try again.']);
        }

        Session::flash('flash_message', 'Organization "' . $organization->name . '" successfully created!');
        
        return redirect('/organizations');
    }
    
    /**
     * Store the user assignation to an organization.
     *
     * @param  Request  $request
     * @return Response
     */
    public function postAssignUser(Request $request)
    {
        $this->authorize('assign', Organization::class);
        
        $this->validate($request, [
            'user' => 'required|exists:users,id',
            'organization' => 'required|exists:organizations,id',
        ]);
        
        try {
            $user = User::findOrFail($request->get('user'));
            $organization = Organization::findOrFail($request->get('organization'));
            $organization->users()->save($user);
        } catch (\Exception $e) {
            app()->make("lern")->record($e);
            return back()->withErrors(['Something went wrong assigning the user to the organization. Please try again.']);
        }

        Session::flash('flash_message', 'User "' . $user->name . '" successfully assigned to the organization ' . $organization->name . '!');
        
        return redirect('/organizations');
    }
    
    /**
     * Delete the asset variant.
     *
     * @param  Request  $request
     * @param  Organization  $organization
     * @return Response
     */
    public function postDelete(Request $request, Organization $organization)
    {
        $this->authorize('delete', $organization);
        
        $organizationName = $organization->name;
        try {
            $organization->delete();
        } catch (\Exception $e) {
            app()->make("lern")->record($e);
            return back()->withErrors(['Something went wrong deleting the organization. Please try again.']);
        }

        Session::flash('flash_message', 'Organization "' . $organizationName . '" successfully removed!');

        return redirect('/organizations');
    }
}
