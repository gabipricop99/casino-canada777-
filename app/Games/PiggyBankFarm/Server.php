<?php 
namespace VanguardLTE\Games\PiggyBankFarm
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
                [0,0,0,0,0],
                [0,0,1,0,0],
                [0,1,1,1,0],
                [0,1,2,1,0],
                [0,1,0,1,0],
                [0,0,0,1,0],
                [0,1,0,0,0],
                [0,0,1,1,0],
                [0,1,1,0,0],
                [0,0,2,0,0],
                [0,0,2,1,0],
                [0,1,2,0,0],
                [1,1,1,1,1],
                [1,1,2,1,1],
                [1,1,0,1,1],
                [1,2,2,2,1],
                [1,0,0,0,1],
                [1,2,1,2,1],
                [1,0,1,0,1],
                [1,1,1,2,1],
                [1,1,1,0,1],
                [1,2,1,1,1],
                [1,0,1,1,1],
                [1,2,0,2,1],
                [1,0,2,0,1],
                [2,2,2,2,2],
                [2,2,3,2,2],
                [2,2,1,2,2],
                [2,3,3,3,2],
                [2,1,1,1,2],
                [2,3,2,3,2],
                [2,1,2,1,2],
                [2,2,2,3,2],
                [2,2,2,1,2],
                [2,3,2,2,2],
                [2,1,2,2,2],
                [2,3,1,3,2],
                [2,1,3,1,2],
                [3,3,3,3,3],
                [3,3,2,3,3],
                [3,2,2,2,3],
                [3,2,1,2,3],
                [3,2,3,2,3],
                [3,3,3,2,3],
                [3,2,3,3,3],
                [3,3,2,2,3],
                [3,2,2,3,3],
                [3,3,1,3,3],
                [3,3,1,2,3],
                [3,2,1,3,3],
            ];
            for($kk = 2; $kk < count($paramData); $kk++){
                $response = "";
                if(isset($paramData[$kk])){
                    $requestData = explode(" ", $paramData[$kk]);
                    if(isset($requestData[0]) && $requestData[0] == 101){
                        $response = "103 \"0T1cpVLFL5p!39939\"\r\n101 39939 \"CAD\" \"\" \"\" \"" . $user->username . "\" \"\"\r\n127 \"". date("Y-m-d H:i:s") . "\""; // KRW
                    }else if(isset($requestData[0]) && $requestData[0] == 102){
                        $response = "102 1";
                    }if(isset($requestData[0]) && $requestData[0] == 103){
                        $response = '103 "0T1cpVLFL5p"';
                    }else if(isset($requestData[0]) && $requestData[0] == 104){
                        $lastEvent = $slotSettings->GetHistory();
                        $response = "";
                        $bet = 0;
                        $currentFreeIndex = 0;
                        if( $lastEvent != 'NULL' ) 
                        {                            
                            $totalFreeGames = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                            $currentFreeGame = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                            $betline = $slotSettings->GetGameData($slotSettings->slotId . 'Bet');
                            $line = $slotSettings->GetGameData($slotSettings->slotId . 'Lines');
                            $coinValue = $slotSettings->GetGameData($slotSettings->slotId . 'CoinValue');
                            $currentRespinGame = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame');
                            if(($totalFreeGames > 0 && $totalFreeGames > $currentFreeGame) || $currentRespinGame > 0){
                                $currentFreeIndex = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeIndex');
                                $bet = $coinValue * 100;
                                $response = str_replace(";","\r\n",$lastEvent->serverResponse->response) . "\r\n";
                            }
                        }
                        $response = "104 1\r\n54 17 ". implode(' ', $slotSettings->Bet) ." 1\r\n57 \"<custom><RTP Value=\"96\" /></custom>'\r\n60 96 0\r\n52 ". ($user->balance * 100) ." 1  ". $bet ."\r\n83 ".$currentFreeIndex."\r\n91 185501564\r\n". $response ."109";
                    }else if(isset($requestData[0]) && $requestData[0] == 0){
                        $response = '';
                    }else if(isset($requestData[0]) && $requestData[0] == 1){
                        $slotEvent = 'bet';
                        $lines = 50; //$requestData[2];
                        $coin = $requestData[1];
                        $coinValue = $requestData[3] / 100;
                        $betline = $coin * $coinValue / 50;
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
                            $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                            $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
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
                            $wild = '9';
                            $scatter = '10';
                            
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
                            $respinCount = 0;
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                if( $reels['reel' . $r][0] == $scatter || $reels['reel' . $r][1] == $scatter || $reels['reel' . $r][2] == $scatter || $reels['reel' . $r][3] == $scatter ) 
                                {
                                    $scattersCount++;
                                }
                                if($r == 5 && ($reels['reel' . $r][0] == 12 || $reels['reel' . $r][1] == 12 || $reels['reel' . $r][2] == 12 || $reels['reel' . $r][3] == 12)){
                                    $respinCount++;
                                }
                            }
                            $scattersWin = $slotSettings->Paytable['SYM_' . ($scatter + 1)][$scattersCount] * $allbet * $bonusMpl;
                            $totalWin += $scattersWin;
                            
                            if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($allbet * rand(2, 5)) ) 
                            {
                            }
                            else if( !$slotSettings->increaseRTP && $winType == 'win' && $allbet < $totalWin ) 
                            {
                            }
                            else
                            {
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
                                else if( ($totalWin > 0 || $respinCount > 0) && $totalWin <= $_winAvaliableMoney && $winType == 'win' ) 
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
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentStatus', 0); // 0 : normal spin, 1 : freespin, 2 : respin
                        $slotSettings->SetGameData($slotSettings->slotId . 'IsRespinStart', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeIndex', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Mul', 0);
                        $spintype = 0; // 0:normalspin, 1 : freespin
                        if( $scattersCount >= 3 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->slotFreeCount);
                            $slotSettings->SetGameData($slotSettings->slotId . 'CurrentStatus', 1);
                            $spintype = 1;
                        }
                        if($respinCount > 0){
                            $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 3);
                            $slotSettings->SetGameData($slotSettings->slotId . 'CurrentStatus', 2);
                            $slotSettings->SetGameData($slotSettings->slotId . 'IsRespinStart', 1);
                        }
                        $lastReel = [];
                        for($k = 1; $k <= 5; $k++){
                            for($r = 0; $r < 4; $r++){
                                array_push($lastReel, $reels['reel'.$k][$r]);
                            }
                        }
                        $_strResultReal = '' . json_encode($lastReel) . '';
                        $_strJackpot = '' . json_encode($slotSettings->Jackpots) . '';
                        
                        $strWinLines = "";
                        $str3result = "";
                        if($totalWin > 0){
                            for($k = 0; $k < count($arrWinLines); $k++){
                                $strWinLines = $strWinLines . implode(" ", $arrWinLines[$k]) . " ";
                            }
                            $str3result = "3 1 " . ($totalWin / $coinValue) . " " . ($totalWin * 100) . " ".$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames')." 1";
                        }else{
                            $str3result = "3 1 0 0 ".$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames')." 1" . "\r\n6 0\r\n52 " . ($slotSettings->GetBalance() * 100) . " 0 0";
                        }
                        $response="1 ". $coin ." 1 ". ($coinValue * 100) ." ". implode(" ", $lastReel) ." ". $spintype ." ". count($arrWinLines) ." ". $strWinLines ."6 3 0 5 5 4 8 7 0 5\r\n";
                        if($scattersCount >= 3){          
                            $response=$response . "2 0 0 ".$scatter." ".$scattersCount." 0\r\n2 2 0 ".($scattersWin / $coinValue)."\r\n2 2 1 ".$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames')."\r\n2 5 1";
                        }else if($respinCount > 0){
                            $response=$response . "2 0 0 12 ".$respinCount." 0\r\n2 2 1 ".$slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame')."\r\n2 5 1";
                        }else{
                            $response = $response . $str3result;
                        }

                        $responseData = '{"responseEvent":"spin","responseType":"' . $slotEvent . '","serverResponse":{"Lines":' . $slotSettings->GetGameData($slotSettings->slotId . 'Lines') . ',"CurrentBet":' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet'). ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"CurrentFreeGame":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"CurrentRespinGame":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') . ',"CurrentStatus":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentStatus') . ',"Mul":' . $slotSettings->GetGameData($slotSettings->slotId . 'Mul') . ',"IsRespinStart":' . $slotSettings->GetGameData($slotSettings->slotId . 'IsRespinStart')  . ',"Balance":' . $userBalance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin. ',"totalCoin":' . ($totalWin / $coinValue). ',"CoinValue":' . $coinValue.  ',"winLines":[],"Jackpots":' . $_strJackpot . ',"response":"' . str_replace("\r\n",";",$response) . '","LastReel":' . $_strResultReal . '}}';
                        
                        $slotSettings->SaveLogReport($responseData, $allbet, $lines, $_totalWin, $slotEvent);
                    }else if(isset($requestData[0]) && $requestData[0] == 2){
                        $lastEvent = $slotSettings->GetHistory();
                        $lastResponse = "";
                        if($lastEvent == 'NULL'){
                            $response = "invalid freespin state";
                            exit( $response );
                        }else{
                            $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'CoinValue', $lastEvent->serverResponse->CoinValue);
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                            $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->CurrentFreeGame);
                            $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', $lastEvent->serverResponse->CurrentRespinGame);
                            $slotSettings->SetGameData($slotSettings->slotId . 'CurrentStatus', $lastEvent->serverResponse->CurrentStatus);
                            $slotSettings->SetGameData($slotSettings->slotId . 'IsRespinStart', $lastEvent->serverResponse->IsRespinStart);
                            $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastEvent->serverResponse->LastReel);
                            $slotSettings->SetGameData($slotSettings->slotId . 'Mul', $lastEvent->serverResponse->Mul);
                            $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->Lines);
                            $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $lastEvent->serverResponse->CurrentBet);
                            $lastResponse = $lastEvent->serverResponse->response;
                        }
                        $totalWin = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                        $coinValue = $slotSettings->GetGameData($slotSettings->slotId . 'CoinValue');
                        $totalFreeGames = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $currentFreeGame = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        $currentRespinGame = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame');
                        $currentStatus = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentStatus');
                        $isRespinStart = $slotSettings->GetGameData($slotSettings->slotId . 'IsRespinStart');
                        $lastReel = $slotSettings->GetGameData($slotSettings->slotId . 'LastReel');
                        $mul = $slotSettings->GetGameData($slotSettings->slotId . 'Mul');
                        $betline = $slotSettings->GetGameData($slotSettings->slotId . 'Bet');
                        $lines = $slotSettings->GetGameData($slotSettings->slotId . 'Lines');
                        $coin = 10; //$betline / $coinValue;
                        $allbet = $betline * $lines;
                        $totalBonusWin = 0;
                        $userBalance = sprintf('%01.2f', $slotSettings->GetBalance());
                        // $response = "2 " . $requestData[1] . "\r\n3 0 ".($totalWin/$coinValue)." ".($totalWin*100)." ".()." 1\r\n";
                        if($currentRespinGame == 0){
                            if($currentFreeGame == 0){
                                $response = "2 " . $requestData[1] . "\r\n3 0 ".($totalWin/$coinValue)." ".($totalWin*100)." ".($totalFreeGames + $currentRespinGame - $currentFreeGame)." 1\r\n";    
                            }else{
                                $response = "2 " . $requestData[1] . "\r\n3 0 ".($totalWin/$coinValue)." ".($totalWin*100)." ".($totalFreeGames + $currentRespinGame - $currentFreeGame)." 1\r\n";
                            }
                        }else{
                            $response = "2 " . $requestData[1] . "\r\n3 0 ".($totalWin/$coinValue)." ".($totalWin*100)." ".($totalFreeGames + $currentRespinGame - $currentFreeGame)." 1\r\n";
                        }
                        $_avaliableBank = $slotSettings->GetBank('freespin');
                        if($currentRespinGame > 0){
                            if($mul == 0){
                                $mul = 1;
                            }
                            if($isRespinStart == 1){
                                for($i = 0; $i < count($lastReel); $i++){
                                    if($lastReel[$i] != 11){
                                        $lastReel[$i] = -1;
                                    }
                                }
                                $isRespinStart = 0;
                                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                                $slotSettings->SetGameData($slotSettings->slotId . 'IsRespinStart', $isRespinStart);
                            }
                            if(rand(0, 100) > 30){
                                $winType = 1;
                            }else{
                                $winType = 0;
                            }
                            while(true){
                                $respinWin = 0;
                                $lineWins = [];
                                $tempReel = $lastReel;
                                $isChanged = false;
                                $changedSymbolCount = 0;
                                if($winType == 1){
                                    $piggysymbolCount = 0;
                                    for($i = 0; $i < 20; $i++){
                                        if($tempReel[$i] != 11){
                                            if(rand(0, 100) < 14){
                                                $tempReel[$i] = 11;
                                                $isChanged = true;
                                                $changedSymbolCount++;
                                            }
                                        }else{
                                            $piggysymbolCount++;
                                        }
                                    }
                                    if($piggysymbolCount > 15){
                                        $winType = 0;
                                    }
                                }
                                $winReel = $tempReel;
                                
                                for($i = 4; $i >= 1; $i--){
                                    $respinLine = $slotSettings->RespinLines[$i];
                                    for($r = 0; $r < count($respinLine); $r++){
                                        $isWin = true;
                                        for($k = 0; $k < count($respinLine[$r]); $k++){
                                            if($winReel[$respinLine[$r][$k]] == -1){
                                                $isWin = false;
                                                break;
                                            }
                                        }
                                        if($isWin == true){
                                            $winMul = rand($slotSettings->RespinPaytable[$i - 1][0], $slotSettings->RespinPaytable[$i - 1][1]) * $mul;
                                            $respinWin = $respinWin + ($winMul * $allbet / 10);
                                            $lineWin = [];
                                            $lineWin['mul'] = $winMul;
                                            $lineWin['symblols'] = $respinLine[$r];
                                            for($k = 0; $k < count($respinLine[$r]); $k++){
                                                $winReel[$respinLine[$r][$k]] = -1;
                                            }
                                            array_push($lineWins, $lineWin);
                                        }
                                    }
                                }
                                if( ($totalWin + $respinWin) < $_avaliableBank / 2) 
                                {
                                    if($isChanged == true){
                                        $type = 1;
                                    }else{
                                        $currentRespinGame--;
                                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', $currentRespinGame);
                                        $type = 0;
                                        if($currentRespinGame == 0){
                                            $type = 1;
                                        }
                                    }
                                    $response=$response . "1 ". $coin ." 1 ". ($coinValue * 100) ." ". implode(" ", $tempReel) ." ".$type." 0 -1 -1 -1 -1 -1 -1 -1 -1 -1 -1\r\n";
                                    $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $tempReel);
                                    $lastReel = $tempReel;
                                    if($currentRespinGame == 0){
                                        $wincount = count($lineWins);
                                        $strwinline = "2 2 8 " . $wincount;
                                        for($k = 0; $k < $wincount; $k++){
                                            $strwinline = $strwinline . " 11 " . $mul . " " . $lineWins[$k]['mul'] . " " . count($lineWins[$k]['symblols']) . " " . implode(' ', $lineWins[$k]['symblols']);
                                        }
                                        $response=$response . "2 0 0 0 1 0\r\n" . $strwinline . "\r\n2 5 1";
                                        $totalWin = $totalWin + $respinWin;
                                        if( $respinWin > 0 ) 
                                        {
                                            if($currentStatus == 1){
                                                $slotSettings->SetBank('freespin', -1 * $respinWin);
                                            }else if($currentStatus == 2){
                                                $slotSettings->SetBank('respin', -1 * $respinWin);
                                            }
                                            
                                            $slotSettings->SetBalance($respinWin);
                                        }
                                        break;
                                    }else{
                                        if($isChanged == true){
                                            $response=$response . "2 0 0 13 ".$changedSymbolCount." 0\r\n2 2 1 1\r\n2 5 1";
                                            break;
                                        }else{
                                            $response=$response . "3 0 ".($totalWin/$coinValue)." ".($totalWin*100)." ".($totalFreeGames + $currentRespinGame - $currentFreeGame)." 1\r\n";
                                        }
                                    }
                                    
                                    if(rand(0, 100) > 50){
                                        $winType = 1;
                                    }else{
                                        $winType = 0;
                                    }
                                }
                            }
                        }else if($totalFreeGames - $currentFreeGame > 0){
                            while(true){
                                $freeSpinWin = 0;
                                $lineWins = [];
                                $lineWinNum = [];
                                $arrWinLines = []; // 2 5 3 0 90
                                $wild = '9';
                                $scatter = '10';
                                $scatterrespin = '12';
                                $reels = $slotSettings->GetReelStrips('', 'freespin');
                                $scattersCount = 0;
                                $respinCount = 0;
                                for( $r = 1; $r <= 5; $r++ ) 
                                {
                                    if( $reels['reel' . $r][0] == $scatter || $reels['reel' . $r][1] == $scatter || $reels['reel' . $r][2] == $scatter || $reels['reel' . $r][3] == $scatter ) 
                                    {
                                        $scattersCount++;
                                    }
                                    if( $reels['reel' . $r][0] == $scatterrespin || $reels['reel' . $r][1] == $scatterrespin || $reels['reel' . $r][2] == $scatterrespin || $reels['reel' . $r][3] == $scatterrespin ) 
                                    {
                                        $respinCount++;
                                    }
                                }
                                if($scattersCount >= 3){
                                    continue;
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
                                                $freeSpinWin += $lineWins[$k];
                                                array_push($arrWinLines, [$k, $firstEle, $lineWinNum[$k], count($arrWinLines), $lineWins[$k]  / $coinValue]);
                                            }
                                        }else{
                                            if($slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] > 0){
                                                $lineWins[$k] = $slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] * $betline;
                                                $_isLineWin = 1;
                                                $freeSpinWin += $lineWins[$k];
                                                array_push($arrWinLines, [$k, $firstEle, $lineWinNum[$k], count($arrWinLines), $lineWins[$k]  / $coinValue]);
                                            }else{
                                                $lineWinNum[$k] = 0;
                                            }
                                            break;
                                        }
                                    }
                                }
    
                                if( ($totalWin + $freeSpinWin) < $_avaliableBank / 2) 
                                {
                                    $lastReel = [];
                                    $totalWin = $totalWin + $freeSpinWin;
                                    $totalBonusWin = $totalBonusWin + $freeSpinWin;
                                    for($k = 1; $k <= 5; $k++){
                                        for($r = 0; $r < 4; $r++){
                                            array_push($lastReel, $reels['reel'.$k][$r]);
                                        }
                                    }
                                    $strWinLines = "";
                                    if($freeSpinWin > 0){
                                        for($k = 0; $k < count($arrWinLines); $k++){
                                            $strWinLines = $strWinLines . implode(" ", $arrWinLines[$k]) . " ";
                                        }
                                    }
                                    $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                                    
                                    $response=$response . "1 ". $coin ." 1 ". ($coinValue * 100) ." ". implode(" ", $lastReel) ." 1 ". count($arrWinLines) ." ". $strWinLines ."6 3 0 5 5 4 8 7 0 5\r\n";
                                    $currentFreeGame++;
                                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $currentFreeGame);
                                    if($respinCount > 0){
                                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 3);
                                        $slotSettings->SetGameData($slotSettings->slotId . 'IsRespinStart', 1);
                                        $slotSettings->SetGameData($slotSettings->slotId . 'Mul', $respinCount);
                                        $response = $response . "2 0 0 12 ".$respinCount." 0\r\n2 2 1 3\r\n2 5 1";
                                        if( $totalBonusWin > 0 ) 
                                        {
                                            $slotSettings->SetBank('freespin', -1 * $totalBonusWin);
                                            $slotSettings->SetBalance($totalBonusWin);
                                        }
                                        break;
                                    }else{
                                        $response = $response . "3 0 ".($totalWin / $coinValue)." ".($totalWin * 100)." ".($totalFreeGames - $currentFreeGame)." 1";
                                        if($totalFreeGames == $currentFreeGame){
                                            if( $totalBonusWin > 0 ) 
                                            {
                                                $slotSettings->SetBank('freespin', -1 * $totalBonusWin);
                                                $slotSettings->SetBalance($totalBonusWin);
                                            }
                                            break;
                                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                                            $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                                            $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                                        }else{
                                            $response = $response . "\r\n";
                                        }
                                    }
                                }else{
                                    //emptyspin
                                }   
                            }
                        }
                        if($currentStatus == 1){
                            $slotEvent = 'freespin';
                        }else if($currentStatus == 2){
                            $slotEvent = 'respin';
                        }
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                        $_strResultReal = '' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'LastReel')) . '';
                        $responseData = '{"responseEvent":"spin","responseType":"' . $slotEvent . '","serverResponse":{"Lines":' . $slotSettings->GetGameData($slotSettings->slotId . 'Lines') . ',"CurrentBet":' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet'). ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"CurrentFreeGame":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"CurrentRespinGame":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') . ',"CurrentStatus":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentStatus') . ',"Mul":' . $slotSettings->GetGameData($slotSettings->slotId . 'Mul') . ',"IsRespinStart":' . $slotSettings->GetGameData($slotSettings->slotId . 'IsRespinStart')  . ',"Balance":' . $userBalance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin. ',"totalCoin":' . ($totalWin / $coinValue). ',"CoinValue":' . $coinValue.  ',"winLines":[],"Jackpots":"","response":"' . $lastResponse . ";" . str_replace("\r\n",";",$response) .  '","LastReel":' . $_strResultReal . '}}';
                        
                        $slotSettings->SaveLogReport($responseData, $allbet, $lines, $totalWin, $slotEvent);
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
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeIndex', $requestData[1]);
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
