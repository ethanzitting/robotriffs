<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->removeDuplicateFollows();

        Schema::table('follows', function (Blueprint $table) {
            $table->unique(['followed_id', 'follower_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('follows', function (Blueprint $table) {
            $table->dropUnique(['followed_id', 'follower_id']);
        });
    }

    protected function removeDuplicateFollows(): void
    {
        $follows = DB::table('follows')->get();

        $uniqueFollows = $follows->unique(function ($follow) {
            return $follow->followed_id.$follow->follower_id;
        });

        $duplicateFollowIds = $follows->pluck('id')
            ->diff($uniqueFollows->pluck('id'));

        DB::table('follows')
            ->whereIn('id', $duplicateFollowIds)
            ->delete();
    }
};
