<?php 
namespace VanguardLTE\Games\DawnOfEgypt
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
                        $response = "103 \"0T1cpVLFL5p!39939\"\r\n101 39939 \"CAD\" \"\" \"\" \"" . $user->username . "\" \"\"\r\n127 \"". date("Y-m-d H:i:s") . "\""; // KRW
                    }else if(isset($requestData[0]) && $requestData[0] == 102){
                        $response = "102 1";
                    }if(isset($requestData[0]) && $requestData[0] == 103){
                        $response = '103 "0T1cpVLFL5p"';
                    }else if(isset($requestData[0]) && $requestData[0] == 104){
                        $response = "104 1\r\n54 22 ". implode(' ', $slotSettings->Bet) ." 1\r\n57 \"<custom><RTP Value=\"96\" /></custom>'\r\n60 96 0\r\n52 ". ($user->balance * 100) ." 0 0\r\n83 0\r\n91 40517\r\n109";
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
                            $wild = '10';
                            $scatter = '11';
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
                            $scattersWin = $slotSettings->Paytable['SYM_' . ($scatter + 1)][$scattersCount] * $betline * $bonusMpl;
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
                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 0);
                        $spintype = 0; // 0:normalspin, 1 : freespin
                        if( $scattersCount >= 3 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusSymbol', -1);
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetFreeSpinCount());
                            $spintype = 1;
                        }
                        $_strResultReal = '' . json_encode($reels) . '';
                        $_strJackpot = '' . json_encode($slotSettings->Jackpots) . '';
                        $responseData = '{"responseEvent":"spin","responseType":"' . $slotEvent . '","serverResponse":{"Lines":' . $slotSettings->GetGameData($slotSettings->slotId . 'Lines') . ',"CurrentBet":' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet'). ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames'). ',"totalRespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $userBalance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin. ',"totalCoin":' . ($totalWin / $coinValue) .  ',"bonusSymbol":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusSymbol'). ',"CoinValue":' . $coinValue.  ',"winLines":[],"Jackpots":' . $_strJackpot . ',"reelsSymbols":' . $_strResultReal . '}}';
                        
                        $slotSettings->SaveLogReport($responseData, $allbet, $lines, $_totalWin, $slotEvent);
                        
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
                        $lastReel = [];
                        for($k = 1; $k <= 5; $k++){
                            for($r = 0; $r < 3; $r++){
                                array_push($lastReel, $reels['reel'.$k][$r]);
                            }
                        }
                        $response="1 ". $coin ." ". $lines ." ". ($coinValue * 100) ." ". implode(" ", $lastReel) ." ". $spintype ." ". count($arrWinLines) ." ". $strWinLines ."6 3 0 5 5 4 8 7 0 5 0\r\n";
                        if($scattersCount >= 3){          
                            $response=$response . "2 0 0 11 ".$scattersCount." 0\r\n2 2 0 ".($scattersWin / $coinValue)."\r\n2 2 1 ".$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames')."\r\n2 5 1";
                        }else{
                            $response = $response . $str3result;
                        }
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
                            $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', $lastEvent->serverResponse->totalRespinGames);
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusSymbol', $lastEvent->serverResponse->bonusSymbol);
                            $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->Lines);
                            $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $lastEvent->serverResponse->CurrentBet);
                        }
                        $userBalance = sprintf('%01.2f', $slotSettings->GetBalance());
                        $totalWin = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                        $coinValue = $slotSettings->GetGameData($slotSettings->slotId . 'CoinValue');
                        $freeGames = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $respinGames = $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames');
                        $currentFreeGame = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        $bonusSymbol = $slotSettings->GetGameData($slotSettings->slotId . 'BonusSymbol');
                        $betline = $slotSettings->GetGameData($slotSettings->slotId . 'Bet');
                        $lines = $slotSettings->GetGameData($slotSettings->slotId . 'Lines');
                        $allbet = $betline * $lines;
                        $coin = $betline / $coinValue;
                        $totalBonusWin = 0;
                        if($freeGames <= $currentFreeGame && $respinGames == 0){
                            $response = "invalid freespin state";
                            exit( $response );
                        }
                        $response = "2 " . $requestData[1] . "\r\n3 0 ".($totalWin/$coinValue)." ".($totalWin*100)." ".($freeGames + $respinGames - $currentFreeGame)." 1\r\n";
                        $_avaliableBank = $slotSettings->GetBank('freespin');
                        $isRespin = false;
                        if($respinGames > 0){
                            $isRespin = true;
                        }
                        if(rand(0, 100) > 70){
                            $winType = 1;
                        }else{
                            $winType = 0;
                        }
                        $count = 0;
                        while(true){
                            $freeSpinWin = 0;
                            $lineWins = [];
                            $lineWinNum = [];
                            $arrWinLines = []; // 2 5 3 0 90
                            $wild = '10';
                            $scatter = '12';
                            if($isRespin == false){
                                $bonusSymbol = $slotSettings->GenerateBonusSymbol();
                            }
                            $reels = $slotSettings->GetReelStrips('', 'freespin');

                            $scattersCount = 0;
                            $scatterPoses = [];
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                for($k = 0; $k < 3; $k++){
                                    if($reels['reel'.$r][$k] >= 4 && $reels['reel'.$r][$k] <= $bonusSymbol){
                                        $reels['reel'.$r][$k] = $bonusSymbol;
                                    }
                                    if($reels['reel'.$r][$k] >= $scatter){
                                        $scattersCount++;
                                        array_push($scatterPoses, ($r - 1) * 3 + $k);
                                    }
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
                            $scattersWin = $slotSettings->Paytable['SYM_' . ($scatter + 1)][$scattersCount] * $betline;
                            if($count > 100){
                                $winType == 0;
                            }
                            if($freeSpinWin + $scattersWin > 0 && $winType == 0){
                            }else if($freeSpinWin + $scattersWin == 0 && $winType == 1 && $scattersCount < 2){                                
                            }else if($isRespin == true && $scattersCount > 2){                                
                            }else if($scattersCount > 2 && $winType == 0){                                
                            }else if( ($totalWin + $freeSpinWin + $scattersWin) < $_avaliableBank / 2) 
                            {
                                $lastReel = [];
                                $totalWin = $totalWin + $freeSpinWin;
                                $totalBonusWin = $totalBonusWin + $freeSpinWin;
                                for($k = 1; $k <= 5; $k++){
                                    for($r = 0; $r < 3; $r++){
                                        array_push($lastReel, $reels['reel'.$k][$r]);
                                    }
                                }
                                $strWinLines = "";
                                if($freeSpinWin > 0){
                                    for($k = 0; $k < count($arrWinLines); $k++){
                                        $strWinLines = $strWinLines . implode(" ", $arrWinLines[$k]) . " ";
                                    }
                                }
                                $response=$response . "1 ". $coin ." ". $lines ." ". ($coinValue * 100) ." ". implode(" ", $lastReel) ." 1 ". count($arrWinLines) ." ". $strWinLines ."6 3 0 5 5 4 8 7 0 5 ".$bonusSymbol."\r\n";
                                if($isRespin == true){
                                    $respinGames = $respinGames - 1;
                                    if($respinGames > 0){
                                        $response = $response . "3 0 ".($totalWin / $coinValue)." ".($totalWin * 100)." ".($freeGames + $respinGames - $currentFreeGame)." 1\r\n"; 
                                    }else{
                                        $response = $response . "3 0 ".($totalWin / $coinValue)." ".($totalWin * 100)." ".($freeGames + $respinGames - $currentFreeGame)." 1\r\n"; 
                                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 0);
                                        if($freeGames == $currentFreeGame){
                                            break;
                                        }else{
                                            $isRespin = false;
                                        }
                                    }

                                }else{
                                    $currentFreeGame = $currentFreeGame + 1;
                                    if($scattersCount >= 2){
                                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusSymbol', $bonusSymbol);
                                        $strRespin = " " .$scattersCount;
                                        $totalRespinCount = 0;
                                        for($k =0; $k < $scattersCount; $k++){
                                            $respinCount = $slotSettings->GetReSpinCount();
                                            $strRespin = $strRespin . " " . $scatterPoses[$k] . " " . $respinCount;
                                            $totalRespinCount = $totalRespinCount + $respinCount;
                                        }
                                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', $totalRespinCount);
                                        $response = $response . "2 0 0 12 ".$scattersCount." 0\r\n2 2 13".$strRespin."\r\n2 2 1 ".$totalRespinCount."\r\n2 5 1";
                                        break;
                                    }else{
                                        $response = $response . "3 0 ".($totalWin / $coinValue)." ".($totalWin * 100)." ".($freeGames + $respinGames - $currentFreeGame)." 1\r\n";
                                        if($freeGames == $currentFreeGame){
                                            break;
                                        }
                                    }
                                }

                                if(rand(0, 100) > 70){
                                    $winType = 1;
                                }else{
                                    $winType = 0;
                                }
                                $count = 0;
                            }
                            $count++;
                        }
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $currentFreeGame);
                        if( $totalBonusWin > 0 ) 
                        {
                            $slotSettings->SetBank('freespin', -1 * $totalBonusWin);
                            $slotSettings->SetBalance($totalBonusWin);
                        }
                        $responseData = '{"responseEvent":"spin","responseType":"' . "freespin" . '","serverResponse":{"Lines":' . $slotSettings->GetGameData($slotSettings->slotId . 'Lines') . ',"CurrentBet":' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet'). ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames'). ',"totalRespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $userBalance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin. ',"totalCoin":' . ($totalWin / $coinValue) .  ',"bonusSymbol":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusSymbol'). ',"CoinValue":' . $coinValue.  ',"winLines":[],"Jackpots":"","reelsSymbols":"","response":"'. str_replace("\r\n", ";" , $response) .'"}}';
                        
                        $slotSettings->SaveLogReport($responseData, $allbet, $lines, $totalWin, "freespin");
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
