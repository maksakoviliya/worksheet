<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Http\Resources\BankCollection;
use App\Http\Resources\WorksheetCollection;
use App\Imports\BanksImport;
use App\Worksheet;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return BankCollection
     */
    public function index(Request $request)
    {
        if (!$request->search || $request->search == 'undefined') {
            return new BankCollection(Bank::paginate($request->all ? 30 : 10));
        }

        return new BankCollection(Bank::where(function ($query) use ($request) {
            $query->where('id', $request->search)
                ->orWhere('name', 'LIKE', "%$request->search%");
        })->paginate($request->all ? 30 : 10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bank  $bank
     * @return Response
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bank  $bank
     * @return Response
     */
    public function edit(Bank $bank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bank  $bank
     * @return Response
     */
    public function update(Request $request, Bank $bank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bank  $bank
     * @return Response
     */
    public function destroy(Bank $bank)
    {
        $bank->delete();

        return response()->json(['success']);
    }

    public function upload(Request $request) {
        $request->validate([
           'file' => 'required|file'
        ]);

        Bank::query()->delete();
        try {
            Excel::import(new BanksImport, request()->file('file'));
        } catch (\Exception $exception) {
            
        }

        return response()->json('success');
    }
}
