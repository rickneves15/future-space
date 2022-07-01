<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Launcher extends Model
{
    use HasFactory;
    protected $table = 'launchers';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $casts = [
        'dataset' => 'object'
    ];

    protected $dateFormat = 'd-m-Y H:i:s';
    protected $fillable = [
        'dataset',
        'imported_t',
        'status'
    ];
}
