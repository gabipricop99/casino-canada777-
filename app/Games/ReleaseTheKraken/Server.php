<?php 
namespace VanguardLTE\Games\ReleaseTheKraken
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
            $linesId[27] = [4,4,2,4,4];
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
                $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 20);
                $slotSettings->setGameData($slotSettings->slotId . 'LastReel', [4,3,11,3,7,10,9,4,11,8,11,8,4,6,4,5,8,9,10,11]);
                $slotSettings->SetGameData($slotSettings->slotId . 'Bgt', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'Level', 0);
                $slotSettings->SetGameData($slotSettings->slotId . 'Wins', []);
                $slotSettings->SetGameData($slotSettings->slotId . 'Status', []);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeSpinNums', []);
                $slotSettings->SetGameData($slotSettings->slotId . 'RespinType', '');  // lwb, cw, iw
                $slotSettings->SetGameData($slotSettings->slotId . 'SubLevel', 0);
                $wp = 0;
                if( $lastEvent != 'NULL' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', $lastEvent->serverResponse->BonusMpl);
                    $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastEvent->serverResponse->LastReel);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->lines);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Bgt', $lastEvent->serverResponse->Bgt);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Level', $lastEvent->serverResponse->Level);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Wins', $lastEvent->serverResponse->Wins);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Status', $lastEvent->serverResponse->Status);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeSpinNums', $lastEvent->serverResponse->FreeSpinNums);
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinType', $lastEvent->serverResponse->RespinType);
                    $bet = $lastEvent->serverResponse->bet;
                }
                else
                {
                    $bet = $slotSettings->Bet[0];
                }
                $currentReelSet = 0;
                $spinType = 's';
                $_obf_StrResponse = '';
                $lastReel = $slotSettings->GetGameData($slotSettings->slotId . 'LastReel');
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
                if($slotSettings->GetGameData($slotSettings->slotId . 'Bgt') == 24){
                    $spinType = 'b';
                    $wins = $slotSettings->GetGameData($slotSettings->slotId . 'Wins');
                    $win_fs = 0;
                    $win_mask = [];
                    for($i = 0; $i < count($wins); $i++){
                        $win_fs = $win_fs + $wins[$i];
                        if($wins[$i] > 0){
                            array_push($win_mask, 'nff');
                        }else{
                            array_push($win_mask, 'h');
                        }
                    }
                    $_obf_StrResponse = '&win_mul=1&bgid=2&win_fs=6&wins='.implode(',', $wins).'&level='.$slotSettings->GetGameData($slotSettings->slotId . 'Level').'&status='.implode(',', $slotSettings->GetGameData($slotSettings->slotId . 'Status')).'&bgt=24&wins_mask='.implode(',', $win_mask).'&end=0';
                }else if($slotSettings->GetGameData($slotSettings->slotId . 'Bgt') == 34){
                    $spinType = 'b';
                    if(isset($lastEvent->serverResponse->wp)){
                        $wp = $lastEvent->serverResponse->wp;
                    }
                    $_obf_StrResponse = '&bgid=1&wins=0,0,0&coef='.($bet * $slotSettings->GetGameData($slotSettings->slotId . 'Lines')).'&level='.$slotSettings->GetGameData($slotSettings->slotId . 'Level').'&status=0,0,0&bgt=34&wins_mask=h,h,h&wp='.$wp.'&end=0&sublevel=0';
                }else if($slotSettings->GetGameData($slotSettings->slotId . 'Bgt') == 41){
                    if($slotSettings->GetGameData($slotSettings->slotId . 'RespinType') == ''){
                        $spinType = 'b';
                        $_obf_StrResponse = '&ls=0&bgid=0&wins=0,0,0&coef='.($bet * $slotSettings->GetGameData($slotSettings->slotId . 'Lines')).'&level=0&status=0,0,0&rw=0.00&bgt=41&lifes=1&bw=1&wins_mask=h,h,h&wp=0&end=0';
                    }else{
                        $_obf_StrResponse = 'bgid=0&coef='.($bet * $slotSettings->GetGameData($slotSettings->slotId . 'Lines')).'&level=1&rs=sm&rw=0.00&rs_p=0&bgt=41&rs_c=1&lifes=0&wp=0&end=1&rs_m=1&rs_f=' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinType');
                    }
                }else if($slotSettings->GetGameData($slotSettings->slotId . 'Bgt') == 43){
                    $spinType = 'b';
                    $wildPos = [];
                    for($k = 0; $k < 20; $k++){
                        if($lastReel[$k] == 2){
                            array_push($wildPos, $k);
                        }
                    }
                    $_obf_StrResponse = 'bgid=3&wins=0,0,0&level='.$slotSettings->GetGameData($slotSettings->slotId . 'Level').'&spn=0&status=0,0,0&bgt=43&wins_mask=h,h,h&end=0&win_p='. implode(',',$wildPos) .'&sublevel=0';
                }else if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')  <= $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0  ) 
                {
                    $spinType = 's';
                    $_obf_StrResponse = '&fs=' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . '&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') .  '&fsres=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&tw=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&w=0.00&fsmul=1&ls=1&aw=0&wmt=sc' . '&wmv=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . '&gwm=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . '&awt=6rl';
                    $currentReelSet = 1;
                }
                $lastReelStr = implode(',', $lastReel);
                $Balance = $slotSettings->GetBalance();
                
                // $response = 'def_s=6,7,4,2,8,4,3,5,6,7,8,5,7,3,4,4,3,5,6,7&balance='. $Balance . $_obf_StrResponse .'&cfgs=1&ver=2&mo_s=13&index=1&balance_cash='.$Balance.'&reel_set_size=2&def_sb=3,4,7,6,8&mo_v=40,80,120,160,200,240,280,320,400,560,640,720,800,960,2000,8000&def_sa=8,7,5,3,7&mo_jp=2000;8000;40000&balance_bonus=0.00&na='. $spinType .'&scatters=1~0,0,1,0,0~10,10,10,0,0~1,1,1,1,1&gmb=0,0,0&bg_i=2,3,5,2,3,5&rt=d&gameInfo={props:{max_rnd_sim:"1",max_rnd_hr:"62500000",max_rnd_win:"7000"}}&mo_jp_mask=jp3;jp2;jp1&stime=' . floor(microtime(true) * 1000) . '&sa=8,7,5,3,7&sb=3,4,7,6,8&sc='. implode(',', $slotSettings->Bet) .'&defc=0.01&sh=4&wilds=2~0,0,0,0,0~1,1,1,1,1;15~0,0,0,0,0~1,1,1,1,1;16~0,0,0,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&n_reel_set=0&bg_i_mask=bgm,bgm,bgm,fgm,fgm,fgm&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;500,100,20,2,0;500,100,20,2,0;300,50,15,2,0;300,50,15,2,0;200,40,10,2,0;200,40,10,2,0;75,25,5,0,0;75,25,5,0,0;50,15,5,0,0;50,15,5,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0&l=40&rtp=96.50&reel_set0=8,10,3,3,3,3,11,9,8,8,6,6,5,5,7,7,4,4,4,4,9,6,6,13,13,13,10,12,5,5,11,8,8,7,7~11,10,9,1,12,5,5,7,7,6,6,2,2,11,9,7,7,3,3,3,3,10,8,8,6,6,13,13,13,13,4,4,4,4,5,5,8,8~8,10,6,6,7,7,3,3,3,3,1,11,9,5,5,8,8,13,13,13,13,6,6,2,2,11,4,4,4,4,5,5,12,9,8,8,10,7,7~8,11,13,13,13,13,3,3,3,3,10,9,1,12,7,7,7,7,6,6,6,6,2,2,2,2,10,4,4,4,4,5,5,5,5,9,8,8,8,8,11~8,11,9,10,6,6,6,6,2,2,2,2,10,12,4,4,4,4,9,3,3,3,3,13,13,13,13,13,5,5,5,5,11,8,8,8,8,7,7,7,7&s='.$lastReelStr.'&reel_set1=8,10,3,3,3,3,11,9,8,8,6,6,5,5,7,7,4,4,4,4,9,6,6,13,13,13,10,12,5,5,11,8,8,7,7~11,10,9,1,12,5,5,7,7,6,6,2,2,11,15,15,15,15,9,7,7,16,16,16,16,10,8,8,6,6,13,13,13,13,5,5,8,8~8,10,16,16,16,16,6,6,7,7,1,11,9,15,15,15,15,5,5,8,8,13,13,13,13,6,6,2,2,11,5,5,12,9,8,8,10,7,7~8,11,13,13,13,13,10,16,16,16,16,9,1,12,7,7,7,7,6,6,6,6,15,15,15,15,2,2,2,2,10,5,5,5,5,9,8,8,8,8,11~8,11,9,10,6,6,6,6,2,2,2,2,10,16,16,16,16,12,9,13,13,13,13,13,5,5,5,5,11,15,15,15,15,8,8,8,8,7,7,7,7';
                $response = 'def_s=4,3,11,3,7,10,9,4,11,8,11,8,4,6,4,5,8,9,10,11&balance='. $Balance . $_obf_StrResponse .'&cfgs=1&ver=2&index=1&balance_cash='.$Balance.'&reel_set_size=3&def_sb=8,6,11,8,6&def_sa=9,3,7,10,4&reel_set='.$currentReelSet.'&balance_bonus=0.00&na='. $spinType .'&scatters=1~0,0,0,0,0~0,0,0,0,0~1,1,1,1,1&fs_aw=t&cls_s=-1&gmb=0,0,0&rt=d&gameInfo={props:{max_rnd_sim:"1",max_rnd_hr:"55555555",max_rnd_win:"3000"}}&stime=' . floor(microtime(true) * 1000) . '&sa=9,3,7,10,4&sb=8,6,11,8,6&sc='. implode(',', $slotSettings->Bet) .'&defc=0.10&sh=4&wilds=2~500,200,50,0,0~1,1,1,1,1;16~500,200,50,0,0~1,1,1,1,1&bonuses=0&fsbonus=&c='.$bet.'&sver=5&counter=2&paytable=0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;500,200,50,0,0;250,100,40,0,0;200,80,40,0,0;150,60,20,0,0;100,60,20,0,0;80,20,10,0,0;80,20,10,0,0;40,10,5,0,0;40,10,5,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0;0,0,0,0,0&l=20&rtp=96.50&total_bet_max=10,000.00&reel_set0=9,11,3,3,3,3,3,3,3,3,10,10,8,0,7,9,4,10,11,11,2,5,8,8,9,6,0,10,11,7,5,5,8,10,6,6,11,10,9,5,8,7,7,8,10,9,9,11,5,4,4,9,10~9,11,3,3,3,3,3,3,3,3,10,10,8,7,9,4,10,11,11,2,5,8,8,9,6,3,10,11,7,5,5,8,10,6,6,11,10,9,5,8,7,7,8,10,9,9,11,5,4,4,9,10~9,11,3,3,3,3,3,3,3,3,10,10,8,0,7,9,4,10,11,11,2,5,8,8,9,6,0,3,10,11,7,5,5,8,10,6,6,11,10,9,5,8,7,7,8,10,9,9,11,5,4,4,9,10~9,11,3,3,3,3,3,3,3,3,10,10,8,7,9,4,10,11,11,2,5,8,8,9,6,3,10,11,7,5,5,8,10,6,6,11,10,9,5,8,7,7,8,10,9,9,11,5,4,4,9,10~9,11,3,3,3,3,3,3,3,3,10,10,8,7,9,4,10,13,11,11,2,5,8,8,9,6,14,10,11,7,5,5,8,10,6,6,11,10,14,9,5,8,7,7,8,10,9,9,11,5,4,4,9,10&s='.$lastReelStr.'&reel_set2=11,11,11,11,3,3,3,3,3,3,3,3,9,9,9,9,2,10,10,10,10,0,4,4,4,4,7,7,7,7,8,8,8,8,5,5,5,5,11,11,11,11,6,6,6,6~11,11,11,11,3,3,3,3,3,3,3,3,9,9,9,9,2,10,10,10,10,4,4,4,4,3,7,7,7,7,8,8,8,8,5,5,5,5,11,11,11,11,6,6,6,6~11,11,11,11,3,3,3,3,3,3,3,3,9,9,9,9,2,10,10,10,10,0,4,4,4,4,3,7,7,7,7,8,8,8,8,5,5,5,5,11,11,11,11,6,6,6,6~11,11,11,11,3,3,3,3,3,3,3,3,9,9,9,9,2,10,10,10,10,4,4,4,4,3,7,7,7,7,8,8,8,8,5,5,11,11,11,11,6,6,6,6~11,11,11,11,3,3,3,3,3,3,3,3,9,9,9,9,2,10,10,10,10,4,4,4,4,7,7,7,7,13,8,8,8,8,5,5,5,5,14,11,11,11,11,6,6,6,6&reel_set1=9,11,3,3,3,3,3,3,3,3,10,10,8,7,9,4,10,11,11,5,8,8,9,6,3,10,11,7,5,5,8,10,6,6,11,10,9,5,8,7,7,8,10,9,9,11,5,4,4,9,10~9,11,3,3,3,3,3,3,3,3,10,10,8,7,9,4,10,11,11,5,8,8,9,6,3,10,11,7,5,5,8,10,6,6,11,10,9,5,8,7,7,8,10,9,9,11,5,4,4,9,10~9,11,3,3,3,3,3,3,3,3,10,10,8,7,9,4,10,11,11,5,8,8,9,6,3,10,11,7,5,5,8,10,6,6,11,10,9,5,8,7,7,8,10,9,9,11,5,4,4,9,10~9,11,3,3,3,3,3,3,3,3,10,10,8,7,9,4,10,11,11,5,8,8,9,6,3,10,11,7,5,5,8,10,6,6,11,10,9,5,8,7,7,8,10,9,9,11,5,4,4,9,10~9,11,3,3,3,3,3,3,3,3,10,10,8,7,9,4,10,11,11,5,8,8,9,6,3,10,11,7,5,5,8,10,6,6,11,10,9,5,8,7,7,8,10,9,9,11,5,4,4,9,10&purInit=[{type:"bg",bet:2000,game_id:2}]&total_bet_min=0.20';
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
                $isBuyFreeSpin = false;
                if(isset($slotEvent['pur']) && $slotEvent['pur'] == 0){
                    $isBuyFreeSpin = true;
                }
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') <= $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                {
                    $slotEvent['slotEvent'] = 'freespin';
                    $slotEvent['slotLines'] = 40;
                    $isBuyFreeSpin = false;
                }else{
                    $slotEvent['slotLines'] = 20;
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
                if($isBuyFreeSpin == true){
                    $winType = 'bonus';
                    $_winAvaliableMoney = $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''));
                             
                }else{
                    $_spinSettings = $slotSettings->GetSpinSettings($slotEvent['slotEvent'], $betline * $lines, $lines);
                    $winType = $_spinSettings[0];
                    $_winAvaliableMoney = $_spinSettings[1];          
                }
                $slotSettings->SetGameData($slotSettings->slotId . 'JackpotWin', 0);
                $isRespin = false;
                $respinType = '';
                $isGeneration = false;
                if($slotEvent['slotEvent'] == 'freespin'){
                    $isBuyFreeSpin = false;
                    $bonusMpl = $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl');
                    if($slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') == 1 && rand(0, 100) < 50){
                        $isGeneration = true;
                    }else if($slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') == 2 && $bonusMpl <= 1){
                        $isGeneration = true;
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                }
                else
                {
                    $slotEvent['slotEvent'] = 'bet';
                    if($slotSettings->GetGameData($slotSettings->slotId . 'RespinType') == ''){
                        if($isBuyFreeSpin == true){
                            $slotSettings->SetBalance(-1 * ($betline * 2000), $slotEvent['slotEvent']);
                            $_sum = ($betline * 2000) / 100 * $slotSettings->GetPercent();
                        }else{
                            $slotSettings->SetBalance(-1 * ($betline * $lines), $slotEvent['slotEvent']);
                            $_sum = ($betline * $lines) / 100 * $slotSettings->GetPercent();
                        }
                        $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), $_sum, $slotEvent['slotEvent'], $isBuyFreeSpin);
                    }else{
                        $isRespin = true;
                        $respinType = $slotSettings->GetGameData($slotSettings->slotId . 'RespinType');
                        $slotSettings->SetGameData($slotSettings->slotId . 'RespinType', '');
                        $winType = 'win';
                        $_winAvaliableMoney = $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''));
                    }
                    $bonusMpl = 1;
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $slotSettings->GetBalance());
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusState', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Bgt', 0);
                }
                $Balance = $slotSettings->GetBalance();
                if( $slotEvent['slotEvent'] == 'bet' ) 
                {
                    $slotSettings->UpdateJackpots($betline * $lines);
                }
                if($slotEvent['slotEvent'] != 'freespin' && $isBuyFreeSpin == false && $isRespin == false && $winType == 'win' && $slotSettings->IsRespinState() == true){
                    $lastReel = [15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15];
                    $bgt = 41;
                    $level = 0;
                    $wins = [0,0,0];
                    $status = [0,0,0];
                    $freeSpinNums = [];
                    $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Bgt', $bgt);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Level', $level);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Wins', $wins);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Status', $status);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeSpinNums', $freeSpinNums);
                    $totalWin = 0;
                    $response = 'tw=0.00&ls=0&bgid=0&balance='.$Balance.'&wins=0,0,0&coef='.($betline * $lines).'&level=0&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&reel_set=1&balance_bonus=0.00&na=b&status=0,0,0&rw=0.00&stime=' . floor(microtime(true) * 1000) .'&bgt=41&sa=11,9,10,4,3&sb=7,8,4,9,3&lifes=1&bw=1&sh=4&wins_mask=h,h,h&wp=0&end=0&c='.$betline.'&sver=5&counter='. ((int)$slotEvent['counter'] + 1) .'&l='. $lines .'&s=15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15&w=0.00';
                    
                    $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                        $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Bgt":' . $bgt . ',"RespinType":"' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinType') . '","Level":' . $level.',"Wins":' . json_encode($wins) .',"Status":' . json_encode($status) .',"FreeSpinNums":' . json_encode($freeSpinNums) . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . ',"LastReel":'.json_encode($lastReel).'}}';
                    $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $totalWin, $slotEvent['slotEvent']);
                    exit( $response );
                }
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $totalWin = 0;
                    $lineWins = [];
                    $lineWinNum = [];
                    $wild = 2;
                    $scatter = 0;
                    $_obf_winCount = 0;
                    $strWinLine = '';
                    $iwcenterposes = [];
                    if($isRespin == true){
                        $tempReels = $slotSettings->GetReelStrips($winType, 'freespin', false);
                    }else{
                        $tempReels = $slotSettings->GetReelStrips($winType, $slotEvent['slotEvent'], $isBuyFreeSpin);
                    }
                    $wildPoses = [];
                    $wildPosCount = 0;
                    if($slotEvent['slotEvent'] == 'freespin'){
                        if(rand(0, 100) > 90 || $isGeneration == true){
                            $pos = rand(0, 19);  
                            $tempReels['reel' . ($pos % 5 + 1)][floor($pos / 5)] = 2;
                        }
                    }
                    $respinWildPos = [[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,0]];
                    if($respinType == 'cw'){
                        $posx = rand(0, 3);
                        $posy = rand(0, 3);
                        for($k = -1; $k < 2; $k++){
                            for($r = -1; $r < 2; $r++){
                                if(($posx + $k) >= 0 && ($posx + $k) < 5 && ($posy + $r) >= 0 && ($posy + $r) < 4){
                                    $respinWildPos[$posx + $k][$posy + $r] = 2;
                                }
                            }
                        }
                    }else if($respinType == 'iw'){
                        $iwcount = $slotSettings->GetIWCount();
                        while($iwcount > 0){
                            $posx = rand(0, 4);
                            $posy = rand(0, 3);
                            if($respinWildPos[$posx][$posy] != 2){
                                $iwcount--;
                                array_push($iwcenterposes, $posx + $posy * 5);
                                for($k = -1; $k < 2; $k++){
                                    if(($posx + $k) >= 0 && ($posx + $k) < 5){
                                        $respinWildPos[$posx + $k][$posy] = 2;
                                    }
                                    if(($posy + $k) >= 0 && ($posy + $k) < 4){
                                        $respinWildPos[$posx][$posy + $k] = 2;
                                    }
                                }
                            }
                        }
                    }else if($respinType == 'lwb'){
                        $wildcount = $slotSettings->GetLWBCount();
                        while($wildcount >= 0){
                            $pos = rand(0, 19);  
                            if($tempReels['reel' . ($pos % 5 + 1)][floor($pos / 5)] != 2){
                                $tempReels['reel' . ($pos % 5 + 1)][floor($pos / 5)] = 2;
                                $wildcount--;
                            }
                        }
                    }

                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        $reels['reel' . $r] = [];
                        for( $k = 0; $k < 4; $k++ ) 
                        {
                            if($respinWildPos[$r - 1][$k] > 0){
                                $reels['reel' . $r][$k] = $respinWildPos[$r - 1][$k];
                            }else{
                                $reels['reel' . $r][$k] = $tempReels['reel' . $r][$k];
                            }
                        }
                    }
                    if($bonusMpl > 1){
                        for($k = 0; $k < $bonusMpl - 1; $k++){
                            while(true){
                                $pos = rand(0, 19);
                                if($reels['reel' . ($pos % 5 + 1)][floor($pos / 5)] != 2){
                                    $reels['reel' . ($pos % 5 + 1)][floor($pos / 5)] = 2;
                                    break;
                                }
                            }
                        }
                    }
                    $_obf_scatterposes = [];
                    $scattersCount = 0;
                    $scattersWin = 0;
                    $isChestBonus = false;
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        for( $k = 0; $k < 4; $k++ ) 
                        {
                            if( $reels['reel' . $r][$k] == $scatter ||  $reels['reel' . $r][$k] == 13 || $reels['reel' . $r][$k] == 14) 
                            {
                                $scattersCount++;
                                array_push($_obf_scatterposes, $k * 5 + $r - 1);
                                if($reels['reel' . $r][$k] == 13){
                                    $isChestBonus = true;
                                }
                            }else if( $reels['reel' . $r][$k] == $wild) 
                            {
                                $wildPosCount++;
                                array_push($wildPoses, $k * 5 + $r - 1);
                            }
                        }
                    }
                    $mul = 1;
                    if($slotEvent['slotEvent'] == 'freespin'){
                        $mul = $wildPosCount + 1;
                    }
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
                            }else if($ele == $firstEle || $ele == $wild ){
                                $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                if($j == 4){
                                    $lineWins[$k] = $slotSettings->Paytable[$firstEle][$lineWinNum[$k]] * $betline * $mul;
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
                                    $lineWins[$k] = $slotSettings->Paytable[$firstEle][$lineWinNum[$k]] * $betline * $mul;
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
                    $freeSpinNums = [];
                    if($scattersCount >= 3 && $isChestBonus == false){
                        $freeSpinNums = $slotSettings->GenerateFreeSpinCount();
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
                    }
                }
                $spinType = 's';
                $isEndRespin = false;
                if($respinType == 'lwb'){
                    $totalWin = 0; 
                }
                if($totalWin > 0){
                    $spinType = 'c';
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), -1 * $totalWin);
                    if($isWelcomeFreespin == 1){
                        $slotSettings->SetWelcomeBonus($totalWin);
                    }
                }

                $_obf_totalWin = $totalWin;

                // if( $scattersCount >= 3 ) 
                // {
                //     if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') == 0 ) 
                //     {
                //         $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 1);
                //         $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->slotFreeCount);
                //         $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 1);
                //     }
                //     else
                //     {
                //         $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $slotSettings->slotFreeCount);
                //     }
                // }
                $lastReel = [];
                $initReel = [];
                for($k = 0; $k < 4; $k++){
                    for($j = 1; $j <= 5; $j++){
                        $lastReel[($j - 1) + $k * 5] = $reels['reel'.$j][$k];
                        $initReel[($j - 1) + $k * 5] = $tempReels['reel'.$j][$k];
                    }
                }
                $strLastReel = implode(',', $lastReel);
                $strInitReel = implode(',', $initReel);
                $strReelSa = $tempReels['reel1'][4].','.$tempReels['reel2'][4].','.$tempReels['reel3'][4].','.$tempReels['reel4'][4].','.$tempReels['reel5'][4];
                $strReelSb = $tempReels['reel1'][-1].','.$tempReels['reel2'][-1].','.$tempReels['reel3'][-1].','.$tempReels['reel4'][-1].','.$tempReels['reel5'][-1];
                $strOtherResponse = '';
                $wins = [];
                $status = [];
                $level = 0;
                $bgt = 0;
                $slotSettings->SetGameData($slotSettings->slotId . 'SubLevel', 0);
                if( $slotEvent['slotEvent'] == 'freespin' ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);

                    $spinType = 's';
                    $Balance = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', $mul);
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                    {
                        $spinType = 'c';
                        $strOtherResponse = '&fs_total='.$slotSettings->GetGameData($slotSettings->slotId . 'FreeGames').'&ls=1&fswin_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . '&fsmul_total=1&fsres_total=' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                    }
                    else
                    {
                        $strOtherResponse = '&fsmul=1&fsmax=' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') .'&fs='. $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame').'&fswin=' . $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') .'&fsres='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                    }
                    $strOtherResponse = $strOtherResponse . '&ls=1&is=' . $strInitReel .'&reel_set=1&aw=0&wmt=sc' . '&wmv='. $mul.'&gwm='. $mul .'&awt=6rl';
                    if(count($wildPoses) > 0){
                        $strOtherResponse = $strOtherResponse . '&rwd=2~' . implode(',', $wildPoses) . '&wnd=2~' . implode(',', $wildPoses);
                    }
                }else
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 1);
                    if($isRespin == true){
                        if($respinType == 'lwb'){
                            $spinType = 'b';
                            $bgt = 43;
                            $wins = [0,0,0];
                            $status = [0,0,0];
                            $strOtherResponse = '&ls=0&bgid=3&wins=0,0,0&level=0&reel_set=1&spn=1&status=0,0,0&rs_t=1&bgt=43&rs_win='.$totalWin.'&bw=1&wins_mask=h,h,h&end=0&rs_f=lwb&cwin_p=' . implode(',', $wildPoses) . '&win_p=' . implode(',', $wildPoses) . '&sublevel=0';
                        }else{
                            $strOtherResponse = '&ls=0&is=' . $strInitReel .'&reel_set=1&rs_t=1&rs_win='.$totalWin.'&rs_f='.$respinType;                            
                            if($respinType == 'iw'){
                                $iwwildposes = [];
                                for($k = 0; $k < count($wildPoses); $k++){
                                    $issame = false;
                                    for($r = 0; $r < count($iwcenterposes); $r++){
                                        if($wildPoses[$k] == $iwcenterposes[$r]){
                                            $issame = true;
                                            break;
                                        }
                                    }
                                    if($issame == false){
                                        array_push($iwwildposes, $wildPoses[$k]);
                                    }
                                }
                                $strOtherResponse = $strOtherResponse . '&rwd=2~' . implode(',', $iwwildposes) . ';16~' . implode(',', $iwcenterposes);
                            }else{
                                $strOtherResponse = $strOtherResponse . '&rwd=2~' . implode(',', $wildPoses);
                            }
                            $bgt = 0;
                        }
                    }else if($scattersCount >=3 ){
                        $spinType = 'b';
                        if($isChestBonus == true){
                            $strOtherResponse = '&ls=0&bgid=1&wins=0,0,0&coef=' . ($betline * $lines) . '&level=1&reel_set=0&status=0,0,0&bgt=34&bw=1&wins_mask=h,h,h&wp=0&end=0&sublevel=0';
                            $wins = [0,0,0];
                            $status = [0,0,0];
                            $bgt = 34;
                        }else{
                            $strOtherResponse = '&ls=0&win_mul=1&bgid=2&win_fs=0&wins=0,0,0,0,0,0,0,0,0,0&level=0&reel_set=0&status=0,0,0,0,0,0,0,0,0,0&bgt=24&bw=1&wins_mask=h,h,h,h,h,h,h,h,h,h&end=0';
                            $wins = [0,0,0,0,0,0,0,0,0,0];
                            $status = [0,0,0,0,0,0,0,0,0,0];
                            $bgt = 24;
                        }
                    }else{
                        $strOtherResponse = '&reel_set=0';
                    }
                }
                $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                $slotSettings->SetGameData($slotSettings->slotId . 'Bgt', $bgt);
                $slotSettings->SetGameData($slotSettings->slotId . 'Level', $level);
                $slotSettings->SetGameData($slotSettings->slotId . 'Wins', $wins);
                $slotSettings->SetGameData($slotSettings->slotId . 'Status', $status);
                $slotSettings->SetGameData($slotSettings->slotId . 'FreeSpinNums', $freeSpinNums);
                $response = 'tw='.$slotSettings->GetGameData($slotSettings->slotId . 'BonusWin').'&balance='.$Balance.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.$strWinLine. $strOtherResponse.'&stime=' . floor(microtime(true) * 1000) .'&sa='.$strReelSa.'&sb='.$strReelSb.'&sh=4&c='.$betline.'&sver=5&counter='. ((int)$slotEvent['counter'] + 1) .'&l='. $lines .'&s='.$strLastReel.'&w='.$totalWin;
                


                if( ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + 1 <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0)) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0); 
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                }
                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Bgt":' . $bgt . ',"RespinType":"' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinType') . '","Level":' . $level.',"Wins":' . json_encode($wins) .',"Status":' . json_encode($status) .',"FreeSpinNums":' . json_encode($freeSpinNums) . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . ',"LastReel":'.json_encode($lastReel).'}}';
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
                $lines = 20;
                $bgt = $slotSettings->GetGameData($slotSettings->slotId . 'Bgt');
                $level = $slotSettings->GetGameData($slotSettings->slotId . 'Level');
                $wins = $slotSettings->GetGameData($slotSettings->slotId . 'Wins');
                $status = $slotSettings->GetGameData($slotSettings->slotId . 'Status');
                $ind = $slotEvent['ind'];
                $wp = 0;
                $totalWin = 0;
                $allBet = $betline * $lines;
                if($bgt == 24){
                    $freeSpinNums = $slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinNums');
                    $level = $level + 1;
                    $status[$ind] = $level;
                    $wins_mask = [];
                    $win_fs = 0;
                    if($level <= count($freeSpinNums)){
                        $wins[$ind] = $freeSpinNums[$level - 1];
                        for($k = 0; $k < count($wins); $k++){
                            if($wins[$k] == 0){
                                array_push($wins_mask, 'h');
                            }else{
                                array_push($wins_mask, 'nff');
                            }
                            $win_fs = $win_fs + $wins[$k];
                        }
                        $slotSettings->SetGameData($slotSettings->slotId . 'Level', $level);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Wins', $wins);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Status', $status);
                        $response = 'win_mul=1&bgid=2&balance='.$Balance.'&win_fs='.$win_fs.'&wins='. implode(',', $wins) .'&level='.$level.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na=b&status='. implode(',', $status) .'&stime=' . floor(microtime(true) * 1000) .'&bgt=24&wins_mask='. implode(',', $wins_mask) .'&end=0&sver=5&counter='. ((int)$slotEvent['counter'] + 1);
                    }else{
                        $wins[$ind] = 1;
                        for($k = 0; $k < count($freeSpinNums); $k++){
                            $win_fs = $win_fs + $freeSpinNums[$k];
                        }
                        for($k = 0; $k < count($wins); $k++){
                            if($ind == $k){
                                array_push($wins_mask, 'np_fn');
                            }else if($wins[$k] == 0){
                                array_push($wins_mask, 'h');
                            }else{
                                array_push($wins_mask, 'nff');
                            }
                        }
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusMpl', 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $win_fs);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Bgt', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Level', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Wins', []);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Status', []);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeSpinNums', []);
                        $response = 'tw=0.00&fsmul=1&win_mul=1&bgid=2&balance='.$Balance.'&win_fs='.$win_fs.'&wins='. implode(',', $wins) .'&fsmax='.$win_fs.'&level='.$level.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na=s&fswin=0.00&status='. implode(',', $status) .'&stime=' . floor(microtime(true) * 1000) .'&fs=1&bgt=24&wins_mask='. implode(',', $wins_mask) .'&end=1&fsres=0.00&sver=5&counter='. ((int)$slotEvent['counter'] + 1);
                    }
                }else if($bgt == 34){                    
                    $subLevel = $slotSettings->GetGameData($slotSettings->slotId . 'SubLevel');
                    if(isset($lastEvent->serverResponse->Wp)){
                        $wp = $lastEvent->serverResponse->Wp;
                    }
                    if($subLevel == 0){
                        $level = $level + 1;
                        $subLevel = 1;
                        $_winAvaliableMoney = $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''));
                        $limitBoxCount = rand(4, 6);
                        if(($level > 3 && rand(0, 100) > 80) || $level >= $limitBoxCount){
                            $winType = 'none';
                        }else{
                            $winType = 'win';
                        }
                        for($i = 0; $i < 100; $i++){
                            $emptyMulIndex = rand(0, 2);
                            $win_mask = [];
                            $wins = [0,0,0];
                            for($k = 0; $k < 3; $k++){
                                if($emptyMulIndex == $k){
                                    $wins[$k] = 0;
                                    array_push($win_mask, 'np');
                                }else{
                                    $wins[$k] = rand(2, 10);
                                    array_push($win_mask, 'mul');
                                }
                            }
                            $status = [0,0,0];
                            $subWp = $wins[$ind];
                            $status[$ind] = 1;
                            $totalWin = ($wp + $subWp) * $allBet;
                            if($i > 50){
                                $winType = 'none';
                            }else if($winType == 'none' && $subWp == 0){
                                break;
                            }else if($winType == 'win' && $subWp > 0 && $totalWin < $_winAvaliableMoney){
                                break;
                            }
                        }
                        $wp = $wp + $subWp;
                        $spinType = 'b';
                        $otherResponse = '';
                        if($subWp == 0){
                            if( $totalWin > 0) 
                            {
                                $spinType = 'cb';
                                $slotSettings->SetBalance($totalWin);
                                $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), -1 * $totalWin);
                                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                                 $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);

                            }
                            $slotSettings->SetGameData($slotSettings->slotId . 'Bgt', 0);
                            $otherResponse = '&rw='.$totalWin.'&end=1';
                        }else{
                            $otherResponse = '&end=0';
                        }
                    }else{
                        $status = [0,0,0];
                        $wins = [0,0,0];
                        $subLevel = 0;
                        $spinType = 'b';
                        $win_mask = ['h', 'h', 'h'];
                        $otherResponse = '&end=0';
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'Level', $level);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Wins', $wins);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Status', $status);
                    $slotSettings->SetGameData($slotSettings->slotId . 'SubLevel', $subLevel);
                    $response = 'tw='.$slotSettings->GetGameData($slotSettings->slotId . 'TotalWin').'&bgid=1&balance='.$Balance . $otherResponse .'&wins='. implode(',', $wins).'&coef='.$allBet.'&level='.$level.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.'&status='.implode(',', $status).'&stime=' . floor(microtime(true) * 1000) .'&bgt='.$bgt.'&wins_mask='.implode(',', $win_mask).'&wp='.$wp.'&sver=5&counter='. ((int)$slotEvent['counter'] + 1).'&sublevel=' . $subLevel;
                }else if($bgt == 41){    
                    $respinTypes = ['lwb', 'cw', 'iw'];
                    shuffle($respinTypes);
                    $respinType = $respinTypes[$ind];
                    $status = [0,0,0];
                    $wins = [0,0,0];
                    $subLevel = 0;
                    $win_mask = ['h', 'h', 'h'];
                    $status[$ind] = 1;
                    $wins[$ind] = 1;
                    $level = $level + 1;
                    $win_mask[$ind] = $respinType;
                    $slotSettings->SetGameData($slotSettings->slotId . 'RespinType', $respinType);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Level', $level);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Wins', $wins);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Status', $status);
                    $response = 'bgid=0&balance='.$Balance . '&wins='. implode(',', $wins).'&coef='.$allBet.'&level=1&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na=s&status='.implode(',', $status).'&rs=sm&rw=0.00&rs_p=0&stime=' . floor(microtime(true) * 1000) .'&bgt=41&rs_c=1&lifes=0&wins_mask='.implode(',', $win_mask).'&wp=0&end=1&rs_m=1&rs_f='.$respinType.'&sver=5&counter='. ((int)$slotEvent['counter'] + 1);
                }else if($bgt == 43){
                    // c, s = continue, ws = wild&continue, wc = wild&collect, mc = multi&collect, sc = continue&collect
                    $subLevel = $slotSettings->GetGameData($slotSettings->slotId . 'SubLevel');
                    if($subLevel == 0){
                        $level = $level + 1;
                        $subLevel = 1;
                        $_winAvaliableMoney = $slotSettings->GetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''));
                        if($level > 3 && rand(0, 100) > 80){
                            $winType = 'none';
                        }else{
                            $winType = 'win';
                        }
                        $limitBoxCount = rand(4, 5);
                        while(true){                            
                            $win_mask = $slotSettings->GetKrakenLockWild();
                            $type = $win_mask[$ind];
                            if($level < $limitBoxCount){
                                if($type == 'c' || $type == 'wc' || $type == 'mc' || $type == 'sc'){
                                    continue;
                                }else{
                                    break;
                                }
                            }else{
                                break;
                            }
                        }
                        $status = [0,0,0];
                        $status[$ind] = 1;
                        $wildPoses = [];
                        $lastReel = $slotSettings->GetGameData($slotSettings->slotId . 'LastReel');
                        for($k = 0; $k < 20; $k++){
                            if($lastReel[$k] == 2){
                                array_push($wildPoses, $k);
                            }
                        }
                        for($i = 0; $i < 100; $i++){
                            $reels = [];
                            $wins = [1,1,1];
                            $newWildPoses = [];
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                $reels['reel' . $r] = [];
                                for( $k = 0; $k < 4; $k++ ) 
                                {
                                    $reels['reel' . $r][$k] = $lastReel[($r - 1) + $k * 5];
                                }
                            }
                            if($type == 'wc' || $type == 'ws'){
                                $newWildCount = $slotSettings->GetLWBCount();
                                while($newWildCount > 0){
                                    $posx = rand(0, 4);
                                    $posy = rand(0, 3);
                                    if($reels['reel' . ($posx + 1)][$posy] != 2){
                                        $reels['reel' . ($posx + 1)][$posy] = 2;
                                        $newWildCount--;
                                        array_push($newWildPoses, ($posx + $posy * 5));
                                    }
                                }
                            }
                            $mul = 1;
                            if($type == 'mc'){
                                $mul = 2;
                                $wins[$ind] = 2;
                            }
                            $totalWin = 0;
                            $wild = 2;
                            $lineWins = [];
                            $lineWinNum = [];
                            $_lineWinNumber = 1;
                            $_obf_winCount = 0;
                            $strWinLine = '';
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
                                    }else if($ele == $firstEle || $ele == $wild ){
                                        $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                        if($j == 4){
                                            $lineWins[$k] = $slotSettings->Paytable[$firstEle][$lineWinNum[$k]] * $betline * $mul;
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
                                            $lineWins[$k] = $slotSettings->Paytable[$firstEle][$lineWinNum[$k]] * $betline * $mul;
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
                            if($i > 50){
                                $winType = 'none';
                                $win_mask[$ind] = 'c';
                                $type = $win_mask[$ind];
                            }else if($totalWin > 0 && $totalWin < $_winAvaliableMoney){
                                break;
                            }
                        }
                        $lastReel = [];
                        for($k = 0; $k < 4; $k++){
                            for($j = 1; $j <= 5; $j++){
                                $lastReel[($j - 1) + $k * 5] = $reels['reel'.$j][$k];
                            }
                        }
                        $slotSettings->SetGameData($slotSettings->slotId . 'LastReel', $lastReel);
                        // c, s = continue, ws = wild&continue, wc = wild&collect, mc = multi&collect, sc = continue&collect
                        $spinType = 'b';
                        $otherResponse = '';
                        $spn = $subLevel;
                        if($type == 'c' || $type == 'wc' || $type == 'mc' || $type == 'sc'){
                            if( $totalWin > 0) 
                            {
                                $spinType = 'cb';
                                $slotSettings->SetBalance($totalWin);
                                $slotSettings->SetBank((isset($slotEvent['slotEvent']) ? $slotEvent['slotEvent'] : ''), -1 * $totalWin);
                                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                                 $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                                 $spn = 0;
                            }else{
                                $spinType = 'sb';
                            }
                            $slotSettings->SetGameData($slotSettings->slotId . 'Bgt', 0);
                            $otherResponse = '&tw='.$slotSettings->GetGameData($slotSettings->slotId . 'TotalWin').$strWinLine.'&mul='. $mul .'&rw='.$totalWin.'&end=1';
                        }else{
                            $otherResponse = '&end=0';
                        }
                        if(count($newWildPoses) > 0){
                            for($k = 0; $k < count($newWildPoses); $k++){
                                array_push($wildPoses, $newWildPoses[$k]);
                            }
                            $otherResponse = $otherResponse . '&cwin_p='. implode(',', $newWildPoses);
                        }
                    }else{
                        $status = [0,0,0];
                        $wins = [0,0,0];
                        $subLevel = 0;
                        $spn = $subLevel;
                        $spinType = 'b';
                        $win_mask = ['h', 'h', 'h'];
                        $otherResponse = '&end=0';
                        $wildPoses = [];
                        $lastReel = $slotSettings->GetGameData($slotSettings->slotId . 'LastReel');
                        for($k = 0; $k < 20; $k++){
                            if($lastReel[$k] == 2){
                                array_push($wildPoses, $k);
                            }
                        }
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'Level', $level);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Wins', $wins);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Status', $status);
                    $slotSettings->SetGameData($slotSettings->slotId . 'SubLevel', $subLevel);
                    $response = 'bgid=3&spn='.$spn.'&balance='.$Balance . $otherResponse .'&wins='. implode(',', $wins).'&level='.$level.'&index='.$slotEvent['index'].'&balance_cash='.$Balance.'&balance_bonus=0.00&na='.$spinType.'&status='.implode(',', $status).'&stime=' . floor(microtime(true) * 1000) .'&bgt='.$bgt.'&wins_mask='.implode(',', $win_mask).'&win_p='.implode(',', $wildPoses).'&sver=5&counter='. ((int)$slotEvent['counter'] + 1).'&s='.implode(',', $lastReel).'&sublevel=' . $subLevel;
                }
                
                
                $_GameLog = '{"responseEvent":"spin","responseType":"' . $slotEvent['slotEvent'] . '","serverResponse":{"BonusMpl":' . 
                    $slotSettings->GetGameData($slotSettings->slotId . 'BonusMpl') . ',"lines":' . $lines . ',"bet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')  . ',"RespinType":"' . $slotSettings->GetGameData($slotSettings->slotId . 'RespinType') . '","Bgt":' . $slotSettings->GetGameData($slotSettings->slotId . 'Bgt') . ',"Level":' . $slotSettings->GetGameData($slotSettings->slotId . 'Level').',"Wins":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'Wins')) .',"Status":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'Status')) .',"FreeSpinNums":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'FreeSpinNums')) . ',"Balance":' . $Balance . ',"Wp":' . $wp . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"winLines":[],"Jackpots":""' . ',"LastReel":'.json_encode($slotSettings->GetGameData($slotSettings->slotId . 'LastReel')).'}}';
                $slotSettings->SaveLogReport($_GameLog, $betline * $lines, $lines, $totalWin, $slotEvent['slotEvent']);
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
