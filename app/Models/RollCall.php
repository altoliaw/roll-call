<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * RollCall Model, which controlling the main table, roll_calls;
 * In the model, the soft delete action is denied.
 */
class RollCall extends Model
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
        'url',
        'iscalled',
        'course_member_id',
        'verified_at',
    ];

    /**
     * The relationship between Models RollCall and Course (N-1)
     *
     * @return BelongsTo
     */
    public function courseMember(): BelongsTo
    {
        return $this->belongsTo(CourseMember::class, 'course_member_id', 'id');
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
