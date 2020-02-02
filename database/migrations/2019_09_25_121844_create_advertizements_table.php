<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertizementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertizements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unieque();
            $table->text('add');
            $table->integer('type');
            $table->string('url')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertizements');
    }
}
