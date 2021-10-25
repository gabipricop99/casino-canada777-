<?php 
namespace VanguardLTE\Games\BookOfTombGM
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
            \DB::beginTransaction();
            // $userId = \Auth::id();// changed by game developer
            if( $userId == null ) 
            {
            	$userId = 1;
            }
            $user = \VanguardLTE\User::lockForUpdate()->find($userId);
            $requestData = $_REQUEST;
            $paramData = json_decode(trim(file_get_contents('php://input')), true);
            // $userBalance = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
            $responseData = [];
            $slotEvent = $paramData['SlotEvent'];
            $credits = $userId == 1 ? $slotEvent === 'getSettings' ? 5000 : $user->balance : null;
            $slotSettings = new SlotSettings($game, $userId, $credits);

            $userBalance = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
            $leftFreeSpinBonus = $slotSettings->GetBonusFreeSpin();
            if( $slotEvent == 'gambleCard' && $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') <= 0 ) 
            {
                $response = '{"responseEvent":"error","responseType":"' . $slotEvent . '","serverResponse":"invalid gamble state"}';
                exit( $response );
            }
            if( $slotEvent == 'bet') 
            {
                if($leftFreeSpinBonus <= 0){
                    $lines = $paramData['lines'];//$slotSettings->GetGameData($slotSettings->slotId . 'Lines');
                    $betline = $paramData['betLine'] ;//$slotSettings->GetGameData($slotSettings->slotId . 'CurrentBet');
                    $coinline = $paramData['coinLine'] ;
                    if( $lines <= 0 || $betline <= 0.0001 || $coinline < 1) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $slotEvent . '","serverResponse":"invalid bet state"}';
                        exit( $response );
                    }
                    if( $slotSettings->GetBalance() < ($lines * $betline * $coinline) ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $slotEvent . '","serverResponse":"invalid balance"}';
                        exit( $response );
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') < $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $requestData['freegame'] == '1' ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $slotEvent . '","serverResponse":"invalid bonus state"}';
                        exit( $response );
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= 0 && $slotEvent == 'freespin' ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $slotEvent . '","serverResponse":"invalid bonus state"}';
                        exit( $response );
                    }
                }
            }
            $ResultInfo = [];
            switch( $slotEvent ) 
            {
                case 'getSettings':
                    $lastEvent = $slotSettings->GetHistory();
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'BetStep', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentBet', $slotSettings->Bet[0]);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentCoin', $slotSettings->Coin[0]);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 10);
                    $slotSettings->SetGameData($slotSettings->slotId . 'bonusSymbol', -1);
                    $strResultInfo = '';
                    if( $lastEvent != 'NULL' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentBet', $lastEvent->serverResponse->CurrentBet);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentCoin', $lastEvent->serverResponse->CurrentCoin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BetStep', $lastEvent->serverResponse->BetStep);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->Lines);
                        $slotSettings->SetGameData($slotSettings->slotId . 'bonusSymbol', $lastEvent->serverResponse->bonusSymbol);
                        
                        $currentLineBet = $lastEvent->serverResponse->CurrentBet;
                        $currentLineCoin = $lastEvent->serverResponse->CurrentCoin;
                        $lastLines = $lastEvent->serverResponse->Lines;
                        $currentFreeGame = 0;
                        $ResultInfo["FreeGames"] = $lastEvent->serverResponse->totalFreeGames;
                        $ResultInfo["CurrentFreeGame"] = $lastEvent->serverResponse->currentFreeGames;
                        $ResultInfo["CurrentBet"] = $lastEvent->serverResponse->CurrentBet;
                        $ResultInfo["CurrentCoin"] = $lastEvent->serverResponse->CurrentCoin;
                        $ResultInfo["Lines"] = $lastEvent->serverResponse->Lines;
                        $ResultInfo["BonusSymbol"] = $lastEvent->serverResponse->bonusSymbol;
                    }
                    else
                    {
                        $currentLineBet = $slotSettings->Bet[3];
                        $currentLineCoin = $slotSettings->Coin[0];
                        $lastLines = 10;
                        $currentFreeGame = 0;
                        $ResultInfo["FreeGames"] = 0;
                        $ResultInfo["CurrentFreeGame"] = 0;
                        $ResultInfo["CurrentBet"] = $slotSettings->Bet[3];
                        $ResultInfo["CurrentCoin"] = $slotSettings->Coin[0];
                        $ResultInfo["Lines"] = $lastLines;
                        $ResultInfo["BonusSymbol"] = -1;
                        $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastLines);
                    }
                    $_cardHistories = $slotSettings->GetGameData($slotSettings->slotId . 'CardsHistory');
                    if($_cardHistories == null){
                        $_cardHistories = [];
                    }
                    $strCardHistory = '[';
                    $historyCount = count($_cardHistories);
                    for( $i = 0; $i < $historyCount; $i++ ) {
                        if($i == $historyCount - 1){
                            $strCardHistory = $strCardHistory . $_cardHistories[$i];
                        }else{
                            $strCardHistory = $strCardHistory . $_cardHistories[$i] . ",";
                        }                        
                    }
                    $strCardHistory = $strCardHistory . ']';
                    // -----* Bonus function check*-------                
                    $slotSettings->SetGameData($slotSettings->slotId . 'IsWelcomeBonus', 0);
                    if(null == $slotSettings->GetGameData($slotSettings->slotId . 'WelcomeBonusFreeSpin')){
                        $slotSettings->SetGameData($slotSettings->slotId . 'WelcomeBonusFreeSpin', 0);
                    }                                    
                    if($leftFreeSpinBonus > 0){
                        $bet = $slotSettings->Bet[0];
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentBet', $slotSettings->Bet[0]);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentCoin', $slotSettings->Coin[0]);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Lines', 10);
                        $ResultInfo["CurrentBet"] = $slotSettings->Bet[0];
                        $ResultInfo["CurrentCoin"] = $slotSettings->Coin[0];
                        $ResultInfo["Lines"] = $lastLines;
                        $slotSettings->SetGameData($slotSettings->slotId . 'IsWelcomeBonus', 1);
                    }
                    // -----**-------
                    $strJsonSetting  = '{"FreeGames":'.$ResultInfo["FreeGames"].',"CurrentFreeGame":'.$ResultInfo["CurrentFreeGame"].',"CurrentBet":'. $ResultInfo["CurrentBet"] .
                        ',"CurrentCoin":'.$ResultInfo["CurrentCoin"].',"Lines":'.$ResultInfo["Lines"].',"BonusSymbol":'.$ResultInfo["BonusSymbol"].
                        ',"Balance":'.$slotSettings->GetBalance().',"LeftFreeBonus":'.$leftFreeSpinBonus.',"CardsHistory":'.$strCardHistory.'}';
                    // $strJsonSetting = json_encode($ResultInfo);
                    $responseData = '{"responseEvent":"","responseType":"getSettings","serverResponse":' . $strJsonSetting . '}';
                    break;
                case 'restart':
                    $lastEvent = $slotSettings->GetHistory();
                    if( $lastEvent != 'NULL' ) 
                    {
                        $ResultInfo["FreeGames"] = $lastEvent->serverResponse->totalFreeGames;
                        $ResultInfo["CurrentFreeGame"] = $lastEvent->serverResponse->currentFreeGames;
                        $ResultInfo["CurrentBet"] = $lastEvent->serverResponse->CurrentBet;
                        $ResultInfo["CurrentCoin"] = $lastEvent->serverResponse->CurrentCoin;
                        $ResultInfo["Lines"] = $lastEvent->serverResponse->Lines;
                        $ResultInfo["BonusSymbol"] = $lastEvent->serverResponse->bonusSymbol;
                    }
                    else
                    {
                        $lastLines = 10;
                        $ResultInfo["FreeGames"] = 0;
                        $ResultInfo["CurrentFreeGame"] = 0;
                        $ResultInfo["CurrentBet"] = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentBet');
                        $ResultInfo["CurrentCoin"] = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentCoin');
                        $ResultInfo["Lines"] = $lastLines;
                        $ResultInfo["BonusSymbol"] = -1;
                        $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastLines);
                    }
                    
                    $strJsonSetting  = '{"FreeGames":'.$ResultInfo["FreeGames"].',"CurrentFreeGame":'.$ResultInfo["CurrentFreeGame"].',"CurrentBet":'. $ResultInfo["CurrentBet"] .
                        ',"CurrentCoin":'.$ResultInfo["CurrentCoin"].',"Lines":'.$ResultInfo["Lines"].',"LeftFreeBonus":'.$slotSettings->GetBonusFreeSpin().',"BonusSymbol":'.$ResultInfo["BonusSymbol"].'}';
                    // $strJsonSetting = json_encode($ResultInfo);
                    $responseData = '{"responseEvent":"","responseType":"restart","serverResponse":' . $strJsonSetting . '}';
                    break;
                case 'freespin':
                case 'bet':
                    $lastEvent = $slotSettings->GetHistory();
                    $linesId = [];
                    $linesId[0] = [
                        1, 
                        1, 
                        1, 
                        1, 
                        1
                    ];
                    $linesId[1] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[2] = [
                        0, 
                        0, 
                        0, 
                        0, 
                        0
                    ];
                    $linesId[3] = [
                        2, 
                        1, 
                        0, 
                        1, 
                        2
                    ];
                    $linesId[4] = [
                        0, 
                        1, 
                        2, 
                        1, 
                        0
                    ];
                    $linesId[5] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[6] = [
                        1, 
                        0, 
                        0, 
                        0, 
                        1
                    ];
                    $linesId[7] = [
                        2, 
                        2, 
                        1, 
                        0, 
                        0
                    ];
                    $linesId[8] = [
                        0, 
                        0, 
                        1, 
                        2, 
                        2
                    ];
                    $linesId[9] = [
                        1, 
                        0, 
                        1, 
                        2, 
                        1
                    ];
                    $lines = $paramData['lines'];//$slotSettings->GetGameData($slotSettings->slotId . 'Lines');
                    $betline = $paramData['betLine'] ;//$slotSettings->GetGameData($slotSettings->slotId . 'CurrentBet');
                    $coinline = $paramData['coinLine'] ;           
                    $isWelcomeFreespin = $slotSettings->GetGameData($slotSettings->slotId . 'IsWelcomeBonus');         
                    $allbet = $betline * $lines * $coinline;
                    if( $slotEvent != 'freespin' ) 
                    {
                        $_sum = $allbet / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($slotEvent) ? $slotEvent : ''), $_sum, $slotEvent);
                        $slotSettings->UpdateJackpots($allbet);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'bonusSymbol', -1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                        $bonusMpl = 1;
                        if($isWelcomeFreespin == 1){
                            $welcomeBonusFreespin = $slotSettings->UpdateBonusFreeSpin();
                            $slotSettings->SetGameData($slotSettings->slotId . 'WelcomeBonusFreeSpin', $welcomeBonusFreespin);
                            if($welcomeBonusFreespin <= 0){
                                $slotSettings->SetGameData($slotSettings->slotId . 'IsWelcomeBonus', 0);
                            }
                        }else{
                            $slotSettings->SetBalance(-1 * $allbet, $slotEvent);
                        }
                    }
                    else
                    {
                        if($lastEvent->serverResponse->CurrentBet != $betline && $lastEvent->serverResponse->CurrentCoin != $coinline){
                            $response = '{"responseEvent":"error","responseType":"' . $slotEvent . '","serverResponse":"invalid bet state"}';
                            exit( $response );
                        }
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                        $bonusMpl = $slotSettings->slotFreeMpl;
                    }
                    $_spinSettings = $slotSettings->GetSpinSettings($slotEvent, $allbet, $lines);
                    $winType = $_spinSettings[0];
                    $_winAvaliableMoney = $_spinSettings[1];
                    $userBalance = sprintf('%01.2f', $slotSettings->GetBalance());
                    $reelgenrationCount = 0;
                    for( $i = 0; $i <= 2000; $i++ ) 
                    {
                        $reelgenrationCount = $i;
                        $totalWin = 0;
                        $lineWins = [];
                        $lineWinNum = [];
                        $wild = '0';
                        $scatter = '0';
                        $tempreels = $slotSettings->GetReelStrips($winType, $slotEvent);
                        $reels = [];
                        $_freespinWin = 0;
                        $_isFreeWin = 0;
                        $_isLineWin = 0;
                        $bs = $slotSettings->GetGameData($slotSettings->slotId . 'bonusSymbol');
                        if( $slotEvent == 'freespin' ) 
                        {
                            $bonusSymbolCount = 0;
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                if( $tempreels['reel' . $r][0] == $bs || $tempreels['reel' . $r][1] == $bs || $tempreels['reel' . $r][2] == $bs ) 
                                {
                                    $bonusSymbolCount++;
                                }
                            }
                            $_freespinWin = $slotSettings->Paytable['SYM_' . $bs][$bonusSymbolCount] * $allbet;
                        }
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            $reels['reel' . $r] = [];
                            if( $_freespinWin >= 0 && ($tempreels['reel' . $r][0] == $bs || $tempreels['reel' . $r][1] == $bs || $tempreels['reel' . $r][2] == $bs )) 
                            {
                                $reels['reel' . $r][0] = $bs;
                                $reels['reel' . $r][1] = $bs;
                                $reels['reel' . $r][2] = $bs;
                                $reels['reel' . $r][3] = 0;
                                for($rr = 0; $rr < 3; $rr++){
                                    if($tempreels['reel' . $r][$rr] == $scatter){
                                        $tempreels['reel' . $r][$rr] == rand(1, 9);
                                    }                                        
                                }
                            }else{
                                $reels['reel' . $r][0] = $tempreels['reel' . $r][0];
                                $reels['reel' . $r][1] = $tempreels['reel' . $r][1];
                                $reels['reel' . $r][2] = $tempreels['reel' . $r][2];
                                $reels['reel' . $r][3] = 0;
                            }
                        }
                        if($_freespinWin > 0){
                            $totalWin += $_freespinWin;
                            $_isFreeWin= 1;
                        }else{
                            $_lineWinNumber = 1;
                            for( $k = 0; $k < $lines; $k++ ) 
                            {
                                $_lineWin = '';
                                $firstEle = $reels['reel1'][$linesId[$k][0]];
                                $lineWinNum[$k] = 1;
                                $lineWins[$k] = 0;
                                for($j = 1; $j < 5; $j++){
                                    $ele = $reels['reel'. ($j + 1)][$linesId[$k][$j]];
                                    if($firstEle == $wild){
                                        $firstEle = $ele;
                                        $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                    }else if($ele == $firstEle || $ele == $wild){
                                        $lineWinNum[$k] = $lineWinNum[$k] + 1;
                                        if($j == 4){
                                            $lineWins[$k] = $slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] * $betline * $coinline;
                                            $_isLineWin = 1;
                                            $totalWin += $lineWins[$k];
                                        }
                                    }else{
                                        if($slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] > 0){
                                            $lineWins[$k] = $slotSettings->Paytable['SYM_' . ($firstEle + 1)][$lineWinNum[$k]] * $betline * $coinline;
                                            $_isLineWin = 1;
                                            $totalWin += $lineWins[$k];
                                        }else{
                                            $lineWinNum[$k] = 0;
                                        }
                                        break;
                                    }
                                }
                            }
                        }
                        $scattersWin = 0;
                        $scattersCount = 0;
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            if( $reels['reel' . $r][0] == $scatter || $reels['reel' . $r][1] == $scatter || $reels['reel' . $r][2] == $scatter ) 
                            {
                                $scattersCount++;
                            }
                        }
                        $scattersWin = $slotSettings->Paytable['SYM_' . ($scatter + 1)][$scattersCount] * $allbet * $bonusMpl;
                        $totalWin += $scattersWin;
                        
                        if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($allbet * rand(2, 5)) ) 
                        {
                        }
                        else if( !$slotSettings->increaseRTP && $winType == 'win' && $allbet < $totalWin ) 
                        {
                        }
                        else
                        {
                            if( $i > 1000 ) 
                            {
                                $winType = 'none';
                            }
                            if( $i > 1500 ) 
                            {
                                $response = '{"responseEvent":"error","responseType":"' . $slotEvent . '","serverResponse":"Bad Reel Strip"}';
                                exit( $response );
                            }
                            if( $scattersCount >= 3 && $winType != 'bonus' ) 
                            {
                            }
                            else if( $totalWin <= $_winAvaliableMoney && $winType == 'bonus' ) 
                            {
                                $_avaliableBank = $slotSettings->GetBank((isset($slotEvent) ? $slotEvent : ''));
                                if( $_avaliableBank < $_winAvaliableMoney ) 
                                {
                                    $_winAvaliableMoney = $_avaliableBank;
                                }
                                else
                                {
                                    break;
                                }
                            }
                            else if( $totalWin > 0 && $totalWin <= $_winAvaliableMoney && $winType == 'win' ) 
                            {
                                $_avaliableBank = $slotSettings->GetBank((isset($slotEvent) ? $slotEvent : ''));
                                if( $_avaliableBank < $_winAvaliableMoney ) 
                                {
                                    $_winAvaliableMoney = $_avaliableBank;
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

                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBank((isset($slotEvent) ? $slotEvent : ''), -1 * $totalWin);
                        $slotSettings->SetBalance($totalWin);
                        if($isWelcomeFreespin == 1){
                            $slotSettings->SetWelcomeBonus($totalWin);
                        }
                    }
                    $_totalWin = $totalWin;
                    $currentFreeGame = 0;
                    $_isFreeGame = 0;
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentBet', $betline);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentCoin', $coinline);
                    // $slotSettings->SetGameData($slotSettings->slotId . 'BetStep', $lastEvent->serverResponse->BetStep);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lines);
                    if( $slotEvent == 'freespin' ) 
                    {
                        $currentFreeGame = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1;
                        $_isFreeGame = 1;
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    }
                    $fs = 0;
                    if( $scattersCount >= 3 ) 
                    {
                        $currentFreeGame = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1;
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $slotSettings->slotFreeCount);
                        }
                        else
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'bonusSymbol', rand(5, 9));
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->slotFreeCount);
                        }
                        $fs = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                    }
                    $_strResultReal = '' . json_encode($reels) . '';
                    $_strResult = '' . json_encode($tempreels) . '';
                    $_strLineWins = '' . json_encode($lineWins) . '';
                    $_strLineWinNum = '' . json_encode($lineWinNum) . '';
                    $_strJackpot = '' . json_encode($slotSettings->Jackpots) . '';
                    $responseData = '{"responseEvent":"spin","responseType":"' . $slotEvent . '","serverResponse":{"bonusSymbol":' . $slotSettings->GetGameData($slotSettings->slotId . 'bonusSymbol') . ',"BetStep":' . $slotSettings->GetGameData($slotSettings->slotId . 'BetStep') . ',"Lines":' . $slotSettings->GetGameData($slotSettings->slotId . 'Lines') . ',"CurrentBet":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentBet'). ',"CurrentCoin":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentCoin') . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $userBalance . ',"afterBalance":' . $userBalance . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[],"Jackpots":' . $_strJackpot . ',"reelsSymbols":' . $_strResultReal . '}}';
                    
                    $slotSettings->SaveLogReport($responseData, $allbet, $lines, $_totalWin, $slotEvent);
                    $responseData = '{"responseEvent":"spin","responseType":"' . $slotEvent . '","ReelGenerationCount":"' . $reelgenrationCount. '","serverResponse":{"bonusSymbol":' . $slotSettings->GetGameData($slotSettings->slotId . 'bonusSymbol') . ',"BetStep":' . $slotSettings->GetGameData($slotSettings->slotId . 'BetStep') . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"totalWin":' . $totalWin . ',"winLines":'. $_strLineWins .',"winLineNum":' . $_strLineWinNum .',"isFreeWin":' .$_isFreeWin.',"isLineWin":'.$_isLineWin. ',"Jackpots":' . $_strJackpot . ',"scaCount":' . $scattersCount . ',"reelsSymbols":' . $_strResultReal . ',"reelsTempSymbols":' . $_strResult . '}}';
                    
                    $currentEndSpinDateTime = date('Y-m-d H:i:s');
                    break;
                case 'gambleCard':
                    $cardType = ["HeiTao", "MeiHua", "HongTao", "FangKuai", "Red", "Black"];                    
                    $_totalWin = $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin');
                    $_betMoney = $_totalWin;
                    $gambleChoice = $paramData['choice'];
                    $doubleWin = rand(1, 2);
                    $multi = 2;
                    if($gambleChoice < 5){
                        $multi = 4;
                    }
                    $_resultChoice = '';
                    $_currentBank = $slotSettings->GetBank((isset($slotEvent) ? $slotEvent : ''));
                    if( $_currentBank < ($_totalWin * $multi) ) 
                    {
                        $doubleWin = 0;
                    }
                    if( $doubleWin == 1 ) 
                    {
                        $_resultWin = $_totalWin * $multi;
                        $_resultChoice = $gambleChoice;
                        if($_resultChoice == 5){
                            $_resultChoice = rand(1, 2);
                        }
                        else if($_resultChoice == 6)
                        {
                            $_resultChoice = rand(3, 4);
                        }
                    }
                    else
                    {
                        $_resultChoice = rand(1, 4);
                        if( $gambleChoice == 1 ) 
                        {
                            if($_resultChoice == 1){
                                $_resultChoice = $_resultChoice + 1;
                            }
                        }
                        else if($gambleChoice == 2)
                        {
                            if($_resultChoice == 2){
                                $_resultChoice = $_resultChoice + 1;
                            }
                        }
                        else if($gambleChoice == 3)
                        {
                            if($_resultChoice == 3){
                                $_resultChoice = $_resultChoice - 1;
                            }
                        }
                        else if($gambleChoice == 4)
                        {
                            if($_resultChoice == 4){
                                $_resultChoice = $_resultChoice - 1;
                            }
                        }
                        else if($gambleChoice == 5)
                        {
                            if($_resultChoice == 1 || $_resultChoice == 2){
                                $_resultChoice = $_resultChoice + 2;
                            }
                        }
                        else if($gambleChoice == 6)
                        {
                            if($_resultChoice == 3 || $_resultChoice == 4){
                                $_resultChoice = $_resultChoice - 2;
                            }
                        }
                        $_resultWin = 0;
                        $_totalWin = -1 * $_totalWin;
                    }
                    $_cardHistories = $slotSettings->GetGameData($slotSettings->slotId . 'CardsHistory');
                    if($_cardHistories == null){
                        $_cardHistories = [];
                    }
                    if(count($_cardHistories) >= 10){
                        array_splice($_cardHistories, 0 ,1);                        
                    }
                    array_push($_cardHistories, $_resultChoice);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CardsHistory', $_cardHistories);
                    if( $_totalWin > 0 ) 
                    {
                        $slotSettings->SetBalance($_totalWin);
                        $slotSettings->SetBank((isset($slotEvent) ? $slotEvent : ''), -1 * $_totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $_resultWin);
                    }
                    else
                    {
                        $slotSettings->SetBalance($_totalWin);
                        $slotSettings->SetBank((isset($slotEvent) ? $slotEvent : ''), $_totalWin * -1);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    }
                    $_cardLogData = '{"responseEvent":"gambleResult","serverResponse":{"totalWin":' . $_resultWin . '}}';
                    $slotSettings->SaveLogReport($_cardLogData, $_betMoney, 1, $_resultWin, 'slotGamble');
                    $resultGambleInfo = [];
                    $resultGambleInfo['choice'] = $_resultChoice;
                    $resultGambleInfo['result'] = $_resultWin;
                    $strResultGamble = json_encode($resultGambleInfo);
                    $responseData = '{"responseEvent":"","responseType":"gambleCard","serverResponse":' . $strResultGamble . '}';
                    break;
            }
            if( !isset($responseData[0]) ) 
            {
                $response = '{"responseEvent":"error","responseType":"","serverResponse":"Invalid request state"}';
                exit( $response );
            }
            $response = $responseData; // [0]
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
