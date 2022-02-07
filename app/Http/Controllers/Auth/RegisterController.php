<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Cliente;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nacionalidade' => ['required', 'string', 'min:3'],
            'contato' => ['required', 'string', 'min:5'],
            'numero_documento' => ['required', 'string', 'min:5'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tipo_documento' => $data['tipo_documento'],
            'numero_documento' => $data['numero_documento'],
            'contato' => $data['contato'],
            'nacionalidade' => $data['nacionalidade'],
        ]);

        $nombre = explode(' ',$data['name']);
        $abreviacao = Str::substr($nombre[0], 0, 1);
        if (count($nombre)> 1) {
            $abreviacao = $abreviacao . Str::substr($nombre[1], 0, 1);
        }

        $numeracao = DB::table('clientes')->max('numeracao');
        $numeracao = $numeracao + 1;
        $numeracao = Str::padLeft($numeracao, 3, '0');
        $usuario = $user->id;

        Cliente::create([
            'nacionalidade' => $data['nacionalidade'],
            'numeracao' => $numeracao,
            'abreviacao' => $abreviacao,
            'user_id' => $usuario,
        ]);

        return $user;
    }
}
