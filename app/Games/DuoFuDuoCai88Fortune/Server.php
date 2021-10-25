<?php 
namespace VanguardLTE\Games\DuoFuDuoCai88Fortune
{
    include('CheckReels.php');
    class Server
    {
        public $winLines = [];
        public function get($request, $game) // changed by game developer
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
            $userId = \Auth::id();// changed by game developer
            
            $serverAddress = 'localhost';
            $serverPort = '8555';
            $user = \VanguardLTE\User::lockForUpdate()->find($userId);
            $credits = $userId == 1 ? $request->action === 'doInit' ? 5000 : $user->balance : null;
            $slotSettings = new SlotSettings($game, $userId, $credits);
            $find = array("#i", "#b", "#s", "#f", "#l");
            // $paramData = trim(file_get_contents('php://input'));
            $paramData = json_decode(str_replace($find, "", trim(file_get_contents('php://input'))), true);
            $gameData = $this->parseMessage($paramData['gameData']);
            $CoinValue = 1;
            $response = '~m~64~m~~j~{"err":0,"res":3,"vals":[0,100000,1,10,2,3],"msg":null}';
            if(isset($gameData[0])){
                if($gameData[0] == 200037){
                    // AccountLoginSecretErrorRespond, AccountLoginRespond
                    $response = $this->encryptMessage('{"err":0,"res":3,"vals":[0,200038,1,1,2,2,3,{"0":0,"1":"'. $user->username .'","99":""}],"msg":null}');
                    $response = $response . '------' . $this->encryptMessage('{"err":0,"res":3,"vals":[0,1,1,1,2,2,3,{"0":18120,"1":0,"2":"'.$serverAddress.'","3":'.$serverPort.',"4":true}],"msg":null}');
                }else if($gameData[0] == 2){
                    // LobbyLoginRespond
                    $response = '{"err":0,"res":3,"vals":[0,3,1,8,2,3,3,{"0":13443,"1":0,"2":"","3":0,"4":' . ($slotSettings->GetBalance() * 100) . ',"5":-1,"6":0,"9":0,"7":0,"8":0,"11":{},"10":0,"12":' . floor(microtime(true) * 1000) .',"13":false,"14":46,"15":3,"16":' . floor(microtime(true) * 1000) .',"17":0,"18":0,"19":"KRW","20":2}],"msg":null}';
                    $response = $this->encryptMessage($response);
                }else if($gameData[0] == 100000){
                    $subGameData = $gameData[3];
                    $lines = 88;
                    if(isset($subGameData[0])){
                        if($subGameData[0] == 100004){
                            // GameroomJoinRequest
                            $lastEvent = $slotSettings->GetHistory();
                            if( $lastEvent != 'NULL' ) 
                            {
                                $bet = $lastEvent->serverResponse->bet;
                            }
                            else
                            {
                                $bet = $slotSettings->Bet[0];
                            }
                            $response = '{"err":0,"res":3,"vals":[0,100000,1,8,2,3,3,{"0":100005,"1":{"0":46,"2":0,"1":3,"3":' . ($slotSettings->GetBalance() * 100) . ',"4":["DuoFuDuoCai88Fortune","'. implode(',', $slotSettings->Bet) .'",'.$lines.',250,100,95,'. $CoinValue .',50,5000,'.($lines * $bet * $CoinValue).
                                ',1,0,0],"5":[48,"KRW","DuoFuDuoCai88Fortune","\u20A9","\u97D3\u570B,\u97D3\u5143",1000,2000,1000,1,"1000,2000",1,2,1],"6":0}}],"msg":null}';
                        }else if($subGameData[0] == 100068){
                            $response = '{"err":0,"res":3,"vals":[0,100000,1,10,2,3,3,{"0":100069,"1":{"0":0,"1":' . $slotSettings->GetBalance() * 100 . ',"2":0}}],"msg":null}';
                        }else if($subGameData[0] == 100008){
                            $betData = $subGameData[1];
                            $betline = 1;
                            if(isset($betData) && isset($betData[1]) && isset($betData[1][3]) && isset($betData[1][3][0])){
                                $betline = floor($betData[1][3][0] / 100);
                            }

                            $slotEvent = [];
                            $_spinSettings = $slotSettings->GetSpinSettings('doSpin', $betline * $lines, $lines);
                            $winType = $_spinSettings[0];
                            $_winAvaliableMoney = $_spinSettings[1];
                            $slotEvent['slotEvent'] = 'bet';
                            $slotSettings->SetBalance(-1 * ($betline * $lines), $slotEvent['slotEvent']);
                            $slotSettings->UpdateJackpots($betline * $lines);
                            $_sum = ($betline * $lines) / 100 * $slotSettings->GetPercent();
                            $slotSettings->SetBank($slotEvent['slotEvent'], $_sum, $slotEvent['slotEvent']);
                            $Balance = $slotSettings->GetBalance();
                            for( $i = 0; $i <= 2000; $i++ ) 
                            {
                                $normalWin = 0;
                                $lineWins = [];
                                $lineWinNum = [];
                                $wild = '0';
                                $scatter = '12';
                                $_obf_winCount = 0;
                                $strWinLine = '';
                                $this->winLines = [];
                                $reels = $slotSettings->GetReelStrips($winType, $slotEvent['slotEvent']);
                                for($r = 0; $r < 3; $r++){
                                    // if($reels['reel1'][$r] != $scatter){
                                        $this->findZokbos($reels, 1, $reels['reel1'][$r], 1);
                                    // }                        
                                }
                                $scattersCount = 0;
                                for($r = 0; $r < count($this->winLines); $r++){
                                    $winLine = $this->winLines[$r];
                                    $winLineMoney = $slotSettings->Paytable[$winLine['FirstSymbol']][$winLine['RepeatCount']] * $betline;
                                    if($winLine['FirstSymbol'] == $scatter){
                                        if($winLine['RepeatCount'] > $scattersCount){
                                            $scattersCount = $winLine['RepeatCount'];
                                        }
                                    }
                                    $normalWin += $winLineMoney;
                                }   
                                $scatterMuls = [0, 0, 0, 5, 10, 50];
                                $scattersWin = $scatterMuls[$scattersCount] * $lines * $betline;
                                $normalWin = $normalWin + $scattersWin; 
                                if( $i > 1000 ) 
                                {
                                    $winType = 'none';
                                }
                                if( $i >= 2000 ) 
                                {
                                    $response = '{"err":1,"res":3,"vals":[],"msg":"Bad Reel Strip"}';
                                    exit( $response );
                                }
                                if( $scattersCount >= 3 && $winType != 'bonus' ) 
                                {
                                }
                                else if( $normalWin <= $_winAvaliableMoney && $winType == 'bonus' ) 
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
                                else if( $normalWin > 0 && $normalWin <= $_winAvaliableMoney && $winType == 'win' ) 
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
                                else if( $normalWin == 0 && $winType == 'none' ) 
                                {
                                    break;
                                }
                            }
                            $lastReel = [];
                            for($k = 1; $k <=5 ; $k++){
                                for($j = 0; $j < 3; $j++){
                                    array_push($lastReel, $reels['reel'.$k][$j]);
                                }
                            }
                            $freeSpinwin = 0;
                            $freeStack = '[]';
                            $jackpotMoney = 0;
                            if( $normalWin > 0) 
                            {
                                $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), -1 * $normalWin);
                            }
                            if($scattersCount >= 3){
                                $avaliableMoney = $slotSettings->GetBank('freespin');
                                $avaliableOdd = floor(($avaliableMoney / $betline) / rand(2, 5));
                                if($avaliableOdd < 0){
                                    $avaliableOdd = 0;
                                }
                                $freeStacks = $slotSettings->getFreeSpinStack($avaliableOdd);
                                $freeSpinwin = $freeStacks[0] * $betline;
                                $freeStack = $freeStacks[1];
                                $slotSettings->SetBank('freespin', -1 * $freeSpinwin);
                            }else{
                                if(isset($slotSettings->Jackpots['jackPay']) && $slotSettings->Jackpots['jackPay'] > 0){
                                    // Jackpot Win
                                    $jackpotID = $slotSettings->Jackpots['jackType'];
                                    $freeStack = '[[2,'. $jackpotID . ', '. implode(',', $this->generatJackpot($jackpotID)) .']]';
                                    $jackpotMoney = $slotSettings->Jackpots['jackPay'];
                                }
                            }
                            $totalWin = $normalWin + $freeSpinwin;
                            if($totalWin > 0){                                
                                $slotSettings->SetBalance($totalWin);
                            }
                            $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":1,"lines":' . $lines . ',"bet":' . $betline . 
                                ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . 0 . ',"winLines":[],"Jackpots":""' . 
                                ',"LastReel":'.json_encode($lastReel).'}}';
                            $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $totalWin, $slotEvent['slotEvent']);
                            
                            $response = '{"err":0,"res":3,"vals":[0,100000,1,8,2,3,3,{"0":100009,"1":{"0":0,"1":['.($totalWin * 100).',['. implode(',', $lastReel) .'],'.$freeStack.','.($normalWin * 100).','. ($freeSpinwin * 100) .',' . ($slotSettings->GetBalance() * 100) . ',0,0,'. ($jackpotMoney * 100) .',-1,0,0,[0,0,0],0]}}],"msg":null}';
                            
                            $slotSettings->SaveGameData();
                        }
                    }
                    $response = $this->encryptMessage($response);
                }else if($gameData[0] == 200017){
                    // GameRoomListInfo
                    $response = '{"err":0,"res":3,"vals":[0,200018,1,8,2,3,3,{"0":[[46,'.$gameData[3][1].',true,' . floor(microtime(true) * 1000) .',0,0,0,0,0,0,0,0,0,0,0]]}],"msg":null}';
                    $response = $this->encryptMessage($response);
                }else if($gameData[0] == 200023){
                    // JackpotInfo
                    $jackpotMoney = $slotSettings->getUpdateJackpot();
                    // $jackpotMoney = $slotSettings->getAdminJackpot();
                    $response = '{"err":0,"res":3,"vals":[0,200024,1,8,2,3,3,{"0":[[46,1,'. ($jackpotMoney[0] * 100) . ',1,[0],15,true],[46,2,'. ($jackpotMoney[1] * 100) . ',1,[1],15,true],[46,3,'. ($jackpotMoney[2] * 100) . ',1,[2],6,true],[46,4,'. ($jackpotMoney[3] * 100) . ',1,[3],10,true]]}],"msg":null}';
                    $response = $this->encryptMessage($response);
                }else if($gameData[0] == 0){
                    // LobbyLoginRespond
                    $response = '~m~115~m~~j~{"err":0,"res":3,"vals":[0,1,1,1,2,2,3,{"0":4499,"1":0,"2":"'.$serverAddress.'","3":'.$serverPort.',"4":false}],"msg":null}';
                    // $response = $this->encryptMessage($response);
                }
            }else if(isset($gameData[1])){
                $response = '~m~64~m~~j~{"err":0,"irs":1,"vals":[1,3946077,2,-1223828109],"msg":null}';
            }
            \DB::commit();
            return $response;
        }

        public function parseMessage($param){
            $vals = $param["vals"];
            $result = [];
            $length = count($vals);
            for($i = 0; $i < floor($length / 2); $i++){
                $result[$vals[$i * 2]] = $vals[$i * 2 + 1];
            }
            if(isset($result[3])){                
                $subResult = [];
                $length = count($result[3]);
                for($i = 0; $i < floor($length / 2); $i++){
                    $subResult[$result[3][$i * 2]] = $result[3][$i * 2 + 1];
                }   
                $result[3] = $subResult;
            }
            return $result;
        }

        public function encryptMessage($param){
            $param = "~j~" . $param;
            return "~m~" . strlen($param) . "~m~" . $param;
        }

        public function findZokbos($reels, $mul, $firstSymbol, $repeatCount){
            $wild = '0';
            $bPathEnded = true;
            if($repeatCount < 5){
                for($r = 0; $r < 3; $r++){
                    if($firstSymbol == $reels['reel'.($repeatCount + 1)][$r] || $reels['reel'.($repeatCount + 1)][$r] == $wild){
                        $this->findZokbos($reels, $mul, $firstSymbol, $repeatCount + 1);
                        $bPathEnded = false;
                    }
                }
            }
            if($bPathEnded == true){
                if($repeatCount >= 3){
                    $winLine = [];
                    $winLine['FirstSymbol'] = $firstSymbol;
                    $winLine['Mul'] = $mul;
                    $winLine['RepeatCount'] = $repeatCount;
                    array_push($this->winLines, $winLine);
                }
            }
        }
        public function generatJackpot($jackpotType){
            $jackpots = [];
            $tempJackpots = [0, 0, 0, 0];
            while(true){
                $rand = rand(0, 3);
                if($tempJackpots[$rand] == 2){
                    if($jackpotType == $rand){
                        array_push($jackpots, $rand);
                        break;
                    }else{
                        continue;
                    }
                }else{
                    array_push($jackpots, $rand);
                    $tempJackpots[$rand] = $tempJackpots[$rand] + 1;
                }
            }
            return $jackpots;
        }
    }

}
