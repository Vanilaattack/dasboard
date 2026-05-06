<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'angkatan',
        'pilihan_1',
        'alasan_1',
        'pilihan_2',
        'alasan_2',
        'foto_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
