<?php

namespace App\Http\Controllers\Emiweb;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *x
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $organizations = Organization::all();
        return view('organizations.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationRequest $organizationRequest, Organization $organization)
    {
        //
         $organization->create($organizationRequest->all());
         return redirect('/organizations')->with('success', 'Organization has been added');

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
    public function edit(Organization $organization)
    {
        //
        return view('organizations.edit', compact('organization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizationRequest $organizationRequest, Organization $organization)
    {
        //
        $organization->update($organizationRequest->all());
        return redirect('/organizations')->with('success', 'Organization details has been updated');
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
