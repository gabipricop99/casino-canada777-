<?php 
namespace VanguardLTE\Games\TheHandOfMidas
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
            $pur_value = -1;
            if( isset($slotEvent['pur'])) 
            {
                $isFreeSpin = true;
                $pur_value = $slotEvent['pur'];
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
                $slotSettings->SetGameData($slotSettings->slotId . 'WildValues', []);
                $slotSettings->SetGameData($slotSettings->slotId . 'WildPos', []);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'InitScatterReels', [0,0,0,0,0]);
                $slotSettings->SetGameData($slotSettings->slotId . 'LimitWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 20);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [4,11,6,6,5,13,10,9,13,7,10,9,3,4,11]);
                $slotSettings->SetGameData($slotSettings->slotId . 'IsMiniFreeSpin', 0);
                if( $lastEvent != 'NULL' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'WildValues', $lastEvent->serverResponse->wildValues);
                    $slotSettings->SetGameData($slotSettings->slotId . 'WildPos', $lastEvent->serverResponse->wildPos);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->lines);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', $lastEvent->serverResponse->BonusMpl);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastEvent->serverResponse->LastReel);
                    $slotSettings->SetGameData($slotSettings->slotId . 'InitScatterReels', $lastEvent->serverResponse->InitScatterReels);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LimitWin', $lastEvent->serverResponse->LimitWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'IsMiniFreeSpin', $lastEvent->serverResponse->IsMiniFreeSpin);
                    $otherResponse = $lastEvent->serverResponse->OtherResponse;
                    $initReel = $lastEvent->serverResponse->InitReel;
                    $bet = $lastEvent->serverResponse->bet;
                }
                else
                {
                    $bet = $slotSettings->Bet[0];
                    $otherResponse = '&s=' . implode(',', $slotSettings->GetGameData($slotSettings->slotId . 'LastReel'));
                    $initReel = [4,11,6,6,5,13,10,9,13,7,10,9,3,4,11];
                }
                $currentReelSet = 0;
                $spinType = 's';
                $wildValues = $slotSettings->GetGameData($slotSettings->slotId . 'WildValues');
                $wildPos = $slotSettings->GetGameData($slotSettings->slotId . 'WildPos');
                // $lastReelStr = implode(',', $slotSettings->GetGameData($slotSettings->slotId . 'LastReel'));
                $strWildResponse = '';
                $wildCount = count($wildPos);
                $totalWildValue = 0;
                if($wildCount > 0){
                    $arr_wild = [];
                    for($k = 0; $k < $wildCount; $k++){
                        array_push($arr_wild, '2~'.$wildPos[$k].'~'.$wildValues[$k]);
                        $totalWildValue = $totalWildValue + $wildValues[$k];
                    }
                    $strWildResponse = '&rmul='. implode(';', $arr_wild) . '&gwm=' . ($totalWildValue + 1);
                }
                $strWildResponse = $strWildResponse . '&wmv=' . ($totalWildValue + 1) . '&wmt=pr';
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
                if($slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') > 1 && $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                {
                    $strSty = '';
                    for($r = 0; $r < count($wildPos); $r++){
                        if($r == 0){
                            $strSty = $wildPos[$r].','.$wildPos[$r];
                        }else{
                            $strSty = $strSty . '~' . $wildPos[$r].','.$wildPos[$r];
                        }
                    }
                    

                    $_obf_StrResponse = '&fs=' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&sty='.$strSty.'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .  '&fsres=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&tw=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&w=0.00&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . $strWildResponse;
                    if($wildCount > 0){
                        $_obf_StrResponse = $_obf_StrResponse . '$is='. implode(',', $initReel);
                    }
                    $currentReelSet = 1;
                }else{
                    $_obf_StrResponse = $strWildResponse;
                }
                $Balance = $slotSettings->GetBalance();
                // $response = 'def_s=11,5,7,7,5,1,6,9,9,6,12,11,9,9,11,12,11,5,5,11&apvi=10&balance='. $Balance .'&cfgs=1&ver=2&index=1&balance_cash='. $Balance .'&reel_set_size=2&def_sb=8,2,6,6,1&def_sa=11,9,5,3,9&reel_set='.$currentReelSet.$_obf_StrResponse.'&balance_bonus=0.00&na='. $spinType.'&scatters=1~0,0,0,0,0~0,0,8,0,0~1,1,1,1,1;14~0,0,0,0,0~0,0,8,0,0~1,1,1,1,1&cls_s=-1&gmb=0,0,0&mbri=1,2,3&rt=d&gameInfo={props:{max_rnd_sim:"1",max_rnd_hr:"106382978",max_rnd_win:"4500"}}&wl_i=tbm~10000&apti=bet_mul&stime=' . floor(microtime(true) * 1000) .'&sa=11,9,5,3,9&sb=8,2,6,6,1&sc='. implode(',', $slotSettings->Bet) .'&defc=0.10&sh=4&wilds=2~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;400,100,30,0,0;250,75,25,0,0;150,40,15,0,0;100,25,10,0,0;75,15,7,0,0;50,10,5,0,0;30,6,3,0,0;30,6,3,0,0;20,5,2,0,0;20,5,2,0,0;20,5,2,0,0;0,0,0,0,0&l=40&rtp=96.51&total_bet_max=10,000.00&reel_set0=7,11,11,1,12,12,6,8,4,10,10,5,11,11,9,9,3,13,13,5,8,12,12,1,13,13,6,10,10~7,11,11,2,12,12,6,8,4,9,9,5,13,13,3,11,11,5,8,12,12,2,13,13,6,10,10~9,7,11,11,2,13,13,6,8,4,9,9,5,10,10,1,6,8,3,11,11,5,8,12,12,2,13,13,6~7,10,10,2,12,12,6,8,11,11,4,9,9,5,6,7,3,11,11,5,6,12,12,7,13,13,6~7,10,10,1,12,12,6,8,4,9,9,5,6,7,3,11,11,5,6,13,13,7,13,13,6,10,10&s='.$lastReelStr.'&reel_set1=10,5,9,9,7,10,10,8,12,12,6,13,13,8,9,9,4,9,9,5,6,8,3,3,3,3,11,11~7,10,10,2,12,12,6,8,4,9,9,5,6,3,11,11,5,6,12,12,7,13,13,2,10,10,7,4~7,10,10,2,12,12,6,8,4,9,9,5,6,3,11,11,5,6,12,12,8,13,13,2,10,10,7,4~7,10,10,2,12,12,6,8,4,9,9,5,6,7,3,11,11,5,6,12,12,7,13,13,6,10,10,7~10,10,6,12,12,8,4,9,9,5,6,7,3,3,3,3,11,11,6,12,12,7,13,13,6,10,10,7&purInit=[{type:"fs",bet:2000,fs_count:8}]&mbr=1,1,1&total_bet_min=0.20';
                $response = 'def_s=4,11,6,6,5,13,10,9,13,7,10,9,3,4,11&balance='. $Balance .'&cfgs=4488&ver=2&index=1&balance_cash='. $Balance .'&def_sb=5,1,12,13,6&prm=2~1,2,3;2~1,2,3&reel_set_size=10&def_sa=6,2,5,3,13&reel_set='.$currentReelSet.$_obf_StrResponse.'&balance_bonus=0.00&na='. $spinType.'&scatters=1~0,0,0,0,0~0,0,0,0,0~1,1,1,1,1&gmb=0,0,0&rt=d&gameInfo={rtps:{ante:"94.51",purchase:"94.51",regular:"94.51"},props:{max_rnd_sim:"1",max_rnd_hr:"1026437",max_rnd_win:"5000",max_rnd_win_a:"4000"}}&wl_i=tbm~5000;tbm_a~4000&bl=0&stime=1617604765576&sa=6,2,5,3,13&sb=5,1,12,13,6&sc='. implode(',', $slotSettings->Bet) .'&defc=100.00&sh=3&wilds=2~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&bls=20,25&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;400,120,40,0,0;300,90,30,0,0;250,70,25,0,0;200,50,20,0,0;150,35,15,0,0;100,20,10,0,0;50,10,5,0,0;50,10,5,0,0;25,5,2,0,0;25,5,2,0,0;25,5,2,0,0&l=20&rtp=94.51&total_bet_max=30,000,000.00&reel_set0=10,11,4,6,8,9,3,1,7,13,5,12,1,8,1,8,1,3,1,8,13,3,8,3,8,3,8,11,1,11,5,8,7,3,1,8,12,5,8,11,8,4,1,6,8,1,8,7,3,6,8,4,1,5,3,8,3,7,8,11,6,3,1,8,6,3,8,1,3,1,8,4,8,6,8,12,5,6,4~12,1,13,7,11,8,2,5,10,3,6,4,9,5,3,4,3,13,9,2,7,4,2,7,3,1,9,7,1,7,1,8,3,10,3,13,7,8,9,7,2,7,1,7,9,3,8,2,9,3,7,2,3,13,2,3,1,10~3,8,4,1,5,11,10,2,13,6,7,9,12,8,11,8,6,9,8,7,13,8,5,12,10,8,6,8,12,11,12,9,5,12,8,10,11,8,5,9,6,11,8,11,8,1,8,11,12,9,8,12,10,2,12,8,2,9,8,12,9,8,7,5,11,12~7,3,4,2,8,5,13,10,12,6,11,1,9,3,12,10,11,6,1,6,1,10,6,1,4,11,10,6,1,6,1,12,3,10,1,4,6,11,8,6,4,12,11,9,10,1,13,6,10,4,3,10~7,13,9,12,8,1,6,5,3,11,4,10,11,1,6,13,5,13,5,8,12,1,13,11,3,6,13,1,6,1,6,12,3,1,11,6,11,3,12,1,13,8,12,1,11,1,11,1,11,1,3,5'.$otherResponse.'&reel_set2=12,8,11,5,7,6,3,13,1,9,10,4,8,5,10,9,8,1,6,5~12,7,13,2,8,6,11,5,3,10,9,4,10,7,5,7,6,3,13,8,6,10,2,5,2,8,2,5,10,2,4,2,6,10,8,5,8,13,5,6,8,2,7,3,5,3,2,5,2,6,2,10,5,2,8,5,2,5,2~10,6,3,8,11,5,9,2,12,13,1,4,7,2,11,3,1,12,2,5,8,6,1,9,11,1,3,9,6,2,1,9,2,6,3,13~6,7,9,2,3,5,4,13,12,10,11,8,10,9,11,9,13,9,7,13,10,13,7,5,9,13,7,11,7,10,7,9,13,9,10,9,13~3,13,6,1,12,8,7,5,10,4,11,9,4,9,6,8,7,8,12,5,8,6,4,6,9,7,4,13,12,7,9,6,7,13&reel_set1=4,4,4,5,6,8,3,3,3,3,5,5,5,9,10,4,12,13,7,11,8,11,3,12,8,12,13,3,12,8,3,8,11,3,12,3,12,5,8,11,5,7,12,5,8,5,13,8,13,9,13,3,13,12,8,13,5,13,12,3,6,12,7,13,5,6,3,11,12,3,10,13,8,13,8,3,8,12,8,12,8,12,8,11,8,12,8,11,3,12,11,9,3,10,12,7,11~12,7,9,2,10,5,6,8,13,3,4,11,7,5,13,3,5,13,6,3,10,5,4,10,5,4,13,5,9,13,10,5,3,5,4,10,13,3,10,13,7,10,3,4,3,11,13,3,4,8,3,13,11,3,13,5,13,4,3,7,4,13,3,11,13,5,13,4,6,13,8,13,10,5,13~5,12,4,9,11,3,10,2,6,7,13,8,10,2,13,2,8,12,4,13,6,12,6,11,6,10,11,13,2,10,3,6,11,9,3,11,10,9,12,7,6,2,13,10,11,2,11,13,2,8,12,10,7,3,2,11,12,11,10,9,10~12,2,8,9,4,13,10,5,6,3,7,11,9,13,8,5,11,10,11,10,8,9,3,13,2,13,2,13,3,8,9,10,8,3,5,9,8,7,3,9,13,7,3,7,3,6,13~12,3,3,3,7,9,6,3,10,5,8,11,4,13,4,4,4,5,5,5,3,6,3,9,4,3,4,10,5,7,5,9,3,5,9,4,3,4,3,5,9,4,11,9,4,13,4,11,4,5,4,9,6,3,9,3,9,4,3,5,3,5,3,10,3,4,6,11,6,5,4,3,13,3,11,5,4,5,9,3,4,5,9,5,3,11,5,6,4,6,5,3,10,4,9,10,9,4,5,9,4,7,5,3,4,3,4,6&reel_set4=12,7,9,13,4,11,1,3,5,6,8,10,13,10,6,13,11,7,6,5,10,13,8,4,10,6,13,11,13,6,7~6,7,3,1,12,13,4,10,5,9,8,2,11,1,8,7,4,12,4,2,12,4,5,2,13,4,8,2,12,7,8,9,12,11,4,12,4,8,12,9,8,9,11,12,3,1,12,13,1,11~13,7,2,9,12,11,6,3,4,10,8,5,3,12,11,3,4,7,4,3,11~4,1,6,2,5,7,8,9,11,13,12,3,10,8,2~11,13,5,7,10,3,12,4,9,8,1,6,12,9,10,9,10,9,13,3,9,4,13,10,9,10,13,10,3,13,8,13,9,3,9,13&purInit=[{type:"fsbl",bet:2000,bet_level:0},{type:"fsbl",bet:4000,bet_level:0},{type:"fsbl",bet:6000,bet_level:0}]&reel_set3=5,3,3,3,7,4,4,4,12,6,5,5,5,13,10,4,11,9,3,8,3,10,3,8,13,3,8,11,3,12,3,8,7,8,13,3,8,3,11,4,11,4,10,8,7,4,3,7,11,8,3,10,8,11,4,10,4,8,4,11,8~13,2,12,8,10,6,3,7,11,9,5,4,8,9,2,5,9,5,8,12,5,2,6,9,5,8,2,5,7,5,12,8,7,10,8,9,5,2,5,10~9,5,4,6,10,3,12,13,2,8,11,7,5,7,2,4,7,2~7,8,11,4,10,5,12,2,6,3,13,9,3,5,4,8,4,5,3,9,4,12,6,5,12,4,9,3,4,9,3,5,9,3,5~12,11,3,3,3,9,4,8,3,5,5,5,5,6,13,4,4,4,7,10,4,3,4,5,4,3,4,6,13,3,5,3,5,3,4,8,5,6,4,3,5,4,13,4,5,4,3,13,3,5,4,3,4,6,4,5,3,5,4,9,5,8,3,5,6,5,7,5,7,4,3,7,5,8,4,10,8,5,3,7,13,5,6,4,5,8,5,7,5,3,5,3,8,7,5,3,11,3,4,13,11,4,3,5,7,5,8,4,13&reel_set6=5,7,4,6,3,13,8,10,1,12,9,11,3,4,13,9,8,13,4,3,8,6,12,6,9,12,4,7~4,1,13,11,5,6,7,9,8,12,10,3,5,3,9,3,6,7,9,3,5,7~1,10,6,7,8,12,3,11,9,5,4,13,6,11,3,4,11,5,3,9,3,4,12,3,8,6,3,4,5,3,4,3,5,6,8,5,4,5,6,5,6,11~3,13,9,11,12,6,5,4,7,10,1,8,7,9,13,8,4,8,10,8,9,8,13,8,4,9,6,7,4,9,13,7,5,13,1,6,8,5,6,9~10,11,9,6,1,13,5,4,3,12,7,8,13,6,1,5,1,7,1,6,3,1,6,9,1,13,1,3,7,13,9,13,6,1,13,8,12,3,5,11&reel_set5=3,3,3,6,3,12,7,11,5,5,5,10,4,4,4,4,13,9,5,8,9,12,5,13,5,12,4,5,12,4,5,4,5,7,4,5,13,5,11,8,4,13,5,13,5,7,5,12,5,4,12,13,4,5,4,5,4,5,7,13,8,12,11,5,7,11,7,13,4,9,5,11,5,4,12~13,11,12,5,3,2,10,7,8,9,6,4,3,11,5,10,11,5,12,5,12,6,12,2,6,11,12,2,6,5,12,5,6,10,12,5,4,5,2,5,3,6,2,5,2,11,4,5,2,5,3,2,5,12,5,6,9,5,7~2,11,7,6,13,8,9,3,10,5,12,4,5,6,11,8,4,3,8,5,3,10,13,6,3,5,12,3,13,6~11,6,4,3,12,13,2,9,8,7,10,5,8,7,5,2,10,2,6,2,9,5,9,4,6,3,9,2,9,10,8,7,5,4,9,2,9,6,9,10,6,9,2,3,5,2,6,9,6,2,9,2,4,9,6,4,9,6,9~4,4,4,8,5,5,5,13,3,3,3,12,7,3,4,10,11,9,6,5,10,9,6,3,5,9,7,3,7,10,9,3,5,7,3,10,6,10,3,9,8,5,3,5,3,9,6,5,6,7,3,8,5,3,7,6,9,7,3,6,11,5,9,7,9,6,7,3,5,9,5,3,9,5,8,10,9,3,6,5,9,5,10,3,5,9,3,7,10,3&reel_set8=7,4,11,6,10,9,5,8,13,12,3,1,13,8,3,6,11,5,1,5,12,13,3,13,5,9,10,13,3,13,10,13,9,5,9,3,9,11,8,9,5,9,11,4,11,5,13,9,5,9,4,11,13,11,9,8,13,12,4,11~13,2,12,7,9,8,10,6,11,4,5,1,3,4,12,7,4,8,4,7,2,9,2,9,4,10,3,7,9,10,8,2,12,2,7,9,5,4,11,2,7,4,9,7,5,12,2,9,2,4,12,2,4,12,9,4,2,5,2,4,5,2,1,4,9,12,1,7,4,7~6,12,3,1,9,7,8,5,10,4,2,11,13,11,4,12,2,3,11,5,1,12,2,4,13,5,3,2,11,2,4,11,12,9,1,2,4,11,4,5,13,2,7,11,4,3,1,2,9,7,4,7,11,2,3,12,7,11,3,9,2,7,2,1,12,2~4,10,6,8,1,7,3,9,5,12,2,11,13,10,8,12,2,6,10,12,8,6,13,10,12,13,12,2,8,12,3,12,10,2,3,12,2,9,10,13,5,10,13,2,10,12,10,12,9,12,13,6,10,5,9,13,5,13,12,2,10,2,12,2,3,8,2,10,2,5,13,8,13,5,2,10,2,10,12~12,7,4,1,9,10,8,6,5,3,13,11,1,5,13,5,4,7,8,13,10,11,5,13,5,11,10,9,10,6&reel_set7=5,5,5,10,5,11,3,3,3,6,4,4,4,8,9,13,4,12,3,7,9,3,4,3,10,3,7,3,9,13,9,3,9,13,9,7,9,3,4,8,4,3,4,9,4,3,6,9,13,3,9,10,4,3,10,3,9,4,7,10,3,4,9,10,4,12,6,9,4,10,3,11,7,4~3,9,13,11,5,4,8,6,7,10,2,12,7,8,12,5,11,10,11,8,7,8,13,11,13,11,5,8,5,9,8,10,8,5~5,4,10,6,12,7,8,2,13,11,9,7,9,7,13,9,7,13,8,13,8,7,10,13,7,13,7,13,9,13,8,11,7,13,7,2,13,10,7,10~7,12,6,11,4,2,8,5,3,10,9,13,9,6,5,4,10,6,4,6,9,8,9,4,6,4,9,11,4,6,10,6,4,10,4,6,10,11,9,10,3,11,10,4,6,5,9,6,11,9,2,9,4,11,6,9,10,6,5,11~3,3,3,3,6,5,5,5,11,4,4,4,10,7,8,12,5,9,13,4,5,7,5,4,5,8,5,6,12,4,5,12,9,5,4,5,12,9,5,6,5,4&reel_set9=4,4,4,11,6,12,3,3,3,3,5,5,5,5,8,13,9,10,7,4,12,9,8,5,9,8,5,7,12,8,7,9,7,9,6,5,12,6,9,8,10,9,7,5,3,6,9,13,9,6,5,9,3,5,7,3,12,7,3,5,9,6,5,13,9,12,6,9,8,3,5,9,5,13,11,8,9,3,6,7,9,7,5,6,3,9,5,6,3,12,7,9,6,9,5,8,13,7,5,12,9~7,3,4,10,11,13,2,5,8,12,9,6,5,8,10,8,2,9,8,10,5,10,8,3,2,13,3,2,3,9,2,8,9,5,2,5,8,9,12,2,9,2,3,13,9,8,12,11,3,12,13,8,9,5,3,12,3,9,5,9,8,2,10,11,5,11,5~7,13,11,12,8,6,5,9,3,10,2,4,2,6,4,5,2,8,6,9,6,4,3,12,6,10,6,11,8,5,4,11,9,10,6,10,9,12,2,6,9,6,10,12,13,6,3,13,8,6,10,2,6,5,6,4,6,13,12,2~13,10,3,11,6,4,12,8,7,2,9,5,7,2,7,2,7~13,3,3,3,11,10,5,5,5,3,4,4,4,6,7,9,4,5,12,8,10,11,5,12,5,10,12,3,11,5,3,4,6,11,5&total_bet_min=0.1';
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
                $linesId[0] = [2,2,2,2,2];
                $linesId[1] = [1,1,1,1,1];
                $linesId[2] = [3,3,3,3,3];
                $linesId[3] = [1,2,3,2,1];
                $linesId[4] = [3,2,1,2,3];
                $linesId[5] = [2,1,1,1,2];
                $linesId[6] = [2,3,3,3,2];
                $linesId[7] = [1,1,2,3,3];
                $linesId[8] = [3,3,2,1,1];
                $linesId[9] = [2,3,2,1,2];
                $linesId[10] = [2,1,2,3,2];
                $linesId[11] = [1,2,2,2,1];
                $linesId[12] = [3,2,2,2,3];
                $linesId[13] = [2,2,1,2,2];
                $linesId[14] = [2,2,3,2,2];
                $linesId[15] = [1,3,1,3,1];
                $linesId[16] = [3,1,3,1,3];
                $linesId[17] = [1,1,3,1,1];
                $linesId[18] = [3,3,1,3,3];
                $linesId[19] = [1,3,3,3,1];
                $slotEvent['slotBet'] = $slotEvent['c'];
                $bl_value = $slotEvent['bl'];
                if($bl_value == 1){
                    $slotEvent['slotLines'] = 25;
                }else{
                    $slotEvent['slotLines'] = 20;
                }
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') <= $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                {
                    $slotEvent['slotEvent'] = 'freespin';
                }
                $lines = $slotEvent['slotLines'];
                $betline = $slotEvent['slotBet'];
                $isWelcomeFreespin = $slotSettings->GetGameData($slotSettings->slotId . 'IsWelcomeBonus');
                $allbet = $lines * $betline;
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
                        if( $slotEvent['slotEvent'] == 'doSpin' && $slotSettings->GetBalance() < ($allbet) )
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
                $_spinSettings = $slotSettings->GetSpinSettings($slotEvent['slotEvent'], $betline * $lines, $lines, $bl_value);
                $winType = $_spinSettings[0];
                $_winAvaliableMoney = $_spinSettings[1];
                $beforeWildCount = 0;
                if($slotEvent['slotEvent'] == 'freespin'){
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                    $_wildValue = $slotSettings->GetGameData($slotSettings->slotId . 'WildValues');
                    $_wildPos = $slotSettings->GetGameData($slotSettings->slotId . 'WildPos');
                    $beforeWildCount = count($_wildPos);
                    $leftFreeGames = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');    
                }
                else
                {
                    $slotEvent['slotEvent'] = 'bet';
                    if($isFreeSpin == true){
                        $buyFreeMuls = [2000, 4000, 6000];
                        $slotSettings->SetBalance(-1 * ($betline * $buyFreeMuls[$pur_value]), $slotEvent['slotEvent']);
                        $winType = 'bonus';
                        $_winAvaliableMoney = $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''));
                        $_sum = ($betline * $buyFreeMuls[$pur_value]) / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), $_sum, $slotEvent['slotEvent'], true);
                    }else{
                        $slotSettings->SetBalance(-1 * ($betline * $lines), $slotEvent['slotEvent']);
                        $_sum = ($betline * $lines) / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), $_sum, $slotEvent['slotEvent']);
                    }
                    
                    $bonusMpl = 1;
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'InitScatterReels', [0,0,0,0,0]);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LimitWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'IsMiniFreeSpin', 0);
                    $leftFreeGames = 0;
                }
                if($slotSettings->GetGameData($slotSettings->slotId . 'IsMiniFreeSpin') == 1 && $slotEvent['slotEvent'] == 'freespin'){
                    $winType = $slotSettings->MiniWinType();
                    $_winAvaliableMoney = $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''));
                }
                
                $Balance = $slotSettings->GetBalance();
                if( $slotEvent['slotEvent'] == 'bet' ) 
                {
                    $slotSettings->UpdateJackpots($betline * $lines);
                }
                $reelNum = 0;
                if($slotEvent['slotEvent'] == 'freespin'){
                    $reelNum = 1;
                }else if($bl_value == 1){
                    $reelNum = rand(2, 9);
                    if($winType == 'bonus'){
                        $reelNum = 8;
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
                    $reels = $slotSettings->GetReelStrips($winType, $slotEvent['slotEvent'], $reelNum, $pur_value);
                    $tempReels = [];
                    $tempWildReels = [];
                    for($r = 0; $r < 5; $r++){
                        $tempWildReels[$r] = [];
                        $tempReels['reel' . ($r+1)] = [];
                        for( $k = 0; $k < 3; $k++ ) 
                        {
                            if( $reels['reel' . ($r+1)][$k] == $wild) 
                            {                                
                                if($slotEvent['slotEvent'] == 'freespin'){
                                    if(($r == 2 && rand(0, 100) < 70) || $winType == 'none'){
                                        $reels['reel' . ($r+1)][$k] = '' . rand(6, 13);
                                        $tempWildReels[$r][$k] = 0;    
                                    }else{
                                        if($r > 0 && $r < 4){
                                            $tempWildReels[$r][$k] = $slotSettings->CheckMultiWild();
                                        }else{
                                            $tempWildReels[$r][$k] = 0;    
                                        }
                                    }
                                }else{
                                    if($r > 0 && $r < 4){
                                        $tempWildReels[$r][$k] = $slotSettings->CheckMultiWild();
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
                    $totalWildValue = 0;
                    for($r = 0; $r < 5; $r++){
                        for($k = 0; $k < 3; $k++){
                            $totalWildValue = $totalWildValue + $tempWildReels[$r][$k];
                        }
                    }
                    $_lineWinNumber = 1;
                    for( $k = 0; $k < 20; $k++ ) 
                    {
                        $_lineWin = '';
                        $firstEle = $reels['reel1'][$linesId[$k][0] - 1];
                        $lineWinNum[$k] = 1;
                        $lineWins[$k] = 0;
                        $mul = $totalWildValue + 1;
                        for($j = 1; $j < 5; $j++){
                            $ele = $reels['reel'. ($j + 1)][$linesId[$k][$j] - 1];
                            if($firstEle == $wild){
                                $firstEle = $ele;
                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                            }else if($ele == $firstEle || $ele == $wild){
                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                if($j == 4){
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
                    $scattersReels = [0,0,0,0,0];
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = '';
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        for( $k = 0; $k < 3; $k++ ) 
                        {
                            if( $reels['reel' . $r][$k] == $scatter ) 
                            {
                                $scattersCount++;
                                $scattersReels[$r - 1] = 1;
                                array_push($_obf_scatterposes, $k * 5 + $r - 1);
                            }
                        }
                    }
                    if($scattersCount >= 3){
                        $freeSpinNums = $slotSettings->GenerateFreeSpinCount($scattersCount * 3);
                        for($k = 0; $k < count($freeSpinNums); $k++){
                            $freeSpinNum = $freeSpinNum + $freeSpinNums[$k];
                        }
                    }
                    
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
                        if( $scattersCount >= 3 && ($winType != 'bonus' || ($pur_value >= 0 && $scattersCount != $slotSettings-> BuyFreeStatters($pur_value)) || $totalWin > 0)) 
                        {
                        }
                        else if($slotEvent['slotEvent'] == 'freespin' && ($i > 1000 && $freeSpinNum)){
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
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeSpinWins', implode(',', $freeSpinNums));
                }
                $lastTempReel = [];
                for($k = 0; $k < 3; $k++){
                    for($j = 1; $j <= 5; $j++){
                        $lastReel[($j - 1) + $k * 5] = $reels['reel'.$j][$k];
                        $lastTempReel[($j - 1) + $k * 5] = $tempReels['reel'.$j][$k];
                    }
                }
                $strLastReel = implode(',', $lastReel);
                $strLastTempReel = implode(',', $lastTempReel);
                $strReelSa = $reels['reel1'][3].','.$reels['reel2'][3].','.$reels['reel3'][3].','.$reels['reel4'][3].','.$reels['reel5'][3];
                $strReelSb = $reels['reel1'][-1].','.$reels['reel2'][-1].','.$reels['reel3'][-1].','.$reels['reel4'][-1].','.$reels['reel5'][-1];
               
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);

                $_wildValue = [];
                $_wildPos = [];
                for($r = 0; $r < 3; $r++){
                    for($k = 0; $k < 5; $k++){
                        if($tempWildReels[$k][$r] > 0){
                            array_push($_wildValue, $tempWildReels[$k][$r]);
                            array_push($_wildPos, $r * 5 + $k);
                        }
                    }
                }


                $slotSettings->SetGameData($slotSettings->slotId . 'WildValues', $_wildValue);
                $slotSettings->SetGameData($slotSettings->slotId . 'WildPos', $_wildPos);
                $strWildResponse = '';
                $wildCount = count($_wildPos);
                if($wildCount > 0){
                    $arr_wild = [];
                    for($k = 0; $k < $wildCount; $k++){
                        array_push($arr_wild, '2~'.$_wildPos[$k].'~'.$_wildValue[$k]);
                    }
                    $strWildResponse = '&rmul='. implode(';', $arr_wild) . '&gwm=' . ($totalWildValue + 1);
                }
                $strWildResponse = $strWildResponse . '&wmv=' . ($totalWildValue + 1) . '&wmt=pr';
                if( $slotEvent['slotEvent'] == 'freespin' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    $spinType = 's';
                    $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                    $isEnd = false;
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                    {
                        if($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') < $slotSettings->GetGameData($slotSettings->slotId . 'LimitWin')){
                            $slotSettings->SetGameData($slotSettings->slotId . 'IsMiniFreeSpin', 1);
                            $initScatterReels = $slotSettings->GetGameData($slotSettings->slotId . 'InitScatterReels');
                            $arr_trail = [];
                            $freemore = 0;
                            for($k = 0; $k < 5; $k++){
                                if($initScatterReels[$k] == 1){
                                    $free_val = $slotSettings->GenerateFreeSpinCount(1)[0];
                                    array_push($arr_trail, 'cr'.($k + 1) . '~'. $free_val);
                                    $freemore = $freemore + $free_val;
                                }
                            }
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $freemore);
                            $spinType = 's&fsmul=1&trail='.implode(';', $arr_trail).'&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fsmore='.$freemore.'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&reel_set=1';
                        }else{
                            $isEnd = true;
                            $spinType = 'c&fs_total='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fswin_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsmul_total=1&fsres_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&reel_set=0';
                        }
                    }
                    else
                    {
                        $spinType = 's&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&reel_set=1';
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
                    $strOtherResponse = '&s='.$strLastReel;
                    $response = 'tw='. $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . $strWildResponse .'&balance='.$Balance.'&index='. $slotEvent['index'] . '&ls=0&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinLine .'&stime=' . floor(microtime(true) * 1000).'&bl='. $bl_value .'&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=3&c='.$betline.'&sty='.$strSty.'&sver=5&counter='. ((int)$slotEvent['counter'] + 1) .'&l='.$lines.'&s='.$strLastReel.'&w='.$totalWin;
                    if($beforeWildCount > 0){
                        $response = $response . '&is='. $strLastTempReel;
                    }
                }else
                {
                    // $_obf_0D5C3B1F210914123C222630290E271410213E320B0A11 = $totalWin;
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                    $n_reel_set = $reelNum;
                    if($scattersCount >=3 ){
                        $spinType = 's';
                        $tempLastReel = $lastReel;
                        $arr_ep = [];
                        $arr_m = [];
                        $arr_v = [];
                        $freePos = 0;
                        for($k = 0; $k < 5; $k++){
                            if($scattersReels[$k] == 1){
                                for($r = 0; $r < 3; $r++){
                                    $pos = $k + $r * 5;
                                    array_push($arr_ep, $pos);
                                    $tempLastReel[$pos] = 1;
                                    array_push($arr_m, 's~p~n');
                                    array_push($arr_v, '1~'.$pos.'~'.$freeSpinNums[$freePos]);
                                    $freePos++;
                                }
                            }
                        }
                        $limitWin = 0;
                        if($scattersCount == 3){
                            $limitWin = $allbet * 10;
                        }else if($scattersCount == 4){
                            $limitWin = $allbet * 20;
                        }else if($scattersCount == 5){
                            $limitWin = $allbet * 30;
                        }
                        $slotSettings->SetGameData($slotSettings->slotId . 'LimitWin', $limitWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'InitScatterReels', $scattersReels);
                        $strOtherResponse= '&fsmul=1&fsmax='.$freeSpinNum.'&is='. $strLastTempReel.'&ep=1~'.implode(',', $_obf_scatterposes).'~'. implode(',', $arr_ep) .'&fswin=0.00&fsres=0.00&aam='.implode(';', $arr_m).'&fs=1&aav='.implode(';', $arr_v).'&s='. implode(',', $tempLastReel);
                    }else{
                        $strOtherResponse= '&s='.$strLastReel;
                    }

                    $response = 'tw='.$totalWin . $strWildResponse . $strOtherResponse .'&ls=0&balance='.$Balance.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinLine.'&stime=' . floor(microtime(true) * 1000) .'&sa='.$strReelSa.'&sb='.$strReelSb.'&bl='. $bl_value.'&sh=3&c='.$betline.'&sver=5&reel_set='.$reelNum.'&counter='. ((int)$slotEvent['counter'] + 1) .'&l='.$lines.'&w='.$totalWin;
                }


                if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0)) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                }

                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $Balance . ',"wildValues":'.json_encode($_wildValue) . ',"wildPos":'.json_encode($_wildPos).',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"LimitWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'LimitWin') . ',"IsMiniFreeSpin":' . $slotSettings->GetGameData($slotSettings->slotId . 'IsMiniFreeSpin') . ',"OtherResponse":"'.$strOtherResponse . '","InitScatterReels":'.json_encode($slotSettings->GetGameData($slotSettings->slotId . 'InitScatterReels')).',"winLines":[],"Jackpots":""' . ',"InitReel":'.json_encode($lastTempReel). ',"LastReel":'.json_encode($lastReel).'}}';
                    
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
