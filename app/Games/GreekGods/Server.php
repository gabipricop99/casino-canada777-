<?php 
namespace VanguardLTE\Games\GreekGods
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
            	$userId = 7;
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
                $_obf_StrResponse = '';
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentBonus', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 25);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [2,3,4,3,2,2,3,4,3,2,2,3,4,3,2]);
                $award_str = '&pb_imw=0.00;0.00;0.00&pb_iv=2~aw~50;3~fs~8;4~bg~0&pb_im=r;r;r&pb_iw=0;0;0';
                if( $lastEvent != 'NULL' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->lines);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', $lastEvent->serverResponse->BonusMpl);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastEvent->serverResponse->LastReel);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentBonus', $lastEvent->serverResponse->CurrentBonus);
                    $award_str = $lastEvent->serverResponse->award_str;
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
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                {
                    $currentReelSet = 1;

                    $_obf_StrResponse = '&fs=' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .  '&fsres=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&tw=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&w=0.00&fsmul=1';
                }else{
                    $_obf_StrResponse = '';
                }
                if($slotSettings->GetGameData($slotSettings->slotId . 'CurrentBonus') > 0){
                    $spinType = 'b';
                    $_obf_StrResponse = $_obf_StrResponse . '&bgid=0&coef='.($bet * 25).'&level=0&rw=0.00&bgt=22&lifes=1&end=0&wp=0';
                }
                $lastReelStr = implode(',', $slotSettings->GetGameData($slotSettings->slotId . 'LastReel'));
                $Balance = $slotSettings->GetBalance();
                
                $response = 'wof_mask=w,w,w,w,w,w,w,w,w,w,w,w&wof_set=10,15,20,25,30,35,40,50,75,150,250,1000&def_s=2,3,4,3,2,2,3,4,3,2,2,3,4,3,2&balance='.$Balance.'&cfgs=1&ver=2&index=1&balance_cash='.$Balance.'&reel_set_size=2&def_sb=6,5,9,7,10&def_sa=10,4,7,11,9&balance_bonus=0.00&na='.$spinType.'&scatters=1~0,0,0,0,0,0,0,0,0~12,11,10,9,8,0,0,0,0~1,1,1,1,1,1,1,1,1;12~0,0,0,0,0,0,0,0,0,0,0,0,0,0,0~15,14,13,12,11,10,9,8,7,6,5,0,0,0,0~1,1,1,1,1,1,1,1,1,1,1,1,1,1,1&gmb=0,0,0&rt=d&gameInfo={props:{max_rnd_sim:"1",max_rnd_hr:"17241379",max_rnd_win:"1500"}}&stime=' . floor(microtime(true) * 1000) .'&sa=10,4,7,11,9&sb=6,5,9,7,10&sc='. implode(',', $slotSettings->Bet) .'&defc='.$bet.$award_str.'&sh=3&wilds=2~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.$_obf_StrResponse.'&sver=5&n_reel_set='.$currentReelSet.'&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;150,60,25,0,0;125,50,20,0,0;100,40,10,0,0;75,30,10,0,0;50,25,5,0,0;50,20,5,0,0;50,20,5,0,0;50,15,5,0,0;50,15,5,0,0;0,0,0,0,0&l=25&rtp=96.50&reel_set0=7,4,4,10,9,5,7,6,11,4,4,8,10,7,9,10,4,4,3,3,10,11,5,10,6,7,8,6~2,2,9,5,11,5,9,4,4,8,5,8,6,11,9,5,11,9,5,11,2,2,11,9,5,8,11,9,8,3,3,5,8,9,10,7,5,10,9~11,7,10,8,7,7,8,3,3,11,6,8,1,1,1,8,10,6,8,3,3,4,4,8,11,11,6,11,9,3,3,5,6,10~2,2,2,2,3,3,8,10,4,4,7,1,1,1,7,10,11,7,5,7,11,7,5,10,9,4,4,5,8,5,6,7,4,4,3,3,10,4,8,11~10,10,3,5,8,3,3,10,1,1,1,7,9,4,4,5,3,3,7,5,9,10,10,9,3,3,10,6,11,4,4,8,5,10,4,5,11,8&s='.$lastReelStr.'&t=243&reel_set1=7,4,4,11,7,9,12,12,12,7,4,4,9,5,6,5,7,6,10,9,4,4,9,10,3,3,12,12,12,10,6,5,11,10,6,10,5,8,10~2,2,2,2,5,11,8,5,4,4,11,8,6,9,11,5,2,2,9,12,12,12,8,11,9,5,8,3,3,2,2,8,5,8,12,12,12,7,10~11,6,10,8,4,7,3,3,11,6,8,12,12,12,10,3,3,8,9,12,12,12,4,8,11,6,3,3,11,9,5,6~2,2,2,2,11,3,3,8,9,5,10,4,4,8,12,12,12,7,7,9,4,2,2,11,6,9,10,9,12,12,12,7,11,12,12,12,7,9,4,4,3,3,11,8~10,5,8,10,3,8,3,3,9,12,12,12,10,9,4,4,7,10,3,3,7,12,12,12,8,5,10,3,3,6,7,11,4,4,8,9,10,12,12,12,5';
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
                $slotEvent['slotLines'] = 25;
                $isWelcomeFreespin = $slotSettings->GetGameData($slotSettings->slotId . 'IsWelcomeBonus');
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') <= $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                {
                    $slotEvent['slotEvent'] = 'freespin';
                }
                $lines = $slotEvent['slotLines'];
                $betline = $slotEvent['slotBet'];
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
                $reelSet_Num = 0;
                $_spinSettings = $slotSettings->GetSpinSettings($slotEvent['slotEvent'], $betline * $lines, $lines);
                $winType = $_spinSettings[0];
                $_winAvaliableMoney = $_spinSettings[1];
                if($slotEvent['slotEvent'] == 'freespin'){
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                    $leftFreeGames = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');    
                    $reelSet_Num = 1;
                }
                else
                {
                    $reelSet_Num = 0; // rand(0, 2);
                    $slotEvent['slotEvent'] = 'bet';
                    $slotSettings->SetBalance(-1 * ($betline * $lines), $slotEvent['slotEvent']);
                    $_sum = ($betline * $lines) / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), $_sum, $slotEvent['slotEvent']);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $leftFreeGames = 0;
                }
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $Balance = $slotSettings->GetBalance();
                if( $slotEvent['slotEvent'] == 'bet' ) 
                {
                    $slotSettings->UpdateJackpots($betline * $lines);
                }
                $wild = '2';
                if($slotEvent['slotEvent']=='freespin'){
                    $scatter = '12';
                }else{
                    $scatter = '1';
                }
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $awardValues = [];
                    $awardStatus = [];
                    $awardTexts = [];
                    $totalWin = 0;
                    $this->winLines = [];
                    $strWinLine = '';
                    $winLineMuls = [];
                    $winLineMulNums = [];
                    $reels = $slotSettings->GetReelStrips($winType, $slotEvent['slotEvent']);
                    for($r = 0; $r < 5; $r++){
                        if($slotEvent['slotEvent'] == 'bet' && $r < 2){
                            $awardValues[$r] = -1;    
                        }else{
                            $awardValues[$r] = $slotSettings->GetAwardValue($slotEvent['slotEvent']);
                        }
                    }
                    for($r = 0; $r < 3; $r++){
                        if($reels['reel1'][$r] != $scatter){
                            $this->findZokbos($reels, 0, $reels['reel1'][$r], 1, '~'.($r * 5));
                        }                        
                    }
                    for($r = 0; $r < count($this->winLines); $r++){
                        $winLine = $this->winLines[$r];
                        $winLineMoney = $slotSettings->Paytable[$winLine['FirstSymbol']][$winLine['RepeatCount']] * $betline;
                        if($winLineMoney > 0){
                            $strWinLine = $strWinLine . '&l'. $r.'='.$r.'~'.$winLineMoney . $winLine['StrLineWin'];
                            $totalWin += $winLineMoney;
                        }
                    }      
                    $awardWin = 0;
                    $isBonus = false;
                    $bonusMpl = 0;
                    $freeSpinNum = 0;
                    $scattersCount = 0;
                    $isScatters = [0, 0, 0, 0, 0];
                    for($r = 0; $r < 5; $r++){
                        $reelScatterCount = 0;
                        for($k = 0; $k < 3; $k++){
                            if($reels['reel' . ($r + 1)][$k] == $scatter){
                                $isScatters[$r]  = 1;
                                $scattersCount++;
                                $reelScatterCount++;
                            }
                        }
                        if($reelScatterCount == 3){
                            $awardStatus[$r] = 1;
                        }else{
                            $awardStatus[$r] = 0;
                        }
                        if($awardValues[$r] == 0){
                            if($reelScatterCount == 3){
                                $isBonus = true;
                            }
                            $awardTexts[$r] = $r . '~bg~' . 0;
                        }else if($awardValues[$r] == 1){
                            $nums = $slotSettings->GenerateFreeSpinCount($slotEvent['slotEvent'], true);
                            $awardTexts[$r] = $r . '~fs~' . $nums;
                            if($reelScatterCount == 3){
                                $freeSpinNum = $freeSpinNum + $nums;
                            }
                        }else if($awardValues[$r] > 1){
                            $awardTexts[$r] = $r . '~aw~' . ($awardValues[$r] / $lines);
                            if($reelScatterCount == 3){
                                $awardWin = $awardWin + $awardValues[$r] * $betline;
                            }
                        }else{
                            $awardTexts[$r] = '';
                        }
                    }
                    $totalWin = $totalWin + $awardWin;
                    if($scattersCount >= 5){
                        for($r = 0; $r < 5; $r++){
                            if($isScatters[$r] == 1){
                                $freeSpinNum = $freeSpinNum + $slotSettings->GenerateFreeSpinCount($slotEvent['slotEvent'], false);
                            }
                        }
                    }
                    $bonusWin = 0;
                    if($isBonus == true){
                        $bonusMpl = $slotSettings->GetBonusMul();
                        $bonusWin = $bonusMpl * $betline * $lines;
                    }
                    // if($freeSpinNum > 0){
                    //     break;
                    // }
                    if( $i >= 1000 ) 
                    {
                        $winType = 'none';
                    }
                    // if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($lines * $betline * rand(2, 5)) ) 
                    // {
                    // }
                    // else if( !$slotSettings->increaseRTP && $winType == 'win' && $lines * $betline < $totalWin ) 
                    // if( !$slotSettings->increaseRTP && $winType == 'win' && $lines * $betline < $totalWin ) 
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
                        if( $scattersCount >= 5 && $winType != 'bonus' ) 
                        {
                        }
                        else if( $totalWin + $bonusWin <= $_winAvaliableMoney && $winType == 'bonus' ) 
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
                        else if( $totalWin + $bonusWin > 0 && $totalWin + $bonusWin <= $_winAvaliableMoney && $winType == 'win' ) 
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
                        else if( $totalWin == 0 + $bonusWin && $winType == 'none' ) 
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
                if( $freeSpinNum > 0 ) 
                {
                    
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') == 0 ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $freeSpinNum);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 1);
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $freeSpinNum);
                    }
                }
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', $bonusMpl);
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

                $n_reel_set = 0;
                if( $slotEvent['slotEvent'] == 'freespin' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    $spinType = 's';
                    $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                    $isEnd = false;
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                    {
                        $n_reel_set = '0&fs_total='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fswin_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsmul_total=1&fsres_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                        $isEnd = true;
                        $spinType = 'c';
                    }
                    else
                    {
                        $n_reel_set = '1&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                        $spinType = 's';
                    }
                    
                }else
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                    if($freeSpinNum > 0 ){
                        $spinType = 's';
                        $n_reel_set = '1&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fswin=0.00&fs=1'; //&psym=1~' . $scattersWin.'~' . $_obf_scatterposes[0] .'~' . $_obf_scatterposes[1] .'~' . $_obf_scatterposes[2];
                    }                   
                }
                $strBonus = '';

                if($isBonus == true){
                    $spinType = 'b';
                    $strBonus = '&wof_mask=w,w,w,w,w,w,w,w,w,w,w,w&wof_set=10,15,20,25,30,35,40,50,75,150,250,1000&bgid=0&coef=' . ($betline * $lines) . '&bgt=22&lifes=1&bw=1&wp=0&end=0';
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentBonus', 1);
                }
                $pb_mws = [];
                $pb_ms = [];
                $pb_vs = [];
                $pb_ws = [];
                for($i = 0; $i < 5; $i++){
                    if($awardValues[$i] >= 0){
                        if($awardValues[$i] < 2){
                            $awardValues[$i] = 0;
                        }
                        array_push($pb_mws, $awardValues[$i] * $betline);
                        array_push($pb_ms, 'r');
                        array_push($pb_vs, $awardTexts[$i]);
                        array_push($pb_ws, $awardStatus[$i]);
                    }
                }

                $strAward = '&pb_imw='. implode(';', $pb_mws) .'&pb_im='. implode(';', $pb_ms) .'&pb_iv='. implode(';', $pb_vs) .'&pb_iw='. implode(';', $pb_ws);
                $response = 'tw='.$slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') .$strBonus .'&balance='.$Balance.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinLine.'&stime=' . floor(microtime(true) * 1000) .'&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=3&c='.$betline.'&sver=5&n_reel_set='.$n_reel_set.'&counter='. ((int)$slotEvent['counter'] + 1) .'&s='.$strLastReel . '&pb_mw='. implode(';', $pb_mws) .'&pb_m='. implode(';', $pb_ms) .'&pb_v='. implode(';', $pb_vs) .'&pb_w='. implode(';', $pb_ws) .'&w='.$totalWin;

                if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0)) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                }
                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"CurrentBonus":'.$slotSettings->GetGameData($slotSettings->slotId . 'CurrentBonus').',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"award_str":"' . $strAward . '","winLines":[],"Jackpots":""' . ',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $_obf_totalWin, $slotEvent['slotEvent']);
                
                if( $slotEvent['slotEvent'] != 'freespin' && $freeSpinNum > 0) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $Balance);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                }
            }else if($slotEvent['slotEvent'] == 'doBonus'){
                $slotEvent['slotEvent'] = 'bonus';
                $lastEvent = $slotSettings->GetHistory();
                if ($lastEvent == 'NULL'){
                    $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid Bonus"}';
                    exit( $response );
                }
                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentBonus', 0);
                $bonusMpl = $lastEvent->serverResponse->BonusMpl;
                $allbet = $lastEvent->serverResponse->bet * 25;
                $totalWin = $bonusMpl * $allbet;
                if($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0){
                    $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                }else{
                    $Balance = $slotSettings->GetBalance();
                }   
                if($totalWin > 0){
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), -1 * $totalWin);
                }             
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                $arr_bonusMuls = [10,15,20,25,30,35,40,50,75,150,250,1000];
                $selectIndex = -1;
                for($i = 0; $i < count($arr_bonusMuls); $i++){
                    if($bonusMpl == $arr_bonusMuls[$i]){
                        $selectIndex = $i;
                        break;
                    }
                }
                $response = 'tw='.$slotSettings->GetGameData($slotSettings->slotId . 'TotalWin').'&wof_mask=w,w,w,w,w,w,w,w,w,w,w,w&wof_set=10,15,20,25,30,35,40,50,75,150,250,1000&bgid=0&balance='.$Balance.'&coef='.$allbet.'&level=1&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus='.$Balance.'&na=s&rw='.$totalWin.'&stime=' . floor(microtime(true) * 1000) .'&bgt=22&lifes=0&wp='.$bonusMpl.'&end=1&sver=5&counter='. ((int)$slotEvent['counter'] + 1) .'&wof_wi=' . $selectIndex;
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
        public function findZokbos($reels, $mul, $firstSymbol, $repeatCount, $strLineWin){
            $wild = '2';
            $bPathEnded = true;
            if($repeatCount < 5){
                for($r = 0; $r < 3; $r++){
                    if($firstSymbol == $reels['reel'.($repeatCount + 1)][$r] || $reels['reel'.($repeatCount + 1)][$r] == $wild){
                        $this->findZokbos($reels, $mul, $firstSymbol, $repeatCount + 1, $strLineWin . '~' . ($repeatCount + $r * 5));
                        $bPathEnded = false;
                    }
                }
            }
            if($bPathEnded == true){
                if($repeatCount >= 3){
                    $winLine = [];
                    $winLine['FirstSymbol'] = $firstSymbol;
                    $winLine['Mul'] = 1;
                    $winLine['RepeatCount'] = $repeatCount;
                    $winLine['StrLineWin'] = $strLineWin;
                    array_push($this->winLines, $winLine);
                }
            }
        }
    }

}
