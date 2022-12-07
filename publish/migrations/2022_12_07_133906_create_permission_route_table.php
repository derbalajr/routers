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
        Schema::create('permission_route', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->foreign('permission_id')
            ->references('id')
            ->on('permissions')
            ->onDelete('cascade');

            $table->unsignedBigInteger('route_id');
            $table->foreign('route_id')
            ->references('id')
            ->on('routes')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permission_route', function (Blueprint $table) {
            $table->dropForeign(['permission_id', 'route_id']);
        });
        Schema::dropIfExists('permission_route');
    }
};
