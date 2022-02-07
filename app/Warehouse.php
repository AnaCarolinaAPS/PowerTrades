<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Warehouse extends Model
{
    protected $fillable = [
        'data', 'warehouse', 'remetente', 'observacoes',
    ];

    public static function listaWarehouses() {
        $listaWarehouses = DB::table('warehouses')
                            // ->leftJoin('packages', 'warehouses.id', '=', 'packages.warehouse_id')
                            ->select('warehouses.id', 'warehouses.warehouse', 'warehouses.data', 'warehouses.remetente')
                            ->get();
                            // ->paginate($paginate);
        return $listaWarehouses;
    }

    public static function listaPackages($id) {
        $listaWarehouses = DB::table('packages')
                            ->leftJoin('clientes', 'clientes.id', '=', 'packages.cliente_id')
                            ->select('packages.id', 'packages.tracknumber', DB::raw('CONCAT("(", clientes.codigo, ") ", clientes.referencia) as cliente'), 'packages.peso_eua', 'packages.peso_pyg', 'packages.peso_cli', 'packages.data_retirada')
                            ->where('packages.warehouse_id', '=', $id)
                            ->get();
                            // ->paginate(5);
        return $listaWarehouses;
    }

    public static function resumoWarehouse($id) {
        $listaWarehouses = DB::table('packages')
                            ->selectRaw('count(id) as ctd_packages, sum(peso_eua) as total_peso_eua, count(data_retirada) as ctd_retirados, sum(peso_pyg) as total_peso_pyg, sum(peso_cli) as total_peso_cli')
                            // ->select('packages.id', 'packages.tracknumber', 'packages.data_recebimento', 'packages.peso_eua', 'packages.peso_pyg', 'packages.peso_cli')
                            ->where('packages.warehouse_id', '=', $id)
                            ->get();
                            // ->paginate($paginate);
        return $listaWarehouses;
    }

    public function packages()
    {
        return $this->hasMany('App\Package');
    }
}
