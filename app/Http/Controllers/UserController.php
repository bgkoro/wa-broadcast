<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\Credit;
use App\Models\CreditsHistory;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('has-permission', 'manage_users');

        $perPage = request()->has('perPage') && request('perPage') <= 100 ? request('perPage') : '10';

        $data = [
            'title' => 'User List',
            'users' => User::with('role')->latest()->filter(request(['search']))->paginate($perPage)->withQueryString(),
        ];

        return view('pages.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('has-permission', 'manage_users');

        $data = [
            'title' => 'Create User',
            'roles' => Role::latest()->get(),
        ];

        return view('pages.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated) {

            $user = User::create($validated);

            $credit = Credit::create([
                'user_id' => $user->id,
                'balance' => 0,
            ]);

            CreditsHistory::create([
                'credit_id' => $credit->id,
                'description' => 'initial balance',
                'initial_balance' => $credit->balance,
                'credit' => $credit->balance,
                'ending_balance' => $credit->balance,
            ]);
        });


        return redirect()->route('user.index')->with('success', 'User has been created success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('has-permission', 'manage_users');

        $data = [
            'title' => 'Edit User',
            'roles' => Role::latest()->get(),
            'user' => $user,
        ];

        return view('pages.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $validated = $request->validated();
        User::where('id', $user->id)->update($validated);

        return redirect()->route('user.index')->with('success', 'User with username ' . $validated['username'] . ' has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('has-permission', 'manage_users');

        User::destroy($user->id);

        return redirect()->route('user.index')->with('success', $user->name . ' has been deleted success');
    }
}
