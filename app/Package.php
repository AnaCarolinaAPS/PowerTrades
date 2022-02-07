<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Package extends Model
{
    protected $fillable = [
        'tracknumber', 'data_recebimento', 'ctd_caixas', 'peso_eua', 'peso_pyg', 'peso_cli', 'data_retirada', 'observacoes', 'cliente_id', 'warehouse_id'
    ];

    public function warehouse() {
        return $this->belongsTo('App\Warehouse');
    }

    public static function listaPackages() {
        $listaPackages = DB::table('packages')
                            ->leftJoin('clientes', 'clientes.id', '=', 'packages.cliente_id')
                            ->leftJoin('warehouses', 'warehouses.id', '=', 'packages.warehouse_id')
                            ->select('packages.id', DB::raw('CONCAT("WR-", warehouses.warehouse) as warehouse'), 'packages.tracknumber', DB::raw('CONCAT("(", clientes.codigo, ") ", clientes.referencia) as cliente'), 'packages.peso_eua', 'packages.peso_pyg', 'packages.peso_cli', 'packages.data_retirada')
                            ->get();
                            // ->paginate(5);
        return $listaPackages;
    }

    public static function listaPackage($id) {
        $listaPackage = DB::table('packages')
                            ->leftJoin('warehouses', 'warehouses.id', '=', 'packages.warehouse_id')
                            ->select('packages.*', DB::raw('CONCAT("WR-", warehouses.warehouse) as warehouse'))
                            ->where('packages.id', '=', $id)
                            ->first();
        return $listaPackage;
    }
}
