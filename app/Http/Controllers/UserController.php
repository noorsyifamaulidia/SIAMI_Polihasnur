<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $params = request()->except('_token');
        $users = User::role('user')->filter($params)->paginate(10);

        return view('user.index', compact('users'));
    }

    public function store(Request $request)
    {
        User::create($request->all());

        session()->flash('success', 'User berhasil ditambahkan');
        return redirect()->back();
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        session()->flash('success', 'User berhasil dihapus');
        return redirect()->back();
    }
}
