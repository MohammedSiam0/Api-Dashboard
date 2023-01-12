<?php

use App\Models\City;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            // $table->foreignId('city_id')->after('password');
            // $table->foreign('city_id')->references('id')->on('cities');

            // $table->foreignIdFor(City::class);
            //  $table->foreign('city_id')->references('id')->on('cities');
            //    $table->foreignId('city_id')->constrained();

              $table->foreignIdFor(City::class)->constrained();

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('user_city_id_foreign');
            $table->dropColumn('city_id');
                });
    }
}
