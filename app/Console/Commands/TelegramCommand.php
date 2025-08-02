<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helper\Telegram;

class TelegramCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Telegram botni ishga tushirish';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Bot ishga tushdi...");
        $update_id = 0;

        while (true) {
            $updates = json_decode(Telegram::getUpdates($update_id), true);

            if (!empty($updates['result'])) {
                foreach ($updates['result'] as $update) {
                    if(isset($update['message'])){
                        Telegram::run($update['message']);
                    }
                    $update_id = $update['update_id'] + 1;
                }
            }

            sleep(1);
        }
    }
}
