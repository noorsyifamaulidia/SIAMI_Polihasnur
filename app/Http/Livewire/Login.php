<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;

    public function render()
    {
        return view('livewire.login')->extends('layouts.auth');
    }

    public function login()
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required|min:5',
        ]);

        if (auth()->attempt(['username' => $this->username, 'password' => $this->password], true)) {
            return redirect()->route('dashboard');
        }

        session()->flash('error', 'Username atau password salah');
    }
}
