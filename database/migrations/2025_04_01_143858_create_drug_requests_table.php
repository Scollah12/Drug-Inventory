<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('drugrequests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('drugid');
            $table->unsignedBigInteger('userid');
            $table->integer('quantity');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
            
            $table->foreign('drugid')->references('id')->on('drugstock')->onDelete('cascade');
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('drugrequests');
    }
};
