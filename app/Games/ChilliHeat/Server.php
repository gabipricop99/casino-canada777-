<?php 
namespace VanguardLTE\Games\ChilliHeat
{
    include('CheckReels.php');
    class Server
    {
        public function get($request, $game, $userId) // changed by game developer
        {
            /*if( config('LicenseDK.APL_INCLUDE_KEY_CONFIG') != 'wi9qydosuimsnls5zoe5q298evkhim0ughx1w16qybs2fhlcpn' ) 
            {
                return false;
            }
            if( md5_file(base_path() . '/app/Lib/LicenseDK.php') != '3c5aece202a4218a19ec8c209817a74e' ) 
            {
                return false;
            }
            if( md5_file(base_path() . '/config/LicenseDK.php') != '951a0e23768db0531ff539d246cb99cd' ) 
            {
                return false;
            }
            $checked = new \VanguardLTE\Lib\LicenseDK();
            $license_notifications_array = $checked->aplVerifyLicenseDK(null, 0);
            if( $license_notifications_array['notification_case'] != 'notification_license_ok' ) 
            {
                $response = '{"responseEvent":"error","responseType":"error","serverResponse":"Error LicenseDK"}';
                exit( $response );
            }*/
            $response = '';
            \DB::beginTransaction();
            // $userId = \Auth::id();// changed by game developer
            if( $userId == null ) 
            {
            	$userId = 1;
            }
            $user = \VanguardLTE\User::lockForUpdate()->find($userId);
            $credits = $userId == 1 ? $request->action === 'doInit' ? 5000 : $user->balance : null;
            $slotSettings = new SlotSettings($game, $userId, $credits);
            $paramData = trim(file_get_contents('php://input'));
            $_obf_params = explode('&', $paramData);
            $slotEvent = [];
            foreach( $_obf_params as $_obf_param ) 
            {
                $_obf_arr = explode('=', $_obf_param);
                $slotEvent[$_obf_arr[0]] = $_obf_arr[1];
            }
            if( !isset($slotEvent['action']) ) 
            {
                return '';
            }
            $slotEvent['slotEvent'] = $slotEvent['action'];
            if( $slotEvent['slotEvent'] == 'update' ) 
            {
                $Balance = $slotSettings->GetBalance();
                $response = 'balance=' . $Balance . '&balance_cash=' . $Balance . '&balance_bonus=0.00&na=s&stime=' . floor(microtime(true) * 1000);
                exit( $response );
            }
            if( $slotEvent['slotEvent'] == 'doInit' ) 
            { 
                $lastEvent = $slotSettings->GetHistory();
                $_obf_StrResponse = '';
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'MoonValue', [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]);
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 25);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [6,7,4,2,8,9,8,5,6,7,8,6,7,3,9]);
                if( $lastEvent != 'NULL' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', $lastEvent->serverResponse->totalRespinGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', $lastEvent->serverResponse->currentRespinGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'MoonValue', $lastEvent->serverResponse->MoonValues);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->lines);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', $lastEvent->serverResponse->BonusMpl);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastEvent->serverResponse->LastReel);
                    $bet = $lastEvent->serverResponse->bet;
                }
                else
                {
                    $bet = $slotSettings->Bet[0];
                }
                $currentReelSet = 0;
                $spinType = 's';
                $currentMoonValue = $slotSettings->GetGameData($slotSettings->slotId . 'MoonValue');
                $strCurrentMoonValue = implode(',', $currentMoonValue);
                $CurrentMoonText = [];
                $sum = 0;
                for($i = 0; $i < count($currentMoonValue); $i++){
                    if($currentMoonValue[$i] > 0){
                        $CurrentMoonText[$i] = 'v';
                        $sum = $sum + $currentMoonValue[$i];
                    }else{
                        $CurrentMoonText[$i] = 'r';
                    }
                }
                $strMoonText = implode(',', $CurrentMoonText);
                $_obf_StrResponse = '';
                // -----* Bonus function check*-------                
                $slotSettings->SetGameData($slotSettings->slotId . 'IsWelcomeBonus', 0);
                if(null == $slotSettings->GetGameData($slotSettings->slotId . 'WelcomeBonusFreeSpin')){
                    $slotSettings->SetGameData($slotSettings->slotId . 'WelcomeBonusFreeSpin', 0);
                }                
                $freespinBonus = $slotSettings->GetGameData($slotSettings->slotId . 'WelcomeBonusFreeSpin');
                $freespin = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                $freespin = $freespin - $freespinBonus;
                if($freespin < 0){
                    $freespin = 0;
                }
                $leftFreeSpin = $slotSettings->GetBonusFreeSpin();
                if($leftFreeSpin > 0){
                    $bet = $slotSettings->Bet[0];
                    $slotSettings->SetGameData($slotSettings->slotId . 'IsWelcomeBonus', 1);
                    if($slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') == 0){
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 1);
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 1);
                }
                $freespin = $freespin + $leftFreeSpin;
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $freespin);
                // -----**-------
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                {
                    $_obf_StrResponse = $_obf_StrResponse . '&fs=' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .  '&fsres=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&tw=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&w=0.00&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . '';
                    $currentReelSet = 1;
                }
                if($slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') < $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames')){
                    $currentReelSet = 0;
                    $spinType = 'b';
                    
                    $_obf_StrResponse = $_obf_StrResponse . '&rsb_s=11,12&bgid=0&rsb_m='.$slotSettings->GetGameData($slotSettings->slotId . 'RespinGames').'&rsb_c='.$slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame').
                        '&bgt=11&end=0&bpw=' . $sum * $bet.'';
                }
                $lastReelStr = implode(',', $slotSettings->GetGameData($slotSettings->slotId . 'LastReel'));
                $Balance = $slotSettings->GetBalance();
                
                $response = 'def_s=6,7,4,2,8,9,8,5,6,7,8,6,7,3,9&balance='. $Balance .'&cfgs=1&ver=2&mo_s=11&index=1&balance_cash='. $Balance .'&reel_set_size=2&def_sb=6,10,3,7,6&mo_v=25,50,75,100,125,150,175,200,250,350,400,450,500,600,750,2500&def_sa=3,7,6,11,9&mo_jp=750;2500;25000&balance_bonus=0.00&na='. $spinType.'&scatters=1~0,0,1,0,0~0,0,8,0,0~1,1,1,1,1&gmb=0,0,0&rt=d&gameInfo={props:{max_rnd_sim:"1",max_rnd_hr:"6289308",max_rnd_win:"1100"}}&mo_jp_mask=jp3;jp2;jp1&stime=' . floor(microtime(true) * 1000) .'&sa=3,7,6,11,9&sb=6,10,3,7,6&sc='. implode(',', $slotSettings->Bet) .'&defc=0.01&sh=3&wilds=2~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&n_reel_set='.$currentReelSet.$_obf_StrResponse.'&mo='.$strCurrentMoonValue.'&mo_t='.$strMoonText.'&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;200,50,10,0,0;150,30,5,0,0;125,25,5,0,0;100,25,5,0,0;50,10,5,0,0;50,10,5,0,0;50,10,5,0,0;50,10,5,0,0;0,0,0,0,0;0,0,0,0,0&l=25&rtp=96.50&reel_set0=3,7,6,11,9,7,4,4,9,10,10,5,5,10,7,8,8,11,6,3,6,6~4,9,6,1,9,10,8,5,5,8,3,4,8,9,4,1,7,2,2,2,2,2,10,9,6,11,11,11~10,8,6,8,1,2,2,2,2,2,2,3,5,11,11,11,8,4,11,8,2,10,9,3,7,2,8,4,5,6,1~3,7,11,11,11,3,5,10,8,7,8,7,2,2,2,2,2,2,2,2,1,9,10,6,6,10,4,7,4,3,5,11,8,6,9,1,2,7~6,10,3,7,6,5,3,4,11,11,11,8,8,4,5,3,6,10,2,2,2,2,7,9,10,7,7,10,9,5,4,6,11&s='.$lastReelStr.'&reel_set1=5,6,5,11,4,6,6,11,3,3,4~3,5,6,6,11,11,11,2,2,2,11,4,3,5,4,2,1,3~6,2,2,2,2,6,4,4,5,6,4,1,5,2,11,11,11,2,3,5,11~4,5,1,5,6,11,11,11,2,2,2,3,6,3,4,4,1,11,5,2~2,2,2,6,5,4,3,2,6,3,6,3,11,5,6,4';
            }
            else if( $slotEvent['slotEvent'] == 'doCollect' || $slotEvent['slotEvent'] == 'doCollectBonus') 
            {
                $Balance = $slotSettings->GetBalance();
                $response = 'balance=' . $Balance . '&index=' . $slotEvent['index'] . '&balance_cash=' . $Balance . '&balance_bonus=0.00&na=s&stime=' . floor(microtime(true) * 1000) . '&na=s&sver=5&counter=' . ((int)$slotEvent['counter'] + 1);
            }
            else if( $slotEvent['slotEvent'] == 'doSpin' ) 
            {
                
                $lastEvent = $slotSettings->GetHistory();
                $linesId = [];
                $linesId[0] = [
                    2, 
                    2, 
                    2, 
                    2, 
                    2
                ];
                $linesId[1] = [
                    1, 
                    1, 
                    1, 
                    1, 
                    1
                ];
                $linesId[2] = [
                    3, 
                    3, 
                    3, 
                    3, 
                    3
                ];
                $linesId[3] = [
                    1, 
                    2, 
                    3, 
                    2, 
                    1
                ];
                $linesId[4] = [
                    3, 
                    2, 
                    1, 
                    2, 
                    3
                ];
                $linesId[5] = [
                    2, 
                    1, 
                    1, 
                    1, 
                    2
                ];
                $linesId[6] = [
                    2, 
                    3, 
                    3, 
                    3, 
                    2
                ];
                $linesId[7] = [
                    1, 
                    1, 
                    2, 
                    3, 
                    3
                ];
                $linesId[8] = [
                    3, 
                    3, 
                    2, 
                    1, 
                    1
                ];
                $linesId[9] = [
                    2, 
                    3, 
                    2, 
                    1, 
                    2
                ];
                $linesId[10] = [
                    2, 
                    1, 
                    2, 
                    3, 
                    2
                ];
                $linesId[11] = [
                    1, 
                    2, 
                    2, 
                    2, 
                    1
                ];
                $linesId[12] = [
                    3, 
                    2, 
                    2, 
                    2, 
                    3
                ];
                $linesId[13] = [
                    1, 
                    2, 
                    1, 
                    2, 
                    1
                ];
                $linesId[14] = [
                    3, 
                    2, 
                    3, 
                    2, 
                    3
                ];
                $linesId[15] = [
                    2, 
                    2, 
                    1, 
                    2, 
                    2
                ];
                $linesId[16] = [
                    2, 
                    2, 
                    3, 
                    2, 
                    2
                ];
                $linesId[17] = [
                    1, 
                    1, 
                    3, 
                    1, 
                    1
                ];
                $linesId[18] = [
                    3, 
                    3, 
                    1, 
                    3, 
                    3
                ];
                $linesId[19] = [
                    1, 
                    3, 
                    3, 
                    3, 
                    1
                ];
                $linesId[20] = [
                    3, 
                    1, 
                    1, 
                    1, 
                    3
                ];
                $linesId[21] = [
                    2, 
                    3, 
                    1, 
                    3, 
                    2
                ];
                $linesId[22] = [
                    2, 
                    1, 
                    3, 
                    1, 
                    2
                ];
                $linesId[23] = [
                    1, 
                    3, 
                    1, 
                    3, 
                    1
                ];
                $linesId[24] = [
                    3, 
                    1, 
                    3, 
                    1, 
                    3
                ];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422 = [];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[0] = [
                    0, 
                    5, 
                    10
                ];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[1] = [
                    1, 
                    6, 
                    11
                ];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[2] = [
                    2, 
                    7, 
                    12
                ];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[3] = [
                    3, 
                    8, 
                    13
                ];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[4] = [
                    4, 
                    9, 
                    14
                ];
                $slotEvent['slotBet'] = $slotEvent['c'];
                $slotEvent['slotLines'] = 25;
                $isWelcomeFreespin = $slotSettings->GetGameData($slotSettings->slotId . 'IsWelcomeBonus');
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') <= $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                {
                    $slotEvent['slotEvent'] = 'freespin';
                }
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') < $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') && $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') > 0 ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                    exit( $response );
                }
                $lines = $slotEvent['slotLines'];
                $betline = $slotEvent['slotBet'];
                if( $slotEvent['slotEvent'] == 'doSpin' || $slotEvent['slotEvent'] == 'freespin' ) 
                {
                    if( $lines <= 0 || $betline <= 0.0001 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid bet state"}';
                        exit( $response );
                    }
                    if($isWelcomeFreespin == 0){
                        if( $slotEvent['slotEvent'] == 'doSpin' && $slotSettings->GetBalance() < ($lines * $betline) ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid balance"}';
                            exit( $response );
                        }
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') < $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotEvent['slotEvent'] == 'freespin' ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                            exit( $response );
                        }
                        if($slotEvent['slotEvent'] == 'freespin'){
                            if ($lastEvent->serverResponse->bet != $betline){
                                $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid Bets"}';
                            exit( $response );
                            }
                        }
                    }
                }
                if($isWelcomeFreespin == 1){
                    $welcomeBonusFreespin = $slotSettings->UpdateBonusFreeSpin();
                    $slotSettings->SetGameData($slotSettings->slotId . 'WelcomeBonusFreeSpin', $welcomeBonusFreespin);
                    if($welcomeBonusFreespin <= 0){
                        $slotSettings->SetGameData($slotSettings->slotId . 'IsWelcomeBonus', 0);
                    }
                }
                $_spinSettings = $slotSettings->GetSpinSettings($slotEvent['slotEvent'], $betline * $lines, $lines);
                $winType = $_spinSettings[0];
                $_winAvaliableMoney = $_spinSettings[1];
                if($slotEvent['slotEvent'] == 'freespin'){
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                }
                else
                {
                    $slotEvent['slotEvent'] = 'bet';
                    $slotSettings->SetBalance(-1 * ($betline * $lines), $slotEvent['slotEvent']);
                    $_sum = ($betline * $lines) / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), $_sum, $slotEvent['slotEvent']);
                    $bonusMpl = 1;
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                }
                $Balance = $slotSettings->GetBalance();
                if( $slotEvent['slotEvent'] != 'bet' ) 
                {
                    $slotSettings->UpdateJackpots($betline * $lines);
                }
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $totalWin = 0;
                    $lineWins = [];
                    $lineWinNum = [];
                    $wild = '2';
                    $scatter = '1';
                    $moonsymbol = '11';
                    $_obf_winCount = 0;
                    $strWinLine = '';
                    $_moonValue = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                    $reels = $slotSettings->GetReelStrips($winType, $slotEvent['slotEvent']);
                    // if($slotEvent['slotEvent'] == 'freespin'){
                    //     $ele = $reels['reel3'][0];
                    //     if ($ele == $scatter){
                    //         $ele = 3;
                    //     }
                    //     for($k = 0; $k < 3; $k++){
                    //         $reels['reel2'][$k] = $ele;
                    //         $reels['reel3'][$k] = $ele;
                    //         $reels['reel4'][$k] = $ele;
                    //     }
                    // }
                    $_lineWinNumber = 1;
                    for( $k = 0; $k < $lines; $k++ ) 
                    {
                        $_lineWin = '';
                        $firstEle = $reels['reel1'][$linesId[$k][0] - 1];
                        $lineWinNum[$k] = 1;
                        $lineWins[$k] = 0;
                        for($j = 1; $j < 5; $j++){
                            $ele = $reels['reel'. ($j + 1)][$linesId[$k][$j] - 1];
                            if($firstEle == $wild){
                                $firstEle = $ele;
                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                            }else if($ele == $firstEle || $ele == $wild){
                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                if($j == 4){
                                    $lineWins[$k] = $slotSettings->Paytable[$firstEle][$lineWinNum[$k]] * $betline;
                                    if($lineWins[$k] > 0){
                                        $totalWin += $lineWins[$k];
                                        $_obf_winCount++;
                                        $strWinLine = $strWinLine . '&l'. ($_obf_winCount - 1).'='.$k.'~'.$lineWins[$k];
                                        for($kk = 0; $kk < $lineWinNum[$k]; $kk++){
                                            $strWinLine = $strWinLine . '~' . (($linesId[$k][$kk] - 1) * 5 + $kk);
                                        }
                                    }
                                }
                            }else{
                                if($slotSettings->Paytable[$firstEle][$lineWinNum[$k]] > 0){
                                    $lineWins[$k] = $slotSettings->Paytable[$firstEle][$lineWinNum[$k]] * $betline;
                                    if($lineWins[$k] > 0){
                                        $totalWin += $lineWins[$k];
                                        $_obf_winCount++;
                                        $strWinLine = $strWinLine . '&l'. ($_obf_winCount - 1).'='.$k.'~'.$lineWins[$k];
                                        for($kk = 0; $kk < $lineWinNum[$k]; $kk++){
                                            $strWinLine = $strWinLine . '~' . (($linesId[$k][$kk] - 1) * 5 + $kk);
                                        }   
                                    }

                                }else{
                                    $lineWinNum[$k] = 0;
                                }
                                break;
                            }
                        }
                    }
                    
                    
                    $_obf_scatterposes = [];
                    $scattersCount = 0;
                    $moonCount = 0;
                    $scattersWin = 0;
                    $moonTotalWin = 0;
                    $moonChangedWin = false;
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = '';
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        for( $k = 0; $k <= 2; $k++ ) 
                        {
                            if( $reels['reel' . $r][$k] == $scatter ) 
                            {
                                $scattersCount++;
                                array_push($_obf_scatterposes, $k * 5 + $r - 1);
                            }
                            if( $reels['reel' . $r][$k] == $moonsymbol ) 
                            {
                                $moonCount++;
                            }
                        }
                    }
                    
                    for($r = 0; $r <= 2; $r++){
                        for( $k = 0; $k < 5; $k++ ) 
                        {
                            if( $reels['reel' . ($k+1)][$r] == $moonsymbol) 
                            {
                                if($_moonValue[$r * 5 + $k] == 0){
                                    $_moonValue[$r * 5 + $k] = $slotSettings->GetMoonWin();
                                    $moonChangedWin = true;
                                }
                                $moonTotalWin = $moonTotalWin + $_moonValue[$r * 5 + $k] * $betline;
                            }
                        }
                    }
                    // if($moonCount >= 6){
                    //     break;
                    // }
                    if( $i > 1000 ) 
                    {
                        $winType = 'none';
                    }
                    if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($lines * $betline * rand(2, 5)) ) 
                    {
                    }
                    else if( !$slotSettings->increaseRTP && $winType == 'win' && $lines * $betline < $totalWin ) 
                    {
                    }
                    else
                    {
                        if( $i > 1500 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                            exit( $response );
                        }
                        if( $scattersCount >= 3 && $winType != 'bonus' ) 
                        {
                        }
                        else if($moonCount >= 6 && $slotEvent['slotEvent'] == 'freespin'){                            
                        }
                        else if( $moonCount >= 6 && $winType == 'win' && rand(0, 100) > 80)
                        {
                            $_obf_0D163F390C080D0831380D161E12270D0225132B261501 = $slotSettings->GetBank('bonus');
                            if($lines * $betline * 500 < $_obf_0D163F390C080D0831380D161E12270D0225132B261501){
                                break;
                            }
                        }
                        else if( $totalWin <= $_winAvaliableMoney && $winType == 'bonus' ) 
                        {
                            $_obf_0D163F390C080D0831380D161E12270D0225132B261501 = $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''));
                            if( $_obf_0D163F390C080D0831380D161E12270D0225132B261501 < $_winAvaliableMoney ) 
                            {
                                $_winAvaliableMoney = $_obf_0D163F390C080D0831380D161E12270D0225132B261501;
                            }
                            else
                            {
                                if($moonTotalWin + $totalWin < $_winAvaliableMoney){
                                    break;
                                }
                            }
                        }
                        else if( $totalWin > 0 && $totalWin <= $_winAvaliableMoney && $winType == 'win' ) 
                        {
                            $_obf_0D163F390C080D0831380D161E12270D0225132B261501 = $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''));
                            if( $_obf_0D163F390C080D0831380D161E12270D0225132B261501 < $_winAvaliableMoney ) 
                            {
                                $_winAvaliableMoney = $_obf_0D163F390C080D0831380D161E12270D0225132B261501;
                            }
                            else
                            {
                                break;
                            }
                        }
                        else if( $totalWin == 0 && $winType == 'none' ) 
                        {
                            break;
                        }
                    }
                }
                $spinType = 's';
                $isEndRespin = false;
                if( $moonCount >= 6 && $slotEvent['slotEvent'] != 'respin') // && $slotEvent['slotEvent'] != 'freespin'
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 1);
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', $slotSettings->slotRespinCount);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                }
                if( $totalWin > 0) 
                {
                    $spinType = 'c';
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), -1 * $totalWin);
                    if($isWelcomeFreespin == 1){
                        $slotSettings->SetWelcomeBonus($totalWin);
                    }
                }
                $_obf_totalWin = $totalWin;
                if( $scattersCount >= 3 ) 
                {
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') == 0 ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->slotFreeCount);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 1);
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $slotSettings->slotFreeCount);
                    }
                }
                
                for($k = 0; $k < 3; $k++){
                    for($j = 1; $j <= 5; $j++){
                        $lastReel[($j - 1) + $k * 5] = $reels['reel'.$j][$k];
                    }
                }
                $strLastReel = implode(',', $lastReel);
                $strReelSa = $reels['reel1'][3].','.$reels['reel2'][3].','.$reels['reel3'][3].','.$reels['reel4'][3].','.$reels['reel5'][3];
                $strReelSb = $reels['reel1'][-1].','.$reels['reel2'][-1].','.$reels['reel3'][-1].','.$reels['reel4'][-1].','.$reels['reel5'][-1];
                $strCurrentMoonValue = implode(',', $_moonValue);
                $CurrentMoonText = [];
                for($i = 0; $i < count($_moonValue); $i++){
                    if($_moonValue[$i] > 0){
                        $CurrentMoonText[$i] = 'v';
                    }else{
                        $CurrentMoonText[$i] = 'r';
                    }
                }
                $strMoonText = implode(',', $CurrentMoonText);
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                $slotSettings->SetGameData($slotSettings->slotId . 'MoonValue', $_moonValue);
                if( $slotEvent['slotEvent'] == 'freespin' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    $spinType = 's';
                    $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                    $n_reel_set = '&n_reel_set=1';
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                    {
                        $spinType = 'c&fs_total='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fswin_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsmul_total=1&fsres_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                        $n_reel_set = '&n_reel_set=0';
                    }
                    else
                    {
                        $spinType = 's&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                    }
                    if($moonCount >= 6){
                        $spinType = 'b';
                        $n_reel_set = '&rsb_s=11,12&bgid=0&rsb_m='.$slotSettings->GetGameData($slotSettings->slotId . 'RespinGames').'&rsb_c='.$slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame').'&bgt=11&end=0&bw=1&bpw='.$moonTotalWin.'';
                    }
                    $response = 'tw='. $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .'&balance='.$Balance.'&mo='.$strCurrentMoonValue.'&mo_t='.$strMoonText. '&index='. $slotEvent['index'] . '&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$n_reel_set.$strWinLine .'&stime=' . floor(microtime(true) * 1000).'&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=3'.
                        '&c='.$betline.'&sver=5&counter='. ((int)$slotEvent['counter'] + 1) .'&l=25&s='.$strLastReel.'&w='.$totalWin.'';
                }else
                {
                    // $_obf_0D5C3B1F210914123C222630290E271410213E320B0A11 = $totalWin;
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                    $n_reel_set = '';
                    if($scattersCount >=3 ){
                        $spinType = 's';
                        $n_reel_set = '&n_reel_set=1&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&fswin=0.00&fs=1&fsres=0.00&psym=1~'.$totalWin.'~'.implode(',', $_obf_scatterposes);
                    }else if($moonCount >= 6){
                        $spinType = 'b';
                        $n_reel_set = '&n_reel_set=0&rsb_s=11,12&bgid=0&rsb_m='.$slotSettings->GetGameData($slotSettings->slotId . 'RespinGames').'&rsb_c='.$slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame').'&bgt=11&end=0&bw=1&bpw='.$moonTotalWin.'';
                    }else{
                        $n_reel_set = '&n_reel_set=0';
                    }
                    if($moonTotalWin > 0){
                        $n_reel_set = $n_reel_set . '&mo='.$strCurrentMoonValue.'&mo_t='.$strMoonText;
                    }
                    $response = 'tw='.$totalWin.'&balance='.$Balance.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinLine.'&stime=' . floor(microtime(true) * 1000) .
                        '&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=3&c='.$betline.'&sver=5'.$n_reel_set.'&counter='. ((int)$slotEvent['counter'] + 1) .'&l=25&s='.$strLastReel.'&w='.$totalWin;
                }


                if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0) || $isEndRespin ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    if(!$isEndRespin){
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    }else{
                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                    }
                }
                

                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . 
                    ',"totalRespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') . ',"currentRespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') . ',"Balance":' . $Balance . 
                    ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . 
                    ',"MoonValues":'.json_encode($_moonValue).',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $_obf_totalWin, $slotEvent['slotEvent']);
                
                if( $scattersCount >= 3 || ($slotEvent['slotEvent']!='respin' && $moonCount >= 6) ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $Balance);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                }
            }
            else if( $slotEvent['slotEvent'] == 'doBonus' ){
                $lastEvent = $slotSettings->GetHistory();
                $betline = $lastEvent->serverResponse->bet;
                $lines = 25;
                $moonsymbol = '11';
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') < $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') && $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') > 0 ) 
                {
                    $slotEvent['slotEvent'] = 'respin';
                }
                if( $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') < $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') && $slotEvent['slotEvent'] == 'respin' ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                    exit( $response );
                }

                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') + 1);
                $bonusMpl = $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                $Balance = $slotSettings->GetBalance();
                $slotSettings->UpdateJackpots($betline * $lines);

                // $_obf_winType = rand(1, $slotSettings->GetGambleSettings());
                $_obf_winType = rand(0, 1);
                for($i = 0; $i < 2000; $i++){
                    $moonTotalWin = 0;
                    $moonChangedWin = false;
                    $moonCount = 0;
                    $lastReel = $slotSettings->GetGameData($slotSettings->slotId . 'LastReel');
                    $_moonValue = $slotSettings->GetGameData($slotSettings->slotId . 'MoonValue');
                    for($k = 0; $k < count($lastReel); $k++){
                        if($lastReel[$k] != $moonsymbol){
                            if(rand(0, 100) < $slotSettings->base_moon_chance && $_obf_winType == 1){
                                $lastReel[$k] = $moonsymbol;
                            }
                        }
                        if($_moonValue[$k] == 0 && $lastReel[$k] == $moonsymbol){
                            $_moonValue[$k] = $slotSettings->GetMoonWin();
                            $moonChangedWin = true;
                        }
                        if($_moonValue[$k] > 0){
                            $moonTotalWin = $moonTotalWin + $_moonValue[$k] * $betline;
                            $moonCount++;
                        }
                    }
                    if( $_obf_winType== 0 && $slotEvent['slotEvent'] == 'respin' &&  $moonChangedWin == false){
                        break;
                    }
                    else if( $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : '')) > $moonTotalWin ) 
                    {
                        break;
                    }
                    else if($i > 500){
                        $_obf_winType = 0;
                    }

                }
                
                
                $isEndRespin = false;
                $totalWin = 0;
                if($moonChangedWin == true && $moonCount < 15){
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                }else{
                    // $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') + 1);
                    if($moonCount==15 || ($slotSettings->GetGameData($slotSettings->slotId . 'RespinGames')<= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') && $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') > 0)){
                        $isEndRespin = true;
                        $totalWin = $moonTotalWin;
                        $moonTotalWin = 0;
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 3);
                    }
                }
                $strLastReel = implode(',', $lastReel);
                $strCurrentMoonValue = implode(',', $_moonValue);
                $CurrentMoonText = [];
                for($i = 0; $i < count($_moonValue); $i++){
                    if($_moonValue[$i] > 0){
                        $CurrentMoonText[$i] = 'v';
                    }else{
                        $CurrentMoonText[$i] = 'r';
                    }
                }
                $strMoonText = implode(',', $CurrentMoonText);

                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                $slotSettings->SetGameData($slotSettings->slotId . 'MoonValue', $_moonValue);
                $spinType = 'b';
                if($isEndRespin == true){
                    $spinType = 'cb&tw='. $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .'&rw='.$totalWin.'';
                }
                $response = 'rsb_s=11,12&bgid=0&rsb_m='.$slotSettings->GetGameData($slotSettings->slotId . 'RespinGames').'&balance='.$Balance.'&rsb_c='.$slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame').'&mo='.$strCurrentMoonValue.
                    '&mo_t='.$strMoonText.'&index='. $slotEvent['index'] . '&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.'&stime=' . floor(microtime(true) * 1000) .'&bgt=11&end=0&sver=5&bpw='.$moonTotalWin.'&counter='. ((int)$slotEvent['counter'] + 1) .'&s='.$strLastReel.'';
                    
                if($isEndRespin == true) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    if( $totalWin > 0) 
                    {
                        $slotSettings->SetBalance($totalWin);
                        $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), -1 * $totalWin);
                    }
                }
                

                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . 
                    ',"totalRespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') . ',"currentRespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') . ',"Balance":' . $Balance . 
                    ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . 
                    ',"MoonValues":'.json_encode($_moonValue).',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $totalWin, $slotEvent['slotEvent']);
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
