<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * CourseUser Model, which controlling the main table, course_user;
 * In the model, the soft delete action is denied.
 */
class CourseMember extends Pivot
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
        'course_id',
        'member_id',
        'verified_id'
    ];

    /**
     * The relationship between Models CourseMember and User (1-N)
     *
     * @return belongsTo
     */
    public function member(): belongsTo
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    /**
     * The relationship between Models CourseUser and Course (1-N)
     *
     * @return belongsTo
     */
    public function course(): belongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    /**
     * The relationship between Models CourseUser and RollCall (1-N)
     *
     * @return hasMany
     */
    public function rollCalls(): hasMany
    {
        return $this->hasMany(RollCall::class, 'course_member_id', 'id');
    }

    /**
     * Serializing the date format in the model
     *
     * @param  mixed $date
     * @return string a format of the datetime
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
