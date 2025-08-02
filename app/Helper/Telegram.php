<?php

namespace App\Helper;

use App\Models\UserAccount;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;

class Telegram
{
    const TOKEN = '8416557208:AAF9tPBHoz2MbFOhMQ7h_8S96TgCrCNAjPg';

    public static function send($chat_id, $message): void
    {
        $bot_token = self::TOKEN;
        foreach (str_split($message, 4096) as $value) {
            $url = "https://api.telegram.org/bot{$bot_token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text=" . urlencode($value);
            @file_get_contents($url);
        }
    }

    public static function run($message): void
    {
        if (isset($message['chat']['id'])) {
            $chat_id = $message['chat']['id'];
            $text = $message['text'] ?? '';

            if (str_starts_with($text, '/start')) {
                $parts = explode(' ', $text);
                $user_id = $parts[1] ?? null;

                if ($user_id && is_numeric($user_id)) {
                    // 1. Avval chat_id bazada mavjudmi, tekshiramiz
                    $existing = UserAccount::where('chat_id', $chat_id)
                                             ->where('user_id', $user_id)
                                             ->first();

                    // 2. Agar bor bo‘lsa va user_id boshqa bo‘lsa => xabar yuboramiz
                    if ($existing) {
                        self::send($chat_id, "❗ Ushbu Telegram akkaunt allaqachon sizga bog‘langan.");
                        return;
                    }

                    // 3. Bo‘lmasa, update yoki create
                    UserAccount::create([
                        'user_id' => $user_id,
                        'chat_id' => $chat_id
                    ]);

                    self::send($chat_id, "✅ Telegram akkauntingiz muvaffaqiyatli bog‘landi.");
                } else {
                    // Agar user_id yo'q bo‘lsa
                    self::send($chat_id, "Sizning chat_id'ingiz: <code>{$chat_id}</code>");
                }
            } else {
                self::send($chat_id, "👋 Salom! Sizning chat_id ingiz: <code>{$chat_id}</code> ");
            }
        }
    }

    public static function getUpdates($offset): false|string
    {
        $bot_token = self::TOKEN;
        $url = "https://api.telegram.org/bot{$bot_token}/getUpdates?offset={$offset}";
        return file_get_contents($url);
    }

    public static function getEvents($start_date, $end_date, $user_id = null) {
        $result = [];

        // Build the query using Laravel Query Builder
        $query = DB::table('events as e')
            ->select('e.*', 'et.start_time')
            ->leftJoin('times as et', 'e.id', '=', 'et.events_id')
            ->where('e.status', 'active')
            ->where('e.start_date', '<=', $end_date)
            ->where(function($query) use ($start_date) {
                $query->whereNull('e.end_date')
                    ->orWhere('e.end_date', '>=', $start_date);
            });

        // Add user filter if provided
        if ($user_id !== null) {
            $query->where('e.user_id', $user_id);
        }

        $events = $query->get()->toArray();


        $start_timestamp = strtotime($start_date);
        $end_timestamp = strtotime($end_date);

        // Helper function to format event output
        $formatEventOutput = function($event, $date) {
            $start_time = $event->start_time ?: '00:00:00';

            return [
                'title' => $event->title,
                'description' => $event->description,
                'user_id' => $event->user_id,
                'start' => $date . 'T' . $start_time,
                'color' => $event->colors
            ];
        };

        foreach ($events as $event) {
            $event_start = strtotime($event->start_date);
            $event_end = $event->end_date ? strtotime($event->end_date) : $end_timestamp;

            // Generate occurrences based on repeat type
            switch ($event->repeat_type) {
                case 'none':
                    // Single occurrence
                    if ($event_start >= $start_timestamp && $event_start <= $end_timestamp) {
                        $result[] = $formatEventOutput($event, $event->start_date);
                    }
                    break;

                case 'daily':
                    $interval = $event->repeat_interval ?: 1;
                    $current = $event_start;

                    while ($current <= $end_timestamp && $current <= $event_end) {
                        if ($current >= $start_timestamp) {
                            $result[] = $formatEventOutput($event, date('Y-m-d', $current));
                        }
                        $current = strtotime("+{$interval} days", $current);
                    }
                    break;

                case 'weekly':
                    $interval = $event->repeat_interval ?: 1;
                    $repeat_days = $event->repeat_days_week ? explode(',', $event->repeat_days_week) : [date('w', $event_start)];

                    // Start from the beginning of the week containing start_date or event start_date
                    $week_start = strtotime('last sunday', max($event_start, $start_timestamp));
                    if (date('w', max($event_start, $start_timestamp)) == 0) {
                        $week_start = max($event_start, $start_timestamp);
                    }

                    $current_week = $week_start;

                    while ($current_week <= $end_timestamp && $current_week <= $event_end) {
                        foreach ($repeat_days as $day) {
                            $occurrence = strtotime("+{$day} days", $current_week);

                            if ($occurrence >= $event_start &&
                                $occurrence >= $start_timestamp &&
                                $occurrence <= $end_timestamp &&
                                $occurrence <= $event_end) {
                                $result[] = $formatEventOutput($event, date('Y-m-d', $occurrence));
                            }
                        }
                        $current_week = strtotime("+{$interval} weeks", $current_week);
                    }
                    break;

                case 'monthly':
                    $interval = $event->repeat_interval ?: 1;
                    $repeat_days = $event->repeat_days_month ? explode(',', $event->repeat_days_month) : [date('j', $event_start)];

                    $current_date = new DateTime($event->start_date);
                    $end_date_obj = new DateTime($end_date);
                    $start_date_obj = new DateTime($start_date);

                    while ($current_date <= $end_date_obj && $current_date->getTimestamp() <= $event_end) {
                        foreach ($repeat_days as $day) {
                            $occurrence = clone $current_date;
                            $occurrence->setDate($current_date->format('Y'), $current_date->format('n'), min($day, $occurrence->format('t')));

                            if ($occurrence >= $start_date_obj &&
                                $occurrence <= $end_date_obj &&
                                $occurrence->getTimestamp() >= $event_start &&
                                $occurrence->getTimestamp() <= $event_end) {
                                $result[] = $formatEventOutput($event, $occurrence->format('Y-m-d'));
                            }
                        }
                        $current_date->add(new DateInterval("P{$interval}M"));
                    }
                    break;

                case 'yearly':
                    $interval = $event->repeat_interval ?: 1;
                    $current_date = new DateTime($event->start_date);
                    $end_date_obj = new DateTime($end_date);
                    $start_date_obj = new DateTime($start_date);

                    while ($current_date <= $end_date_obj && $current_date->getTimestamp() <= $event_end) {
                        if ($current_date >= $start_date_obj && $current_date->getTimestamp() >= $event_start) {
                            $result[] = $formatEventOutput($event, $current_date->format('Y-m-d'));
                        }
                        $current_date->add(new DateInterval("P{$interval}Y"));
                    }
                    break;
            }
        }

        return $result;
    }


}
