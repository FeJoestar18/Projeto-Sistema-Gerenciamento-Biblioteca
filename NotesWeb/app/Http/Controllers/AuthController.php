<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AuditLog;
use App\Notifications\WelcomeNotification;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if ($user && $user->is_blocked) {
            return back()->withErrors(['email' => 'Usuário bloqueado. Entre em contato com o administrador.']);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            AuditLog::create([
                'user_id' => auth()->id(),
                'action' => 'login',
                'description' => 'Usuário realizou login no sistema',
                'ip_address' => $request->ip(),
            ]);

            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas.']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'cpf' => 'nullable|string|size:11|unique:users,cpf',
            'cnpj' => 'nullable|string|size:14|unique:users,cnpj',
            'rg' => 'nullable|string|max:20|unique:users,rg',
        ], [
            'email.unique' => 'Este e-mail já está cadastrado.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'cnpj.unique' => 'Este CNPJ já está cadastrado.',
            'rg.unique' => 'Este RG já está cadastrado.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
            'rg' => $request->rg,
            'role' => 'usuario',
            'is_blocked' => false,
        ]);

        $user->notify(new WelcomeNotification());

        Auth::login($user);

        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }
    
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}

