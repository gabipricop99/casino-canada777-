<?php 
namespace VanguardLTE\Games\PandasFortune2
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
            	$response = 'unlogged';
                exit( $response );
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
            }else if( $slotEvent['slotEvent'] == 'doInit' ) 
            { 
                $lastEvent = $slotSettings->GetHistory();
                $_obf_StrResponse = '';
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 25);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [6,7,4,3,8,4,3,5,6,7,8,5,7,3,4]);                
                $slotSettings->SetGameData($slotSettings->slotId . 'GoldenPoses', [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]);
                if( $lastEvent != 'NULL' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->lines);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', $lastEvent->serverResponse->BonusMpl);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastEvent->serverResponse->LastReel);
                    $slotSettings->SetGameData($slotSettings->slotId . 'GoldenPoses', $lastEvent->serverResponse->GoldenPoses);
                    $bet = $lastEvent->serverResponse->bet;
                }
                else
                {
                    $bet = $slotSettings->Bet[0];
                }
                $currentReelSet = 0;
                $spinType = 's';
                $lastReel = $slotSettings->GetGameData($slotSettings->slotId . 'LastReel');
                $lastReelStr = implode(',', $lastReel);
                $goldenPoses = $slotSettings->GetGameData($slotSettings->slotId . 'GoldenPoses');
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
                    $strOtherResponse = '&fs=' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .  '&fsres=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&tw=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&w=0.00&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                    $currentReelSet = 2;
                }else{
                    $strOtherResponse = '';
                }
                $arr_gsf = [];
                for($k = 0; $k < count($goldenPoses); $k++){
                    if($goldenPoses[$k] == 1){
                        array_push($arr_gsf, $lastReel[$k] . '~' . $k);
                    }
                }
                if(count($arr_gsf) > 0){
                    $strOtherResponse = $strOtherResponse . '&gsf=' . implode(';', $arr_gsf);
                }
                $Balance = $slotSettings->GetBalance();
                $response = 'def_s=6,7,4,3,8,4,3,5,6,7,8,5,7,3,4&balance='. $Balance .'&cfgs=1&ver=2&index=1&balance_cash='. $Balance .'&def_sb=4,13,4,7,8&reel_set_size=3&def_sa=10,3,5,3,7&reel_set='.$currentReelSet.$strOtherResponse.'&balance_bonus=0.00&na='. $spinType.'&scatters=1~100,15,2,0,0~12,12,12,0,0~1,1,1,1,1&gmb=0,0,0&bg_i=3,0,2,1,1,2,2,3,1,4,3,5,2,6,1,7,2,8,1,9,5,10,15,20,25,50,75,100,150,200,250,500,1000,2500,4998,10,5,10,15,20,25,50,75,100,150,200,250,500,1000,2500,4998,11&rt=d&gameInfo={rtps:{regular:"96.51"},props:{max_rnd_sim:"1",max_rnd_hr:"953591",max_rnd_win:"5000"}}&wl_i=tbm~5000&stime=' . floor(microtime(true) * 1000) .'&sa=10,3,5,3,7&sb=4,13,4,7,8&sc='. implode(',', $slotSettings->Bet) .'&defc=0.08&sh=3&wilds=2~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&bg_i_mask=pw,ic,pw,ic,pw,ic,pw,ic,pw,ic,pw,ic,pw,ic,pw,ic,pw,ic,pw,ic,pw,pw,pw,pw,pw,pw,pw,pw,pw,pw,pw,pw,pw,pw,pw,ic,pw,pw,pw,pw,pw,pw,pw,pw,pw,pw,pw,pw,pw,pw,pw,ic&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;200,50,25,0,0;150,50,10,0,0;100,20,5,0,0;100,20,5,0,0;100,20,5,0,0;50,15,5,0,0;50,15,5,0,0;50,10,5,0,0;50,10,5,0,0;50,10,5,0,0;50,10,5,0,0&l=25&rtp=96.51&reel_set0=10,6,12,4,8,12,6,12,6~7,5,11,13,3,9,3,11,13,3,11,3,9,3,11,3,5,9,11,13,5,3,9,13,11,9,3~10,13,3,9,5,6,7,4,11,8,12,9,11,3,7,3,7,11,5,11,8,11,3,11,7,8,11,3,6,9~3,7,11,6,9,8,4,12,5,13,10,11,9,13,7,6,12,6,12,7,12,5,13,9,6,9,7,11,9,6,7,6~9,3,2,1,4,5,10,13,6,7,8,11,12,11,1,4,6,12,11,1,11,12,2,1,11,3,1,11,3,1,4&s='.$lastReelStr.'&reel_set2=9,5,13,12,1,8,10,6,4,7,3,11,7,12,4,7,12,10,4,8,6,4,8,6,7,4,5,7,5~10,5,4,12,2,2,2,7,9,3,2,11,6,8,13,1,6,2,12,2,5,8,2,6,11,3,11,2,12,2,3,12,8,6,12,3~2,2,2,11,6,9,2,8,13,7,3,1,5,12,4,10,4,6,12,13,12,11,3,4,12,6,13,12,6,12,3,12,3,12,13,10,12,3,4,3,13~12,10,7,8,11,5,2,2,2,3,4,1,13,2,9,6,8,2,11,2,13,2,5,2,5,2,1,2,8,5,2,5~2,2,2,11,4,1,8,6,7,2,3,12,5,13,10,9,1,10,6,1,7,6,10,8,6,11,1,9,5,6,9,7,9,6,8,5,11,6,8,10,11,10,5,6,13,8,1,6,9&reel_set1=1,8,11,13,4,12,7,5,9,10,6,3,6,11,7,11,6,8,6,13,5~2,2,2,7,9,10,4,13,11,12,2,8,1,6,5,3,6,1,10,7,10,12,6,8,10,12,10,11,1,9,7,6,8,7,10~2,2,2,12,6,3,7,13,4,1,11,5,8,10,2,9,6,10,12,10,9,13,12~2,2,2,2,6,8,9,12,1,13,3,11,5,7,10,4,12,7,12,3,12,8,12,7,8~11,2,10,8,13,12,3,4,1,5,7,6,9,13,8,1,9,4,10';
            }
            else if( $slotEvent['slotEvent'] == 'doCollect' || $slotEvent['slotEvent'] == 'doCollectBonus') 
            {
                $Balance = $slotSettings->GetBalance();
                $response = 'balance=' . $Balance . '&index=' . $slotEvent['index'] . '&balance_cash=' . $Balance . '&balance_bonus=0.00&na=s&stime=' . floor(microtime(true) * 1000) . '&na=s&sver=5&counter=' . ((int)$slotEvent['counter'] + 1);
            }
            else if( $slotEvent['slotEvent'] == 'doSpin' ) 
            {
                
                $lastEvent = $slotSettings->GetHistory();
                $linesId = $slotSettings->winLines;
                
                $slotEvent['slotBet'] = $slotEvent['c'];
                $slotEvent['slotLines'] = 25;
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') <= $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                {
                    $slotEvent['slotEvent'] = 'freespin';
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
                $allbet = $betline * $lines;
                $_spinSettings = $slotSettings->GetSpinSettings($slotEvent['slotEvent'], $allbet, $lines);
                $winType = $_spinSettings[0];
                $_winAvaliableMoney = $_spinSettings[1];
                if($slotEvent['slotEvent'] == 'freespin'){
                    if($slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') == 1){
                        $slotSettings->SetGameData($slotSettings->slotId . 'GoldenPoses', [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]);   
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                }
                else
                {
                    $slotEvent['slotEvent'] = 'bet';
                    $slotSettings->SetBalance(-1 * ($allbet), $slotEvent['slotEvent']);
                    $_sum = ($allbet) / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), $_sum, $slotEvent['slotEvent']);
                    $bonusMpl = 1;
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'GoldenPoses', [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]);
                }
                
                $Balance = $slotSettings->GetBalance();
                if( $slotEvent['slotEvent'] != 'bet' ) 
                {
                    $slotSettings->UpdateJackpots($allbet);
                }
                
                $isJackpot = false;
                $jackpotPosCount = 0;
                $jackpotLine = -1;
                if($_winAvaliableMoney > $allbet * 3000 && $winType == 'win' && rand(0, 100) < 0){                    
                    $isJackpot = true;
                    $goldenPoses = $slotSettings->GetGameData($slotSettings->slotId . 'GoldenPoses');
                    for( $k = 0; $k < $lines; $k++ ) 
                    {
                        $lineId = $linesId[$k];
                        $goldenCount = 0;
                        for($j = 0; $j < 5; $j++){
                            $pos = ($lineId[$j] - 1) * 5 + $j;
                            if($goldenPoses[$pos] == 1){
                                $goldenCount++;
                            }
                        }
                        if($jackpotPosCount == 0 || ($goldenCount > 0 && $goldenCount < $jackpotPosCount)){
                            $jackpotPosCount = $goldenCount;
                            $jackpotLine = $k;
                        }
                    }
                }

                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $totalWin = 0;
                    $lineWins = [];
                    $lineWinNum = [];
                    $wild = 2;
                    $scatter = 1;
                    $_obf_winCount = 0;
                    $strWinLine = '';
                    $_obf_scatterposes = [];
                    $goldenWins = [];
                    $scattersCount = 0;
                    $scattersWin = 0;
                    $goldenWin = 0;
                    $_lineWinNumber = 1;
                    $goldenPoses = $slotSettings->GetGameData($slotSettings->slotId . 'GoldenPoses');
                    if($isJackpot == true){
                        if($jackpotLine == -1){
                            $jackpotLine = mt_rand(0, count($lines)-1);
                        }
                        $reels = $slotSettings->GenerateJackpotReel($jackpotLine);
                        if($jackpotPosCount == 0){
                            $goldenReelPos = mt_rand(0, 4);
                            $goldenPoses[($linesId[$jackpotLine][$goldenReelPos] - 1) * 5 + $goldenReelPos] = 1;
                        }
                    }else{
                        $reels = $slotSettings->GetReelStrips($winType, $slotEvent['slotEvent'], $betline);
                        for($k = 0; $k < 15; $k++){
                            if($goldenPoses[$k] == 0 && $slotSettings->CheckGoldenSymbol() && $reels['reel' . ($k % 5 + 1)][floor($k / 5)] != $scatter){
                                $goldenPoses[$k] = 1;
                            }
                        }
                    }
                    for( $k = 0; $k < $lines; $k++ ) 
                    {
                        $_lineWin = '';
                        $firstEle = $reels['reel1'][$linesId[$k][0] - 1];
                        $lineWinNum[$k] = 1;
                        $lineWins[$k] = 0;
                        $isWild = false;
                        $isJackpotPay = false;
                        for($j = 1; $j < 5; $j++){
                            $ele = $reels['reel'. ($j + 1)][$linesId[$k][$j] - 1];
                            if($firstEle == $wild){
                                $firstEle = $ele;
                                $isWild = true;
                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                            }else if($ele == $firstEle || $ele == $wild){
                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                if($ele == $wild){
                                    $isWild = true;
                                }
                                if($j == 4){
                                    if($firstEle > 2){
                                        $lineWins[$k] = $slotSettings->Paytable[$firstEle][$lineWinNum[$k]] * $betline;
                                        if($lineWins[$k] > 0){
                                            $totalWin += $lineWins[$k];
                                            $_obf_winCount++;
                                            $strWinLine = $strWinLine . '&l'. ($_obf_winCount - 1).'='.$k.'~'.$lineWins[$k];
                                            for($kk = 0; $kk < $lineWinNum[$k]; $kk++){
                                                $pos = ($linesId[$k][$kk] - 1) * 5 + $kk;
                                                $strWinLine = $strWinLine . '~' . ($pos);
                                                $symbol = $reels['reel'. ($kk + 1)][$linesId[$k][$kk] - 1];
                                                if($goldenPoses[$pos] == 1){
                                                    if($isJackpot == true && $isJackpotPay == false){
                                                        array_push($goldenWins, [$symbol, $slotSettings->GetGoldenMul($symbol, $lineWinNum[$k], $isJackpot)]);
                                                        $isJackpotPay = true;
                                                    }else{
                                                        array_push($goldenWins, [$symbol, $slotSettings->GetGoldenMul($symbol, $lineWinNum[$k])]);
                                                    }
                                                }
                                            }
                                        }
                                    }else{
                                        $lineWinNum[$k] = 0;
                                    }
                                }
                            }else{
                                if($slotSettings->Paytable[$firstEle][$lineWinNum[$k]] > 0){
                                    if($firstEle > 2){
                                        $lineWins[$k] = $slotSettings->Paytable[$firstEle][$lineWinNum[$k]] * $betline;
                                        if($lineWins[$k] > 0){
                                            $totalWin += $lineWins[$k];
                                            $_obf_winCount++;
                                            $strWinLine = $strWinLine . '&l'. ($_obf_winCount - 1).'='.$k.'~'.$lineWins[$k];
                                            for($kk = 0; $kk < $lineWinNum[$k]; $kk++){                                                
                                                $pos = ($linesId[$k][$kk] - 1) * 5 + $kk;
                                                $strWinLine = $strWinLine . '~' . ($pos);
                                                $symbol = $reels['reel'. ($kk + 1)][$linesId[$k][$kk] - 1];
                                                if($goldenPoses[$pos] == 1){
                                                    array_push($goldenWins, [$symbol, $slotSettings->GetGoldenMul($symbol, $lineWinNum[$k])]);
                                                }
                                            }   
                                        }
                                    }else{
                                        $lineWinNum[$k] = 0;    
                                    }
                                }else{
                                    $lineWinNum[$k] = 0;
                                }
                                break;
                            }
                        }
                    }
                    
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        for( $k = 0; $k <= 2; $k++ ) 
                        {
                            if( $reels['reel' . $r][$k] == $scatter ) 
                            {
                                $scattersCount++;
                                if($goldenPoses[$k * 5 + $r - 1] == 1){
                                    continue;
                                }
                                array_push($_obf_scatterposes, $k * 5 + $r - 1);
                            }
                        }
                    }
                    if($scattersCount >= 3){
                        $scattersWin =$allbet * $slotSettings->scatterPayTable[$scattersCount];
                    }

                    for($k = 0; $k < count($goldenWins); $k++){
                        $goldenWin = $goldenWin + $allbet * $goldenWins[$k][1];
                    }
                    $totalWin = $totalWin + $scattersWin + $goldenWin;
                    
                    if( $i >= 1000 ) 
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
                            // $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                            // exit( $response );
                            break;
                        }
                        
                        if( $scattersCount >= 3 && $winType != 'bonus' ) 
                        {
                        }
                        else if ($scattersCount == 5)
                        {
                            
                        }
                        else if( $totalWin <= $_winAvaliableMoney && $winType == 'bonus' ) 
                        {
                            $_obf_0D163F390C080D0831380D161E12270D0225132B261501 = $slotSettings->GetBank('bonus');
                            if( $_obf_0D163F390C080D0831380D161E12270D0225132B261501 < $_winAvaliableMoney ) 
                            {
                                $_winAvaliableMoney = $_obf_0D163F390C080D0831380D161E12270D0225132B261501;
                            }
                            else
                            {
                                break;
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
                    // }
                }
                $spinType = 's';
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
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 12);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 1);
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 8);
                    }
                }
                $lastReel = [];
                for($k = 0; $k < 3; $k++){
                    for($j = 1; $j <= 5; $j++){
                        $lastReel[($j - 1) + $k * 5] = $reels['reel'.$j][$k];
                    }
                }
                $strLastReel = implode(',', $lastReel);
                $strReelSa = $reels['reel1'][3].','.$reels['reel2'][3].','.$reels['reel3'][3].','.$reels['reel4'][3].','.$reels['reel5'][3];
                $strReelSb = $reels['reel1'][-1].','.$reels['reel2'][-1].','.$reels['reel3'][-1].','.$reels['reel4'][-1].','.$reels['reel5'][-1];
               
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                $slotSettings->SetGameData($slotSettings->slotId . 'GoldenPoses', $goldenPoses);
                $strOtherResponse = '';
                $n_reel_set = 0;
                $isEnd = false;
                if( $slotEvent['slotEvent'] == 'freespin' ) 
                {
                    $n_reel_set = 2;
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin - $goldenWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    $spinType = 's';
                    $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                    {
                        $spinType = 'c';
                        $isEnd = true;
                        $strOtherResponse = '&fs_total='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fswin_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsmul_total=1&fsend_total=1&fsres_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                    }
                    else
                    {
                        $strOtherResponse = '&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                    }
                }else
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                    if($scattersCount >=3 ){
                        $spinType = 's';
                        $strOtherResponse = '&fsmul=1&fsmax='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fswin=0.00&fs=1&fsres=0.00';
                    }  
                    if($scattersCount >= 2){
                        $n_reel_set = 1;
                    }
                }

                if($scattersCount >= 3){
                    $strOtherResponse = $strOtherResponse . '&psym=1~'. $scattersWin .'~' . implode(',', $_obf_scatterposes);
                }
                $arr_gsf = [];
                for($k = 0; $k < count($goldenPoses); $k++){
                    if($goldenPoses[$k] == 1){
                        array_push($arr_gsf, $lastReel[$k] . '~' . $k);
                    }
                }
                if(count($arr_gsf) > 0){
                    $strOtherResponse = $strOtherResponse . '&gsf=' . implode(';', $arr_gsf);
                }
                if($goldenWin > 0){
                    $arr_gsf_a = [];
                    $totalGoldenMul = 0;
                    for($k = 0; $k < count($goldenWins); $k++){
                        array_push($arr_gsf_a, $goldenWins[$k][0] . '~' . $goldenWins[$k][1]);
                        $totalGoldenMul = $totalGoldenMul + $goldenWins[$k][1];
                    }
                    $strOtherResponse = $strOtherResponse . '&coef='. $allbet .'&gsf_a='. implode(';', $arr_gsf_a) .'&rw='. $goldenWin .'&bw=1&wp='. $totalGoldenMul .'&end=1';
                }
                $response = 'tw='.$slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . $strOtherResponse . '&balance='.$Balance.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinLine.'&stime=' . floor(microtime(true) * 1000) . '&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=3&c='.$betline.'&sver=5&reel_set='.$n_reel_set.'&counter='. ((int)$slotEvent['counter'] + 1) .'&l=25&s='.$strLastReel.'&w='.($totalWin - $goldenWin);

                if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0)) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                }

                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $Balance . ',"GoldenPoses":'.json_encode($goldenPoses) . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . ',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $allbet, $lines, $_obf_totalWin, $slotEvent['slotEvent']);
                
                if( $scattersCount >= 3 && $slotEvent['slotEvent'] != 'freespin') 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $Balance);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                }
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
