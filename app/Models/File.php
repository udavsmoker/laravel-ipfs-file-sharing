<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'path',
        'extension',
        'ipfs_hash',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
