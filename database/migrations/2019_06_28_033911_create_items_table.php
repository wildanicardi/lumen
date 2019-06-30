<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('checklist_id')->foreign('checklist_id')->references('id')->on('checklists')
                                    ->onUpdate('cascade')->onDelete('cascade');
            $table->string('description');
            $table->boolean('is_completed')->default(false);
            $table->date('completed_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('assignee_id')->nullable();
            $table->integer('task_id')->nullable();
            $table->string('due_unit')->nullable();
            $table->integer('due_interval')->nullable();
            $table->integer('urgency');
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
        Schema::dropIfExists('items');
    }
}
