<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerialsTable extends Migration
{
    public function up()
    {
        Schema::create('serials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('serial');
            $table->text('notes');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('serials');
    }
}
