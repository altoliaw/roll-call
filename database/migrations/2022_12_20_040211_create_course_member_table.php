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
        Schema::create('course_member', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('serial No.');
            $table->unsignedBigInteger('course_id')->comment('serial No. in courses table');
            $table->foreign('course_id')->references('id')->on('courses');

            $table->unsignedBigInteger('member_id')->comment('serial No. in members table');
            $table->foreign('member_id')->references('id')->on('members');

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
        Schema::table('course_member', function (Blueprint $table)
        {
            $table->dropForeign('course_member_course_id_foreign');
            $table->dropForeign('course_member_member_id_foreign');
        });
        Schema::dropIfExists('course_member');
    }
};
