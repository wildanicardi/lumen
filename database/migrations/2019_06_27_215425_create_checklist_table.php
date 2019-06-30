<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklists', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->string('type')->default('checklists');
            $table->string('object_domain');
            $table->string('object_id');
            $table->string('description');
            $table->boolean('is_completed')->default(false);
            $table->date('completed_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('due')->nullable();
            $table->string('due_unit')->nullable();
            $table->integer('due_interval')->nullable();
            $table->integer('urgency');
            $table->string('self');
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
        Schema::dropIfExists('checklists');
    }
}
