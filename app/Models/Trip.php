<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Trip extends Model
{
    protected $fillable = [
        'title',
        'description',
        'city',
        'buddies_needed',
        'photo1',
        'photo2',
        'photo3',
        'start_date',
        'end_date',
        'user_id'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'buddies_needed' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::deleting(function ($trip) {
            // Delete associated photos when a trip is deleted
            foreach (['photo1', 'photo2', 'photo3'] as $photo) {
                if ($trip->$photo) {
                    Storage::disk('public')->delete($trip->$photo);
                }
            }

            // Delete associated comments (this is a backup, as we have onDelete('cascade') in migration)
            $trip->comments()->delete();
        });
    }

    public function isActive(): bool
    {
        return $this->end_date->isFuture();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }
}
