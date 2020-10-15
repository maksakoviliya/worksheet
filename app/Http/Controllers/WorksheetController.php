<?php

namespace App\Http\Controllers;

use App\worksheet;
use Illuminate\Http\Request;

class WorksheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('worksheets');
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
     * @param  \App\worksheet  $worksheet
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('worksheet');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\worksheet  $worksheet
     * @return \Illuminate\Http\Response
     */
    public function edit(worksheet $worksheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\worksheet  $worksheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, worksheet $worksheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\worksheet  $worksheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(worksheet $worksheet)
    {
        //
    }
}
