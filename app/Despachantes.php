<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Despachantes extends Model
{
    protected $fillable = [
        'nome', 'referencia', 'nacionalidade', 'contato', 'observacoes'
    ];

    public static function listaDespachantes() {
        $listaDespachantes = DB::table('despachantes')
                            ->leftJoin('despachantes_precos', 'despachantes.id', '=', 'despachantes_precos.despachante_id')
                            ->select('despachantes.id', 'despachantes.nome', 'despachantes.referencia', 'despachantes.contato', 'despachantes_precos.precio_kg')
                            // ->whereNull('freteiros.deleted_at')
                            ->get();
                            // ->paginate($paginate);
        return $listaDespachantes;
    }
}
