<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use HasFactory;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('retweets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tweet_id');
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retweets');
    }
};
