<?php


namespace App\Tools;

use Illuminate\Support\Facades\DB;
use App\Models\Card;
use App\Models\CardUser;
use App\Models\CreditUser;
use App\Models\TransactionBuys;
use App\Models\User;

class RunScheduledBuys
{

    public function __invoke($x)
    {
        var_dump($x);
    }

    static function run()
    {
        $today = now()->format('Y-m-d');
        $purchases = DB::table('scheduled_buys')->whereDate('date_transaction', $today)->get();
        foreach ($purchases as $purchase) {
            $card = Card::find($purchase->card_id);
            //Check if card has owner or is property of Bank of cards
            if (count($card->users()->get()) > 0) {
                $seller = $card->users()->first()->id;
            } else {
                $seller = 0;
            }
            TransactionBuys::create([
                'card_id' => $card->id,
                'user_id_seller' => $seller,
                'user_id_buyer' => $purchase->user_id_buyer,
                'price' => $card->price,
                'date_transaction' => now(),
                'scheduled' => true
            ]);
            //if exists seller, update the row - else create new row
            if ($seller > 0) {
                CardUser::where('user_id', $card->users()->first()->id)
                    ->where('card_id', $card->id)
                    ->update(['user_id' => $purchase->user_id_buyer]);
            } else {
                CardUser::create([
                    'card_id' => $card->id,
                    'user_id' => $purchase->user_id_buyer
                ]);
            }
            $creditUser = User::find($purchase->user_id_buyer);
            $credit = $creditUser->credit['credit'];
            CreditUser::find($creditUser->credit['id'])->update(['credit' => $credit - $card->price]);
            DB::table('scheduled_buys')->whereDate('date_transaction', $today)->delete();
        }
    }
}
