<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawData extends Model
{
    use HasFactory;

    protected $table = 'raw_data';
    protected $primaryKey = 'idx';
    protected $fillable = [
        'address',
        'board_type',
        'board_number',
        'data1',
        'data2',
        'data3',
        'data4',
        'hw_cnt',
        'created_at'
    ];
    public $timestamps = false;
}
