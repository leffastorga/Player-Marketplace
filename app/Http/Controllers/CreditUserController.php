<?php

namespace App\Http\Controllers;

use App\Models\CreditUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreditUserController extends Controller
{


    public function updateCredit(Request $request, $id)
    {

        $request->validate([
            'credit' => 'required|numeric|min:0|max:999'
        ]);
        $creditUser = CreditUser::find($id);
        $creditUser->update([
           'credit' => $request->credit
        ]);

        return redirect('/my-account');
    }


}
