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
        Schema::create('vaccine_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('vaccine_name');
            $table->string('short_name')->nullable();
            $table->string('default_batchno');
            $table->string('default_lotno');
            $table->date('expiration_date')->nullable();
            $table->integer('seconddose_nextdosedays')->default(1);
            $table->integer('booster_nextdosedays')->default(1);
            $table->tinyInteger('is_singledose')->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vaccine_lists');
    }
};
