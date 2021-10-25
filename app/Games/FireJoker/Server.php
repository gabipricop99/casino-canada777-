<?php 
namespace VanguardLTE\Games\FireJoker
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
                [1, 1, 1],
                [0, 0, 0],
                [2, 2, 2],
                [0, 1, 2],
                [2, 1, 0]
            ];
            for($kk = 2; $kk < count($paramData); $kk++){
                $response = "";
                if(isset($paramData[$kk])){
                    $requestData = explode(" ", $paramData[$kk]);
                    if(isset($requestData[0]) && $requestData[0] == 101){
                        $response = "103 \"T0xPw8t0Rf!39939\"\r\n101 39939 \"CAD\" \"\" \"\" \"" . $user->username . "\" \"\"\r\n127 \"". date("Y-m-d H:i:s") . "\""; // KRW
                    }else if(isset($requestData[0]) && $requestData[0] == 102){
                        $response = "102 1";
                    }if(isset($requestData[0]) && $requestData[0] == 103){
                        $response = '103 "T0xPw8t0Rf"';
                    }else if(isset($requestData[0]) && $requestData[0] == 104){
                        $response = "104 1\r\n54 13 ". implode(' ', $slotSettings->Bet) ." 1\r\n57 \"<custom><RTP Value=\"96\" /></custom>'\r\n60 96 0\r\n52 ". ($user->balance * 100) ." 0 0\r\n83 0\r\n91 40517\r\n109";
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
                            $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
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
                        $isRespin = false;
                        $respinReels = [-1, -1, -1];
                        $strRespinResponse = "";
                        for( $i = 0; $i <= 2000; $i++ ) 
                        {
                            $reelgenrationCount = $i;
                            $totalWin = 0;
                            $lineWins = [];
                            $isBonus = false;
                            $lineWinNum = [];
                            $arrWinLines = []; // 2 5 3 0 90
                            $bonustotalMul = 0;
                            $bonusMul = 0;
                            $bonusMulPos = -1;
                            $wild = '8';
                            $scatter = '9';
                            $scattersCount = 0;
                            $reels = $slotSettings->GetReelStrips($winType, $slotEvent);
                            if($isRespin == true){
                                for($k = 0; $k < 3; $k++){
                                    if($respinReels[$k] > -1){
                                        for($j = 0; $j < 3; $j++){
                                            $reels['reel'.($k+1)][$j] = $respinReels[$k];
                                        }
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
                                for($j = 1; $j < 3; $j++){
                                    $ele = $reels['reel'. ($j + 1)][$linesId[$k][$j]];
                                    if($firstEle == $wild){
                                        $firstEle = $ele;
                                        $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                    }else if($ele == $firstEle || $ele == $wild){
                                        $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                    }else{
                                        $lineWinNum[$k] = 0;
                                        break;
                                    }
                                    if($j == 2){
                                        $lineWins[$k] = $slotSettings->Paytable[$firstEle] * $betline;
                                        $_isLineWin = 1;
                                        $totalWin += $lineWins[$k];
                                        array_push($arrWinLines, [$k, $firstEle, $lineWinNum[$k], count($arrWinLines), $lineWins[$k]  / $coinValue]);
                                    }
                                }
                            }
                            if($isRespin == false && $totalWin <= 0){
                                $respinReels = [];
                                $count = 0;
                                $firstEle = -1;
                                for($k = 1; $k<=3; $k++){
                                    if($reels['reel'. ($k)][0] == $reels['reel'. ($k)][1] && $reels['reel'. ($k)][1] == $reels['reel'. ($k)][2]){
                                        array_push($respinReels, $reels['reel'. ($k)][0]);
                                        $count++;
                                    }else{
                                        array_push($respinReels, -1);
                                    }
                                }
                                $subRespinResponse = "";
                                if($respinReels[0] == -1 && ($respinReels[1] != -1 && $respinReels[2] != -1)){
                                    if($respinReels[1] == $wild || $respinReels[2] == $wild || $respinReels[1] == $respinReels[2]){
                                        $isRespin = true;
                                        $subRespinResponse = "2 0 4 ".$respinReels[1]." 0 0\r\n2 2 1 1\r\n2 5 0\r\n3 0 0 0 1 1\r\n";
                                    }
                                }else if($respinReels[0] != -1){
                                    if($respinReels[1] == $wild || $respinReels[1] == $respinReels[0]){
                                        $isRespin = true;
                                        $subRespinResponse = "2 0 4 ".$respinReels[0]." 2 0\r\n2 2 1 1\r\n2 5 0\r\n3 0 0 0 1 1\r\n";
                                    }else if($respinReels[2] == $wild || $respinReels[2] == $respinReels[0]){
                                        $isRespin = true;
                                        $subRespinResponse = "2 0 4 ".$respinReels[0]." 1 0\r\n2 2 1 1\r\n2 5 0\r\n3 0 0 0 1 1\r\n";   
                                    }
                                }
                                if($isRespin == true){
                                    $subReels = [];
                                    for($k = 1; $k <= 3; $k++){
                                        for($r = 0; $r < 3; $r++){
                                            array_push($subReels, $reels['reel'.$k][$r]);
                                        }
                                    }
                                    $strRespinResponse="1 ". $coin ." ". $lines ." ". ($coinValue * 100) ." ". implode(" ", $subReels) ." 1 0 6 3 0 5 5 4\r\n" . $subRespinResponse;
                                    continue;
                                }
                            }

                            $firstEle = -1;
                            $sameSymbolCount = 0;
                            for($k = 0; $k < 3; $k++){
                                for($j =0; $j < 3; $j++){
                                    if($firstEle == -1 && $reels['reel'.($k+1)][$j] != $wild){
                                        $firstEle = $reels['reel'.($k+1)][$j];
                                    }
                                    if($firstEle > -1){
                                        if($firstEle == $reels['reel'.($k+1)][$j] || $reels['reel'.($k+1)][$j] == $wild){
                                            $sameSymbolCount++;
                                        }
                                    }else{
                                        $sameSymbolCount++;
                                    }
                                }
                            }
                            if($sameSymbolCount == 9){
                                if($firstEle == -1){
                                    $firstEle = 8;
                                }
                                $isBonus = true;                                
                                $bonusMul = $slotSettings->GetBonusMul();
                                $bonusMulPos = $slotSettings->GetBonusPos($bonusMul);
                                $totalWin = $totalWin * $bonusMul;
                                $bonustotalMul = $slotSettings->Paytable[$firstEle] * $lines * ($bonusMul - 1);
                            }


                            // if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($allbet * rand(2, 5)) ) 
                            // {
                            // }
                            // else if( !$slotSettings->increaseRTP && $winType == 'win' && $allbet < $totalWin ) 
                            // {
                            // }
                            // else
                            // {
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
                            // }
                        }
    
                        if( $totalWin > 0 ) 
                        {
                            $slotSettings->SetBank((isset($slotEvent) ? $slotEvent : ''), -1 * $totalWin);
                            $slotSettings->SetBalance($totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'TotalCoin', ($totalWin / $coinValue));
                        }
                        $_totalWin = $totalWin;
                        $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $betline);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lines);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CoinValue', $coinValue);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                        
                        $_strResultReal = '' . json_encode($reels) . '';
                        $_strJackpot = '' . json_encode($slotSettings->Jackpots) . '';
                        $responseData = '{"responseEvent":"spin","responseType":"' . $slotEvent . '","serverResponse":{"Lines":' . $slotSettings->GetGameData($slotSettings->slotId . 'Lines') . ',"CurrentBet":' . $slotSettings->GetGameData($slotSettings->slotId . 'Bet'). ',"Balance":' . $userBalance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin. ',"totalCoin":' . ($totalWin / $coinValue) . ',"CoinValue":' . $coinValue.  ',"BonusMul":' . $bonusMul.  ',"winLines":[],"Jackpots":' . $_strJackpot . ',"reelsSymbols":' . $_strResultReal . '}}';
                        
                        $slotSettings->SaveLogReport($responseData, $allbet, $lines, $_totalWin, $slotEvent);
                        
                        $strWinLines = "";
                        $str3result = "";
                        if($totalWin > 0){
                            for($k = 0; $k < count($arrWinLines); $k++){
                                $strWinLines = $strWinLines . implode(" ", $arrWinLines[$k]) . " ";
                            }
                            $str3result = "3 0 " . ($totalWin / $coinValue) . " " . ($totalWin * 100) . " 0 1";
                        }else{
                            $str3result = "3 0 0 0 0 1" . "\r\n6 0\r\n52 " . ($slotSettings->GetBalance() * 100) . " 0 0";
                        }
                        $lastReel = [];
                        for($k = 1; $k <= 3; $k++){
                            for($r = 0; $r < 3; $r++){
                                array_push($lastReel, $reels['reel'.$k][$r]);
                            }
                        }
                        $spintype = 0;
                        if($isBonus == true){          
                            $response="2 0 0 11 3 0\r\n2 2 0 ". $bonustotalMul ."\r\n2 2 6 ".$bonusMul."\r\n2 2 6 ".$bonusMulPos."\r\n2 5 0\r\n". $str3result;
                            $spintype = 1;
                        }else{
                            $response = $str3result;
                        }
                        $response= $strRespinResponse . "1 ". $coin ." ". $lines ." ". ($coinValue * 100) ." ". implode(" ", $lastReel) ." ". $spintype ." ". count($arrWinLines) ." ". $strWinLines ."6 3 0 5 5 4\r\n" . $response;
                        
                    }else if(isset($requestData[0]) && $requestData[0] == 2){
                        
                    }else if(isset($requestData[0]) && $requestData[0] == 4){
                        $lastEvent = $slotSettings->GetHistory();
                        $response = "5 " . $lastEvent->serverResponse->totalCoin . "\r\n6 ".($lastEvent->serverResponse->totalWin * 100)."\r\n52 ".($slotSettings->GetBalance() * 100)." 0 0";
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
