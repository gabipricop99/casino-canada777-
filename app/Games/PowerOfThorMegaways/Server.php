<?php 
namespace VanguardLTE\Games\PowerOfThorMegaways
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
            }else if( $slotEvent['slotEvent'] == 'doInit' ) 
            { 
                $lastEvent = $slotSettings->GetHistory();
                $_obf_StrResponse = '';
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 20);                
                $slotSettings->SetGameData($slotSettings->slotId . 'TumbWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'TumbleState', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BuyFreeSpin', -1);
                $slotSettings->SetGameData($slotSettings->slotId . 'Level', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeOPT', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'HammerCount', 0);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [19,8,7,10,12,19,10,7,3,9,5,12,11,9,1,11,12,5,11,9,8,5,12,6,11,9,10,5,19,9,11,9,19,19,19,9,19,9,19,19,19,9,19,19,19,19,19,12]);
                $slotSettings->setGameData($slotSettings->slotId . 'BinaryReel', [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]);
                $slotSettings->SetGameData($slotSettings->slotId . 'ReelSymbolCount', [0, 0, 0, 0, 0, 0]);
                $strTopTmb = '';
                $strMainTmb = '';
                $strWinLine = '';
                if( $lastEvent != 'NULL' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TumbWin', $lastEvent->serverResponse->tumbWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->lines);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', $lastEvent->serverResponse->BonusMpl);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TumbleState', $lastEvent->serverResponse->TumbState);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastEvent->serverResponse->LastReel);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BinaryReel', $lastEvent->serverResponse->BinaryReel);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BuyFreeSpin', $lastEvent->serverResponse->BuyFreeSpin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'ReelSymbolCount', $lastEvent->serverResponse->ReelSymbolCount);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Level', $lastEvent->serverResponse->Level);
                    $slotSettings->SetGameData($slotSettings->slotId . 'HammerCount', $lastEvent->serverResponse->HammerCount);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeOPT', $lastEvent->serverResponse->FreeOPT);
                    $bet = $lastEvent->serverResponse->bet;
                    $strTopTmb = str_replace('|', '"', $lastEvent->serverResponse->strTopTmb);
                    $strMainTmb = str_replace('|', '"', $lastEvent->serverResponse->strMainTmb);                    
                    $strWinLine = $lastEvent->serverResponse->winLines;
                }
                else
                {
                    $bet = $slotSettings->Bet[0];
                }
                $currentReelSet = 0;
                $spinType = 's';
                $bonusMul = $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                if($bonusMul == 0){
                    $bonusMul = 1;
                }else{
                    $currentReelSet = 1;
                }
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
                    $_obf_StrResponse = '&fs=' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .  '&fsres=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&tw=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&w=0.00&fsmul=1&gwm=' . $bonusMul .'&prg='.$bonusMul;
                    $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance') - $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $Balance);
                }else{
                    $Balance = $slotSettings->GetBalance();
                }
                if( $slotSettings->GetGameData($slotSettings->slotId . 'TumbleState') > 0){
                    $_obf_StrResponse = $_obf_StrResponse.'&rs=mc&tmb_win='.$slotSettings->GetGameData($slotSettings->slotId . 'TumbWin').'&rs_p='.($slotSettings->GetGameData($slotSettings->slotId . 'TumbleState') - 1).'&rs_c=1&rs_m=1';
                }else{
                    $freeOPT = $slotSettings->GetGameData($slotSettings->slotId . 'FreeOPT');
                    if($freeOPT > 0){
                        $spinType = 'b';
                        $level = $slotSettings->GetGameData($slotSettings->slotId . 'Level');
                        $freeSpin = $slotSettings->GetFreeSpin($freeOPT - 4 + $level);
                        $bonus_status = [10, 14, 18, 22];
                        $status = [0, 0, 0, 0];
                        for($k = 0; $k < 4; $k++){
                            if($bonus_status[$k] == $freeSpin){
                                $status[$k] = 1;
                            }
                        }
                        //if($level > 0){
                            $_obf_StrResponse = $_obf_StrResponse . '&status=' . implode(',', $status);
                        // }
                        $_obf_StrResponse = $_obf_StrResponse . '&coef='.($bet * 20).'&bgid=0&wins=10,14,18,22&level='.$level.'&bgt=35&lifes=1&wins_mask=nff,nff,nff,nff&wp=0&end=0';
                    }
                }
                $lastReel = $slotSettings->GetGameData($slotSettings->slotId . 'LastReel');
                $lastReelStr = implode(',', $lastReel);
                $topLastReel = [];
                $mainLastReel = [];
                for($k = 0; $k < 48; $k++){
                    if($k > 0 && $k < 5){
                        $topLastReel[$k -1] = $lastReel[$k];
                    }else if($k >= 6){
                        array_push($mainLastReel, $lastReel[$k]);
                    }
                } 
                $response = 'def_s=19,8,7,10,12,19,10,7,3,9,5,12,11,9,1,11,12,5,11,9,8,5,12,6,11,9,10,5,19,9,11,9,19,19,19,9,19,9,19,19,19,9,19,19,19,19,19,12&balance='. $Balance . $strWinLine .'&nas=19&cfgs=1&accm=cp~mp&ver=2&acci=0&index=1&balance_cash='. $Balance .'&reel_set_size=10&balance_bonus=0.00&na='.$spinType.'&accv='. $slotSettings->GetGameData($slotSettings->slotId . 'HammerCount') .'~2&scatters=1~0,0,0,0,0,0~0,0,0,0,0,0~1,1,1,1,1,1&gmb=0,0,0&rt=d&gameInfo={rtps:{purchase:"96.97",regular:"96.55"},props:{max_rnd_sim:"1",max_rnd_hr:"867302",max_rnd_win:"5000",gamble_lvl_2:"70.39%",gamble_lvl_3:"75.02%",gamble_lvl_1:"62.81%"}}&wl_i=tbm~5000&stime=' . floor(microtime(true) * 1000) .'&sc='. implode(',', $slotSettings->Bet) .'&defc=0.10&sh=8&wilds=2~0,0,0,0,0,0~1,1,1,1,1,1&bonuses=0&fsbonus=&st=rect&c='.$bet.$_obf_StrResponse.'&sw=6&sver=5&g={reg:{def_s:"10,7,3,9,5,12,11,9,1,11,12,5,11,9,8,5,12,6,11,9,10,5,19,9,11,9,19,19,19,9,19,9,19,19,19,9,19,19,19,19,19,12",def_sa:"10,5,5,8,6,4",def_sb:"1,9,10,5,11,12",reel_set:"'.($currentReelSet * 2 + 1).'",s:"'. implode(',', $mainLastReel) .'",sa:"10,5,5,8,6,4",sb:"1,9,10,5,11,12",sh:"7",st:"rect",sw:"6"'. $strMainTmb .'},top:{def_s:"12,10,7,8",def_sa:"10",def_sb:"8",reel_set:"'.($currentReelSet * 2).'",s:"'. implode(',', $topLastReel) .'",sa:"10",sb:"8",sh:"4",st:"rect",sw:"1"'. $strTopTmb .'}}&counter=2&paytable=0,0,0,0,0,0;0,0,0,0,0,0;0,0,0,0,0,0;400,200,100,20,10,0;100,50,40,10,0,0;50,30,20,10,0,0;40,15,10,5,0,0;30,12,8,4,0,0;25,10,8,4,0,0;20,10,5,3,0,0;18,10,5,3,0,0;16,8,4,2,0,0;12,8,4,2,0,0;0,0,0,0,0,0;0,0,0,0,0,0;0,0,0,0,0,0;0,0,0,0,0,0;0,0,0,0,0,0;0,0,0,0,0,0;0,0,0,0,0,0&l=20&rtp=96.55,96.97&total_bet_max=10,000.00&reel_set0=6,2,11,12,9,11,10,5,12,5,9,12,4,9,5,7,4,12,4,17,11,14,12,8,2,7,7,12,11,3,8,12,12,5,5,12,9,10,7,9,5,14,16,17,12,10,2,5,17,9,10,4,11,12,9,14,8,2,4,9,9,2,2,8,9,5,7,9,12,9,10,7,12,12,4,17,12,5,5,3,7,12,10,4,11,10,10,7,3,12,7,5,2,7,6,5,18,3,3,4,8,9,9,9,12,12,9,9,12,10,9,9,12,7,5,7,2,9,5,10,9,5,4,10,9,4,9,17,2,7,12,10,12,5,9,10,9,15,12,7,4,4,8,9,7,9,17,3,16,8,4,9,8,17,2,10,5,3,17,2,10,9,9,4,12,12,10,10,18,8,7,12,10,3,9,7,17,7,11,17,2,4,2,4,17,2,12,7,6,3,14,10,9,4,6,12,18,3,9,7,7,10,2,6,12,3,10,10,10,4,8,9,6,16,12,7,3,2,9,6,11,7,4,5,5,12,11,10,4,5,4,9,9,2,15,12,3,4,2,10,10,12,9,2,5,12,7,3,3,9,4,2,3,5,17,2,4,9,4,7,17,9,8,9,12,7,10,12,15,8,7,10,9,3,15,6,7,2,18,17,3,9,5,17,12,4,2,9,12,9,9,3,5,10,12,10,2,4,17,6,2,10,5,16,12,11,8,6,7,7,4,7&s='.$lastReelStr.'&accInit=[{id:0,mask:"cp;mp"}]&reel_set2=2,2,11,3,10,7,8,12,18,5,2,6,12,12,4,11,10,7,2,17,11,10,2,12,4,2,8,16,15,7,10,11,2,11,5,12,9,10,2,8,11,9,6,6,10,10,10,12,12,14,8,6,11,18,10,2,3,2,4,4,7,12,6,8,11,10,7,10,2,13,10,10,14,11,10,2,8,7,6,5,16,8,11,8,10,11,3,4,12,9,11,9,9,9,9,10,9,9,3,17,11,10,8,4,18,9,7,18,7,7,3,11,3,8,9,8,10,12,10,3,2,15,9,10,10,7,13,10,2,11,7,11,11,5,9,12,8,7,9,9,11&t=243&reel_set1=11,11,4,5,10,1,5,11,10,11,10,9,7,5,1,9,8,6,10,5,5,5,12,11,5,10,5,6,5,4,6,4,11,7,11,4,4,9,5,3,11,3,11,10,10,10,10,1,9,8,9,5,5,10,4,7,10,7,4,11,12,5,10,3,5,5,4,11,11,11,10,12,5,11,6,12,11,1,10,5,12,1,4,5,11,7,4,10,1,1,10,4,4,4,11,4,11,5,10,9,8,7,4,4,11,5,5,10,4,10,5,4,7,11,5,8~12,8,9,12,5,12,11,9,12,4,9,6,10,5,9,7,7,9,9,9,1,12,9,9,8,1,5,12,8,10,7,8,6,10,9,10,7,8,8,8,8,10,7,3,12,12,7,7,12,5,7,12,7,9,8,4,4,11,7,7,7,7,7,1,3,12,12,9,5,7,7,9,12,4,4,9,7,9,9,6,12,12,12,12,11,7,7,5,1,9,4,11,8,12,6,11,9,9,8,6,7,8,7~6,6,10,10,9,8,7,8,9,6,4,4,8,6,1,7,12,5,8,5,10,11,11,4,12,8,7,11,10,10,7,6,9,11,8,1,6,12,8,8,12,7,9,11,8,10,7,4,11,3,5,6,6,6,1,1,9,5,4,12,4,5,7,4,10,6,8,7,3,12,4,6,4,5,9,12,5,10,6,4,6,10,6,12,8,6,6,4,10,4,4,5,11,7,3,12,5,9,4,10,6,7,10,4,6,1,4,12~9,4,12,12,11,5,7,4,10,3,10,3,5,10,5,9,5,11,6,9,5,6,3,10,10,10,5,6,4,1,5,3,10,5,6,9,8,10,5,12,5,9,4,9,8,6,5,5,11,8,12,5,5,5,6,6,4,7,9,10,5,10,5,10,10,11,4,8,6,7,6,10,6,3,6,10,3,3,6,6,6,10,5,5,10,7,9,4,5,1,6,5,7,5,7,5,7,10,5,8,7,9,8,9,9,5,9,9,9,5,6,6,8,1,6,9,12,10,10,12,4,10,8,5,5,7,1,12,3,8,6,5,9,12,5~10,5,11,1,11,10,4,8,11,9,8,6,6,12,6,6,5,3,6,5,7,9,12,7,11,3,8,1,6,10,6,9,11,1,6,5,4,11,12,9,4,9,12,4,11,6,9,11,5,11,6,5,8,7,9,11,4,1,10,6,6,6,6,12,5,11,5,6,12,11,12,8,9,6,11,10,6,8,1,5,7,7,9,5,9,7,12,5,10,6,6,4,11,10,10,5,9,9,7,11,6,1,6,6,12,4,12,9,9,6,1,12,7,11,4,1,5,8,12,3,12,5,6,9~8,4,7,9,5,9,5,9,4,4,10,10,9,10,5,10,12,4,9,12,11,7,11,12,12,8,5,10,1,10,7,9,9,9,4,11,10,4,5,8,3,11,9,12,9,5,9,11,8,4,12,5,5,7,12,1,12,12,11,6,11,7,5,11,9,5,12,12,12,10,10,9,9,6,6,12,11,8,11,4,9,3,1,4,6,7,6,9,9,4,11,12,5,9,1,6,7,4,1,12,9,10&reel_set4=10,10,3,12,13,7,12,10,4,3,11,11,8,16,9,12,3,6,2,15,11,8,18,2,11,9,18,12,2,18,3,10,11,18,12,11,7,10,10,18,3,8,9,2,6,17,10,10,9,8,12,12,18,10,18,5,8,11,14,7,10,17,18,8,12,7,4,13,8,7,2,11,10,2,7,5,11,8,10,6,8,9,9,11,7,7,12,5,12,11,9,10,12,12,11,10,7,3,10,10,10,9,11,6,7,8,7,7,14,11,6,11,8,11,10,11,10,12,11,10,10,11,10,12,11,11,4,12,3,2,16,16,2,11,3,11,3,10,5,5,18,10,4,4,3,8,9,10,6,8,18,9,8,2,8,7,8,9,9,13,12,7,9,10,4,7,11,8,11,9,18,11,5,8,16,8,10,6,14,4,3,7,11,3,8,5,10,13,11,10,10,12,4,11,6,4,18,10,7,2,11,9,9,9,11,2,11,8,15,10,18,10,11,2,9,15,4,11,12,5,6,11,9,10,10,9,4,17,7,18,11,14,2,11,8,7,9,7,9,9,12,12,10,3,10,18,5,7,2,9,8,17,11,8,10,2,12,3,7,4,10,11,7,18,11,9,8,8,7,11,11,15,3,11,5,8,9,10,7,10,7,7,6,2,11,7,9,9,10,11,7,3,12,10,10,11,8,9,10,7,9,7,10,4,9&purInit=[{type:"fsbl",bet:2000,bet_level:0}]&reel_set3=10,8,9,9,8,5,12,12,4,12,5,7,8,12,8,5,5,11,9,9,9,9,12,8,5,5,12,12,5,12,9,4,5,9,12,12,8,9,9,8,5,5,5,5,8,12,10,9,8,10,3,7,8,6,5,9,12,8,6,5,8,4,8,8,8,10,9,9,3,10,5,8,5,12,6,7,12,12,8,9,5,7,8,6,12,12,12,9,9,11,7,8,9,7,8,12,12,7,12,11,8,8,9,12,8,5,5,4~9,10,6,10,11,11,6,7,6,8,7,10,10,10,11,4,11,12,7,4,10,7,7,3,4,11,10,4,4,4,9,5,11,5,10,6,12,7,7,8,8,4,7,7,7,7,7,9,12,5,3,7,10,10,8,11,9,11,12,11,11,11,10,11,10,11,7,7,4,10,11,7,10,8,7,11~10,7,6,11,9,5,6,9,12,11,11,9,11,6,4,12,4,8,7,9,12,5,5,4,7,6,4,4,10,8,6,10,12,8,6,6,6,6,6,8,6,9,4,7,9,8,5,9,6,8,11,11,8,8,4,8,9,6,12,7,9,11,4,3,7,6,6,8,10,4,12,12,8~4,12,9,4,9,3,10,3,9,10,10,10,6,12,9,12,11,3,8,12,10,9,12,12,12,12,6,8,7,3,12,12,4,6,7,9,9,9,6,10,9,12,6,11,10,7,5,6,8,12~12,6,10,10,8,3,6,6,12,9,5,11,12,7,11,8,6,4,6,10,5,5,6,10,12,7,12,10,11,8,12,8,10,10,5,11,12,8,3,3,5,6,5,10,9,9,4,12,10,6,12,5,9,8,9,5,7,8,9,6,5,8,6,10,6,11,5,11,7,7,12,10,10,8,10,6,5,12,5,4,7,8,6,4,5,6,12,10,11,8,6,6,5,12,4,8,11,8,5,10,6,11,6,4,12,6,5,11,10,4,10,5,3,6,5,6,6,5,11,11,4,5,11,11,9,9,3,12,6,12,11,11,5,10,6,7,12,10,6,11,11,9,7,12,9,9,12,6,6,5,6,11~4,11,8,8,5,7,9,10,10,10,10,9,8,12,6,3,12,7,9,10,11,11,11,12,10,10,11,5,11,6,11,5,4&reel_set6=12,12,8,10,5,1,12,11,4,8,15,16,10,3,12,7,8,12,9,8,9,3,11,11,10,5,14,9,2,3,7,3,5,10,10,17,7,11,8,12,2,11,10,12,12,12,3,10,7,10,10,11,3,4,9,2,12,10,11,10,7,11,12,7,9,11,7,10,12,11,11,10,8,7,9,12,11,7,5,11,12,14,7,13,10,9,2,13,3,8,5,11,11,11,10,13,3,12,6,10,12,7,4,11,8,12,6,4,11,7,9,12,5,9,12,11,13,9,9,7,9,6,10,2,8,12,7,10,8,8,10,12,9,10,11,2,11,12,1,1,1,1,15,16,8,12,11,17,4,11,9,8,11,7,9,12,3,13,13,11,12,11,10,8,10,12,11,9,6,6,8,11,10,11,7,2,7,7,6,12,11,8,2,3,10,10,4&reel_set5=4,12,9,5,10,6,8,6,8,6,6,12,11,8,11,12,5,9,9,9,9,8,8,10,12,9,7,10,9,8,12,8,8,9,12,12,7,9,8,12,8,12,12,12,12,12,8,4,12,8,6,4,10,11,9,12,9,8,7,6,12,8,12,6,8,8,8,3,6,4,11,8,9,8,8,9,6,12,6,5,7,9,10,9,11,6,5,8~7,12,12,4,9,8,9,12,12,10,9,8,8,11,9,4,8,8,10,9,12,6,8,10,12,5,10,7,8,5,11,11,12,12,6,3,6,9,8,12,8,3,6,8,3,9,12,5,6,12,8,7,8,9,9,6,9,8~8,7,5,4,12,12,5,10,7,12,10,11,6,11,11,10,10,12,5,12,12,8,10,6,7,9,4,12,10,4,11,7,9,10,10,8,12,10,11,9,11,6,10,10,3,9,6,11,4,9,11,8,10,9,12,7,7,7,10,9,10,12,11,5,8,9,3,8,7,7,9,7,6,8,9,9,8,4,9,8,6,11,7,7,8,9,4,10,4,7,5,7,12,4,7,8,10,5,12,6,4,7,6,9,6,7,11,8,10,11,9,7,9,10,4,6~11,8,7,9,7,5,3,9,5,3,12,9,8,4,8,9,12,3,4,12,8,7,7,6,9,11,12,9,12,3,12,9,7,9,7,12,3,12,9,5,5,5,9,10,4,12,9,8,12,4,7,5,12,7,12,7,10,7,5,8,12,11,12,12,8,5,12,3,10,12,11,4,9,3,12,12,9,12,9,7,5,12,12,12,12,12,11,7,11,8,7,7,12,10,8,7,9,7,9,12,3,5,7,7,9,12,4,5,10,12,4,10,7,7,10,7,9,12,12,9,7,3,12,3,4,9,9,9,5,8,5,8,3,3,12,12,10,9,5,3,3,12,5,9,12,11,11,9,3,12,7,7,5,4,8,5,12,11,12,10,7,6,9,10,5,9,4,12,9,12~11,4,6,6,11,9,7,6,7,6,9,5,4,10,10,5,7,8,5,11,12,12,8,12,3,7~11,7,11,6,11,9,6,10,5,11,7,5,11,10,8,11,5,10,9,5,10,6,10,9,12,10,11,6,6,5,8,9,11,3,12,5,4,10,5,9,8,11,5,4,9,10,8,12,11,11,12,11,9,6,11,5,5,5,12,6,5,12,4,9,9,10,10,11,10,11,4,5,6,8,8,5,6,3,11,7,10,11,10,11,5,9,8,5,9,9,6,11,10,12,11,7,5,3,4,6,10,11,8,10,6,8,7,5,9,5,11,5,6,9,11,11,11,8,5,6,9,9,10,12,7,5,8,12,12,4,5,12,9,12,5,8,5,7,4,6,7,7,9,6,12,5,11,10,12,4,10,12,6,10,5,12,5,12,11,4,7,11,11,3,12,5,12,12,10,7,6,12,5,5,6&reel_set8=10,4,3,10,11,12,11,13,7,8,11,12,3,9,9,10,10,11,12,12,10,16,13,3,3,7,12,15,13,10,6,10,16,3,11,7,3,3,2,3,9,12,10,1,9,7,15,12,12,12,12,12,6,4,13,7,5,6,13,11,11,8,7,11,13,15,12,7,4,11,9,14,11,10,15,8,2,12,10,15,10,13,11,16,2,7,4,7,9,4,4,11,2,9,10,8,9,15,11,12,11,12,8,11,11,11,8,5,9,9,6,11,5,8,9,7,6,16,5,2,8,9,11,9,10,14,2,8,12,10,12,7,1,10,10,7,10,7,11,13,14,17,12,12,10,11,13,8,14,7,10,16,7,17,12,10,3,1,1,1,10,5,5,11,7,11,11,8,17,11,8,11,13,17,13,14,12,2,10,9,11,13,3,13,17,7,11,10,5,14,16,8,14,12,16,1,17,9,8,17,4,9,10,11,8,3,9,15,10,2,2,11&reel_set7=8,9,8,10,11,10,8,12,5,9,4,12,12,6,10,9,9,10,12,10,9,6,9,6,7,6,9,8,11,12,8,11,8,9,6,8,12,8,8,6,12,9,9,9,3,8,9,6,11,4,8,5,4,6,8,9,12,8,3,12,8,11,12,12,5,9,8,12,9,7,6,6,9,6,10,12,12,8,9,7,9,6,8,6,11,8,12,12,12,12,9,8,9,11,8,12,9,12,12,8,11,8,6,9,4,8,7,12,10,12,10,12,12,8,12,10,5,6,4,5,4,6,7,9,4,8,8,6,6,12,12,8,8,8,9,12,9,8,12,8,8,5,8,8,6,8,9,12,11,8,6,7,7,9,12,8,8,12,8,11,5,6,12,8,10,6,6,8,12,12,11,10,6,5,9,9,5~5,9,10,8,8,6,12,6,8,8,10,5,12,4,9,11,12,8,12,12,5,8,9,9,11,9,6,8,6,9,12,8,7,7,8,8,3,9,9,4,10,3,11,12,12,10~4,10,9,6,8,8,9,9,6,6,10,10,7,9,7,7,12,11,8,11,11,12,9,10,10,4,7,10,8,3,9,7,5,12,7,8,11,9,11,11,9,5,4,10,10,7,11,10,12,11,10,8,9,10,8,6,10,4,5,7,9,9,4,11,8,4,11,5,4,7,7,7,8,11,6,9,9,4,4,12,6,12,5,9,7,9,3,8,12,10,12,9,6,9,6,6,7,9,7,10,7,7,4,6,12,5,12,9,11,10,10,12,7,10,12,7,5,10,12,8,6,7,11,11,4,8,8,12,7,11,9,10,12,5,8,10,4,9,10,8,6,7,10,7~4,4,12,5,7,5,11,7,9,3,7,12,7,12,12,9,5,10,12,12,7,7,6,8,9,7,5,9,9,12,12,3,7,7,3,11,12,4,11,6,7,5,5,5,7,4,10,12,3,9,4,4,11,12,12,9,8,12,9,9,12,3,12,10,8,12,7,7,12,3,11,7,9,8,9,3,9,7,12,10,9,10,7,4,9,5,12,12,12,12,10,12,8,3,12,9,10,12,4,7,3,7,12,12,9,5,5,11,5,7,3,9,12,9,10,7,7,5,9,5,3,3,12,9,8,12,12,7,3,5,12,9,9,9,8,7,12,3,11,4,7,12,5,12,9,12,7,8,3,3,5,11,5,12,12,9,8,9,8,10,10,12,7,9,12,10,5,8,9,9,4,8,11,12,4,12,5~6,5,7,8,9,12,11,12,5,6,7,11,11,6,5,6,7,8,7,9,5,10,11,5,3,6,6,11,10,8,9,12,8,4,6,7,6,3,11,8,7,7,9,7,7,10,11,4,5,9,5,12,11,5,12,7,11,12,10,10,11,6,4,12,6,7,11,10,5,9,7,7,5,5,7,10,12,7,12,7,5,12,5,4,4,11,11,12,9,6,10,11,7,8,8,5,12,8,7,12,12,11,7,12,3,12,5,4,8,7,11,6,5,6,6,11,6,3,12,12,9,5,3,7,5,9,6,3,11,6,9,7,7,12,8,4,7,10,9,6,6,7,4,6,8,11,5,7,5,8,5,5,7,7,11,7,6,12,6,12,8,8,6,6,5,4,9,11~12,9,11,8,5,7,5,5,6,9,12,4,11,10,6,9,7,6,10,10,6,11,10,8,4,9,9,6,10,10,7,12,9,11,9,5,10,9,11,5,12,5,4,5,11,8,5,10,12,8,9,7,7,11,4,5,5,5,11,11,12,12,5,11,11,3,6,8,12,5,10,5,10,7,5,6,12,11,11,6,7,12,10,8,8,12,4,11,5,10,5,11,11,12,5,10,3,9,12,6,6,11,8,6,5,3,11,5,11,12,6,5,11,10,11,11,11,7,7,6,5,5,6,5,8,10,5,8,12,12,11,11,10,10,12,9,4,9,6,8,11,5,5,6,9,7,10,12,11,4,5,9,5,6,3,4,11,6,5,10,11,4,9,12,5,10,8,7,12,12,9,10,6,9&reel_set9=8,9,5,12,5,12,7,9,7,9,9,9,9,5,11,9,7,12,7,5,7,8,6,12,12,12,12,9,7,12,4,11,12,5,5,3,6,7,7,7,7,10,10,5,4,10,12,7,9,9,12,7~12,7,5,9,7,8,6,3,9,5,8,12,10,12,10,3,7,7,6,12,9,7,7,9,9,5,9,7,7,12,11,7,12,12,6,12,12,5,7,9,12,12,7,10,9,12,6,3,7,9,11,7,8,6,7,9,3,7,5,10,5,12,11,4,12,9,11,12,5,9,7,7,12,9,4,10,8,7,11,10,7,10,9,4,9,5,7~10,8,8,12,9,11,5,4,10,10,6,10,11,7,10,8,4,8,9,10,5,4,8,11,8,9,11,9,7,6,11,8,8,8,8,12,7,12,9,4,8,5,12,9,11,9,4,11,9,10,10,7,4,12,10,8,6,8,12,9,4,4,6,3,5,10,8,7~9,9,10,11,4,8,6,3,12,8,9,7,10,8,10,12,12,8,8,4,12,12,6,11,4,8,4,12,9,11,4,6,8,4,12,12,10,6,6,6,8,9,12,12,3,12,8,8,11,8,9,3,6,8,10,3,3,12,8,9,12,7,6,3,8,9,8,4,9,7,12,9,12,10,3,9,12,3,12,12,12,8,7,7,12,9,12,3,8,3,12,9,7,7,12,8,7,3,9,6,11,12,12,6,12,4,8,9,12,12,3,9,9,10,10,6,10,12,9,9,9,9,12,8,6,5,7,3,8,6,9,6,11,12,9,5,8,12,3,7,12,12,9,12,12,7,9,6,9,6,12,6,8,9,11,4,8,12,12,11,10,4~7,10,11,5,9,6,8,5,12,3,8,8,4,12,7,11,6~11,4,7,11,12,3,5,6,12,6,6,6,12,8,11,6,4,12,10,9,10,6,11,11,11,6,7,5,9,8,11,10,10,9,6,5&total_bet_min=0.01';
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
                $slotEvent['slotLines'] = 20;
                $lines = $slotEvent['slotLines'];
                $betline = $slotEvent['slotBet'];
                $isbuyfreespin = -1;
                if(isset($slotEvent['pur'])){
                    $isbuyfreespin = $slotEvent['pur'];
                }
                $slotSettings->SetGameData($slotSettings->slotId . 'BuyFreeSpin', $isbuyfreespin);
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') <= $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1  && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                {
                    $slotEvent['slotEvent'] = 'freespin';
                }
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
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 < $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotEvent['slotEvent'] == 'freespin' ) 
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
                $allBet = $betline * $lines;
                if($isbuyfreespin == 0 && $slotEvent['slotEvent'] != 'freespin'){
                    $allBet = $betline * 2000;
                    $winType = 'bonus';
                    $_winAvaliableMoney = $slotSettings->GetBank('');
                }else{
                    $_spinSettings = $slotSettings->GetSpinSettings($slotEvent['slotEvent'], $allBet, $lines);
                    $winType = $_spinSettings[0];
                    $_winAvaliableMoney = $_spinSettings[1];
                }
                $isTumb = false;
                $lastReel = null;
                if($slotSettings->GetGameData($slotSettings->slotId . 'TumbleState') > 0){
                    $isTumb = true;
                    $lastReel = $slotSettings->GetLastReel($slotSettings->GetGameData($slotSettings->slotId . 'LastReel'), $slotSettings->GetGameData($slotSettings->slotId . 'BinaryReel'));
                }else{
                    $slotSettings->SetGameData($slotSettings->slotId . 'TumbWin', 0);
                    if($slotEvent['slotEvent'] == 'freespin'){
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TumbWin', 0);
                        $leftFreeGames = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');    
                        $reelSet_Num = rand(2, 4);
                    }else
                    {
                        $reelSet_Num = 0; // rand(0, 2);
                        $slotEvent['slotEvent'] = 'bet';
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                        $slotSettings->SetBalance(-1 * ($allBet), $slotEvent['slotEvent']);
                        $_sum = ($allBet) / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), $_sum, $slotEvent['slotEvent']);
                        $slotSettings->SetGameData($slotSettings->slotId . 'ReelSymbolCount', [0, 0, 0, 0, 0, 0]);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TumbWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Level', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'HammerCount', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                        $leftFreeGames = 0;
                    }
                }
                $bonusMul = 1;
                if($slotEvent['slotEvent'] == 'freespin'){
                    $bonusMul = $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                    if($isTumb == true){
                        $bonusMul++;
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', $bonusMul);
                    }
                }
                $Balance = $slotSettings->GetBalance();
                if( $slotEvent['slotEvent'] == 'bet' ) 
                {
                    $slotSettings->UpdateJackpots($allBet);
                }
                $defaultScatterCount = 0;
                if($winType == 'bonus'){                    
                    $defaultScatterCount = $slotSettings->GenerateScatterCount($slotEvent);
                }
                // $winType = 'win';
                // $_winAvaliableMoney = $slotSettings->GetBank('');
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $totalWin = 0;
                    $this->winLines = [];
                    $wild = '2';
                    $scatter = '1';
                    $_obf_winCount = 0;
                    $strWinLine = '';
                    $winLineMulNums = [];                    
                    $reelSymbolCount = $slotSettings->GetGameData($slotSettings->slotId . 'ReelSymbolCount');
                    $reels = $slotSettings->GetReelStrips($winType, $slotEvent['slotEvent'], $reelSet_Num, $defaultScatterCount, $isTumb, $reelSymbolCount);
                    if($isTumb == true && $lastReel != null){
                        for($r = 0; $r < 6; $r++){
                            for( $k = 0; $k < 8; $k++ ) 
                            {
                                if( $lastReel[$r][$k] > -1 && $lastReel[$r][$k] < 19) 
                                {                                
                                    $reels['reel' . ($r+1)][$k] = $lastReel[$r][$k];
                                }
                            }
                        }
                    }
                    $hammerReel = [0,0,0,0,0,0];
                    $hummerCount = 0;
                    for( $r = 2; $r < 4; $r++ ) 
                    {
                        if($reels['reel' . ($r+1)][0] == 13){
                            if($hummerCount >= 2){
                                $reels['reel' . ($r+1)][0] = rand(7, 12);
                            }else{
                                $hammerReel[$r] = 1;
                                $hummerCount++;
                                if($reels['reel' . ($r+2)][0] != 13 && $hummerCount < 2){
                                    $reels['reel' . ($r+2)][0] = 13;
                                    $hammerReel[$r + 1] = 1;
                                    $hummerCount++;
                                    $r = $r+2;
                                    if($r > 3){
                                        break;
                                    }
                                }
                            }
                        }else{
                            $hummerCount = 0;
                        }
                    }

                    $hammerInitReel = [];
                    if($hummerCount >= 2 && $slotEvent['slotEvent'] == 'freespin'){
                        for($r = 0; $r < 6; $r++){
                            $hammerInitReel[$r] = [];
                            for( $k = 1; $k < 8; $k++ ) 
                            {
                                $hammerInitReel[$r][$k - 1] = $reels['reel' . ($r+1)][$k];
                                if($hammerReel[$r] == 1 && $reels['reel' . ($r+1)][$k] < 19){
                                    $reels['reel' . ($r+1)][$k] = 2;
                                }
                            }
                        }
                    }
                    $binaryReel = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                    $isNewTumb = false;
                    for($r = 0; $r < 8; $r++){
                        if($reels['reel1'][$r] != $scatter && $reels['reel1'][$r] != 19){
                            $this->findZokbos($reels, $reels['reel1'][$r], 1, '~'.($r * 6));
                        }                        
                    }
                    $isHummerFirstSymbol = false;
                    for($r = 0; $r < count($this->winLines); $r++){
                        $winLine = $this->winLines[$r];
                        $winLineMoney = $slotSettings->Paytable[$winLine['FirstSymbol']][$winLine['RepeatCount']] * $betline * $bonusMul;
                        if($winLineMoney > 0){                            
                            if($winLine['FirstSymbol'] == $reels['reel2'][0] && $hummerCount >= 2){
                                $isHummerFirstSymbol = true;
                            }
                            $isNewTumb = true;
                            $strWinLine = $strWinLine . '&l'. $r.'='.$r.'~'.$winLineMoney . $winLine['StrLineWin'];
                            $totalWin += $winLineMoney;
                        }
                    } 
                    $scattersCount = 0;
                    for($r = 0; $r < 6; $r++){
                        for( $k = 0; $k < 8; $k++ ) 
                        {
                            if( $reels['reel' . ($r+1)][$k] == $scatter ) 
                            {                                
                                $scattersCount++;
                            }
                        }
                    }

                    $freeSpinNum = 0;
                    if($slotEvent['slotEvent'] == 'freespin'){
                        if($scattersCount >= 3){
                            $freeSpinNum = 4;
                        }
                    }
                    
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
                        if( $scattersCount >= 4 && ( $winType != 'bonus' || $scattersCount != $defaultScatterCount)) 
                        {
                        }
                        else if($isHummerFirstSymbol == true){

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
                $isEndRespin = false;
                $_obf_totalWin = $totalWin;
                if( $totalWin > 0) 
                {
                    $spinType = 'c';
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), -1 * $totalWin);
                    if($isWelcomeFreespin == 1){
                        $slotSettings->SetWelcomeBonus($totalWin);
                    }
                }
                if($hummerCount >= 2 && $slotEvent['slotEvent'] == 'freespin'){
                    $slotSettings->SetGameData($slotSettings->slotId . 'HammerCount', $slotSettings->GetGameData($slotSettings->slotId . 'HammerCount') + 1);
                }
                $topLastReel = [];
                $mainLastReel = [];
                $reelSymbolCount = [0,0,0,0,0,0];
                for($k = 0; $k < 8; $k++){
                    for($j = 1; $j <= 6; $j++){
                        if($k == 0){
                            // $lastReel[$j - 1] = $reels['reel'.(7 - $j)][$k];
                            $lastReel[$j - 1] = $reels['reel'.$j][$k];
                            if($j > 1 && $j < 6){
                                array_push($topLastReel, $reels['reel'.(7 - $j)][$k]);
                            }
                        }else{
                            $lastReel[($j - 1) + $k * 6] = $reels['reel'.$j][$k];
                            array_push($mainLastReel, $reels['reel'.$j][$k]);
                            if($reels['reel'.$j][$k] == 19 && $reelSymbolCount[$j - 1] == 0){
                                $reelSymbolCount[$j - 1] = $k - 1;
                            }
                        }
                    }
                }
                for($k = 0; $k < 6; $k++){
                    if($reelSymbolCount[$k] == 0){
                        $reelSymbolCount[$k] = 7;
                    }
                }

                for($r = 0; $r < count($this->winLines); $r++){
                    $winLine = $this->winLines[$r];
                    for($i = 0; $i < $winLine['RepeatCount']; $i++){
                        for($j = 0; $j < 8; $j++){
                            if($reels['reel'.($i + 1)][$j] == $winLine['FirstSymbol'] || $reels['reel'.($i + 1)][$j] == 2){
                                if($j == 0){
                                    $binaryReel[5 - $i] = $reels['reel'.($i + 1)][$j];
                                }else{
                                    $binaryReel[$j * 6 + $i] = $reels['reel'.($i + 1)][$j];
                                }
                            }
                        }
                    }
                } 
                if($isTumb == false){
                    $slotSettings->SetGameData($slotSettings->slotId . 'ReelSymbolCount', $reelSymbolCount);
                }
                $strLastReel = implode(',', $lastReel);
                $strReelSa = $reels['reel1'][8].','.$reels['reel2'][8].','.$reels['reel3'][8].','.$reels['reel4'][8].','.$reels['reel5'][8].','.$reels['reel6'][8];
                $strReelSb = $reels['reel1'][-1].','.$reels['reel2'][-1].','.$reels['reel3'][-1].','.$reels['reel4'][-1].','.$reels['reel5'][-1].','.$reels['reel6'][-1];               
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                $slotSettings->SetGameData($slotSettings->slotId . 'BinaryReel', $binaryReel);
                if($isNewTumb == true){
                    $slotSettings->SetGameData($slotSettings->slotId . 'TumbleState', $slotSettings->GetGameData($slotSettings->slotId . 'TumbleState') + 1);
                }else{
                    if( $freeSpinNum > 0 ) 
                    {                        
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $freeSpinNum);
                    }
                }
                $otherResponse = '';
                $n_reel_set = $reelSet_Num;
                $isEnd = false;
                $strHummer = '';
                if( $slotEvent['slotEvent'] == 'freespin' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TumbWin', $slotSettings->GetGameData($slotSettings->slotId . 'TumbWin') + $totalWin);
                    $spinType = 's';
                    $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 && $isNewTumb == false ) 
                    {
                        $isEnd = true;
                        $spinType = 'c';
                        $otherResponse = '&fs_total='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fswin_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsmul_total=1&fsres_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                    }
                    else
                    {
                        $otherResponse = '&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&wmt=pr&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                    }
                    if($hummerCount >= 2){
                        $arr_hummers = [];
                        $arr_initReel = [];
                        $arr_dsa = [];
                        $arr_dsam = [];
                        for($r = 1; $r < 8; $r++){
                            for( $k = 0; $k < 6; $k++ ) 
                            {
                                if($hammerReel[$k] == 1){
                                    if($reels['reel' . ($k+1)][$r] == 2){
                                        array_push($arr_hummers,'2~' . (($r - 1) * 6 + $k));
                                        array_push($arr_dsa, 0);
                                        array_push($arr_dsam, 'v');
                                    }
                                }
                                $arr_initReel[($r - 1) * 6 + $k] = $hammerInitReel[$k][$r - 1];
                            }                            
                        }
                        //;
                        $strHummer = 'ds:"'.implode(';', $arr_hummers).'",dsa:"'.implode(';', $arr_dsa).'",dsam:"'.implode(';', $arr_dsam).'",is:"'.implode(',', $arr_initReel).'",'; 
                    }

                }else
                {
                    // $_obf_0D5C3B1F210914123C222630290E271410213E320B0A11 = $totalWin;
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TumbWin', $slotSettings->GetGameData($slotSettings->slotId . 'TumbWin') + $totalWin);
                    if($scattersCount >=4){
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeOPT', $scattersCount);
                        if($isNewTumb == false){
                            $spinType = 'b';
                            $bonus_status = [10, 14, 18, 22];
                            $freeSpin = $slotSettings->GetFreeSpin($scattersCount - 4);
                            $status = [0, 0, 0, 0];
                            for($k = 0; $k < 4; $k++){
                                if($bonus_status[$k] == $freeSpin){
                                    $status[$k] = 1;
                                }
                            }
                            $otherResponse = $otherResponse . '&coef='.($betline * $lines).'&status='.implode(',', $status).'&bgid=0&wins=10,14,18,22&level=0&bgt=35&lifes=1&bw=1&wins_mask=nff,nff,nff,nff&wp=0&end=0';
                        }
                    }else{
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeOPT', 0);
                    }
                    if($isbuyfreespin == 0){
                        $otherResponse = $otherResponse . '&purtr=1';
                    }
                }
                $strTopTmb = '';
                $strMainTmb = '';
                if($isNewTumb == true){
                    $spinType = 's';
                    $firstsymbolstr = '';
                    for($r = 6; $r < 48; $r++){
                        if($binaryReel[$r] > 0){
                            if($firstsymbolstr == ''){
                                $firstsymbolstr = $binaryReel[$r];
                                $strMainTmb = ',tmb:"'.($r - 6);
                            }else{
                                $strMainTmb = $strMainTmb . ',' . $binaryReel[$r] . '~' . ($r - 6);
                            }
                        }
                    }
                    if($strMainTmb != ''){
                        $strMainTmb = $strMainTmb . ',' . $firstsymbolstr . '"';
                    }
                    $firstTopSymbolStr = '';
                    for($r = 1; $r < 5; $r++){
                        if($binaryReel[$r] > 0){
                            if($firstTopSymbolStr == ''){
                                $firstTopSymbolStr = $binaryReel[$r];
                                $strTopTmb = ',tmb:"'.($r - 1);
                            }else{
                                $strTopTmb = $strTopTmb . ',' . $binaryReel[$r] . '~' . ($r - 1);
                            }
                        }
                    }
                    if($strTopTmb != ''){
                        $strTopTmb = $strTopTmb . ',' . $firstTopSymbolStr . '"';
                    }
                    $otherResponse = $otherResponse.'&rs=mc&tmb_win='.$slotSettings->GetGameData($slotSettings->slotId . 'TumbWin').'&rs_p='.($slotSettings->GetGameData($slotSettings->slotId . 'TumbleState') - 1).'&rs_c=1&rs_m=1';
                }else{
                    if($isTumb == true){
                        if($slotEvent['slotEvent'] != 'freespin' && $scattersCount < 4){
                            $spinType = 'c';
                        }
                        $otherResponse = $otherResponse.'&tmb_res='.$slotSettings->GetGameData($slotSettings->slotId . 'TumbWin').'&rs_t='.$slotSettings->GetGameData($slotSettings->slotId . 'TumbleState').'&tmb_win='.($slotSettings->GetGameData($slotSettings->slotId . 'TumbWin'));
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'TumbleState', 0);
                } 
                if($slotEvent['slotEvent'] == 'freespin'){                    
                    $otherResponse = $otherResponse . '&gwm=' . $bonusMul .'&wmv='.$bonusMul;
                }
                if($isEnd == true){
                    $otherResponse = $otherResponse.'&w='.$slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                }else{
                    $otherResponse = $otherResponse.'&w='.$_obf_totalWin;
                }
                if($slotSettings->GetGameData($slotSettings->slotId . 'BuyFreeSpin') == 0){
                    $otherResponse = $otherResponse.'&puri=0';
                }
                $response = 'tw='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .'&balance='.$Balance.'&index='.$slotEvent['index'].'&accm=cp~mp&acci=0&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinLine.'&stime=' . floor(microtime(true) * 1000) .'&accv='. $slotSettings->GetGameData($slotSettings->slotId . 'HammerCount') .'~2&sh=8&c='.$betline.'&st=rect&sw=6&sver=5'.$otherResponse.'&g={reg:{'.$strHummer.'reel_set:"'. ($reelSet_Num * 2 + 1) .'",s:"'. implode(',', $mainLastReel) .'",sa:"'.$strReelSa.'",sb:"'.$strReelSb.'",sh:"7",st:"rect",sw:"6"'. $strMainTmb .'},top:{reel_set:"'. ($reelSet_Num * 2) .'",s:"'. implode(',', $topLastReel) .'",sa:"6",sb:"9",sh:"4",st:"rect",sw:"1"'. $strTopTmb .'}}&counter='. ((int)$slotEvent['counter'] + 1) .'&l=20&s='.$strLastReel;

                if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0) && $isNewTumb == false) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                }

                if($isNewTumb == false){
                    if( $slotEvent['slotEvent'] != 'freespin' && $scattersCount >= 4) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $Balance);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                    }
                }
                
                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"TumbState":' . $slotSettings->GetGameData($slotSettings->slotId . 'TumbleState') . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .   ',"freeBalance":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance') .  ',"tumbWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'TumbWin') . ',"winLines":"'.$strWinLine.'","Jackpots":""' . ',"FreeOPT":'. $slotSettings->GetGameData($slotSettings->slotId . 'FreeOPT') .  ',"BuyFreeSpin":'.$slotSettings->GetGameData($slotSettings->slotId . 'BuyFreeSpin') .  ',"HammerCount":'.$slotSettings->GetGameData($slotSettings->slotId . 'HammerCount') .  ',"Level":'.$slotSettings->GetGameData($slotSettings->slotId . 'Level') . ',"strTopTmb":"'.str_replace('"', '|', $strTopTmb) . '","strMainTmb":"'.str_replace('"', '|', $strMainTmb) .  '","LastReel":'.json_encode($lastReel). ',"BinaryReel":'.json_encode($slotSettings->GetGameData($slotSettings->slotId . 'BinaryReel')). ',"ReelSymbolCount":'.json_encode($slotSettings->GetGameData($slotSettings->slotId . 'ReelSymbolCount')).'}}';
                $slotSettings->SaveLogReport($_GameLog, $allBet, $lines, $_obf_totalWin, $slotEvent['slotEvent']);
            }
            else if( $slotEvent['slotEvent'] == 'doBonus' ){
                $scattersCount = $slotSettings->GetGameData($slotSettings->slotId . 'FreeOPT');
                $level = $slotSettings->GetGameData($slotSettings->slotId . 'Level');
                $lastEvent = $slotSettings->GetHistory();
                $betline = $lastEvent->serverResponse->bet;
                $strTopTmb = $lastEvent->serverResponse->strTopTmb;
                $strMainTmb = $lastEvent->serverResponse->strMainTmb;
                $strWinLine = $lastEvent->serverResponse->winLines;
                $lines = 20;
                $Balance = $slotSettings->GetBalance();
                $ind = $slotEvent['ind'];
                $isWin = false;
                if($ind == 0){
                    $isWin = true;
                    $freeSpin = $slotSettings->GetFreeSpin($scattersCount - 4 + $level);   
                }else{
                    $level = $level + 1;
                    if(rand(0, 100) < 70){
                        $isWin = true;
                    }
                    $freeSpin = $slotSettings->GetFreeSpin($scattersCount - 4 + $level);   
                }
                $slotSettings->SetGameData($slotSettings->slotId . 'Level', $level);
                $otherResponse = '';
                $spinType = 's';
                $slotSettings->SetGameData($slotSettings->slotId . 'Level', $level);
                if($ind == 0 || $freeSpin == 22){
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') == 0 ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $freeSpin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 1);
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $freeSpins[$ind][1]);
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeOPT', 0);
                    $otherResponse = '&fsmul=1&end=1&lifes=1&fsmax='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fswin=0.00&fs=1&fsres=0.00';
                }else{
                    if($isWin == true){
                        $spinType = 'b';
                        $otherResponse = '&end=0&lifes=1';
                    }else{
                        $spinType = 'c';
                        $otherResponse = '&end=1&lifes=0';
                    }
                }
                $bonus_status = [10, 14, 18, 22];
                $status = [0, 0, 0, 0];
                for($k = 0; $k < 4; $k++){
                    if($bonus_status[$k] == $freeSpin){
                        $status[$k] = 1;
                    }
                }
                $response = 'tw='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').$otherResponse.'&coef='.($betline * $lines).'&bgid=0&balance='.$Balance.'&wins=10,14,18,22&coef=2.00&level='.$slotSettings->GetGameData($slotSettings->slotId . 'Level').'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.'&status='. implode(',', $status) .'&stime=' . floor(microtime(true) * 1000) . '&bgt=35&wins_mask=nff,nff,nff,nff&wp=0&sver=5&counter='. ((int)$slotEvent['counter'] + 1);

                $totalWin = 0;
                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')  . ',"TumbState":' . $slotSettings->GetGameData($slotSettings->slotId . 'TumbleState') . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .   ',"freeBalance":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance') .  ',"tumbWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'TumbWin') . ',"winLines":"'.$strWinLine.'","Jackpots":""' . ',"FreeOPT":'. $slotSettings->GetGameData($slotSettings->slotId . 'FreeOPT') .  ',"BuyFreeSpin":'.$slotSettings->GetGameData($slotSettings->slotId . 'BuyFreeSpin') .  ',"HammerCount":'.$slotSettings->GetGameData($slotSettings->slotId . 'HammerCount') .  ',"Level":'.$slotSettings->GetGameData($slotSettings->slotId . 'Level') . ',"strTopTmb":"'.str_replace('"', '|', $strTopTmb) . '","strMainTmb":"'.str_replace('"', '|', $strMainTmb) .  '","LastReel":'.json_encode($slotSettings->GetGameData($slotSettings->slotId . 'LastReel')). ',"BinaryReel":'.json_encode($slotSettings->GetGameData($slotSettings->slotId . 'BinaryReel')). ',"ReelSymbolCount":'.json_encode($slotSettings->GetGameData($slotSettings->slotId . 'ReelSymbolCount')).'}}';
                
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, 0, $slotEvent['slotEvent']);
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
        public function findZokbos($reels, $firstSymbol, $repeatCount, $strLineWin){
            $wild = '2';
            $bPathEnded = true;
            if($repeatCount < 6){
                for($r = 0; $r < 8; $r++){
                    if($firstSymbol == $reels['reel'.($repeatCount + 1)][$r] || $reels['reel'.($repeatCount + 1)][$r] == $wild){
                        $this->findZokbos($reels, $firstSymbol, $repeatCount + 1, $strLineWin . '~' . ($repeatCount + $r * 6));
                        $bPathEnded = false;
                    }
                }
            }
            if($bPathEnded == true){
                if($repeatCount >= 3){
                    $winLine = [];
                    $winLine['FirstSymbol'] = $firstSymbol;
                    $winLine['RepeatCount'] = $repeatCount;
                    $winLine['StrLineWin'] = $strLineWin;
                    array_push($this->winLines, $winLine);
                }
            }
        }
    }

}
