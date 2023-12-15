<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bateria extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'baterias';

    protected $fillable = [
        'id',
        'surfista1',
        'surfista2',
    ];

    public function surfista1()
    {
        return $this->belongsTo(Surfista::class, 'surfista1', 'numero');
    }

    public function surfista2()
    {
        return $this->belongsTo(Surfista::class, 'surfista2', 'numero');
    }

    public function ondas()
    {
        return $this->hasMany(Onda::class, 'bateria_id', 'id');
    }
}
