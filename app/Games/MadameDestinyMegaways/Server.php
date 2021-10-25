<?php 
namespace VanguardLTE\Games\MadameDestinyMegaways
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
            $arr_freeMuls = [
                [5,5,5,5,5,5,5,5,8,8,8,8,8,8,8,8,10,10,10,10,10,10,12,12,12,12,12,12],
                [2,3,5,8,10,15,20,25,2,3,5,8,10,15,20,25,2,3,5,8,10,15,2,3,5,8,10,15]
            ];
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
                $slotSettings->SetGameData($slotSettings->slotId . 'DoubleChance', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BuyFreeSpin', -1);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [14,11,7,3,3,14,12,3,11,3,3,3,11,7,3,3,11,9,6,9,10,3,5,12,8,5,4,12,5,4,9,1,4,8,9,10,7,4,10,7,10,9,1,4,8,6,1,12]);
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
                    $slotSettings->SetGameData($slotSettings->slotId . 'DoubleChance', $lastEvent->serverResponse->DoubleChance);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BuyFreeSpin', $lastEvent->serverResponse->BuyFreeSpin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'ReelSymbolCount', $lastEvent->serverResponse->ReelSymbolCount);
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
                    $_obf_StrResponse = '&fs=' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .  '&fsres=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&tw=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&w=0.00&fsmul=1';  
                    if($slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') == 1){
                        $freeSpinIndex = 0;
                        for($k = 0; $k < count($arr_freeMuls[0]); $k++){
                            if($arr_freeMuls[0][$k] == $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $arr_freeMuls[1][$k] == $bonusMul){
                                $freeSpinIndex = $k;
                                break;
                            }
                        }
                        $_obf_StrResponse = $_obf_StrResponse. '&iaw=fs~'.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'~'.$freeSpinIndex.'~5,5,5,5,5,5,5,5,8,8,8,8,8,8,8,8,10,10,10,10,10,10,12,12,12,12,12,12;mul~'.$bonusMul.'~'.$freeSpinIndex.'~2,3,5,8,10,15,20,25,2,3,5,8,10,15,20,25,2,3,5,8,10,15,2,3,5,8,10,15';
                    }else{
                        $_obf_StrResponse = $_obf_StrResponse. '&gwm=' . $bonusMul .'&prg='.$bonusMul;
                    }          
                    
                    $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance') - $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $Balance);
                }else{
                    $Balance = $slotSettings->GetBalance();
                }
                if( $slotSettings->GetGameData($slotSettings->slotId . 'TumbleState') > 0){
                    $_obf_StrResponse = $_obf_StrResponse.'&rs=mc&tmb_win='.$slotSettings->GetGameData($slotSettings->slotId . 'TumbWin').'&rs_p='.($slotSettings->GetGameData($slotSettings->slotId . 'TumbleState') - 1).'&rs_c=1&rs_m=1';
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

                $response = 'def_s=16,5,3,7,11,16,6,9,10,3,5,12,11,7,3,3,11,9,6,9,10,3,5,12,8,5,4,12,5,4,9,5,4,8,9,10,7,4,10,7,10,9,3,4,8,6,7,12&reel_set25=11,9,9,9,10,12,12,12,12,12,7,7,7,10,7,1,5,5,5,3,9,6,4,5,11,11,11,11,10,10,10,10,10,12,4,7,5,7,11,9,7,4,11,10,5,11,9,5,4,10,4,5,10,9,11,5,4,10,12,9,10~8,8,8,8,10,10,12,5,11,6,11,4,1,9,3,7,12,1,11,4,1,7,12,4,12,12,4,12,11,12,12,12,10,5,1,7,10,12,1,11,11,1,10,7,1,3,10,7~4,10,7,10,10,10,8,1,12,12,12,12,11,11,11,11,9,5,3,11,6,10,12,11,3,11,12,12,8,12,8,7,10,12,11,8,10~4,12,8,5,1,11,3,10,6,10,12,9,11,7,11,9,10,11,10,1,11,5,10,9,1,9~7,3,10,1,12,12,9,10,11,5,8,4,6,11,11,3,8,3,11,4,6,4,1,4,10,6,3,4,5,4,6,5,9,11,1,6,11~12,12,10,11,1,9,11,3,6,10,8,5,4,7,3,6,3,10,3,10,3,11,10,3,12,3,6,10,6,10,11,3,11,12,11,10,6,3,10,11,10,10,12,6,11,1,3,10,4&reel_set26=4,3,5,12,6,10,11,9,7,10,8,11,12,9,12,5,10,8,12,12,11,10,8,9,5,10,8,12,12,12,9,6,9,5,12,10&reel_set27=12,3,7,7,7,11,10,6,6,6,6,7,9,9,9,9,10,10,10,11,4,12,8,10,12,12,12,5,1,5,5,5,11,11,11,12,9,3,11,7,1,7,8,1,11,3,9,5,3,5,1,5,7,11,1,9,11,5,11,7,5,7,5,11,5,1,5,11~8,8,8,7,1,10,3,11,4,11,12,10,5,12,6,9,8,12,3,4,12,5,9,3,11,4,5~9,10,3,10,10,10,11,12,12,12,12,1,11,6,10,7,12,5,11,11,11,4,8,10,3,10,12,10,11,10,11,10,12,7,5,8,12,11,8,10,12~12,5,1,4,8,7,10,10,3,11,12,11,6,9,6,4,6,12,10,11,4,10,11,10,10,7,11,10,4,11,1,6,5~11,10,12,4,11,10,5,6,12,8,7,3,1,9,4,12,1,10,12,10,4,6,10,12,10~11,10,5,8,10,12,4,6,12,3,1,9,11,7,10,4,11,12,4,5,4,10,11,9&balance='. $Balance . $strWinLine .'&nas=16&cfgs=1&ver=2&index=1&balance_cash='. $Balance .'&reel_set_size=28&balance_bonus=0.00&na='.$spinType.'&scatters=1~100,20,10,5,0,0~0,0,0,0,0,0~1,1,1,1,1,1&gmb=0,0,0&rt=d&gameInfo={rtps:{ante:"96.67",purchase:"96.67",regular:"96.56"},props:{max_rnd_sim:"1",max_rnd_hr:"1071429",max_rnd_win:"5000"}}&wl_i=tbm~5000&bl='.$slotSettings->GetGameData($slotSettings->slotId . 'DoubleChance').'&stime=' . floor(microtime(true) * 1000) .'&reel_set10=7,9,12,2,10,4,12,5,3,10,11,6,8,11,12,9,11,4,3,10,5,6,3,11,12,10,6,12,10,11,3,2,12,9,3,2,10,11,12,12,11,8,6,10,11,3,2,10,4,3,4,11,5,10,12,10,3,5,8&sc='. implode(',', $slotSettings->Bet) .'&defc=0.10&reel_set11=10,12,6,12,11,4,8,9,5,11,10,7,3,5,3,7,12,7,12,10,8,7,11,5,12,7,10,11,8,10~4,7,5,10,8,12,2,12,10,11,6,9,11,3,12,5,3,10,12,7,8,5,12,10,3,12,3,8,11,7,5,12,10,3,12,5,12,5,12,11,8,11,5,3,7,12,11,12,12,9,12~5,10,7,12,8,4,6,10,11,9,11,2,12,6,8,4,12,9,4,9,6~5,12,10,10,10,11,4,6,10,7,3,2,12,7,10,11,3,12,10,12,3,12,10,12,3,10,12,10,11,7,10,12,10,12,2,12,11,12,11~11,10,9,10,12,2,8,12,11,12,11,2,10,12,10,2,11,12,10,10,8,10~10,7,12,5,11,3,6,2,4,2,7,6&reel_set12=12,9,11,10,4,10,11,8,5,12,7,3,6,3,10,8,10,11,10,11,10,8,10,10,10,4,9,3,4,10,10,8,10,8,11,10,8,3&reel_set13=12,9,9,9,8,6,3,5,5,5,10,4,10,10,10,11,11,11,11,9,11,6,6,6,12,12,12,12,5,7,7,7,1,10,7,10~8,8,8,11,10,11,5,10,3,7,12,12,1,6,4,9,8,6,12,10,12,6,12,11,12,10,12,12,12,10,3,12,12,5,4,3~10,10,10,10,11,11,11,9,12,12,12,12,11,8,1,12,3,5,11,4,6,10,7,11,4,8,4,8~9,12,10,7,8,11,12,4,3,6,5,11,1,10,8,11,10,11,8,10,12,12,11,10,8,12,12,11,8,10,11,11,12,10,11,8,10,1,10,12,11,10,11,10,7,12,8,4,8,10,10~3,12,12,1,10,4,9,10,6,8,11,7,11,5,10,4,12~10,10,7,11,4,6,1,11,8,3,12,9,12,5,1,10,8,3,1,10,1,4,1,5,11,4,11,4,7,1,7,11,12,1,11&sh=8&wilds=2~0,0,0,0,0,0~64,32,16,8,4,2&bonuses=0&fsbonus=&st=rect&c='.$bet.$_obf_StrResponse.'&sw=6&sver=5&g={reg:{def_s:"6,9,10,3,5,12,11,7,3,3,11,9,6,9,10,3,5,12,8,5,4,12,5,4,9,5,4,8,9,10,7,4,10,7,10,9,3,4,8,6,7,12",def_sa:"8,9,11,8,6,10",def_sb:"5,4,7,8,10,12",reel_set:"'.($currentReelSet * 2 + 1).'",s:"'. implode(',', $mainLastReel) .'",sa:"8,9,11,8,6,10",sb:"5,4,7,8,10,12",sh:"7",st:"rect",sw:"6"'. $strMainTmb .'},top:{def_s:"11,7,3,5",def_sa:"11",def_sb:"4",reel_set:"'.($currentReelSet * 2).'",s:"'. implode(',', $topLastReel) .'",sa:"11",sb:"4",sh:"4",st:"rect",sw:"1"'. $strTopTmb .'}}&bls=20,25&reel_set18=6,12,3,11,10,12,7,8,11,5,10,4,9,7,12,9,12,5,12,11&reel_set19=8,12,3,5,11,6,9,9,9,10,4,9,5,5,5,11,1,12,7,10,7,7,7,6,6,6,11,11,11,10,10,10,12,12,12,11,7,9,10,9,10,10,9,10,7,5,7,12,6,11,5,1,7,6,11,6~5,8,8,8,12,4,11,6,10,11,12,7,10,3,9,1,8,1,10,1,8,10,1,10,10,11,1~1,10,10,10,10,12,12,12,7,11,11,11,6,3,8,9,12,11,4,12,10,5,11,11,10,12,10,8~11,8,10,7,12,3,5,11,1,9,12,10,4,6,7,9,1,3,9,1,5,3,12,7,9,5,8,7,3,9,8,10,7,8,9,8,5,8,1,12,3,9,12,9,5,8,1,10,1,8,6,1,9,6,7,3~1,11,10,12,7,8,11,5,4,6,12,3,10,9,7,10,10,8,12,10,9,12,8,9,11,9,10,11,12,9,3,12,5,6,12,10~10,7,8,4,12,3,10,1,6,9,5,11,11,12,1,11,6,5,12,1,11,1,12,8,12,1,3,1,3,12,1,3,1,8,12,12,1,6,1,12,1,11,12,1,8,12,1,10,8,5,6,8,3,11,10,6,8,1,3,11,1&counter=2&reel_set14=4,10,12,12,11,11,6,3,2,5,8,9,10,7,10,8,11,12,11,11,12,11,7,9,11,12,8,12,9,12,11,12,11,9,12,11,12,10,11,9,2,9,12,11,5,2,5,11,2,8,9,8,10,9,12,9,12,9,11,10,12,9,12,9,12,9,12,10,9,11&paytable=0,0,0,0,0,0;0,0,0,0,0,0;0,0,0,0,0,0;400,200,80,40,20,0;75,50,40,20,0,0;40,20,10,6,0,0;30,16,10,6,0,0;25,10,8,4,0,0;25,10,8,4,0,0;20,10,8,4,0,0;20,8,4,2,0,0;20,8,4,2,0,0;20,8,4,2,0,0;0,0,0,0,0,0;0,0,0,0,0,0;0,0,0,0,0,0;0,0,0,0,0,0&l=20&reel_set15=6,10,7,11,12,3,10,11,8,5,9,12,4,3,11,7,10,12,3,11,10,7,12,3,8,10,12,11,7,10,10,5~8,4,9,11,6,12,11,5,2,12,10,10,7,3,11,10,11,10,11,11,7,10,7,9,10,10,10,11,10,11,9,7,11,9,10,12,6,9,10,11,7,11,9,10,10,12,10,12,9,10,6,7,9~9,4,12,12,7,11,6,10,10,8,11,5,2,6~10,10,10,3,10,7,12,2,11,4,6,5,2,12,2,3,2,7,3,7,5,12,2,12,5,3,5,7,12,2,12,3,7,2,5,2,12,2,12,5,7,3,12,4,2,12,2,12,5,12,2,12,2,7,5,12,2,5,12,2,3,4~11,8,10,12,9,11,10,2,12,2,10,11,8,10,8,12,11,2,11,10,12,11,10,2,11,2,12,10,12,12,12,11,2,9,10,11~4,5,12,10,7,11,3,6,2,3,12,10,12,5,2,10,5,3,5,7,3,2,12&reel_set16=12,3,6,11,7,11,5,9,4,10,12,8,10,8,11,3,11,9,11,11,7,8,11,4,3,7&reel_set17=7,7,7,7,3,12,10,10,10,12,11,12,12,12,10,11,11,11,4,1,9,9,9,8,6,6,6,9,5,5,5,10,11,6,5,11,6,9,11,10,5,11,1,8,9~4,8,8,8,5,8,11,9,1,11,3,12,6,10,10,7,12,11,1,12,10,11,12,5,12,10,10,9,5,11,12,11,8,10,1,11,10,8,1~12,12,12,1,10,10,10,5,9,7,3,11,11,11,11,10,12,11,6,8,10,12,4,3,11,10,10,11,10,11,3,11,10,10,1,10,11,11,3,11,11,3,1~3,6,1,11,5,12,8,4,11,9,7,12,10,10,7,1,10,7,8,6,10,12,7,8,6,10,8~11,12,10,7,12,3,4,8,11,10,5,1,6,9,10,12,10,1,9,1,10,7,10,1,10,8,10,4,10,4,7,10,10,12,1,10,4,10,1,4,6,8,1,6,10,7,4,10,10~6,12,9,11,8,10,12,4,7,10,3,1,11,5,10,10,4,8,9,4,8,4,8,10,9,10,10,8,1,10,1,10,4,11,10,9,10,11,9,8,10,8,10&rtp=96.56,96.67,96.67&total_bet_max=10,000.00&reel_set21=6,3,5,4,7,4,7,4,7,3,4,3,7,4,7,4,7,3,4,3,7,4,7,4,3,4,7,3,7~10,9,8,11,12,8,9,8,9,8,9,12,8,9,12,8,9,11,9,11,9,12,11,9,12,11,12,8,12,11,8,12,9,11,8,9,8,12,11,8,12,11,9,12,11,8,11,12,8,11,8,11,9,8,12,9~5,6,3,7,4,6,4,6,4,6,3,4,6,4,3,6,7~4,5,6,7,3,6,7,3,7,3,7,6,7,6~9,10,8,12,11,10,11,8,10,12,10,8,10,11,8,10,11,8,10,8,10,11,10,11,10,11,10,8,11,8,11,10,11,12,8,10,8,11~3,4,6,7,5,4,7,4,7,4,5,7,4,7,4,6,4,5,4,7,5,7,4,7,5,4,7,5,4,6,5,7,4,7,4,7,6,7,4,7,4,5,7,4,7&reel_set22=10,5,10,2,9,3,6,8,12,12,11,7,4,11,10,12,7,11,12,7,4,5,11,5,10,5,11,12,12,12,4,6,3,5,11,8,4,7,6,7,5,8,12,7,11,5,12,11,5,6,12,10,4,12,2,11,3,10,6,5,3,12,4,8,5,11,10,3,4&reel_set0=6,7,12,11,12,9,11,3,10,10,5,8,2,4,2,9,8,4,9,12,2,11,9,10,12,11,8,7,11,4,10,4,2,12,5,8,5,2,8,10,11,2,12,9,8,11,12,8,11,10,5,12,2,10,5,12,4,9,7,5,2,12,11,12,11,5,2,11,3,10,11,7,9,3,5,8,3,9,12,11&reel_set23=5,4,6,10,9,12,7,12,11,8,10,11,12,9,6,8,12,8,9,12,8,10~2,9,12,11,8,5,10,4,7,10,11,6,12,3,8,6,11,12,8,10,6,5,10,4,6~10,9,7,4,6,12,12,8,10,11,11,5,2,4,5,6,11,2,10,6,4,10,2,6,12,2,9,7,8,12,4,5,10~11,5,6,10,10,10,10,2,3,4,7,12,10,2,3,10,5,10,5~12,8,10,11,10,12,2,11,9,11,12,11,10,12,2,12,10,11,2,12,8,10,12,9~7,3,11,2,10,4,6,5,12,5,4,3,5,3,6,10,12,2,12,10,3,12,5,4,10,6,5,10,4,10,4,3,5,10,6,10,6,3,4,6,10,3,5,10,12,3,5,6&s='.$lastReelStr.'&reel_set24=6,7,4,8,11,5,3,11,12,10,9,10,12,10,10,4,3,5,9,8,7,8,3,10,4,12,3,7,10,12,5,10,12,12,8,10,5&reel_set2=8,12,3,6,9,11,5,10,10,11,4,12,7,12,12,11,4,7,11,9,11,4,7,12,3,11,9&t=243&reel_set1=10,12,10,11,5,11,9,3,8,4,12,6,7,3,11,10,12,12,10~3,12,11,9,8,12,10,2,4,10,6,11,7,5,8,10,4,9,2,8,12,11,4,10,8,10,2,11,12,10,6,11,2,4,11,2,11,2,4,2,8,12,6,11,10,5,8,11~8,11,5,7,2,12,11,9,6,10,4,12,10,9,5,9,4,11,11,5,10,12,11,6,4,7,11,4,12,7,6,5,9,11,10,2,10,4,5~2,12,11,10,3,5,4,10,10,10,6,7,10,3,10,4,10~9,8,11,12,11,10,2,12,10,11,11,10,12,11,8,12,11,12,11~5,7,2,4,6,12,10,3,11,4,10,4,6,7,4,6,4,6,7,10,7,4,7,6,11,3,4,6,7,4,6,3,6,11,6,4,6,4,6,3,7,4,10,6,10,6,3&reel_set4=11,6,4,12,8,3,5,7,2,10,11,12,10,9,4,10,8,3,7,6&purInit=[{type:"fsbl",bet:2000,bet_level:0}]&reel_set3=12,12,12,11,6,12,11,8,10,11,11,11,3,1,9,9,9,10,7,7,7,4,6,6,6,7,5,5,5,5,10,10,10,12,9,6,10,1,9,4,11,6,10,7,5,10~8,8,8,9,3,8,4,12,5,1,12,11,10,7,10,6,11,9,5,9,12,11,5,9,11,11,4,7,11,11,12,11,12,4,5,12,11,12,1,12,11,12,10,1,11,12,6,11,12,11~4,10,5,6,11,11,11,9,11,10,10,10,7,12,12,12,3,10,11,12,12,8,1,10,10,12,8,1,8,7,10,3,1,8,12,3,8,12,8,5,8,1,8,9,8,5,8,12~12,3,5,7,6,11,10,8,10,11,12,4,9,1,8,9,5,9,4,11,3,9,5,9,11,5,6,10,11,5,9,10,9,10,11,5,8,9,4,10,9,7,10,9,5,11,12~12,8,4,11,12,1,11,9,10,3,6,7,10,5,11,9,4,6,4,1,8,1,8,11,5,6,11,3,6,8,5,4,10,11,1,3,8,12,6,5,11,6~4,5,12,12,11,6,7,1,3,11,8,10,9,10,10,11,6,11,1,6,9,12,6,11,12,11,3,11,12,6,10,11,11,12,3,12,11,6,11,12,1,3&reel_set20=10,5,6,7,11,4,9,3,8,12,4,7,4,12,4,8,7,6,8,5,11,3,11,7,3,9,4,6,5,4,5,8,7,3,7,4,7,9,5,11,7,11,7,9,8,4,7,4,6,7,4,12,7,8,7,6,11,4,5,3,8&reel_set6=3,12,6,12,9,8,7,11,10,5,4,11,10,8,12,5,12,9,8,4,12,11,5,4,8,12,8,5,9,6,8&reel_set5=5,7,10,6,11,8,9,3,12,11,10,4,12,6,11,7,6,10,6,10,6,12,11,7,3,12,10,4,6,12,6,8,6,12,6,11,4,12,10,6,12,6,11,4,6,4,11,8,3,6,7,6,7,12,11,6,12,6,4~5,12,6,10,9,12,8,11,11,4,7,10,2,3,2,6,10,12,6,7,12,12,10,7,10,8,12,11,6~6,4,2,9,10,5,11,10,12,11,8,7,12,12,7,10,12,7~10,10,10,11,4,2,12,6,5,7,10,3,6,5,12,6,3,4,11,5,12,4,12,6,2,4,2,5,4,6,4,12,7,4,12,5,6,12,6,5,2,5,2,5,4,12,6,4,7,6,11,6,2,6,2,3,6~9,12,12,11,8,10,2,11,10,12,11,8,10,8,2,10,12,8,2,12,2,12,2,10,2,10,8,11,10,10,12,11,2,8,10,10,11,10,12,10,2,10,2,12,10~5,3,10,12,4,6,2,11,7,2,12,6,10,6,7,2,10,2,10,7,10,6,7,11,6,11,4,6,7,11,6,7,10,4,10,11&reel_set8=5,10,8,6,11,3,12,11,4,12,10,7,9,3,6,12,10,12,3,11&reel_set7=9,11,6,6,6,1,10,7,11,12,6,12,12,12,12,10,4,3,8,11,11,11,5,5,5,5,10,10,10,7,7,7,9,9,9,12,5,11~8,8,8,1,8,11,12,9,10,6,12,3,10,11,4,7,5,4,3,5,4,11,10,4,10,3,10,4,3,5,9,7,3,12,4,6,4,3,12,6,4~11,1,12,12,12,12,5,3,9,7,12,10,10,10,4,10,11,11,11,10,8,11,6,10,8,7,12,10,9,8,12,11,10,12,11,8,11,9,12,10,12,5,10,12,5~5,10,4,10,12,12,8,3,1,6,9,11,7,11,11,11,3,11~12,12,11,8,4,5,11,10,10,9,7,1,3,6,4,3,4,3,11,3~7,6,8,4,5,1,11,3,9,11,12,12,10,10,10,3,1,10,9,10,10,10,1,10,4,11,1,11,11,8,11,4,10,10&reel_set9=10,10,10,6,10,4,7,7,7,7,5,5,5,10,6,6,6,8,11,11,11,12,5,1,9,9,9,9,12,12,12,12,11,3,11,5,7,12,4,9,1,5,7,9,5,7,5~11,4,8,8,8,12,10,12,6,11,1,8,10,7,3,5,9,11,4,10,3,10,8,10,3,4,6,3,6,10,4,10,5,8,6,4~10,10,10,8,11,11,11,11,12,6,12,12,12,4,9,3,7,5,12,11,1,10,10,12,7,3,11,11,11,12,11,12,4,6,12,5,11,5~12,11,10,4,10,8,6,9,7,1,5,11,3,12,9,10,9,10,10,8,5,8,10,11,9,11,9,6,10,9,3,11,10,9,11,6,11,7,9,6,7,12,8,3,10~12,1,4,9,3,6,12,10,11,10,11,7,8,5,10,9,3,12,9,8,9,5,9,5,1,5,8,12~12,6,12,9,10,8,10,3,4,11,5,1,7,11,1,8,6,1,4,1,11,6,12,6,9,4,1,6,10,12,6,7,6,7,9,12,1,6,3,6,1,7,6,7,1,9,1,8,7&total_bet_min=0.01';

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
                $isWelcomeFreespin = $slotSettings->GetGameData($slotSettings->slotId . 'IsWelcomeBonus');
                $lines = $slotEvent['slotLines'];
                $betline = $slotEvent['slotBet'];
                $isbuyfreespin = -1;
                if(isset($slotEvent['pur'])){
                    $isbuyfreespin = $slotEvent['pur'];
                }
                $isdoublechance = $slotEvent['bl'];
                $slotSettings->SetGameData($slotSettings->slotId . 'DoubleChance', $isdoublechance);
                $slotSettings->SetGameData($slotSettings->slotId . 'BuyFreeSpin', $isbuyfreespin);
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') <= $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1  && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                {
                    $slotEvent['slotEvent'] = 'freespin';
                }
                if( $slotEvent['slotEvent'] == 'doSpin' || $slotEvent['slotEvent'] == 'freespin' ) 
                {
                    if( $lines <= 0 || $betline <= 0.0001 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid bet state"}';
                        exit( $response );
                    }
                    if($isdoublechance == 1 && $isbuyfreespin == 0){
                        $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid bonus"}';
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
                $reelSet_Num = rand(0, 1);
                $allBet = $betline * $lines;
                if($slotEvent['slotEvent'] == 'freespin'){
                    $reelSet_Num = rand(10, 11);
                        // if($isdoublechance == 1){
                        //     $reelSet_Num = 13;
                        // }
                }else{
                    if($isdoublechance == 1){
                        $allBet = $betline * 25;
                        $reelSet_Num = rand(5, 6);
                    }
                }
                
                if($isbuyfreespin == 0 && $slotEvent['slotEvent'] != 'freespin'){
                    $allBet = $betline * 2000;
                    $winType = 'bonus';
                    $_winAvaliableMoney = $slotSettings->GetBank('');
                }else{
                    $_spinSettings = $slotSettings->GetSpinSettings($slotEvent['slotEvent'], $allBet, $lines);
                    $winType = $_spinSettings[0];
                    $_winAvaliableMoney = $_spinSettings[1];
                }
                if($winType == 'bonus'){
                    $reelSet_Num = rand(8, 9);
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
                        
                    }else
                    {
                        $slotEvent['slotEvent'] = 'bet';
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 1);
                        $slotSettings->SetBalance(-1 * ($allBet), $slotEvent['slotEvent']);
                        $_sum = ($allBet) / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), $_sum, $slotEvent['slotEvent']);
                        $slotSettings->SetGameData($slotSettings->slotId . 'ReelSymbolCount', [0, 0, 0, 0, 0, 0]);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TumbWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                        $leftFreeGames = 0;
                    }
                }
                $bonusMul = 1;
                if($slotEvent['slotEvent'] == 'freespin'){
                    $bonusMul = $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                    // if($isTumb == true){
                    //     $bonusMul++;
                    //     $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', $bonusMul);
                    // }
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
                                if( $lastReel[$r][$k] > -1 && $lastReel[$r][$k] < 16) 
                                {                                
                                    $reels['reel' . ($r+1)][$k] = $lastReel[$r][$k];
                                }
                            }
                        }
                    }
                    $binaryReel = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                    $isNewTumb = false;
                    for($r = 0; $r < 8; $r++){
                        if($reels['reel1'][$r] != $scatter && $reels['reel1'][$r] != 16){
                            $this->findZokbos($reels, $reels['reel1'][$r], 1, '~'.($r * 6), false);
                        }                        
                    }
                    for($r = 0; $r < count($this->winLines); $r++){
                        $winLine = $this->winLines[$r];
                        $winLineMoney = $slotSettings->Paytable[$winLine['FirstSymbol']][$winLine['RepeatCount']] * $betline * $bonusMul;
                        if($winLine['IsWild'] == true){
                            $winLineMoney = $winLineMoney * 2;
                        }
                        if($winLineMoney > 0){                            
                            $isNewTumb = true;
                            $strWinLine = $strWinLine . '&l'. $r.'='.$r.'~'.$winLineMoney . $winLine['StrLineWin'];
                            $totalWin += $winLineMoney;
                        }
                    } 
                    $scattersCount = 0;
                    $scatterPoses = [];
                    for($r = 0; $r < 6; $r++){
                        for( $k = 0; $k < 8; $k++ ) 
                        {
                            if( $reels['reel' . ($r+1)][$k] == $scatter ) 
                            {                                
                                $scattersCount++;
                                array_push($scatterPoses, $k * 6 + $r);
                            }
                        }
                    }
                    $scatterWin = 0;
                    if($scattersCount >= 3){
                        $scatterMuls = [0, 0, 0, 5, 10, 20, 100];
                        $scatterWin = $scatterMuls[$scattersCount] * $betline * $lines;
                        $totalWin = $totalWin + $scatterWin;
                    }
                    $freeSpinIndex = 0;
                    if($scattersCount >= 3){
                        $freeSpinIndex = $slotSettings->GetFreeSpinIndex();
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
                        if($i > 1100 && $isTumb == true && $totalWin < $betline * $lines * 5 && $scattersCount >= 3){
                            break;
                        }
                        else if( $scattersCount >= 3 && ( $winType != 'bonus' || $scattersCount != $defaultScatterCount || $slotEvent['slotEvent'] == 'freespin')) 
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
                $topLastReel = [];
                $mainLastReel = [];
                $reelSymbolCount = [0,0,0,0,0,0];
                for($k = 0; $k < 8; $k++){
                    for($j = 1; $j <= 6; $j++){
                        if($k == 0){
                            $lastReel[$j - 1] = $reels['reel'.$j][$k];
                            if($j > 1 && $j < 6){
                                array_push($topLastReel, $reels['reel'.(7 - $j)][$k]);
                            }
                        }else{
                            $lastReel[($j - 1) + $k * 6] = $reels['reel'.$j][$k];
                            array_push($mainLastReel, $reels['reel'.$j][$k]);
                            if($reels['reel'.$j][$k] == 16 && $reelSymbolCount[$j - 1] == 0){
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
                                    $binaryReel[$i] = $reels['reel'.($i + 1)][$j]; //5 - 
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
                $freeOtherResponse = '';
                if($isNewTumb == true){
                    $slotSettings->SetGameData($slotSettings->slotId . 'TumbleState', $slotSettings->GetGameData($slotSettings->slotId . 'TumbleState') + 1);
                }else{
                    if( $scattersCount >= 3 ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', $arr_freeMuls[1][$freeSpinIndex]);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $arr_freeMuls[0][$freeSpinIndex]);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 1);
                        
                    }
                }
                $otherResponse = '';
                $n_reel_set = $reelSet_Num;
                $isEnd = false;
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
                        $otherResponse = '&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                    }
                    $otherResponse = $otherResponse . '&prg_m=wm';
                }else
                {
                    // $_obf_0D5C3B1F210914123C222630290E271410213E320B0A11 = $totalWin;
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TumbWin', $slotSettings->GetGameData($slotSettings->slotId . 'TumbWin') + $totalWin);
                    if($scattersCount >=3){
                        if($isNewTumb == false){
                            $spinType = 's';
                            $otherResponse = $otherResponse . '&fsmul=1&fsmax='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fswin=0.00&fs=1&iaw=fs~'.$arr_freeMuls[0][$freeSpinIndex].'~'.$freeSpinIndex.'~5,5,5,5,5,5,5,5,8,8,8,8,8,8,8,8,10,10,10,10,10,10,12,12,12,12,12,12;mul~'.$arr_freeMuls[1][$freeSpinIndex].'~'.$freeSpinIndex.'~2,3,5,8,10,15,20,25,2,3,5,8,10,15,20,25,2,3,5,8,10,15,2,3,5,8,10,15&fsres=0.00&psym=1~'.$scatterWin.'~'. implode(',', $scatterPoses);
                        }
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
                        if($slotEvent['slotEvent'] != 'freespin' && $scattersCount < 3){
                            $spinType = 'c';
                        }
                        $otherResponse = $otherResponse.'&tmb_res='.$slotSettings->GetGameData($slotSettings->slotId . 'TumbWin').'&rs_t='.$slotSettings->GetGameData($slotSettings->slotId . 'TumbleState').'&tmb_win='.($slotSettings->GetGameData($slotSettings->slotId . 'TumbWin'));
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'TumbleState', 0);
                } 
                if($slotEvent['slotEvent'] == 'freespin'){                    
                    $otherResponse = $otherResponse . '&gwm=' . $bonusMul .'&prg='.$bonusMul;
                }
                if($isEnd == true){
                    $otherResponse = $otherResponse.'&w='.$slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                }else{
                    $otherResponse = $otherResponse.'&w='.$_obf_totalWin;
                }
                if($slotSettings->GetGameData($slotSettings->slotId . 'BuyFreeSpin') == 0){
                    $otherResponse = $otherResponse.'&puri=0';
                }
                $response = 'tw='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .'&balance='.$Balance.'&bl='.$isdoublechance.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinLine.'&stime=' . floor(microtime(true) * 1000) .'&sh=8&c='.$betline.'&st=rect&sw=6&sver=5'.$otherResponse.'&g={reg:{reel_set:"'. ($reelSet_Num * 2 + 1) .'",s:"'. implode(',', $mainLastReel) .'",sa:"'.$strReelSa.'",sb:"'.$strReelSb.'",sh:"7",st:"rect",sw:"6"'. $strMainTmb .'},top:{reel_set:"'. ($reelSet_Num * 2) .'",s:"'. implode(',', $topLastReel) .'",sa:"6",sb:"9",sh:"4",st:"rect",sw:"1"'. $strTopTmb .'}}&counter='. ((int)$slotEvent['counter'] + 1) .'&l=20&s='.$strLastReel;

                if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0) && $isNewTumb == false) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                }

                if($isNewTumb == false){
                    if( $slotEvent['slotEvent'] != 'freespin' && $scattersCount >= 3) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $Balance);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                    }
                }
                
                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"TumbState":' . $slotSettings->GetGameData($slotSettings->slotId . 'TumbleState') . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .   ',"freeBalance":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance') .  ',"tumbWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'TumbWin') . ',"winLines":"'.$strWinLine.'","Jackpots":""' . ',"DoubleChance":'.$slotSettings->GetGameData($slotSettings->slotId . 'DoubleChance'). ',"FreeOPT":'. $slotSettings->GetGameData($slotSettings->slotId . 'FreeOPT') .  ',"BuyFreeSpin":'.$slotSettings->GetGameData($slotSettings->slotId . 'BuyFreeSpin') . ',"strTopTmb":"'.str_replace('"', '|', $strTopTmb) . '","strMainTmb":"'.str_replace('"', '|', $strMainTmb) .  '","LastReel":'.json_encode($lastReel). ',"BinaryReel":'.json_encode($slotSettings->GetGameData($slotSettings->slotId . 'BinaryReel')). ',"ReelSymbolCount":'.json_encode($slotSettings->GetGameData($slotSettings->slotId . 'ReelSymbolCount')).'}}';
                $slotSettings->SaveLogReport($_GameLog, $allBet, $lines, $_obf_totalWin, $slotEvent['slotEvent']);
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
        public function findZokbos($reels, $firstSymbol, $repeatCount, $strLineWin, $isWild){
            $wild = '2';
            $bPathEnded = true;
            if($repeatCount < 6){
                for($r = 0; $r < 8; $r++){
                    if($firstSymbol == $reels['reel'.($repeatCount + 1)][$r] || $reels['reel'.($repeatCount + 1)][$r] == $wild){
                        if($reels['reel'.($repeatCount + 1)][$r] == $wild){
                            $isWild = true;
                        }
                        $this->findZokbos($reels, $firstSymbol, $repeatCount + 1, $strLineWin . '~' . ($repeatCount + $r * 6), $isWild);
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
                    $winLine['IsWild'] = $isWild;
                    array_push($this->winLines, $winLine);
                }
            }
        }
    }

}
