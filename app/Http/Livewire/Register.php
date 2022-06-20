<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{

    public $name;
    public $username;
    public $password;

    public function render()
    {
        return view('livewire.register')->extends('layouts.auth');
    }

    public function register()
    {
        $this->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:5',
        ]);

        $user = User::create([
            'name' => $this->name,
            'username' => $this->username,
            'password' => bcrypt($this->password),
        ]);

        auth()->login($user);

        // assign to role user
        $user->assignRole('user');

        return redirect()->route('dashboard');
    }
}
