<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class FoodShare extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'food_name',
        'slug',
        'provider_name',
        'servings',
        'status',
        'image_url',
        'pickup_limit',
        'location_detail',
        'description',
    ];

    protected $casts = [
        'pickup_limit' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (FoodShare $foodShare): void {
            if (! empty($foodShare->slug)) {
                return;
            }

            $baseSlug = Str::slug($foodShare->food_name);
            $slug = $baseSlug;
            $counter = 2;

            while (static::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $foodShare->slug = $slug;
        });
    }

    public function getFormattedPickupAttribute(): string
    {
        return Carbon::parse($this->pickup_limit)->translatedFormat('d M Y, H:i');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'Available' => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
            'Booked' => 'bg-amber-100 text-amber-700 ring-amber-200',
            default => 'bg-slate-100 text-slate-700 ring-slate-200',
        };
    }

    public function getIsUrgentAttribute(): bool
    {
        $pickup = Carbon::parse($this->pickup_limit);

        if ($pickup->isPast()) {
            return false;
        }

        return now()->diffInMinutes($pickup) < 120;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}