<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{
    protected $fillable = [
        'codigo', 'nacionalidad', 'numeracao', 'abreviacao', 'referencia', 'observacoes', 'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public static function listaClientes() {
        $listaClientes = DB::table('clientes')
                            ->leftJoin('users', 'users.id', '=', 'clientes.user_id')
                            ->select('clientes.id', DB::raw('CONCAT(clientes.nacionalidade, clientes.numeracao, clientes.abreviacao) as codigo'), 'users.name', 'clientes.referencia')
                            // ->where('packages.warehouse_id', '=', $id)
                            ->whereNull('clientes.deleted_at')
                            ->get();
                            // ->paginate($paginate);
        return $listaClientes;
    }

    public static function dadosCliente($id) {
        $listaClientes = DB::table('clientes')
                            ->leftJoin('users', 'users.id', '=', 'clientes.user_id')
                            ->select('clientes.id', 'clientes.codigo', 'clientes.nacionalidade', 'clientes.numeracao', 'clientes.abreviacao', 'clientes.observacoes', 'users.name', 'users.email', 'users.contato', 'users.tipo_documento', 'users.numero_documento', 'clientes.referencia')
                            ->where('clientes.id', '=', $id)
                            ->whereNull('clientes.deleted_at')
                            ->first();
                            // ->paginate($paginate);
        return $listaClientes;
    }
}
