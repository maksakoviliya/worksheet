<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserCollection
     */
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'string|nullable|max:100',
        ]);

        if (!$request->search) {
            return new UserCollection(User::with('roles:name,title')->select(['id', 'name', 'email'])->paginate(10));
        }
        return new UserCollection(User::with('roles:name')->select(['id', 'name', 'email'])->where('id', $request->search)
                                    ->orWhere('name', 'LIKE', "%$request->search%")
                                    ->orWhere('email', 'LIKE', "%$request->search%")->paginate(10));
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
