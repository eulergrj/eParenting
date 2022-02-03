<?php

namespace App\Http\Controllers;

use App\Models\ViewHistory;
use Illuminate\Http\Request;

class ViewHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $viewHistory = ViewHistory::where("user_id", $user->id)->get();
        $data = array(
            'viewHistory' => $viewHistory,            
        );
        return view('backend.history.index')->with($data);
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
     * @param  \App\Models\ViewHistory  $viewHistory
     * @return \Illuminate\Http\Response
     */
    public function show(ViewHistory $viewHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ViewHistory  $viewHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(ViewHistory $viewHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ViewHistory  $viewHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ViewHistory $viewHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ViewHistory  $viewHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ViewHistory $viewHistory)
    {
        //
    }
}
