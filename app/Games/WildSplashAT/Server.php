<?php 
namespace VanguardLTE\Games\WildSplashAT
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
                $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid login"}';
                exit( $response );
            }
            $slotSettings = new SlotSettings($game, $userId);
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822 = [];
            if( !isset($_POST['cmd']) ) 
            {
                $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid game command"}';
                exit( $response );
            }
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = $_POST['cmd'];
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'gameSpin' ) 
            {
                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                {
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'] = $slotSettings->GetGameData($slotSettings->slotId . 'slotLines');
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] = $slotSettings->GetGameData($slotSettings->slotId . 'slotBet');
                }
                else
                {
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'] = $_POST['lines'];
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] = $_POST['bet'] / 100;
                    $slotSettings->SetGameData($slotSettings->slotId . 'slotLines', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines']);
                    $slotSettings->SetGameData($slotSettings->slotId . 'slotBet', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet']);
                }
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'gameGamble' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'slotGamble';
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['gambleChoice'] = $_POST['color'];
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'update' ) 
            {
                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"' . $slotSettings->GetBalance() . '"}';
                exit( $response );
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'bet' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'respin' ) 
            {
                if( !in_array($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'], $slotSettings->gameLine) || !in_array($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'], $slotSettings->Bet) ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid bet state"}';
                    exit( $response );
                }
                if( $slotSettings->GetBalance() < ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet']) && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'bet' ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid balance"}';
                    exit( $response );
                }
                if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                    exit( $response );
                }
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'slotGamble' && $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') <= 0 ) 
            {
                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid gamble state"}';
                exit( $response );
            }
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'gameInit' ) 
            {
                $lastEvent = $slotSettings->GetHistory();
                if( !$slotSettings->HasGameData($slotSettings->slotId . 'HistoryCards') ) 
                {
                    $slotSettings->SetGameData($slotSettings->slotId . 'HistoryCards', []);
                }
                $_obf_0D5C3831071A3610163227012704053C131A110B2E3122 = '';
                $_obf_0D282A3E130518100418230D042B0A2B400930193F3232 = 'null';
                $restore = 'false';
                if( $lastEvent != 'NULL' ) 
                {
                    if( isset($lastEvent->serverResponse->expSymbol) ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'ExpSymbol', $lastEvent->serverResponse->expSymbol);
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                    $slotSettings->SetGameData($slotSettings->slotId . 'slotLines', $lastEvent->serverResponse->slotLines);
                    $slotSettings->SetGameData($slotSettings->slotId . 'slotBet', $lastEvent->serverResponse->slotBet);
                    $slotSettings->SetGameData($slotSettings->slotId . 'Mpl', $lastEvent->serverResponse->Mpl);
                    $reels = $lastEvent->serverResponse->reelsSymbols;
                    $_obf_0D1D385C3B2E29221F233F3E3D09295B0F1B0D063B3222 = [];
                    $_obf_0D282A3E130518100418230D042B0A2B400930193F3232 = '';
                    $_obf_0D023D033008250C382225112229361B223E2D11341111 = [];
                    for( $i = 1; $i <= 5; $i++ ) 
                    {
                        $_obf_0D06261B28242240172C0239373D0B04153C330C1B0701 = [];
                        $ps = 0;
                        for( $p = 3; $p >= 0; $p-- ) 
                        {
                            if( isset($reels->{'reel' . $i}[$p]) && $reels->{'reel' . $i}[$p] != '' ) 
                            {
                                $_obf_0D06261B28242240172C0239373D0B04153C330C1B0701[] = '"' . ($ps + 1) . '":"' . $reels->{'reel' . $i}[$p] . '"';
                                $ps++;
                            }
                        }
                        $_obf_0D1D385C3B2E29221F233F3E3D09295B0F1B0D063B3222[] = '"' . $i . '":{' . implode(',', $_obf_0D06261B28242240172C0239373D0B04153C330C1B0701) . '}';
                    }
                    $_obf_0D282A3E130518100418230D042B0A2B400930193F3232 = '{' . implode(',', $_obf_0D1D385C3B2E29221F233F3E3D09295B0F1B0D063B3222) . '}';
                    if( $lastEvent->serverResponse->currentFreeGames < $lastEvent->serverResponse->totalFreeGames ) 
                    {
                        $restore = 'true';
                        $_obf_0D5C3831071A3610163227012704053C131A110B2E3122 = '"id":"54594109_20200214110301","current":' . $lastEvent->serverResponse->currentFreeGames . ',"add":0,"total":' . $lastEvent->serverResponse->totalFreeGames . ',"totalWin":' . ($lastEvent->serverResponse->totalWin * 100) . '';
                    }
                }
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                foreach( $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 as &$_obf_0D1E1E2D5C173410021C5C5C21140B2C04313B11280F32 ) 
                {
                    $_obf_0D1E1E2D5C173410021C5C5C21140B2C04313B11280F32 = $_obf_0D1E1E2D5C173410021C5C5C21140B2C04313B11280F32 * 100;
                }
                $response = '{"status":"success","microtime":0.0077991485595703,"dateTime":"2020-02-13 13:16:03","error":"","content":{"cmd":"gameInit","balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"session":"54594109_4133a64673d3883d42cd003ee905ba3e","betInfo":{"denomination":0.01,"bet":' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . ',"lines":40},"betSettings":{"denomination":[0.01],"bets":[' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '],"lines":[1,5,10,20,40]},"symbols":' . $_obf_0D282A3E130518100418230D042B0A2B400930193F3232 . ',"reels":{"base":{"1":["' . implode('","', $slotSettings->reelStrip1) . '"],"2":["' . implode('","', $slotSettings->reelStrip2) . '"],"3":["' . implode('","', $slotSettings->reelStrip3) . '"],"4":["' . implode('","', $slotSettings->reelStrip4) . '"],"5":["' . implode('","', $slotSettings->reelStrip5) . '"]},"feature":{"1":["' . implode('","', $slotSettings->reelStripBonus1) . '"],"2":["' . implode('","', $slotSettings->reelStripBonus2) . '"],"3":["' . implode('","', $slotSettings->reelStripBonus3) . '"],"4":["' . implode('","', $slotSettings->reelStripBonus4) . '"],"5":["' . implode('","', $slotSettings->reelStripBonus5) . '"]}},"exitUrl":"\/","pingInterval":60000,"restore":' . $restore . ',"freeSpin":{' . $_obf_0D5C3831071A3610163227012704053C131A110B2E3122 . '},"hash":"da0a5044aebc413b6da3a8e42dea0246"}}';
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'gameRefreshBalance' ) 
            {
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                $response = '{"status":"success","microtime":0.0065572261810303,"dateTime":"2020-02-15 12:46:27","error":"","content":{"cmd":"gameRefreshBalance","session":"54990161_9709e13bca7763b46396cda1868d2e7e","balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"hash":"8d9f26101b61f471ac401c22d6b8d68c"}}';
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'gamePing' ) 
            {
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                $response = '{"status":"success","microtime":0.0031919479370117,"dateTime":"2020-02-14 11:51:01","error":null,"content":{"cmd":"gamePing","session":"54594109_4133a64673d3883d42cd003ee905ba3e","balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"hash":"fda108a357d692381d7ca82a1bea67b1"}}';
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'sessionInfo' ) 
            {
                $response = '{"status":"success","microtime":0.0026731491088867,"dateTime":"2020-02-13 13:23:32","error":"","content":{"cmd":"sessionInfo","serverMathematics":"\/game\/WildSplashAT\/server","serverResources":"","sessionId":"54594109_4133a64673d3883d42cd003ee905ba3e","exitUlt":"\/","exitUrl":"\/","id":"341","name":"GameName","currency":"ALL","language":"en","type":"aristocrat","systemName":"wild_splash","version":"2","mobile":"1"}}';
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'gameTakeWin' ) 
            {
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                $response = '{"status":"success","microtime":0.033211946487427,"dateTime":"2020-02-14 10:09:04","error":null,"content":{"cmd":"gameTakeWin","session":"54594109_4133a64673d3883d42cd003ee905ba3e","balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"actionId":"54594109_74_659","hash":"a12f5889add8917d6e705751e1d9a953"}}';
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'gamePick' ) 
            {
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                if( $_POST['pick'] == 0 ) 
                {
                    $slotSettings->SetGameData('WildSplashATMpl', 10);
                    $slotSettings->SetGameData('WildSplashATCurrentFreeGame', 0);
                    $slotSettings->SetGameData('WildSplashATFreeGames', 5);
                }
                else if( $_POST['pick'] == 1 ) 
                {
                    $slotSettings->SetGameData('WildSplashATMpl', 5);
                    $slotSettings->SetGameData('WildSplashATCurrentFreeGame', 0);
                    $slotSettings->SetGameData('WildSplashATFreeGames', 10);
                }
                else if( $_POST['pick'] == 2 ) 
                {
                    $slotSettings->SetGameData('WildSplashATMpl', 3);
                    $slotSettings->SetGameData('WildSplashATCurrentFreeGame', 0);
                    $slotSettings->SetGameData('WildSplashATFreeGames', 15);
                }
                else if( $_POST['pick'] == 3 ) 
                {
                    $slotSettings->SetGameData('WildSplashATMpl', 2);
                    $slotSettings->SetGameData('WildSplashATCurrentFreeGame', 0);
                    $slotSettings->SetGameData('WildSplashATFreeGames', 20);
                }
                $response = '{"status":"success","microtime":0.0093810558319092,"dateTime":"2020-02-15 14:26:21","error":"","content":{"session":"54990161_9709e13bca7763b46396cda1868d2e7e","cmd":"gamePick","balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"win":0,"symbols":{"1":{"1":"symbol_6","2":"symbol_9","3":"symbol_13"},"2":{"1":"symbol_10","2":"symbol_5","3":"symbol_8"},"3":{"1":"symbol_10","2":"symbol_13","3":"symbol_11"},"4":{"1":"symbol_13","2":"symbol_10","3":"symbol_6"},"5":{"1":"symbol_3","2":"symbol_8","3":"symbol_1"}},"winLines":[],"freeSpin":{"id":"54990161_20200215132548","current":0,"add":' . $slotSettings->GetGameData('WildSplashATFreeGames') . ',"total":' . $slotSettings->GetGameData('WildSplashATFreeGames') . ',"totalWin":' . ($slotSettings->GetGameData('WildSplashATBonusWin') * 100) . ',"multiplayer":' . $slotSettings->GetGameData('WildSplashATMpl') . ',"pick":' . $_POST['pick'] . '},"actionId":"54990161_10_60","hash":"1ace145628d930d28bdf38789a28a9d7"}}';
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'slotGamble' ) 
            {
                $Balance = $slotSettings->GetBalance();
                $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = rand(1, $slotSettings->GetGambleSettings());
                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = '';
                $totalWin = $slotSettings->GetGameData('WildSplashATTotalWin');
                $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = 0;
                $_obf_0D3310323F3F07041133133D263014342B230C260D1F11 = $totalWin;
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['gambleChoice'] == 'red' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['gambleChoice'] == 'black' ) 
                {
                    if( $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : '')) < ($totalWin * 2) ) 
                    {
                        $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = 0;
                    }
                    $_obf_0D025B32252D2C3C2B1114371F080D170D5B35093D2C11 = 'spin';
                    if( $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 == 1 ) 
                    {
                        $_obf_0D025B32252D2C3C2B1114371F080D170D5B35093D2C11 = 'gamble\/takeWin';
                        $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'win';
                        $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = $totalWin;
                        $totalWin = $totalWin * 2;
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['gambleChoice'] == 'red' ) 
                        {
                            $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301 = [
                                'diamond', 
                                'heart'
                            ];
                            $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301[rand(0, 1)];
                        }
                        else
                        {
                            $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301 = [
                                'club', 
                                'spade'
                            ];
                            $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301[rand(0, 1)];
                        }
                    }
                    else
                    {
                        $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'lose';
                        $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = -1 * $totalWin;
                        $totalWin = 0;
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['gambleChoice'] == 'red' ) 
                        {
                            $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301 = [
                                'club', 
                                'spade'
                            ];
                            $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301[rand(0, 1)];
                        }
                        else
                        {
                            $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301 = [
                                'diamond', 
                                'heart'
                            ];
                            $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301[rand(0, 1)];
                        }
                    }
                }
                else
                {
                    if( $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : '')) < ($totalWin * 4) ) 
                    {
                        $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = 0;
                    }
                    $_obf_0D025B32252D2C3C2B1114371F080D170D5B35093D2C11 = 'spin';
                    if( $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 == 1 ) 
                    {
                        $_obf_0D025B32252D2C3C2B1114371F080D170D5B35093D2C11 = 'gamble\/takeWin';
                        $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'win';
                        $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = $totalWin;
                        $totalWin = $totalWin * 4;
                        $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['gambleChoice'];
                    }
                    else
                    {
                        $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'lose';
                        $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = -1 * $totalWin;
                        $totalWin = 0;
                        $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301 = [
                            'club', 
                            'spade', 
                            'diamond', 
                            'heart'
                        ];
                        shuffle($_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301);
                        for( $i = 0; $i < 4; $i++ ) 
                        {
                            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['gambleChoice'] != $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301[$i] ) 
                            {
                                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301[$i];
                            }
                        }
                    }
                }
                $slotSettings->SetGameData('WildSplashATTotalWin', $totalWin);
                $slotSettings->SetBalance($_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22);
                $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 * -1);
                $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 = $slotSettings->GetBalance();
                $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 = '{"dealerCard":"' . $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 . '","gambleState":"' . $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 . '","totalWin":' . $totalWin . ',"afterBalance":' . $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 . ',"Balance":' . $Balance . '}';
                $_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211 = '{"responseEvent":"gambleResult","serverResponse":' . $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 . '}';
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                $response = '{"status":"success","microtime":0.0097517967224121,"dateTime":"2020-02-14 09:37:51","error":null,"content":{"cmd":"gameGamble","session":"54594109_4133a64673d3883d42cd003ee905ba3e","balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"card":"' . $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 . '","win":' . ($totalWin * 100) . ',"actionId":"54594109_68_593","actionNext":"' . $_obf_0D025B32252D2C3C2B1114371F080D170D5B35093D2C11 . '","lastCard":["spade","diamond","diamond"],"hash":"c9f3dbf54134e682dead5ec1f89d48d5"}}';
                $slotSettings->SaveLogReport($_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211, $_obf_0D3310323F3F07041133133D263014342B230C260D1F11, 1, $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'bet' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
            {
                $linesId = [];
                $linesId[0] = [
                    1, 
                    1, 
                    1, 
                    1, 
                    1
                ];
                $linesId[1] = [
                    1, 
                    1, 
                    2, 
                    1, 
                    1
                ];
                $linesId[2] = [
                    1, 
                    2, 
                    2, 
                    2, 
                    1
                ];
                $linesId[3] = [
                    1, 
                    2, 
                    3, 
                    2, 
                    1
                ];
                $linesId[4] = [
                    1, 
                    2, 
                    1, 
                    2, 
                    1
                ];
                $linesId[5] = [
                    1, 
                    1, 
                    1, 
                    2, 
                    1
                ];
                $linesId[6] = [
                    1, 
                    2, 
                    1, 
                    1, 
                    1
                ];
                $linesId[7] = [
                    1, 
                    1, 
                    2, 
                    2, 
                    1
                ];
                $linesId[8] = [
                    1, 
                    2, 
                    2, 
                    1, 
                    1
                ];
                $linesId[9] = [
                    1, 
                    1, 
                    3, 
                    1, 
                    1
                ];
                $linesId[10] = [
                    1, 
                    1, 
                    3, 
                    2, 
                    1
                ];
                $linesId[11] = [
                    1, 
                    2, 
                    3, 
                    1, 
                    1
                ];
                $linesId[12] = [
                    2, 
                    2, 
                    2, 
                    2, 
                    2
                ];
                $linesId[13] = [
                    2, 
                    2, 
                    3, 
                    2, 
                    2
                ];
                $linesId[14] = [
                    2, 
                    2, 
                    1, 
                    2, 
                    2
                ];
                $linesId[15] = [
                    2, 
                    3, 
                    3, 
                    3, 
                    2
                ];
                $linesId[16] = [
                    2, 
                    1, 
                    1, 
                    1, 
                    2
                ];
                $linesId[17] = [
                    2, 
                    3, 
                    2, 
                    3, 
                    2
                ];
                $linesId[18] = [
                    2, 
                    1, 
                    2, 
                    1, 
                    2
                ];
                $linesId[19] = [
                    2, 
                    2, 
                    2, 
                    3, 
                    2
                ];
                $linesId[20] = [
                    2, 
                    2, 
                    2, 
                    1, 
                    2
                ];
                $linesId[21] = [
                    2, 
                    3, 
                    2, 
                    2, 
                    2
                ];
                $linesId[22] = [
                    2, 
                    1, 
                    2, 
                    2, 
                    2
                ];
                $linesId[23] = [
                    2, 
                    3, 
                    1, 
                    3, 
                    2
                ];
                $linesId[24] = [
                    2, 
                    1, 
                    3, 
                    1, 
                    2
                ];
                $linesId[25] = [
                    3, 
                    3, 
                    3, 
                    3, 
                    3
                ];
                $linesId[26] = [
                    3, 
                    3, 
                    4, 
                    3, 
                    3
                ];
                $linesId[27] = [
                    3, 
                    3, 
                    2, 
                    3, 
                    3
                ];
                $linesId[28] = [
                    3, 
                    4, 
                    4, 
                    4, 
                    3
                ];
                $linesId[29] = [
                    3, 
                    2, 
                    2, 
                    2, 
                    3
                ];
                $linesId[30] = [
                    3, 
                    4, 
                    3, 
                    4, 
                    3
                ];
                $linesId[31] = [
                    3, 
                    2, 
                    3, 
                    2, 
                    3
                ];
                $linesId[32] = [
                    3, 
                    3, 
                    3, 
                    4, 
                    3
                ];
                $linesId[33] = [
                    3, 
                    3, 
                    3, 
                    2, 
                    3
                ];
                $linesId[34] = [
                    3, 
                    4, 
                    3, 
                    3, 
                    3
                ];
                $linesId[35] = [
                    3, 
                    2, 
                    3, 
                    3, 
                    3
                ];
                $linesId[36] = [
                    3, 
                    4, 
                    2, 
                    4, 
                    3
                ];
                $linesId[37] = [
                    3, 
                    2, 
                    4, 
                    2, 
                    3
                ];
                $linesId[38] = [
                    4, 
                    4, 
                    4, 
                    4, 
                    4
                ];
                $linesId[39] = [
                    4, 
                    4, 
                    3, 
                    4, 
                    4
                ];
                $linesId[40] = [
                    4, 
                    3, 
                    3, 
                    3, 
                    4
                ];
                $linesId[41] = [
                    4, 
                    3, 
                    2, 
                    3, 
                    4
                ];
                $linesId[42] = [
                    4, 
                    3, 
                    4, 
                    3, 
                    4
                ];
                $linesId[43] = [
                    4, 
                    4, 
                    4, 
                    3, 
                    4
                ];
                $linesId[44] = [
                    4, 
                    3, 
                    4, 
                    4, 
                    4
                ];
                $linesId[45] = [
                    4, 
                    4, 
                    3, 
                    3, 
                    4
                ];
                $linesId[46] = [
                    4, 
                    3, 
                    3, 
                    4, 
                    4
                ];
                $linesId[47] = [
                    4, 
                    4, 
                    2, 
                    4, 
                    4
                ];
                $linesId[48] = [
                    4, 
                    4, 
                    2, 
                    3, 
                    4
                ];
                $linesId[49] = [
                    4, 
                    3, 
                    2, 
                    4, 
                    4
                ];
                $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines']);
                $winType = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[0];
                $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[1];
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                {
                    if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    }
                    $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines']) / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $slotSettings->UpdateJackpots($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines']);
                    $slotSettings->SetBalance(-1 * ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines']), $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $bonusMpl = 1;
                    $slotSettings->SetGameData('WildSplashATBonusWin', 0);
                    $slotSettings->SetGameData('WildSplashATFreeGames', 0);
                    $slotSettings->SetGameData('WildSplashATCurrentFreeGame', 0);
                    $slotSettings->SetGameData('WildSplashATTotalWin', 0);
                    $slotSettings->SetGameData('WildSplashATFreeBalance', 0);
                    $slotSettings->SetGameData('WildSplashATMpl', 3);
                }
                else
                {
                    $slotSettings->SetGameData('WildSplashATCurrentFreeGame', $slotSettings->GetGameData('WildSplashATCurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->GetGameData('WildSplashATMpl');
                }
                $Balance = $slotSettings->GetBalance();
                if( isset($slotSettings->Jackpots['jackPay']) ) 
                {
                    $Balance = $Balance - ($slotSettings->Jackpots['jackPay'] * $slotSettings->CurrentDenom);
                }
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $totalWin = 0;
                    $lineWins = [];
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
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0
                    ];
                    $wild = ['symbol_14'];
                    $scatter = 'symbol_15';
                    $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811 = [];
                    $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    for( $k = 0; $k < $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines']; $k++ ) 
                    {
                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '';
                        $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k] = $linesId[$k];
                        for( $_obf_0D2E1D222A1A1A3B2A03211B341C305C0D293F07161011 = 0; $_obf_0D2E1D222A1A1A3B2A03211B341C305C0D293F07161011 < count($_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k]); $_obf_0D2E1D222A1A1A3B2A03211B341C305C0D293F07161011++ ) 
                        {
                            if( $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][$_obf_0D2E1D222A1A1A3B2A03211B341C305C0D293F07161011] == 1 ) 
                            {
                                $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][$_obf_0D2E1D222A1A1A3B2A03211B341C305C0D293F07161011] = 4;
                            }
                            else if( $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][$_obf_0D2E1D222A1A1A3B2A03211B341C305C0D293F07161011] == 2 ) 
                            {
                                $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][$_obf_0D2E1D222A1A1A3B2A03211B341C305C0D293F07161011] = 3;
                            }
                            else if( $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][$_obf_0D2E1D222A1A1A3B2A03211B341C305C0D293F07161011] == 3 ) 
                            {
                                $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][$_obf_0D2E1D222A1A1A3B2A03211B341C305C0D293F07161011] = 2;
                            }
                            else if( $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][$_obf_0D2E1D222A1A1A3B2A03211B341C305C0D293F07161011] == 4 ) 
                            {
                                $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][$_obf_0D2E1D222A1A1A3B2A03211B341C305C0D293F07161011] = 1;
                            }
                        }
                        for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                        {
                            $_obf_0D011C142C3C37263F351C4012170A074027083F321132 = $slotSettings->SymbolGame[$j];
                            if( $_obf_0D011C142C3C37263F351C4012170A074027083F321132 == $scatter || !isset($slotSettings->Paytable[$_obf_0D011C142C3C37263F351C4012170A074027083F321132]) ) 
                            {
                            }
                            else
                            {
                                $s = [];
                                $s[0] = $reels['reel1'][$linesId[$k][0] - 1];
                                $s[1] = $reels['reel2'][$linesId[$k][1] - 1];
                                $s[2] = $reels['reel3'][$linesId[$k][2] - 1];
                                $s[3] = $reels['reel4'][$linesId[$k][3] - 1];
                                $s[4] = $reels['reel5'][$linesId[$k][4] - 1];
                                if( $s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild) ) 
                                {
                                    $mpl = 1;
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable[$_obf_0D011C142C3C37263F351C4012170A074027083F321132][1] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $mpl * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"line":' . ($k + 1) . ',"symbol":"' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '","count":1,"side":"left","elements":[[1,' . $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][0] . ']],"xWin":' . $mpl . ',"win":' . ($cWins[$k] * 100) . '}';
                                    }
                                }
                                if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) ) 
                                {
                                    $mpl = 1;
                                    if( in_array($s[0], $wild) && in_array($s[1], $wild) ) 
                                    {
                                        $mpl = 1;
                                    }
                                    else if( in_array($s[0], $wild) || in_array($s[1], $wild) ) 
                                    {
                                        $mpl = $slotSettings->slotWildMpl;
                                        for( $_obf_0D0C021818145B101222043F3C051C231B1C5B231A3522 = 0; $_obf_0D0C021818145B101222043F3C051C231B1C5B231A3522 < 2; $_obf_0D0C021818145B101222043F3C051C231B1C5B231A3522++ ) 
                                        {
                                            if( in_array($s[$_obf_0D0C021818145B101222043F3C051C231B1C5B231A3522], $wild) ) 
                                            {
                                            }
                                        }
                                    }
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable[$_obf_0D011C142C3C37263F351C4012170A074027083F321132][2] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $mpl * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"line":' . ($k + 1) . ',"symbol":"' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '","count":2,"side":"left","elements":[[1,' . $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][0] . '],[2,' . $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][1] . ']],"xWin":' . $mpl . ',"win":' . ($cWins[$k] * 100) . '}';
                                    }
                                }
                                if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) ) 
                                {
                                    $mpl = 1;
                                    if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) ) 
                                    {
                                        $mpl = 1;
                                    }
                                    else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) ) 
                                    {
                                        $mpl = $slotSettings->slotWildMpl;
                                        for( $_obf_0D0C021818145B101222043F3C051C231B1C5B231A3522 = 0; $_obf_0D0C021818145B101222043F3C051C231B1C5B231A3522 < 3; $_obf_0D0C021818145B101222043F3C051C231B1C5B231A3522++ ) 
                                        {
                                            if( in_array($s[$_obf_0D0C021818145B101222043F3C051C231B1C5B231A3522], $wild) ) 
                                            {
                                            }
                                        }
                                    }
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable[$_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $mpl * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"line":' . ($k + 1) . ',"symbol":"' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '","count":3,"side":"left","elements":[[1,' . $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][0] . '],[2,' . $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][1] . '],[3,' . $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][2] . ']],"xWin":' . $mpl . ',"win":' . ($cWins[$k] * 100) . '}';
                                    }
                                }
                                if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) && ($s[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[3], $wild)) ) 
                                {
                                    $mpl = 1;
                                    if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) && in_array($s[3], $wild) ) 
                                    {
                                        $mpl = 1;
                                    }
                                    else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) || in_array($s[3], $wild) ) 
                                    {
                                        $mpl = $slotSettings->slotWildMpl;
                                        for( $_obf_0D0C021818145B101222043F3C051C231B1C5B231A3522 = 0; $_obf_0D0C021818145B101222043F3C051C231B1C5B231A3522 < 4; $_obf_0D0C021818145B101222043F3C051C231B1C5B231A3522++ ) 
                                        {
                                            if( in_array($s[$_obf_0D0C021818145B101222043F3C051C231B1C5B231A3522], $wild) ) 
                                            {
                                            }
                                        }
                                    }
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable[$_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $mpl * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"line":' . ($k + 1) . ',"symbol":"' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '","count":4,"side":"left","elements":[[1,' . $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][0] . '],[2,' . $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][1] . '],[3,' . $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][2] . '],[4,' . $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][3] . ']],"xWin":' . $mpl . ',"win":' . ($cWins[$k] * 100) . '}';
                                    }
                                }
                                if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) && ($s[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[3], $wild)) && ($s[4] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[4], $wild)) ) 
                                {
                                    $mpl = 1;
                                    if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) && in_array($s[3], $wild) && in_array($s[4], $wild) ) 
                                    {
                                        $mpl = 1;
                                    }
                                    else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) || in_array($s[3], $wild) || in_array($s[4], $wild) ) 
                                    {
                                        $mpl = $slotSettings->slotWildMpl;
                                        for( $_obf_0D0C021818145B101222043F3C051C231B1C5B231A3522 = 0; $_obf_0D0C021818145B101222043F3C051C231B1C5B231A3522 < 5; $_obf_0D0C021818145B101222043F3C051C231B1C5B231A3522++ ) 
                                        {
                                            if( in_array($s[$_obf_0D0C021818145B101222043F3C051C231B1C5B231A3522], $wild) ) 
                                            {
                                            }
                                        }
                                    }
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable[$_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $mpl * $bonusMpl;
                                    if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"line":' . ($k + 1) . ',"symbol":"' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132 . '","count":5,"side":"left","elements":[[1,' . $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][0] . '],[2,' . $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][1] . '],[3,' . $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][2] . '],[4,' . $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][3] . '],[5,' . $_obf_0D060C2D0C080B3E17250940122B1F153D0F2A135B0811[$k][4] . ']],"xWin":' . $mpl . ',"win":' . ($cWins[$k] * 100) . '}';
                                    }
                                }
                            }
                        }
                        if( $cWins[$k] > 0 && $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 != '' ) 
                        {
                            array_push($lineWins, $_obf_0D0207283039073919263232090A382F3D26101F0D1E11);
                            $totalWin += $cWins[$k];
                        }
                    }
                    $scattersWin = 0;
                    $scattersStr = '';
                    $_obf_0D2F263812130A1D380B2F020E362127181D13063E2822 = [];
                    $scattersCount = 0;
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        for( $p = 0; $p <= 2; $p++ ) 
                        {
                            if( $reels['reel' . $r][$p] == $scatter ) 
                            {
                                $scattersCount++;
                                if( $p == 0 ) 
                                {
                                    $_obf_0D36152A142D3640231A1D361D113D0D310B0121323711 = 4;
                                }
                                else if( $p == 1 ) 
                                {
                                    $_obf_0D36152A142D3640231A1D361D113D0D310B0121323711 = 3;
                                }
                                else if( $p == 2 ) 
                                {
                                    $_obf_0D36152A142D3640231A1D361D113D0D310B0121323711 = 2;
                                }
                                else if( $p == 3 ) 
                                {
                                    $_obf_0D36152A142D3640231A1D361D113D0D310B0121323711 = 1;
                                }
                                $_obf_0D2F263812130A1D380B2F020E362127181D13063E2822[] = '[' . $r . ',"' . $_obf_0D36152A142D3640231A1D361D113D0D310B0121323711 . '"]';
                            }
                        }
                    }
                    $scattersWin = $slotSettings->Paytable[$scatter][$scattersCount] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'];
                    if( $scattersCount >= 3 && $slotSettings->slotBonus ) 
                    {
                        $scattersStr = '{"line":"scatter","symbol":"' . $scatter . '","count":' . $scattersCount . ',"elements":[' . implode(',', $_obf_0D2F263812130A1D380B2F020E362127181D13063E2822) . '],"xWin":' . $bonusMpl . ',"freeSpinAdd":' . $slotSettings->slotFreeCount[$scattersCount] . ',"win":' . ($scattersWin * 100) . '}';
                        array_push($lineWins, $scattersStr);
                    }
                    else if( $scattersWin > 0 ) 
                    {
                        $scattersStr = '{"line":"scatter","symbol":"' . $scatter . '","count":' . $scattersCount . ',"elements":[' . implode(',', $_obf_0D2F263812130A1D380B2F020E362127181D13063E2822) . '],"xWin":' . $bonusMpl . ',"freeSpinAdd":0,"win":' . ($scattersWin * 100) . '}';
                        array_push($lineWins, $scattersStr);
                    }
                    else
                    {
                        $scattersStr .= '';
                    }
                    $totalWin += $scattersWin;
                    if( $i > 1000 ) 
                    {
                        $winType = 'none';
                    }
                    if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * rand(2, 5)) ) 
                    {
                    }
                    else if( !$slotSettings->increaseRTP && $winType == 'win' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] < $totalWin ) 
                    {
                    }
                    else
                    {
                        if( $i > 1500 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                            exit( $response );
                        }
                        if( $scattersCount >= 3 && $winType != 'bonus' ) 
                        {
                        }
                        else if( $totalWin <= $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 && $winType == 'bonus' ) 
                        {
                            $_obf_0D163F390C080D0831380D161E12270D0225132B261501 = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                            if( $_obf_0D163F390C080D0831380D161E12270D0225132B261501 < $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 ) 
                            {
                                $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D163F390C080D0831380D161E12270D0225132B261501;
                            }
                            else
                            {
                                break;
                            }
                        }
                        else if( $totalWin > 0 && $totalWin <= $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 && $winType == 'win' ) 
                        {
                            $_obf_0D163F390C080D0831380D161E12270D0225132B261501 = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                            if( $_obf_0D163F390C080D0831380D161E12270D0225132B261501 < $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 ) 
                            {
                                $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D163F390C080D0831380D161E12270D0225132B261501;
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
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                }
                $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                $_obf_0D5C3831071A3610163227012704053C131A110B2E3122 = '';
                $_obf_0D282A3E130518100418230D042B0A2B400930193F3232 = 'null';
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                {
                    $slotSettings->SetGameData('WildSplashATBonusWin', $slotSettings->GetGameData('WildSplashATBonusWin') + $totalWin);
                    $slotSettings->SetGameData('WildSplashATTotalWin', $slotSettings->GetGameData('WildSplashATTotalWin') + $totalWin);
                    $_obf_0D5C3831071A3610163227012704053C131A110B2E3122 = '"id":"54594109_20200214110301","current":' . $slotSettings->GetGameData('WildSplashATCurrentFreeGame') . ',"multiplayer":' . $slotSettings->GetGameData('WildSplashATMpl') . ',"add":0,"total":' . $slotSettings->GetGameData('WildSplashATFreeGames') . ',"totalWin":' . ($slotSettings->GetGameData('WildSplashATBonusWin') * 100) . '';
                }
                else
                {
                    $slotSettings->SetGameData('WildSplashATTotalWin', $totalWin);
                }
                if( $scattersCount >= 3 ) 
                {
                    if( $slotSettings->GetGameData('WildSplashATFreeGames') > 0 ) 
                    {
                        $slotSettings->SetGameData('WildSplashATFreeGames', $slotSettings->GetGameData('WildSplashATFreeGames') + $slotSettings->slotFreeCount[$scattersCount]);
                        $_obf_0D5C3831071A3610163227012704053C131A110B2E3122 = '"id":"54594109_20200214110301","current":' . $slotSettings->GetGameData('WildSplashATCurrentFreeGame') . ',"multiplayer":' . $slotSettings->GetGameData('WildSplashATMpl') . ',"add":' . $slotSettings->slotFreeCount[$scattersCount] . ',"total":' . $slotSettings->GetGameData('WildSplashATFreeGames') . ',"totalWin":' . ($slotSettings->GetGameData('WildSplashATBonusWin') * 100) . '';
                    }
                    else
                    {
                        $slotSettings->SetGameData('WildSplashATFreeBalance', $Balance);
                        $slotSettings->SetGameData('WildSplashATBonusWin', $totalWin);
                        $slotSettings->SetGameData('WildSplashATFreeGames', $slotSettings->slotFreeCount[$scattersCount]);
                        $_obf_0D5C3831071A3610163227012704053C131A110B2E3122 = '"id":"54594109_20200214110301","current":' . $slotSettings->GetGameData('WildSplashATCurrentFreeGame') . ',"multiplayer":' . $slotSettings->GetGameData('WildSplashATMpl') . ',"add":' . $slotSettings->slotFreeCount[$scattersCount] . ',"total":' . $slotSettings->GetGameData('WildSplashATFreeGames') . ',"totalWin":' . ($slotSettings->GetGameData('WildSplashATBonusWin') * 100) . '';
                    }
                }
                $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $lineWins);
                $_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211 = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"slotLines":' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'] . ',"slotBet":' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] . ',"totalFreeGames":' . $slotSettings->GetGameData('WildSplashATFreeGames') . ',"Mpl":' . $slotSettings->GetGameData('WildSplashATMpl') . ',"currentFreeGames":' . $slotSettings->GetGameData('WildSplashATCurrentFreeGame') . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"bonusInfo":{},"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                $_obf_0D1D385C3B2E29221F233F3E3D09295B0F1B0D063B3222 = [];
                for( $i = 1; $i <= 5; $i++ ) 
                {
                    $_obf_0D1D385C3B2E29221F233F3E3D09295B0F1B0D063B3222[] = '"' . $i . '":{"1":"' . $reels['reel' . $i][3] . '","2":"' . $reels['reel' . $i][2] . '","3":"' . $reels['reel' . $i][1] . '","4":"' . $reels['reel' . $i][0] . '"}';
                }
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round(sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                $response = '{"status":"success","microtime":0.012106895446777,"dateTime":"2020-02-13 15:56:37","error":"","content":{"session":"54594109_4133a64673d3883d42cd003ee905ba3e","cmd":"gameSpin","balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"win":' . ($totalWin * 100) . ',"symbols":{' . implode(',', $_obf_0D1D385C3B2E29221F233F3E3D09295B0F1B0D063B3222) . '},"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"freeSpin":{' . $_obf_0D5C3831071A3610163227012704053C131A110B2E3122 . '},"actionId":"54594109_0_315","hash":"3f8366f9f05bada378a5a4a37034e744"}}';
                $slotSettings->SaveLogReport($_obf_0D2D350C1338352E3F0236115C1407341C0926053F2211, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'], $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
