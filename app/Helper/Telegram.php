<?php

namespace App\Helper;

use App\Models\UserAccount;

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
                    $existing = UserAccount::where('chat_id', $chat_id)->first();

                    // 2. Agar bor bo‘lsa va user_id boshqa bo‘lsa => xabar yuboramiz
                    if ($existing && $existing->user_id != $user_id) {
                        self::send($chat_id, "❗ Ushbu Telegram akkaunt allaqachon boshqa foydalanuvchi bilan bog‘langan.");
                        return;
                    }

                    // 3. Bo‘lmasa, update yoki create
                    UserAccount::updateOrCreate(
                        ['user_id' => $user_id],
                        ['chat_id' => $chat_id]
                    );

                    self::send($chat_id, "✅ Telegram akkauntingiz muvaffaqiyatli bog‘landi.");
                } else {
                    // Agar user_id yo'q bo‘lsa
                    self::send($chat_id, "Sizning chat_id'ingiz: <code>{$chat_id}</code>");
                }
            } else {
                self::send($chat_id, "👋 Salom! Botdan foydalanishni boshlash uchun <b>/start</b> buyrug‘ini bosing.");
            }
        }
    }

    public static function getUpdates($offset): false|string
    {
        $bot_token = self::TOKEN;
        $url = "https://api.telegram.org/bot{$bot_token}/getUpdates?offset={$offset}";
        return file_get_contents($url);
    }
}
