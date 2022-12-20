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
        Schema::create('roll_calls', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('serial No.');
            $table->string('url')->comment('for qrcode');
            $table->boolean('iscalled')->comment('is called flag for restoring rollcall infomation');

            $table->unsignedBigInteger('course_member_id')->comment('fk. course_member/id');
            $table->foreign('course_member_id')->references('id')->on('course_member');

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
        Schema::table('roll_calls', function (Blueprint $table)
        {
            $table->dropForeign('roll_calls_course_member_id_foreign');
        });
        Schema::dropIfExists('roll_calls');
    }
};
