<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Course extends Model
{
    use HasFactory;

    /**
     * The relationships that should always be loaded in eager loading.
     *
     * @var array
     */
    protected $with = [
        'academic_year',
    ];

    /**
     * The setting of being inserted/ updated column name by using batches
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'no',
        'academic_year_id',
        'isenabled',
        'verified_at',
    ];

    /**
     * The relationship between Models Course and AcademicYear (N-1)
     *
     * @return belongsTo
     */
    public function academic_year(): belongsTo
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id', 'id');
    }

    /**
     * The relationship between Models Course and User (M-N)
     *
     * @return belongsToMany
     */
    public function users(): belongsToMany
    {
        return $this->belongsToMany(User::class)->without('courses');
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
