<?php

namespace App\Http\Controllers;

use App\Models\CardUser;
use App\Models\CreditUser;
use App\Models\ScheduledBuys;
use App\Models\TransactionBuys;
use App\Models\Card;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BuysController extends Controller
{


    public function buyCard(Card $card){
        $User = Auth::id();
        //Check if card has owner or is property of Bank of cards
        if(count($card->users()->get()) > 0) {
            $seller = $card->users()->first()->id;
        } else {
            $seller = 0;
        }
        TransactionBuys::create([
            'card_id' => $card->id,
            'user_id_seller' => $seller,
            'user_id_buyer' => $User,
            'price' => $card->price,
            'date_transaction' => now(),
            'scheduled' => false
        ]);
        //if exists seller, update the row - else create new row
        if($seller > 0){
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

    public function buyRandomCards(Request $request){
        $User = Auth::id();
        foreach(json_decode($request->cards) as $item){
            $card = Card::find($item->id);
            //Check if card has owner or is property of Bank of cards
            if(count($card->users()->get()) > 0) {
                $seller = $card->users()->first()->id;
            } else {
                $seller = 0;
            }
            TransactionBuys::create([
                'card_id' => $card->id,
                'user_id_seller' => $seller,
                'user_id_buyer' => $User,
                'price' => $card->price,
                'date_transaction' => now(),
                'scheduled' => false
            ]);
            //if exists seller, update the row - else create new row
            if($seller > 0){
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
        }

        return view('marketplace', ['cards' => Card::with('users')->with('attributes')->get()]);
    }

    public function scheduledPurchase(Request $request){
        $User = Auth::id();
        $request->validate([
            'card' => 'required',
            'dateTransaction' => 'required'
        ]);
        ScheduledBuys::create([
            'card_id' => $request->card,
            'user_id_buyer' => $User,
            'date_transaction' => $request->dateTransaction
        ]);
        return redirect('/marketplace');
    }


}
