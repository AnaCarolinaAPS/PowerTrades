<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Freteiros extends Model
{
    protected $fillable = [
        'nome', 'referencia', 'nacionalidade', 'tipo_documento', 'numero_documento', 'contato', 'observacoes'
    ];

    public static function listaFreteiros() {
        $listaFreteiros = DB::table('freteiros')
                            ->select('freteiros.id', 'freteiros.nome', 'freteiros.referencia', DB::raw('CONCAT("[",freteiros.tipo_documento, "] ", freteiros.numero_documento) as documento'), 'freteiros.contato')
                            // ->whereNull('freteiros.deleted_at')
                            ->get();
                            // ->paginate($paginate);
        return $listaFreteiros;
    }
}
