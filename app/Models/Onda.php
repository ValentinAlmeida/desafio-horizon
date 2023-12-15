<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onda extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'ondas';

    protected $fillable = [
        'id',
        'bateria_id',
        'surfista_id'
    ];

    public function bateria()
    {
        return $this->belongsTo(Bateria::class, 'Bateria', 'id');
    }

    public function surfista()
    {
        return $this->belongsTo(Surfista::class, 'Surfista', 'numero');
    }

    public function nota()
    {
        return $this->hasOne(Nota::class, 'Onda', 'id');
    }
}
