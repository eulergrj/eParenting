<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string("addressNickname");
            $table->string("address1");
            $table->string("address2")->nullable();
            $table->string("address3")->nullable();
            $table->foreignId('country_id')->constrained();            
            $table->foreignId('county_id')->nullable()->constrained();            
            $table->string('city')->nullable();
            $table->string("postcode");
            $table->string("phone")->nullable();
            $table->string("notes")->nullable();
            $table->boolean("default")->default(0);
            $table->boolean("deleted")->default(1);
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
        Schema::dropIfExists('addresses');
    }
}
