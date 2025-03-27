<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('image_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Corrected this line
            $table->string('caption')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            // Adding the foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 

            // Adding an index for faster querying
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_posts');
    }
};
