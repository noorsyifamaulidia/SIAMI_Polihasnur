<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class EditProfile extends Component
{

    public $username;
    public $name;
    public $password;
    public $password_confirmation;

    public function render()
    {
        $user = auth()->user();

        return view('livewire.user.edit-profile', compact('user'))->extends('layouts.app');
    }

    public function mount()
    {
        $user = auth()->user();

        $this->username = $user->username;
        $this->name = $user->name;
    }

    // update
    public function update()
    {
        $user = User::find(auth()->id());

        $this->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
            'password' => 'nullable|min:5',
            'password_confirmation' => 'nullable|same:password',
        ]);

        $user->update([
            'name' => $this->name,
            'username' => $this->username,
            'password' => bcrypt($this->password),
        ]);

        $this->name = $user->name;
        $this->username = $user->username;
        $this->password = null;
        $this->password_confirmation = null;

        // flash message
        session()->flash('success', 'Profil berhasil diubah');
    }
}
