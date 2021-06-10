<?php

namespace App\Http\Controllers;

use App\Models\CardUser;
use App\Models\CreditUser;
use Illuminate\Http\Request;
use App\Models\TransactionBuys;
use App\Models\Card;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BuysController extends Controller
{


    public function buyCard(Card $card){
        $User = Auth::id();
        TransactionBuys::create([
            'card_id' => $card->id,
            'user_id_seller' => $card->users()->first()->id,
            'user_id_buyer' => $User,
            'price' => $card->price,
            'date_transaction' => now(),
            'scheduled' => false
        ]);
        if($card->users()->first()->id){
            CardUser::where('user_id', $card->users()->first()->id)
                    ->where('card_id', $card->id)
                    ->update(['user_id' => $User]);
        } else {
            CardUser::create([
               'card_id' =>  $card->id,
                'user_id' => $User
            ]);
        }
        $creditUser = User::find($User);
        $credit = $creditUser->credit['credit'];
        CreditUser::find($creditUser->credit['id'])->update(['credit' => $credit - $card->price]);

        return view('showcard', ['card' => $card]);
    }


}
