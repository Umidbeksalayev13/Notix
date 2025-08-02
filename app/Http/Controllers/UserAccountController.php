<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        // Userning accounti bor yoki yo'qligini tekshiramiz
        $account = UserAccount::firstOrNew(['user_id' => $user->id]);

        // Ma'lumotlarni yozamiz
        $account->chat_id = $request->chat_id;
        $account->user_id = $user->id;
        $account->save();

        return back()->with('success', 'Telegram hisobingiz muvaffaqiyatli ulandi!');
    }

    public function accounts(){
        $accounts=UserAccount::where('user_id',Auth::id())->get();
        return view('accounts.index',compact('accounts'));
    }
}
