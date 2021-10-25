
function gigadatListener(\Illuminate\Http\Request $request)
{
    Log::channel('payment')->info('***Gigadat Listener***', ['request' => $request]);
    $transaction = $request->post('transactionId');
    $status = $request->get('status');
    $userId = $request->post('userId');
    $amount = $request->post('amount');
    $type = $request->post('type');
    $email = $request->post('email');
    $phone = $request->post('mobile');
    $ip = $request->post('userIp');

    $user = \VanguardLTE\User::where('id', $userId)->first();
    if (!$user) {
        return response()->json(['error' => true, 'msg' => trans('app.wrong_user')], 200);
    }
    $curTransaction = \VanguardLTE\Transaction::where(['user_id'=> $userId, 'transaction' => $transaction, 'status' => -1])->first();
    if (!$curTransaction) {
        return response()->json(['error' => true, 'msg' => trans('app.wrong_transaction')], 200);
    }
    if ($status == 'STATUS_INITED') {
    }
    else if ($status == 'STATUS_PENDING') {
    }
    else if ($status == 'STATUS_SUCCESS') {
        if ($type == 'CPI') {
            // $deposit_count = \VanguardLTE\Transaction::leftjoin('users', 'transactions.user_id', '=', 'users.id')->where(['users.visitor_id'=>$user->visitor_id, 'type'=>'in', 'transactions.status' => '1'])->count();
            $deposit_count = \VanguardLTE\Transaction::where(['user_id'=>$user->id, 'type'=>'in'])->count();
            $user->increment('balance', $amount);
            $user->increment('count_balance', $amount);
            switch ($deposit_count) {
                case 1:
                    $welcomepackages = \VanguardLTE\WelcomePackage::leftJoin('games', function ($join)
                                                        {
                                                            $join->on('games.original_id','=','welcomepackages.game_id');
                                                            $join->on('games.id','=','games.original_id');
                                                        })->select('welcomepackages.*', 'games.name')->get();
                    foreach ($welcomepackages as $welcomepackage) {
                        $welcomepackagelog = \VanguardLTE\WelcomePackageLog::create([
                            'user_id' => $userId,
                            'day' => $welcomepackage->day,
                            'freespin' => $welcomepackage->freespin,
                            'remain_freespin' => $welcomepackage->freespin,
                            'game_id' => $welcomepackage->game_id,
                            'max_bonus' => 20,
                            'started_at' => date('Y-m-d', strtotime('+'.($welcomepackage->day-1).' days'))
                        ]);
                    }
                    app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatch(new \VanguardLTE\Jobs\GetFreespinJob($user));
                case 2:
                case 3:
                    $bonus = \VanguardLTE\Bonus::where('deposit_num', $deposit_count + 1)->first();
                    if ($bonus) {
                        $bonus_amount = $bonus->bonus;
                        if ($amount < $bonus_amount)
                            $bonus_amount = $amount;
                        if ($amount < 10)
                            break;
                        $user->increment('balance', $bonus_amount);
                        $user->increment('bonus', $bonus_amount);
                        $user->increment('count_bonus', $bonus_amount);
                        $user->increment('wager', $bonus_amount * 70);

                        \VanguardLTE\BonusLog::create([
                            'user_id' => $userId,
                            'deposit_num' => $deposit_count + 1,
                            'deposit' => $amount,
                            'bonus' => $bonus_amount,
                            'wager' => $bonus_amount * 70,
                            'wager_played' => 0
                        ]);
                    }
                    break;
            }
            app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatch(new \VanguardLTE\Jobs\DepositSuccessedJob($curTransaction));
        }
        else if ($type == 'ETO') {

        }
        $curTransaction->status = 1;
        $curTransaction->save();
    }
    else if ($status == 'STATUS_REJECTED' || $status == 'STATUS_ABORTED'){
        $statNum = $status == 'STATUS_REJECTED' ? -2 : -4;
        if ($type == 'CPI') {
            app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatch(new \VanguardLTE\Jobs\DepositFailedJob($user));
        }
        else if ($type == 'ETO') {

        }
        $curTransaction->status = $statNum;
        $curTransaction->save();
        /* if transaction is not confirmed, send message to user.  */

        /* --- */
    }
    else if ($status == 'STATUS_ERROR') {
        app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatch(new \VanguardLTE\Jobs\DepositFailedJob($user));
        // $user->notify(new \VanguardLTE\Notifications\DepositFailed($user));
        $curTransaction->status = -5;
        $curTransaction->save();
    }

    return response()->json(['error' => false, 'msg' => trans('app.success')], 200);
}