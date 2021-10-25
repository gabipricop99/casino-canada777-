<?php 
namespace VanguardLTE\Games\PirateGoldDeluxe
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
            $isBuyRespinSpin = false;
            if( isset($slotEvent['pur']) && $slotEvent['pur'] == 0) 
            {
                $isBuyRespinSpin = true;
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
                $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'RespinRepeat', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'RespinMul', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'MoneyValues', [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]);
                $slotSettings->SetGameData($slotSettings->slotId . 'InitMoneyValues', [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]);
                $slotSettings->setGameData($slotSettings->slotId . 'InitRespinReel', [6,7,4,2,8,4,3,5,6,7,8,5,7,3,4,4,3,5,6,7]);
                $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 40);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [6,7,4,2,8,4,3,5,6,7,8,5,7,3,4,4,3,5,6,7]);
                if( $lastEvent != 'NULL' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', $lastEvent->serverResponse->BonusMpl);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastEvent->serverResponse->LastReel);
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', $lastEvent->serverResponse->RespinGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', $lastEvent->serverResponse->CurrentRespinGame);
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinRepeat', $lastEvent->serverResponse->RespinRepeat);
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinMul', $lastEvent->serverResponse->RespinMul);
                    $slotSettings->SetGameData($slotSettings->slotId . 'MoneyValues', $lastEvent->serverResponse->MoneyValues);
                    $slotSettings->SetGameData($slotSettings->slotId . 'InitMoneyValues', $lastEvent->serverResponse->InitMoneyValues);
                    $slotSettings->SetGameData($slotSettings->slotId . 'InitRespinReel', $lastEvent->serverResponse->InitRespinReel);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->lines);
                    $bet = $lastEvent->serverResponse->bet;
                }
                else
                {
                    $bet = $slotSettings->Bet[0];
                }
                $currentReelSet = 0;
                $spinType = 's';
                $_obf_StrResponse = '';
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
                    $_obf_StrResponse = '&fs=' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .  '&fsres=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&tw=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&w=0.00&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . '';
                    $currentReelSet = 1;
                }
                $initMoneyValues = $slotSettings->GetGameData($slotSettings->slotId . 'InitMoneyValues');
                $isRespinSymbol = false;
                $initmoneyTexts = [];
                for($k = 0; $k < count($initMoneyValues); $k++){
                    if($initMoneyValues[$k] > 0){
                        array_push($initmoneyTexts, 'v');
                        $isRespinSymbol = true;
                    }else{
                        array_push($initmoneyTexts, 'r');
                    }
                }
                if($isRespinSymbol == true){
                    $_obf_StrResponse = $_obf_StrResponse . '&mo='. implode(',', $initMoneyValues) .'&mo_t=' . implode(',', $initmoneyTexts);
                }
                $lastReel = $slotSettings->GetGameData($slotSettings->slotId . 'LastReel');
                if(($slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') <= $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') && $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') > 0) || $slotSettings->GetGameData($slotSettings->slotId . 'RespinRepeat') > 0){
                    $respinReel = [];
                    for($k = 0; $k < count($lastReel); $k++){
                        if($lastReel[$k] == 13){
                            $respinReel[$k] = $lastReel[$k];
                        }else{
                            $respinReel[$k] = 14;
                        }
                    }
                    $moneyValues = $slotSettings->GetGameData($slotSettings->slotId . 'MoneyValues');
                    $initMoneyValue = 0;
                    for($i = 0; $i < count($initMoneyValues); $i++){
                        $initMoneyValue = $initMoneyValue + $initMoneyValues[$i];
                    }
                    $moneyTexts = [];
                    $respinwin = 0;
                    for($i = 0; $i < count($moneyValues); $i++){
                        if($moneyValues[$i] == $initMoneyValue){
                            array_push($moneyTexts, 'mo1');
                            $respinwin = $respinwin + $moneyValues[$i];
                        }else if($moneyValues[$i] > $initMoneyValue){
                            array_push($moneyTexts, 'mo2');
                        }else if($moneyValues[$i] == 1){
                            array_push($moneyTexts, 'rt');
                            $respinRepeat = $respinRepeat + 1;
                        }else if($moneyValues[$i] == 2 || $moneyValues[$i] == 3 || $moneyValues[$i] == 5){
                            array_push($moneyTexts, 'm');
                        }else if($moneyValues[$i] == 0){
                            array_push($moneyTexts, 'r');
                        }else{
                            array_push($moneyTexts, 'v');
                        }
                    }
                    $respinwin= $respinwin * $bet * $slotSettings->GetGameData($slotSettings->slotId . 'RespinMul');
                    if($slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') == $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames')){
                        $spinType = 's';
                        $_obf_StrResponse = $_obf_StrResponse . '&tw='. $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&rw='. $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') .'&bpw=0.00&end=1';
                    }else{
                        $spinType = 'b';
                    }
                    $_obf_StrResponse = $_obf_StrResponse . '&rsb_s=13,14&rsb_rt='.$slotSettings->GetGameData($slotSettings->slotId . 'RespinRepeat').'&rsb_m='. $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') .'&rsb_c='.$slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame').'&bmo='.implode(',', $moneyValues).'&bmo_t='.implode(',', $moneyTexts).'&is='.implode(',', $slotSettings->GetGameData($slotSettings->slotId . 'InitRespinReel')).'&sver=5&bpw='.$respinwin.'&rsb_mu='.$slotSettings->GetGameData($slotSettings->slotId . 'RespinMul').'&e_aw=0.00&rs_s=' . implode(',', $respinReel);
                }
                $lastReelStr = implode(',', $lastReel);
                $Balance = $slotSettings->GetBalance();
                
                // $response = 'def_s=6,7,4,2,8,4,3,5,6,7,8,5,7,3,4,4,3,5,6,7&balance='. $Balance . $_obf_StrResponse .'&cfgs=1&ver=2&mo_s=13&index=1&balance_cash='.$Balance.'&reel_set_size=2&def_sb=3,4,7,6,8&mo_v=40,80,120,160,200,240,280,320,400,560,640,720,800,960,2000,8000&def_sa=8,7,5,3,7&mo_jp=2000;8000;40000&balance_bonus=0.00&na='. $spinType .'&scatters=1~0,0,1,0,0~10,10,10,0,0~1,1,1,1,1&gmb=0,0,0&bg_i=2,3,5,2,3,5&rt=d&gameInfo={props:{max_rnd_sim:"1",max_rnd_hr:"62500000",max_rnd_win:"7000"}}&mo_jp_mask=jp3;jp2;jp1&stime=' . floor(microtime(true) * 1000) . '&sa=8,7,5,3,7&sb=3,4,7,6,8&sc='. implode(',', $slotSettings->Bet) .'&defc=0.01&sh=4&wilds=2~0,0,0,0,0~1,1,1,1,1;15~0,0,0,0,0~1,1,1,1,1;16~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&n_reel_set=0&bg_i_mask=bgm,bgm,bgm,fgm,fgm,fgm&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;500,100,20,2,0;500,100,20,2,0;300,50,15,2,0;300,50,15,2,0;200,40,10,2,0;200,40,10,2,0;75,25,5,0,0;75,25,5,0,0;50,15,5,0,0;50,15,5,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0&l=40&rtp=96.50&reel_set0=8,10,3,3,3,3,11,9,8,8,6,6,5,5,7,7,4,4,4,4,9,6,6,13,13,13,10,12,5,5,11,8,8,7,7~11,10,9,1,12,5,5,7,7,6,6,2,2,11,9,7,7,3,3,3,3,10,8,8,6,6,13,13,13,13,4,4,4,4,5,5,8,8~8,10,6,6,7,7,3,3,3,3,1,11,9,5,5,8,8,13,13,13,13,6,6,2,2,11,4,4,4,4,5,5,12,9,8,8,10,7,7~8,11,13,13,13,13,3,3,3,3,10,9,1,12,7,7,7,7,6,6,6,6,2,2,2,2,10,4,4,4,4,5,5,5,5,9,8,8,8,8,11~8,11,9,10,6,6,6,6,2,2,2,2,10,12,4,4,4,4,9,3,3,3,3,13,13,13,13,13,5,5,5,5,11,8,8,8,8,7,7,7,7&s='.$lastReelStr.'&reel_set1=8,10,3,3,3,3,11,9,8,8,6,6,5,5,7,7,4,4,4,4,9,6,6,13,13,13,10,12,5,5,11,8,8,7,7~11,10,9,1,12,5,5,7,7,6,6,2,2,11,15,15,15,15,9,7,7,16,16,16,16,10,8,8,6,6,13,13,13,13,5,5,8,8~8,10,16,16,16,16,6,6,7,7,1,11,9,15,15,15,15,5,5,8,8,13,13,13,13,6,6,2,2,11,5,5,12,9,8,8,10,7,7~8,11,13,13,13,13,10,16,16,16,16,9,1,12,7,7,7,7,6,6,6,6,15,15,15,15,2,2,2,2,10,5,5,5,5,9,8,8,8,8,11~8,11,9,10,6,6,6,6,2,2,2,2,10,16,16,16,16,12,9,13,13,13,13,13,5,5,5,5,11,15,15,15,15,8,8,8,8,7,7,7,7';
                $response = 'def_s=6,7,4,2,8,4,3,5,6,7,8,5,7,3,4,4,3,5,6,7&balance='. $Balance . $_obf_StrResponse .'&cfgs=1&ver=2&mo_s=13&index=1&balance_cash='.$Balance.'&def_sb=3,4,7,6,8&mo_v=2,4,8,12,16,20,40,60,80,100,160,200,240,300,400,1000,4000,20000&reel_set_size=2&def_sa=8,7,5,3,7&reel_set=0&mo_jp=1000;4000;20000&balance_bonus=0.00&na='. $spinType .'&scatters=1~0,0,0~0,0,0~1,1,1&gmb=0,0,0&rt=d&gameInfo={rtps:{purchase:"96.45",regular:"96.48"},props:{max_rnd_sim:"1",max_rnd_hr:"18248200",max_rnd_win:"15000"}}&wl_i=tbm~15000&mo_jp_mask=jp3;jp2;jp1&stime=' . floor(microtime(true) * 1000) . '&sa=8,7,5,3,7&sb=3,4,7,6,8&sc='. implode(',', $slotSettings->Bet) .'&defc=0.10&sh=4&wilds=2~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;250,50,10,2,0;250,50,10,2,0;150,25,10,1,0;150,25,10,1,0;100,20,6,1,0;100,20,6,1,0;40,10,4,0,0;40,10,4,0,0;20,8,4,0,0;20,8,4,0,0;0,0,0,0,0;0,0,0,0,0&l=20&rtp=96.48&total_bet_max=10,000.00&reel_set0=11,8,8,3,9,5,7,5,3,3,3,4,10,6,6,6,4,8,8,10,6,11,7,11,6,13,13,13,10,6,3,11,7,12,6,13,4,4,4~13,13,13,11,3,2,2,2,11,5,10,3,3,3,13,9,3,3,13,9,7,5,13,2,4,4,4,6,9,2,12,8~3,3,3,13,9,7,9,8,4,13,13,13,5,10,12,13,8,8,8,6,2,2,2,4,4,4,5,5,12,5,11,5,2,11,11,10,6,3,12,7,8,8~5,5,5,11,4,4,4,10,7,7,7,13,3,3,3,13,13,13,13,8,8,8,4,5,5,13,4,9,5,11,5,10,9,4,10,2,2,2,12,9,9,6,6,6,8,9,2,10~8,8,8,8,6,6,9,4,7,7,7,9,9,6,9,8,13,13,13,9,12,5,5,5,13,4,4,4,9,3,3,3,11,10,5,9,5,10,9,11,5,3,5,9,4,9,3,11,3,13,6,6,6,2,2,2&s='.$lastReelStr.'&reel_set1=3,7,3,3,3,5,7,5,5,3,3,5,5,3,7,3,7,7,7,5,5,5,3,9,11~8,8,8,10,12,4,6,6,6,6,4,6,4,4,4,6,6,6,4,6,6,4,4,4,4~8,9,10,11,12,4,6,5,7,7,3,3,3,5,4,4,4,5,4,5,7,3,7,4,4,5,5,3,7,4,3,3,7,3,7,7,5,3,7,6~8,8,8,9,10,11,12,6,6,4,4,4,4,7,5,6,4,6,6,6,5,5,5,4,4,4,7,7,7,3,3,3,7,4,6,4,4,3,4,7,4,7,3,4,5,6,7,6,4,5~8,8,8,4,4,4,5,4,3,3,3,6,6,5,7,6,6,3,4,5,5,5,6,3,7,7,6,6,6,5,6,4,5,4,3,6,5,7,7,7,7,6,6,6,4,9,10,11,12&purInit=[{type:"wbg",bet:2000,game_ids:[2]}]&total_bet_min=0.01';
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
                $linesId[1] = [4,4,4,4,4];
                $linesId[2] = [2,2,2,2,2];
                $linesId[3] = [3,3,3,3,3];
                $linesId[4] = [1,2,3,2,1];
                $linesId[5] = [4,3,2,3,4];
                $linesId[6] = [3,2,1,2,3];
                $linesId[7] = [2,3,4,3,2];
                $linesId[8] = [1,2,1,2,1];
                $linesId[9] = [4,3,4,3,4];
                $linesId[10] = [2,1,2,1,2];
                $linesId[11] = [3,4,3,4,3];
                $linesId[12] = [2,3,2,3,2];
                $linesId[13] = [3,2,3,2,3];
                $linesId[14] = [1,2,2,2,1];
                $linesId[15] = [4,3,3,3,4];
                $linesId[16] = [2,1,1,1,2];
                $linesId[17] = [3,4,4,4,3];
                $linesId[18] = [2,3,3,3,2];
                $linesId[19] = [3,2,2,2,3];
                $linesId[20] = [1,1,2,1,1];
                $linesId[21] = [4,4,3,4,4];
                $linesId[22] = [2,2,1,2,2];
                $linesId[23] = [3,3,4,3,3];
                $linesId[24] = [2,2,3,2,2];
                $linesId[25] = [3,3,2,3,3];
                $linesId[26] = [1,1,3,1,1];
                $linesId[27] = [4,4,1,4,4];
                $linesId[28] = [3,3,1,3,3];
                $linesId[29] = [2,2,4,2,2];
                $linesId[30] = [1,3,3,3,1];
                $linesId[31] = [4,2,2,2,4];
                $linesId[32] = [3,1,1,1,3];
                $linesId[33] = [2,4,4,4,2];
                $linesId[34] = [2,1,3,1,2];
                $linesId[35] = [3,4,2,4,3];
                $linesId[36] = [2,3,1,3,2];
                $linesId[37] = [3,2,4,2,3];
                $linesId[38] = [1,3,1,3,1];
                $linesId[39] = [4,2,4,2,4];
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
                $_spinSettings = $slotSettings->GetSpinSettings($slotEvent['slotEvent'], $betline * $lines, $lines);
                $winType = $_spinSettings[0];
                $_winAvaliableMoney = $_spinSettings[1];
                $_moneyValue = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];                
                $slotSettings->SetGameData($slotSettings->slotId . 'JackpotWin', 0);
                if($slotEvent['slotEvent'] == 'freespin'){
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                }
                else
                {
                    $slotEvent['slotEvent'] = 'bet';
                    if($isBuyRespinSpin == true){
                        $slotSettings->SetBalance(-1 * ($betline * $lines * 50), $slotEvent['slotEvent']);
                        $_sum = ($betline * $lines * 50) / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), $_sum, $slotEvent['slotEvent'], true);
                        $winType = 'bonus';
                        $_winAvaliableMoney = $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''));
                    }else{
                        $slotSettings->SetBalance(-1 * ($betline * $lines), $slotEvent['slotEvent']);
                        $_sum = ($betline * $lines) / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), $_sum, $slotEvent['slotEvent'], false);
                    }
                    $bonusMpl = 1;
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinRepeat', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinMul', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                }
                $Balance = $slotSettings->GetBalance();
                if( $slotEvent['slotEvent'] == 'bet' ) 
                {
                    $slotSettings->UpdateJackpots($betline * $lines);
                }
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $totalWin = 0;
                    $lineWins = [];
                    $lineWinNum = [];
                    $wild = '2';
                    $scatter = '1';
                    $moneysymbol = '13';
                    $_obf_winCount = 0;
                    $strWinLine = '';
                    $reels = $slotSettings->GetReelStrips($winType, $slotEvent['slotEvent']);
                    
                    $_lineWinNumber = 1;
                    for( $k = 0; $k < $lines; $k++ ) 
                    {
                        $_lineWin = '';
                        $firstEle = $reels['reel1'][$linesId[$k][0] - 1];
                        $lineWinNum[$k] = 1;
                        $lineWins[$k] = 0;
                        for($j = 1; $j < 5; $j++){
                            $ele = $reels['reel'. ($j + 1)][$linesId[$k][$j] - 1];
                            if($firstEle == $wild || $firstEle >= 15){
                                $firstEle = $ele;
                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                            }else if($ele == $firstEle || $ele == $wild || $ele >= 15){
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
                    
                    
                    $_obf_scatterposes = [];
                    $scattersCount = 0;
                    $scattersWin = 0;
                    
                    $isMoney = false;
                    $moneyCount = 0;
                    $tempMoneyWin = 0;
                    for($r = 0; $r <= 3; $r++){
                        for( $k = 0; $k < 5; $k++ ) 
                        {
                            if( $reels['reel' . ($k+1)][$r] == $moneysymbol) 
                            {
                                $_moneyValue[$r * 5 + $k] = $slotSettings->GetMoneyWin();
                                $tempMoneyWin = $tempMoneyWin + $_moneyValue[$r * 5 + $k];
                                $moneyCount++;
                                $isMoney = true;
                            }else{
                                $_moneyValue[$r * 5 + $k] = 0;
                            }
                        }
                    }
                    $tempMoneyWin = $tempMoneyWin * $betline;
                    $totalWin = $totalWin + $scattersWin; 
                    if( $i > 1000 && $isBuyRespinSpin == false ) 
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
                        if( $i > 2000 && $isBuyRespinSpin == false) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                            exit( $response );
                        }
                        if( ($moneyCount >= 8 && $winType != 'bonus') || $moneyCount > 11 ) 
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
                        else if($totalWin == 0 && $winType == 'bonus' && $moneyCount >= 8){
                            $avaliableMoney = $slotSettings->GetBank('bonus');
                            if($tempMoneyWin < $avaliableMoney){
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
                if($moneyCount >= 8){
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinGames', 3);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinRepeat', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinMul', 0);
                }
                
                $respinReel = [];
                for($k = 0; $k < 4; $k++){
                    for($j = 1; $j <= 5; $j++){
                        $lastReel[($j - 1) + $k * 5] = $reels['reel'.$j][$k];
                        if($moneyCount >= 8){
                            if($reels['reel'.$j][$k] == 13){
                                $respinReel[($j - 1) + $k * 5] = $lastReel[($j - 1) + $k * 5];
                            }else{
                                $respinReel[($j - 1) + $k * 5] = 14;
                            }
                        }
                    }
                }
                $strLastReel = implode(',', $lastReel);
                $strReelSa = $reels['reel1'][4].','.$reels['reel2'][4].','.$reels['reel3'][4].','.$reels['reel4'][4].','.$reels['reel5'][4];
                $strReelSb = $reels['reel1'][-1].','.$reels['reel2'][-1].','.$reels['reel3'][-1].','.$reels['reel4'][-1].','.$reels['reel5'][-1];
                $strFreeSpinResponse = '';
                $isEnd = false;
                if( $slotEvent['slotEvent'] == 'freespin' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    $spinType = 's';
                    $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                    {
                        $spinType = 'c';
                        $isEnd = true;
                        $strFreeSpinResponse = '&fs_total='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fswin_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsmul_total=1&fsres_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&reel_set=0';
                    }
                    else
                    {
                        $strFreeSpinResponse = '&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&reel_set=1';
                    }
                    if($scattersCount >=3 ){
                        $spinType = 's';
                        $strFreeSpinResponse = $strFreeSpinResponse . 'psym=1~'.$totalWin.'~'.implode(',', $_obf_scatterposes);
                    }
                }else
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                    if($scattersCount >=3 ){
                        $spinType = 's';
                        $strFreeSpinResponse = '&reel_set=1&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&fswin=0.00&fs=1&fsres=0.00&psym=1~'.($betline * $lines).'~'.implode(',', $_obf_scatterposes);
                    }else{
                        $strFreeSpinResponse = '&reel_set=0';
                    }
                }
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                
                $strMoneySymbolResponse = '';
                if($isMoney){                    
                    $strMoneySymbolResponse = '&mo=' . implode(',', $_moneyValue);
                    $CurrentMoneyText = [];
                    $moneyWin = 0;
                    for($i = 0; $i < count($_moneyValue); $i++){
                        if($_moneyValue[$i] > 0){
                            $CurrentMoneyText[$i] = 'v';
                            $moneyWin = $moneyWin + $_moneyValue[$i];
                        }else{
                            $CurrentMoneyText[$i] = 'r';
                        }
                    }
                    $moneyWin = $moneyWin * $betline;
                    if( $moneyCount >= 8) 
                    {
                        $spinType = 'b';
                        $strMoneySymbolResponse = $strMoneySymbolResponse . '&bmo='.implode(',', $_moneyValue).'&rsb_s=13,14&rsb_rt=0&rsb_m=3&rsb_c=0&bw=1&bpw='.$moneyWin.'&rsb_mu=0&e_aw=0.00&end=0&bw=1&rs_s=' . implode(',', $respinReel).'&bmo_t='. implode(',', $CurrentMoneyText);
                        $slotSettings->SetGameData($slotSettings->slotId . 'MoneyValues', $_moneyValue);
                        $slotSettings->SetGameData($slotSettings->slotId . 'InitMoneyValues', $_moneyValue);
                        $slotSettings->SetGameData($slotSettings->slotId . 'InitRespinReel', $lastReel);
                    }
                    $strMoneySymbolResponse = $strMoneySymbolResponse . '&mo_t=' . implode(',', $CurrentMoneyText);
                }

                if($isEnd == true){
                    $strFreeSpinResponse = $strFreeSpinResponse.'&w='.$slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                }else{
                    $strFreeSpinResponse = $strFreeSpinResponse.'&w='.$totalWin;
                }
                $response = 'tw='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&balance='.$Balance.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinLine. $strFreeSpinResponse. $strMoneySymbolResponse.'&stime=' . floor(microtime(true) * 1000) .'&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=4&c='.$betline.'&sver=5&counter='. ((int)$slotEvent['counter'] + 1) .'&l=40&s='.$strLastReel;
                


                if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0)) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                }
                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"RespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') . ',"CurrentRespinGame":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame').',"MoneyValues":' . json_encode($_moneyValue) .',"InitMoneyValues":' . json_encode($_moneyValue) . ',"InitRespinReel":' . json_encode($lastReel) . ',"RespinMul":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinMul') . ',"RespinRepeat":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinRepeat') . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . ',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $_obf_totalWin, $slotEvent['slotEvent']);
                
                if( $scattersCount >= 3 && $slotEvent['slotEvent']!='freespin') 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $Balance);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                }
            }
            else if( $slotEvent['slotEvent'] == 'doBonus' ){
                
                $lastEvent = $slotSettings->GetHistory();
                if($lastEvent == 'NULL'){
                    $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                    exit( $response );
                }
                $Balance = $slotSettings->GetBalance();
                $betline = $lastEvent->serverResponse->bet;
                
                $lines = 40;
                if($slotSettings->GetGameData($slotSettings->slotId . 'RespinRepeat') == 0 && $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') >  $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames')) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                    exit( $response );
                }
                $_obf_winType = 0;
                if($slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') == 3 && $slotSettings->GetGameData($slotSettings->slotId . 'RespinRepeat') > 0){
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinRepeat', $slotSettings->GetGameData($slotSettings->slotId . 'RespinRepeat') - 1);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinMul', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'MoneyValues', $slotSettings->GetGameData($slotSettings->slotId . 'InitMoneyValues'));
                    $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $slotSettings->GetGameData($slotSettings->slotId . 'InitRespinReel'));
                }else{
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame') + 1); 
                    if(rand(0, 100) > 50){
                        $_obf_winType = 1;
                    }else{
                        $_obf_winType = 0;
                    }   
                }
                $initMoneyValue = 0;
                $lastMoneyValue = 0;
                $initMoneyValues = $slotSettings->GetGameData($slotSettings->slotId . 'InitMoneyValues');
                $lastMoneyValues = $slotSettings->GetGameData($slotSettings->slotId . 'MoneyValues');
                for($i = 0; $i < count($initMoneyValues); $i++){
                    $initMoneyValue = $initMoneyValue + $initMoneyValues[$i];
                    $lastMoneyValue = $lastMoneyValue + $lastMoneyValues[$i];
                }
                
                
                for($i = 0; $i < 2000; $i++){
                    $totalWin = 0;
                    $isChanged = false;
                    $moneyCount = 0;
                    $moneyValues = $slotSettings->GetGameData($slotSettings->slotId . 'MoneyValues');
                    $respinMul = $slotSettings->GetGameData($slotSettings->slotId . 'RespinMul');
                    $lastReel = $slotSettings->GetGameData($slotSettings->slotId . 'LastReel');
                    $respinRepeat = $slotSettings->GetGameData($slotSettings->slotId . 'RespinRepeat');
                    $totalMoneyValue = $lastMoneyValue;
                    $isTrigerAndMul = false;
                    $trigerAndMul = 0;
                    $respinReel = [];
                    for($k = 0; $k < count($lastReel); $k++){
                        if($lastReel[$k] != 13 && $_obf_winType != 0){
                            $lastReel[$k] = $slotSettings->GetMoneyRise($lastReel[$k]);
                            if($lastReel[$k] == 13){
                                $moneyCount++;
                                $isJackpot = $slotSettings->GetJackpotMoney();
                                if($isJackpot == 0 || $isTrigerAndMul == true){
                                    $moneyValues[$k] = $initMoneyValue;
                                    $totalMoneyValue = $totalMoneyValue + $initMoneyValue;
                                }else if($isJackpot == 6){
                                    $moneyValues[$k] = $totalMoneyValue;
                                    $totalMoneyValue = $totalMoneyValue + $totalMoneyValue;
                                }else{
                                    $isTrigerAndMul = true;
                                    $trigerAndMul = $isJackpot;
                                    $moneyValues[$k] = $isJackpot;
                                }
                                $isChanged = true;
                                $respinReel[$k] = $lastReel[$k];
                            }else{
                                $respinReel[$k] = 14;
                            }
                        }else{
                            if($lastReel[$k] == 13){
                                $respinReel[$k] = 13;    
                            }else{
                                $respinReel[$k] = 14;
                            }
                        }
                    }        
                    $totalWin = $totalMoneyValue * $betline;
                    
                    if($moneyCount == 20){
                        $totalWin = 40000 * $betline;
                    }
                    if($trigerAndMul > 1){
                        $respinMul = $respinMul + $trigerAndMul;
                    }
                    if($respinMul > 0){
                        $totalWin = $totalWin * $respinMul;
                    }
                    
                    if($i > 200){
                        break;
                    }
                    $_winAvaliableMoney = $slotSettings->GetBank('bonus');
                    if($_winAvaliableMoney > $totalWin * ($respinRepeat + 1)){
                        break;
                    }else{
                        if($i > 100){
                            $_obf_winType = 0;
                        }
                    }
                }
                
                $strWinResponse = '';
                $moneyTexts = [];
                $respinwin = 0;
                for($i = 0; $i < count($moneyValues); $i++){
                    if($moneyValues[$i] == $initMoneyValue){
                        array_push($moneyTexts, 'mo1');
                        $respinwin = $respinwin + $moneyValues[$i];
                    }else if($moneyValues[$i] > $initMoneyValue){
                        array_push($moneyTexts, 'mo2');
                    }else if($moneyValues[$i] == 1){
                        array_push($moneyTexts, 'rt');
                        $respinRepeat = $respinRepeat + 1;
                    }else if($moneyValues[$i] == 2 || $moneyValues[$i] == 3 || $moneyValues[$i] == 5){
                        array_push($moneyTexts, 'm');
                    }else if($moneyValues[$i] == 0){
                        array_push($moneyTexts, 'r');
                    }else{
                        array_push($moneyTexts, 'v');
                    }
                }
                if($isChanged == true){
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 0);
                }
                if($moneyCount == 20){
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 3);
                }
                $isEnd = false;
                $strWinResponse = '';
                if($slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') == $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame')){
                    $isEnd = true;
                    if($respinRepeat == 0){
                        $spinType = 'cb';
                    }else{
                        $spinType = 'b';
                    }
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank('bonus', -1 * $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                    $strWinResponse = '&tw='. $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&rw='. $totalWin .'&bpw=0.00&end=1'.'&is='.implode(',', $slotSettings->GetGameData($slotSettings->slotId . 'InitRespinReel'));
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentRespinGame', 3);
                }else{
                    $spinType = 'b';
                    $strWinResponse = '&bpw='.$totalWin.'&end=0';
                    $totalWin = 0;
                }
                
                $response = 'rsb_s=13,14&rsb_rt='.$respinRepeat.'&rsb_m='.$slotSettings->GetGameData($slotSettings->slotId . 'RespinGames').'&balance='.$Balance .'&rsb_c='.$slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame').'&bmo='.implode(',', $moneyValues).'&bmo_t='.implode(',', $moneyTexts).'&index='. $slotEvent['index'] . '&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinResponse.'&stime=' . floor(microtime(true) * 1000) .'&bgt=49&sver=5&rsb_mu='.$respinMul.'&rs_s=' . implode(',', $respinReel).'&e_aw=0.00&counter='. ((int)$slotEvent['counter'] + 1);
                
                $initReel = $slotSettings->GetGameData($slotSettings->slotId . 'InitRespinReel');
                for($k = 0; $k < count($lastReel); $k++){
                    if($moneyValues[$k] < 4 || $moneyValues[$k] == 5){
                        $moneyValues[$k] = 0;
                        $lastReel[$k] = $initReel[$k];
                    }
                }
                
                $slotSettings->SetGameData($slotSettings->slotId . 'RespinMul', $respinMul);
                $slotSettings->SetGameData($slotSettings->slotId . 'MoneyValues', $moneyValues);
                $slotSettings->SetGameData($slotSettings->slotId . 'RespinRepeat', $respinRepeat);
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);

                $_GameLog = '{"responseEvent":"spin","responseType":"Bonus","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"RespinGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinGames') . ',"CurrentRespinGame":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentRespinGame').',"MoneyValues":' . json_encode($moneyValues) .',"InitMoneyValues":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'InitMoneyValues')). ',"InitRespinReel":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'InitRespinReel')) . ',"RespinMul":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinMul') . ',"RespinRepeat":' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinRepeat') . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . ',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $totalWin, 'bonus');
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
