<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorksheetCollection;
use App\Worksheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class WorksheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return WorksheetCollection
     */
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'string|nullable|max:100',
        ]);


        if (Auth::user()->hasRole('admin')) {
            if (!$request->search) {
                return new WorksheetCollection(Worksheet::paginate(10));
            }

            return new WorksheetCollection(Worksheet::where(function ($query) use ($request) {
                $query->where('id', $request->search)
                    ->orWhere('envyID', 'LIKE', "%$request->search%")
                    ->orWhere('name', 'LIKE', "%$request->search%")
                    ->orWhere('email', 'LIKE', "%$request->search%");
            })->paginate(10));
        } elseif (Auth::user()->hasRole('head')) {
            if (!$request->search) {
                return new WorksheetCollection(Worksheet::where('filial_id', Auth::user()->filial_id)->paginate(10));
            }

            return new WorksheetCollection(Worksheet::where('filial_id', Auth::user()->filial_id)->where(function ($query) use ($request) {
                $query->where('id', $request->search)
                    ->orWhere('envyID', 'LIKE', "%$request->search%")
                    ->orWhere('name', 'LIKE', "%$request->search%")
                    ->orWhere('email', 'LIKE', "%$request->search%");
            })->paginate(10));
        } elseif (Auth::user()->hasRole('user')) {
            if (!$request->search) {
                return new WorksheetCollection(Worksheet::where('user_id', Auth::user()->id)->where('filial_id', Auth::user()->filial_id)->paginate(10));
            }

            return new WorksheetCollection(Worksheet::where('user_id', Auth::user()->user_id)->where('filial_id', Auth::user()->filial_id)->where(function ($query) use ($request) {
                $query->where('id', $request->search)
                    ->orWhere('envyID', 'LIKE', "%$request->search%")
                    ->orWhere('name', 'LIKE', "%$request->search%")
                    ->orWhere('email', 'LIKE', "%$request->search%");
            })->paginate(10));
        }


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
        // TODO: Добавить валидацию
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Worksheet $worksheet)
    {
        // TODO: Добавить валидацию
        $worksheet->update($request->all());
        return response()->json(['success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\worksheet $worksheet
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(worksheet $worksheet)
    {
        $worksheet->delete();

        return response()->json(['success']);
    }
}
