<?php

namespace App\Http\Controllers\Admin;

use App\Freteiros;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FreteirosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaMigalhas = json_encode([
            ["titulo" => "Painel", "url" => route('adminicio')],
            ["titulo" => "Lista de Freteiros", "url" => ""],
        ]);
        // $listaModelo = Warehouse::select('id', 'data', 'warehouse', 'remetente')->get();
        $listaModelo = Freteiros::listaFreteiros();
        // $listaUsuarios = NULL;
        // $listaUsuarios = User::listaUserSinClientes();
        return view('admin.cad.freteiros.index',compact('listaMigalhas', 'listaModelo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validacao = \Validator::make($data, [
            "nome" => "required",
            "numero_documento" => "required",
            "contato" => "required",
        ]);

        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }
        $freteiro = Freteiros::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Freteiros::find($id);
        // $cliente = Cliente::dadosCliente($id);
        // return json_encode($cliente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validacao = \Validator::make($data, [
            "nome" => "required",
            "numero_documento" => "required",
            "contato" => "required",
        ]);

        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }
        Freteiros::find($id)->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
