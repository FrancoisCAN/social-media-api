<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the foreign keys' association.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries');
        });

        Schema::table('devices', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('rights_roles', function (Blueprint $table) {
            $table->foreign('right_id')->references('id')->on('rights');
            $table->foreign('role_id')->references('id')->on('roles');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropForeign('cities_country_id_foreign');
            $table->dropColumn('country_id');
        });

        Schema::table('devices', function (Blueprint $table) {
            $table->dropForeign('devices_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::table('rights_roles', function (Blueprint $table) {
            $table->dropForeign('rights_role_id_foreign');
            $table->dropForeign('roles_right_id_foreign');
            $table->dropColumn('right_id');
            $table->dropColumn('role_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_role_id_foreign');
            $table->dropColumn('role_id');
        });
    }
};
