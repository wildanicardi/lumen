<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('checklist_id')->foreign('checklist_id')->references('id')->on('checklists')
                                    ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('item_id')->foreign('item_id')->references('id')->on('item_attributes')
                                    ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('template_attributes');
    }
}
