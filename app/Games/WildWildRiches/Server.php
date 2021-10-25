<?php 
namespace VanguardLTE\Games\WildWildRiches
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
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 25);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [7,8,6,11,11,7,7,6,8,11,2,9,6,8,11,13,13,6,8,3]);
                $slotSettings->SetGameData($slotSettings->slotId . 'DoubleChance', 0);
                $_moneyValue = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                if( $lastEvent != 'NULL' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', $lastEvent->serverResponse->BonusMpl);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastEvent->serverResponse->LastReel);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->lines);
                    $slotSettings->SetGameData($slotSettings->slotId . 'DoubleChance', $lastEvent->serverResponse->DoubleChance);
                    $_moneyValue = $lastEvent->serverResponse->MoneyValue;                    
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
                    $_obf_StrResponse = '&fs=' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .  '&fsres=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&tw=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&w=0.00&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . '';
                    $currentReelSet = 2;
                }
                $_obf_StrResponse = $_obf_StrResponse . '&mo=' . implode(',', $_moneyValue);
                $CurrentMoneyText = $slotSettings->GetMoneyText($_moneyValue);
                $_obf_StrResponse = $_obf_StrResponse . '&mo_t=' . implode(',', $CurrentMoneyText). '&bl=' . $slotSettings->GetGameData($slotSettings->slotId . 'DoubleChance');
                $lastReelStr = implode(',', $slotSettings->GetGameData($slotSettings->slotId . 'LastReel'));
                $Balance = $slotSettings->GetBalance();
                
                $response = 'def_s=7,8,6,11,11,7,7,6,8,11,2,9,6,8,11,13,13,6,8,3&balance='. $Balance .'&nas=13&cfgs=1&ver=2&mo_s=12&index=1&balance_cash='. $Balance .'&def_sb=10,2,1,5,3&mo_v=25,50,75,100,125,150,200,250,375,625,1250,2500,12500&reel_set_size=3&def_sa=4,8,11,12,11&reel_set='.$currentReelSet.$_obf_StrResponse.'&mo_jp=1250;2500;12500&balance_bonus=0.00&na=s&scatters=1~0,0,0,0,0~0,0,0,0,0~1,1,1,1,1&gmb=0,0,0&rt=d&gameInfo={props:{max_rnd_sim:"1",max_rnd_hr:"31250000",max_rnd_win:"3000"}}&bl=0&mo_jp_mask=jp3;jp2;jp1&stime=' . floor(microtime(true) * 1000) .'&sa=4,8,11,12,11&sb=10,2,1,5,3&sc='. implode(',', $slotSettings->Bet) .'&defc=0.10&sh=4&wilds=2~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&bls=25,30&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;200,75,50,0,0;100,50,20,0,0;50,25,10,0,0;25,10,8,0,0;20,8,4,0,0;15,8,4,0,0;10,5,2,0,0;10,5,2,0,0;10,5,2,0,0;0,0,0,0,0;0,0,0,0,0&l=25&rtp=96.00,96.77&total_bet_max=150.00&reel_set0=11,11,11,5,5,8,8,3,9,8,8,5,5,7,6,6,9,9,2,10,9,8,6,6,7,7,5,5,10,6,10,11,2,8,8,9,4,4,7,10,10,7,10,4,7,7,5,5,11,5,11,11,9,9,11,2,7,11,7,7,6,6,11,10,10,2,10,4,4,11,6,11,4,11,9,9,3,3,11,9,2,11,8,9,11,7,9,9,10,3,3,10,9,8,10,8,8,2,8,9,4,9,8,8,2,8,4,4,10,9,7,10,7,7,2,7,5,5,11,11,5,5,10,10,7,2,7,7,6,7,10,6,6,10,10,2,4,10,9,4,11,11,7,8,8,3,3,11,5,7,7,6,9,6,10,4,10,10,6,10,4,11,3,11,11,4,11,9,9,3,9,8,9,11,9,9,11,9,9,3,8,7,9,10,7,8,10,5,10,9,8,2,10,11,7,8,9,4,10,8,5,10,7,10~7,7,8,8,5,5,7,7,2,8,8,11,11,3,5,9,4,11,6,11,11,9,2,6,10,3,9,6,6,8,8,11,9,9,6,6,10,10,7,5,5,10,7,11,11,11,2,9,9,5,5,7,9,6,6,7,7,4,7,7,9,6,8,2,9,8,8,3,6,9,11,10,11,2,9,9,6,10,2,10,10,6,6,4,4,7,2,7,7,4,4,6,6,10,10,2,10,10,11,11,11,3,11,10,9,5,4,9,5,3,11,8,9,2,11,3,6,10,11,7,10,2,7,8,9~11,10,3,11,4,12,12,12,12,10,11,6,6,6,6,1,7,10,3,3,3,3,10,7,10,9,9,10,12,10,9,12,12,6,8,12,12,8,11,3,3,3,3,12,7,5,5,12,11,3,4,11,7,8,3,10,9,9,5,4,7,12,12,7,3,3,10,6,11,1,7,4,5,3,3,3,7,12,12,12,10,7,10,10,4,5,3,3,3,7,12,12,12,12,8,12,12~7,7,12,12,12,12,6,6,11,11,11,12,12,7,7,12,12,4,4,9,9,12,6,6,6,6,12,12,10,10,12,8,8,4,4,4,12,12,12,10,8,8,8,5,5,5,5,10,10,10,12,12,12,3,3,8,8,8,12,12,9,9,9,9,11,11,11,5,5,5,5,12,12,12,12,4,4,4,4,7,7,7,7,6,6,6,12,12,9,9,12,12,12,4,4,11,11,11,12,12,6,6,6,8,8,12,12,3,3,3,3,8,8,12,12,12,7,12,12,5,5,5,5,7,7,7,12,12,8,8,8,12,12,12,10,8,12,12,12,12,8,5,6,7,3,8,5,4,8,3,6,8,3,5,6,9,11,12,12,12,7,4,7,5,8,7,3,8,5,6,3,8,10,9,6,8,4,7,11,6,5,11,6,3,8,9,7,5,9,12,12,12,12,12,12,12,12,9,5,6,9~11,11,11,11,3,3,3,3,8,8,8,8,10,10,10,9,9,9,9,12,12,12,12,4,4,4,4,7,7,7,7,9,5,9,11,8,5,10,11,7,10,12,12,4,4,12,12,9,9,7,7,7,5,5,5,5,12,12,12,12,12,12,10,11,11,11,3,11,10,9,5,4,9,11,7,6,11,10,3,8,11,3,9,12,12,12,12,11,10,9,11,8,5,10,11,7,10,8,12,12,12,12,12,12,12,12,5,9,9,9,9,7,7,7,7,12,12,12,12,10,10,11,11,11,3,11,10,9,5,4,9,11,7,6,11,10,3,8,11,12,12,12,12,3,6,11,10,9,11,8,5,10,11,7,10,9,4,8,10,9,6,10,9,11,12,12,8,11,9,4,12,12,12,12,7,8,10,7,8,6,5,8,12,12,12,12,12,12,12,5,9,3,10,9,5,12,12,12,12,12,12&s='.$lastReelStr.'&reel_set2=11,11,11,5,5,8,10,10,2,8,8,5,5,2,6,6,8,9,2,8,9,8,6,6,7,7,5,5,2,6,10,5,7,11,7,7,6,6,10,11,10,2,10,4,4,11,6,11,4,11,2,9,3,3,11,9,2,11,3,9,11,3,9,10,9,3,3,10,9,2,10,8,8,2,8,9,4,9,8,8,2,8,4,4,10,9,7,2,7,7,2,7,5,5,11,2,5,5,10,10,7,2,7,7,6,7,2,6,6,10,10,2,4,10,9,4,11,11,3,11,2,3,3,8,5,9,7,6,2,6,10,4,10,10,6,10,4,11,3,11,11,4,11,3,2,3,9,8,9,11,9,2,11,9,9,3,8,3,9,10,7,2,10,5,10,9,8,2,10,11,7,8,9,4,10,2,5,10,7,10~7,7,2,8,5,5,7,7,2,8,8,11,2,11,5,9,9,2,6,11,11,9,2,6,10,10,2,6,6,8,8,5,7,4,7,2,9,6,8,2,8,9,8,3,3,2,9,11,11,2,9,3,9,10,2,10,10,6,2,4,4,7,2,7,7,4,4,6,6,10,10,2,10,10,11,2,11,3,11,10,2,5,4,9,3,3,11,8,9,2,11,3,6,10,11,7,10,2,7,8,9~11,10,3,11,4,12,12,12,12,10,11,6,6,6,6,1,7,10,7,3,3,3,10,7,10,9,9,12,12,12,9,10,9,1,5,4,7,12,12,7,3,3,10,6,11,1,7,4,5,3,3,3,7,12,12,12,12,12,12,12,10,7,10,12,12,12,12,10,4,5,3,3,3,7,12,12,12,12,8,12,12~7,7,12,12,12,12,6,6,11,11,11,12,12,7,7,12,12,4,4,9,9,12,6,6,6,6,12,12,10,10,12,12,8,8,12,12,9,9,11,11,11,5,5,5,5,12,12,12,12,10,10,10,4,4,4,4,7,12,7,7,6,6,6,12,12,9,9,9,9,12,12,12,4,4,12,11,11,12,12,6,6,6,8,8,12,12,3,3,3,3,8,8,12,12,12,7,12,12,5,5,5,5,7,7,7,12,12,8,8,8,12,12,12,10,8,12,12,12,12,8,5,6,7,3,8,5,4,8,3,6,8,3,5,6,9,11,12,12,12,7,4,7,5,8,7,3,8,5,6,3,8,10,9,6,8,4,7,11,6,5,11,6,3,8,9,7,5,9,12,12,12,12,12,12,12,12,9,5,6,9~11,11,11,11,3,3,3,3,8,8,8,8,10,10,10,9,9,9,9,12,12,12,12,4,4,4,4,7,7,7,7,12,12,12,12,12,12,12,10,11,11,11,3,11,12,9,5,4,12,11,7,6,11,10,3,8,11,3,9,12,12,12,12,11,10,9,11,8,5,10,11,7,10,8,12,12,12,12,12,12,12,12,5,5,5,5,9,9,9,12,12,7,7,7,12,12,12,12,10,10,11,11,11,3,11,10,9,5,4,9,11,7,6,11,10,3,8,11,12,12,12,12,3,6,11,10,9,11,8,5,10,11,7,10,9,4,8,10,9,6,10,9,11,12,12,8,11,9,4,12,12,12,12,7,8,10,7,8,6,5,8,12,12,12,12,12,12,12,5,9,3,10,9,5,12,12,12,12,12,12&t=243&reel_set1=5,2,9,7,2,11,11,3,2,9,8,2,7,6,2,7,10,2,4~8,2,8,3,2,10,10,2,11,2,8,11,2,9,9,4,2,6,5,10,2,10,9,2,11,10,2,7~11,11,3,11,4,12,12,12,12,10,10,10,6,6,6,6,9,9,7,7,7,1,12,12,10,10,10,12,12,12,12,8,8,8,8,11,11,12,12,12,12,4,4,12,12,3,6,12,12,12,8,11,9,3,3,3,12,12,5,5,12,12,3,4,11,7,8,3,10,9,5,5,4,12,12,12,12,3,11,8,6,6,5,3,10,6,11,7,7,4,5,3,3,3,7,12,12,12,12,12,12,12~7,7,12,12,12,12,6,6,11,6,6,6,6,12,12,10,10,12,12,5,5,8,8,8,8,3,3,3,11,11,12,12,12,9,9,9,12,12,4,4,4,12,12,12,10,8,8,8,5,5,5,5,10,10,10,12,12,12,3,3,8,8,8,12,12,9,9,11,11,11,5,5,5,5,12,12,12,12,4,4,4,4,12,7,7,7,6,6,6,12,12,9,9,12,12,12,4,4,11,11,11,12,12,6,6,6,8,8,12,12,3,3,3,3,8,8,12,12,12,12,12,12,5,5,5,5,7,7,7,12,12,8,8,8,12,12,12,12,12,12,12,12,12,8,5,6,7,3,8,5,4,8,3,6,8,3,5,6,9,11,12,12,12,12,4,7,5,8,7,3,8,5,6,3,8,10,9,6,8,4,7,11,6,5,11,6,3,8,9,7,5,9,12,12,12,12,12,12,12,12,9,5,6,9~11,11,11,11,3,3,3,3,8,12,4,4,4,4,7,7,7,7,12,9,9,9,5,5,5,5,7,7,7,12,11,11,11,12,12,12,11,10,9,11,8,8,8,8,5,10,11,12,12,12,12,4,4,12,12,12,9,7,7,7,5,5,5,5,12,12,12,12,12,12,10,11,11,11,3,11,10,9,5,4,9,11,7,6,11,10,3,8,11,3,9,12,12,12,12,11,10,9,11,8,5,10,11,7,10,10,10,8,12,12,12,12,12,12,12,12,5,9,9,9,9,7,7,7,7,12,12,12,12,10,10,11,11,11,3,11,10,9,5,4,9,11,7,6,11,10,3,8,11,12,12,12,12,3,6,11,10,9,11,8,5,10,11,7,10,9,4,8,10,9,6,10,9,11,12,12,8,11,9,4,12,12,12,12,7,8,10,7,8,6,5,8,12,12,12,12,12,12,12,5,9,3,10,9,5,12,12,12,12,12,12&total_bet_min=0.01';
            }
            else if( $slotEvent['slotEvent'] == 'doCollect' || $slotEvent['slotEvent'] == 'doCollectBonus') 
            {
                $Balance = $slotSettings->GetBalance();
                $response = 'balance=' . $Balance . '&index=' . $slotEvent['index'] . '&balance_cash=' . $Balance . '&balance_bonus=0.00&na=s&stime=' . floor(microtime(true) * 1000) . '&na=s&sver=5&counter=' . ((int)$slotEvent['counter'] + 1);
            }
            else if( $slotEvent['slotEvent'] == 'doSpin' ) 
            {
                $isdoublechance = $slotEvent['bl'];
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
                $allBet = $betline * $lines;
                if($isdoublechance == 1){
                    $allBet = $betline * 30;
                }
                $_spinSettings = $slotSettings->GetSpinSettings($slotEvent['slotEvent'], $allBet, $lines);
                $winType = $_spinSettings[0];
                $_winAvaliableMoney = $_spinSettings[1];
                $_moneyValue = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];     
                if($slotEvent['slotEvent'] == 'freespin'){
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
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
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'DoubleChance', $isdoublechance);
                }
                $Balance = $slotSettings->GetBalance();
                if( $slotEvent['slotEvent'] != 'bet' ) 
                {
                    $slotSettings->UpdateJackpots($allBet);
                }
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $totalWin = 0;
                    $this->winLines = [];
                    $wild = '2';
                    $scatter = '1';
                    $moneysymbol = '12';
                    $_obf_winCount = 0;
                    $strWinLine = '';
                    $reels = $slotSettings->GetReelStrips($winType, $slotEvent['slotEvent']);
                    
                    for($r = 0; $r < 4; $r++){
                        if($reels['reel1'][$r] != $scatter && $reels['reel1'][$r] < 12){
                            $this->findZokbos($reels, $reels['reel1'][$r], 1, '~'.($r * 5));
                        }                        
                    }
                    $wincount = 0;
                    for($r = 0; $r < count($this->winLines); $r++){
                        $winLine = $this->winLines[$r];
                        $winLineMoney = $slotSettings->Paytable[$winLine['FirstSymbol']][$winLine['RepeatCount']] * $betline;
                        if($winLineMoney > 0){
                            $strWinLine = $strWinLine . '&l'. $wincount.'='.$wincount.'~'.$winLineMoney . $winLine['StrLineWin'];
                            $totalWin += $winLineMoney;
                            $wincount++;
                        }
                    } 
                    
                    $isMoney = false;
                    $wildCount = 0;
                    $moneyReels = [0, 0, 0, 0, 0];
                    $isJackpot = false;
                    for($r = 0; $r <= 3; $r++){
                        for( $k = 0; $k < 5; $k++ ) 
                        {
                            if( $reels['reel' . ($k+1)][$r] == $moneysymbol) 
                            {
                                $_moneyValue[$r * 5 + $k] = $slotSettings->GetJackpotMoney($isJackpot);
                                if($_moneyValue[$r * 5 + $k] <= 5 || $_moneyValue[$r * 5 + $k] >= 1250){
                                    $isJackpot = true;
                                }
                                $moneyReels[$k] = 1;
                                $isMoney = true;
                            }else{
                                $_moneyValue[$r * 5 + $k] = 0;
                            }
                            if( $reels['reel' . ($k+1)][$r] == $wild) {
                                $moneyReels[$k] = 1;
                                $wildCount++;
                            }
                        }
                    }
                    $freespinNum = 0;
                    $moneyTotalWin = 0;
                    $scattersCount = 0;
                    $lastMoneyReelNum = 2;
                    $moneyMul = 0;
                    $moneyWinPoses = [];
                    if($wildCount == 2){
                        for( $k = 2; $k < 5; $k++ ){                         
                            for($r = 0; $r <= 3; $r++){
                                if($reels['reel' . ($k+1)][$r] == $scatter){
                                    $scattersCount++;
                                }
                                if($reels['reel' . ($k+1)][$r] == $moneysymbol && $moneyReels[$k - 1] == 1){
                                    if($_moneyValue[$r * 5 + $k] <= 5){
                                        $moneyMul = $moneyMul + $_moneyValue[$r * 5 + $k];
                                    }else{
                                        $moneyTotalWin = $moneyTotalWin + $_moneyValue[$r * 5 + $k] * $betline;
                                    }
                                    array_push($moneyWinPoses, $r * 5 + $k);
                                }
                            }   
                        }
                    }
                    if($moneyMul > 0){
                        $moneyTotalWin = $moneyTotalWin * $moneyMul;
                    }
                    if($scattersCount == 1){
                        $freespinNum = 10;
                    }
                    
                    $totalWin = $totalWin + $moneyTotalWin; 
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
                        if( $i > 2000 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                            exit( $response );
                        }
                        if( $freespinNum == 10 && $winType != 'bonus' ) 
                        {
                        }
                        else if($winType == 'bonus' && $moneyTotalWin > 0){

                        }
                        else if( $totalWin <= $_winAvaliableMoney && $winType == 'bonus' && $freespinNum > 0) 
                        {
                            $_obf_0D163F390C080D0831380D161E12270D0225132B261501 = $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''));
                            if( $_obf_0D163F390C080D0831380D161E12270D0225132B261501 < $_winAvaliableMoney ) 
                            {
                                $_winAvaliableMoney = $_obf_0D163F390C080D0831380D161E12270D0225132B261501;
                            }
                            else
                            {
                                if($totalWin < $_winAvaliableMoney){
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

                if( $freespinNum > 0 ) 
                {
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') == 0 ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $freespinNum);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 1);
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $freespinNum);
                    }
                }
                for($k = 0; $k <= 3; $k++){
                    for($j = 1; $j <= 5; $j++){
                        $lastReel[($j - 1) + $k * 5] = $reels['reel'.$j][$k];
                    }
                }
                $strLastReel = implode(',', $lastReel);
                $strReelSa = $reels['reel1'][4].','.$reels['reel2'][4].','.$reels['reel3'][4].','.$reels['reel4'][4].','.$reels['reel5'][4];
                $strReelSb = $reels['reel1'][-1].','.$reels['reel2'][-1].','.$reels['reel3'][-1].','.$reels['reel4'][-1].','.$reels['reel5'][-1];
                $strOtherResponse = '';
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
                        $strOtherResponse = '&fs_total='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fswin_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsmul_total=1&fsres_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&reel_set=2';
                    }
                    else
                    {
                        $strOtherResponse = '&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&reel_set=2';
                    }
                }else
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                    if($freespinNum > 0 ){
                        $spinType = 's';
                        $strOtherResponse = '&reel_set=0&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&fswin=0.00&fs=1&fsres=0.00';
                    }else{
                        $strOtherResponse = '&reel_set=0';
                    }
                }
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                if($isMoney){                    
                    $strOtherResponse = $strOtherResponse . '&mo=' . implode(',', $_moneyValue);
                    $CurrentMoneyText = $slotSettings->GetMoneyText($_moneyValue);
                    $strOtherResponse = $strOtherResponse . '&mo_t=' . implode(',', $CurrentMoneyText);
                    if($moneyTotalWin > 0){
                        $strOtherResponse = $strOtherResponse . '&mo_tv=' . ($moneyTotalWin / $betline) . '&mo_wpos=' . implode(',', $moneyWinPoses) . '&mo_c=1&mo_tw=' . $moneyTotalWin;
                    }
                }
                if($isEnd == true){
                    $strOtherResponse = $strOtherResponse.'&w='.$slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                }else{
                    $strOtherResponse = $strOtherResponse.'&w='.$totalWin;
                }
                $response = 'tw='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&balance='.$Balance.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinLine. $strOtherResponse.'&stime=' . floor(microtime(true) * 1000) .'&sa='.$strReelSa.'&sb='.$strReelSb. '&bl=' . $isdoublechance.'&sh=4&c='.$betline.'&sver=5&counter='. ((int)$slotEvent['counter'] + 1) .'&l=25&s='.$strLastReel;
                


                if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0)) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                }
                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"DoubleChance":' . $slotSettings->GetGameData($slotSettings->slotId . 'DoubleChance') .',"MoneyValue":'.json_encode($_moneyValue) . ',"winLines":[],"Jackpots":""' .',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $allBet, $lines, $_obf_totalWin, $slotEvent['slotEvent']);
                
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
        public function findZokbos($reels, $firstSymbol, $repeatCount, $strLineWin){
            $wild = '2';
            $bPathEnded = true;
            if($repeatCount < 5){
                for($r = 0; $r < 4; $r++){
                    if($firstSymbol == $wild || $firstSymbol == $reels['reel'.($repeatCount + 1)][$r] || $reels['reel'.($repeatCount + 1)][$r] == $wild){
                        if($firstSymbol == $wild){
                            $this->findZokbos($reels, $reels['reel'.($repeatCount + 1)][$r], $repeatCount + 1, $strLineWin . '~' . ($repeatCount + $r * 5));
                        }else{
                            $this->findZokbos($reels, $firstSymbol, $repeatCount + 1, $strLineWin . '~' . ($repeatCount + $r * 5));
                        }
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
