<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Reservation
 *
 * @method static Builder|Reservation orderBy(string $column, string $direction = 'asc')
 * @method static Builder|Reservation where(string $column, mixed $value)
 * @method static Builder|Reservation create(array $attributes = [])
 */
class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date',
        'start_time',
        'end_time',
        'notes',
    ];
}
