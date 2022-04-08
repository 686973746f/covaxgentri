<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccinator_names', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->string('lname');
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('suffix')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vaccinator_names');
    }
};
