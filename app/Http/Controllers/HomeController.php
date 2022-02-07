<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listaMigalhas = json_encode([
            ["titulo" => "Painel", "url" => ""],
        ]);
        $user = auth()->user();
        $cliente = Cliente::where('user_id', '=', $user->id)->first();

        return view('home', compact('listaMigalhas', 'user', 'cliente'));
    }
}
