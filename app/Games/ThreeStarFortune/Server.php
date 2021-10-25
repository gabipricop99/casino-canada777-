<?php 
namespace VanguardLTE\Games\ThreeStarFortune
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
                1, 
                1, 
                2, 
                1, 
                1
            ];
            $linesId[6] = [
                3, 
                3, 
                2, 
                3, 
                3
            ];
            $linesId[7] = [
                2, 
                3, 
                3, 
                3, 
                2
            ];
            $linesId[8] = [
                2, 
                1, 
                1, 
                1, 
                2
            ];
            $linesId[9] = [
                2, 
                1, 
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
            if( $slotEvent['slotEvent'] == 'update' ) 
            {
                $Balance = $slotSettings->GetBalance();
                $response = 'balance=' . $Balance . '&balance_cash=' . $Balance . '&balance_bonus=0.00&na=s&stime=' . floor(microtime(true) * 1000);
            }else if( $slotEvent['slotEvent'] == 'doInit' ) 
            { 
                $lastEvent = $slotSettings->GetHistory();
                $_obf_StrResponse = '';
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'WildPoses', []);
                $slotSettings->SetGameData($slotSettings->slotId . 'WildStyle', '');
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 10);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [3,4,5,6,7,8,9,8,7,6,5,4,3,4,5]);
                if( $lastEvent != 'NULL' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', $lastEvent->serverResponse->totalRespinGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', $lastEvent->serverResponse->currentRespinGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'WildPoses', $lastEvent->serverResponse->wildPoses);
                    $slotSettings->SetGameData($slotSettings->slotId . 'WildStyle', $lastEvent->serverResponse->wildStyle);
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
                if($slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') < $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames')){
                    $_obf_StrResponse = '&rs=t&rs_p='.$slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame').'&rs_c=1&rs_m=1';
                }
                $lastReel = $slotSettings->GetGameData($slotSettings->slotId . 'LastReel');
                for($k = 0; $k < count($lastReel); $k++){
                    if($lastReel[$k] == 17){
                        $lastReel[$k] = 2;
                    }
                }
                $lastReelStr = implode(',', $lastReel);
                $Balance = $slotSettings->GetBalance();
                
                $response = 'msi=10~11~12~13~14~15~16&def_s=3,4,5,6,7,8,9,8,7,6,5,4,3,4,5&balance='. $Balance . $slotSettings->GetGameData($slotSettings->slotId . 'WildStyle') .'&cfgs=1&ver=2&index=1&balance_cash='. $Balance .
                    '&reel_set_size=2&def_sb=3,4,5,6,7&def_sa=3,4,5,6,7&reel_set=0&balance_bonus=0.00&na='. $spinType.'&scatters=1~0,0,0,0,0~0,0,0,0,0~1,1,1,1,1&gmb=0,0,0&rt=d&gameInfo={props:{max_rnd_sim:"1",max_rnd_hr:"30303030",max_rnd_win:"500"}}&stime=' . floor(microtime(true) * 1000) .
                    '&sa=3,4,5,6,7&sb=3,4,5,6,7&sc='. implode(',', $slotSettings->Bet) .'&defc='.$bet.'&sh=3&wilds=2~0,0,0,0,0~1,1,1,1,1;17~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.$_obf_StrResponse.
                    '&sver=5&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;250,200,50,0,0;120,60,25,0,0;60,25,10,0,0;50,20,8,0,0;40,15,7,0,0;25,10,5,0,0;25,10,5,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0&l=10&rtp=96.27&reel_set0=9,9,9,9,9,6,6,6,6,6,7,7,9,9,5,5,5,7,6,6,7,7,7,6,6,6,5,5,8,9,9,9,4,4,6,6,6,3,3,3,6,6,6,9,9,7,7,7,3,6,8,8,6,6,4,4,4,7,7,7,9,9,9,8,8,8,8~3,3,3,5,5,4,4,4,8,8,8,6,6,6,6,8,8,5,5,5,4,6,6,7,7,7,8,8,8,2,5,5,8,6,6,8,8,8,8,3,9,9,9,5,5,5,9,6,6,7,7,6,6,6,7,8,8,8,5~8,8,8,9,9,4,4,4,4,4,8,8,8,8,5,5,5,9,6,9,9,9,4,9,7,7,7,7,7,4,4,4,7,7,7,5,7,3,2,6,6,5,5,5,3,3,3,3,8,8,7,7,7,7,8,8,8,6,6,6,8,7,7,9,9~5,5,4,4,4,5,5,5,3,3,4,4,8,4,9,8,3,3,5,5,3,3,3,3,3,4,4,4,8,8,8,2,3,3,3,5,5,9,9,6,6,8,8,7,7,7,7,5,9,9,9,8,8,8,4,4,4,5,5,7,8,8,8~6,6,9,9,7,7,6,7,7,6,6,6,9,9,9,9,7,7,7,4,9,7,7,9,9,7,4,4,6,6,6,5,7,7,8,8,8,5,5,5,7,7,9,9,9,6,6,6,7,7,7,3,3,3,8,8,8,6,6,9,9,9&s='.$lastReelStr.'&reel_set1=10,10,10,10,10,10,10,10,10,10,15,10,10,15,10,10,10,10,10,15,10,15,10,10,15,10,10,15,10,10,15,10,10,10,15,10,10,10,15,10,10,10,10,10,10,10,10,10,15,10,10,10,10,10,15,10,10,10,10,15,10,10,10,10,15,10,10,15,15~15,11,11,15,15,11,11,11,15,11,11,15,11,11,15,11,11,15,11,11,11,11,15,11,11,11,11,11,11,11,11,11,15,11,11,11,11,11,2,11,11,11,11,11,15,11,15,11,11,15,11,11,15,11,11,15,11,11,11,11,11,11,11,11,11,11~12,12,15,12,15,12,12,15,12,12,2,12,12,12,12,12,12,12,12,12,12,15,12,12,12,12,15,12,12,15,12,12,15,12,12,12,12,12,15,12,12,12,12,12,12,12,12,12,15,15,12,12,12,15,12,12,12,15,12,12,15,12,12,15~13,13,16,13,2,13,13,16,13,13,13,16,13,13,13,13,13,13,13,16,13,13,13,13,13,16,13,13,16,13,13,13,13,13,13,16,16,13,13,13,13,16,13,13,16,13,13,13,13,13,13,13,13,13,16,13,13,13,16,16~14,14,14,16,14,16,16,14,14,16,16,14,14,16,14,14,14,16,14,14,14,14,14,14,16,14,14,14,14,14,14,14,14,14,16,16,14,16,14,14,14,14,14,14,14,16,14,14,14,16,14,14,14,14,14,14,14,14,14,14,16,14,14,14,14,16';
            }
            else if( $slotEvent['slotEvent'] == 'doCollect' || $slotEvent['slotEvent'] == 'doCollectBonus') 
            {
                $Balance = $slotSettings->GetBalance();
                $response = 'balance=' . $Balance . '&index=' . $slotEvent['index'] . '&balance_cash=' . $Balance . '&balance_bonus=0.00&na=s&stime=' . floor(microtime(true) * 1000) . '&na=s&sver=5&counter=' . ((int)$slotEvent['counter'] + 1);
            }
            else if( $slotEvent['slotEvent'] == 'doSpin' ) 
            {
                
                $lastEvent = $slotSettings->GetHistory();
                $slotEvent['slotBet'] = $slotEvent['c'];
                $slotEvent['slotLines'] = 10;
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') < $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') && $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') > 0 ) 
                {
                    $slotEvent['slotEvent'] = 'respin';
                }
                $lines = $slotEvent['slotLines'];
                $betline = $slotEvent['slotBet'];
                $isWelcomeFreespin = $slotSettings->GetGameData($slotSettings->slotId . 'IsWelcomeBonus');
                if( $slotEvent['slotEvent'] == 'doSpin' || $slotEvent['slotEvent'] == 'respin' ) 
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
                        if($slotEvent['slotEvent'] == 'respin'){
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
                $convertSymbols = [0, 0, 0, 0, 0, 0, 0];
                if($slotEvent['slotEvent'] == 'respin'){
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') + 1);
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
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'WildPoses', []);
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
                    $strLineWins = [];
                    $rightLineWins = [];
                    $rightLineWinNum = [];
                    $strRightLineWins = [];
                    if($slotEvent['slotEvent'] == 'respin'){
                        for($k = 0; $k < 7; $k++){
                            $convertSymbols[$k] = $slotSettings->GetConvertSymbol();
                        }
                    }
                    $wild = '17';
                    $_obf_winCount = 0;
                    $_obf_rightWinCount = 0;
                    $strWinLine = '';
                    $initReels = $slotSettings->GetReelStrips($winType, $slotEvent['slotEvent']);   
                    $wildPoses = $slotSettings->GetGameData($slotSettings->slotId. 'WildPoses');
                    // $wildPoses = [1];
                    $wild_ep = [];
                    $reels = [];
                    $isWild = false;
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        $reels['reel' . $r] = [];
                        for( $k = 0; $k <= 2; $k++ ) 
                        {
                            if( $initReels['reel' . $r][$k] == 2) 
                            {
                                if($isWild == false && count($wildPoses) <= 0){
                                    array_push($wildPoses,$r - 1);
                                    array_push($wild_ep, $k * 5 + $r - 1);
                                    $reels['reel' . $r][$k] = $initReels['reel' . $r][$k];
                                    $isWild = true;
                                }else{
                                    if($slotEvent['slotEvent'] == 'respin'){
                                        $initReels['reel' . $r][$k] = rand(10, 16);
                                        $reels['reel' . $r][$k] = $initReels['reel' . $r][$k];
                                    }else{
                                        $initReels['reel' . $r][$k] = rand(7, 9);
                                        $reels['reel' . $r][$k] = $initReels['reel' . $r][$k];
                                    }
                                }
                            }else{
                                if($slotEvent['slotEvent'] == 'respin'){
                                    $reels['reel' . $r][$k] = $convertSymbols[$initReels['reel' . $r][$k] - 10];
                                }else{
                                    $reels['reel' . $r][$k] = $initReels['reel' . $r][$k];
                                }
                            }
                        }
                    }
                    for($r = 0; $r < count($wildPoses); $r++){
                        $reels['reel' . ($wildPoses[$r] + 1)][0] = 17;
                        $reels['reel' . ($wildPoses[$r] + 1)][1] = 17;
                        $reels['reel' . ($wildPoses[$r] + 1)][2] = 17;
                    }
                    for( $k = 0; $k < $lines; $k++ ) 
                    {
                        $_lineWin = '';
                        $strLineWins[$k] = '';
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
                                        $strWinLine = '='.$k.'~'.$lineWins[$k]; // $strWinLine . '&l'. 
                                        for($kk = 0; $kk < $lineWinNum[$k]; $kk++){
                                            $strWinLine = $strWinLine . '~' . (($linesId[$k][$kk] - 1) * 5 + $kk);
                                        }
                                        $strLineWins[$k] = $strWinLine;
                                    }
                                }
                            }else{
                                if($slotSettings->Paytable[$firstEle][$lineWinNum[$k]] > 0){
                                    $lineWins[$k] = $slotSettings->Paytable[$firstEle][$lineWinNum[$k]] * $betline;
                                    if($lineWins[$k] > 0){
                                        $totalWin += $lineWins[$k];
                                        $_obf_winCount++;
                                        $strWinLine = '='.$k.'~'.$lineWins[$k];
                                        for($kk = 0; $kk < $lineWinNum[$k]; $kk++){
                                            $strWinLine = $strWinLine . '~' . (($linesId[$k][$kk] - 1) * 5 + $kk);
                                        }   
                                        $strLineWins[$k] = $strWinLine;
                                    }

                                }else{
                                    $lineWinNum[$k] = 0;
                                }
                                break;
                            }
                        }
                    }
                    for( $k = 0; $k < $lines; $k++ ) 
                    {
                        $_lineWin = '';
                        $strRightLineWins[$k] = '';
                        $firstEle = $reels['reel5'][$linesId[$k][4] - 1];
                        $rightLineWinNum[$k] = 1;
                        $rightLineWins[$k] = 0;
                        for($j = 3; $j >= 0; $j--){
                            $ele = $reels['reel'. ($j + 1)][$linesId[$k][$j] - 1];
                            if($firstEle == $wild){
                                $firstEle = $ele;
                                $rightLineWinNum[$k] = $rightLineWinNum[$k] + 1;
                            }else if($ele == $firstEle || $ele == $wild){
                                $rightLineWinNum[$k] = $rightLineWinNum[$k] + 1;
                                if($j == 0){
                                    $rightLineWins[$k] = $slotSettings->Paytable[$firstEle][$rightLineWinNum[$k]] * $betline;
                                    if($rightLineWins[$k] > 0){
                                        $totalWin += $rightLineWins[$k];
                                        $_obf_rightWinCount++;
                                        $strWinLine = '='.$k.'~'.$rightLineWins[$k]; //$strWinLine . '&ll'. 
                                        for($kk = 0; $kk < $rightLineWinNum[$k]; $kk++){
                                            $index = 4 - $kk;
                                            $strWinLine = $strWinLine . '~' . (($linesId[$k][$index] - 1) * 5 + $index);
                                        }
                                        $strRightLineWins[$k] = $strWinLine;
                                    }
                                }
                            }else{
                                if($slotSettings->Paytable[$firstEle][$rightLineWinNum[$k]] > 0){
                                    $rightLineWins[$k] = $slotSettings->Paytable[$firstEle][$rightLineWinNum[$k]] * $betline;
                                    if($rightLineWins[$k] > 0){
                                        $totalWin += $rightLineWins[$k];
                                        $_obf_rightWinCount++;
                                        $strWinLine = '='.$k.'~'.$rightLineWins[$k]; // $strWinLine . '&ll'. 
                                        for($kk = 0; $kk < $rightLineWinNum[$k]; $kk++){
                                            $index = 4 - $kk;
                                            $strWinLine = $strWinLine . '~' . (($linesId[$k][$index] - 1) * 5 + $index);
                                        }   
                                        $strRightLineWins[$k] = $strWinLine;
                                    }

                                }else{
                                    $rightLineWinNum[$k] = 0;
                                }
                                break;
                            }
                        }
                    }
                    
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
                        if( $isWild == false && $winType == 'bonus' ) 
                        {
                        }
                        // if( $rhinoCount >= 6 && $winType != 'bonus' ) 
                        // {
                        // }
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
                $isEndRespin = false;
                $strWinLine = '';    
                if( $isWild == true) 
                {
                    if($slotEvent['slotEvent'] != 'respin'){
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                    }else{                            
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') + 1);
                    }
                }
                if( $totalWin > 0) 
                {
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), -1 * $totalWin);
                    if($isWelcomeFreespin == 1){
                        $slotSettings->SetWelcomeBonus($totalWin);
                    }
                    $leftWinCount = 0;
                    $rightWinCount = 0;
                    for($k = 0; $k < $lines; $k++){
                        $isLeft = false;
                        if($strLineWins[$k] != ''){
                            $strWinLine = $strWinLine . '&l' . $leftWinCount . $strLineWins[$k];
                            $leftWinCount++;
                            $isLeft = true;
                        }
                        if($strRightLineWins[$k] != ''){
                            if($isLeft == false){
                                $strWinLine = $strWinLine . '&l' . $leftWinCount  . $strRightLineWins[$k];
                                $leftWinCount++;
                            }else{
                                $strWinLine = $strWinLine . '&ll' . $rightWinCount . $strRightLineWins[$k];
                                $rightWinCount++;
                            }
                        }
                    }
                }
                $_obf_totalWin = $totalWin;
                $initReel = [];
                for($k = 0; $k < 3; $k++){
                    for($j = 1; $j <= 5; $j++){
                        $lastReel[($j - 1) + $k * 5] = $reels['reel'.$j][$k];
                        $initReel[($j - 1) + $k * 5] = $initReels['reel'.$j][$k];
                    }
                }
                $strLastReel = implode(',', $lastReel);
                $strInitReel = implode(',', $initReel);
                $strReelSa = $initReels['reel1'][3].','.$initReels['reel2'][3].','.$initReels['reel3'][3].','.$initReels['reel4'][3].','.$initReels['reel5'][3];
                $strReelSb = $initReels['reel1'][-1].','.$initReels['reel2'][-1].','.$initReels['reel3'][-1].','.$initReels['reel4'][-1].','.$initReels['reel5'][-1];
                
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                $strOtherResponse = '';
                $spinType = 's';
                $tempStyle = [];
                $arr_srf = [];
                $index = 0;
                $beforeSymbol = 0;
                for($r = 0; $r < 3; $r++){
                    for($k = 0; $k < count($wildPoses); $k++){
                        if($index == 0){
                            array_push($tempStyle, $wildPoses[$k] + 5 * $r);
                            $index++;
                        }else{
                            if($slotEvent['slotEvent'] == 'respin'){
                                array_push($tempStyle, '-1~' . ($wildPoses[$k] + 5 * $r));
                            }else{
                                array_push($tempStyle, $beforeSymbol . '~' . ($wildPoses[$k] + 5 * $r));
                            }
                            $index++;
                        }
                        if($r == 2 && $k == count($wildPoses) - 1){
                            if($slotEvent['slotEvent'] == 'respin'){
                                array_push($tempStyle, -1);
                            }else{
                                array_push($tempStyle, $wildPoses[$k] + 5 * $r);
                            }
                        }
                        $beforeSymbol = $wildPoses[$k] + 5 * $r;
                        array_push($arr_srf, $wildPoses[$k] + 5 * $r);
                    }
                }
                $strStyle = '';
                if(count($tempStyle) > 0){
                    $strStyle = '&sty=' . implode(',', $tempStyle);
                }
                $n_reel_set = '&reel_set=0';
                $slotSettings->SetGameData($slotSettings->slotId . 'WildStyle', $strStyle);
                if($isWild == true)
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'WildPoses', $wildPoses);
                    $strOtherResponse = '&ep=2~' . implode(',', $wild_ep) . '~' . implode(',', $arr_srf) . '&rs=t' . '&rs_p='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame').'&rs_c=1&rs_m=1&srf=2~17~' . implode(',', $arr_srf);
                }else{
                    $slotSettings->SetGameData($slotSettings->slotId . 'WildPoses', []);
                }
                $strConvertSymbol = '';
                if( $slotEvent['slotEvent'] == 'respin' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    $strConvertSymbol = '&msr=' . implode('~', $convertSymbols);
                    $n_reel_set = '&reel_set=1';
                    $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                    $strOtherResponse = $strOtherResponse . '&rs_t='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame').'&rs_win=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                }else{                    
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);  
                }
                if($isWild == false){
                    if($slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') > 0){
                        $spinType = 'c';
                    }
                }
                $response = 'tw='. $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . $strConvertSymbol .'&balance='.$Balance.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strOtherResponse.$strStyle.$strWinLine.'&stime=' . floor(microtime(true) * 1000) .
                '&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=3&c='.$betline.'&sver=5'.$n_reel_set.'&counter='. ((int)$slotEvent['counter'] + 1) .'&l=20&is='. $strInitReel.'&s='.$strLastReel.'&w='.$totalWin;

                
 
                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . 
                    ',"totalRespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') . ',"wildStyle":"' . $slotSettings->GetGameData($slotSettings->slotId . 'WildStyle') . '","wildPoses":' . json_encode($wildPoses) . ',"currentRespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') . ',"Balance":' . $Balance . 
                    ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":'. $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') .',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . 
                    ',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $_obf_totalWin, $slotEvent['slotEvent']);
                if( ($slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') && $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') > 0)) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                }
                if( $slotEvent['slotEvent']!='respin' && $isWild == true) 
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
                $lastReel = $slotSettings->GetGameData($slotSettings->slotId . 'LastReel');
                $tempReels = [];
                for($i = 0; $i < 5; $i++){
                    $tempReels[$i] = [];
                    for($j = 0; $j < 3; $j++){
                        $tempReels[$i][$j] = $lastReel[$j * 5 + $i];
                    }
                }
                $_obf_winType = rand(0, 1);
                $totalWin = 0;
                $rhinoSymbol = 3;
                for($i = 0; $i < 2000; $i++){
                    $respinChanged = false;
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
                                if(rand(0, 100) < $slotSettings->base_rhino_chance){
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
                    if( $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : '')) > $totalWin ) 
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
                    // $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') + 1);
                    if($rhinoCount > 13 || ($slotSettings->GetGameData($slotSettings->slotId . 'RespinGames')<= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') && $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') > 0)){
                        $isEndRespin = true;
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 3);
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
                        $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), -1 * $totalWin);
                    }
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
