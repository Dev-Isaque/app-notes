<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth/login");
    }

    public function loginSubmit(Request $request)
    {
        $request->validate(
            [
                'text_email' => 'required|email',
                'text_password' => 'required|min:6|max:16'
            ],
            [
                'text_email.required' => 'O email é obrigatório',
                'text_email.email' => 'email deve ser um email válido',
                'text_password.required' => 'A password é obrigatória',
                'text_password.min' => 'A password deve ter pelo menos :min caracteres',
                'text_password.max' => 'A password deve ter no máximo :max caracteres',
            ]
        );

        $email = $request->input('text_email');
        $password = $request->input('text_password');

        $user = User::where('email', $email)
            ->where('deleted_at', NULL)
            ->first();

        if (!$user || !password_verify($password, $user->password)) {
            return redirect()->back()->withInput()->with('loginError', 'email ou password incorretos.');
        }

        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        session([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
            ],
        ]);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        session()->forget('user');
        return redirect()->to('/login');
    }

    public function register(Request $request)
    {
        return view("auth/register");
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'password_pri' => 'required|min:6|max:16',
                'password_sec' => 'required|min:6|max:16|same:password_pri',
            ],
            [
                'name.required' => 'O Nome é obrigatório',
                'email.required' => 'O email é obrigatório',
                'email.email' => 'O email deve ser um email válido',
                'password_pri.required' => 'A senha é obrigatória',
                'password_pri.min' => 'A senha deve ter no mínimo 6 caracteres',
                'password_pri.max' => 'A senha deve ter no máximo 16 caracteres',
                'password_sec.same' => 'As senhas não coincidem'
            ]
        );

        $emailUser = User::where('email', $request->email)->first();

        if ($emailUser) {
            return redirect()->back()
                ->withInput()
                ->with('erro', 'Email já utilizado por outro usuário.');
        }

        // create new user

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password_pri;
        $user->save();

        // redirect to home
        return redirect()->route('home');
    }
}
