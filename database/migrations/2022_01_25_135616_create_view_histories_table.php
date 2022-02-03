<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view_histories', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer('duration');
            $table->integer('release_year');
            $table->string('thumbnail');
            $table->string('author');
            $table->foreignId('ratings_id')->constrained();
            $table->foreignId('platforms_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('family_member_id')->constrained();
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
        Schema::dropIfExists('view_histories');
    }
}
