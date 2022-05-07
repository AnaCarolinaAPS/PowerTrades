<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DespachantesPrecos extends Model
{
    protected $fillable = [
        'precio_kg', 'data', 'despachante_id'
    ];

    public function DespachantesPrecos() {
        return $this->belongsTo('App\Despachantes');
    }
}
