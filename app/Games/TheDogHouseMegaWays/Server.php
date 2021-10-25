<?php 
namespace VanguardLTE\Games\TheDogHouseMegaWays
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
            $isBuyFreeSpin = false;
            if( isset($slotEvent['pur']) && $slotEvent['pur'] == 0) 
            {
                $isBuyFreeSpin = true;
            }
            $slotEvent['slotEvent'] = $slotEvent['action'];
            if( $slotEvent['slotEvent'] == 'update' ) 
            {
                $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"' . $slotSettings->GetBalance() . '"}';
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
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeSpinType', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'IsBuyFreeSpin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeOPT', [0]);
                $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 20);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [8,3,12,3,12,11,8,12,3,12,3,6,10,12,3,12,3,6,10,7,13,7,13,12,14,7,14,7,13,15,14,11,14,14,8,14,14,9,14,14,8,14]);
                if( $lastEvent != 'NULL' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'WildValues', $lastEvent->serverResponse->wildValues);
                    $slotSettings->SetGameData($slotSettings->slotId . 'WildPos', $lastEvent->serverResponse->wildPos);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->lines);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeSpinType', $lastEvent->serverResponse->FreeSpinType);
                    $slotSettings->SetGameData($slotSettings->slotId . 'IsBuyFreeSpin', $lastEvent->serverResponse->IsBuyFreeSpin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeOPT', $lastEvent->serverResponse->FreeOPT);
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
                $lastReel = $slotSettings->GetGameData($slotSettings->slotId . 'LastReel');
                $lastReelStr = implode(',', $lastReel);
                // -----* Bonus function check*-------
                // $freespinBonus = 20;
                // $bet = $slotSettings->Bet[0];
                // $slotSettings->SetGameData($slotSettings->slotId . 'IsBonus', 1);
                // $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $freespinBonus);
                // -----**-------
                $wlm_v = [];
                $wlm_p = [];
                for($r = 0; $r < count($wildValues); $r++){
                    if($wildValues[$r] > 1){
                        array_push($wlm_v, $wildValues[$r]);
                        array_push($wlm_p, $wildPos[$r]);
                    }
                }
                $strOtherResponse = '';
                if(count($wlm_v) > 0){
                    $strOtherResponse = '&wlm_v=' . implode(',', $wlm_v) . '&wlm_p=' . implode(',', $wlm_p);
                }
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
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeSpinType', 1);
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

                    if(count($wildPos) > 0){
                        $arr_rwds = [];
                        for($k = 0; $k < count($wildPos); $k++){
                            if(isset($arr_rwds[$wildPos[$k]]) == false){
                                $arr_rwd[$wildPos[$k]] = [];
                                $arr_rwds[$wildPos[$k]]['symbol'] = $lastReel[$wildPos[$k]];
                                $arr_rwds[$wildPos[$k]]['poses'] = [];
                                array_push($arr_rwds[$wildPos[$k]]['poses'], $wildPos[$k]);
                            }else{
                                array_push($arr_rwds[$wildPos[$k]]['poses'], $wildPos[$k]);
                            }                        
                        }
                        $arr_strRwds = [];
                        foreach( $arr_rwds as $index=>$val ) 
                        {
                            array_push($arr_strRwds, $val['symbol'] . '~' . implode(',', $val['poses']));
                        }
                        $strOtherResponse = $strOtherResponse . '&rwd=' . implode(';', $arr_strRwds);
                    }
                    $strOtherResponse = $strOtherResponse . '&fs=' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&sty='.$strSty.'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .  '&fsres=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&tw=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&w=0.00&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') .'&is='. $lastReelStr . '&fsopt_i=' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') - 1);
                    if($slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') == 2){
                        $currentReelSet = 10;
                    }else if($slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') == 1){
                        $currentReelSet = 9;
                    }
                }else if(count($freeOPT) > 1){
                    $strOtherResponse = $strOtherResponse . '&fs_opt_mask=fs,m,msk&fs_opt=' . $freeOPT[0] .',1,0~' . $freeOPT[1] .',1,0';
                    $spinType = 'fso';
                }
                if($slotSettings->GetGameData($slotSettings->slotId . 'IsBuyFreeSpin') == 1){
                    $strOtherResponse = $strOtherResponse . '&puri=0';
                }
                $Balance = $slotSettings->GetBalance();
                // $response = 'def_s=9,3,2,3,9,10,4,1,4,10,9,3,2,3,9&balance='. $Balance .'&cfgs=1&ver=2&index=1&balance_cash='.$Balance.
                //     '&reel_set_size=2&def_sb=8,10,8,11,7&def_sa=8,9,10,11,12&balance_bonus=0.00&na='. $spinType.'&scatters=1~0,0,5,0,0~0,0,0,0,0~1,1,1,1,1&gmb=0,0,0&mbri=1,2,3&rt=d&stime=' . floor(microtime(true) * 1000) .
                //     '&sa=8,9,10,11,12&sb=8,10,8,11,7&sc='. implode(',', $slotSettings->Bet) .'&defc=0.01&sh=3&wilds=2~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&n_reel_set='.$currentReelSet.$_obf_StrResponse.'&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;750,150,50,0,0;500,100,35,0,0;300,60,25,0,0;200,40,20,0,0;150,25,12,0,0;100,20,8,0,0;50,10,5,0,0;50,10,5,0,0;25,5,2,0,0;25,5,2,0,0;25,5,2,0,0&l=20&rtp=96.51&reel_set0=9,8,12,8,10,7,5,11,4,1,3,7,10,13,1,6,9,13,6,11,12~3,6,8,13,7,10,9,11,10,9,6,5,12,2,4,8,11,12,13,7~4,9,13,12,13,7,8,12,6,1,2,10,11,7,5,11,3,10,8,9,6~2,6,10,7,11,13,12,5,9,3,6,7,12,9,13,8,10,11,4,8~8,11,7,6,13,9,10,5,1,12,6,3,8,4,7,10,13,12,11,9&s='.$lastReelStr.'&reel_set1=12,5,11,9,13,8,13,3,3,3,10,12,11,10,13,11,8,8,9,6,9,10,12,6,3,7,4,7,5~13,11,7,9,4,12,7,3,10,9,8,13,11,10,13,5,6,9,2,7,6,10,12,8,11~6,12,10,13,7,12,5,10,8,7,2,13,3,6,9,8,11,8,5,12,9,4,11,10,9,13~13,9,5,7,13,6,12,11,6,10,13,12,9,7,8,10,4,2,8,7,5,9,11,3,12,8,6,10,11~13,12,11,7,10,11,7,13,4,9,12,6,10,3,3,3,8,6,11,8,9,13,7,9,5,8,12';
                $response = 'def_s=8,3,12,3,12,11,8,12,3,12,3,6,10,12,3,12,3,6,10,7,13,7,13,12,14,7,14,7,13,15,14,11,14,14,8,14,14,9,14,14,8,14&balance='. $Balance .'&nas=14&cfgs=1&ver=2&index=1&balance_cash='. $Balance .'&def_sb=13,11,13,11,13,11&reel_set_size=11&def_sa=6,6,6,13,13,13&reel_set='.$currentReelSet.$strOtherResponse.'&balance_bonus=0.00&na='.$spinType.'&scatters=1~0,0,0,0,0,0~0,0,0,0,0,0~1,1,1,1,1,1&gmb=0,0,0&rt=d&gameInfo={props:{max_rnd_sim:"1",max_rnd_hr:"104166666",max_rnd_win:"9000"}}&stime=' . floor(microtime(true) * 1000) .'&sa=6,6,6,13,13,13&sb=13,11,13,11,13,11&reel_set10=13,13,13,4,12,12,12,6,12,5,5,5,13,10,9,11,4,4,4,5,3,7,8,11,11,11,3,3,3,8,8,8,9,9,9,6,6,6,4,11~11,11,11,9,3,3,3,4,9,9,9,3,13,13,13,12,8,6,10,6,6,6,13,12,12,12,5,7,5,5,5,11,4,4,4,8,8,8,6,3,9,13,3,9,3,13,9,12,6,9,6,3,13,9,13,6,4,9,3,12,9,12,6,4,6,4,9,4,8,13,9,4,3~8,8,8,11,4,10,3,3,3,6,13,8,3,6,6,6,7,13,13,13,9,5,12,11,11,11,4,4,4,9,9,9,5,5,5,12,12,12,3,12,3,6,9,6,12,5,12,13,5,9,12,5,11,7,4,9,4,6,13,6,13,3,5,12,3,6,11,9,12,9,13,3,13,9,4,9,6,12,11,4,12,11,4,3~12,12,12,11,8,8,8,8,5,13,13,13,7,5,5,5,10,9,9,9,12,6,6,6,3,3,3,3,13,4,4,4,6,4,9,11,11,11,6,9,6,13,8,6,8,6,3,6,9,4,9,6,11,8,5,9,4,9,7,9,8,9,4,13,5,8,9~13,5,3,3,3,9,9,9,9,7,6,11,4,3,8,12,10,11,11,11,12,12,12,5,5,5,6,6,6,4,4,4,8,8,8,13,13,13,3,8,9,6,12,8,9,3,8,4,3,11,4,3,12,6,11,9,12,4,11,9,3,8,3,11,3,11,6,12,5,9,12,9,5,8,4,9,3,12,9,6,5,9,12,3,9,5,12,4,6,4,6~8,8,8,7,10,9,13,13,13,12,6,12,12,12,13,3,8,11,4,6,6,6,5,5,5,5,4,4,4,9,9,9,3,3,3,11,11,11,4,13,6,3,11,13,3,6,5,6,9,3&sc='. implode(',', $slotSettings->Bet) .'&defc=0.10&sh=7&wilds=2~0,0,0,0,0,0~1,1,1,1,1,1;15~0,0,0,0,0,0~1,1,1,1,1,1;16~0,0,0,0,0,0~1,1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&counter=2&paytable=0,0,0,0,0,0;0,0,0,0,0,0;0,0,0,0,0,0;150,60,40,15,0,0;60,30,20,10,0,0;40,20,15,7,0,0;30,15,10,4,0,0;30,10,8,3,0,0;30,10,8,3,0,0;20,6,4,2,0,0;20,6,4,2,0,0;20,6,4,2,0,0;10,4,2,1,0,0;10,4,2,1,0,0;0,0,0,0,0,0;0,0,0,0,0,0;0,0,0,0,0,0&l=20&rtp=96.55&total_bet_max=10,000.00&reel_set0=4,4,4,1,10,3,13,13,13,12,6,12,12,12,8,11,11,11,11,5,8,8,8,7,4,9,9,9,9,13,3,3,3,5,5,5,6,6,6,7,1,8,13,6,8,12,6,9,3,8,9,3,8,5,6,1,11,12,11,1,13,8,3,9,3,8,12,6,3,11,8,13,6~8,3,9,9,9,13,7,11,13,13,13,2,6,11,11,11,9,1,3,3,3,12,5,10,5,5,5,4,8,8,8,12,12,12,4,4,4,3,9,13,12,4,11,3,13,12,4,2,9,5,12,9,4,5,4,6,4,13,5,13,12,13~11,11,11,8,7,1,13,13,13,13,12,12,12,9,9,9,9,4,5,5,5,3,3,3,3,10,4,4,4,11,5,12,2,6,2,12,4,9,12,2,13,5,3,2~4,4,4,4,9,9,9,11,13,13,13,5,7,12,12,12,12,1,5,5,5,2,8,13,11,11,11,6,3,10,9,3,3,3,5,13,9,11,9,3,9,12,9,5,13,5,7,9,3,5,3,5,9,3,13,3,5,3,13~11,12,12,12,1,10,9,12,11,11,11,13,5,5,5,8,7,3,3,3,4,5,2,6,4,4,4,3,13,13,13,9,9,9,12,7,4,5~10,12,12,12,11,8,8,8,3,8,6,3,3,3,1,11,11,11,9,5,5,5,5,13,12,6,6,6,7,4,13,13,13,9,9,9,4,4,4,6,12,5,4,8,5,12,6,5,4,5,4,6,5,8,7,9,8,9,13,4,6,13,8,4,12,6,12,7,1,3,13,11,5,8,9,6,8,5,9,5,9,5,12&s='.$lastReelStr.'&reel_set2=8,8,8,12,10,11,11,11,13,3,13,13,13,9,3,3,3,4,6,12,12,12,11,6,6,6,8,5,5,5,7,4,4,4,5,9,9,9,10,3,13,3,4,11,9,5,3,11,10,11,13,11,9,3,9,4,5,11,10,3,11,6,5,13,3,9,5,13,5,10,3,9,6,11,3,13,11,6,4,9,4,3,11,4,11,4,5,9,3,11,13,11,3,5,12,3,4,3,6~9,9,9,5,11,11,11,12,7,11,4,4,4,13,13,13,13,4,5,5,5,10,6,3,3,3,8,8,8,8,3,12,12,12,9,5,4,3,4,5,6,11,3,13,11,3,5,11,8,11,8,12,11,13,4,13,10,4,13,4,11,8,5,3,8,3,13,5,4,13,3~5,10,4,4,4,11,8,11,11,11,9,13,6,4,3,3,3,3,8,8,8,12,7,9,9,9,12,12,12,13,13,13,5,5,5,9,8,12,4,12,4,6,11,7,11,4,3,7,11,3,8,4,8,3,4,9,11,9,11,12,11,9,7,3,11,4,7,8,3,7,9,4,3,4,3,9,11,9,12~9,7,6,3,3,3,5,8,3,4,4,4,13,4,11,12,12,12,12,10,9,9,9,13,13,13,5,5,5,11,11,11,4,5,10,13,4,3,13,12,3,12,5,13,7,3,11,5,13,3,5,4,3,13,11,7,4,12,3,5,8,5,7,13,8,3,5,12,7,3,6,5,3,7,3,6,13~4,4,4,9,3,3,3,10,12,3,4,11,11,11,8,6,5,7,11,13,9,9,9,12,12,12,5,5,5,13,13,13,11,13,9,5,9,3,9,6,13,3,13,9,13,11,9,13,11,6,9,13,3,5,12~12,13,13,13,5,4,3,12,12,12,10,9,9,9,7,11,9,6,6,6,8,13,6,4,4,4,3,3,3,11,11,11,5,5,5,8,8,8,6&t=243&reel_set1=4,8,10,6,6,6,13,9,9,9,9,7,12,5,13,13,13,11,4,4,4,6,8,8,8,3,11,11,11,3,3,3,12,12,12,5,5,5,7,5,6,11,13,9,6,10,3,6,13,3,9,3,6,8,9,10,12,3,12,10,6,3,8,13,9,8,3,13,3,13,6,13,3,8,12,6,9,12,6,12,11,10,12,9,3,10,13~3,3,3,11,8,8,8,6,13,13,13,9,9,9,9,10,5,5,5,13,12,12,12,5,3,4,2,12,8,7,11,11,11,4,4,4,5~8,8,8,13,13,13,13,6,10,4,7,11,9,11,11,11,5,3,3,3,8,2,3,12,9,9,9,4,4,4,5,5,5,12,12,12,5,13,9,13,5,11,13,2,13,3,13,5,4,2,12,13,3,11,5,3,11,4,13,9,3,13,4,13,5,13,4,11,3,13,12,7,13,4,13,2,5,3,4~4,12,12,12,10,13,13,13,5,3,3,3,2,11,7,6,13,11,11,11,3,12,9,9,9,9,8,5,5,5,4,4,4,5,8,12,11,12,8,3,13,11,2,9,6,2,3,2,3,12,5,8,5,9,5,12,8,3,7,9,5,12,7,3,12,9,3,11,3,9,2,8,11,12,5~4,9,8,13,3,7,6,11,13,13,13,5,2,9,9,9,12,10,4,4,4,11,11,11,12,12,12,5,5,5,3,3,3,13,3,11,2,13,2,12,3,13,7,13,9,3,2,6,12,13,12,13,3,5,13,3,13,3,13,7,13,3,13,9,5,3,9,3,5,12,13,5,13,9,12,9,2,11,12,5,9,12,3,13,9,12,11,13,5,9,13,9,3,12,3,13,12,5,9~13,13,13,3,12,12,12,7,9,8,8,8,6,6,6,6,10,4,5,5,5,5,13,11,11,11,8,12,11,9,9,9,3,3,3,4,4,4,5,11,9,6,4,8,11,4,9,5,11,6,4,6,5,11,12,8,11,6,12,11,4,3,12,6,9,8,4,11,4,3,6,5,3,8,6,9,3,6,12,5,11,3,4,12,5,9,4,6,4,6,4,9,8,11,6,4,5,11,9,6&reel_set4=7,11,11,11,9,8,8,8,12,4,6,5,9,9,9,13,10,8,5,5,5,11,3,13,13,13,12,12,12,3,3,3,6,6,6,4,4,4,5,4,9,8,5,13,4,5,12,13,4,12,4,5,4,12,5,4,3,13,12~13,9,11,11,11,10,9,9,9,4,12,12,12,7,8,3,4,4,4,5,13,13,13,12,6,5,5,5,11,3,3,3,11,3,5,11,5,11,9,5,11,12,5,11,12,11,5,12,4,11,3,4,9,3,11,5,4,9,11,3,9,11,7,3,12,3,12,3,9,11,5,4,11,9,11,12,9,4,3,11,5,4,7,8,3,11,3,11,12,4,3~12,12,12,5,12,7,11,6,11,11,11,9,13,13,13,13,4,10,3,8,9,9,9,4,4,4,3,3,3,5,5,5,11,9,13,3,13,11,3,9,4,13,9,5,11,13,4,13,4,13,5,13,11,13,11,9,3,9,13,3,13,9,13,9,13,4,13,4,3,13,5,13,9,4,13,3,13~10,8,8,8,5,13,13,13,13,12,12,12,4,9,4,4,4,2,8,11,11,11,7,3,3,3,6,5,5,5,12,11,3,9,9,9,12,7,8,5,12,8,5,9,3,4,11,12,11,8,3~9,9,9,9,6,8,8,8,2,12,12,12,12,5,10,4,7,3,8,11,13,4,4,4,11,11,11,3,3,3,13,13,13,5,5,5,12,7,3,8,5,8,12,13,11,13,8,12,11,7,5,3,12,4,8,12,8,11,3,5,8~13,8,9,11,11,11,10,12,11,4,3,7,5,6,12,12,12,5,5,5,13,13,13,4,4,4,3,3,3,8,8,8,9,9,9,6,6,6,5,8,6,12,11,5,4,12,3,11,4,12,11,7,8,11,12,4,6,11,3,4,10,9,12,11,8,3,9,11,8,11,8,11,5,3,6,12,6,8,9,8,5,11,5,6,11,9&purInit=[{type:"fsbl",bet:2000,bet_level:0}]&reel_set3=3,3,3,7,5,11,9,9,9,13,12,6,6,6,9,4,4,4,10,11,11,11,6,12,12,12,3,4,5,5,5,8,13,13,13,8,8,8,6,9,6,12,7,13,5,13,6,9,11,6,13,12,7,9,4,8,6,5,7,9,11,4,6,9,8,12,4,8,6,4,5,10,4,7,9,4,13,11,9,5,12,4,12,4,11,9,4~3,3,3,3,4,12,12,12,5,13,13,13,9,12,2,4,4,4,10,9,9,9,8,8,8,8,6,11,7,13,5,5,5,11,11,11,5,9,13,12,7,12,9,11,13,11,13,12,13,12,8,11~3,9,13,13,13,11,12,5,5,5,2,13,8,5,7,10,4,6,9,9,9,8,8,8,11,11,11,12,12,12,4,4,4,3,3,3,4,12,11,9,13,5,13,4,12,4,11,12,13,8,4,6,9,5,11,4,9,5,4,13,6,11,5,9,12,5,4,11,5,9,12,13,9,6,11,12,8,4,11,13,12,9,8,4,12,8,4,12,5,12,4,9,4,11,5,8,4,9,8~9,9,9,8,11,7,12,12,12,5,6,13,10,9,3,3,3,4,12,3,13,13,13,5,5,5,11,11,11,4,4,4,8,3,13,5,3,10,8,3,5,12,11,3,12,3,5,13,5,12,11,5,10,13,5,4,12,13,12,13,12,13,5,13,5~4,4,4,8,12,5,5,5,5,9,3,9,9,9,6,4,11,13,13,13,7,12,12,12,13,10,3,3,3,11,11,11,3,7,5,12,3,12,7,3,11~4,3,3,3,3,7,6,13,13,13,13,5,10,11,11,11,11,9,8,12,12,12,12,6,6,6,5,5,5,9,9,9,8,8,8,4,4,4,5,11,3,6,9,13,5,13,10,9,5,13,9,5,11,6,9,3,13,9,13,11,8,9,13,9,5,11,13,9,8&reel_set6=11,3,10,13,5,4,8,6,9,12,7,10,12,9,10,4,5,7,13,7,6,4,10,7,9,6,4,5,10,4,7,4,9,10,9,6,5,6,10,5,4,5,6,4,5,10,5,6,5,4,7,9,4,7,10,4,6,7,5,7,6,7,5,9,7,9,13,4,7,5,4,9,4,6,9,10,13,4,10,9,6~4,13,9,2,11,6,8,10,12,7,5,3,7,6,7,11,2,6,2,8,7,8,7,11,5,11,2,7,3,7,3,11,3,6,5,6,8,11,2,8,3,6,12,5,11,6,7,8,7,8,5,2,3,8,2,3,11~7,12,8,10,2,9,4,5,11,6,13,3,11,3,6,12,13,3,4,6,10,11,13,11,6,12,8,5,12,6,3,5,10,5,3,12,8,5,12,9,4,11,12,8,3,4,3,12,4,8,5,6,10,3,8,5,8,4,5,6,8,11,12,4,8,10,12,11,4,5,8,3,6,12,3,11,6,12,13,12~6,10,11,8,9,12,2,7,4,3,13,5,4,11,3,13,7,2,5,7,5,4,12,4,7,5,9,13,2,4,2,4,5,4,2,4,10,12~12,11,9,7,5,2,13,4,6,8,10,3,11,5,3,13,7,2,11,8,11,10,8,11,2,8,11,10,11,3,11,6,8,13,7,3,7,11,13,2,13,8,11,9,13,3,11,6,11,13,8,11,8,13,5,7,11,2,8,13,11,9,11,3,8,11,13,10,11,13,8,9,13~8,3,6,13,11,12,4,5,10,9,7,9,7,3,5,12,5,6,10,6,10,6,13,12,3,5,7,10,7,9,13,7,3,5,10,9,6,3,12,6,7,13,6,3,7,10,13,9,7,3,10,12,6,7,6,9,7,9,12,5,7,9,12,5,10,12,3,5,6,9&reel_set5=5,6,7,13,10,4,11,12,3,1,8,9,11,12,6,1,6,11~5,11,6,1,10,4,13,9,7,8,3,12,2,8,3,2,7,8,2,7,2,8,6,12,1,8,1,2,12,8,2,1,3,7,12,7,6~2,7,10,1,11,8,3,9,4,12,13,5,6,13,3,1,3,1,9,5,3,4,10,4,9,5,4,1,6,3,4,7,5,11,1,13,1,5,10,1,9,3,4,5,6,3~4,13,12,10,6,7,5,2,3,1,9,11,8,3,9,7,8,1,3,1,9,7,5,12,13,3,5,9,8,1,7,1,13,10,5,1,9,1,12,1,3,9,5,9,5,9,12,1,5,8,5,10,1,9,5~6,13,12,8,11,2,3,4,7,9,1,10,5,7,2,5,10,5,9,3,4,10,7,5,12,13,5,3,9,10,8,11,2,7,8,13,10,5,10,7,13,3,4,2,7,5,10,8,1,7,8,2,5,4,5,2,8,2,5,8,5,2,10,2,7,2,8,5,2,7,5,8,13,8,5,13,2,5,9,2,13,2,1,13,9,4,10,2,3,2,7,2~9,1,4,11,10,6,8,3,7,12,13,5,13,3,13,5,10,7,3,7,3,5,13,7,13,7,8,1,7,3,6,3,8,13,3,13,8,3,13,11,13,5,13,7,5,6,13,3,6,3,7,3,8,3,8,7,12,8,5,13,7,3,8,13,7,5,13,5,13,12,3,8,5,3,5,3,7,6,11,6,3,5,7,13,8,13,12,3&reel_set8=13,11,5,6,8,13,13,13,10,7,3,5,5,5,12,8,8,8,9,4,4,4,4,11,11,11,9,9,9,3,3,3,12,12,12,7,7,7,3,12,11,5,8,7,3,6,3,12,10,5,11,3,9,6,3,4,5,12,3,4,5,11,12,7,4,3,12,8,3,5,12,7,4,5,3,7,6,4,8~7,6,10,13,13,13,13,12,11,9,7,7,7,3,5,2,4,8,8,8,8,12,12,12,4,4,4,11,11,11,9,9,9,3,3,3,4,12,5,3,5,2,3,5,11,13,5,12,10,5,8,11,12,13,5,11,9,12,13,9,2,10,12,9,13,11,3~3,3,3,11,7,13,13,13,9,8,8,8,6,8,3,13,4,2,12,5,5,5,10,5,11,11,11,4,4,4,12,12,12,9,9,9,8,13,11,9,8,11,13,4,8,13,9,11,4,5,11,4,5,13,4,9,4,13,5,4,13,4,11,13~4,4,4,3,7,9,9,9,9,12,13,13,13,13,8,8,8,6,12,12,12,11,4,10,7,7,7,2,5,8,3,3,3,11,11,11,8,12,13,7,13,12,7,11,3,7,5,13,8,7,3,13,5,9,12,5,10,13,9,6,12,7,12,9,12,11,10,11,8,5,13,12,9,3,7,5,9,11,13,5,7,3,12,13,11,12,9,11,10,3,5~6,3,8,12,4,5,10,11,9,7,13,5,4,11,5,4,12,5,9,5,13,8,5,9,10,5,10,8,4,5,11,5,9,10,9,5,9,3,4,9,5,12,4,10,9,4,9,5,3,5,9,13,10,11,5,4,5,8,9,10,5,9,4,5,10,13,5,10,5,9,10,5,4,5,8,13,10,12,4,5,10,12,10,13,3,9,5,9,13,4,10~7,12,3,13,8,10,6,5,11,9,4,6,3,6,5,3,11,6,9,6,5,13,6,9,4,5,13,11,6,13,9,6,5,3,6,11,5,3,11,6,5,3,4,6,3,6,3,5,6,11,10,5,6,4,3,6,11,6,4,13,6,11,6,5,4,6,10,4,3,11,6,11,5,11,6,5,4,5,6,4,9,5,6,4,13,6,5,3,6,9,3,4,6,9,4,5,6&reel_set7=3,6,6,6,12,13,13,13,11,7,4,9,11,11,11,8,10,9,9,9,13,8,8,8,6,3,3,3,5,5,5,5,12,12,12,4,4,4,13,12,11,13,9,11,5~12,12,12,3,5,3,3,3,6,2,7,8,8,8,10,4,4,4,13,4,13,13,13,8,9,12,9,9,9,11,11,11,11,5,5,5,7,13,5,7,5,13,5,2,6,13,5,4,8,7,5,11,3,5,2,9,5,11,8,3~6,2,3,13,7,11,11,11,10,12,12,12,5,12,4,4,4,4,11,9,9,9,8,9,5,5,5,13,13,13,3,3,3,8,8,8,12,10,9,3,12,11,7,4,5,10,12,8,9,3,4,9,13,5,8,13,5,4,3,8,12,3,7,9,10,13,7,3,10,3,11,4,5,4,3,7,4,5,4,3,7,8,5,7,2,9,5,7,13,4~4,4,4,5,8,9,9,9,6,3,9,8,8,8,12,10,5,5,5,2,11,12,12,12,7,4,13,3,3,3,11,11,11,13,13,13,8,2,8,6,3,11,12,8,3,9~13,2,5,4,4,4,8,11,9,9,9,9,10,3,12,4,6,7,5,5,5,11,11,11,13,13,13,8,8,8,3,3,3,12,12,12,8,9,10,3,4,10,12,8,5~4,9,9,9,10,12,12,12,7,11,6,12,9,5,13,13,13,13,3,11,11,11,8,3,3,3,8,8,8,4,4,4,5,5,5,6,6,6,13,8,5,12,13,12,11,10,11,8,6,5,10,9,13,5,13,5,12,13,8,5,8,13,5,12,13,5,12,8,6,5,6,5,11,5,10,8,13,5,8,5,12,8,11,5,8,5,8,13,11,10,5,12,13,12,13,12,6&reel_set9=7,5,8,11,9,9,9,6,10,12,3,4,4,4,4,13,9,5,5,5,8,8,8,12,12,12,13,13,13,3,3,3,11,11,11,6,6,6,9,13,9,11,8,6,5,3,5,13,12,5,13,10,13,5,9,5,13,12,5,11,4,12,13,11,9,13,12,8~9,9,9,8,3,3,3,3,6,13,13,13,9,11,4,13,5,5,5,5,7,10,8,8,8,12,11,11,11,4,4,4,12,12,12,8,3,5,4,12,3,12,11,12,3,12,11,4,13,6,11,13,12,5,4,5,8,13,5,3,4,10,3,8,11,10,5,12,11,3,4,3,5,3,10,13,8,3,4,13,7,4,12,13,12,10,13,11,3,4~13,8,8,8,12,7,4,10,8,5,6,3,9,11,11,11,11,4,4,4,5,5,5,3,3,3,13,13,13,12,12,12,9,9,9,10,12,3,10,4,11,10,7,4,11,12,4,11,12,10,3,10,8,12,9,7,11,3,10,12,11,3~8,12,3,12,12,12,10,9,9,9,4,5,11,7,4,4,4,9,6,11,11,11,13,13,13,13,3,3,3,5,5,5,4,13,11,4,3,11,10,9,11,9,11,4,3,13,3,9,11,12,3,13,9,3,11~9,5,6,11,11,11,8,4,4,4,4,7,12,12,12,3,12,13,3,3,3,10,11,13,13,13,5,5,5,9,9,9,8,5,8,3,11,13,4,11,5,11,8,11,4,5,4,11,13,11,8,11,5,7,11,5,11,6,11,4,12,11,5,11,8,5~9,9,9,12,5,5,5,13,11,12,12,12,7,6,6,6,8,6,5,9,4,10,11,11,11,3,3,3,3,4,4,4,13,13,13,8,8,8,13,8,13,8,3,13,3,5,11,6,13,4,8,4,8,13,4,6,8,7,5,8,11,13,12,6,11,13,3,4,13,5,12,4,6,3,4,8,4,11,5,11,12,7,13,12,13,5,8,4,13,10,13,12,4,12,5,13,6,5&total_bet_min=0.01';
            }
            else if( $slotEvent['slotEvent'] == 'doCollect' || $slotEvent['slotEvent'] == 'doCollectBonus') 
            {
                $Balance = $slotSettings->GetBalance();
                $response = 'balance=' . $Balance . '&index=' . $slotEvent['index'] . '&balance_cash=' . $Balance . '&balance_bonus=0.00&na=s&stime=' . floor(microtime(true) * 1000) . '&na=s&sver=5&counter=' . ((int)$slotEvent['counter'] + 1);
            }
            else if( $slotEvent['slotEvent'] == 'doSpin' ) 
            {
                
                $lastEvent = $slotSettings->GetHistory();
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422 = [];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[0] = [
                    0, 
                    5, 
                    10
                ];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[1] = [
                    1, 
                    6, 
                    11
                ];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[2] = [
                    2, 
                    7, 
                    12
                ];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[3] = [
                    3, 
                    8, 
                    13
                ];
                $_obf_0D3E5B07273F2C2D231026141F1B2C090F300518311422[4] = [
                    4, 
                    9, 
                    14
                ];
                $slotEvent['slotBet'] = $slotEvent['c'];
                $slotEvent['slotLines'] = 20;
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
                    }else{
                        $slotSettings->SetGameData($slotSettings->slotId . 'IsBonus', 0);
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
                $_spinSettings = $slotSettings->GetSpinSettings($slotEvent['slotEvent'], $betline * $lines, $lines);
                $winType = $_spinSettings[0];
                $_winAvaliableMoney = $_spinSettings[1];
                if($slotEvent['slotEvent'] == 'freespin'){
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                    $_wildValue = $slotSettings->GetGameData($slotSettings->slotId . 'WildValues');
                    $_wildPos = $slotSettings->GetGameData($slotSettings->slotId . 'WildPos');
                    $leftFreeGames = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');    
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 && $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') == 0) 
                    {
                        $winType = 'win';
                        $_winAvaliableMoney = $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''));
                    }
                }
                else
                {
                    if($isBuyFreeSpin == true){
                        $slotSettings->SetBalance(-1 * ($betline * 2000), $slotEvent['slotEvent']);
                        $winType = 'bonus';
                        $_winAvaliableMoney = $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''));
                        $_sum = ($betline * 2000) / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), $_sum, $slotEvent['slotEvent'], true);
                    }else{
                        $slotSettings->SetBalance(-1 * ($betline * $lines), $slotEvent['slotEvent']);
                        $_sum = ($betline * $lines) / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), $_sum, $slotEvent['slotEvent']);
                    }
                    $slotEvent['slotEvent'] = 'bet';
                    $bonusMpl = 1;
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeSpinType', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeOPT', []);
                    if($isBuyFreeSpin == true){
                        $slotSettings->SetGameData($slotSettings->slotId . 'IsBuyFreeSpin', 1);
                    }else{
                        $slotSettings->SetGameData($slotSettings->slotId . 'IsBuyFreeSpin', 0);
                    }
                    $leftFreeGames = 0;
                }
                
                $Balance = $slotSettings->GetBalance();
                if( $slotEvent['slotEvent'] != 'bet' ) 
                {
                    $slotSettings->UpdateJackpots($betline * $lines);
                }
                $n_reel_set = 0;
                $generatedScatters = 0;
                if($winType == 'bonus'){
                    $n_reel_set = 0;
                    $generatedScatters = $slotSettings->GenerateScatterCount();
                }else if($slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') == 2){
                    $n_reel_set = 10;
                }else if($slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') == 1){
                    $n_reel_set = 9;
                }else{
                    $n_reel_set = rand(0, 5);
                }
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $totalWin = 0;
                    $this->winLines = [];
                    $wild = '2';
                    $scatter = '1';
                    $_obf_winCount = 0;
                    $strWinLine = '';
                    $reels = $slotSettings->GetReelStrips($winType, $slotEvent['slotEvent'], $n_reel_set, $generatedScatters);
                    $tempReels = [];
                    $newWildPoses = [];
                    $tempWildReels = [];
                    for($r = 0; $r < 6; $r++){
                        $tempWildReels[$r] = [];
                        $tempReels['reel' . ($r+1)] = [];
                        $emptySymbolPos = -1;
                        for( $k = 0; $k < 7; $k++ ) 
                        {
                            if( $reels['reel' . ($r+1)][$k] == $wild) 
                            {                                
                                if( $slotEvent['slotEvent'] == 'freespin' && ($winType == 'none' || (($r == 1 || $r == 2) && rand(0, 100) < 70))){
                                    $reels['reel' . ($r+1)][$k] = rand(7, 13);
                                    $tempWildReels[$r][$k] = 0;
                                }else if($r > 0 && $r < 5){
                                    $tempWildReels[$r][$k] = $slotSettings->CheckMultiWild();
                                }else{
                                    $tempWildReels[$r][$k] = 0;    
                                }
                                array_push($newWildPoses, $k * 6 + $r);
                            }else{
                                $tempWildReels[$r][$k] = 0;
                                if($reels['reel' . ($r+1)][$k] == 14 && $emptySymbolPos == -1){
                                    $emptySymbolPos = $k;
                                }
                            }
                            $tempReels['reel' . ($r+1)][$k] = $reels['reel' . ($r+1)][$k];
                        }
                        if($slotEvent['slotEvent'] == 'freespin'){
                            if($slotSettings->IsGenerateWild($r + 1, $slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType')) && $emptySymbolPos > -1){
                                $row = rand(0, $emptySymbolPos - 1);
                                $reels['reel' . ($r+1)][$row] = $wild;
                                $tempWildReels[$r][$row] = $slotSettings->CheckMultiWild();
                                array_push($newWildPoses, $row * 6 + $r);
                            }
                        }
                    }
                    if($slotEvent['slotEvent'] == 'freespin' && $slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') == 2){
                        for($r = 0; $r < count($_wildPos); $r++){
                            $col = $_wildPos[$r] % 6;
                            $row = floor($_wildPos[$r] / 6);
                            if($reels['reel'.($col + 1)][$row] == 14){
                                for($k = $row - 1; $k >= 0; $k--){
                                    if($reels['reel'.($col + 1)][$k] < 14){
                                        if($reels['reel'.($col + 1)][$k] == $wild){
                                            $reels['reel'.($col + 1)][$k + 1] = $wild;
                                            $tempWildReels[$col][$k + 1] = $_wildValue[$r];
                                        }else{
                                            $reels['reel'.($col + 1)][$k] = $wild;
                                            $tempWildReels[$col][$k] = $_wildValue[$r];
                                        }
                                        break;
                                    }
                                }
                            }else{
                                $reels['reel'.($col + 1)][$row] = $wild;
                                $tempWildReels[$col][$row] = $_wildValue[$r];
                            }
                        }
                    }

                    for($r = 0; $r < 7; $r++){
                        if($reels['reel1'][$r] != $scatter && $reels['reel1'][$r] != 14){
                            $symbolPoses = [];
                            array_push($symbolPoses, $r * 6);
                            $this->findZokbos($reels, $tempWildReels, 1, $reels['reel1'][$r], 1, $symbolPoses);
                        }                        
                    }
                    for($r = 0; $r < count($this->winLines); $r++){
                        $winLine = $this->winLines[$r];
                        $winLineMoney = $slotSettings->Paytable[$winLine['FirstSymbol']][$winLine['RepeatCount']] * $betline;
                        if($winLine['Mul'] > 0){
                            $this->winLines[$r]['WinMoney'] = $winLineMoney;
                            $winLineMoney = $winLineMoney * $winLine['Mul'];
                        }
                        $totalWin += $winLineMoney;
                    } 
                    
                    $freeSpinNums = [];                    
                    $freeSpinNum = 0;

                    $_obf_scatterposes = [];
                    $scattersCount = 0;
                    $wildposes = [];
                    $wildCount = 0;
                    $scattersWin = 0;
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = '';
                    for( $r = 1; $r <= 6; $r++ ) 
                    {
                        for( $k = 0; $k <= 6; $k++ ) 
                        {
                            if( $reels['reel' . $r][$k] == $scatter ) 
                            {
                                $scattersCount++;
                                array_push($_obf_scatterposes, $k * 6 + $r - 1);
                            }
                            if( $reels['reel' . $r][$k] == $wild ) 
                            {
                                $wildCount++;
                                array_push($wildposes, $k * 6 + $r - 1);
                            }
                        }
                    }
                    if( $i >= 1000 ) 
                    {
                        $winType = 'none';
                    }
                    if( $i > 1500 ) 
                    {
                        break;
                    }
                    if( $scattersCount >= 3 && ($winType != 'bonus' || $slotEvent['slotEvent'] == 'freespin')) 
                    {
                    }
                    else if($slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') == 2 && $wild > 7){

                    }else if($slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') == 1 && $wild > 6){
                        
                    }else if($scattersCount >= 3 && $winType == 'bonus' && $scattersCount != $generatedScatters){

                    }
                    else if($slotEvent['slotEvent'] == 'freespin'&& $i > 1000){
                        if($totalWin * $leftFreeGames < $_winAvaliableMoney){
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
                            if($scattersCount >= 3){
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
                $spinType = 's';
                $isEndRespin = false;
                $strOtherResponse = '';
                if( $totalWin > 0) 
                {
                    $spinType = 'c';
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), -1 * $totalWin);
                    if($isWelcomeFreespin == 1){
                        $slotSettings->SetWelcomeBonus($totalWin);
                    }
                    $wlc_vs = [];
                    $firstSymbols = [];
                    for($r = 0; $r < count($this->winLines); $r++){
                        $winLine = $this->winLines[$r];
                        if($winLine['WinMoney'] > 0){
                            if(isset($wlc_vs[$winLine['FirstSymbol']]) == false){
                                $wlc_vs[$winLine['FirstSymbol']] = [];
                                $wlc_vs[$winLine['FirstSymbol']]['RepeatCount'] = $winLine['RepeatCount'];
                                $wlc_vs[$winLine['FirstSymbol']]['SymbolPoses'] = $winLine['SymbolPoses'];
                                $wlc_vs[$winLine['FirstSymbol']]['WinCount'] = 1;
                                $wlc_vs[$winLine['FirstSymbol']]['WinMoney'] = $winLine['WinMoney'];
                                array_push($firstSymbols, $winLine['FirstSymbol']);
                            }else{
                                for($k = 0; $k < count($winLine['SymbolPoses']); $k++){
                                    $isSame = false;
                                    for($p = 0; $p < count($wlc_vs[$winLine['FirstSymbol']]['SymbolPoses']); $p++){
                                        if($wlc_vs[$winLine['FirstSymbol']]['SymbolPoses'][$p] == $winLine['SymbolPoses'][$k]){
                                            $isSame = true;
                                            break;
                                        }
                                    }
                                    if($isSame == false){
                                        array_push($wlc_vs[$winLine['FirstSymbol']]['SymbolPoses'], $winLine['SymbolPoses'][$k]);
                                    }
                                }
                                $wlc_vs[$winLine['FirstSymbol']]['WinCount']++;
                                $wlc_vs[$winLine['FirstSymbol']]['WinMoney'] = $wlc_vs[$winLine['FirstSymbol']]['WinMoney'] + $winLine['WinMoney'];
                            }
                        }
                    } 
                    $arr_wlc_v = [];
                    foreach($wlc_vs as $index=>$wlc_v ){
                        array_push($arr_wlc_v, $index . '~' . $wlc_v['WinMoney'] . '~' . $wlc_v['WinCount'] . '~' . $wlc_v['RepeatCount'] . '~' . implode(',', $wlc_v['SymbolPoses']) . '~1');
                    }
                    $strOtherResponse = '&wlc_v=' . implode(';', $arr_wlc_v);
                }
                $_obf_totalWin = $totalWin;
                
                $lastTempReel = [];
                for($k = 0; $k < 7; $k++){
                    for($j = 1; $j <= 6; $j++){
                        if($slotEvent['slotEvent'] == 'freespin' && $reels['reel'.$j][$k] == 2 && $tempWildReels[$j - 1][$k] > 1){
                            $reels['reel'.$j][$k] = 14 + $tempWildReels[$j - 1][$k] - 1;
                        }
                        $lastReel[($j - 1) + $k * 6] = $reels['reel'.$j][$k];
                        $lastTempReel[($j - 1) + $k * 6] = $tempReels['reel'.$j][$k];
                    }
                }
                $strLastReel = implode(',', $lastReel);
                $strLastTempReel = implode(',', $lastTempReel);
                $strReelSa = $reels['reel1'][7].','.$reels['reel2'][7].','.$reels['reel3'][7].','.$reels['reel4'][7].','.$reels['reel5'][7].','.$reels['reel6'][7];
                $strReelSb = $reels['reel1'][-1].','.$reels['reel2'][-1].','.$reels['reel3'][-1].','.$reels['reel4'][-1].','.$reels['reel5'][-1].','.$reels['reel6'][-1];
               
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);

                $_wildValue = [];
                $_wildPos = [];
                $wlm_v = [];
                $wlm_p = [];
                for($r = 0; $r < 7; $r++){
                    for($k = 0; $k < 6; $k++){
                        if($tempWildReels[$k][$r] > 0){
                            array_push($_wildValue, $tempWildReels[$k][$r]);
                            array_push($_wildPos, $r * 6 + $k);
                            if($tempWildReels[$k][$r] > 1){
                                array_push($wlm_v, $tempWildReels[$k][$r]);
                                array_push($wlm_p, $r * 6 + $k);
                            }
                        }
                    }
                }


                $slotSettings->SetGameData($slotSettings->slotId . 'WildValues', $_wildValue);
                $slotSettings->SetGameData($slotSettings->slotId . 'WildPos', $_wildPos);
                $strWildResponse = '';
                if(count($wlm_v) > 0){
                    $strOtherResponse = $strOtherResponse . '&wlm_v=' . implode(',', $wlm_v) . '&wlm_p=' . implode(',', $wlm_p);
                }
                if(count($newWildPoses) > 0){
                    $arr_rwds = [];
                    for($k = 0; $k < count($newWildPoses); $k++){
                        if(isset($arr_rwds[$newWildPoses[$k]]) == false){
                            $arr_rwd[$newWildPoses[$k]] = [];
                            $arr_rwds[$newWildPoses[$k]]['symbol'] = $lastReel[$newWildPoses[$k]];
                            $arr_rwds[$newWildPoses[$k]]['poses'] = [];
                            array_push($arr_rwds[$newWildPoses[$k]]['poses'], $newWildPoses[$k]);
                        }else{
                            array_push($arr_rwds[$newWildPoses[$k]]['poses'], $newWildPoses[$k]);
                        }                        
                    }
                    if($slotEvent['slotEvent'] == 'freespin'){
                        $arr_strRwds = [];
                        foreach( $arr_rwds as $index=>$val ) 
                        {
                            array_push($arr_strRwds, $val['symbol'] . '~' . implode(',', $val['poses']));
                        }
                        $strOtherResponse = $strOtherResponse . '&rwd=' . implode(';', $arr_strRwds);
                    }
                }
                                   
                if($slotSettings->GetGameData($slotSettings->slotId . 'IsBuyFreeSpin') == 1){
                    $strOtherResponse = $strOtherResponse . '&puri=0';
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
                        $spinType = 'c';
                        $strOtherResponse = $strOtherResponse . '&fs_total='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fswin_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&fsmul_total=1&fsres_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                    }
                    else
                    {
                        $strOtherResponse = $strOtherResponse . '&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                    }
                    
                    if($isEnd == true){
                        $strOtherResponse = $strOtherResponse . '&w='.$slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                    }else{
                        $strOtherResponse = $strOtherResponse . '&w='.$totalWin;
                    }
                    if($slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') == 2){
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
                        $strOtherResponse = $strOtherResponse . '&sty='.$strSty;
                    }
                    $response = 'tw='. $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . $strOtherResponse .'&balance='.$Balance.'&index='. $slotEvent['index'] . '&balance_cash='.$Balance.'&is='. $strLastTempReel .'&reel_set='.$n_reel_set.'&balance_bonus=0.00&na='.$spinType.'&stime=' . floor(microtime(true) * 1000).'&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=7'.'&c='.$betline.'&sver=5&counter='. ((int)$slotEvent['counter'] + 1) .'&l=20&s='.$strLastReel.'&fsopt_i='.($slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') - 1) ;
                }else
                {
                    // $_obf_0D5C3B1F210914123C222630290E271410213E320B0A11 = $totalWin;
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                    if($scattersCount >=3 ){
                        $spinType = 'fso';
                        $freeSpins = $slotSettings->GenerateFreeSpinCount($scattersCount);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeOPT', $freeSpins);
                        $strOtherResponse = $strOtherResponse . '&fs_opt_mask=fs,m,msk&fs_opt=' . $freeSpins[0] .',1,0~' . $freeSpins[1] .',1,0';
                        $slotSettings->SetGameData($slotSettings->slotId . 'WildValues', []);
                        $slotSettings->SetGameData($slotSettings->slotId . 'WildPos', []);
                        if($isBuyFreeSpin == true){
                            $strOtherResponse = $strOtherResponse . '&purtr=1';
                        }
                    }else{
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeOPT', [0]);
                    }
                    $response = 'tw='.$totalWin . $strOtherResponse .'&balance='.$Balance.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.'&stime=' . floor(microtime(true) * 1000) . '&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=7&c='.$betline.'&sver=5&reel_set='.$n_reel_set.'&counter='. ((int)$slotEvent['counter'] + 1) .'&l=20&s='.$strLastReel.'&w='.$totalWin;
                }


                if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0)) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeSpinType', 0);
                }
                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')  . ',"FreeSpinType":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType')  . ',"IsBuyFreeSpin":' . $slotSettings->GetGameData($slotSettings->slotId . 'IsBuyFreeSpin') . ',"Balance":' . $Balance . ',"wildValues":'.json_encode($_wildValue) . ',"wildPos":'.json_encode($_wildPos).',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . ',"FreeOPT":'.json_encode($slotSettings->GetGameData($slotSettings->slotId . 'FreeOPT')).',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $_obf_totalWin, $slotEvent['slotEvent']);
                
                if( $scattersCount >= 3) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $Balance);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                }
            }
            else if( $slotEvent['slotEvent'] == 'doFSOption' ){
                $freeSpins = $slotSettings->GetGameData($slotSettings->slotId . 'FreeOPT');
                $lastEvent = $slotSettings->GetHistory();
                $betline = $lastEvent->serverResponse->bet;
                $lines = 20;
                $Balance = $slotSettings->GetBalance();
                $ind = $slotEvent['ind'];
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeSpinType', $ind + 1);
                if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') == 0 ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 1);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $freeSpins[$ind]);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 1);
                }
                else
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $freeSpins[$ind]);
                }
                $response = 'fsmul=1&fs_opt_mask=fs,m,msk&balance='.$Balance.'&fsmax='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na=s&fswin=0.00&stime=' . floor(microtime(true) * 1000) . '&fs=1&fs_opt='.$freeSpins[0].',1,0~'.$freeSpins[1].',1,0&fsres=0.00&sver=5&counter='. ((int)$slotEvent['counter'] + 1) .'&fsopt_i=' . $ind;
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeOPT', [0]);
                $totalWin = 0;
                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')  . ',"FreeSpinType":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinType') . ',"IsBuyFreeSpin":' . $slotSettings->GetGameData($slotSettings->slotId . 'IsBuyFreeSpin') . ',"Balance":' . $Balance . ',"wildValues":'.json_encode($slotSettings->GetGameData($slotSettings->slotId . 'WildValues')) . ',"wildPos":'.json_encode($slotSettings->GetGameData($slotSettings->slotId . 'WildPos')).',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . ',"FreeOPT":'.json_encode($slotSettings->GetGameData($slotSettings->slotId . 'FreeOPT')).',"LastReel":'.json_encode($slotSettings->GetGameData($slotSettings->slotId . 'LastReel')).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, 0, $slotEvent['slotEvent']);
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
        public function findZokbos($reels, $tempWildReels, $mul, $firstSymbol, $repeatCount, $symbolPoses){
            $wild = '2';
            $bPathEnded = true;
            if($repeatCount < 6){
                for($r = 0; $r < 7; $r++){
                    if($firstSymbol == $reels['reel'.($repeatCount + 1)][$r] || $reels['reel'.($repeatCount + 1)][$r] == $wild){
                        if($reels['reel'.($repeatCount + 1)][$r] == $wild){
                            $mul = $mul * $tempWildReels[$repeatCount][$r];
                        }
                        array_push($symbolPoses, $repeatCount + $r * 6);
                        $this->findZokbos($reels, $tempWildReels, $mul, $firstSymbol, $repeatCount + 1, $symbolPoses);
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
                    $winLine['SymbolPoses'] = $symbolPoses;
                    $winLine['WinMoney'] = 0;
                    array_push($this->winLines, $winLine);
                }
            }
        }
    }

}
