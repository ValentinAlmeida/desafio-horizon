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
        return $this->belongsTo(Bateria::class, 'bateria_id', 'id');
    }

    public function surfista()
    {
        return $this->belongsTo(Surfista::class, 'surfista_id', 'numero');
    }

    public function nota()
    {
        return $this->hasOne(Nota::class, 'onda_id', 'id');
    }
}
