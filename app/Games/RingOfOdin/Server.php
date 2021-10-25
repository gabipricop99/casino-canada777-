<?php 
namespace VanguardLTE\Games\RingOfOdin
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
            \DB::beginTransaction();
            // $userId = \Auth::id();// changed by game developer
            if( $userId == null ) 
            {
            	$userId = 1;
            }
            $user = \VanguardLTE\User::lockForUpdate()->find($userId);
            $requestData = $_REQUEST;
            $paramData = trim(file_get_contents('php://input'));
            // $paramData = json_decode(trim(file_get_contents('php://input')), true);
            // $userBalance = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
            $paramData = explode("\r\n", $paramData);
            $requestData = [];
            $credits = $userId == 1 ? $slotEvent === 'getSettings' ? 5000 : $user->balance : null;
            $slotSettings = new SlotSettings($game, $userId, $credits);
            $userBalance = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
            $lastResponse = "";
            
            $linesId = [
                [1, 1, 1, 1, 1],
                [0, 0, 0, 0, 0],
                [2, 2, 2, 2, 2],
                [0, 1, 2, 1, 0],
                [2, 1, 0, 1, 2],
                [1, 0, 0, 0, 1],
                [1, 2, 2, 2, 1],
                [0, 0, 1, 2, 2],
                [2, 2, 1, 0, 0],
                [1, 2, 1, 0, 1]
            ];
            for($kk = 2; $kk < count($paramData); $kk++){
                $response = "";
                if(isset($paramData[$kk])){
                    $requestData = explode(" ", $paramData[$kk]);
                    if(isset($requestData[0]) && $requestData[0] == 101){
                        $response = "103 \"wtBI2CfHJIi!39939\"\r\n101 39939 \"CAD\" \"\" \"\" \"" . $user->username . "\" \"\"\r\n127 \"". date("Y-m-d H:i:s") . "\""; // KRW
                    }else if(isset($requestData[0]) && $requestData[0] == 102){
                        $response = "102 1";
                    }if(isset($requestData[0]) && $requestData[0] == 103){
                        $response = '103 "wtBI2CfHJIi"';
                    }else if(isset($requestData[0]) && $requestData[0] == 104){
                        $response = "104 1\r\n54 16 ". implode(' ', $slotSettings->Bet) ." 1\r\n57 \"<custom><RTP Value=\"96\" /></custom>'\r\n60 96 0\r\n52 ". ($user->balance * 100) ." 0 0\r\n83 0\r\n91 40517\r\n109";
                    }else if(isset($requestData[0]) && $requestData[0] == 0){
                        $response = '';
                    }else if(isset($requestData[0]) && $requestData[0] == 1){
                        $slotEvent = 'bet';
                        $lines = $requestData[2];
                        $coin = $requestData[1];
                        $coinValue = $requestData[3] / 100;
                        $betline = $coin * $coinValue;
                        $allbet = $betline * $lines;
                        if( $slotSettings->GetBalance() < ($allbet) ) 
                        {
                            $response = "d=90 0 0 7 \"\" 0\r\n52 0 0 0";
                            exit( $response );
                        }
                        $lastEvent = $slotSettings->GetHistory();
                        if( $slotEvent != 'freespin' ) 
                        {
                            $_sum = $allbet / 100 * $slotSettings->GetPercent();
                            $slotSettings->SetBank((isset($slotEvent) ? $slotEvent : ''), $_sum, $slotEvent);
                            $slotSettings->UpdateJackpots($allbet);
                            $slotSettings->SetBalance(-1 * $allbet, $slotEvent);
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                            $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                            $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                            $slotSettings->SetGameData($slotSettings->slotId . 'bonusSymbol', -1);
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                            $bonusMpl = 1;
                        }
                        else
                        {
                            if($lastEvent->serverResponse->CurrentBet != $betline && $lastEvent->serverResponse->CurrentCoin != $coinline){
                                $response = '{"responseEvent":"error","responseType":"' . $slotEvent . '","serverResponse":"invalid bet state"}';
                                exit( $response );
                            }
                            $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                            $bonusMpl = $slotSettings->slotFreeMpl;
                        }
                        $_spinSettings = $slotSettings->GetSpinSettings($slotEvent, $allbet, $lines);
                        $winType = $_spinSettings[0];
                        $_winAvaliableMoney = $_spinSettings[1];
                        $userBalance = sprintf('%01.2f', $slotSettings->GetBalance());
                        $reelgenrationCount = 0;
                        for( $i = 0; $i <= 2000; $i++ ) 
                        {
                            $reelgenrationCount = $i;
                            $totalWin = 0;
                            $lineWins = [];
                            $lineWinNum = [];
                            $arrWinLines = []; // 2 5 3 0 90
                            $wild = '8';
                            $scatter = '9';
                            $reels = $slotSettings->GetReelStrips($winType, $slotEvent);
                            $_lineWinNumber = 1;
                            for( $k = 0; $k < $lines; $k++ ) 
                            {
                                $_lineWin = '';
                                $firstEle = $reels['reel1'][$linesId[$k][0]];
                                $lineWinNum[$k] = 1;
                                $lineWins[$k] = 0;
                                for($j = 1; $j < 5; $j++){
                                    $ele = $reels['reel'. ($j + 1)][$linesId[$k][$j]];
                                    if($firstEle == $wild){
                                        $firstEle = $ele;
                                        $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                    }else if($ele == $firstEle || $ele == $wild){
                                        $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                        if($j == 4){
                                            $lineWins[$k] = $slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] * $betline;
                                            $_isLineWin = 1;
                                            $totalWin += $lineWins[$k];
                                            array_push($arrWinLines, [$k, $firstEle, $lineWinNum[$k], count($arrWinLines), $lineWins[$k]  / $coinValue]);
                                        }
                                    }else{
                                        if($slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] > 0){
                                            $lineWins[$k] = $slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] * $betline;
                                            $_isLineWin = 1;
                                            $totalWin += $lineWins[$k];
                                            array_push($arrWinLines, [$k, $firstEle, $lineWinNum[$k], count($arrWinLines), $lineWins[$k]  / $coinValue]);
                                        }else{
                                            $lineWinNum[$k] = 0;
                                        }
                                        break;
                                    }
                                }
                            }
                            $scattersWin = 0;
                            $scattersCount = 0;
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                if( $reels['reel' . $r][0] == $scatter || $reels['reel' . $r][1] == $scatter || $reels['reel' . $r][2] == $scatter ) 
                                {
                                    $scattersCount++;
                                }
                            }
                            $respinCount = 0;
                            $respinSymbol = $reels['reel3'][1];
                            if($scattersCount < 3 && $reels['reel3'][1] != $scatter && rand(0, 100) < 14){ 
                                $respinCount = 1;
                            }
                            $scattersWin = $slotSettings->Paytable['SYM_' . ($scatter + 1)][$scattersCount] * $allbet * $bonusMpl;
                            $totalWin += $scattersWin;
                            

                            if( $i > 1000 ) 
                            {
                                $winType = 'none';
                            }
                            if( $i > 1500 ) 
                            {
                                $response = "Bad Reel Strip";
                                exit( $response );
                            }
                            if( $scattersCount >= 3 && $winType != 'bonus' ) 
                            {
                            }
                            else if($respinCount > 0 && $winType == 'none'){

                            }
                            else if( $totalWin <= $_winAvaliableMoney && $winType == 'bonus' ) 
                            {
                                $_avaliableBank = $slotSettings->GetBank((isset($slotEvent) ? $slotEvent : ''));
                                if( $_avaliableBank < $_winAvaliableMoney ) 
                                {
                                    $_winAvaliableMoney = $_avaliableBank;
                                }
                                else
                                {
                                    break;
                                }
                            }
                            else if( $totalWin > 0 && $totalWin <= $_winAvaliableMoney && $winType == 'win' ) 
                            {
                                $_avaliableBank = $slotSettings->GetBank((isset($slotEvent) ? $slotEvent : ''));
                                if( $_avaliableBank < $_winAvaliableMoney ) 
                                {
                                    $_winAvaliableMoney = $_avaliableBank;
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
    
                        if( $totalWin > 0 ) 
                        {
                            $slotSettings->SetBank((isset($slotEvent) ? $slotEvent : ''), -1 * $totalWin);
                            $slotSettings->SetBalance($totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'TotalCoin', ($totalWin / $coinValue));
                        }
                        $_totalWin = $totalWin;
                        $currentFreeGame = 0;
                        $_isFreeGame = 0;
                        $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $betline);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lines);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CoinValue', $coinValue);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentStatus', 'NormalSpin');
                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinSymbol', -1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'IsRespinStart', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'IsFreespinStart', 0);
                        $spintype = 0; // 0:normalspin, 1 : freespin
                        if( $scattersCount >= 3 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->slotFreeCount);
                            $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                            $slotSettings->SetGameData($slotSettings->slotId . 'CurrentStatus', 'FreeSpin');
                            $slotSettings->SetGameData($slotSettings->slotId . 'IsFreespinStart', 1);
                            $spintype = 1;
                        }
                        if($respinCount > 0){
                            $slotSettings->SetGameData($slotSettings->slotId . 'RespinSymbol', $respinSymbol);
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'CurrentStatus', 'ReSpin');
                            $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 1);
                            $slotSettings->SetGameData($slotSettings->slotId . 'IsRespinStart', 1);
                            $spintype = 1;
                        }
                        $lastReel = [];
                        for($k = 1; $k <= 5; $k++){
                            for($r = 0; $r < 3; $r++){
                                array_push($lastReel, $reels['reel'.$k][$r]);
                            }
                        }
                        $_strResultReal = '' . json_encode($lastReel) . '';
                        $_strJackpot = '' . json_encode($slotSettings->Jackpots) . '';
                        $responseData = '{"responseEvent":"spin","responseType":"' . $slotEvent . '","serverResponse":{"Lines":' . $slotSettings->GetGameData($slotSettings->slotId . 'Lines') . ',"CurrentBet":' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet'). ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $userBalance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin. ',"totalCoin":' . ($totalWin / $coinValue) .  ',"RespinSymbol":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinSymbol').  ',"IsRespinStart":' . $slotSettings->GetGameData($slotSettings->slotId . 'IsRespinStart').  ',"IsFreespinStart":' . $slotSettings->GetGameData($slotSettings->slotId . 'IsFreespinStart'). ',"CoinValue":' . $coinValue. ',"RespinGames":' . $respinCount. ',"CurrentStatus":"' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentStatus').  '","winLines":[],"Jackpots":' . $_strJackpot . ',"LastReel":' . $_strResultReal . '}}';
                        
                        $slotSettings->SaveLogReport($responseData, $allbet, $lines, $_totalWin, $slotEvent);
                        
                        $strWinLines = "";
                        $str3result = "";
                        if($totalWin > 0){
                            for($k = 0; $k < count($arrWinLines); $k++){
                                $strWinLines = $strWinLines . implode(" ", $arrWinLines[$k]) . " ";
                            }
                            $str3result = "3 0 " . ($totalWin / $coinValue) . " " . ($totalWin * 100) . " ".$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames')." 1";
                        }else{
                            $str3result = "3 0 0 0 ".$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames')." 1" . "\r\n6 0\r\n52 " . ($slotSettings->GetBalance() * 100) . " 0 0";
                        }
                        $response="1 ". $coin ." ". $lines ." ". ($coinValue * 100) ." ". implode(" ", $lastReel) ." ". $spintype ." ". count($arrWinLines) ." ". $strWinLines ."6 3 0 5 5 4 8 7 0 5 ".$respinCount." 1\r\n";
                        if($scattersCount >= 3){          
                            $response=$response . "2 0 3 0 ".$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames')." 1\r\n2 2 1 ".$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames')."\r\n2 5 1";
                        }else if($respinCount > 0){
                            $response=$response . "2 0 0 ". $respinSymbol ." 0 0"."\r\n2 2 1 ".$respinCount."\r\n2 5 1";
                        }else{
                            $response = $response . $str3result;
                        }
                        // $response = "1 1 10 20 1 4 9 7 3 5 0 5 2 0 7 5 2 4 0 1 0 2 0 0 4 1 8 3 0 0 3 1 1\r\n2 0 0 4 0 0\r\n2 2 1 1\r\n2 5 1";
                    }else if(isset($requestData[0]) && $requestData[0] == 2){
                        $lastEvent = $slotSettings->GetHistory();
                        if($lastEvent == 'NULL'){
                            $response = "invalid freespin state";
                            exit( $response );
                        }else{
                            $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'CoinValue', $lastEvent->serverResponse->CoinValue);
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                            $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                            $slotSettings->SetGameData($slotSettings->slotId . 'RespinSymbol', $lastEvent->serverResponse->RespinSymbol);
                            $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->Lines);
                            $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $lastEvent->serverResponse->CurrentBet);
                            $slotSettings->SetGameData($slotSettings->slotId . 'CurrentStatus', $lastEvent->serverResponse->CurrentStatus);
                            $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', $lastEvent->serverResponse->RespinGames);
                            $slotSettings->SetGameData($slotSettings->slotId . 'IsRespinStart', $lastEvent->serverResponse->IsRespinStart);
                            $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastEvent->serverResponse->LastReel);
                            $slotSettings->SetGameData($slotSettings->slotId . 'IsFreespinStart', $lastEvent->serverResponse->IsFreespinStart);
                        }
                        $totalWin = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                        $coinValue = $slotSettings->GetGameData($slotSettings->slotId . 'CoinValue');
                        $totalFreeGames = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $currentFreeGame = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        $respinCount = $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames');
                        $respinSymbol = $slotSettings->GetGameData($slotSettings->slotId . 'RespinSymbol');
                        $betline = $slotSettings->GetGameData($slotSettings->slotId . 'Bet');
                        $lines = $slotSettings->GetGameData($slotSettings->slotId . 'Lines');
                        $currentStatus = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentStatus');
                        $isRespinStart = $slotSettings->GetGameData($slotSettings->slotId . 'IsRespinStart');
                        $isFreespinStart = $slotSettings->GetGameData($slotSettings->slotId . 'IsFreespinStart');
                        $coin = $betline / $coinValue;
                        $allbet = $betline * $lines;
                        $totalBonusWin = 0;
                        $userBalance = $slotSettings->GetBalance();
                        // if($respinCount > 0)
                        if($respinCount == 0){
                            if($currentFreeGame == 0){
                                $response = "2 " . $requestData[1] . "\r\n3 0 ".($totalWin/$coinValue)." ".($totalWin*100)." ".($totalFreeGames + $respinCount - $currentFreeGame)." 1\r\n";    
                            }else{
                                $response = "2 " . $requestData[1] . "\r\n3 0 ".($totalWin/$coinValue)." ".($totalWin*100)." ".($totalFreeGames + $respinCount - $currentFreeGame + 1)." 1\r\n";
                            }
                        }else{
                            $response = "2 " . $requestData[1] . "\r\n3 0 ".($totalWin/$coinValue)." ".($totalWin*100)." ".($totalFreeGames + $respinCount - $currentFreeGame)." 1\r\n";
                        }
                        
                        
                        if($isFreespinStart == 1){
                            if($isRespinStart == 1){
                                $reels = $slotSettings->GetGameData($slotSettings->slotId . 'LastReel');
                                $slotSettings->SetGameData($slotSettings->slotId . 'IsFreespinStart', 0);
                                $slotSettings->SetGameData($slotSettings->slotId . 'RespinSymbol', $reels[7]);
                                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                                $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 1);
                                $slotSettings->SetGameData($slotSettings->slotId . 'IsRespinStart', 1);
                                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $currentFreeGame + 1);
                                $response = "2 " . $requestData[1] . "\r\n2 0 0 ". $reels[7] ." 0 0"."\r\n2 2 1 1\r\n2 5 1";
                            }else{
                                for($i = 0; $i < 2000; $i++){
                                    $lineWins = [];
                                    $lineWinNum = [];
                                    $arrWinLines = []; // 2 5 3 0 90
                                    $wild = '8';
                                    $scatter = '9';
                                    $reels = $slotSettings->GetReelStrips('', 'freespin');
                                    $respinCount = 0;
                                    $freespinWin = 0;
                                    $_lineWinNumber = 1;
                                    $_avaliableBank = $slotSettings->GetBank('freespin');
                                    for( $k = 0; $k < $lines; $k++ ) 
                                    {
                                        $_lineWin = '';
                                        $firstEle = $reels['reel1'][$linesId[$k][0]];
                                        $lineWinNum[$k] = 1;
                                        $lineWins[$k] = 0;
                                        for($j = 1; $j < 5; $j++){
                                            $ele = $reels['reel'. ($j + 1)][$linesId[$k][$j]];
                                            if($firstEle == $wild){
                                                $firstEle = $ele;
                                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                            }else if($ele == $firstEle || $ele == $wild){
                                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                                if($j == 4){
                                                    $lineWins[$k] = $slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] * $betline;
                                                    $_isLineWin = 1;
                                                    $freespinWin += $lineWins[$k];
                                                    array_push($arrWinLines, [$k, $firstEle, $lineWinNum[$k], count($arrWinLines), $lineWins[$k]  / $coinValue]);
                                                }
                                            }else{
                                                if($slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] > 0){
                                                    $lineWins[$k] = $slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] * $betline;
                                                    $_isLineWin = 1;
                                                    $freespinWin += $lineWins[$k];
                                                    array_push($arrWinLines, [$k, $firstEle, $lineWinNum[$k], count($arrWinLines), $lineWins[$k]  / $coinValue]);
                                                }else{
                                                    $lineWinNum[$k] = 0;
                                                }
                                                break;
                                            }
                                        }
                                    }
                                    $scatterCount = 0;
                                    for( $r = 1; $r <= 5; $r++ ) 
                                    {
                                        if( $reels['reel' . $r][0] == $scatter || $reels['reel' . $r][1] == $scatter || $reels['reel' . $r][2] == $scatter ) 
                                        {
                                            $scatterCount++;
                                        }
                                    }
    
                                    
                                    if( ($totalWin + $freespinWin) < $_avaliableBank / 2) 
                                    {
                                        break;
                                    }
                                }
                                $lastReel = [];
                                $totalWin = $totalWin + $freespinWin;
                                $totalBonusWin = $totalBonusWin + $freespinWin;
                                for($k = 1; $k <= 5; $k++){
                                    for($r = 0; $r < 3; $r++){
                                        array_push($lastReel, $reels['reel'.$k][$r]);
                                    }
                                }
                                $strWinLines = "";
                                if($freespinWin > 0){
                                    for($k = 0; $k < count($arrWinLines); $k++){
                                        $strWinLines = $strWinLines . implode(" ", $arrWinLines[$k]) . " ";
                                    }
                                }
                                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                                $response=$response . "1 ". $coin ." ". $lines ." ". ($coinValue * 100) ." ". implode(" ", $lastReel) ." 1 ". count($arrWinLines) ." ". $strWinLines ."6 3 0 5 5 4 8 7 0 5 0 1\r\n";
                                $response = $response . "2 0 3 0 1 ".($scatterCount + 1)."\r\n2 2 1 ".$scatterCount."\r\n2 5 1\r\n";
                                $slotSettings->SetGameData($slotSettings->slotId . 'IsRespinStart', 1);
                                $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $totalFreeGames + $scatterCount);
                            }
                        }else{
                            if($isRespinStart == 1){
                                for($i = 0; $i < 2000; $i++){
                                    $lineWins = [];
                                    $lineWinNum = [];
                                    $arrWinLines = []; // 2 5 3 0 90
                                    $wild = '8';
                                    $scatter = '9';
                                    $reels = $slotSettings->GetReelStrips('', 'freespin');
                                    for( $r = 1; $r <= 5; $r++ ) 
                                    {
                                        for($k = 0; $k < 3; $k++){
                                            if($reels['reel' . $r][$k] == $scatter)
                                            $reels['reel' . $r][$k] = rand(0, 4);
                                        }
                                    }
                                    $respinCount = 0;
                                    $respinWin = 0;
                                    $_lineWinNumber = 1;
                                    $_avaliableBank = $slotSettings->GetBank('freespin');
                                    for( $k = 0; $k < $lines; $k++ ) 
                                    {
                                        $_lineWin = '';
                                        $firstEle = $reels['reel1'][$linesId[$k][0]];
                                        $lineWinNum[$k] = 1;
                                        $lineWins[$k] = 0;
                                        for($j = 1; $j < 5; $j++){
                                            $ele = $reels['reel'. ($j + 1)][$linesId[$k][$j]];
                                            if($firstEle == $wild){
                                                $firstEle = $ele;
                                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                            }else if($ele == $firstEle || $ele == $wild){
                                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                                if($j == 4){
                                                    $lineWins[$k] = $slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] * $betline;
                                                    $_isLineWin = 1;
                                                    $respinWin += $lineWins[$k];
                                                    array_push($arrWinLines, [$k, $firstEle, $lineWinNum[$k], count($arrWinLines), $lineWins[$k]  / $coinValue]);
                                                }
                                            }else{
                                                if($slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] > 0){
                                                    $lineWins[$k] = $slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] * $betline;
                                                    $_isLineWin = 1;
                                                    $respinWin += $lineWins[$k];
                                                    array_push($arrWinLines, [$k, $firstEle, $lineWinNum[$k], count($arrWinLines), $lineWins[$k]  / $coinValue]);
                                                }else{
                                                    $lineWinNum[$k] = 0;
                                                }
                                                break;
                                            }
                                        }
                                    }
                                    for( $r = 2; $r <= 4; $r++ ) 
                                    {
                                        if( $reels['reel' . $r][0] == $respinSymbol || $reels['reel' . $r][1] == $respinSymbol || $reels['reel' . $r][2] == $respinSymbol ) 
                                        {
                                            $respinCount++;
                                        }
                                    }
    
                                    
                                    if( ($totalWin + $respinWin) < $_avaliableBank / 2) 
                                    {
                                        break;
                                    }
                                }
                                $lastReel = [];
                                $totalWin = $totalWin + $respinWin;
                                $totalBonusWin = $totalBonusWin + $respinWin;
                                
                                for($k = 1; $k <= 5; $k++){
                                    for($r = 0; $r < 3; $r++){
                                        array_push($lastReel, $reels['reel'.$k][$r]);
                                    }
                                }
                                $strWinLines = "";
                                if($respinWin > 0){
                                    for($k = 0; $k < count($arrWinLines); $k++){
                                        $strWinLines = $strWinLines . implode(" ", $arrWinLines[$k]) . " ";
                                    }
                                }
                                $response=$response . "1 ". $coin ." ". $lines ." ". ($coinValue * 100) ." ". implode(" ", $lastReel) ." 1 ". count($arrWinLines) ." ". $strWinLines ."6 3 0 5 5 4 8 7 0 5 ".$respinCount." 1\r\n";
                                if($respinCount == 0){
                                    if($currentStatus == "ReSpin"){
                                        $response = $response . "3 0 ".($totalWin / $coinValue)." ".($totalWin * 100)." ".($totalFreeGames + $respinCount - $currentFreeGame)." 1\r\n";
                                        if($totalWin == 0){
                                            $response = $response . "6 0\r\n52 ". ($slotSettings->GetBalance() * 100) ." 0 0";
                                        }else{
                                            $slotSettings->SetBank('respin', -1 * $totalWin);
                                            $slotSettings->SetBalance($totalWin);
                                        }
                                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', $respinCount);
                                        $slotSettings->SetGameData($slotSettings->slotId . 'IsRespinStart', 0);
                                    }else{                                        
                                        if($slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames')){
                                            $response = $response . "3 0 ".($totalWin / $coinValue)." ".($totalWin * 100)." ".($totalFreeGames + $respinCount - $currentFreeGame)." 1\r\n";
                                            for($i = 0; $i < 2000; $i++){
                                                $lineWins = [];
                                                $lineWinNum = [];
                                                $arrWinLines = []; // 2 5 3 0 90
                                                $wild = '8';
                                                $scatter = '9';
                                                $reels = $slotSettings->GetReelStrips('', 'freespin');
                                                for( $r = 1; $r <= 5; $r++ ) 
                                                {
                                                    for($k = 0; $k < 3; $k++){
                                                        if($reels['reel' . $r][$k] == $scatter)
                                                        $reels['reel' . $r][$k] = rand(0, 4);
                                                    }
                                                }
                                                $respinCount = 0;
                                                $freespinWin = 0;
                                                $_lineWinNumber = 1;
                                                $_avaliableBank = $slotSettings->GetBank('freespin');
                                                for( $k = 0; $k < $lines; $k++ ) 
                                                {
                                                    $_lineWin = '';
                                                    $firstEle = $reels['reel1'][$linesId[$k][0]];
                                                    $lineWinNum[$k] = 1;
                                                    $lineWins[$k] = 0;
                                                    for($j = 1; $j < 5; $j++){
                                                        $ele = $reels['reel'. ($j + 1)][$linesId[$k][$j]];
                                                        if($firstEle == $wild){
                                                            $firstEle = $ele;
                                                            $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                                        }else if($ele == $firstEle || $ele == $wild){
                                                            $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                                            if($j == 4){
                                                                $lineWins[$k] = $slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] * $betline;
                                                                $_isLineWin = 1;
                                                                $freespinWin += $lineWins[$k];
                                                                array_push($arrWinLines, [$k, $firstEle, $lineWinNum[$k], count($arrWinLines), $lineWins[$k]  / $coinValue]);
                                                            }
                                                        }else{
                                                            if($slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] > 0){
                                                                $lineWins[$k] = $slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] * $betline;
                                                                $_isLineWin = 1;
                                                                $freespinWin += $lineWins[$k];
                                                                array_push($arrWinLines, [$k, $firstEle, $lineWinNum[$k], count($arrWinLines), $lineWins[$k]  / $coinValue]);
                                                            }else{
                                                                $lineWinNum[$k] = 0;
                                                            }
                                                            break;
                                                        }
                                                    }
                                                }
                                                $scatterCount = 0;
                                                for( $r = 1; $r <= 5; $r++ ) 
                                                {
                                                    if( $reels['reel' . $r][0] == $scatter || $reels['reel' . $r][1] == $scatter || $reels['reel' . $r][2] == $scatter ) 
                                                    {
                                                        $scatterCount++;
                                                    }
                                                }
                
                                                
                                                if( ($totalWin + $freespinWin) < $_avaliableBank / 2) 
                                                {
                                                    break;
                                                }
                                            }
                                            $lastReel = [];
                                            $totalWin = $totalWin + $freespinWin;
                                            $totalBonusWin = $totalBonusWin + $freespinWin;
                                            for($k = 1; $k <= 5; $k++){
                                                for($r = 0; $r < 3; $r++){
                                                    array_push($lastReel, $reels['reel'.$k][$r]);
                                                }
                                            }
                                            $strWinLines = "";
                                            if($freespinWin > 0){
                                                for($k = 0; $k < count($arrWinLines); $k++){
                                                    $strWinLines = $strWinLines . implode(" ", $arrWinLines[$k]) . " ";
                                                }
                                            }
                                            $slotSettings->SetGameData($slotSettings->slotId . 'RespinSymbol', $reels['reel3'][1]);
                                            $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 1);
                                            $slotSettings->SetGameData($slotSettings->slotId . 'IsRespinStart', 1);
                                            $spintype = 1;
                                            $response=$response."1 ". $coin ." ". $lines ." ". ($coinValue * 100) ." ". implode(" ", $lastReel) ." ". $spintype ." ". count($arrWinLines) ." ". $strWinLines ."6 3 0 5 5 4 8 7 0 5 1 1\r\n";
                                            $response=$response . "2 0 0 ". $reels['reel3'][1] ." 0 0"."\r\n2 2 1 1\r\n2 5 1";
                                            $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $currentFreeGame + 1);
                                        }else{
                                            $response = $response . "3 0 ".($totalWin / $coinValue)." ".($totalWin * 100)." ".($totalFreeGames + $respinCount - $currentFreeGame)." 1\r\n";
                                        }
                                    }
                                }else{
                                    $response = $response . "2 0 1 ".$respinSymbol." ".$respinCount." 0\r\n2 2 1 ".$respinCount."\r\n2 5 1\r\n";
                                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', $respinCount);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'IsRespinStart', 0);
                                }
                                
                            }else{
                                while($respinCount > 0){
                                    $reSpinWin = 0;
                                    $lineWins = [];
                                    $lineWinNum = [];
                                    $arrWinLines = []; // 2 5 3 0 90
                                    $wild = '8';
                                    $scatter = '9';
                                    $_avaliableBank = $slotSettings->GetBank('freespin');
                                    $reels = $slotSettings->GetReelStrips('', 'freespin');
                                    for( $r = 1; $r <= 5; $r++ ) 
                                    {
                                        for($k = 0; $k < 3; $k++){
                                            if($reels['reel' . $r][$k] == $scatter)
                                            $reels['reel' . $r][$k] = rand(0, 4);
                                        }
                                    }
                                    $scattersCount = 0;
                                    $bonusSymbolCount = 0;
                                    for( $r = 2; $r <= 4; $r++ ) 
                                    {
                                        for($k = 0; $k < 3; $k++){
                                            $reels['reel' . $r][$k] = $respinSymbol;
                                        }
                                    }
                                    $_lineWinNumber = 1;
                                    for( $k = 0; $k < $lines; $k++ ) 
                                    {
                                        $_lineWin = '';
                                        $firstEle = $reels['reel1'][$linesId[$k][0]];
                                        $lineWinNum[$k] = 1;
                                        $lineWins[$k] = 0;
                                        for($j = 1; $j < 5; $j++){
                                            $ele = $reels['reel'. ($j + 1)][$linesId[$k][$j]];
                                            if($firstEle == $wild){
                                                $firstEle = $ele;
                                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                            }else if($ele == $firstEle || $ele == $wild){
                                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                                if($j == 4){
                                                    $lineWins[$k] = $slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] * $betline;
                                                    $_isLineWin = 1;
                                                    $reSpinWin += $lineWins[$k];
                                                    array_push($arrWinLines, [$k, $firstEle, $lineWinNum[$k], count($arrWinLines), $lineWins[$k]  / $coinValue]);
                                                }
                                            }else{
                                                if($slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] > 0){
                                                    $lineWins[$k] = $slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] * $betline;
                                                    $_isLineWin = 1;
                                                    $reSpinWin += $lineWins[$k];
                                                    array_push($arrWinLines, [$k, $firstEle, $lineWinNum[$k], count($arrWinLines), $lineWins[$k]  / $coinValue]);
                                                }else{
                                                    $lineWinNum[$k] = 0;
                                                }
                                                break;
                                            }
                                        }
                                    }
                                    
                                    if( ($totalWin + $reSpinWin) < $_avaliableBank / 2) 
                                    {
                                        $lastReel = [];
                                        $totalWin = $totalWin + $reSpinWin;
                                        $totalBonusWin = $totalBonusWin + $reSpinWin;
                                        for($k = 1; $k <= 5; $k++){
                                            for($r = 0; $r < 3; $r++){
                                                array_push($lastReel, $reels['reel'.$k][$r]);
                                            }
                                        }
                                        $strWinLines = "";
                                        if($reSpinWin > 0){
                                            for($k = 0; $k < count($arrWinLines); $k++){
                                                $strWinLines = $strWinLines . implode(" ", $arrWinLines[$k]) . " ";
                                            }
                                        }
                                        $response=$response . "1 ". $coin ." ". $lines ." ". ($coinValue * 100) ." ". implode(" ", $lastReel) ." 1 ". count($arrWinLines) ." ". $strWinLines ."6 3 0 5 5 4 8 7 0 5 ".$respinCount." 1\r\n";
                                        $respinCount = $respinCount - 1;
                                        if($respinCount == 0){
                                            $response = $response . "3 0 ".($totalWin / $coinValue)." ".($totalWin * 100)." ".($totalFreeGames + $respinCount - $currentFreeGame)." 1\r\n";
                                        }else{
                                            $response = $response . "3 0 ".($totalWin / $coinValue)." ".($totalWin * 100)." ".($totalFreeGames + $respinCount - $currentFreeGame)." 1\r\n";
                                        }
                                    }
                                }
                                if($totalFreeGames > 0){
                                    if($slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames')){
                                        for($i = 0; $i < 2000; $i++){
                                            $lineWins = [];
                                            $lineWinNum = [];
                                            $arrWinLines = []; // 2 5 3 0 90
                                            $wild = '8';
                                            $scatter = '9';
                                            $reels = $slotSettings->GetReelStrips('', 'freespin');
                                            for( $r = 1; $r <= 5; $r++ ) 
                                            {
                                                for($k = 0; $k < 3; $k++){
                                                    if($reels['reel' . $r][$k] == $scatter)
                                                    $reels['reel' . $r][$k] = rand(0, 4);
                                                }
                                            }
                                            $respinCount = 0;
                                            $freespinWin = 0;
                                            $_lineWinNumber = 1;
                                            $_avaliableBank = $slotSettings->GetBank('freespin');
                                            for( $k = 0; $k < $lines; $k++ ) 
                                            {
                                                $_lineWin = '';
                                                $firstEle = $reels['reel1'][$linesId[$k][0]];
                                                $lineWinNum[$k] = 1;
                                                $lineWins[$k] = 0;
                                                for($j = 1; $j < 5; $j++){
                                                    $ele = $reels['reel'. ($j + 1)][$linesId[$k][$j]];
                                                    if($firstEle == $wild){
                                                        $firstEle = $ele;
                                                        $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                                    }else if($ele == $firstEle || $ele == $wild){
                                                        $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                                        if($j == 4){
                                                            $lineWins[$k] = $slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] * $betline;
                                                            $_isLineWin = 1;
                                                            $freespinWin += $lineWins[$k];
                                                            array_push($arrWinLines, [$k, $firstEle, $lineWinNum[$k], count($arrWinLines), $lineWins[$k]  / $coinValue]);
                                                        }
                                                    }else{
                                                        if($slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] > 0){
                                                            $lineWins[$k] = $slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] * $betline;
                                                            $_isLineWin = 1;
                                                            $freespinWin += $lineWins[$k];
                                                            array_push($arrWinLines, [$k, $firstEle, $lineWinNum[$k], count($arrWinLines), $lineWins[$k]  / $coinValue]);
                                                        }else{
                                                            $lineWinNum[$k] = 0;
                                                        }
                                                        break;
                                                    }
                                                }
                                            }
                                            $scatterCount = 0;
                                            for( $r = 1; $r <= 5; $r++ ) 
                                            {
                                                if( $reels['reel' . $r][0] == $scatter || $reels['reel' . $r][1] == $scatter || $reels['reel' . $r][2] == $scatter ) 
                                                {
                                                    $scatterCount++;
                                                }
                                            }
            
                                            
                                            if( ($totalWin + $freespinWin) < $_avaliableBank / 2) 
                                            {
                                                break;
                                            }
                                        }
                                        $lastReel = [];
                                        $totalWin = $totalWin + $freespinWin;
                                        $totalBonusWin = $totalBonusWin + $freespinWin;
                                        for($k = 1; $k <= 5; $k++){
                                            for($r = 0; $r < 3; $r++){
                                                array_push($lastReel, $reels['reel'.$k][$r]);
                                            }
                                        }
                                        $strWinLines = "";
                                        if($freespinWin > 0){
                                            for($k = 0; $k < count($arrWinLines); $k++){
                                                $strWinLines = $strWinLines . implode(" ", $arrWinLines[$k]) . " ";
                                            }
                                        }
                                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinSymbol', $reels['reel3'][1]);
                                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 1);
                                        $slotSettings->SetGameData($slotSettings->slotId . 'IsRespinStart', 1);
                                        $spintype = 1;
                                        $response=$response."1 ". $coin ." ". $lines ." ". ($coinValue * 100) ." ". implode(" ", $lastReel) ." ". $spintype ." ". count($arrWinLines) ." ". $strWinLines ."6 3 0 5 5 4 8 7 0 5 1 1\r\n";
                                        $response=$response . "2 0 0 ". $reels['reel3'][1] ." 0 0"."\r\n2 2 1 1\r\n2 5 1";
                                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $currentFreeGame + 1);
                                    }
                                }
                            }
                        }
                        if( $totalBonusWin > 0 ) 
                        {
                            $slotSettings->SetBank('respin', -1 * $totalBonusWin);
                            $slotSettings->SetBalance($totalBonusWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                        }
                        $responseData = '{"responseEvent":"spin","responseType":"' . $currentStatus . '","serverResponse":{"Lines":' . $slotSettings->GetGameData($slotSettings->slotId . 'Lines') . ',"CurrentBet":' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet'). ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $userBalance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin. ',"totalCoin":' . ($totalWin / $coinValue) .  ',"RespinSymbol":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinSymbol').  ',"IsRespinStart":' . $slotSettings->GetGameData($slotSettings->slotId . 'IsRespinStart').  ',"IsFreespinStart":' . $slotSettings->GetGameData($slotSettings->slotId . 'IsFreespinStart'). ',"CoinValue":' . $coinValue. ',"RespinGames":' . $respinCount. ',"CurrentStatus":"' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentStatus').  '","winLines":[],"LastReel":'.json_encode($slotSettings->GetGameData($slotSettings->slotId . 'LastReel')).',"Response":"'. str_replace("\r\n", ";" , $response) .'"}}';                        
                        $slotSettings->SaveLogReport($responseData, $allbet, $lines, $totalWin, $currentStatus);
                    }else if(isset($requestData[0]) && $requestData[0] == 4){
                        $lastEvent = $slotSettings->GetHistory();
                        if($requestData[1] > 0){
                            $slotEvent = 'gamble';
                            $_totalWin = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                            $_totalCoin = $slotSettings->GetGameData($slotSettings->slotId . 'TotalCoin');
                            if($_totalWin > 0){
                                $_betMoney = $_totalWin;
                                $gambleChoice = $requestData[1];
                                $doubleWin =  rand(0, 100);
                                $multi = 2;
                                if($gambleChoice > 3){
                                    $multi = 4;
                                }
                                $_currentBank = $slotSettings->GetBank((isset($slotEvent) ? $slotEvent : ''));
                                if( $_currentBank < ($_totalWin * $multi) ) 
                                {
                                    $doubleWin = 0;
                                }
                                $cardNum = -1;
                                $_resultWin = 0;
                                $_resultCoin = 0;
                                if( $doubleWin > 60 ) 
                                {
                                    $_resultWin = $_totalWin * $multi;
                                    $_resultCoin = $_totalCoin * $multi;
                                    if($gambleChoice == 1){
                                        if($doubleWin > 80){
                                            $cardNum = rand(13, 25);
                                        }else{
                                            $cardNum = rand(39, 51);
                                        }
                                    }else if($gambleChoice == 3){
                                        if($doubleWin > 80){
                                            $cardNum = rand(0, 12);
                                        }else{
                                            $cardNum = rand(26, 38);
                                        }
                                    }else if($gambleChoice == 4){
                                        $cardNum = rand(0, 12);
                                    }else if($gambleChoice == 5){
                                        $cardNum = rand(13, 25);
                                    }else if($gambleChoice == 6){
                                        $cardNum = rand(26, 38);
                                    }else if($gambleChoice == 7){
                                        $cardNum = rand(39, 51);
                                    }
                                }else{
                                    if($gambleChoice == 1){
                                        if($doubleWin > 30){
                                            $cardNum = rand(0, 12);
                                        }else{
                                            $cardNum = rand(26, 38);
                                        }
                                    }else if($gambleChoice == 3){
                                        if($doubleWin > 30){
                                            $cardNum = rand(13, 25);
                                        }else{
                                            $cardNum = rand(39, 51);
                                        }
                                    }else if($gambleChoice == 4){
                                        $cardNum = rand(13, 51);
                                    }else if($gambleChoice == 5){
                                        $cardNum = rand(26, 51);
                                    }else if($gambleChoice == 6){
                                        $cardNum = rand(0, 25);
                                    }else if($gambleChoice == 7){
                                        $cardNum = rand(0, 38);
                                    }
                                }
                                $_cardHistories = $slotSettings->GetGameData($slotSettings->slotId . 'CardsHistory');
                                if($_cardHistories == null){
                                    $_cardHistories = [];
                                }
                                if(count($_cardHistories) >= 10){
                                    array_splice($_cardHistories, 0 ,1);                        
                                }
                                array_push($_cardHistories, $cardNum);
                                $slotSettings->SetGameData($slotSettings->slotId . 'CardsHistory', $_cardHistories);
                                $slotSettings->SetBalance($_resultWin - $_totalWin);
                                $slotSettings->SetBank((isset($slotEvent) ? $slotEvent : ''), -1 * $_totalWin);
                                $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $_resultWin);
                                $slotSettings->SetGameData($slotSettings->slotId . 'TotalCoin', $_resultCoin);
                                $_cardLogData = '{"responseEvent":"gambleResult","serverResponse":{"totalWin":' . $_resultWin . '}}';
                                $slotSettings->SaveLogReport($_cardLogData, 0, 1, $_resultWin, 'slotGamble');
                                if($_resultWin > 0){
                                    $response = "4 " . $requestData[1] . " " . $multi . " " . $_resultCoin . " " . $cardNum . " 0";
                                }else{                                    
                                    $response = "4 " . $requestData[1] . " 0 0 " . $cardNum . " 0\r\n6 0\r\n52".($slotSettings->GetBalance() * 100)." 0 0";
                                }
                            }else{
                                $response = "5 " . $lastEvent->serverResponse->totalCoin . "\r\n6 ".($lastEvent->serverResponse->totalWin * 100)."\r\n52 ".($slotSettings->GetBalance() * 100)." 0 0";    
                            }
                        }else{
                            $response = "5 " . $lastEvent->serverResponse->totalCoin . "\r\n6 ".($lastEvent->serverResponse->totalWin * 100)."\r\n52 ".($slotSettings->GetBalance() * 100)." 0 0";
                        }
                    }else if(isset($requestData[0]) && $requestData[0] == 7){
                        $response = "83 " . $requestData[1];
                    }

                    if($lastResponse == ""){
                        $lastResponse = "d=" . $response;
                    }else{
                        $lastResponse = $lastResponse . "\r\n" . $response;
                    }
                }
            }
            
            $slotSettings->SaveGameData();
            \DB::commit();
            return $lastResponse;
        }
    }

}

