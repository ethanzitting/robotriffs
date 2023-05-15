<?php

use App\Models\Notification;
use App\Types\NotificationTypes;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Notification::where('type', NotificationTypes::TWEET_POSTED)
            ->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Irreversible
    }
};
