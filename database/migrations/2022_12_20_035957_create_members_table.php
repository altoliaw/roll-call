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
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('serial No.');
            $table->string('account')->comment('school id');
            $table->string('name')->comment('username');
            $table->string('line_id')->nullable()->comment('line id');

            $table->unsignedInteger('agency_id')->comment('fk. agencies/id');
            $table->foreign('agency_id')->references('id')->on('agencies');

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
        Schema::table('members', function (Blueprint $table)
        {
            $table->dropForeign('members_agency_id_foreign');
        });

        Schema::dropIfExists('members');
    }
};
