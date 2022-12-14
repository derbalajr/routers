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
        Schema::table('permissions', function (Blueprint $table) {
            $table->string('route');

            //for development purposes to list icons and routes in the side bar
            $table->string('icon');
            $table->string('masked_label');
            $table->string('masked_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('route');
            $table->dropColumn('icon');
            $table->dropColumn('masked_link');
            $table->dropColumn('masked_label');
        });
    }
};
