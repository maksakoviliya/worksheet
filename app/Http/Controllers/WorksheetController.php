<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorksheetCollection;
use App\Mail\EmailEditedWorksheet;
use App\Worksheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
                return new WorksheetCollection(Worksheet::orderBy('id', 'desc')->paginate(10));
            }

            return new WorksheetCollection(Worksheet::where(function ($query) use ($request) {
                $query->where('id', $request->search)
                    ->orWhere('envyID', 'LIKE', "%$request->search%")
                    ->orWhere('name', 'LIKE', "%$request->search%")
                    ->orWhere('email', 'LIKE', "%$request->search%");
            })->orderBy('id', 'desc')->paginate(10));
        } elseif (Auth::user()->hasRole('head')) {
            if (!$request->search) {
                return new WorksheetCollection(Worksheet::where('filial_id', Auth::user()->filial_id)->orderBy('id', 'desc')->paginate(10));
            }

            return new WorksheetCollection(Worksheet::where('filial_id', Auth::user()->filial_id)->where(function ($query) use ($request) {
                $query->where('id', $request->search)
                    ->orWhere('envyID', 'LIKE', "%$request->search%")
                    ->orWhere('name', 'LIKE', "%$request->search%")
                    ->orWhere('email', 'LIKE', "%$request->search%");
            })->orderBy('id', 'desc')->paginate(10));
        } elseif (Auth::user()->hasRole('user')) {
            if (!$request->search) {
                return new WorksheetCollection(Worksheet::where('user_id', Auth::user()->id)->where('filial_id', Auth::user()->filial_id)->orderBy('id', 'desc')->paginate(10));
            }

            return new WorksheetCollection(Worksheet::where('user_id', Auth::user()->user_id)->where('filial_id', Auth::user()->filial_id)->where(function ($query) use ($request) {
                $query->where('id', $request->search)
                    ->orWhere('envyID', 'LIKE', "%$request->search%")
                    ->orWhere('name', 'LIKE', "%$request->search%")
                    ->orWhere('email', 'LIKE', "%$request->search%");
            })->orderBy('id', 'desc')->paginate(10));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // TODO: Добавить валидацию

        $request->merge([
            'user_id' => Auth::user()->id
        ]);

        Log::info($request->all(), ['create worksheet']);

        $worksheet = Worksheet::create($request->all());

//        event(new WorksheetCreated($worksheet));

        return response()->json(['success']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\worksheet $worksheet
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('worksheet');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\worksheet $worksheet
     * @return \Illuminate\Http\Response
     */
    public function edit(worksheet $worksheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\worksheet $worksheet
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Worksheet $worksheet)
    {
        // TODO: Добавить валидацию
        $worksheet->update($request->except('user_id'));

//        event(new WorksheetEdited($worksheet));

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

    public function sendEmail(Request $request)
    {
        $worksheet = Worksheet::find($request->id);
        $email = new EmailEditedWorksheet($worksheet);
        try {
            Mail::to(config('mail.to.address'))->send($email);
            return response()->json(['success']);
        } catch (\Exception $exception) {
            Log::info($exception);
            return response()->json(['error'], 500);
        }
    }
}
