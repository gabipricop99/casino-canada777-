<?php 
namespace VanguardLTE\Games\MustangKingNY
{
    include('CheckReels.php');
    class Server
    {
        public $winLines = [];
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
            $paramData = json_decode(trim(file_get_contents('php://input')), true);
            $slotEvent = $paramData['SlotEvent'];
            // $paramData = trim(file_get_contents('php://input'));
            // $_obf_params = explode('&', $paramData);
            // $slotEvent = [];
            // foreach( $_obf_params as $_obf_param ) 
            // {
            //     $_obf_arr = explode('=', $_obf_param);
            //     $slotEvent[$_obf_arr[0]] = $_obf_arr[1];
            // }
            // if( !isset($slotEvent['action']) ) 
            // {
            //     return '';
            // }
            // $slotEvent = $slotEvent['action'];
            // if( $slotEvent == 'update' ) 
            // {
            //     $Balance = $slotSettings->GetBalance();
            //     if($slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') <= $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0){
            //         $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
            //     }
            //     $response = 'balance=' . $Balance . '&balance_cash=' . $Balance . '&balance_bonus=0.00&na=s&stime=' . floor(microtime(true) * 1000);
            //     exit( $response );
            // }
            if( $slotEvent == 'getSettings' || $slotEvent == 'restart' ) 
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
                $slotSettings->SetGameData($slotSettings->slotId . 'IsMoreRespin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 25);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [10,3,6,8,9,9,7,10,3,5,4,5,8,4,10]);
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
                    $slotSettings->SetGameData($slotSettings->slotId . 'IsMoreRespin', $lastEvent->serverResponse->IsMoreRespin);
                    $bet = $lastEvent->serverResponse->bet;
                }
                else
                {
                    $bet = $slotSettings->Bet[0];
                }
                if($lastEvent != 'NULL'){                    
                    $bet = $lastEvent->serverResponse->bet;
                }else{
                    $bet = $slotSettings->Bet[0];
                }
                $currentReelSet = 0;
                $lastReel = $slotSettings->GetGameData($slotSettings->slotId . 'LastReel');
                $lastReelMoon = $slotSettings->GetGameData($slotSettings->slotId . 'MoonValue');
                $result = [];
                $resultMoon = [];
                for($i = 0; $i < 5; $i++){
                    $result['reel' . ($i + 1)] = [];
                    $resultMoon[$i] = [];
                    for($j = 0; $j < 3; $j++){
                        $result['reel' . ($i + 1)][$j] = $lastReel[$i + $j * 5];
                        $resultMoon[$i][$j] = $lastReelMoon[$i + $j * 5];
                    }
                }
                $Balance = $slotSettings->GetBalance();
                $strJsonSetting  = '{"FreeGames":'.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').',"CurrentFreeGame":'.$slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame'). ',"RespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') . ',"CurrentRespinGame":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame').',"CurrentBet":'. $bet . ',"Lines":'.$slotSettings->GetGameData($slotSettings->slotId . 'Lines').',"reelSymbols":'.json_encode($result).',"resultMoons":'.json_encode($resultMoon).',"Balance":'.$Balance.'}';
                $response = '{"responseEvent":"","responseType":"'.$slotEvent.'","serverResponse":' . $strJsonSetting . '}';
            }
            else if( $slotEvent == 'bet' || $slotEvent == 'freespin' ) 
            {
                
                $lastEvent = $slotSettings->GetHistory();
                
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                {
                    $slotEvent = 'freespin';
                }
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') < $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') && $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') > 0 ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $slotEvent . '","serverResponse":"invalid bonus state"}';
                    exit( $response );
                }
                $lines = $paramData['lines'];//$slotSettings->GetGameData($slotSettings->slotId . 'Lines');
                $betline = $paramData['betLine'] ;
                if( $slotEvent == 'bet' || $slotEvent == 'freespin' ) 
                {
                    if( $lines <= 0 || $betline <= 0.0001 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $slotEvent . '","serverResponse":"invalid bet state"}';
                        exit( $response );
                    }
                    if( $slotEvent == 'doSpin' && $slotSettings->GetBalance() < ($lines * $betline) ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $slotEvent . '","serverResponse":"invalid balance"}';
                        exit( $response );
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') < $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotEvent == 'freespin' ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $slotEvent . '","serverResponse":"invalid bonus state"}';
                        exit( $response );
                    }
                    if($slotEvent == 'freespin'){
                        if ($lastEvent->serverResponse->bet != $betline){
                            $response = '{"responseEvent":"error","responseType":"' . $slotEvent . '","serverResponse":"invalid Bets"}';
                        exit( $response );
                        }
                    }
                }
                $_spinSettings = $slotSettings->GetSpinSettings($slotEvent, $betline * $lines, $lines);
                $winType = $_spinSettings[0];
                $_winAvaliableMoney = $_spinSettings[1];
                if($slotEvent == 'freespin'){
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                }
                else
                {
                    $slotEvent = 'bet';
                    $slotSettings->SetBalance(-1 * ($betline * $lines), $slotEvent);
                    $_sum = ($betline * $lines) / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($slotEvent) ? $slotEvent : ''), $_sum, $slotEvent);
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
                $slotSettings->SetGameData($slotSettings->slotId . 'IsMoreRespin', 0);
                $Balance = $slotSettings->GetBalance();
                if( $slotEvent != 'bet' ) 
                {
                    $slotSettings->UpdateJackpots($betline * $lines);
                }
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $_moonValue = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                    $totalWin = 0;
                    $wild = '2';
                    $scatter = '1';
                    $moonsymbol = '11';
                    $this->winLines = [];
                    $lineWins = [];
                    $lineWinNum = [];
                    $_obf_winCount = 0;
                    $strWinLine = '';
                    $winLineMuls = [];
                    $winLineMulNums = [];
                    $reels = $slotSettings->GetReelStrips($winType, $slotEvent);
                    for($r = 0; $r < 3; $r++){
                        if($reels['reel1'][$r] != $scatter){
                            $this->findZokbos($reels, $reels['reel1'][$r], 1, ($r * 5));
                        }                        
                    }
                    for($r = 0; $r < count($this->winLines); $r++){
                        $winLine = $this->winLines[$r];
                        $lineWinNum[$r] = $winLine['StrLineWin'];
                        $lineWins[$r] = $slotSettings->Paytable[$winLine['FirstSymbol']][$winLine['RepeatCount']] * $betline * $bonusMpl;
                        $totalWin += $lineWins[$r];
                        $strWinLine = $strWinLine . '&l'. $r.'='.$r.'~'.$lineWins[$r]. '~' . $winLine['StrLineWin'];
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
                    if($scattersCount >= 3){
                        $scattersWin = $betline * $lines * 2;
                    }
                    $totalWin = $totalWin + $scattersWin;
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
                    if($moonCount < 6){
                        $moonTotalWin = 0;
                    }
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
                            $response = '{"responseEvent":"error","responseType":"' . $slotEvent . '","serverResponse":"Bad Reel Strip"}';
                            exit( $response );
                        }
                        if( $scattersCount >= 3 && $winType != 'bonus' ) 
                        {
                        }else if( $moonCount >= 6 && $winType != 'win' ) 
                        {
                        }else if( $moonCount >= 6 && $scattersCount >= 3 ) 
                        {
                        }
                        else if( $moonTotalWin + $totalWin <= $_winAvaliableMoney && $winType == 'bonus' ) 
                        {
                            $_obf_0D163F390C080D0831380D161E12270D0225132B261501 = $slotSettings->GetBank((isset($slotEvent) ? $slotEvent : ''));
                            if( $_obf_0D163F390C080D0831380D161E12270D0225132B261501 < $_winAvaliableMoney ) 
                            {
                                $_winAvaliableMoney = $_obf_0D163F390C080D0831380D161E12270D0225132B261501;
                            }
                            else
                            {
                                break;
                            }
                        }
                        else if( $moonTotalWin + $totalWin > 0 && $moonTotalWin + $totalWin <= $_winAvaliableMoney && $winType == 'win' ) 
                        {
                            $_obf_0D163F390C080D0831380D161E12270D0225132B261501 = $slotSettings->GetBank((isset($slotEvent) ? $slotEvent : ''));
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
                if( $totalWin > 0) 
                {
                    $spinType = 'c';
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($slotEvent) ? $slotEvent : ''), -1 * $totalWin);
                }
                $_obf_totalWin = $totalWin;
                if( $scattersCount >= 3 ) 
                {
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') == 0 ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->slotFreeCount);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $slotSettings->slotFreeCount);
                    }
                }
                if( $moonCount >= 6 && $slotEvent != 'respin') 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 1);
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', $slotSettings->slotRespinCount);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                }
                $moonResult = [];
                $reelResult = [];
                for($k = 0; $k < 3; $k++){
                    for($j = 1; $j <= 5; $j++){
                        $lastReel[($j - 1) + $k * 5] = $reels['reel'.$j][$k];
                    }
                }
                for($k = 0; $k < 5; $k++){
                    $reelResult['reel' . ($k + 1)] = [];
                    $reelResult[$k] = [];
                    for($j = 0; $j < 3; $j++){
                        $reelResult['reel' . ($k + 1)][$j] = $reels['reel'.($k + 1)][$j];
                        $moonResult[$k][$j] = $_moonValue[$j * 5 + $k];
                    }
                }
                $strLastReel = implode(',', $lastReel);
                $strReelSa = $reels['reel1'][3].','.$reels['reel2'][3].','.$reels['reel3'][3].','.$reels['reel4'][3].','.$reels['reel5'][3];
                $strReelSb = $reels['reel1'][-1].','.$reels['reel2'][-1].','.$reels['reel3'][-1].','.$reels['reel4'][-1].','.$reels['reel5'][-1];
                
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                $slotSettings->SetGameData($slotSettings->slotId . 'MoonValue', $_moonValue);

                $_strResultMoon = '' . json_encode($moonResult) . '';
                $_strResult = '' . json_encode($reelResult) . '';
                $_strLineWins = '' . json_encode($lineWins) . '';
                $_strLineWinNum = '' . json_encode($lineWinNum) . '';

                $response = '{"responseEvent":"spin","responseType":"' . $slotEvent . '","serverResponse":{"bonusSymbol":' . $slotSettings->GetGameData($slotSettings->slotId . 'bonusSymbol') . ',"BetStep":' . $slotSettings->GetGameData($slotSettings->slotId . 'BetStep') . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame'). ',"RespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') . ',"CurrentRespinGame":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') . ',"totalWin":' . $totalWin . ',"winLines":'. $_strLineWins .',"winLineNum":' . $_strLineWinNum . ',"scaCount":' . $scattersCount . ',"RespiNum":' . $moonCount . ',"reelsSymbols":' . $_strResult . ',"resultMoons":' . $_strResultMoon . '}}';

                if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames')  <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0)) 
                {
                    if($moonCount < 6){
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    }
                }
                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"totalRespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') . ',"currentRespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin')  . ',"IsMoreRespin":' . $slotSettings->GetGameData($slotSettings->slotId . 'IsMoreRespin') . ',"winLines":[],"Jackpots":""' . ',"MoonValues":'.json_encode($_moonValue).',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $_obf_totalWin, $slotEvent);
                
                if( ($scattersCount >= 3 || $moonCount >= 6) && $slotEvent!='freespin' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $Balance);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                }
            }
            else if( $slotEvent == 'respin' ){
                $lastEvent = $slotSettings->GetHistory();
                $betline = $lastEvent->serverResponse->bet;
                $lines = 25;
                $moonsymbol = '11';
                $isFreeSpin = false;
                $isMoreRespin = false;
                if(( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') < $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') && $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') > 0 ) || $isMoreRespin == true) 
                {
                    $slotEvent = 'respin';
                }
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') <= $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                {
                    $isFreeSpin = true;
                }

                $bonusMpl = $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                $Balance = $slotSettings->GetBalance();
                // $_obf_winType = rand(1, $slotSettings->GetGambleSettings());
                $_obf_winType = rand(0, 1);
                $moreRespin = 0;
                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') + 1);
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
                    if( $moonCount < 10 && rand(0, 100) < 20){
                        $moreRespin = $slotSettings->GetMoreRespin();
                    }
                    if( $_obf_winType== 0 && $slotEvent == 'respin' &&  $moonChangedWin == false){
                        break;
                    }
                    else if( $slotSettings->GetBank((isset($slotEvent) ? $slotEvent : '')) > $moonTotalWin && $moonCount < 13 ) 
                    {
                        break;
                    }
                    else if($i > 500){
                        $_obf_winType = 0;
                    }
                }
                
                $slotSettings->SetGameData($slotSettings->slotId . 'IsMoreRespin', $moreRespin);
                $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames',  $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') + $moreRespin);
                $isEndRespin = false;
                $totalWin = 0;
                if($moonCount==15 || ($slotSettings->GetGameData($slotSettings->slotId . 'RespinGames')<= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') && $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') > 0 && $slotSettings->GetGameData($slotSettings->slotId . 'IsMoreRespin') == 0)){
                    $isEndRespin = true;
                    $totalWin = $moonTotalWin;
                    $moonTotalWin = 0;
                }
                $strLastReel = implode(',', $lastReel);
                $moonResult = [];
                $reelResult = [];
                for($k = 0; $k < 5; $k++){
                    $reelResult['reel' . ($k + 1)] = [];
                    $reelResult[$k] = [];
                    for($j = 0; $j < 3; $j++){
                        $reelResult['reel' . ($k + 1)][$j] = $lastReel[$k + $j * 5];
                        $moonResult[$k][$j] = $_moonValue[$j * 5 + $k];
                    }
                }

                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                $slotSettings->SetGameData($slotSettings->slotId . 'MoonValue', $_moonValue);
                
                $_strResultMoon = '' . json_encode($moonResult) . '';
                $_strResult = '' . json_encode($reelResult) . '';
                    
                if($isEndRespin == true) 
                {
                    if( $totalWin > 0) 
                    {
                        $slotSettings->SetBalance($totalWin);
                        $slotSettings->SetBank((isset($slotEvent) ? $slotEvent : ''), -1 * $totalWin);
                    }
                    if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0) || $isFreeSpin == false) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    }else if($isFreeSpin == true){
                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                    }
                }
                $response = '{"responseEvent":"spin","responseType":"respin","serverResponse":{"BetStep":' . $slotSettings->GetGameData($slotSettings->slotId . 'BetStep') . ',"RespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') . ',"CurrentRespinGame":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') . ',"moreRespin":' . $slotSettings->GetGameData($slotSettings->slotId . 'IsMoreRespin'). ',"totalWin":' . $totalWin. ',"RespiNum":' . $moonCount . ',"reelsSymbols":' . $_strResult . ',"resultMoons":' . $_strResultMoon . '}}';

                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"totalRespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') . ',"currentRespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin')   . ',"IsMoreRespin":' . $slotSettings->GetGameData($slotSettings->slotId . 'IsMoreRespin'). ',"winLines":[],"Jackpots":""' . 
                    ',"MoonValues":'.json_encode($_moonValue).',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $totalWin, $slotEvent);
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
        public function findZokbos($reels, $firstSymbol, $repeatCount, $strLineWin){
            $wild = '2';
            $bPathEnded = true;
            if($repeatCount < 5){
                for($r = 0; $r < 3; $r++){
                    if($firstSymbol == $reels['reel'.($repeatCount + 1)][$r] || $reels['reel'.($repeatCount + 1)][$r] == $wild){
                        $this->findZokbos($reels, $firstSymbol, $repeatCount + 1, $strLineWin . '~' . ($repeatCount + $r * 5));
                        $bPathEnded = false;
                    }
                }
            }
            if($bPathEnded == true){
                if($repeatCount >= 3){
                    $winLine = [];
                    $winLine['FirstSymbol'] = $firstSymbol;
                    $winLine['RepeatCount'] = $repeatCount;
                    $winLine['StrLineWin'] = $strLineWin;
                    array_push($this->winLines, $winLine);
                }
            }
        }
    }

}
