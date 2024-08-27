<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    #[Validate('required')]
    public $email;

    #[Validate('required')]
    public $password;

    public $rememberMe;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'E-posta alanı zorunludur.',
            'password.required' => 'Şifre alanı zorunludur.',
        ]);
        $user = User::where('email', $this->email)->first();
        if ($user && Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            Auth::login($user);
            if ($this->rememberMe) {
                Auth::remember();
                return redirect(route('admin.index', absolute: false));
            }
            return redirect(route('admin.index', absolute: false));
        } else {
            $this->addError('email', 'Sağlanan kimlik bilgileri kayıtlarımızla eşleşmiyor.');
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
