<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Member extends Model
{
    use HasFactory;

    /**
     * The relationships that should always be loaded in eager loading.
     *
     * @var array
     */
    protected $with = [
        "agency",
    ];

    /**
     * The setting of being inserted/ updated column name by using batches
     *
     * @var array
     */
    protected $fillable = [
        'account',
        'name',
        'line_id',
        'agency_id',
        'verified_at',
    ];

    /**
     * The relationship between Models User and Agency (N-1)
     *
     * @return belongsTo
     */
    public function agency(): belongsTo
    {
        return $this->belongsTo(Agency::class, 'agency_id', 'id');
    }

    /**
     * The relationship between Models User and Course (M-N);
     * i.e., the pivot is called CourseUser.
     * @return void
     */
    public function courses(): BelongsToMany
    {
        return $this
        ->belongsToMany(Course::class)->withPivot('id')->withTimestamps();
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
