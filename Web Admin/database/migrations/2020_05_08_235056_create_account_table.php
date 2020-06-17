<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account', function (Blueprint $table) {
            $table->id();
            $table->string("nim_npp");
            $table->string("account_name");
            $table->string("gender");
            $table->string("dob");
            $table->string("phone");
            $table->string("email");
            $table->string("status");
            $table->string("image");
            $table->string("password");
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
        Schema::dropIfExists('account');
    }
}
