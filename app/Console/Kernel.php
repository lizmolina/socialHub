<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\LoginTwitterController;
use App\Models\Post;
use App\Models\Calendario;


class Kernel extends ConsoleKernel
{
      /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\DailyQuote::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
         $schedule->call(function () {
            $date1 = date('l');
            $time1 = date('H');
            $posts = Post::all()->where('type', 'Schedule');


            foreach ($posts as $post) {
                $schedule = Calendario::find($post->schedule_id);
                $schedule = Calendario::find($post->user_id);
                if ($date1 === $schedule->date) {
                    if ($schedule->time === $time1) {
                        $network = new LoginTwitterController();
                        $network->postTweet($post->user_id->twitter_oauth_token,$post->user_id->twitter_oauth_token_secret,$post->description);
                    }
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
