<?php

namespace App\Http\Controllers;

use App\Filial;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Http\Resources\ManagerCollection;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Role;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        if (Auth::user()->can('manage heads')) {
            if (!$request->search) {
                return new UserCollection(User::paginate(10));
            }
            return new UserCollection(User::where('id', $request->search)
                ->orWhere('name', 'LIKE', "%$request->search%")
                ->orWhere('email', 'LIKE', "%$request->search%")->paginate(10));
        } elseif (Auth::user()->can('manage users')) {
            if (!$request->search) {
                return new UserCollection(User::where('filial_id', Auth::user()->filial_id)->whereHas('roles', function ($query) {
                    return $query->where('name', 'user');
                })->paginate(10));
            }
            return new UserCollection(User::where('filial_id', Auth::user()->filial_id)->whereHas('roles', function ($query) {
                return $query->where('name', 'user');
            })
                ->where(function ($query) use ($request) {
                    $query->where('id', $request->search)
                        ->orWhere('name', 'LIKE', "%$request->search%")
                        ->orWhere('email', 'LIKE', "%$request->search%");
                })->paginate(10));
        } else {
            return redirect()->route('login');
        }
    }

    public function managers()
    {
        if (Auth::user()->can('manage heads')) {
            return new ManagerCollection(User::all());
        } elseif (Auth::user()->can('manage users')) {
            return new ManagerCollection(User::where('filial_id', Auth::user()->filial_id)->whereHas('roles', function ($query) {
                return $query->where('name', 'user');
            })->get());
        } else {
            return new ManagerCollection(User::where('id', Auth::user()->id)->get());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $newUser = Arr::get($request->validated(), 'user');

        try {
            if (Auth::user()->can('manage heads')) {
                $user = User::create([
                    'name' => $newUser['name'],
                    'email' => $newUser['email'],
                    'password' => Hash::make($newUser['password']),
                    'filial_id' => $newUser['filial']
                ]);

                $user->assignRole($newUser['role']);
            } elseif (Auth::user()->can('manage users')) {
                $user = User::create([
                    'name' => $newUser['name'],
                    'email' => $newUser['email'],
                    'password' => Hash::make($newUser['password']),
                    'filial_id' => Auth::user()->filial_id
                ]);

                $user->assignRole('user');
            }
        } catch (\Exception $exception) {
            throw new \Exception('Что-то пошло не так');
        }

        return response()->json(['success']);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(\App\User $user)
    {
        $userData = new UserResource($user);
        $roles = Role::all();
        $filials = Filial::all();

        return response()->json(compact(['userData', 'roles', 'filials']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, \App\User $user)
    {
        $userData = Arr::get($request->validated(), 'user');
        try {
            $user->name = $userData['name'];
            $user->email = $userData['email'];
            if (Arr::has($userData, 'password')) {
                $user->password = Hash::make($userData['password']);
            }
            $user->filial_id = $userData['filial'];
            $user->syncRoles($userData['role']);

            $user->save();
        } catch (\Exception $exception) {
            throw new \Exception('Что-то пошло не так');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['success']);
    }

    public function getUsersData()
    {
        $roles = Role::all();
        $filials = Filial::all();
        return response()->json(compact(['roles', 'filials']));
    }
}
