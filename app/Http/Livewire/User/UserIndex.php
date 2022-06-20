<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $q;

    protected $queryString = [
        'q' => ['except' => ''],
    ];
    
    public $modalTitle;
    public $statusAdd = false;
    public $statusEdit = false;
    public $username;
    public $name;
    public $password;
    public $password_confirmation;
    public $userId;

    public function render()
    {
        $params = [
            'q' => $this->q,
        ];

        $users = User::filter($params)->role('user')->orderBy('is_active')->orderBy('name')->paginate(10);

        return view('livewire.user.user-index', compact('users'))->extends('layouts.app');
    }

    public function add()
    {
        $this->modalTitle = 'Tambah Pengguna';
        $this->statusAdd = true;
        $this->statusEdit = false;

        $this->name = null;
        $this->username = null;
        $this->password = null;
        $this->password_confirmation = null;
        $this->userId = null;
    }

    // store
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:5',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $this->name,
            'username' => $this->username,
            'password' => bcrypt($this->password),
            'is_active' => true,
        ]);

        // assign to role user
        $user->assignRole('user');

        // reset form
        $this->reset(['name', 'username', 'password', 'password_confirmation']);

        // flash message
        session()->flash('message', 'Pengguna berhasil ditambahkan');
    }

    // edit
    public function edit(User $user)
    {
        $this->modalTitle = 'Edit Pengguna';
        $this->statusAdd = false;
        $this->statusEdit = true;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->userId = $user->id;
    }

    // update
    public function update()
    {
        $user = User::find($this->userId);

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

        // reset form
        $this->reset(['name', 'username', 'password', 'password_confirmation', 'userId']);

        // flash message
        session()->flash('success', 'Pengguna berhasil diubah');

        // emit user updated
        $this->emit('userUpdated');
    }

    // delete
    public function destroy(User $user)
    {
        try {
            $user->delete();
            session()->flash('success', 'Pengguna berhasil dihapus');
        } catch (\Throwable $th) {
            session()->flash('success', 'Pengguna tidak dapat dihapus');
        }
    }

    // set active or non active
    public function setActive(User $user)
    {
        $user->update([
            'is_active' => !$user->is_active,
        ]);

        // flash message
        session()->flash('success', 'Status pengguna "'.$user->name.'" berhasil diubah');
    }
}
