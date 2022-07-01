<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaunchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('launchers', function (Blueprint $table) {
            $table->id();
            $table->json('dataset');
            $table->timestamp('imported_t')->useCurrent();
            $table->enum('status', ['draft', 'trash', 'published'])->default('draft');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('launchers');
    }
}
