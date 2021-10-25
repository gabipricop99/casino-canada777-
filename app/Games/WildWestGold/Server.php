<?php 
namespace VanguardLTE\Games\WildWestGold
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
            $isFreeSpin = false;
            if( isset($slotEvent['pur']) && $slotEvent['pur'] == 0) 
            {
                $isFreeSpin = true;
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
                $_obf_StrResponse = '';
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'WildValues', [3, 3]);
                $slotSettings->SetGameData($slotSettings->slotId . 'WildPos', [2, 12]);
                $slotSettings->SetGameData($slotSettings->slotId . 'WildReelValues', [3,3,3]);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 40);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [11,5,7,7,5,1,6,9,9,6,12,11,9,9,11,12,11,5,5,11]);
                if( $lastEvent != 'NULL' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'WildValues', $lastEvent->serverResponse->wildValues);
                    $slotSettings->SetGameData($slotSettings->slotId . 'WildPos', $lastEvent->serverResponse->wildPos);
                    $slotSettings->SetGameData($slotSettings->slotId . 'WildReelValues', $lastEvent->serverResponse->wildReelValues);
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
                $wildValues = $slotSettings->GetGameData($slotSettings->slotId . 'WildValues');
                $wildPos = $slotSettings->GetGameData($slotSettings->slotId . 'WildPos');
                $wildReelValue = $slotSettings->GetGameData($slotSettings->slotId . 'WildReelValues');
                $lastReelStr = implode(',', $slotSettings->GetGameData($slotSettings->slotId . 'LastReel'));
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
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                {
                    $strSty = '';
                    for($r = 0; $r < count($wildPos); $r++){
                        if($r == 0){
                            $strSty = $wildPos[$r].','.$wildPos[$r];
                        }else{
                            $strSty = $strSty . '~' . $wildPos[$r].','.$wildPos[$r];
                        }
                    }

                    $_obf_StrResponse = '&fs=' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&sty='.$strSty.'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .  '&fsres=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&tw=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&w=0.00&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . 
                    '&mbv='. implode(',', $wildValues) . '&mbp=' . implode(',', $wildPos) . '&mbr=' . implode(',', $wildReelValue).'$is='. $lastReelStr;
                    $currentReelSet = 1;
                }else{
                    $_obf_StrResponse = '&mbv='. implode(',', $wildValues) . '&mbp=' . implode(',', $wildPos) . '&mbr=1,1,1&mbp=' . implode(',', $wildReelValue).'';
                }
                $Balance = $slotSettings->GetBalance();
                $response = 'def_s=11,5,7,7,5,1,6,9,9,6,12,11,9,9,11,12,11,5,5,11&apvi=10&balance='. $Balance .'&cfgs=1&ver=2&index=1&balance_cash='. $Balance .'&reel_set_size=2&def_sb=8,2,6,6,1&def_sa=11,9,5,3,9&reel_set='.$currentReelSet.$_obf_StrResponse.'&balance_bonus=0.00&na='. $spinType.'&scatters=1~0,0,0,0,0~0,0,8,0,0~1,1,1,1,1;14~0,0,0,0,0~0,0,8,0,0~1,1,1,1,1&cls_s=-1&gmb=0,0,0&mbri=1,2,3&rt=d&gameInfo={props:{max_rnd_sim:"1",max_rnd_hr:"106382978",max_rnd_win:"4500"}}&wl_i=tbm~10000&apti=bet_mul&stime=' . floor(microtime(true) * 1000) .'&sa=11,9,5,3,9&sb=8,2,6,6,1&sc='. implode(',', $slotSettings->Bet) .'&defc=0.10&sh=4&wilds=2~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;400,100,30,0,0;250,75,25,0,0;150,40,15,0,0;100,25,10,0,0;75,15,7,0,0;50,10,5,0,0;30,6,3,0,0;30,6,3,0,0;20,5,2,0,0;20,5,2,0,0;20,5,2,0,0;0,0,0,0,0&l=40&rtp=96.51&total_bet_max=10,000.00&reel_set0=7,11,11,1,12,12,6,8,4,10,10,5,11,11,9,9,3,13,13,5,8,12,12,1,13,13,6,10,10~7,11,11,2,12,12,6,8,4,9,9,5,13,13,3,11,11,5,8,12,12,2,13,13,6,10,10~9,7,11,11,2,13,13,6,8,4,9,9,5,10,10,1,6,8,3,11,11,5,8,12,12,2,13,13,6~7,10,10,2,12,12,6,8,11,11,4,9,9,5,6,7,3,11,11,5,6,12,12,7,13,13,6~7,10,10,1,12,12,6,8,4,9,9,5,6,7,3,11,11,5,6,13,13,7,13,13,6,10,10&s='.$lastReelStr.'&reel_set1=10,5,9,9,7,10,10,8,12,12,6,13,13,8,9,9,4,9,9,5,6,8,3,3,3,3,11,11~7,10,10,2,12,12,6,8,4,9,9,5,6,3,11,11,5,6,12,12,7,13,13,2,10,10,7,4~7,10,10,2,12,12,6,8,4,9,9,5,6,3,11,11,5,6,12,12,8,13,13,2,10,10,7,4~7,10,10,2,12,12,6,8,4,9,9,5,6,7,3,11,11,5,6,12,12,7,13,13,6,10,10,7~10,10,6,12,12,8,4,9,9,5,6,7,3,3,3,3,11,11,6,12,12,7,13,13,6,10,10,7&purInit=[{type:"fs",bet:2000,fs_count:8}]&mbr=1,1,1&total_bet_min=0.20';
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
                $linesId[0] = [1,1,1,1,1];
                $linesId[1] = [2,2,2,2,2];
                $linesId[2] = [3,3,3,3,3];
                $linesId[3] = [4,4,4,4,4];
                $linesId[4] = [1,2,1,2,1];
                $linesId[5] = [2,1,2,1,2];
                $linesId[6] = [2,3,2,3,2];
                $linesId[7] = [3,2,3,2,3];
                $linesId[8] = [3,4,3,4,3];
                $linesId[9] = [4,3,4,3,4];
                $linesId[10] = [1,4,1,4,1];
                $linesId[11] = [4,1,4,1,4];
                $linesId[12] = [1,2,3,2,1];
                $linesId[13] = [2,3,4,3,2];
                $linesId[14] = [3,2,1,2,3];
                $linesId[15] = [4,3,2,3,4];
                $linesId[16] = [1,1,2,1,1];
                $linesId[17] = [2,2,3,2,2];
                $linesId[18] = [3,3,4,3,3];
                $linesId[19] = [4,4,1,4,4];
                $linesId[20] = [4,4,3,4,4];
                $linesId[21] = [3,3,2,3,3];
                $linesId[22] = [2,2,1,2,2];
                $linesId[23] = [1,1,4,1,1];
                $linesId[24] = [1,3,3,3,1];
                $linesId[25] = [2,3,3,3,2];
                $linesId[26] = [3,4,4,4,3];
                $linesId[27] = [4,1,1,1,4];
                $linesId[28] = [4,3,3,3,4];
                $linesId[29] = [3,2,2,2,3];
                $linesId[30] = [2,1,1,1,2];
                $linesId[31] = [1,4,4,4,1];
                $linesId[32] = [2,4,2,4,2];
                $linesId[33] = [1,3,1,3,1];
                $linesId[34] = [3,1,3,1,3];
                $linesId[35] = [4,2,4,2,4];
                $linesId[36] = [4,3,2,1,2];
                $linesId[37] = [1,2,3,4,3];
                $linesId[38] = [4,1,2,1,4];
                $linesId[39] = [1,4,3,4,1];
                $slotEvent['slotBet'] = $slotEvent['c'];
                $slotEvent['slotLines'] = 40;
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
                    if($slotEvent['slotEvent'] == 'freespin' && $isFreeSpin == true){
                        $isFreeSpin = false;
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
                $_wildValue = [];
                $_wildPos = [];
                $_wildReelValue = [];
                $_spinSettings = $slotSettings->GetSpinSettings($slotEvent['slotEvent'], $betline * $lines, $lines);
                $winType = $_spinSettings[0];
                $_winAvaliableMoney = $_spinSettings[1];
                if($slotEvent['slotEvent'] == 'freespin'){
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                    $_wildValue = $slotSettings->GetGameData($slotSettings->slotId . 'WildValues');
                    $_wildPos = $slotSettings->GetGameData($slotSettings->slotId . 'WildPos');
                    $leftFreeGames = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');    
                }
                else
                {
                    $slotEvent['slotEvent'] = 'bet';
                    if($isFreeSpin == true){
                        $slotSettings->SetBalance(-1 * ($betline * 2000), $slotEvent['slotEvent']);
                        $winType = 'bonus';
                        $_winAvaliableMoney = $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''));
                    }else{
                        $slotSettings->SetBalance(-1 * ($betline * $lines), $slotEvent['slotEvent']);
                    }
                    $_sum = ($betline * $lines) / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), $_sum, $slotEvent['slotEvent']);
                    
                    $bonusMpl = 1;
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                    $leftFreeGames = 0;
                }
                
                $Balance = $slotSettings->GetBalance();
                if( $slotEvent['slotEvent'] != 'bet' ) 
                {
                    $slotSettings->UpdateJackpots($betline * $lines);
                }
                // if($winType == 'win'){
                //     $test = 1;
                // }
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $totalWin = 0;
                    $lineWins = [];
                    $lineWinNum = [];
                    $wild = '2';
                    $scatter = '1';
                    $_obf_winCount = 0;
                    $strWinLine = '';
                    $reels = $slotSettings->GetReelStrips($winType, $slotEvent['slotEvent']);
                    $tempReels = [];
                    $tempWildReels = [];
                    $_wildReelValue = $slotSettings->CheckMultiWild();
                    for($r = 0; $r < 5; $r++){
                        $tempWildReels[$r] = [];
                        $tempReels['reel' . ($r+1)] = [];
                        for( $k = 0; $k < 4; $k++ ) 
                        {
                            if( $reels['reel' . ($r+1)][$k] == $wild) 
                            {                                
                                if($slotEvent['slotEvent'] == 'freespin'){
                                    if(($r == 2 && rand(0, 100) < 70) || $winType == 'none'){
                                        $reels['reel' . ($r+1)][$k] = '' . rand(3, 10);
                                        $tempWildReels[$r][$k] = 0;    
                                    }else{
                                        if($r > 0 && $r < 4){
                                            $tempWildReels[$r][$k] = $_wildReelValue[$r - 1];
                                        }else{
                                            $tempWildReels[$r][$k] = 0;    
                                        }
                                    }
                                }else{
                                    if($r > 0 && $r < 4){
                                        $tempWildReels[$r][$k] = $_wildReelValue[$r - 1];
                                    }else{
                                        $tempWildReels[$r][$k] = 0;    
                                    }
                                }
                            }else{
                                $tempWildReels[$r][$k] = 0;
                            }
                            $tempReels['reel' . ($r+1)][$k] = $reels['reel' . ($r+1)][$k];
                        }
                    }
                    if($slotEvent['slotEvent'] == 'freespin'){
                        for($r = 0; $r < count($_wildPos); $r++){
                            $col = $_wildPos[$r] % 5;
                            $row = floor($_wildPos[$r] / 5);
                            $reels['reel'.($col + 1)][$row] = $wild;
                            $tempWildReels[$col][$row] = $_wildValue[$r];
                        }
                    }

                    $_lineWinNumber = 1;
                    for( $k = 0; $k < $lines; $k++ ) 
                    {
                        $_lineWin = '';
                        $firstEle = $reels['reel1'][$linesId[$k][0] - 1];
                        $lineWinNum[$k] = 1;
                        $lineWins[$k] = 0;
                        $mul = 0;
                        for($j = 1; $j < 5; $j++){
                            $ele = $reels['reel'. ($j + 1)][$linesId[$k][$j] - 1];
                            if($firstEle == $wild){
                                $firstEle = $ele;
                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                $mul = $mul + $tempWildReels[$j][$linesId[$k][$j] - 1];
                            }else if($ele == $firstEle || $ele == $wild){
                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                if($ele == $wild){
                                    $mul = $mul + $tempWildReels[$j][$linesId[$k][$j] - 1];
                                }
                                if($j == 4){
                                    if($mul == 0){$mul = 1;}
                                    $lineWins[$k] = $slotSettings->Paytable[$firstEle][$lineWinNum[$k]] * $betline * $mul;
                                    $totalWin += $lineWins[$k];
                                    $_obf_winCount++;
                                    $strWinLine = $strWinLine . '&l'. ($_obf_winCount - 1).'='.$k.'~'.$lineWins[$k];
                                    for($kk = 0; $kk < $lineWinNum[$k]; $kk++){
                                        $strWinLine = $strWinLine . '~' . (($linesId[$k][$kk] - 1) * 5 + $kk);
                                    }
                                }
                            }else{
                                if($slotSettings->Paytable[$firstEle][$lineWinNum[$k]] > 0){
                                    if($mul == 0){$mul = 1;}
                                    $lineWins[$k] = $slotSettings->Paytable[$firstEle][$lineWinNum[$k]] * $betline * $mul;
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
                    
                    $freeSpinNums = [];                    
                    $freeSpinNum = 0;

                    $_obf_scatterposes = [];
                    $scattersCount = 0;
                    $scattersWin = 0;
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = '';
                    if($slotEvent['slotEvent'] == 'freespin'){
                        $freeSpinScatters = $slotSettings->GetFreeScatters();
                        $freespinCount = 0;
                        for($r = 0; $r < count($freeSpinScatters); $r++){
                            for($k = 0; $k < count($_wildPos); $k++){
                                if($freeSpinScatters[$r] == $_wildPos[$k]){
                                    $freeSpinScatters[$r] = -1;
                                    break;
                                }
                            }
                            if($freeSpinScatters[$r] >= 0){
                                $freespinCount++;
                            }
                        }
                        $freeSpins = [0,0,4,8,12,20];
                        $freeSpinNum = $freeSpins[$freespinCount];
                    }else{
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $k = 0; $k <= 3; $k++ ) 
                            {
                                if( $reels['reel' . $r][$k] == $scatter ) 
                                {
                                    $scattersCount++;
                                    array_push($_obf_scatterposes, $k * 5 + $r - 1);
                                }
                            }
                        }
                        if($scattersCount >= 3){
                            $scattersWin = 0;
                            $freeSpinNum = 8;
                        }
                    }
                    
                    $totalWin = $totalWin + $scattersWin;
                    if( $i >= 1000 ) 
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
                            // $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                            // exit( $response );
                            break;
                        }
                        if( $scattersCount >= 3 && $winType != 'bonus' ) 
                        {
                        }
                        else if($slotEvent['slotEvent'] == 'freespin'&& ($i > 1000 && $freeSpinNum)){
                            if($totalWin * ($leftFreeGames + $freeSpinNum) < $_winAvaliableMoney){
                                break;
                            }
                        }
                        else if( $totalWin <= $_winAvaliableMoney && $winType == 'bonus' ) 
                        {
                            $_obf_0D163F390C080D0831380D161E12270D0225132B261501 = $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''));
                            if( $_obf_0D163F390C080D0831380D161E12270D0225132B261501 < $_winAvaliableMoney ) 
                            {
                                $_winAvaliableMoney = $_obf_0D163F390C080D0831380D161E12270D0225132B261501;
                            }
                            else
                            {
                                if($freeSpinNum > 0){
                                    if($_winAvaliableMoney > $totalWin * $freeSpinNum){
                                        break;
                                    }else{
                                        continue;
                                    }
                                }else{
                                    break;
                                }
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
                    }
                }
                $spinType = 's';
                $isEndRespin = false;
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
                if( $freeSpinNum > 0 ) 
                {
                    
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') == 0 ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $freeSpinNum);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 1);
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $freeSpinNum);
                    }
                }
                $lastTempReel = [];
                for($k = 0; $k < 4; $k++){
                    for($j = 1; $j <= 5; $j++){
                        $lastReel[($j - 1) + $k * 5] = $reels['reel'.$j][$k];
                        $lastTempReel[($j - 1) + $k * 5] = $tempReels['reel'.$j][$k];
                    }
                }
                $strLastReel = implode(',', $lastReel);
                $strLastTempReel = implode(',', $lastTempReel);
                $strReelSa = $reels['reel1'][4].','.$reels['reel2'][4].','.$reels['reel3'][4].','.$reels['reel4'][4].','.$reels['reel5'][4];
                $strReelSb = $reels['reel1'][-1].','.$reels['reel2'][-1].','.$reels['reel3'][-1].','.$reels['reel4'][-1].','.$reels['reel5'][-1];
               
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);

                $_wildValue = [];
                $_wildPos = [];
                for($r = 0; $r < 4; $r++){
                    for($k = 0; $k < 5; $k++){
                        if($tempWildReels[$k][$r] > 0){
                            array_push($_wildValue, $tempWildReels[$k][$r]);
                            array_push($_wildPos, $r * 5 + $k);
                        }
                    }
                }


                $slotSettings->SetGameData($slotSettings->slotId . 'WildValues', $_wildValue);
                $slotSettings->SetGameData($slotSettings->slotId . 'WildPos', $_wildPos);
                $slotSettings->SetGameData($slotSettings->slotId . 'WildReelValues', $_wildReelValue);
                $strWildResponse = '';
                if(count($_wildPos) > 0 && count($_wildValue)){
                    $strWildResponse = '&mbv='. implode(',', $_wildValue) . '&mbp=' . implode(',', $_wildPos);
                }
                if( $slotEvent['slotEvent'] == 'freespin' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    $spinType = 's';
                    $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                    $isEnd = false;
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                    {
                        $isEnd = true;
                        $spinType = 'c&fs_total='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fswin_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsmul_total=1&fsres_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&n_reel_set=0';
                    }
                    else
                    {
                        $spinType = 's&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&n_reel_set=1';
                    }

                    $strSty = '';
                    for($r = 0; $r < count($_wildPos); $r++){
                        $endPos = $_wildPos[$r];
                        if($isEnd == true){
                            $endPos = -1;
                        }
                        if($r == 0){
                            $strSty = $_wildPos[$r].','.$endPos;
                        }else{
                            $strSty = $strSty . '~' . $_wildPos[$r].','.$endPos;
                        }
                    }
                    $strFreeSpinNum = "";
                    if(count($freeSpinScatters) > 0){
                        $strfreescatters = [];
                        $strfreescattermarks = [];
                        $isFreeScatter = false;
                        for($k = 0; $k < count($freeSpinScatters); $k++){
                            if($freeSpinScatters[$k] >= 0){
                                array_push($strfreescatters, '14~'.$freeSpinScatters[$k]);
                                array_push($strfreescattermarks, 'v');
                                $isFreeScatter = true;
                            }
                        }
                        if($isFreeScatter == true){
                            $strFreeSpinNum = '&ds='.implode(';', $strfreescatters).'&dsam='.implode(';', $strfreescattermarks);
                            if($freeSpinNum > 0){
                                $strFreeSpinNum = $strFreeSpinNum.'&dsa=1&fsmore='.$freeSpinNum;
                            }
                        }
                    }
                    $response = 'tw='. $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . $strFreeSpinNum. $strWildResponse .'&balance='.$Balance.'&index='. $slotEvent['index'] . '&ls=0&balance_cash='.$Balance.'&is='. $strLastTempReel .'&balance_bonus=0.00&na='.$spinType.
                        '&mbri=1,2,3'.$strWinLine .'&stime=' . floor(microtime(true) * 1000).'&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=4&c='.$betline.'&sty='.$strSty.'&sver=5&counter='. ((int)$slotEvent['counter'] + 1) .'&l=40&s='.$strLastReel.'&w='.$totalWin.'&mbr='. implode(',',$_wildReelValue);
                }else
                {
                    // $_obf_0D5C3B1F210914123C222630290E271410213E320B0A11 = $totalWin;
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                    $n_reel_set = '0';
                    if($scattersCount >=3 ){
                        $spinType = 's';
                        $n_reel_set = '0&fsmul=1&fsmax='.$freeSpinNum.'&fswin=0.00&fs=1&fsres=0.00';
                    }

                    $response = 'tw='.$totalWin . $strWildResponse .'&ls=0&balance='.$Balance.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinLine.'&mbri=1,2,3&stime=' . floor(microtime(true) * 1000) .
                        '&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=4&c='.$betline.'&sver=5&n_reel_set='.$n_reel_set.'&counter='. ((int)$slotEvent['counter'] + 1) .'&l=40&s='.$strLastReel.'&w='.$totalWin.'&mbr='. implode(',',$_wildReelValue);
                }


                if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0)) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                }

                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . 
                    ',"Balance":' . $Balance . ',"wildValues":'.json_encode($_wildValue) . ',"wildPos":'.json_encode($_wildPos).',"wildReelValues":'.json_encode($_wildReelValue).
                    ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . 
                    ',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $_obf_totalWin, $slotEvent['slotEvent']);
                
                if( $scattersCount >= 3) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $Balance);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                }
            }
            else if( $slotEvent['slotEvent'] == 'doBonus' ){
                $lastEvent = $slotSettings->GetHistory();
                $betline = $lastEvent->serverResponse->bet;
                $lines = 40;
                $Balance = $slotSettings->GetBalance();
                if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') < $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotEvent['slotEvent'] == 'freespin' ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                    exit( $response );
                }
                $response = 'fsmul='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl').'&bgid=0&balance='.$Balance.'&win_fs='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').
                    '&wins='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinWins').'&fsmax='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&index='.$slotEvent['index'].
                    '&balance_cash='.$Balance.'&balance_bonus=0.00&na=s&fswin=0.00&stime=' . floor(microtime(true) * 1000) .'&fs=' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . 
                    '&bgt=32&wins_mask=nff,nff,nff,nff,nff,nff,nff,nff,nff&end=1&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&sver=5&n_reel_set=1&counter='. ((int)$slotEvent['counter'] + 1);
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
