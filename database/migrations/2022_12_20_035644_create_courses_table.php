<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('serial No.');
            $table->string('name')->comment('course name');
            $table->string('no')->comment('school course id');

            $table->unsignedInteger('academic_year_id')->comment('fk. academic_years/id');
            $table->foreign('academic_year_id')->references('id')->on('academic_years');

            $table->boolean('isenabled')->comment('alive status for rollcalls in this course');

            $table->timestamps();
            $table->timestamp('verified_at')->nullable()->comment('record deleted status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /**
         * Dropping the constraint (FK, the rule pattern is ${table name}_${column name}_foreign)
         * `_foreign` is a suffix and is necessary to be added as a suffix when using `deopForeign(.)`
         * because the suffix is to be added when the FK is created.
         */
        Schema::table('courses', function (Blueprint $table)
        {
            $table->dropForeign('courses_academic_year_id_foreign');
        });
        Schema::dropIfExists('courses');
    }
};
