<?php 
namespace VanguardLTE\Games\GreatRhinoPM
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
            if( $slotEvent['slotEvent'] == 'doInit' ) 
            { 
                $lastEvent = $slotSettings->GetHistory();
                $_obf_StrResponse = '';
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 20);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [6,9,8,4,7,7,3,4,11,11,10,11,6,5,10]);
                if( $lastEvent != 'NULL' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', $lastEvent->serverResponse->totalRespinGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', $lastEvent->serverResponse->currentRespinGames);
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
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') <= $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                {
                    $_obf_StrResponse = '&fs=' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .  '&fsres=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&tw=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&w=0.00&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . '';
                    $currentReelSet = 1;
                }else if($slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') < $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames')){
                    $currentReelSet = 0;
                    $spinType = 'b';
                    
                    $_obf_StrResponse = '&bgid=0&rsb_m='.$slotSettings->GetGameData($slotSettings->slotId . 'RespinGames').'&rsb_c='.$slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame').
                        '&bgt=26&end=0&bpw=0.00';
                }
                $lastReel = $slotSettings->GetGameData($slotSettings->slotId . 'LastReel');
                if($spinType != 'b'){
                    for($k = 0; $k < count($lastReel); $k++){
                        if($lastReel[$k] == 13){
                            $lastReel[$k] = rand(4, 10);
                        }
                    }
                }
                $lastReelStr = implode(',', $lastReel);
                $Balance = $slotSettings->GetBalance();
                
                $response = 'def_s=6,9,8,4,7,7,3,4,11,11,10,11,6,5,10&balance='. $Balance .'&cfgs=1&ver=2&index=1&balance_cash='.$Balance.
                    '&reel_set_size=2&def_sb=8,4,2,8,7&def_sa=5,7,3,3,3&bonusInit=[{bgid:0,bgt:26,bg_i:"375,500",bg_i_mask:"psw,psw"}]&balance_bonus=0.00&na='. $spinType.'&scatters=1~0,0,2,0,0~0,0,10,0,0~1,1,1,1,1&gmb=0,0,0&bg_i=375,500&rt=d&gameInfo={props:{max_rnd_sim:"1",max_rnd_hr:"39370078",max_rnd_win:"800"}}&stime=' . floor(microtime(true) * 1000) .
                    '&sa=5,7,3,3,3&sb=8,4,2,8,7&sc='. implode(',', $slotSettings->Bet) .'&defc=0.01&sh=3&wilds=2~500,150,50,4,0~1,1,1,1,1;14~500,150,50,4,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.
                    '&sver=5&n_reel_set='.$currentReelSet.$_obf_StrResponse.'&bg_i_mask=psw,psw&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;400,150,50,2,0;200,50,15,0,0;150,40,10,0,0;100,30,10,0,0;50,25,10,0,0;25,10,5,0,0;20,10,5,0,0;20,10,5,0,0;20,10,5,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0&l='.$slotSettings->GetGameData($slotSettings->slotId . 'Lines') .'&rtp=96.53&reel_set0=5,7,3,3,3,11,11,4,9,2,2,10,7,8,9,4,10,5,9,11,10,7,5,6,8,3,10,10,9~11,8,10,3,3,3,11,9,11,4,7,4,2,2,7,10,10,11,1,8,6,8,11,3,5,6,3~4,10,3,3,3,11,9,10,6,7,11,7,2,2,8,4,8,3,6,9,10,9,1,5,2,2,3,5,9,2,2,8,8~8,7,7,9,9,9,2,2,11,10,1,9,6,5,4,5,8,8,10,4,3,3,3,11,11,6,2,2,11~8,4,2,2,8,7,6,3,3,3,11,10,8,11,4,10,11,9,3,10,5,10,9,6,9,9,7,5,7&s='.$lastReelStr.'&reel_set1=9,10,10,11,2,2,9,10,14,14,9,11,8,5,9,5,11,9,7,6,7,14,14,7,10,4~8,8,14,14,11,11,5,4,6,14,14,11,5,7,10,10,6,11,10,4,9,2,2,9~8,2,2,14,14,10,7,9,11,8,10,9,14,14,9,7,4,6,6,5,7,10~2,2,14,14,11,6,7,4,5,10,14,14,6,11,9,8,7,8,9,8,4,6,10~11,14,14,7,9,11,7,5,5,4,9,9,10,6,2,2,14,14,7,11,8,6,8,10,9';
            }
            else if( $slotEvent['slotEvent'] == 'doCollect' || $slotEvent['slotEvent'] == 'doCollectBonus') 
            {
                $Balance = $slotSettings->GetBalance();
                $response = 'balance=' . $Balance . '&index=' . $slotEvent['index'] . '&balance_cash=' . $Balance . '&balance_bonus=0.00&na=s&stime=' . floor(microtime(true) * 1000) . '&na=s&sver=5&counter=' . ((int)$slotEvent['counter'] + 1);
            }
            else if( $slotEvent['slotEvent'] == 'doSpin' ) 
            {
                
                $lastEvent = $slotSettings->GetHistory();
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
                $slotEvent['slotLines'] = 20;
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
                $isWelcomeFreespin = $slotSettings->GetGameData($slotSettings->slotId . 'IsWelcomeBonus');
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
                    $cWins = [
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0
                    ];
                    $wild = '2';
                    $freewild = '14';
                    $scatter = '1';
                    $_obf_winCount = 0;
                    $strWinLine = '';
                    $reels = $slotSettings->GetReelStrips($winType, $slotEvent['slotEvent']);
                    
                    $_lineWinNumber = 1;
                    if($slotEvent['slotEvent'] == 'freespin'){
                        for( $k = 0; $k < $lines; $k++ ) 
                        {
                            $_lineWin = '';
                            $firstEle = $reels['reel1'][$linesId[$k][0] - 1];
                            $lineWinNum[$k] = 1;
                            $lineWins[$k] = 0;
                            for($j = 1; $j < 5; $j++){
                                $ele = $reels['reel'. ($j + 1)][$linesId[$k][$j] - 1];
                                if($firstEle == $wild || $firstEle == $freewild){
                                    $firstEle = $ele;
                                    $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                }else if($ele == $firstEle || $ele == $wild || $ele == $freewild){
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
                    }else{
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
                    }
                    
                    
                    
                    $_obf_scatterposes = [];
                    $scattersCount = 0;
                    $scattersWin = 0;
                    $respinCount = 0;
                    $_obf_respinposes = [];
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        for( $k = 0; $k <= 2; $k++ ) 
                        {
                            if( $reels['reel' . $r][$k] == $scatter ) 
                            {
                                $scattersCount++;
                                array_push($_obf_scatterposes, $k * 5 + $r - 1);
                            }
                        }
                        if($reels['reel' . $r][0] == '3' && $reels['reel' . $r][1] == '3' && $reels['reel' . $r][2] == '3'){
                            $respinCount++;
                            array_push($_obf_respinposes, $r);
                        }
                    }
                    if($scattersCount >= 3){
                        $scattersWin = 2 * $lines * $betline;
                    }
                    $totalWin = $totalWin + $scattersWin;
                    // if($rhinoCount >= 6){
                    //     break;
                    // }
                    if( $i > 1000 ) 
                    {
                        $winType = 'none';
                    }
                    // if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($lines * $betline * rand(2, 5)) ) 
                    // {
                    // }
                    // else if( !$slotSettings->increaseRTP && $winType == 'win' && $lines * $betline < $totalWin ) 
                    // {
                    // }
                    // else
                    // {
                        if( $i > 1500 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                            exit( $response );
                        }
                        if( $scattersCount >= 3 && $winType != 'bonus' ) 
                        {
                        }
                        else if($respinCount >= 2 && ($slotEvent['slotEvent']  == 'freespin' || $scattersCount >= 3)){

                        }
                        else if( $totalWin <= $_winAvaliableMoney && $winType == 'bonus' ) 
                        {
                            $_obf_CurrentAvaliableMoney = $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''));
                            if( $_obf_CurrentAvaliableMoney < $_winAvaliableMoney ) 
                            {
                                $_winAvaliableMoney = $_obf_CurrentAvaliableMoney;
                            }
                            else
                            {
                                break;
                            }
                        }
                        else if( $totalWin > 0 && $totalWin <= $_winAvaliableMoney && $winType == 'win' ) 
                        {
                            $_obf_CurrentAvaliableMoney = $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''));
                            if( $_obf_CurrentAvaliableMoney < $_winAvaliableMoney ) 
                            {
                                $_winAvaliableMoney = $_obf_CurrentAvaliableMoney;
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
                    // }
                }
                $spinType = 's';
                $isEndRespin = false;
                if( $respinCount >= 2 && $slotEvent['slotEvent'] != 'respin') 
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
                
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                $strFreeResponse = '';
                $spinType = 's';
                $isEnd = false;
                if( $slotEvent['slotEvent'] == 'freespin' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                    {
                        $spinType = 'c';
                        $isEnd = true;
                        $n_reel_set = '&n_reel_set=0';
                        $strFreeResponse = '&fs_total='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fswin_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsmul_total=1&fsres_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                    }
                    else
                    {
                        $n_reel_set = '&n_reel_set=1';
                        $strFreeResponse = '&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                    }
                }else
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                    $n_reel_set = '';
                    if($scattersCount >=3 ){
                        $spinType = 's';
                        $n_reel_set = '&n_reel_set=1';
                        $strFreeResponse = '&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&fswin=0.00&fs=1&fsres=0.00&psym=1~'.$totalWin.'~'.implode(',', $_obf_scatterposes);
                    }else{
                        $n_reel_set = '&n_reel_set=0';
                    }
                }
                $strRespinResponse = '';
                if($respinCount >= 2){
                    $spinType = 'b';
                    $strRespinResponse = '&bgid=0&rsb_m='.$slotSettings->GetGameData($slotSettings->slotId . 'RespinGames').'&rsb_c='.$slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame').'&bgt=26&end=0&bw=1&bpw=0';
                }
                if($isEnd == true){
                    $strFreeResponse = $strFreeResponse.'&w='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                }else{
                    $strFreeResponse = $strFreeResponse.'&w='.$totalWin;
                }

                $response = 'tw='. $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') .'&balance='.$Balance.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strFreeResponse.$strRespinResponse.$strWinLine.'&stime=' . floor(microtime(true) * 1000) .'&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=3&c='.$betline.'&sver=5'.$n_reel_set.'&counter='. ((int)$slotEvent['counter'] + 1) .'&l=20&s='.$strLastReel;

                if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0)) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                }
                if($respinCount < 2){
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                }else{
                    $lastReel = [];
                    for($k = 0; $k < 3; $k++){
                        for($j = 1; $j <= 5; $j++){
                            $isSame = false;
                            for($r = 0; $r < count($_obf_respinposes); $r++){
                                if($j == $_obf_respinposes[$r]){
                                    $isSame = true;
                                    break;
                                }
                            }
                            if($isSame == true){
                                $lastReel[($j - 1) + $k * 5] = 3;
                            }else{
                                $lastReel[($j - 1) + $k * 5] = 13;
                            }
                        }
                    }
                    
                    $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                }
 
                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . 
                    ',"totalRespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') . ',"currentRespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') . ',"Balance":' . $Balance . 
                    ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":'. $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') .',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . 
                    ',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $_obf_totalWin, $slotEvent['slotEvent']);
                
                if( $scattersCount >= 3 || ($slotEvent['slotEvent']!='respin' && $respinCount >= 2) ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $Balance);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                }
            }
            else if( $slotEvent['slotEvent'] == 'doBonus' ){
                $lastEvent = $slotSettings->GetHistory();
                $betline = $lastEvent->serverResponse->bet;
                $lines = 20;
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') < $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') && $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') > 0 ) 
                {
                    $slotEvent['slotEvent'] = 'respin';
                }else{
                    $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                    exit( $response );
                    // $test=1;
                }

                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') + 1);
                $bonusMpl = $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                $Balance = $slotSettings->GetBalance();
                $lastReel = $slotSettings->GetGameData($slotSettings->slotId . 'LastReel');
                $tempReels = [];
                for($i = 0; $i < 5; $i++){
                    $tempReels[$i] = [];
                    for($j = 0; $j < 3; $j++){
                        $tempReels[$i][$j] = $lastReel[$j * 5 + $i];
                    }
                }
                $_obf_winType = rand(0, 1);
                $rhinoSymbol = 3;
                for($i = 0; $i < 2000; $i++){
                    $respinChanged = false;
                    $totalWin = 0;
                    $rhinoCount = 0;
                    $reels = [];
                    $strWinLine = '';
                    for($r = 0; $r < 5; $r++){
                        $reels[$r] = [];
                        for($j = 0; $j < 3; $j++){
                            if($tempReels[$r][$j] == $rhinoSymbol){
                                $reels[$r][$j] = $tempReels[$r][$j];
                                $rhinoCount++;
                            }else{
                                if(rand(0, 100) < $slotSettings->base_rhino_chance && $_obf_winType == 1){
                                    $reels[$r][$j] = $rhinoSymbol;
                                    $rhinoCount++;
                                    $respinChanged = true;
                                }else{
                                    $reels[$r][$j] = $tempReels[$r][$j];
                                }
                            }
                        }
                    }
                    if($rhinoCount == 14){
                        $totalWin = $lines * $betline * 375;
                    }else if ($rhinoCount == 15){
                        $totalWin = $lines * $betline * 500;
                    }else{
                        $_obf_winCount = 0;
                        for( $k = 0; $k < $lines; $k++ ) 
                        {
                            $_lineWin = '';
                            $firstEle = $reels[0][$linesId[$k][0] - 1];
                            $lineWinNum[$k] = 1;
                            $lineWins[$k] = 0;
                            for($j = 1; $j < 5; $j++){
                                $ele = $reels[$j][$linesId[$k][$j] - 1];
                                if($ele == $firstEle){
                                    $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                    if($j == 4){
                                        $lineWins[$k] = $slotSettings->Paytable[$firstEle][$lineWinNum[$k]] * $betline;
                                        $totalWin += $lineWins[$k];
                                        $_obf_winCount++;
                                        $strWinLine = $strWinLine . '&l'. ($_obf_winCount - 1).'='.$k.'~'.$lineWins[$k];
                                        for($kk = 0; $kk < $lineWinNum[$k]; $kk++){
                                            $strWinLine = $strWinLine . '~' . (($linesId[$k][$kk] - 1) * 5 + $kk);
                                        }
                                    }
                                }else{
                                    if($slotSettings->Paytable[$firstEle][$lineWinNum[$k]] > 0){
                                        $lineWins[$k] = $slotSettings->Paytable[$firstEle][$lineWinNum[$k]] * $betline;
                                        $totalWin += $lineWins[$k];
                                        $_obf_winCount++;
                                        $strWinLine = $strWinLine . '&l'. ($_obf_winCount - 1).'='.$k.'~'.$lineWins[$k];
                                        for($kk = 0; $kk < $lineWinNum[$k]; $kk++){
                                            $strWinLine = $strWinLine . '~' . (($linesId[$k][$kk] - 1) * 5 + $kk);
                                        }   
    
                                    }else{
                                        $lineWinNum[$k] = 0;
                                    }
                                    break;
                                }
                            }
                        }
                    }
                    if( $_obf_winType== 0 && $slotEvent['slotEvent'] == 'respin' &&  $respinChanged == false){
                        break;
                    }
                    // if( $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : '')) > $totalWin ) 
                    if( $slotSettings->GetBank('') > $totalWin ) 
                    {
                        break;
                    }
                    if($i > 500){
                        $_obf_winType = 0;
                    }

                }
                
                
                $isEndRespin = false;
                if($respinChanged == true && $rhinoCount < 14){
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') + $slotSettings->slotRespinCount);
                }else{
                    if($rhinoCount > 13 || ($slotSettings->GetGameData($slotSettings->slotId . 'RespinGames')<= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') && $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') > 0)){
                        $isEndRespin = true;
                    }
                }
                for($k = 0; $k < 3; $k++){
                    for($j = 0; $j < 5; $j++){
                        $lastReel[$j + $k * 5] = $reels[$j][$k];
                    }
                }
                $strLastReel = implode(',', $lastReel);
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                $spinType = 'b&end=0';
                if($isEndRespin == true){
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                    $spinType = 'cb&tw='. $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .'&rw='.$totalWin.'&end=1';
                }
                $response = 'bgid=0&rsb_m='.$slotSettings->GetGameData($slotSettings->slotId . 'RespinGames').'&balance='.$Balance.'&rsb_c='.$slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame').'&index='. $slotEvent['index'] . 
                '&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.'&stime=' . floor(microtime(true) * 1000) .'&bgt=26&sver=5&bpw='.$totalWin.'&counter='. ((int)$slotEvent['counter'] + 1) .'&s='.$strLastReel.'';
                if($isEndRespin == true) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                    if( $totalWin > 0) 
                    {
                        $slotSettings->SetBalance($totalWin);
                        // $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), -1 * $totalWin);
                        $slotSettings->SetBank('', -1 * $totalWin);
                    }
                }else{
                    $totalWin = 0;
                }
                

                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . 
                    ',"totalRespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') . ',"currentRespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') . ',"Balance":' . $Balance . 
                    ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . 
                    ',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $totalWin, $slotEvent['slotEvent']);
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
