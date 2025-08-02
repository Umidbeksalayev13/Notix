<?php

namespace App\Console\Commands;

use App\Helper\Telegram;
use App\Models\UserAccount;
use Illuminate\Console\Command;

class notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify';

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
        echo "start\n";
        $res =  $this->getCurrentDateTime();
        $date = $res['date'];
        $events = Telegram::getEvents($date, $date);

        $send = [];
        foreach($events as $event){
            if($event['start'] == $res['now']){
                $send[] = $event;
            }
        }


        //TODO
        foreach($send as $item){
            print_r($item);
            $user_id=$item['user_id'];
            $accounts = UserAccount::where('user_id',$user_id)->get();
            $message = "Title: " . $item['title'] . "\n";
            $message .= "Desc: " . $item['description'];
            foreach($accounts as $account){
                echo $account->chat_id . "\n";
                Telegram::send($account->chat_id,$message);
            }
        }
        echo "end\n";
    }

    public function getCurrentDateTime()
    {
        date_default_timezone_set('Asia/Tashkent'); // or your timezone

        $timestamp = time();

        // Extract minutes
        $minutes = date('i', $timestamp);

        // If minutes >= 30, set to 30; else 00
        if ($minutes < 30) {
            $roundedMinutes = 30;
            $roundedHour = date('H', $timestamp);
        } else {
            $roundedMinutes = 0;
            $roundedHour = date('H', strtotime('+1 hour', $timestamp));
        }

        // Build the rounded time
        $date = date('Y-m-d', $timestamp);
        $roundedTime = $date . 'T' . str_pad($roundedHour, 2, '0', STR_PAD_LEFT) . ':' . str_pad($roundedMinutes, 2, '0', STR_PAD_LEFT);

        return [
            'date' => $date,
            'now' => $roundedTime
        ];
    }
}
