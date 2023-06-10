<?php

use App\Models\Like;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function __construct()
    {
        $this->notificationService = new NotificationService();
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('type');
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('caused_by')
                ->nullable()
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->foreignId('follow_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('tweet_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->boolean('viewed')->default(false);
            $table->timestamps();
        });

        $this->populateTableForExistingEvents();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }

    private function populateTableForExistingEvents(): void
    {
        // Likes
        Like::query()
            ->with(['tweet'])
            ->get()
            ->each(function ($like) {
                if (! $like->tweet) {
                    return;
                }
                $this->notificationService
                    ->createTweetLikedNotification(
                        $like->tweet->user_id,
                        $like->user_id,
                        $like->tweet_id,
                        $like->created_at,
                        $like->updated_at,
                    );
            });

        $users = User::with(['tweets', 'followers', 'tweets.parent'])
            ->where('handle', '!=', 'robot')
            ->get();

        foreach ($users as $user) {
            foreach ($user->tweets as $tweet) {
                if ($tweet->parent_id) {
                    // Replies
                    $this->notificationService
                        ->createReplyPostedNotification(
                            $tweet->parent->user_id,
                            $user->id,
                            $tweet->id,
                            $tweet->created_at,
                            $tweet->updated_at,
                        );

                    continue;
                }

                // Posts
                foreach ($user->followers as $follower) {
                    $this->notificationService
                        ->createTweetPostedNotification(
                            $follower->id,
                            $user->id,
                            $tweet->id,
                            $tweet->created_at,
                            $tweet->updated_at,
                        );
                }
            }
        }

        // Follows
        foreach ($users as $user) {
            foreach ($user->followers()->withPivot(['created_at', 'updated_at'])->get() as $follower) {
                $this->notificationService
                    ->createUserFollowedNotification(
                        $user->id,
                        $follower->id,
                        $follower->pivot->created_at,
                        $follower->pivot->updated_at,
                    );
            }
        }
    }
};
