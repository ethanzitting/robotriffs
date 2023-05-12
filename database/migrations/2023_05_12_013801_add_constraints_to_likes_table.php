<?php

use App\Models\Like;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->removeDuplicateLikes();

        Schema::table('tweet_likes', function (Blueprint $table) {
            $table->unique(['tweet_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tweet_likes', function (Blueprint $table) {
            $table->dropUnique(['tweet_id', 'user_id']);
        });
    }

    protected function removeDuplicateLikes(): void
    {
        $likes = Like::get();

        $uniqueLikes = $likes->unique(function (Like $like) {
            return $like['user_id'].$like['tweet_id'];
        });

        $duplicateLikeIds = $likes->pluck('id')
            ->diff($uniqueLikes->pluck('id'));

        Like::whereIn('id', $duplicateLikeIds)
            ->delete();
    }
};
