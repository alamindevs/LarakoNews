<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('short_about');
            $table->string('address');
            $table->string('email');
            $table->string('phone',20);
            $table->string('facebook')->nullable()->default('#');
            $table->string('twitter')->nullable()->default('#');
            $table->string('instagram')->nullable()->default('#');
            $table->string('linkedin')->nullable()->default('#');
            $table->string('google')->nullable()->default('#');
            $table->string('pinterest')->nullable()->default('#');
            $table->string('copyright');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('other_contacts');
    }
}
