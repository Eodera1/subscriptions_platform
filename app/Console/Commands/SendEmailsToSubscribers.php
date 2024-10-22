<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendEmailsToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails-to-subscribers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $websites = \App\Website::with('posts')->get();

        foreach ($websites as $website) {
            foreach ($website->subscriptions as $subscription) {
                $newPosts = $website->posts()
                    ->whereDoesntHave('emails', function ($query) use ($subscription) {
                        $query->where('user_id', $subscription->user_id);
                    })
                    ->get();
    
                foreach ($newPosts as $post) {
                    Mail::to($subscription->user->email)->send(new PostNotification($post));
    
                    Email::create([
                        'post_id' => $post->id,
                        'user_id' => $subscription->user_id,
                    ]);
                }
            }
        }
    }
}