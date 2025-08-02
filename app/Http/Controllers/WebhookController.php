<?php

namespace App\Http\Controllers;

use App\Helper\Telegram;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle()
    {
        $input = file_get_contents('php://input');
        file_put_contents('log.txt', print_r($input, 1), FILE_APPEND);

            // Decode JSON to associative array
        $update = json_decode($input, true);
        if (isset($update['message'])) {
            Telegram::run($update['message']);
        }

        echo "working";

    }
}
