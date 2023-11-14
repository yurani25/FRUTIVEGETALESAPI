<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
          // $table->unsignedBigInteger('rol_id');
           // $table->unsignedBigInteger('abastecimiento_id');
            $table->string('profile_picture')->nullable();
            $table->string('nombres');
            $table->string('apellidos');
            $table->integer('edad');
            $table->string('telefono', 15);
            $table->string('email');
            $table->string('password');
            $table->timestamps();
           // $table->foreign('abastecimiento_id')->references('id')->on('abastecimientos')->onDelete('cascade');
           // $table->foreign('rol_id')->references('id')->on('rols')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
