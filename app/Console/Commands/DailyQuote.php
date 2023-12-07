<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DailyQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-quote';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily social media posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $text = "[" . date("Y-m-d H:i:s") . "]: Ver hora de cronjo";
        Storage::append("file.txt", $text);

        return Command::SUCCESS;
    }
}
