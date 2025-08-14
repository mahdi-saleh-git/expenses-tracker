<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $request->session()->put('user_id', $user->id);
        $request->session()->regenerate();

        return redirect()->route('user.expenses.index', ['user' => $user]); // main page
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
        $user = User::findOrFail(session('user_id'));

        return view('user.details', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $userid)
    {
        $user = User::findOrFail($userid);

        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $register)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:6', // make password optional
        ]);
    
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $register->update($data);

        return redirect()->route('register.show', ['register' => $register->id])
                ->with('success', 'Profile Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
