<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'display_name',
        'judul',
        'isi_aspirasi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
