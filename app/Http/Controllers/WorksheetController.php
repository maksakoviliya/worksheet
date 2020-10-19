<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorksheetCollection;
use App\Worksheet;
use Illuminate\Http\Request;

class WorksheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return WorksheetCollection
     */
    public function index()
    {
//        $request->validate([
//            'search' => 'string|nullable|max:100',
//        ]);
//        if (Auth::user()->can('manage heads')) {
//            if (!$request->search) {
//                return new UserCollection(User::paginate(10));
//            }
//            return new UserCollection(User::where('id', $request->search)
//                ->orWhere('name', 'LIKE', "%$request->search%")
//                ->orWhere('email', 'LIKE', "%$request->search%")->paginate(10));
//
        return new WorksheetCollection(Worksheet::paginate(10));
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
        Worksheet::create($request->all());

        return response()->json(['success']);
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
