<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


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
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->string('username',50)->unique();
            $table->string('email')->unique();
            $table->string('phone',30)->unique();
            $table->integer('gender');
            $table->integer('role_id');
            $table->string('address',150)->nullable();
            $table->string('image',150)->nullable();
            $table->string('bio',180)->nullable();
            $table->string('facebook',180)->nullable();
            $table->string('twitter',180)->nullable();
            $table->string('instagram',180)->nullable();
            $table->string('youtube',180)->nullable();
            $table->integer('status')->default('1');
            $table->string('slug',50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
