<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;
    public $autoSeeded = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|string',
    ];

    protected $messages = [
        'email.required' => 'Alamat email wajib diisi.',
        'email.email' => 'Format alamat email tidak valid.',
        'password.required' => 'Kata sandi wajib diisi.',
    ];

    public function mount()
    {
        // Auto-seed a default administrator if the user table is empty
        if (User::count() === 0) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@digisign.com',
                'password' => Hash::make('password'),
            ]);
            $this->autoSeeded = true;
        }

        // Redirect if already logged in
        if (Auth::check()) {
            return redirect()->route('admin.documents');
        }
    }

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            return redirect()->intended(route('admin.documents'));
        }

        $this->addError('email', 'Email atau password yang Anda masukkan salah.');
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('components.layouts.app');
    }
}
