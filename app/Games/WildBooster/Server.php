<?php 
namespace VanguardLTE\Games\WildBooster
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
                // if(isset($slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')) && isset($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames'))){
                    if($slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') <= $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0){
                        $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                    }
                // }
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
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeSpinType', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeOPT', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'WildStep', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalScatters', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'InitScatters', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BuyFreeSpin', -1); 
                $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 20);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [3,4,5,6,7,8,9,10,2,11,7,6,1,4,3]);
                if( $lastEvent != 'NULL' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeSpinType', $lastEvent->serverResponse->FreeSpinType);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeOPT', $lastEvent->serverResponse->FreeOPT);
                    $slotSettings->SetGameData($slotSettings->slotId . 'WildStep', $lastEvent->serverResponse->WildStep);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalScatters', $lastEvent->serverResponse->TotalScatters);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BuyFreeSpin', $lastEvent->serverResponse->BuyFreeSpin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'InitScatters', $lastEvent->serverResponse->InitScatters);
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
                $freeOPT = $slotSettings->GetGameData($slotSettings->slotId . 'FreeOPT');
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
                if($freeOPT > 0){
                    $spinType = 'fso';
                    $_obf_StrResponse = '&fs_opt_mask=fs,m,msk&accm=cp~tp~lvl~sc&acci=0&fs_opt=5,1,0~5,1,0&accv='.$freeOPT.'~5~1~'.$freeOPT;
                }
                else if($slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') <= $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0){
                    $strAccv = '&acci=0&accm=cp~tp~lvl~sc&accv='.($slotSettings->GetGameData($slotSettings->slotId . 'TotalScatters') % 5).'~5~'.(floor($slotSettings->GetGameData($slotSettings->slotId . 'TotalScatters') / 5) + 1).'~' .($slotSettings->GetGameData($slotSettings->slotId . 'TotalScatters') % 5);

                    $_obf_StrResponse = '&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .'&fsopt_i=' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') - 1) . $strAccv;
                    if($slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') == 1){
                        $currentReelSet = 6;
                    }else if($slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') == 2){
                        $currentReelSet = 5;
                    }

                    if($slotSettings->GetGameData($slotSettings->slotId . 'BuyFreeSpin') == 0){
                        $_obf_StrResponse = $_obf_StrResponse.'&puri=0&purtr=1';
                    }
                }
                
                $lastReelStr = implode(',', $slotSettings->GetGameData($slotSettings->slotId . 'LastReel'));
                $Balance = $slotSettings->GetBalance();
                $response = 'def_s=3,4,5,6,7,8,9,10,2,11,7,6,1,4,3&balance='. $Balance . $_obf_StrResponse .'&cfgs=1&ver=2&index=1&balance_cash='. $Balance .'&def_sb=1,2,3,4,5&reel_set_size=10&def_sa=1,2,3,4,5&reel_set='. $currentReelSet .'&balance_bonus=0.00&na='.$spinType.'&scatters=1~0,0,0,0,0~0,0,0,0,0~1,1,1,1,1&gmb=0,0,0&rt=d&gameInfo={rtps:{purchase:"96.47",regular:"96.47"},props:{max_rnd_sim:"1",max_rnd_hr:"836890",max_rnd_win:"5000"}}&wl_i=tbm~5000&stime=' . floor(microtime(true) * 1000) .'&sa=1,2,3,4,5&sb=1,2,3,4,5&sc='. implode(',', $slotSettings->Bet) .'&defc=0.10&sh=3&wilds=2~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;600,100,50,0,0;300,50,25,0,0;200,40,20,0,0;150,25,12,0,0;100,20,10,0,0;60,12,6,0,0;60,12,6,0,0;50,10,5,0,0;50,10,5,0,0&l=20&rtp=96.47&total_bet_max=7,500.00&reel_set0=5,8,10,7,11,6,9,11,4,5,5,3,10,10,9,6,4,6,8,9,10,1,11,9,10,8,8,7,7,9,8,3,11,3~7,5,4,1,10,2,7,10,4,8,6,11,9,7,10,3,8,11,9,5,4,9,10,11,9,11,3,4,9,5,6,8,11,11,6,2,8,4,11,8,10,1,5,7,6,9~10,7,9,4,3,11,3,6,2,11,7,5,9,10,1,9,4,7,2,5,11,11,8,10,3,2,10,6,9,9,8,1,5,5,9,10,2,10,11,4,4,7,8,9,5,8,8,4,8,7~10,3,8,2,2,9,10,3,5,4,1,8,9,4,6,9,3,9,11,7,10,4,6,11,5,11,8~9,10,6,9,11,9,4,7,9,4,8,6,4,1,10,7,5,6,3,3,8,11,5,9,8,11,10,3,8,10,5,3,8&s='.$lastReelStr.'&accInit=[{id:0,mask:"cp;tp;lvl;sc;cl"}]&reel_set2=5,10,9,3,7,4,11,8,7,10,8,6,8,4,10,8,7,3,6,9,6,8,9,5,5,4,9,10,10,8,4,3,4,9,7,11,10,10,9,11,5,11,3,9,11~6,7,9,4,3,2,8,8,9,7,9,5,8,2,11,11,7,10,9,6,6,5,11,10,11,4,11,3,4,11,9,2,10,3,5~9,2,9,11,8,2,10,10,2,11,8~10,7,6,3,5,3,10,11,4,3,9,3,3,9,6,9,10,9,8,11,8,3,11,5,2,5,11,2,8,6,9,5,4,8,7,10,11,9,7,9,5,4,11,8,8,4,10~8,5,10,8,9,9,4,8,9,11,9,3,10,4,11,7,8,5,11,6,7,3,9,4,11,10,6,3,5,6,6,4,10,3,9,8,5,5,10,7,8,7,10,11&reel_set1=10,9,7,7,8,10,11,8,4,5,11,11,9,4,3,8,6,10,10,3,8,10,7,11,8,5,3,5,10,9,4,4,5,9,6,6,3,9,4,9,11,8,7~11,2,2,11,11,8,10,2,9,8,10,9,2,10~7,11,9,9,8,10,9,4,11,5,9,5,4,10,4,3,9,9,10,11,3,6,6,5,8,6,7,4,8,8,3,6,7,7,5,4,8,5,10,10,8,5,10,2,3,2,2,11~4,10,3,10,4,7,9,11,9,3,11,10,8,7,4,5,8,9,5,8,6,2,9,3,5,11,3,8,6,2,11~11,8,10,5,5,3,10,9,5,8,7,5,4,6,9,11,4,6,10,8,5,9,8,3,9,8,11,10,3,9,10,11,4,6,8,11,7,7,9,6,3,7,4&reel_set4=9,8,8,11,5,11,6,10,3,11,1,3,5,10,4,7,9,9,4,8,4,10,7~8,9,11,7,10,2,6,11,5,10,10,11,3,11,5,3,2,7,9,9,2,8,11,6,9,8,2,6,11,4,6,3,5,10,4,2,8,11,5,1,9,9~1,2,2,3,4,4,5,5,6,7,8,8,9,9,10,10,11,11~7,1,6,7,10,1,3,9,11,5,2,3,11,3,9,5,8,9,8,11,11,2,8,9,4,2,10,8,4,6,10~10,8,9,8,1,3,4,7,10,10,7,9,9,10,6,10,11,9,6,5,8,4,3,9,4,8,6,3,5,5,7,11&purInit=[{type:"fs",bet:1500}]&reel_set3=10,6,8,5,7,9,11,3,6,3,9,10,4,10,4,11,7,8,9,8,5~10,4,3,8,6,2,11,5,3,6,7,11,9,4,7,10,8,5,11,2,9,9~2,8,7,6,5,9,4,9,8,10,3,2,11,8,9,10,10,11,3,6,6,2,10,7,4,11,5,5,3,5,8,9,4~9,11,9,2,8,2,10,11,10,8,2~7,8,3,9,6,9,8,3,4,9,11,11,5,11,6,4,8,7,6,3,11,7,9,5,8,5,8,4,10,8,8,7,3,8,9,10,7,10,4,8,10,3,6,5,9,10,9,4,11,10,7,5,10,11,11,9,4,6,3,10,9,5,6,5&reel_set6=8,10,8,10,9,5,11,4,3,7,7,3,11,11,8,6,5,9,9,7,10,6,11,10,10,9,8,4,3,9,4,5,4,1~10,11,8,9,10,5,10,9,2,2,11,9,6,3,9,3,6,11,7,8,9,11,5,4,8,11,2,6,5,11,7,5,4,1,2,8,11,10,9,2,6,4~4,2,3,4,9,9,8,4,9,3,5,2,5,8,7,7,6,10,11,2,1,6,10,5,8,8,9,10,11,10,11~9,3,3,4,10,8,2,11,7,11,2,9,8,9,1,6,5,10~9,11,7,9,3,5,7,10,8,10,8,9,6,11,6,10,3,5,8,4,8,5,6,11,9,1,3,4&reel_set5=6,11,8,5,3,8,6,4,9,10,5,8,5,8,10,8,9,5,8,11,4,9,9,10,10,3,10,1,9,3,10,9,4,9,7,6,7,4,3,11,7,10,11~1,9,11,5,9,7,5,4,2,2,3,6,11,2,8,11,10,7,11,10,8,5,5,3,2,4,3,9,3,4,10,6,8,9,10,8,11~9,7,5,1,4,8,11,10,6,4,10,8,3,1,8,2,3,4,5,10,11,8,7,9,11,9,7,3,9,5,6,5,9,2,10,11,10,5,2,6,2,8,4,11~1,2,2,3,3,4,5,6,7,8,8,9,9,10,10,11,11~1,3,3,4,5,6,7,8,8,9,9,10,11,11&reel_set8=5,4,11,8,10,5,6,7,1,7,4,10,9,10,8,7,9,9,3,3,8,10,9,5,5,8,11,11,7,9,10,9,10,9,10,4,3,4,4,8,11,11,8,6,3~9,2,11,5,6,1,10,11,3,11,2,5,6,8,4,2,7,4,9,11,10,9,8~10,11,11,7,3,5,11,9,10,4,9,4,11,5,9,5,1,7,5,4,8,10,10,9,9,6,2,8,3,1,10,4,8,5,8,6,2,3,7,6,2,8,2~2,3,8,11,9,5,5,6,10,8,3,9,7,4,11,1,2,4,10,11,6,8,9~1,10,8,11,9,4,4,3,10,8,9,3,8,10,6,7,3,6,11,6,8,10,3,6,7,10,5,1,5,7,9,8,9,3,8,11,5,9,5,9,8,9,3,11,5,4,7,6,11,10,4&reel_set7=9,7,8,4,11,5,3,1,9,8,3,6,10,10,4,9,8~8,4,2,8,11,6,9,3,9,9,11,4,10,2,2,3,5,9,4,10,6,9,11,11,9,10,6,7,8,5,3,1,5,2,8,7,11,6,11,2,10~2,11,8,9,5,10,11,11,7,2,9,10,3,4,1,6,8,2,8,9,6,10,9,3,5,4,6,7,5,4,5,3,10,5~1,2,2,3,3,4,5,6,7,8,8,9,9,10,10,11,11~9,4,7,11,5,5,8,11,7,4,5,6,11,9,7,9,8,8,5,6,10,10,6,4,8,1,9,10,11,3,9,8,4,6,1,10,7,8,8,11,3,3,9,10,3,10,8,6,8,5,10,9,3,3&reel_set9=8,9,5,10,9,10,8,4,11,1,6,10,4,11,7,5,3,9,3~9,9,10,8,9,8,10,11,5,9,2,4,11,6,1,3,2,6,11,11,5,2,7~4,6,6,10,2,10,9,9,5,9,3,11,3,2,11,7,7,2,5,9,4,8,2,1,6,4,11,1,10,10,8,4,3,5,4,3,2,10,8,8,9,5,10,11,11,6,7,9,9,5,8,8,6,11~4,2,7,2,10,6,9,3,8,11,1,5,11,6,5,8,3,10,9,11,9,10,2~3,7,8,4,5,8,9,1,5,5,8,7,11,11,9,10,9,3,6,6,10,7,8,8,3,11,9,9,8,3,6,10,6,9,1,11,4,8,5,10,11,4,10,9,9,10,5,10,11,4,3,10,4,7,6&total_bet_min=0.01';
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
                $slotEvent['slotBet'] = $slotEvent['c'];
                $slotEvent['slotLines'] = 20;
                $isBuyFreespin = -1;
                if(isset($slotEvent['pur'])){
                    $isBuyFreespin = $slotEvent['pur'];
                }
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
                if($isBuyFreespin == 0){
                    $allBet = $betline * $lines * 75;
                }else{
                    $allBet = $betline * $lines;
                }
                $_spinSettings = $slotSettings->GetSpinSettings($slotEvent['slotEvent'], $allBet, $lines);
                $winType = $_spinSettings[0];
                $_winAvaliableMoney = $_spinSettings[1];
                if($slotEvent['slotEvent'] == 'freespin'){
                    $wildMuls = $slotSettings->GetWildMul($slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') - 1);
                    // $currentStep = floor($slotSettings->GetGameData($slotSettings->slotId . 'TotalScatters') / $slotSettings->GetGameData($slotSettings->slotId . 'InitScatters'));
                    $bonusMpl = $wildMuls[floor($slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') / 5)];
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                }
                else
                {
                    $slotEvent['slotEvent'] = 'bet';                    
                    $slotSettings->SetBalance(-1 * ($allBet), $slotEvent['slotEvent']);
                    $_sum = ($allBet) / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), $_sum, $slotEvent['slotEvent']);
                    $bonusMpl = 1;
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeSpinType', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeOPT', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'WildStep', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalScatters', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'InitScatters', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BuyFreeSpin', $isBuyFreespin); 
                    if($isBuyFreespin == 0){
                        $winType = 'bonus';
                        $_winAvaliableMoney = $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''));
                    }
                }
                $Balance = $slotSettings->GetBalance();
                if( $slotEvent['slotEvent'] != 'bet' ) 
                {
                    $slotSettings->UpdateJackpots($allBet);
                }
                $currentReelSet = 0;
                if($slotEvent['slotEvent'] == 'freespin'){
                    if($slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') == 1){
                        $currentReelSet = 6;
                    }else if($slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') == 2){
                        $currentReelSet = 5;
                    }
                }
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $totalWin = 0;
                    $lineWins = [];
                    $lineWinNum = [];
                    $wild = '2';
                    $scatter = '1';
                    $_obf_winCount = 0;
                    $strWinLine = '';
                    $reels = $slotSettings->GetReelStrips($winType, $slotEvent['slotEvent'], $currentReelSet);
                    $_lineWinNumber = 1;
                    $winLineNumbers = [];
                    for( $k = 0; $k < $lines; $k++ ) 
                    {
                        $_lineWin = '';
                        $firstEle = $reels['reel1'][$linesId[$k][0] - 1];
                        $lineWinNum[$k] = 1;
                        $lineWins[$k] = 0;
                        $isWild = false;
                        for($j = 1; $j < 5; $j++){
                            $ele = $reels['reel'. ($j + 1)][$linesId[$k][$j] - 1];
                            if($firstEle == $wild){
                                $firstEle = $ele;
                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                $isWild = true;
                            }else if($ele == $firstEle || $ele == $wild){
                                if($ele == $wild){
                                    $isWild = true;
                                }
                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                if($j == 4){
                                    $lineWins[$k] = $slotSettings->Paytable[$firstEle][$lineWinNum[$k]] * $betline;
                                    if($lineWins[$k] > 0){
                                        if($isWild == true){
                                            $lineWins[$k] = $lineWins[$k] * $bonusMpl;
                                            array_push($winLineNumbers, $k . '~' . $bonusMpl);
                                        }
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
                                        if($isWild == true){
                                            $lineWins[$k] = $lineWins[$k] * $bonusMpl;
                                            array_push($winLineNumbers, $k . '~' . $bonusMpl);
                                        }
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
                    $totalScatters = $slotSettings->GetGameData($slotSettings->slotId . 'TotalScatters') + $scattersCount;
                    $freeSpinNums = 0;                    
                    $currentWildStep = floor($totalScatters / 5);
                    // if($slotEvent['slotEvent'] == 'freespin' && $scattersCount > 0 && ($totalScatters % $slotSettings->GetGameData($slotSettings->slotId . 'InitScatters') == 0)){
                    if($slotEvent['slotEvent'] == 'freespin' && $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') - 1 == $currentWildStep * 5 ){
                        $freeSpinNums = 5;
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
                            $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                            exit( $response );
                        }
                        if( $scattersCount == 5 || ($scattersCount >= 3 && $winType != 'bonus')) 
                        {
                        }
                        else if($totalScatters >= 15 && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') >= 15){

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
                if($freeSpinNums > 0 && $slotEvent['slotEvent'] == 'freespin') 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $freeSpinNums);
                    
                }
                
                for($k = 0; $k < 3; $k++){
                    for($j = 1; $j <= 5; $j++){
                        $lastReel[($j - 1) + $k * 5] = $reels['reel'.$j][$k];
                    }
                }
                $strLastReel = implode(',', $lastReel);
                $strReelSa = $reels['reel1'][3].','.$reels['reel2'][3].','.$reels['reel3'][3].','.$reels['reel4'][3].','.$reels['reel5'][3];
                $strReelSb = $reels['reel1'][-1].','.$reels['reel2'][-1].','.$reels['reel3'][-1].','.$reels['reel4'][-1].','.$reels['reel5'][-1];                
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                if( $slotEvent['slotEvent'] == 'freespin' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    if($slotSettings->GetGameData($slotSettings->slotId . 'WildStep') - 1 < $currentWildStep){
                        $strAccv = '&accm=cp~tp~lvl~sc~cl&accv='.($totalScatters % 5).'~5~'.($currentWildStep + 1).'~' . $scattersCount.'~'.$slotSettings->GetGameData($slotSettings->slotId . 'WildStep');
                    }else{
                        $strAccv = '&accm=cp~tp~lvl~sc&accv='.($totalScatters % 5).'~5~'.$slotSettings->GetGameData($slotSettings->slotId . 'WildStep').'~' . $scattersCount;
                    }
                    if($totalWin > 0){
                        $strAccv = $strAccv . '&lm_v='. implode(';', $winLineNumbers) .'&lm_m=l~m';
                    }
                    if($freeSpinNums > 0){
                        $strAccv = $strAccv . '&fsmore=5';
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalScatters', $totalScatters);
                    $slotSettings->SetGameData($slotSettings->slotId . 'WildStep', $currentWildStep + 1);

                    $spinType = 's';
                    $isEnd = false;
                    $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                    {
                        $isEnd = true;
                        $spinType = 'c&fs_total='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fswin_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsend_total=1&fsmul_total=1&fsres_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                    }
                    else
                    {
                        $spinType = 's&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                    }
                    if($slotSettings->GetGameData($slotSettings->slotId . 'BuyFreeSpin') == 0){
                        $spinType = $spinType.'&puri=0';
                    }
                    $response = 'tw='. $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .'&ls=0&balance='.$Balance.'&acci=0&index='. $slotEvent['index'] . $strAccv . '&reel_set='. $currentReelSet .'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinLine .'&stime=' . floor(microtime(true) * 1000).'&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=3'.'&c='.$betline.'&sver=5&counter='. ((int)$slotEvent['counter'] + 1) .'&l=20&s='.$strLastReel.'&fsopt_i=' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') - 1).'&w='.$totalWin;
                }else
                {
                    // $_obf_0D5C3B1F210914123C222630290E271410213E320B0A11 = $totalWin;
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                    $otherResponse = '';
                    if($scattersCount >=3 ){
                        $spinType = 'fso';
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeOPT', $scattersCount);
                        $otherResponse = '&fs_opt_mask=fs,m,msk&accm=cp~tp~lvl~sc&acci=0&fs_opt=5,1,0~5,1,0&accv='.$scattersCount.'~5~1~'.$scattersCount; //'&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&fswin=0.00&fs=1&fsres=0.00&psym=1~'.$totalWin.'~'.implode(',', $_obf_scatterposes);
                        $slotSettings->SetGameData($slotSettings->slotId . 'InitScatters', $scattersCount);
                        if($isBuyFreespin == 0){
                            $otherResponse = $otherResponse . '&puri=0&purtr=1';
                        }
                    }
                    $response = 'tw='.$totalWin.'&ls=0&balance='.$Balance.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&reel_set='. $currentReelSet .'&balance_bonus=0.00&na='.$spinType.$strWinLine.'&stime=' . floor(microtime(true) * 1000) .'&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=3&c='.$betline.'&sver=5'.$otherResponse.'&counter='. ((int)$slotEvent['counter'] + 1) .'&l=20&s='.$strLastReel.'&w='.$totalWin;
                }


                if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0)) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                }
                

                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"FreeSpinType":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') . ',"FreeOPT":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeOPT') . ',"WildStep":' . $slotSettings->GetGameData($slotSettings->slotId . 'WildStep')  . ',"TotalScatters":' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalScatters')  . ',"BuyFreeSpin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BuyFreeSpin')  . ',"InitScatters":' . $slotSettings->GetGameData($slotSettings->slotId . 'InitScatters')  . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . 
                    ',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $allBet, $lines, $_obf_totalWin, $slotEvent['slotEvent']);
                
                if( $scattersCount >= 3 ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $Balance);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                }
            }
            else if( $slotEvent['slotEvent'] == 'doFSOption' ){
                $scattersCount = $slotSettings->GetGameData($slotSettings->slotId . 'FreeOPT');
                $lastEvent = $slotSettings->GetHistory();
                $betline = $lastEvent->serverResponse->bet;
                $lines = 20;
                $Balance = $slotSettings->GetBalance();
                $ind = $slotEvent['ind'];
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeSpinType', $ind + 1);
                if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') == 0 ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 1);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 5);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 1);
                }
                $response = 'fsmul=1&fs_opt_mask=fs,m,msk&balance='.$Balance.'&fsmax='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na=s&fswin=0.00&stime=' . floor(microtime(true) * 1000) . '&fs=1&fs_opt=5,1,0~5,1,0&fsres=0.00&sver=5&counter='. ((int)$slotEvent['counter'] + 1) .'&fsopt_i=' . $ind;
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeOPT', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalScatters', $scattersCount);
                $slotSettings->SetGameData($slotSettings->slotId . 'WildStep', 1);
                $totalWin = 0;
                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"FreeSpinType":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') . ',"FreeOPT":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeOPT') . ',"WildStep":' . $slotSettings->GetGameData($slotSettings->slotId . 'WildStep')  . ',"TotalScatters":' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalScatters') . ',"BuyFreeSpin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BuyFreeSpin') . ',"InitScatters":' . $slotSettings->GetGameData($slotSettings->slotId . 'InitScatters') . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . ',"LastReel":'.json_encode($slotSettings->GetGameData($slotSettings->slotId . 'LastReel')).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, 0, $slotEvent['slotEvent']);
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
