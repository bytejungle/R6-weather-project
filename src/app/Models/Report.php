<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city'
    ];

    /**
     * Get the day forecasts for the report.
     */
    public function dayForecasts(): HasMany
    {
        return $this->hasMany(DayForecast::class);
    }
}
