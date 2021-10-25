<?php 
namespace VanguardLTE\Games\HotToBurn
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
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 5);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [7,7,5,9,3,4,7,5,9,8,4,7,6,8,6]);
                if( $lastEvent != 'NULL' ) 
                {
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
                $lastReelStr = implode(',', $slotSettings->GetGameData($slotSettings->slotId . 'LastReel'));
                $Balance = $slotSettings->GetBalance();
                // $response = 'tw=0.00&ls=0&def_s=3,9,10,8,8,9,8,5,11,11,11,11,8,7,7&balance='. $Balance . $_obf_StrResponse. '&action=doSpin&accm=cp~np~mp;cp~np~mp;cp~np~mp;cp~np~mp;cp~np~mp&cfgs=1&reel1=7,9,8,11,10,6,4,8,7,10,2,11,3,7,6,9,8,5&ver=2&reel0=11,3,9,11,10,8,7,9,5,10,4,11,7,8,2,9,6&acci=0;1;2;3;4&index=1&balance_cash='. $Balance .'&def_sb=10,10,11,9,5&is=9,7,8,7,10,11,2,10,9,8,6,3,5,3,4&def_sa=11,7,3,4,6&reel3=10,6,4,8,11,7,9,6,2,9,8,3,5&reel2=2,9,10,11,5,9,7,11,6,10,9,11,4,3,10,5,8&reel4=3,9,7,11,4,7,6,8,11,7,5,11,6,2,11,10&balance_bonus=0.00&na=s&accv='.implode(';', $arr_accv).'&scatters=1~0,0,0,0,0~0,0,0,0,0~1,1,1,1,1&gmb=0,0,0&mbri=0,1,2,3,4&rt=d&stime=' . floor(microtime(true) * 1000) .'&sa=7,8,11,8,11&sb=7,8,11,2,10&sc='. implode(',', $slotSettings->Bet) .'&defc=0.10&sh=3&wilds=2~250,50,30,0,0~1,1,1,1,1&bonuses=0&wll_i=10000&fsbonus=&c='.$bet.'&sver=5&counter=2&l=20&paytable=0,0,0,0,0;0,0,0,0,0;250,50,30,0,0;90,40,25,0,0;70,35,20,0,0;60,30,15,0,0;50,24,12,0,0;40,20,10,0,0;35,18,10,0,0;30,16,8,0,0;25,12,6,0,0;20,10,5,0,0;0,0,0,0,0&rtp=96.57&s='.$lastReelStr.'&accInit=[{id:0,mask:"cp;np;mp"},{id:1,mask:"cp;np;mp"},{id:2,mask:"cp;np;mp"},{id:3,mask:"cp;np;mp"},{id:4,mask:"cp;np;mp"}]&w=0.00&mbr=' . implode(',', $currentMuls);
                $response = 'def_s=7,7,5,9,3,4,7,5,9,8,4,7,6,8,6&balance='. $Balance . '&cfgs=1&reel1=3,8,4,3,4,9,1,6,6,6,7,7,7,5,3,8,8,8,9,9,9,1,7,4,7,5,8&ver=2&reel0=5,1,8,8,8,4,7,7,7,3,6,6,6,3,5,1,9,9,9,4,7,6,5&index=1&balance_cash='. $Balance . '&def_sb=8,6,6,9,6&def_sa=7,5,9,9,9&reel3=3,8,4,3,4,9,1,6,6,6,7,7,7,5,3,8,8,8,9,9,9,1,7,4,7,5,8&reel2=3,8,4,3,4,9,1,6,6,6,7,7,7,5,3,8,8,8,9,9,9,1,7,4,7,5,8&reel4=3,8,4,3,4,9,1,6,6,6,7,7,7,5,3,8,8,8,9,9,9,1,7,4,7,5,8&balance_bonus=0.00&na=s&scatters=1~50,10,2,0,0~0,0,0,0,0~1,1,1,1,1&gmb=0,0,0&rt=d&gameInfo={props:{max_rnd_sim:"1",max_rnd_hr:"76587",max_rnd_win:"1000"}}&stime=' . floor(microtime(true) * 1000) .'&sa=7,5,9,9,9&sb=8,6,6,9,6&sc='. implode(',', $slotSettings->Bet) .'&defc=0.25&sh=3&wilds=2~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;5000,1000,100,0,0;500,200,50,0,0;500,200,50,0,0;200,50,20,0,0;200,50,20,0,0;200,50,20,0,0;200,50,20,5,0&l=5&rtp=96.71&s='.$lastReelStr;
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
                $slotEvent['slotBet'] = $slotEvent['c'];
                $slotEvent['slotLines'] = 5;
                $lines = $slotEvent['slotLines'];
                $betline = $slotEvent['slotBet'];
                if( $slotEvent['slotEvent'] == 'doSpin') 
                {
                    if( $lines <= 0 || $betline <= 0.0001 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid bet state"}';
                        exit( $response );
                    }
                    if( $slotSettings->GetBalance() < ($lines * $betline) ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid balance"}';
                        exit( $response );
                    }
                }
                $_spinSettings = $slotSettings->GetSpinSettings($slotEvent['slotEvent'], $betline * $lines, $lines);
                $winType = $_spinSettings[0];
                $_winAvaliableMoney = $_spinSettings[1];
                $slotEvent['slotEvent'] = 'bet';
                $slotSettings->SetBalance(-1 * ($betline * $lines), $slotEvent['slotEvent']);
                $_sum = ($betline * $lines) / 100 * $slotSettings->GetPercent();
                $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), $_sum, $slotEvent['slotEvent']);
                $bonusMpl = 1;
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                $Balance = $slotSettings->GetBalance();
                $slotSettings->UpdateJackpots($betline * $lines);
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $totalWin = 0;
                    $lineWins = [];
                    $lineWinNum = [];
                    $wild = '2';
                    $scatter = '1';
                    $_obf_winCount = 0;
                    $strWinLine = '';
                    $winSymbols = [];
                    $reels = $slotSettings->GetReelStrips($winType, $slotEvent['slotEvent']);
                    for( $k = 0; $k < $lines; $k++ ) 
                    {
                        $_lineWin = '';
                        $firstEle = $reels['reel1'][$linesId[$k][0] - 1];
                        $lineWinNum[$k] = 1;
                        $mul = 1;
                        $lineWins[$k] = 0;
                        for($j = 1; $j < 5; $j++){
                            $ele = $reels['reel'. ($j + 1)][$linesId[$k][$j] - 1];
                            if($firstEle == $wild){
                                $firstEle = $ele;
                                $mul = $mul * $tmpMuls[$j - 1];
                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                            }else if($ele == $firstEle || $ele == $wild){
                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                if($j == 4){
                                    $lineWins[$k] = $slotSettings->Paytable[$firstEle][$lineWinNum[$k]] * $betline;
                                    if($lineWins[$k] > 0){
                                        array_push($winSymbols, $firstEle);
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
                                        array_push($winSymbols, $firstEle);
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
                    $scattersWin = 0;
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
                        }
                    }
                    if($scattersCount >= 3){
                        $scattersWin = $betline * $lines * $slotSettings->ScatterPaytable[$scattersCount];
                    }
                    $totalWin = $totalWin + $scattersWin;
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
                if( $totalWin > 0) 
                {
                    $spinType = 'c';
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), -1 * $totalWin);
                }

                $_obf_totalWin = $totalWin;
                $lastReel = [];
                $initReel = [];
                for($k = 0; $k < 3; $k++){
                    for($j = 1; $j <= 5; $j++){
                        $lastReel[($j - 1) + $k * 5] = $reels['reel'.$j][$k];
                    }
                }
                $strLastReel = implode(',', $lastReel);
                $strReelSa = $reels['reel1'][3].','.$reels['reel2'][3].','.$reels['reel3'][3].','.$reels['reel4'][3].','.$reels['reel5'][3];
                $strReelSb = $reels['reel1'][-1].','.$reels['reel2'][-1].','.$reels['reel3'][-1].','.$reels['reel4'][-1].','.$reels['reel5'][-1];                
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                $otherResponse = "";
                if(count($winSymbols) > 0){
                    $otherResponse = "&com=" . implode(',', $winSymbols);
                }
                if($scattersCount >=3 ){
                    $otherResponse = $otherResponse . '&psym=1~' . $scattersWin.'~' . implode(',', $_obf_scatterposes);
                }

                // $response = 'tw='.$totalWin.$otherResponse.'&ls=0&balance='.$Balance.'&accm=cp~np~mp;cp~np~mp;cp~np~mp;cp~np~mp;cp~np~mp&acci=0;1;2;3;4&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&is='.$strInitReel.$strWinLine.'&balance_bonus=0.00&na='.$spinType.'&accv='.implode(';', $arr_accv).'&mbri=0,1,2,3,4&stime=' . floor(microtime(true) * 1000) .'&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=3&c='.$betline.'&sver=5&counter='. ((int)$slotEvent['counter'] + 1) .'&l=20&s='.$strLastReel.'&w='.$totalWin.'&mbr=' . implode(',', $tmpMuls);
                $response = 'tw='.$totalWin.$otherResponse.'&balance='.$Balance.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinLine.'&stime=' . floor(microtime(true) * 1000) .'&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=3&c='.$betline.'&sver=5&counter='. ((int)$slotEvent['counter'] + 1) .'&l=5&s='.$strLastReel.'&w='.$totalWin;

                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' .$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . ',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $_obf_totalWin, $slotEvent['slotEvent']);
            }
            else if( $slotEvent['slotEvent'] == 'doBonus' ){
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
