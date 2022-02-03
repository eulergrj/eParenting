<?php

namespace App\Http\Controllers;

use App\Models\FamilyMember;
use Illuminate\Http\Request;

class FamilyMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $fmembers = FamilyMember::where("user_id", $user->id)->get();
        $data = array(
            'fmembers' => $fmembers,            
        );
        return view('backend.fmembers.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\familyMember  $familyMember
     * @return \Illuminate\Http\Response
     */
    public function show(familyMember $familyMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\familyMember  $familyMember
     * @return \Illuminate\Http\Response
     */
    public function edit(familyMember $familyMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\familyMember  $familyMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, familyMember $familyMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\familyMember  $familyMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(familyMember $familyMember)
    {
        //
    }
}
