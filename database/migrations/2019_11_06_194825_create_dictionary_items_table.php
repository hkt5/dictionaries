<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDictionaryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dictionary_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 167)->nullable(false);
            $table->unsignedBigInteger('dictionary_id')->nullable(false);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('dictionary_id')->on('dictionaries')->references('id')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dictionary_items');
    }
}
