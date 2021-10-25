<?php 
namespace VanguardLTE\Games\JohnHunterTOSQ
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
                $_obf_StrResponse = '';
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalRespinMoney', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 25);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [6,7,4,2,8,9,8,5,6,7,8,6,7,3,9]);
                if( $lastEvent != 'NULL' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalRespinMoney', $lastEvent->serverResponse->totalRespinMoney);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', $lastEvent->serverResponse->BonusMpl);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastEvent->serverResponse->LastReel);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->lines);
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
                $totalRespinMoney = $slotSettings->GetGameData($slotSettings->slotId . 'TotalRespinMoney');
                $_obf_StrResponse = '';
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') <= $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                {
                    $_obf_StrResponse = '&prg_m=cp,acw&prg='.$totalRespinMoney.','. $totalRespinMoney * $bet .'&fs=' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .  '&fsres=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&tw=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&w=0.00&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . '';
                    $currentReelSet = 1;
                }else if($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') < $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $totalRespinMoney > 0){
                    $_obf_StrResponse = '&prg_m=cp,acw&prg='.$totalRespinMoney.','. $totalRespinMoney * $bet . '&fs_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&fswin_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .  '&fsmul_total=1&fsres_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&rs=t&rs_c=1&rs_m=1';
                    $currentReelSet = 1;
                }
                $lastReelStr = implode(',', $slotSettings->GetGameData($slotSettings->slotId . 'LastReel'));
                $Balance = $slotSettings->GetBalance();
                $response = 'msi=12&def_s=6,7,4,2,8,9,8,5,6,7,8,6,7,3,9&msr=17&balance='. $Balance .'&cfgs=1&ver=2&mo_s=11&index=1&balance_cash='. $Balance .'&reel_set_size=3&def_sb=10,11,9,6,8&mo_v=25,50,75,125,200,250,300,375,450,500,625,750,875&def_sa=7,5,4,4,3&reel_set='.$currentReelSet.$_obf_StrResponse.
                    '&balance_bonus=0.00&na=s&scatters=1~0,0,1,0,0~0,0,8,0,0~1,1,1,1,1&gmb=0,0,0&rt=d&stime=' . floor(microtime(true) * 1000) . '&sa=7,5,4,4,3&sb=10,11,9,6,8&sc='. implode(',', $slotSettings->Bet) .'&defc=0.01&sh=3&wilds=2~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.
                    '&sver=5&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;800,50,10,0,0;175,30,5,0,0;150,25,5,0,0;125,25,5,0,0;100,20,5,0,0;100,10,5,0,0;100,10,5,0,0;100,10,5,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0&l=25&rtp=96.50&reel_set0=5,7,6,4,10,9,4,5,7,6,9,7,11,11,11,11,10,8,4,7,6,9,5,10,6,8,3,4,10,5,7,9,6,10,4,9,5,8,9,6,10,3,7,6,10,8,9,10,6,9,5,3,10~7,2,2,2,2,2,4,8,5,9,1,10,6,9,4,7,8,11,11,11,11,10,6,9,4,8,3,9,5,10,4,9,1,7,5,9,3,8,5,4,9,8,3,7,4,8,5,9,6,10,1,8~3,2,2,2,2,2,8,5,9,1,10,4,8,7,3,8,6,5,8,4,7,1,8,5,9,6,8,9,2,2,2,8,10,6,8,5,7,1,8,6,9,11,11,11,11,8,6,3,9,5,8,10~10,2,2,2,2,5,6,4,7,10,3,7,11,11,11,11,9,5,7,3,10,1,7,6,9,4,7,8,9,3,7,4,10,6,7,1,8,7,3,9,5,7,8,6,7,9,6,7,4,5,8,3,10,4,9,1,7,3,5,8,6,9,7,4,10,3,9,1~7,2,2,6,4,3,9,5,8,6,4,7,6,10,7,6,12,9,4,5,7,6,10,5,7,4,10,6,7,4,9,6,8,3,6,9,5,3,10,6,7,5,4,8,9,6,10,4,7,6,8,4,9,12,10,6,7,4,10,9,5,6,10,8,4,7,8,10,4,8,5,9,6,10,9,4,7,8&s='.$lastReelStr.'&reel_set2=18,18,18,18~18,18,18,18~18,18,18,18~18,18,18,18~7,2,2,2,4,8,6,10,3,9,5,12,3,4,7,6,10,9,5,10,7,6,9,4,3,7,6,5,10,7,12,10,6,7,4,9,6,8,7,6,9,5,3,10,6,7,5,3,8,9,12,10,4,7,3,9,4,8,9,4,10,6,5,3,10,9,5,6,9&reel_set1=5,7,6,3,10,9,4,5,7,6,9,7,11,11,11,11,11,9,5,10,6,8,3,4,10,5,7,9,6,10,4,9,5,8,9,6,10,3,7,6,8,10,9,6,11,11,11,11,11,7,4,10~7,2,2,2,2,2,2,2,2,2,3,8,5,9,1,10,6,9,4,11,11,11,11,11,5,10,6,9,4,8,3,9,5,10,4,9,1,7,5,9,11,11,11,11,11,8,3,7,4,8,5,9,6,10,1,8~8,2,2,2,2,2,2,2,2,2,2,2,5,9,1,10,4,8,7,9,8,6,5,8,4,7,1,8,5,9,11,11,11,11,11,4,10,8,6,5,8,7,1,8,6,9,11,11,11,11,11,6,8,9,5,8,3~10,2,2,2,2,2,2,2,2,2,2,2,2,2,2,10,3,7,11,11,11,11,11,5,7,3,10,1,7,6,9,4,7,8,9,3,7,4,10,6,7,1,8,7,3,9,5,7,8,6,11,11,11,11,11,11,5,8,10,4,9,1,7,3,5,8,6,9,7,4,10,3,9,1~7,2,2,8,6,10,3,9,5,12,3,4,7,6,10,7,6,12,9,4,8,7,6,12,5,7,4,10,6,7,12,9,6,8,3,6,9,5,4,10,6,7,12,4,8,9,6,10,12,7,6,8,4,9,12,10,6,7,3,10,9,12,6,10,4,8,7,12,10,4,8,5,9,6,12,10,4,7,8';
                // $response = 'def_s=6,7,4,2,8,9,8,5,6,7,8,6,7,3,9&bgid=0&balance='. $Balance .'&cfgs=1&ver=2&mo_s=11&index=1&balance_cash='.$Balance.'&reel_set_size=2&def_sb=10,11,9,6,8&mo_v=25,50,75,125,200,250,300,375,450,500,625,750,875,0&def_sa=7,5,4,4,3&bonusInit=[{bgid:0,bgt:18,bg_i:"1000,200,100,50",bg_i_mask:"pw,pw,pw,pw"}]&mo_jp=0&balance_bonus=0.00&na='. $spinType .
                //     '&scatters=1~0,0,1,0,0~0,0,8,0,0~1,1,1,1,1&gmb=0,0,0&bg_i=1000,200,100,50&rt=d&mo_jp_mask=jpb&stime=1609309922326&bgt=18&sa=7,5,4,4,3&sb=10,11,9,6,8&sc='. implode(',', $slotSettings->Bet) .'&defc=0.01&sh=3&wilds=2~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&n_reel_set='.$currentReelSet.$_obf_StrResponse.
                //     '&bg_i_mask=pw,pw,pw,pw&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;500,50,10,0,0;300,50,10,0,0;250,25,10,0,0;200,25,10,0,0;100,15,5,0,0;100,15,5,0,0;100,15,5,0,0;100,15,5,0,0;0,0,0,0,0;0,0,0,0,0&l='.$slotSettings->GetGameData($slotSettings->slotId . 'Lines') .'&rtp=96.53&reel_set0=5,7,6,3,10,9,4,5,7,6,9,7,11,11,11,11,8,10,6,9,5,10,6,8,3,4,10,5,7,9,6,10,4,9,5,8,9,6,10,3,7,6,8,10,8,4,7,10,6,9,5,3,10,7~7,2,2,2,2,2,9,3,8,5,9,1,10,6,9,4,7,8,11,11,11,11,7,9,4,8,3,9,5,10,4,9,1,7,5,9,3,8,5,4,9,10,6,9,3,7,4,8,5,9,6,10~3,2,2,2,2,2,8,5,9,1,10,4,8,7,3,8,6,5,8,4,7,6,8,5,9,6,3,9,8,3,10,2,2,2,2,2,8,6,8,5,7,1,8,6,9,3,10,11,11~10,2,2,2,2,2,9,8,5,4,7,1,10,3,7,11,11,11,11,4,9,3,10,1,7,6,9,4,7,8,6,9,3,7,4,10,6,7,1,8,7,3,9,5,7,1,8,6,7,9,5,7,9,6,7,4,5,8,3~7,2,2,2,2,8,6,10,3,9,5,8,3,4,7,6,10,9,5,10,7,6,9,4,3,7,6,10,5,7,12,10,6,7,4,9,6,8,7,6,9,5,3,10,6,7,5,3,8,9,6,10,4,7,3,9,4,9,8&s='.$lastReelStr.'&reel_set1=5,7,6,3,10,9,4,5,7,6,9,7,11,11,11,5,8,10,6,9,5,6,10,8,3,4,10,11,11~7,2,2,2,2,2,9,3,8,5,9,1,10,6,9,4,7,8,11,11,11,5,7,9,4,8,3,9~3,2,2,2,2,2,8,5,9,1,10,4,8,11,11,11,6,5,8,4,7,1,8,5,9,6,3,9~10,2,2,2,2,2,2,2,2,4,7,1,10,3,7,5,11,11,11,4,9,3,10,1,7,6,9,4,8~12,2,2,9,6,10,12,9,5,8,3,4,9,6,10,3,9,10,12,6,9,3,7,12,10,8,8,3';
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
                $linesId[5] = [
                    2, 
                    1, 
                    1, 
                    1, 
                    2
                ];
                $linesId[6] = [
                    2, 
                    3, 
                    3, 
                    3, 
                    2
                ];
                $linesId[7] = [
                    1, 
                    1, 
                    2, 
                    3, 
                    3
                ];
                $linesId[8] = [
                    3, 
                    3, 
                    2, 
                    1, 
                    1
                ];
                $linesId[9] = [
                    2, 
                    3, 
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
                $slotEvent['slotBet'] = $slotEvent['c'];
                $slotEvent['slotLines'] = 25;
                $totalRespinMoney = $slotSettings->GetGameData($slotSettings->slotId . 'TotalRespinMoney');
                if( (($slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') <= $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0)) || $totalRespinMoney > 0) 
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
                    if($isWelcomeFreespin == 0){
                        if( $slotEvent['slotEvent'] == 'doSpin' && $slotSettings->GetBalance() < ($lines * $betline) ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid balance"}';
                            exit( $response );
                        }
                        // if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') < $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotEvent['slotEvent'] == 'freespin' )  ||  $totalRespinMoney == 0) 
                        // {
                        //     $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                        //     exit( $response );
                        // }
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
                $_spinSettings = $slotSettings->GetSpinSettings($slotEvent['slotEvent'], $betline * $lines, $lines);
                $winType = $_spinSettings[0];
                $_winAvaliableMoney = $_spinSettings[1];
                $_moneyValue = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; 
                $_reelset = 0;
                if($slotEvent['slotEvent'] == 'freespin'){
                    if($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') < $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $totalRespinMoney > 0){
                        $_reelset = 2;
                    }else{
                        $_reelset = 1;
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                    }
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
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                }
                $Balance = $slotSettings->GetBalance();
                if($winType == 'win'){
                    $test = 1;
                }
                if( $slotEvent['slotEvent'] != 'bet' ) 
                {
                    $slotSettings->UpdateJackpots($betline * $lines);
                }
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $totalWin = 0;
                    $lineWins = [];
                    $lineWinNum = [];
                    $cWins = [
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0
                    ];
                    $wild = '2';
                    $scatter = '1';
                    $moneysymbol = '11';
                    $_obf_winCount = 0;
                    $strWinLine = '';
                    $initReels = $slotSettings->GetReelStrips($winType, $_reelset);
                    $moneyCollectSymbol = 0;
                    $moneyCollectPos = -1;
                    $extraMoney = 0;
                    $_obf_scatterposes = [];
                    $scattersCount = 0;
                    $scattersWin = 0;
                    $isMoney = false;
                    if($initReels['reel5'][0] == 12 || $initReels['reel5'][1] == 12 || $initReels['reel5'][2] == 12){
                        $moneyCollectSymbol = $slotSettings->GetMoneySymbol();
                        if($_reelset == 2){
                            $moneyCollectSymbol = 17;
                        }
                        if($moneyCollectSymbol == 13){
                            $extraMoney = $slotSettings->GetMoneyWin();
                        }else if($moneyCollectSymbol == 14){
                            $extraMoney = $slotSettings->GetMoneyMulti();
                        }
                    }
                    $reels = [];
                    $isRespinChanged = false;
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        $reels['reel' . $r] = [];
                        for( $k = 0; $k <= 2; $k++ ) 
                        {
                            if( $initReels['reel' . $r][$k] == $moneysymbol) 
                            {
                                if($moneyCollectSymbol == 15){
                                    $reels['reel' . $r][0] = 11;    
                                    $reels['reel' . $r][1] = 11;    
                                    $reels['reel' . $r][2] = 11;    
                                    break;
                                }else if($moneyCollectSymbol == 16){
                                    if(rand(0, 100) < 50 || $isRespinChanged == false){
                                        $initReels['reel' . $r][$k] = rand(5, 10);
                                        $reels['reel' . $r][$k] = 11;
                                        $isRespinChanged = true;
                                    }else{
                                        $reels['reel' . $r][$k] = $initReels['reel' . $r][$k];  
                                    }
                                }else{
                                    $reels['reel' . $r][$k] = $initReels['reel' . $r][$k];
                                }
                            }else if($initReels['reel' . $r][$k] == 12){
                                $moneyCollectPos = $k * 5 + $r - 1;
                                $reels['reel' . $r][$k] = $moneyCollectSymbol;
                            }else{
                                $reels['reel' . $r][$k] = $initReels['reel' . $r][$k];
                            }
                        }
                    }
                    if($_reelset == 2){
                        if($moneyCollectSymbol > 12){
                            $totalWin = $totalRespinMoney * $betline;
                        }
                    }else{
                        $_lineWinNumber = 1;
                        for( $k = 0; $k < $lines; $k++ ) 
                        {
                            $_lineWin = '';
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
                    
                    
                    for( $r = 2; $r <= 4; $r++ ) 
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
                        $scattersWin = $lines * $betline;
                    }
                    for($r = 0; $r <= 2; $r++){
                        for( $k = 0; $k < 5; $k++ ) 
                        {
                            if( $reels['reel' . ($k+1)][$r] == $moneysymbol) 
                            {
                                $_moneyValue[$r * 5 + $k] = $slotSettings->GetMoneyWin();
                                $isMoney = true;
                            }else{
                                $_moneyValue[$r * 5 + $k] = 0;
                            }
                        }
                    }
                    $moneyTotalWin = 0;
                    $freemoneyTotalWin = 0;
                    for($r = 0; $r < count($_moneyValue); $r++){
                        if($_moneyValue[$r] > 0){
                            if($moneyCollectSymbol == 13){
                                $freemoneyTotalWin = $freemoneyTotalWin + ($_moneyValue[$r] + $extraMoney);
                            }else if($moneyCollectSymbol == 14){
                                $freemoneyTotalWin = $freemoneyTotalWin + ($_moneyValue[$r] * $extraMoney);
                            }else{
                                $freemoneyTotalWin = $freemoneyTotalWin + $_moneyValue[$r];
                            }
                        }
                    }
                    if($moneyCollectSymbol > 12 && $isMoney == true){
                        $moneyTotalWin = $freemoneyTotalWin * $betline;
                    }
                    $totalWin = $totalWin + $moneyTotalWin + $scattersWin; 
                    // if($moneyCollectSymbol > 0){
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
                        if( $i > 2000 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                            exit( $response );
                        }
                        if( $scattersCount >= 3 && $winType != 'bonus' ) 
                        {
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
                                break;
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

                if( $scattersCount >= 3 ) 
                {
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') == 0 ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->slotFreeCount);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 1);
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $slotSettings->slotFreeCount);
                    }
                }
                $lastReel = [];
                $initLastReel = [];
                for($k = 0; $k < 3; $k++){
                    for($j = 1; $j <= 5; $j++){
                        $lastReel[($j - 1) + $k * 5] = $reels['reel'.$j][$k];
                        $initLastReel[($j - 1) + $k * 5] = $initReels['reel'.$j][$k];
                    }
                }

                $strLastReel = implode(',', $lastReel);
                $strInitReel = implode(',', $initLastReel);
                $strReelSa = $initReels['reel1'][3].','.$initReels['reel2'][3].','.$initReels['reel3'][3].','.$initReels['reel4'][3].','.$initReels['reel5'][3];
                $strReelSb = $initReels['reel1'][-1].','.$initReels['reel2'][-1].','.$initReels['reel3'][-1].','.$initReels['reel4'][-1].','.$initReels['reel5'][-1];
                $strFreeSpinResponse = '';
                $isEnd = false;
                if( $slotEvent['slotEvent'] == 'freespin' ) 
                {
                    $totalRespinMoney = $totalRespinMoney + $freemoneyTotalWin;
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalRespinMoney', $totalRespinMoney);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    $spinType = 's';
                    $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');                    
                    $strFreeSpinResponse = '&tw=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                    {
                        $isEnd = true;
                        if($_reelset == 2){
                            $spinType = 'c';
                            $strFreeSpinResponse =  $strFreeSpinResponse . '&fs_total='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&prg_m=cp,acw&fswin_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsmul_total=1&prg='. $totalRespinMoney . ',' . ($totalRespinMoney * $betline) .
                            '&mo_c=1&rs_t=1&rs_win='. $totalWin .'&fsres_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&n_reel_set=2';
                        }else{
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                            $strFreeSpinResponse = $strFreeSpinResponse . '&fs_total='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&prg_m=cp,acw&fswin_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsmul_total=1&prg='. $totalRespinMoney . ',' . ($totalRespinMoney * $betline) .
                                '&fsres_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&rs=t&rs_p=0&rs_c=1&rs_m=1&n_reel_set=1';
                        }
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                        $strFreeSpinResponse = $strFreeSpinResponse . '&prg_m=cp,acw&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&prg='. $totalRespinMoney . ',' . ($totalRespinMoney * $betline) .'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&n_reel_set=1';
                    }
                    if($scattersCount >=3 ){
                        $spinType = 's';
                        $strFreeSpinResponse = $strFreeSpinResponse . 'psym=1~'.$totalWin.'~'.implode(',', $_obf_scatterposes);
                    }
                }else
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalRespinMoney', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                    if($scattersCount >=3 ){
                        $spinType = 's';
                        $strFreeSpinResponse = '&tw=' . $totalWin.'&n_reel_set=1&prg_m=cp,acw&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&fswin=0.00&fs=1&fsres=0.00&psym=1~'.$totalWin.'~'.implode(',', $_obf_scatterposes);
                    }else{
                        $strFreeSpinResponse = '&tw=' . $totalWin.'&n_reel_set=0';
                    }
                }
                
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                $strMoneySymbolResponse = '';
                $strMoneyExpand = '';
                if($isMoney){                    
                    $CurrentMoneyText = [];
                    for($i = 0; $i < count($_moneyValue); $i++){
                        if($_moneyValue[$i] > 0){
                            $CurrentMoneyText[$i] = 'v';
                        }else{
                            $CurrentMoneyText[$i] = 'r';
                        }
                    }
                    if( $moneyCollectSymbol == 13) 
                    {
                        $CurrentMoneyText[$moneyCollectPos] = 'ea';
                        $_moneyValue[$moneyCollectPos] = $extraMoney;
                    }else if($moneyCollectSymbol == 14){
                        $CurrentMoneyText[$moneyCollectPos] = 'ma';
                        $_moneyValue[$moneyCollectPos] = $extraMoney;
                    }
                    $strMoneySymbolResponse = '&mo=' . implode(',', $_moneyValue) . '&mo_t=' . implode(',', $CurrentMoneyText);
                    if($moneyTotalWin > 0){
                        $strMoneySymbolResponse = $strMoneySymbolResponse . '&mo_tv=' . ($moneyTotalWin / $betline) . '&mo_c=1&mo_tw=' . $moneyTotalWin;
                    }
                    if($moneyCollectSymbol == 15){
                        $lastMoneyExpand = [];
                        $initMoneyExpand = [];
                        for($k = 0; $k < 15; $k++){
                            if($lastReel[$k] == 11){
                                array_push($lastMoneyExpand, $k);
                            }
                            if($initLastReel[$k] == 11){
                                array_push($initMoneyExpand, $k);
                            }
                        }
                        $strMoneyExpand = '&ep=11~'. implode(',', $initMoneyExpand) . '~' . implode(',', $lastMoneyExpand);
                    }
                }                
                $strRespinCollectSymbols = '';
                if($moneyCollectSymbol == 16){
                    $respinCollectSymbols = [];
                    for($k = 0; $k < count($lastReel); $k++){
                        if($lastReel[$k] != $initLastReel[$k] && $lastReel[$k] != 16){
                            array_push($respinCollectSymbols, $initLastReel[$k].'~'.$lastReel[$k].'~'.$k);
                        }
                    }
                    $strRespinCollectSymbols = '&srf=' . implode(';', $respinCollectSymbols);
                }
                $strMoneyCollect = '&msr=';
                if($moneyCollectSymbol == 0){
                    $moneyCollectSymbol = $slotSettings->GetMoneySymbol();
                }
                $strMoneyCollect = $strMoneyCollect . $moneyCollectSymbol;
                if($isEnd == true){
                    $strFreeSpinResponse = $strFreeSpinResponse.'&w='.$slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                }else{
                    $strFreeSpinResponse = $strFreeSpinResponse.'&w='.$totalWin;
                }
                $response = 'balance='.$Balance.$strMoneyCollect.$strMoneyExpand.$strRespinCollectSymbols.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinLine. $strFreeSpinResponse. 
                    $strMoneySymbolResponse.'&stime=' . floor(microtime(true) * 1000) .'&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=3&c='.$betline.'&sver=5&counter='. ((int)$slotEvent['counter'] + 1) .'&is='. $strInitReel .'&l=25&s='.$strLastReel;
                


                if($_reelset == 2) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalRespinMoney', 0);
                }
                
                // $slotSettings->SetGameData($slotSettings->slotId . 'JackpotWin', $lastEvent->serverResponse->JackpotWin);
                // $slotSettings->SetGameData($slotSettings->slotId . 'JackpotLevel', $lastEvent->serverResponse->JackpotLevel);
                // $slotSettings->SetGameData($slotSettings->slotId . 'JackpotReel', $lastEvent->serverResponse->JackpotReels);
                // $slotSettings->SetGameData($slotSettings->slotId . 'JackpotNumber', $lastEvent->serverResponse->JackpotNumbers);

                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . 
                    ',"Msr":' . $moneyCollectSymbol . ',"totalRespinMoney":' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalRespinMoney') . ',"MoneyValue":' . json_encode($_moneyValue) . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . 
                    ',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $_obf_totalWin, $slotEvent['slotEvent']);
                
                if( $scattersCount >= 3 && $slotEvent['slotEvent']!='freespin') 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $Balance);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                }
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
