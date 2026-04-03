<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specialist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'salon_id', 'bio', 'experience_years', 'rating',
    ];

    protected function casts(): array
    {
        return [
            'experience_years' => 'integer',
            'rating' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function salon(): BelongsTo { return $this->belongsTo(Salon::class); }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'specialist_service');
    }

    public function appointments(): HasMany { return $this->hasMany(Appointment::class); }
    public function reviews(): HasMany { return $this->hasMany(Review::class); }

    /**
     * Обновляем рейтинг специалиста по его отзывам
     */
    public function updateRating(): void
    {
        $this->rating = $this->reviews()->avg('rating') ?? 0;
        $this->save();
    }

    /**
     * Получаем топ N специалистов по рейтингу (по умолчанию 3)
     */
    public static function topThree(): \Illuminate\Database\Eloquent\Collection
    {
        // Обновляем рейтинг всех специалистов перед выборкой
        self::all()->each->updateRating();

        return self::orderByDesc('rating')
                   ->take(3)
                   ->get();
    }
}