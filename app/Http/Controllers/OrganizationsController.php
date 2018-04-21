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

    public function showOrganizationInfo($id)
    {
        $data['organization'] = Organization::find($id);
        return view('organizations.show', $data);
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
     * Store the organization.
     *
     * @param  Request  $request
     * @return Response
     */
    public function postEditOrganizationInfo(Request $request, Organization $organization)
    {
        $this->validate($request, [
            'name' => 'required|unique:organizations',
        ]);
        try {
            $organization->name = $request->get('name');
            $organization->save();
        } catch (\Exception $e) {
            app()->make("lern")->record($e);
            return back()->withErrors(['Something went wrong modifying the organization. Please try again.']);
        }
        Session::flash('flash_message', 'Organization successfully modified!');
        return back();
    }
    
    /**
     * Delete the asset variant.
     *
     * @param  Request  $request
     * @param  Organization  $organization
     * @return Response
     */
    public function postDeleteOrganization(Request $request, Organization $organization)
    {
        return $organization;
    }
}
