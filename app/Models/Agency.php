<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agency extends Model
{
    use HasFactory;

    /**
     * The relationships that should always be loaded in eager loading.
     *
     * @var array
     */
    protected $with = [
    ];

    /**
     * The setting of being inserted/ updated column name by using batches
     *
     * @var array
     */
    protected $fillable = [
        'abbreviation',
        'name',
        'formal_name',
        'verified_at',
    ];

    /**
     * The relationship between Models Angency and User (1-N)
     *
     * @return hasMany
     */
    public function users(): hasMany
    {
        return $this->hasMany(User::class, 'id', 'agency_id');
    }

    /**
     * Serializing the date format in the model
     *
     * @param  DateTimeInterface $date
     * @return string a format of the datetime
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
