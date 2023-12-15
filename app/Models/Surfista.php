<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surfista extends Model
{
    use HasFactory;

    protected $primaryKey = 'numero';
    public $incrementing = false;
    protected $keyType = 'integer';
    protected $table = 'surfistas';

    protected $fillable = [
        'numero',
        'nome',
        'pais',
    ];

    public function baterias()
    {
        return $this->hasMany(Bateria::class, 'surfista1', 'numero')
                    ->orWhere('surfista2', $this->numero);
    }

    public function ondas()
    {
        return $this->hasMany(Onda::class, 'surfista_id', 'numero');
    }
}
