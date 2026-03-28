<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;


#[Layout('layouts.guest')]
class LoginForm extends Component
{
    #[Validate('required|email', message: ['required' => 'Email wajib diisi.', 'email' => 'Format email tidak valid.'])]
    public string $email = '';

    #[Validate('required|min:6', message: ['required' => 'Password wajib diisi.', 'min' => 'Password minimal 6 karakter.'])]
    public string $password = '';

    public bool $remember = false;
    public string $alertMessage = '';
    public string $alertType = ''; // 'error' | 'success'

    public function login()
    {
        $this->alertMessage = '';

        $this->validate();

        if (!Auth::attempt([
            'email'    => $this->email,
            'password' => $this->password,
        ], $this->remember)) {
            $this->alertType    = 'error';
            $this->alertMessage = 'Email atau password salah. Silakan coba lagi.';
            return;
        }

        session()->regenerate();
        $this->alertType    = 'success';
        $this->alertMessage = 'Login berhasil! Mengalihkan...';

        return $this->redirect('/todos');
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}