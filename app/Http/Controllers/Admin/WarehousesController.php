<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Warehouse;
use App\Cliente;
use App\Package;

class WarehousesController extends Controller
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
            ["titulo" => "Lista de Warehouses", "url" => ""],
        ]);
        // $listaModelo = Warehouse::select('id', 'data', 'warehouse', 'remetente')->get();
        $listaModelo = Warehouse::listaWarehouses();
        return view('admin.log.warehouses.index',compact('listaMigalhas', 'listaModelo'));
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
            "warehouse" => "required",
            "remetente" => "required",
            "data" => "required",
        ]);

        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }
        $warehouse = Warehouse::create($data);
        return redirect()->route('warehouses.show', [$warehouse->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $warehouse = Warehouse::find($id);
        $listaMigalhas = json_encode([
            ["titulo" => "Painel", "url" => route('adminicio')],
            ["titulo" => "Warehouses", "url" => route('warehouses.index')],
            ["titulo" => "WR".$warehouse->warehouse, "url" => ""],
        ]);
        $listaModelo = Warehouse::listaPackages($id);
        $resumoModelo = Warehouse::resumoWarehouse($id);
        $listaClientes = Cliente::listaClientes();
        if ($warehouse) {
            return view('admin.log.warehouses.warehouse', compact('listaMigalhas', 'listaModelo', 'listaClientes', 'resumoModelo', 'warehouse'));
        }
        return redirect()->back();
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
            "warehouse" => "required",
            "remetente" => "required",
            "data" => "required",
        ]);

        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }
        Warehouse::find($id)->update($data);
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
        Warehouse::find($id)->delete();
        Package::where('warehouse_id', '=', $id)->delete();
        // DB::table('packages')->where('warehouse_id', '=', $id)->delete();
        return redirect()->route('warehouses.index');
        // return redirect()->back();
    }
}
