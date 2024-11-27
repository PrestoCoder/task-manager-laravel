<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();                    // Auto-incrementing ID
            $table->string('name');          // Project name field
            $table->timestamps();            // Created_at and updated_at fields
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');    // Removes table when rolling back
    }
};