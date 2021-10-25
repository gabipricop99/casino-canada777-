<?php 
namespace VanguardLTE\Games\JohnHunterBookOfTut
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
            $isbuyfreespin = -1;
            if(isset($slotEvent['pur'])){
                $isbuyfreespin = $slotEvent['pur'];
            }
            $slotEvent['slotEvent'] = $slotEvent['action'];
            if( $slotEvent['slotEvent'] == 'update' ) 
            {
                $Balance = $slotSettings->GetBalance();
                $response = 'balance=' . $Balance . '&balance_cash=' . $Balance . '&balance_bonus=0.00&na=s&stime=' . floor(microtime(true) * 1000);
                exit( $response );
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
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 10);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [5,8,7,9,8,8,7,3,4,4,11,6,8,11,10]);
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusSymbol', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'BuyFreeSpin', -1);
                if( $lastEvent != 'NULL' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->lines);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', $lastEvent->serverResponse->BonusMpl);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastEvent->serverResponse->LastReel);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusSymbol', $lastEvent->serverResponse->BonusSymbol);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BuyFreeSpin', $lastEvent->serverResponse->BuyFreeSpin);
                    $bet = $lastEvent->serverResponse->bet;
                }
                else
                {
                    $bet = $slotSettings->Bet[0];
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
                $currentReelSet = 0;
                $spinType = 's';
                $lastReelStr = implode(',', $slotSettings->GetGameData($slotSettings->slotId . 'LastReel'));
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') <= $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                {
                    $bonusSymbol = $slotSettings->GetGameData($slotSettings->slotId . 'BonusSymbol');
                    $currentReelSet = 15 + $bonusSymbol;
                    $_obf_StrResponse = '&fs=' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .  '&fsres=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&tw=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&w=0.00&ms='. $bonusSymbol .'&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                    if($slotSettings->GetGameData($slotSettings->slotId . 'BuyFreeSpin') == 0){
                        $_obf_StrResponse = $_obf_StrResponse .'&puri=0';
                    }
                }else{
                    $_obf_StrResponse = '';
                }
                $Balance = $slotSettings->GetBalance();
                // $response = 'msi=14&def_s=6,7,4,3,8,9,3,5,6,7,8,5,7,3,9&msr=2&balance='. $Balance .'&cfgs=1&ver=2&index=1&balance_cash='.$Balance.'&reel_set_size=2&def_sb=10,3,2,2,2&def_sa=6,10,5,8,10&balance_bonus=0.00&na='. $spinType.
                //     '&scatters=1~100,15,2,0,0~15,10,8,0,0~1,1,1,1,1&gmb=0,0,0&bg_i=800,0,200,1,25,2&rt=d&stime=1610464406511&sa=6,10,5,8,10&sb=10,3,2,2,2&sc='. implode(',', $slotSettings->Bet) .'&defc=0.01&sh=3&wilds=2~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&n_reel_set='.$currentReelSet.$_obf_StrResponse.'&bg_i_mask=pw,ic,pw,ic,pw,ic&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;200,50,25,0,0;150,50,10,0,0;100,20,5,0,0;100,20,5,0,0;100,20,5,0,0;50,15,5,0,0;50,15,5,0,0;50,10,5,0,0;50,10,5,0,0;50,10,5,0,0;50,10,5,0,0;0,0,0,0,0&l=25&rtp=96.17&reel_set0=11,6,13,8,8,9,1,4,10,3,10,9,6,12,13,5,11,5,7,12~7,3,7,11,13,10,12,6,2,2,2,4,8,1,9,7,5,2,12,4~6,7,3,11,9,1,9,9,12,4,5,2,2,2,2,2,13,8,6,4,11,10~10,2,2,2,2,4,2,8,13,10,7,6,13,2,8,11,11,13,4,12,5,10,1,3,12,9~10,12,2,2,2,2,2,2,2,2,4,5,10,8,13,8,6,9,1,9,11,11,2,3,1,3,7,12&s='.$lastReelStr.'&reel_set1=6,12,8,1,7,8,11,10,10,12,9,11,3,9,5,4,5,13~7,9,13,10,2,2,2,2,2,14,14,14,14,14,6,7,11,12,5,12,3,14,8,1,2,4,14,4,14,2~2,2,2,2,2,2,2,1,2,6,2,14,14,14,4,8,9,14,2,4,11,13,12,11,10,9,2,5,2,3,2,7,2,6,9,14,7~9,13,6,10,10,2,2,2,2,2,2,2,14,14,14,14,14,14,14,14,14,14,14,14,11,14,14,12,13,12,2,14,4,5,3,14,11,2,8,13,4,14,10,1,1,7~8,10,1,3,9,2,2,2,2,2,2,2,14,14,14,14,14,14,14,14,2,2,3,10,5,12,4,1,2,9,8,13,6,12,11,2,7,14,14';
                $response = 'wsc=1~bg~200,20,2,0,0~10,10,10,0,0~fs~200,20,2,0,0~10,10,10,0,0&def_s=5,8,7,9,8,8,7,3,4,4,11,6,8,11,10&reel_set25=5,8,7,10,4,7,1,9,6,1,9,7,6,10,5,7,9,8,10,9,5,7,9,5,10,9,8,11,9,8,3,4,8,10,7,5,10,11,8,7,11,9,7,11,8,7,11,8,7,3,8,7,9,1,8,9,5,8,7,3,9,8,7,9,8,5,9,4,11,9,8,5,9,11,3,8,10,5,8,10,9,8,4,7,9,10,6,7,10,6,7,1,5,7,8,11,10,5,8,10,9,11~9,10,7,8,4,10,8,7,11,10,7,11,4,7,10,6,7,9,6,10,9,6,11,10,7,8,9,6,1,10,6,7,10,8,4,11,8,9,6,8,5,10,8,11,9,10,8,11,9,10,5,9,11,8,7,11,8,10,11,7,10,8,11,10,6,11,10,9,11,10,8,6,3,10,11,6,10,8,11,1,10,8,11,4,10,11,6,10,8,9,11,8,3,9,8,11,4,8,1,11,7,10~9,11,3,7,9,10,8,6,7,11,6,10,11,7,9,11,10,9,11,4,9,11,3,9,11,10,9,11,3,7,11,6,1,11,7,10,11,1,10,11,5,7,11,9,7,11,4,9,11,7,10,11,9,4,5,10,7,11,5,7,10,8,7,10,4,3,7,11,9,1,7,11,10,7,11,10,9,6,10,4,5,10,7,4,10,6,8,10,4,5,10,7,6,4,11,9,7,11,9~6,4,7,9,4,5,10,11,6,8,4,9,5,4,7,5,8,9,1,8,7,5,11,9,5,11,7,8,10,7,11,5,1,10,11,9,10,8,7,11,9,7,11,9,7,8,5,7,8,11,3,9,10,6,9,4,11,1,9,10,3,7,4,11,8,10,1,8,9,7,4,9,10,11,8,9,11,6,10,8,3,5,7,1,11,7,5,9,6,8,9,5,10,9,8,6,10~4,8,10,3,4,10,7,4,11,10,6,8,10,9,5,10,9,11,5,9,1,7,11,1,10,8,5,10,9,8,5,6,9,10,8,3,9,11,7,9,5,7,8,5,4,11,3,4,10,6,9,10,6,8,1,6,9,3,8,9,10,11,8,6,7,11,9,7,8,1,7,10,8,7,11,8,7,9,8,7,5,10,7,9,6,11,5,7,11,5,7,10,9,7,11,6,4,11&reel_set26=5,8,7,10,4,7,1,9,6,1,9,7,6,9,11,7,9,8,11,9,5,7,11,5,10,9,8,11,9,8,3,4,11,10,7,5,10,11,8,7,11,9,7,11,8,7,11,8,7,3,8,7,9,1,8,9,5,8,7,3,9,8,7,9,8,5,9,4,11,9,8,5,9,11,3,8,10,5,8,10,9,8,4,7,9,10,6,7,10,6,7,1,5,7,8,11,10,5,8,10,9,11~9,10,7,8,4,10,8,7,11,9,7,11,4,7,8,6,11,9,6,10,9,6,11,10,7,8,9,6,1,10,6,7,10,8,4,11,8,9,6,8,5,10,8,11,9,10,8,11,9,10,5,9,11,8,7,11,8,10,11,7,10,8,11,10,6,11,10,9,11,10,8,6,3,10,11,6,10,8,11,1,10,8,11,4,10,11,6,10,8,9,11,8,3,9,8,11,4,8,1,11,7,10~9,11,3,7,9,10,8,6,7,11,6,10,11,7,9,11,10,9,11,4,9,11,3,9,11,10,9,11,3,7,11,6,1,11,7,10,11,1,10,11,5,7,11,9,7,11,4,9,11,7,10,11,9,4,5,10,7,11,5,7,10,8,7,10,4,3,7,11,9,1,7,11,10,7,11,10,9,6,10,4,5,10,7,4,10,6,8,10,4,5,10,7,6,4,11,9,7,11,9~6,4,7,9,4,5,9,11,6,8,4,9,10,4,7,5,8,9,1,8,7,5,11,9,5,11,7,8,4,7,11,5,1,10,11,9,10,8,7,11,9,7,11,9,7,8,5,7,8,11,3,9,10,6,9,4,11,1,9,10,3,7,4,11,8,10,1,8,9,7,4,9,10,11,8,9,11,6,10,8,3,5,7,1,11,7,5,9,6,8,9,5,10,9,8,6,10~4,8,10,11,4,8,7,4,11,10,6,8,10,11,5,10,9,11,5,9,1,7,11,1,10,8,5,10,9,11,5,6,9,7,8,3,9,11,7,9,5,7,8,5,4,11,3,4,10,6,9,10,6,8,1,6,9,3,8,9,10,11,8,6,7,11,9,7,8,1,7,10,8,7,11,8,7,9,8,7,5,8,7,9,6,11,5,7,11,5,7,10,9,7,11,6,4,11&balance='. $Balance .'&cfgs=1&ver=2&index=1&balance_cash='. $Balance .'&reel_set_size=27&def_sb=5,3,4,6,7&def_sa=11,12,10,8,9&reel_set='.$currentReelSet.$_obf_StrResponse.'&balance_bonus=0.00&na='. $spinType.'&scatters=&gmb=0,0,0&rt=d&gameInfo={props:{max_rnd_sim:"1",max_rnd_hr:"23809523",max_rnd_win:"5000"}}&stime=' . floor(microtime(true) * 1000) .'&sa=11,12,10,8,9&sb=5,3,4,6,7&reel_set10=3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7&sc='. implode(',', $slotSettings->Bet) .'&defc=0.20&reel_set11=3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7&reel_set12=1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10&reel_set13=1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7&sh=3&wilds=2~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&reel_set18=5,8,7,10,4,7,1,9,6,1,9,7,6,9,5,7,9,8,7,9,5,7,9,5,10,9,8,11,9,8,3,4,8,10,7,5,10,11,8,7,11,9,7,11,8,7,11,8,7,3,8,7,9,1,8,9,5,8,7,3,9,8,7,9,8,5,9,4,11,9,8,5,9,11,3,8,10,5,8,10,9,8,4,7,9,10,6,7,10,6,7,1,5,7,8,11,10,5,8,10,9,11~9,10,7,8,4,10,8,7,11,9,7,11,3,7,8,6,7,9,6,10,9,6,11,10,7,8,9,6,1,10,6,7,10,8,4,11,8,9,6,8,5,10,8,11,9,10,8,11,9,10,5,9,11,8,7,11,8,10,11,7,10,8,11,10,6,11,10,9,11,10,8,6,3,10,11,6,10,8,11,1,10,8,11,4,10,11,6,10,8,9,11,8,3,9,8,11,4,8,1,11,7,10~9,11,3,7,9,10,8,6,7,11,3,10,11,7,9,11,10,9,11,4,9,11,3,9,11,10,9,11,3,7,11,6,1,11,7,10,11,1,10,11,5,7,11,9,7,11,4,9,11,7,10,11,9,4,5,10,7,11,5,7,10,8,7,10,4,3,7,11,9,1,7,11,10,7,11,10,9,6,10,4,5,10,7,4,10,6,8,10,4,5,10,7,6,4,11,9,7,11,9~6,4,7,9,4,5,9,11,6,8,4,9,5,4,7,3,8,9,1,8,7,5,11,9,5,11,7,8,4,7,11,5,1,10,11,9,10,8,7,11,9,7,11,9,7,8,5,7,8,11,3,9,10,6,9,4,11,1,9,10,3,7,4,11,8,10,1,8,9,7,4,9,10,11,8,9,11,6,10,8,3,5,7,1,11,7,5,9,6,8,9,5,10,9,8,6,10~4,8,10,3,4,8,7,4,11,10,3,8,10,9,5,10,9,11,5,9,1,7,11,1,10,8,5,10,9,8,5,6,9,7,8,3,9,11,7,9,5,7,8,5,4,11,3,4,10,6,9,10,6,8,1,6,9,3,8,9,10,11,8,6,7,11,9,7,8,1,7,10,8,7,11,8,7,9,8,7,5,8,7,9,6,11,5,7,11,5,7,10,9,7,11,6,4,11&reel_set19=5,8,7,10,9,7,1,9,6,1,9,7,4,9,5,7,9,4,7,9,5,7,4,5,10,9,8,11,9,8,3,4,8,10,7,5,10,11,8,7,11,9,7,11,8,7,11,8,7,3,8,7,9,1,8,9,5,8,7,3,9,8,7,9,8,5,9,4,11,9,8,5,9,11,3,8,10,5,8,10,9,8,4,7,9,10,6,7,10,6,7,1,5,7,8,11,10,5,8,10,9,11~9,10,7,8,4,10,8,7,11,9,7,11,9,7,8,6,7,9,6,10,9,6,4,10,7,8,9,6,1,10,6,7,10,8,4,11,8,9,6,8,5,10,8,11,9,10,8,11,9,10,5,9,11,8,7,11,8,10,11,7,10,8,11,10,6,11,10,9,11,10,8,6,3,10,11,6,10,8,11,1,10,8,11,4,10,11,6,10,8,9,11,8,3,9,8,11,4,8,1,11,7,10~9,11,3,7,9,10,8,6,7,11,6,10,11,7,4,11,10,9,11,4,9,11,3,9,11,10,9,11,3,7,11,6,1,11,7,10,11,1,10,11,5,7,11,9,7,11,4,9,11,7,10,11,9,4,5,10,7,11,5,7,10,8,7,10,4,3,7,11,9,1,7,11,10,7,11,10,9,6,10,4,5,10,7,4,10,6,8,10,4,5,10,7,6,4,11,9,7,11,9~6,4,7,9,4,5,9,11,6,8,4,9,5,4,7,5,8,9,1,8,7,5,11,4,5,11,7,8,4,7,11,5,1,10,11,9,10,8,7,11,9,7,11,9,7,8,5,7,8,11,3,9,10,6,9,4,11,1,9,10,3,7,4,11,8,10,1,8,9,7,4,9,10,11,8,9,11,6,10,8,3,5,7,1,11,7,5,9,6,8,9,5,10,9,8,6,10~4,8,10,3,4,8,7,9,11,10,6,8,10,9,5,10,9,11,5,9,1,7,11,1,10,8,4,10,9,8,5,6,9,7,4,3,9,11,7,9,5,7,8,5,4,11,3,4,10,6,9,10,6,8,1,6,9,3,8,9,10,11,8,6,7,11,9,7,8,1,7,10,8,7,11,8,7,9,8,7,5,8,7,9,6,11,5,7,11,5,7,10,9,7,11,6,4,11&counter=2&reel_set14=1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;5000,1000,100,10,0;2000,400,40,5,0;750,100,30,5,0;750,100,30,5,0;150,40,5,0,0;150,40,5,0,0;100,25,5,0,0;100,25,5,0,0;100,25,5,0,0&l=10&reel_set15=1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7&reel_set16=3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7&reel_set17=1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7&rtp=96.50&total_bet_max=100,000.00&reel_set21=5,8,7,10,4,7,1,9,6,1,9,7,6,9,5,7,9,8,6,9,5,7,9,5,6,9,8,11,9,8,3,4,8,10,7,5,10,11,8,7,11,9,7,11,8,7,11,8,7,3,8,7,9,1,8,9,5,8,7,3,9,8,7,9,8,5,9,4,11,9,8,5,9,11,3,8,10,5,8,10,9,8,4,7,9,10,6,7,10,6,7,1,5,7,8,11,10,5,8,10,9,11~9,10,7,8,4,10,8,7,11,9,7,11,4,7,8,6,7,9,6,10,9,6,11,10,7,8,9,6,1,10,6,7,10,8,4,11,8,9,6,8,5,10,8,11,9,10,8,11,9,10,5,9,11,8,7,11,8,10,11,7,10,8,11,10,6,11,10,9,11,10,8,6,3,10,11,6,10,8,11,1,10,8,11,4,10,11,6,10,8,9,11,8,3,9,8,11,4,8,1,11,7,10~9,11,3,6,9,10,8,6,7,11,6,10,11,7,9,11,10,6,11,4,9,11,3,6,11,10,9,11,3,7,11,6,1,11,7,10,11,1,10,11,5,7,11,9,7,11,4,9,11,7,10,11,9,4,5,10,7,11,5,7,10,8,7,10,4,3,7,11,9,1,7,11,10,7,11,10,9,6,10,4,5,10,7,4,10,6,8,10,4,5,10,7,6,4,11,9,7,11,9~6,4,7,9,4,5,9,11,6,8,4,9,5,4,7,5,8,9,1,8,7,5,11,9,5,11,7,8,4,7,11,5,1,10,11,9,10,8,7,11,9,7,11,9,7,8,5,7,8,11,3,9,10,6,9,4,11,1,9,10,3,7,4,11,8,10,1,8,9,7,4,9,10,11,8,9,11,6,10,8,3,5,7,1,11,7,5,9,6,8,9,5,10,9,8,6,10~4,8,10,3,4,8,7,4,11,10,6,8,10,9,5,6,9,11,5,9,1,7,11,1,10,8,5,6,9,8,5,6,9,7,8,3,9,11,7,9,5,7,8,5,4,11,3,4,10,6,9,10,6,8,1,6,9,3,8,9,10,11,8,6,7,11,9,7,8,1,7,10,8,7,11,8,7,9,8,7,5,8,7,9,6,11,5,7,11,5,7,10,9,7,11,6,4,11&reel_set22=5,8,7,10,4,7,1,9,6,1,9,7,6,9,5,7,9,8,7,9,5,7,9,5,10,7,8,11,9,7,3,4,8,10,7,5,10,11,8,7,11,9,7,11,8,7,11,8,7,3,8,7,9,1,8,9,5,8,7,3,9,8,7,9,8,5,9,4,11,9,8,5,9,11,3,8,10,5,8,10,9,8,4,7,9,10,6,7,10,6,7,1,5,7,8,11,10,5,8,10,9,11~9,10,7,8,4,10,8,7,11,9,7,11,4,7,8,6,7,9,6,10,9,6,11,10,7,8,9,6,1,10,6,7,10,8,4,11,8,9,6,8,5,10,8,11,9,10,8,11,9,10,5,9,11,8,7,11,8,10,11,7,10,8,11,10,6,11,10,9,11,10,8,6,3,10,11,6,10,8,11,1,10,8,11,4,10,11,6,10,8,9,11,8,3,9,8,11,4,8,1,11,7,10~9,11,3,7,9,10,8,6,3,11,6,10,11,7,9,11,10,9,11,7,9,11,3,7,11,10,9,11,3,7,11,6,1,11,7,10,11,1,10,11,5,7,11,9,7,11,4,9,11,7,10,11,9,4,5,10,7,11,5,7,10,8,7,10,4,3,7,11,9,1,7,11,10,7,11,10,9,6,10,4,5,10,7,4,10,6,8,10,4,5,10,7,6,4,11,9,7,11,9~6,4,7,9,4,5,9,11,7,8,4,9,5,4,7,5,8,9,1,8,7,5,11,9,5,11,7,8,4,7,11,5,1,10,11,9,10,8,7,11,9,7,11,9,7,8,5,7,8,11,3,9,10,6,9,4,11,1,9,10,3,7,4,11,8,10,1,8,9,7,4,9,10,11,8,9,11,6,10,8,3,5,7,1,11,7,5,9,6,8,9,5,10,9,8,6,10~4,8,10,3,4,8,7,4,11,10,7,8,10,9,5,3,9,11,5,9,1,7,11,1,10,8,5,10,7,8,5,6,9,7,8,3,9,11,7,9,5,7,8,5,4,11,3,4,10,6,7,10,6,8,1,6,9,3,8,9,10,11,8,6,7,11,9,7,8,1,7,10,8,7,11,8,7,9,8,7,5,8,7,9,6,11,5,7,11,5,7,10,9,7,11,6,4,11&reel_set0=9,5,11,7,8,5,1,7,11,8,10,5,11,4,10,5,9,3,4,6,10,8,1,10,6,11,9,10,3,8~6,9,8,7,10,5,3,7,4,6,8,5,1,4,9,10,11,3,1,6,4,7,1,11,10,5,11,6,3,1~7,9,1,10,11,5,9,3,4,6,7,5,9,10,11,4,8,1,9,6,5,3,4,6,9,1,6,7,5,4~11,6,3,10,4,6,1,7,4,1,9,11,10,5,1,9,11,5,7,8,4,9,1,4,5,10,7,5,3,7~6,4,9,5,8,11,5,10,7,9,3,1,11,7,8,9,11,3,7,6,11,3,9,4,3,5,11,7,1,5&reel_set23=5,8,7,10,4,7,1,9,6,1,9,7,6,9,5,7,9,8,7,9,5,8,9,5,10,9,8,11,9,8,3,4,8,10,7,5,10,11,8,7,11,9,7,11,8,7,11,8,7,3,8,7,9,1,8,9,5,8,7,3,9,8,7,9,8,5,9,4,11,9,8,5,9,11,3,8,10,5,8,10,9,8,4,7,9,8,6,7,10,6,7,1,5,7,8,11,10,5,8,10,9,11~9,10,7,8,4,10,8,7,11,9,7,11,4,7,8,6,7,9,6,10,9,6,11,10,7,8,9,6,1,10,6,7,10,8,4,11,8,9,6,8,5,10,8,11,9,10,8,11,9,10,5,9,11,8,7,11,8,10,11,7,10,8,11,10,6,11,10,9,11,10,8,6,3,10,11,6,10,8,11,1,10,8,11,4,10,11,6,10,8,9,11,8,3,9,8,11,4,8,1,11,7,10~9,11,3,7,9,10,3,6,7,11,6,8,11,7,9,11,10,9,11,4,9,8,3,9,11,10,9,11,3,7,11,6,1,11,7,10,11,1,10,11,5,7,11,9,7,11,4,9,11,7,10,8,9,4,5,10,7,11,5,7,10,8,7,10,4,3,7,11,9,1,7,11,10,7,11,10,9,6,10,4,5,10,7,4,10,6,8,10,4,5,10,7,6,4,11,9,7,11,9,7~6,4,7,9,4,5,9,11,6,8,4,9,5,4,7,5,8,9,1,8,7,5,11,9,5,11,7,8,4,7,11,5,1,10,11,9,10,8,7,11,9,7,11,9,7,8,5,7,8,11,3,9,10,6,9,4,11,1,9,10,3,7,4,11,8,10,1,8,9,7,4,9,10,11,8,9,11,6,10,8,3,5,7,1,11,7,5,9,6,8,9,5,10,9,8,6,10~4,8,10,3,4,8,7,4,11,10,6,8,10,9,5,3,9,11,5,9,1,7,11,1,10,8,5,10,9,8,5,6,9,7,8,3,9,11,7,9,5,7,8,5,4,11,3,8,10,6,9,10,6,8,1,6,9,3,8,9,10,11,8,6,7,11,9,7,8,1,7,10,8,7,11,8,7,9,8,7,5,8,7,9,6,11,5,7,11,5,7,10,9,7,11,6,4,11&s='.$lastReelStr.'&reel_set24=5,8,7,10,4,7,1,9,6,1,9,7,6,9,5,7,9,8,7,9,5,7,9,5,10,9,8,11,9,8,3,4,8,9,7,5,10,9,8,7,11,9,7,11,8,7,11,8,7,3,8,7,9,1,8,9,5,8,7,3,9,8,7,9,8,5,9,4,11,9,8,5,9,11,3,8,10,5,8,10,9,8,4,7,9,10,6,7,10,6,7,1,5,7,8,11,10,5,8,10,9,11~9,10,7,8,4,10,8,7,11,9,7,11,4,7,8,6,7,9,6,10,9,6,11,10,7,8,9,6,1,10,6,7,9,8,4,11,8,9,6,8,5,10,8,11,9,10,8,11,9,10,5,9,11,8,7,11,8,9,11,7,10,8,11,10,6,11,10,9,11,10,8,6,3,10,11,6,10,8,11,1,10,8,11,4,10,11,6,10,8,9,11,8,3,9,8,11,4,8,1,11,7,10~9,11,3,7,9,10,8,6,7,11,6,10,11,7,9,11,10,9,11,4,9,11,3,9,11,10,9,11,3,7,11,6,1,11,7,10,11,1,10,11,5,7,11,9,7,11,4,9,11,7,10,11,9,4,5,10,7,11,5,7,10,8,9,10,4,3,7,11,9,1,7,11,10,7,11,10,9,6,10,4,5,10,7,4,10,6,8,10,4,5,10,7,6,4,11,9,7,11,9~6,4,7,9,4,5,9,11,6,8,4,9,5,4,7,5,8,9,1,8,7,5,11,9,5,11,7,8,4,7,11,5,1,10,11,9,10,8,7,11,9,7,11,9,7,8,5,7,8,11,3,9,10,6,9,4,11,1,9,10,3,7,4,11,8,10,1,8,9,7,4,9,10,11,8,9,11,6,10,8,3,5,7,1,11,7,5,9,6,8,9,5,10,9,8,6,10~4,8,10,3,9,8,7,4,11,9,6,8,10,9,5,10,9,11,5,9,1,7,11,1,10,8,5,10,9,8,5,6,9,7,8,3,9,11,7,9,5,7,8,5,4,11,3,4,10,6,9,10,6,8,1,6,9,3,8,9,10,11,9,6,7,11,9,7,8,1,7,10,8,7,11,8,7,9,8,7,5,8,7,9,6,11,5,7,11,5,7,10,9,7,11,6,4,11&reel_set2=1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10&reel_set1=10,5,7,10,8,9,1,7,8,11,10,9,6,4,10,11,1,4,3,9,4,1,6,8,10,11,7,1,3,8~6,9,5,1,10,8,3,7,6,4,8,9,3,4,8,3,11,9,8,6,11,3,1,7,3,5,7,10,3,7~3,9,6,10,11,6,1,3,10,4,7,6,8,10,7,3,8,11,5,6,10,3,4,5,9,1,10,7,5,1~5,6,7,10,4,3,6,7,11,10,9,11,3,5,8,4,11,1,3,8,5,9,1,7,11,10,9,11,3,1~9,4,1,7,8,9,6,10,1,5,3,8,5,7,6,1,11,5,3,6,11,3,9,6,10,5,3,4,1,11&reel_set4=1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7&reel_set3=1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10&reel_set20=5,8,7,5,4,7,1,9,6,1,9,7,6,9,5,7,9,8,7,9,5,7,9,5,10,9,8,11,9,8,3,4,8,10,7,5,10,11,8,7,11,9,7,11,8,7,11,8,7,3,8,7,9,1,8,9,5,8,7,3,9,8,7,9,8,5,9,4,11,9,8,5,9,11,3,8,10,5,8,10,9,8,4,7,9,10,6,7,10,6,7,1,5,7,8,11,10,5,8,10,9,11~9,10,7,8,4,10,8,7,5,9,7,11,4,7,8,5,7,9,6,10,9,6,11,10,7,8,9,6,1,10,6,7,10,8,4,11,8,9,6,8,5,10,8,11,9,10,8,11,9,10,5,9,11,8,7,11,8,10,11,7,10,8,11,10,6,11,10,9,11,10,8,6,3,10,11,6,10,8,11,1,10,8,11,4,10,11,6,10,8,9,11,8,3,9,8,11,4,8,1,11,7,10~9,11,3,7,9,10,8,6,7,9,5,10,11,7,9,11,10,9,11,4,9,11,5,9,11,10,9,5,3,7,11,6,1,11,7,10,11,1,10,11,5,7,11,9,7,11,4,9,11,7,10,11,9,4,5,10,7,11,5,7,10,8,7,10,4,3,7,11,9,1,7,11,10,7,11,10,9,6,10,4,5,10,7,4,10,6,8,10,4,5,10,7,6,4,11,9,7,11,9,7~6,4,7,9,4,5,9,11,6,8,4,9,5,4,7,5,8,9,1,8,7,5,11,9,5,11,7,8,4,7,11,5,1,10,11,9,10,8,7,11,9,7,11,9,7,8,5,7,8,11,3,9,10,6,9,4,11,1,9,10,3,7,4,11,8,10,1,8,9,7,4,9,10,11,8,9,11,6,10,8,3,5,7,1,11,7,5,9,6,8,9,5,10,9,8,6,10~4,8,10,3,4,5,7,4,11,5,6,8,10,9,5,10,9,11,5,9,1,7,11,1,10,8,5,10,9,8,5,6,9,7,8,3,9,11,7,9,5,7,8,5,4,11,3,4,10,6,9,10,6,8,1,6,9,3,8,9,10,11,8,6,7,11,9,7,8,1,7,10,8,7,11,8,7,9,8,7,5,8,7,9,6,11,5,7,11,5,7,10,9,7,11,6,4,11&purInit=[{type:"fs",bet:1000,fs_count:10}]&reel_set6=1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7&reel_set5=1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10&reel_set8=3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10&reel_set7=1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7&reel_set9=3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7~3,7,9,11,10,4,8,10,7,11,5,8,9,6,7,11,8,10,9,7,11,8,9,10~1,5,7,1,8,6,1,9,3,1,9,11,1,4,10,1,11,8,1,10,7,1,8,10,1,7&total_bet_min=0.01';
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
                $slotEvent['slotBet'] = $slotEvent['c'];
                $slotEvent['slotLines'] = 10;
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
                $_spinSettings = $slotSettings->GetSpinSettings($slotEvent['slotEvent'], $betline * $lines, $lines);
                $winType = $_spinSettings[0];
                $_winAvaliableMoney = $_spinSettings[1];
                if($slotEvent['slotEvent'] == 'freespin'){
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                }
                else
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BuyFreeSpin', $isbuyfreespin);
                    $slotEvent['slotEvent'] = 'bet';
                    if($isbuyfreespin == 0){
                        $slotSettings->SetBalance(-1 * ($betline * $lines) * 100, $slotEvent['slotEvent']);
                        $_sum = ($betline * $lines)  * 100 / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), $_sum, $slotEvent['slotEvent']);
                        $winType = 'bonus';
                        $_winAvaliableMoney = $slotSettings->GetBank('');
                    }else{
                        $slotSettings->SetBalance(-1 * ($betline * $lines), $slotEvent['slotEvent']);
                        $_sum = ($betline * $lines) / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), $_sum, $slotEvent['slotEvent']);
                    }
                    $bonusMpl = 1;
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusSymbol', 0);
                }
                
                $Balance = $slotSettings->GetBalance();
                if( $slotEvent['slotEvent'] != 'bet' ) 
                {
                    $slotSettings->UpdateJackpots($betline * $lines);
                }
                // if($winType == 'win'){
                //     $test = 1;
                // }
                $n_reel_set = 0;
                $bonusSymbol = 0;
                if($slotEvent['slotEvent'] == 'freespin'){
                    $bonusSymbol = $slotSettings->GetGameData($slotSettings->slotId . 'BonusSymbol');
                    $n_reel_set = $bonusSymbol - 2;
                }
                $initScatterCount = 0;
                if($winType == 'bonus'){
                    $initScatterCount = $slotSettings->GenerateFreeSpinCount($slotEvent);
                }
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $totalWin = 0;
                    $lineWins = [];
                    $lineWinNum = [];
                    $wild = 1;
                    $scatter = 1;
                    $_obf_winCount = 0;
                    $strWinLine = '';
                    $reels = $slotSettings->GetReelStrips($winType, $slotEvent['slotEvent'], $n_reel_set, $initScatterCount);
                    
                    $_obf_scatterposes = [];
                    $scattersCount = 0;
                    $scattersWin = 0;
                    $_lineWinNumber = 1;
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
                            }else if($ele == $firstEle || $ele == $wild){
                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                if($j == 4){
                                    $lineWins[$k] = $slotSettings->Paytable[$firstEle][$lineWinNum[$k]] * $betline;
                                    if($lineWins[$k] > 0){
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
                    $me_reels = [];
                    $me_bonusPoses = [];
                    $me_bonusChangedPoses = [];
                    $me_bonusReelPoses = [0,0,0,0,0];
                    $me_bonusCount = 0;
                    $me_bonusWin = 0;
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        for( $k = 0; $k <= 2; $k++ ) 
                        {
                            if( $reels['reel' . $r][$k] == $scatter ) 
                            {
                                $scattersCount++;
                                array_push($_obf_scatterposes, $k * 5 + $r - 1);
                            }
                            if( $reels['reel' . $r][$k] == $bonusSymbol ) 
                            {
                                $me_bonusCount++;
                                array_push($me_bonusPoses, $k * 5 + $r - 1);
                                $me_bonusReelPoses[$r - 1] = 1;
                            }
                        }
                    }
                    if($slotEvent['slotEvent'] == 'freespin'){
                        $me_bonusWin = $slotSettings->Paytable[$bonusSymbol][$me_bonusCount] * $betline * 10;
                        if($me_bonusWin > 0){
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                $me_reels[$r - 1] = [];
                                for( $k = 0; $k <= 2; $k++ ) 
                                {
                                    if($me_bonusReelPoses[$r - 1] == 1){
                                        $me_reels[$r - 1][$k] = $bonusSymbol;
                                        if($reels['reel' . $r][$k] != $bonusSymbol){
                                            array_push($me_bonusChangedPoses, $k * 5 + $r - 1);
                                        }
                                    }else{
                                        $me_reels[$r - 1][$k] = $reels['reel' . $r][$k];
                                    }
                                }
                            }
                        }
                    }
                    if($scattersCount >= 3 && $slotEvent['slotEvent'] != 'freespin'){
                        $scattersWin = $betline * $lines * $slotSettings->freeSpinCount[$scattersCount];
                    }
                    
                    $totalWin = $totalWin + $scattersWin + $me_bonusWin;
                    
                    if( $i >= 1000 ) 
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
                        if( $i > 1500 ) 
                        {
                            // $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                            // exit( $response );
                            break;
                        }
                        if( $scattersCount >= 3 && ($winType != 'bonus' || $scattersCount != $initScatterCount) ) 
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
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 10);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 1);
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 10);
                    }
                }
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
                        $isEnd = true;
                        $spinType = 'c';
                        $strOtherResponse = '&fs_total='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fswin_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsmul_total=1&fsres_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                    }
                    else
                    {
                        $strOtherResponse = '&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                    }
                    
                    $n_reel_set = $bonusSymbol + 15;
                    if($me_bonusWin > 0){
                        $lastBonusReel = [];
                        for($k = 0; $k < 3; $k++){
                            for($j = 0; $j < 5; $j++){
                                $lastBonusReel[$j + $k * 5] = $me_reels[$j][$k];
                            }
                        }
                        $strOtherResponse = $strOtherResponse . '&me='. $bonusSymbol .'~'. implode(',', $me_bonusPoses) .'~'. implode(',', $me_bonusChangedPoses) .'&ms='. $bonusSymbol .'&mes='.implode(',', $lastBonusReel).'&psym='. $bonusSymbol .'~'.$me_bonusWin.'~' . implode(',', $me_bonusPoses);
                    }
                }else
                {
                    // $_obf_0D5C3B1F210914123C222630290E271410213E320B0A11 = $totalWin;
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                    if($scattersCount >=3 ){
                        $spinType = 'm';
                        $strOtherResponse = '&fsmul=1&mb=1&fsmax='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fswin=0.00&fs=1&fsres=0.00&psym=1~' . $scattersWin.'~' . implode(',', $_obf_scatterposes);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusSymbol', $slotSettings->GetBonusSymbol());
                        if($slotSettings->GetGameData($slotSettings->slotId . 'BuyFreeSpin') == 0){
                            $strOtherResponse = $strOtherResponse.'&purtr=1';
                        }
                    }                    
                }

                if($isEnd == true){
                    $strOtherResponse = $strOtherResponse.'&w='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                }else{
                    $strOtherResponse = $strOtherResponse.'&w='.$totalWin;
                }
                if($slotSettings->GetGameData($slotSettings->slotId . 'BuyFreeSpin') == 0){
                    $strOtherResponse = $strOtherResponse.'&puri=0';
                }
                $response = 'tw='.$slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . $strOtherResponse . '&balance='.$Balance.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinLine.'&stime=' . floor(microtime(true) * 1000) .'&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=3&c='.$betline.'&sver=5&reel_set='.$n_reel_set.'&counter='. ((int)$slotEvent['counter'] + 1) .'&l=10&s='.$strLastReel;

                if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0)) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                }

                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $Balance . ',"BonusSymbol":'.$slotSettings->GetGameData($slotSettings->slotId . 'BonusSymbol') . ',"BuyFreeSpin":'.$slotSettings->GetGameData($slotSettings->slotId . 'BuyFreeSpin') . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . 
                    ',"LastReel":'.json_encode($lastReel).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $_obf_totalWin, $slotEvent['slotEvent']);
                
                if( $scattersCount >= 3 && $slotEvent['slotEvent'] != 'freespin') 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $Balance);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                }
            }else if( $slotEvent['slotEvent'] == 'doMysteryScatter' ){
                $Balance = $slotSettings->GetBalance();
                $response = 'fsmul=1&balance='.$Balance.'&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&ms='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusSymbol') . '&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&reel_set=0&balance_bonus=0.00&na=s&fswin=0.00&stime=' . floor(microtime(true) * 1000) .'&fs=1&fsres=0.00&sver=5&counter='. ((int)$slotEvent['counter'] + 1);
                if($slotSettings->GetGameData($slotSettings->slotId . 'BuyFreeSpin') == 0){
                    $response = $response .'&purtr=1&puri=0';
                }
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
