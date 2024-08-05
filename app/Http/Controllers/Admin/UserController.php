<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()->paginate(5);

        return view('admins.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::transaction(function () use ($request){
                $user = $request->users;

                User::create($user);
            }, 3);
            return redirect()
                ->route('users.index')
                ->with('success', 'Thao tác thành công');
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admins.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admins.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::transaction(function () use ($request, $user){

                $data = $request->input('users');

                if (!empty($data['password'])) {
                    
                    $data['password'] = bcrypt($data['password']);
                } else {
                    unset($data['password']);
                }

                $user->update($data);

            }, 3);
            return back()->with('success', 'Thao tác thành công');

        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // dd($user);
        try {
            DB::transaction(
                function () use ($user) {
                    $user->delete();
                },
                3

            );
            return back();
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
