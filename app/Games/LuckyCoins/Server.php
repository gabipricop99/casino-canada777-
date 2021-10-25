<?php 
namespace VanguardLTE\Games\LuckyCoins
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
            // $paramData = substr($paramData, 1, strlen($paramData) - 2);
            $paramEvent = json_decode($paramData);
            if(count($paramEvent)){
                $Balance = $slotSettings->GetBalance();
                $response = '{"events":[],"platform":{"balance":' . $Balance . '}}';
                return $response;
            }
            if( !isset($paramEvent->action) ) 
            {
                return '';
            }
            $slotEvent = [];
            $slotEvent['slotEvent'] = $paramEvent->action;
            if($slotEvent['slotEvent'] == 'config'){
                $Balance = $slotSettings->GetBalance();
                // $response = '{"events":[],"platform":{"balance":' . $Balance . '}}';
                $response = '{"events":[{"event":"config","context":{"symbols":["WILD","PIC1","PIC2","PIC3","PIC4","ACE","KING","QUEEN","JACK","BONUS","BONUS_1","BONUS_2","BONUS_3","BONUS_4","BONUS_5","BONUS_6","BONUS_7","BONUS_8","BONUS_14","BONUS_16","BONUS_20","BONUS_24","BONUS_10","BONUS_15","BONUS_25","BONUS_30","BONUS_35","BONUS_40","BONUS_45","BONUS_50","BONUS_60","BONUS_70","BONUS_Mini","BONUS_Major","SCAT","BLANK"],"symbolsPay":{"line":["PIC1","WILD","PIC2","PIC3","PIC4","ACE","KING","QUEEN","JACK"],"scatter":["SCAT","BONUS"]},"wildSymbols":["WILD"],"lineAlign":"left","lineCoinciding":false,"assetsDir":"myGame","window":{"rows":3,"reels":5},"availablePayLines":[[1,1,1,1,1],[0,0,0,0,0],[2,2,2,2,2],[0,1,2,1,0],[2,1,0,1,2],[0,0,1,2,2],[2,2,1,0,0],[1,2,2,2,1],[1,0,0,0,1],[1,0,1,2,1],[1,2,1,0,1],[2,1,1,1,2],[0,1,1,1,0],[2,1,1,1,0],[0,1,1,1,2],[0,1,0,1,0],[2,1,2,1,2],[1,0,1,0,1],[1,2,1,2,1],[0,1,2,2,2],[2,1,0,0,0],[1,1,0,1,1],[1,1,2,1,1],[0,0,0,1,2],[2,2,2,1,0]],"freespinsPaytable":{"line":[{"on":{"occurs":[4,5],"of":"PIC1","mode":"line"},"pay":[50,150]},{"on":{"occurs":[4,5],"of":"PIC2","mode":"line"},"pay":[30,150]},{"on":{"occurs":[4,5],"of":"PIC3","mode":"line"},"pay":[25,100]},{"on":{"occurs":[4,5],"of":"PIC4","mode":"line"},"pay":[25,100]},{"on":{"occurs":[4,5],"of":"ACE","mode":"line"},"pay":[10,25]},{"on":{"occurs":[4,5],"of":"KING","mode":"line"},"pay":[10,25]},{"on":{"occurs":[4,5],"of":"QUEEN","mode":"line"},"pay":[5,15]},{"on":{"occurs":[4,5],"of":"JACK","mode":"line"},"pay":[5,15]}],"scatter":[{"on":{"occurs":[9,10,11],"of":"SCAT","mode":"scatter"},"pay":[1,1,1],"trigger":"freespins"},{"on":{"occurs":[9,10,11,12,13,14,15],"of":"BONUS","mode":"scatter"},"pay":[0,0,0,0,0,0,0],"trigger":"holdAndSpinFS"}]},"paytable":{"line":[{"on":{"occurs":[3,4,5],"of":"PIC1","mode":"line"},"pay":[25,100,500]},{"on":{"occurs":[3,4,5],"of":"PIC2","mode":"line"},"pay":[20,80,400]},{"on":{"occurs":[3,4,5],"of":"PIC3","mode":"line"},"pay":[15,50,300]},{"on":{"occurs":[3,4,5],"of":"PIC4","mode":"line"},"pay":[10,40,200]},{"on":{"occurs":[3,4,5],"of":"ACE","mode":"line"},"pay":[10,25,100]},{"on":{"occurs":[3,4,5],"of":"KING","mode":"line"},"pay":[5,20,70]},{"on":{"occurs":[3,4,5],"of":"QUEEN","mode":"line"},"pay":[5,10,50]},{"on":{"occurs":[3,4,5],"of":"JACK","mode":"line"},"pay":[5,10,50]}],"scatter":[{"on":{"occurs":[3,4,5,6,7,8,9,10,11],"of":"SCAT","mode":"scatter"},"pay":[3,3,3,3,3,3,3,3,3],"trigger":"freespins"},{"on":{"occurs":[6,7,8,9,10,11,12,13,14,15],"of":"BONUS","mode":"scatter"},"pay":[0,0,0,0,0,0,0,0,0,0],"trigger":"holdAndSpin"}]}}}],"platform":{"balance":' . $Balance . '}}';
            }
            else if( $slotEvent['slotEvent'] == 'doInit' ) 
            { 
                $lastEvent = $slotSettings->GetHistory();
                $_obf_StrResponse = '';
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'JackpotWin', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'JackpotReel', [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]);
                $slotSettings->SetGameData($slotSettings->slotId . 'JackpotNumber', [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]);
                $slotSettings->SetGameData($slotSettings->slotId . 'JackpotLevel', 0);
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
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', $lastEvent->serverResponse->BonusMpl);
                    // $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastEvent->serverResponse->LastReel);
                    if($lastEvent->serverResponse->JackpotWin > 0){
                        $slotSettings->SetGameData($slotSettings->slotId . 'JackpotWin', $lastEvent->serverResponse->JackpotWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'JackpotLevel', $lastEvent->serverResponse->JackpotLevel);
                        $slotSettings->SetGameData($slotSettings->slotId . 'JackpotReel', $lastEvent->serverResponse->JackpotReels);
                        $slotSettings->SetGameData($slotSettings->slotId . 'JackpotNumber', $lastEvent->serverResponse->JackpotNumbers);
                    }                    
                    $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->lines);
                    $bet = $lastEvent->serverResponse->bet;
                }
                else
                {
                    $bet = $slotSettings->Bet[0];
                }
                $currentReelSet = 0;
                $spinType = 's';
                
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                {
                    $_obf_StrResponse = '&fs=' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .  '&fsres=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&tw=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&w=0.00&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . '';
                    $currentReelSet = 1;
                }
                if($slotSettings->GetGameData($slotSettings->slotId . 'JackpotWin') > 0){
                    $spinType = 'b';
                    $jackpotReel = $slotSettings->GetGameData($slotSettings->slotId . 'JackpotReel');
                    $jackpotLevel = $slotSettings->GetGameData($slotSettings->slotId . 'JackpotLevel');
                    $jackpotNumber = $slotSettings->GetGameData($slotSettings->slotId . 'JackpotNumber');
                    $win_mask = [];
                    for($i = 0; $i < count($jackpotReel); $i++){
                        if($jackpotReel[$i] > 0){
                            array_push($win_mask, 'pw');
                        }else{
                            array_push($win_mask, 'h');
                        }
                    }
                    $_obf_StrResponse = '&wins='. implode(',', $jackpotReel) .'&coef='. $bet * $slotSettings->GetGameData($slotSettings->slotId . 'Lines')  .
                        '&level='. $jackpotLevel .'&status='. implode(',', $jackpotNumber) .'&rw=0.00&lifes=1&wins_mask='. implode(',', $win_mask) .'&wp=0&end=0';

                }
                $lastReelStr = implode(',', $slotSettings->GetGameData($slotSettings->slotId . 'LastReel'));
                $Balance = $slotSettings->GetBalance();
                
                // $response = 'def_s=6,7,4,2,8,9,8,5,6,7,8,6,7,3,9&balance='. $Balance .'&cfgs=1&ver=2&mo_s=11&index=1&balance_cash='.$Balance.
                //     '&reel_set_size=2&def_sb=6,10,3,7,6&mo_v=25,50,75,100,125,150,175,200,250,350,400,450,500,600,750,2500&def_sa=3,7,6,11,9&mo_jp=750;2500;25000&balance_bonus=0.00&na='. $spinType.'&scatters=1~1,1,1,0,0~0,0,5,0,0~1,1,1,1,1&gmb=0,0,0&rt=d&mo_jp_mask=jp3;jp2;jp1&stime=' . floor(microtime(true) * 1000) .
                //     '&sa=3,7,6,11,9&sb=6,10,3,7,6&sc='. implode(',', $slotSettings->Bet) .'&defc=0.01&sh=3&wilds=2~500,250,25,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&n_reel_set='.$currentReelSet.$_obf_StrResponse.'&mo='.$strCurrentMoonValue.'&mo_t='.$strMoonText.
                //     '&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;500,250,25,0,0;400,150,20,0,0;300,100,15,0,0;200,50,10,0,0;50,20,10,0,0;50,20,5,0,0;50,20,5,0,0;50,20,5,0,0;0,0,0,0,0;0,0,0,0,0&l='.$slotSettings->GetGameData($slotSettings->slotId . 'Lines') .'&rtp=96.00&reel_set0=7,4,6,1,10,10,9,2,2,2,5,6,3,6,9,11,11,11,7,8,5,1,10,5,6,8,2,4,10~8,6,9,2,2,2,7,9,10,5,4,9,6,4,5,8,10,11,11,11,3,7,9~9,2,2,2,4,3,5,8,11,11,11,7,4,5,8,10,8,6,2,7,5,2,1,3,10,8~11,11,10,5,7,4,7,7,8,9,2,2,2,7,5,3,2,3,4,10,3,8,4,6,10,6,6,7~3,8,4,7,1,10,3,2,2,2,5,6,1,6,4,6,7,4,10,7,11,11,11,9,3,7,10,6,8,5,9,10,5&s='.$lastReelStr.'&reel_set1=4,3,5,10,6,4,6,2,2,2,4,6,7,5,8,3,6,9~5,5,5,10,10,10,3,3,3,1,1,1,4,4,4,7,9,9,9,6,6,6,11,11,11,6,7,7,7,3,4,2,2,2,8,8,8,3~2,2,2,8,8,8,3,5,5,5,4,4,4,7,9,9,9,6,6,6,11,11,11,6,7,7,7,3,4,10,10,10,3,3,3,1,1,1~1,1,1,8,8,8,3,5,5,5,4,4,4,7,9,9,9,6,6,6,11,11,11,3,4,10,10,10,3,3,3,2,2,2,6,7,7,7~5,1,6,9,2,2,2,6,8,10,3,3,4,7,6,5,4';
                $response = 'def_s=6,7,4,2,8,9,8,5,6,7,8,6,7,3,9&bgid=0&balance='. $Balance .'&cfgs=1&ver=2&mo_s=11&index=1&balance_cash='.$Balance.'&reel_set_size=2&def_sb=10,11,9,6,8&mo_v=25,50,75,125,200,250,300,375,450,500,625,750,875,0&def_sa=7,5,4,4,3&bonusInit=[{bgid:0,bgt:18,bg_i:"1000,200,100,50",bg_i_mask:"pw,pw,pw,pw"}]&mo_jp=0&balance_bonus=0.00&na='. $spinType .
                    '&scatters=1~0,0,1,0,0~0,0,8,0,0~1,1,1,1,1&gmb=0,0,0&bg_i=1000,200,100,50&rt=d&mo_jp_mask=jpb&stime=1609309922326&bgt=18&sa=7,5,4,4,3&sb=10,11,9,6,8&sc='. implode(',', $slotSettings->Bet) .'&defc=0.01&sh=3&wilds=2~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&n_reel_set='.$currentReelSet.$_obf_StrResponse.
                    '&bg_i_mask=pw,pw,pw,pw&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;500,50,10,0,0;300,50,10,0,0;250,25,10,0,0;200,25,10,0,0;100,15,5,0,0;100,15,5,0,0;100,15,5,0,0;100,15,5,0,0;0,0,0,0,0;0,0,0,0,0&l='.$slotSettings->GetGameData($slotSettings->slotId . 'Lines') .'&rtp=96.53&reel_set0=5,7,6,3,10,9,4,5,7,6,9,7,11,11,11,11,8,10,6,9,5,10,6,8,3,4,10,5,7,9,6,10,4,9,5,8,9,6,10,3,7,6,8,10,8,4,7,10,6,9,5,3,10,7~7,2,2,2,2,2,9,3,8,5,9,1,10,6,9,4,7,8,11,11,11,11,7,9,4,8,3,9,5,10,4,9,1,7,5,9,3,8,5,4,9,10,6,9,3,7,4,8,5,9,6,10~3,2,2,2,2,2,8,5,9,1,10,4,8,7,3,8,6,5,8,4,7,6,8,5,9,6,3,9,8,3,10,2,2,2,2,2,8,6,8,5,7,1,8,6,9,3,10,11,11~10,2,2,2,2,2,9,8,5,4,7,1,10,3,7,11,11,11,11,4,9,3,10,1,7,6,9,4,7,8,6,9,3,7,4,10,6,7,1,8,7,3,9,5,7,1,8,6,7,9,5,7,9,6,7,4,5,8,3~7,2,2,2,2,8,6,10,3,9,5,8,3,4,7,6,10,9,5,10,7,6,9,4,3,7,6,10,5,7,12,10,6,7,4,9,6,8,7,6,9,5,3,10,6,7,5,3,8,9,6,10,4,7,3,9,4,9,8&s='.$lastReelStr.'&reel_set1=5,7,6,3,10,9,4,5,7,6,9,7,11,11,11,5,8,10,6,9,5,6,10,8,3,4,10,11,11~7,2,2,2,2,2,9,3,8,5,9,1,10,6,9,4,7,8,11,11,11,5,7,9,4,8,3,9~3,2,2,2,2,2,8,5,9,1,10,4,8,11,11,11,6,5,8,4,7,1,8,5,9,6,3,9~10,2,2,2,2,2,2,2,2,4,7,1,10,3,7,5,11,11,11,4,9,3,10,1,7,6,9,4,8~12,2,2,9,6,10,12,9,5,8,3,4,9,6,10,3,9,10,12,6,9,3,7,12,10,8,8,3';
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
                $slotEvent['slotLines'] = 25;
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
                    if( $slotSettings->GetBalance() < ($lines * $betline) ) 
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
                $_spinSettings = $slotSettings->GetSpinSettings($slotEvent['slotEvent'], $betline * $lines, $lines);
                $winType = $_spinSettings[0];
                $_winAvaliableMoney = $_spinSettings[1];
                $_moneyValue = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];                
                $slotSettings->SetGameData($slotSettings->slotId . 'JackpotWin', 0);
                if($slotEvent['slotEvent'] == 'freespin'){
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
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
                    $moneyCollectSymbol = '12';
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
                    if($scattersCount >= 3){
                        $scattersWin = $lines * $betline;
                    }
                    $isMoney = false;
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
                    $jackpotWin = 0;
                    $moneyTotalWin = 0;
                    $isJackpot = false;
                    $jackpotPos = -1;
                    if($reels['reel5'][0] == $moneyCollectSymbol || $reels['reel5'][1] == $moneyCollectSymbol || $reels['reel5'][2] == $moneyCollectSymbol){
                        for($r = 0; $r < count($_moneyValue); $r++){
                            if($isJackpot==false && $_moneyValue[$r] > 0){
                                $jackpotWin = $slotSettings->GetJackpotMoney();
                                if($jackpotWin > 0){
                                    $isJackpot = true;
                                    $jackpotPos = $r;
                                    $_moneyValue[$r] = 0;
                                }
                            }
                            $moneyTotalWin = $moneyTotalWin + $_moneyValue[$r] * $betline;
                        }
                    }
                    $totalWin = $totalWin + $moneyTotalWin + $scattersWin; 
                    // if($isJackpot == true){
                    //     break;
                    // }
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
                        if( $scattersCount >= 3 && $winType != 'bonus' ) 
                        {
                        }
                        if( $isJackpot == true && $winType != 'bonus' ) 
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
                                if($jackpotWin + $totalWin < $_winAvaliableMoney){
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
                $isEndRespin = false;
                if( $totalWin > 0) 
                {
                    $spinType = 'c';
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), -1 * $totalWin);
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
                for($k = 0; $k < 3; $k++){
                    for($j = 1; $j <= 5; $j++){
                        $lastReel[($j - 1) + $k * 5] = $reels['reel'.$j][$k];
                    }
                }
                $strLastReel = implode(',', $lastReel);
                $strReelSa = $reels['reel1'][3].','.$reels['reel2'][3].','.$reels['reel3'][3].','.$reels['reel4'][3].','.$reels['reel5'][3];
                $strReelSb = $reels['reel1'][-1].','.$reels['reel2'][-1].','.$reels['reel3'][-1].','.$reels['reel4'][-1].','.$reels['reel5'][-1];
                $strFreeSpinResponse = '';
                if( $slotEvent['slotEvent'] == 'freespin' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    $spinType = 's';
                    $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                    {
                        $spinType = 'c';
                        $strFreeSpinResponse = '&fs_total='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&fswin_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsmul_total=1&fsres_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&n_reel_set=0';
                    }
                    else
                    {
                        $strFreeSpinResponse = '&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') . '&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&n_reel_set=1';
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
                        $strFreeSpinResponse = '&n_reel_set=1&fsmul=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&fswin=0.00&fs=1&fsres=0.00&psym=1~'.$totalWin.'~'.implode(',', $_obf_scatterposes);
                    }else{
                        $strFreeSpinResponse = '&n_reel_set=0';
                    }
                }
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                $slotSettings->SetGameData($slotSettings->slotId . 'JackpotLevel', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'JackpotReel', [0,0,0,0,0,0,0,0,0,0,0,0]);
                $slotSettings->SetGameData($slotSettings->slotId . 'JackpotNumber', [0,0,0,0,0,0,0,0,0,0,0,0]);
                $slotSettings->SetGameData($slotSettings->slotId . 'JackpotWin', $jackpotWin);
                $strMoneySymbolResponse = '';
                if($isMoney){                    
                    $strMoneySymbolResponse = '&mo=' . implode(',', $_moneyValue);
                    $CurrentMoneyText = [];
                    for($i = 0; $i < count($_moneyValue); $i++){
                        if($_moneyValue[$i] > 0){
                            $CurrentMoneyText[$i] = 'v';
                        }else{
                            $CurrentMoneyText[$i] = 'r';
                        }
                    }
                    if( $isJackpot == true) 
                    {
                        $spinType = 'b';
                        $CurrentMoneyText[$jackpotPos] = 'jpb';
                        $strMoneySymbolResponse = $strMoneySymbolResponse . '&wins=0,0,0,0,0,0,0,0,0,0,0,0&level=0&bg_i=1000,200,100,50&rw=0.00&bgt=18&lifes=1&bw=1&wins_mask=h,h,h,h,h,h,h,h,h,h,h,h&wp=0&end=0&bg_i_mask=pw,pw,pw,pw';
                    }
                    $strMoneySymbolResponse = $strMoneySymbolResponse . '&mo_t=' . implode(',', $CurrentMoneyText);
                    if($moneyTotalWin > 0){
                        $strMoneySymbolResponse = $strMoneySymbolResponse . '&mo_tv=' . ($moneyTotalWin / $betline) . '&mo_c=1&mo_tw=' . $moneyTotalWin;
                    }
                }
                $response = 'tw='.$totalWin.'&balance='.$Balance.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinLine. $strFreeSpinResponse. $strMoneySymbolResponse.'&stime=' . floor(microtime(true) * 1000) .
                        '&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=3&c='.$betline.'&sver=5&counter='. ((int)$slotEvent['counter'] + 1) .'&l=25&s='.$strLastReel.'&w='.$totalWin;
                


                if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0)) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                }
                
                // $slotSettings->SetGameData($slotSettings->slotId . 'JackpotWin', $lastEvent->serverResponse->JackpotWin);
                // $slotSettings->SetGameData($slotSettings->slotId . 'JackpotLevel', $lastEvent->serverResponse->JackpotLevel);
                // $slotSettings->SetGameData($slotSettings->slotId . 'JackpotReel', $lastEvent->serverResponse->JackpotReels);
                // $slotSettings->SetGameData($slotSettings->slotId . 'JackpotNumber', $lastEvent->serverResponse->JackpotNumbers);

                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . 
                    ',"JackpotWin":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'JackpotWin')) . ',"JackpotLevel":' . $slotSettings->GetGameData($slotSettings->slotId . 'JackpotLevel') . ',"JackpotReels":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'JackpotReel')) . ',"JackpotNumbers":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'JackpotNumber')) . 
                    ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . 
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
            else if( $slotEvent['slotEvent'] == 'doBonus' ){
                
                $lastEvent = $slotSettings->GetHistory();
                $betline = $lastEvent->serverResponse->bet;
                $jackpotLevel = $lastEvent->serverResponse->JackpotLevel + 1;
                $jackpotWin = $lastEvent->serverResponse->JackpotWin;
                $selectedMoneySymbol = $slotEvent['ind'];
                $lines = 25;
                if( $slotSettings->GetGameData($slotSettings->slotId . 'JackpotWin') <= 0 ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                    exit( $response );
                }else if($selectedMoneySymbol < 0){
                    $response = '{"responseEvent":"error","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                    exit( $response );
                }

                $slotSettings->SetGameData($slotSettings->slotId . 'JackpotLevel', $jackpotLevel);
                $bonusMpl = $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                $Balance = $slotSettings->GetBalance();
                $slotSettings->UpdateJackpots($betline * $lines);

                $_obf_winType = rand(1, $slotSettings->GetGambleSettings());
                $totalWin = 0;
                for($i = 0; $i < 2000; $i++){
                    if($i > 1500){
                        $moneyValue = $jackpotWin;                    
                    }else{
                        $randNum =  rand(1, 4);
                        $moneyValue = $slotSettings->money_jackpot[1][$randNum];                    
                    }
                    $jackpotReels = $lastEvent->serverResponse->JackpotReels;
                    $jackpotNumbers = $lastEvent->serverResponse->JackpotNumbers;
                    $jackpotReels[$selectedMoneySymbol] = $moneyValue;
                    $jackpotNumbers[$selectedMoneySymbol] = $jackpotLevel;
                    $jackpotCounts = [];
                    $jackpotCounts[50] = 0;
                    $jackpotCounts[100] = 0;
                    $jackpotCounts[200] = 0;
                    $jackpotCounts[1000] = 0;
                    for($r = 0; $r < count($jackpotReels); $r++){
                        if($jackpotReels[$r] == 50){
                            $jackpotCounts[50]++;
                        }else if($jackpotReels[$r] == 100){
                            $jackpotCounts[100]++;
                        }else if($jackpotReels[$r] == 200){
                            $jackpotCounts[200]++;
                        }else if($jackpotReels[$r] == 1000){
                            $jackpotCounts[1000]++;
                        }
                    }
                    if($jackpotCounts[$jackpotWin] == 3){
                        $totalWin = $jackpotWin * $betline * $lines;
                        break;
                    }
                    if($jackpotCounts[50] < 3 && $jackpotCounts[100] < 3 && $jackpotCounts[200] < 3 && $jackpotCounts[1000] < 3){
                        break;
                    }
                }
                
                $strWinResponse = '';
                $wins_mask = [];
                for($r = 0; $r < count($jackpotReels); $r++){
                    if($jackpotReels[$r] > 0){
                        array_push($wins_mask, 'pw');
                    }else{
                        array_push($wins_mask, 'h');
                    }
                }
                if($totalWin > 0){
                    $spinType = 'c';
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), -1 * $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    $strWinResponse = '&tw='. $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin').'&rw='. $totalWin .'&lifes=0&end=1&wp='. $jackpotWin.'&wins='. implode(',', $jackpotReels).
                        '&level='.$jackpotLevel . '&status='. implode(',', $jackpotNumbers);
                    $slotSettings->SetGameData($slotSettings->slotId . 'JackpotLevel', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'JackpotReel', [0,0,0,0,0,0,0,0,0,0,0,0]);
                    $slotSettings->SetGameData($slotSettings->slotId . 'JackpotNumber', [0,0,0,0,0,0,0,0,0,0,0,0]);
                    $slotSettings->SetGameData($slotSettings->slotId . 'JackpotWin', 0);
                    
                }else{
                    $spinType = 'b';
                    $strWinResponse = '&rw=0.00&lifes=1&end=0&wp=0&wins='. implode(',', $jackpotReels).'&level='.$jackpotLevel . '&status='. implode(',', $jackpotNumbers);
                    $slotSettings->SetGameData($slotSettings->slotId . 'JackpotLevel', $jackpotLevel);
                    $slotSettings->SetGameData($slotSettings->slotId . 'JackpotReel', $jackpotReels);
                    $slotSettings->SetGameData($slotSettings->slotId . 'JackpotNumber', $jackpotNumbers);
                    $slotSettings->SetGameData($slotSettings->slotId . 'JackpotWin', $jackpotWin);
                }
                $response = 'bgid=0&balance='.$Balance .'&coef='. ($betline * $lines) .'&index='. $slotEvent['index'] . '&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinResponse.
                    '&bg_i=1000,200,100,50&stime=' . floor(microtime(true) * 1000) .'&wins_mask=' . implode(',', $wins_mask).'&bgt=18&sver=5&bg_i_mask=pw,pw,pw,pw&counter='. ((int)$slotEvent['counter'] + 1);
                

                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . 
                    ',"JackpotWin":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'JackpotWin')) . ',"JackpotLevel":' . $slotSettings->GetGameData($slotSettings->slotId . 'JackpotLevel') . ',"JackpotReels":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'JackpotReel')) . ',"JackpotNumbers":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'JackpotNumber')) . 
                    ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""'.'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $totalWin, $slotEvent['slotEvent']);
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
