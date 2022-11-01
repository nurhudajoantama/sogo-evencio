<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)->latest()->get();
        return view('dashboard.user.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('dashboard.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validation = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|alpha_dash|unique:users,username,' . $user->id,
        ];
        if ($request->password) {
            $validation['password'] = 'required|min:6';
            $validation['confirm_password'] = 'required|same:password';
        }
        $request->validate($validation);
        if ($request->password) {
            $request->merge(['password' => bcrypt($request->password)]);
        } else {
            $request->merge(['password' => $user->password]);
        }
        $user->update($request->all());

        return redirect()->route('dashboard.user.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard.user.index')->with('success', 'User deleted successfully');
    }
}
