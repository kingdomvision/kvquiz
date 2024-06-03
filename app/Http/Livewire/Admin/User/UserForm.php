<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserForm extends Component
{
    public string $name;
    public string $email;
    public string $password;

    protected array $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ];

    public function save()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        session()->flash('message', "$user->name account is created.");
        return redirect()->route('users.list');
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.user.user-form', [
            'test' => []
        ]);
    }
}
