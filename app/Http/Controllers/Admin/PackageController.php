<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Package;
use App\Cliente;
use Illuminate\Http\Request;

class PackageController extends Controller
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
            ["titulo" => "Lista de Paquetes", "url" => ""],
        ]);
        // $listaModelo = Warehouse::select('id', 'data', 'warehouse', 'remetente')->get();
        $listaModelo = Package::listaPackages();
        $listaClientes = Cliente::listaClientes();
        return view('admin.log.packages.index',compact('listaMigalhas', 'listaModelo', 'listaClientes'));
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
            "tracknumber" => "required",
            "data_recebimento" => "required",
            "ctd_caixas" => "required",
            "peso_eua" => "required",
            "warehouse_id" => "required",
        ]);

        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }
        $package = Package::create($data);
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
        // return Package::find($id);
        $package = Package::listaPackage($id);
        return json_encode($package);
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
            "tracknumber" => "required",
            "data_recebimento" => "required",
            "ctd_caixas" => "required",
            "peso_eua" => "required",
            "warehouse_id" => "required",
        ]);

        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }
        Package::find($id)->update($data);
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
        Package::find($id)->delete();
        return redirect()->back();
    }
}
