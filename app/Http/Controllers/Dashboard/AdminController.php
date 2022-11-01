<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('is_admin', true)->latest()->get();
        return view('dashboard.admin.index', compact('admins'));
    }

    public function create()
    {
        return view('dashboard.admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|alpha_dash|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        $request->merge([
            'password' => bcrypt($request->password),
            'is_admin' => true,
        ]);
        User::create($request->all());
        return redirect()->route('dashboard.admin.index')->with('success', 'Admin created successfully');
    }

    public function edit(User $admin)
    {
        return view('dashboard.admin.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        $validation = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'username' => 'required|alpha_dash|unique:users,username,' . $admin->id,
        ];
        if ($request->password) {
            $validation['password'] = 'required|min:6';
            $validation['confirm_password'] = 'required|same:password';
        }
        $request->validate($validation);
        if ($request->password) {
            $request->merge(['password' => bcrypt($request->password)]);
        } else {
            $request->merge(['password' => $admin->password]);
        }
        $admin->update($request->all());

        return redirect()->route('dashboard.admin.index')->with('success', 'Admin updated successfully');
    }

    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect()->route('dashboard.admin.index')->with('success', 'Admin deleted successfully');
    }
}
