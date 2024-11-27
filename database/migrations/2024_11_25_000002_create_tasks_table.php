<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('priority');
            $table->foreignId('project_id')  // Creates relationship with projects table
                  ->nullable()               // Tasks can exist without a project
                  ->constrained()            // Ensures referential integrity
                  ->onDelete('cascade');     // Deletes tasks when project is deleted
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};