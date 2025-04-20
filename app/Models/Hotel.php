<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'address',
        'city',
        'photo1',
        'photo2',
        'photo3',
        'proof_document'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
