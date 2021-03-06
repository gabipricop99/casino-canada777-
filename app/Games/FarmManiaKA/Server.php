<?php 
namespace VanguardLTE\Games\FarmManiaKA
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
                $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid login"}';
                exit( $response );
            }
            $slotSettings = new SlotSettings($game, $userId);
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822 = json_decode(trim(file_get_contents('php://input')), true);
            $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = '';
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] == 'bet' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet']['gameCommand'] == 'collect' ) 
            {
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] = 'collect';
            }
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = (string)$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'];
            switch( $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 ) 
            {
                case 'startGame':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    for( $i = 0; $i < count($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] * 100;
                    }
                    $lastEvent = $slotSettings->GetHistory();
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    if( $lastEvent != 'NULL' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                        $reels = $lastEvent->serverResponse->reelsSymbols;
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '' . rand(0, 6) . ',' . $reels->reel1[0] . ',' . $reels->reel1[1] . ',' . $reels->reel1[2] . ',' . rand(0, 6);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '';
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ($reels->reel1[2] . ',' . $reels->reel2[2] . ',' . $reels->reel3[2] . ',' . $reels->reel4[2] . ',' . $reels->reel5[2]);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= (',' . $reels->reel1[1] . ',' . $reels->reel2[1] . ',' . $reels->reel3[1] . ',' . $reels->reel4[1] . ',' . $reels->reel5[1]);
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= (',' . $reels->reel1[0] . ',' . $reels->reel2[0] . ',' . $reels->reel3[0] . ',' . $reels->reel4[0] . ',' . $reels->reel5[0]);
                        $lines = $lastEvent->serverResponse->slotLines;
                        $bet = $lastEvent->serverResponse->slotBet * 100;
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                        {
                        }
                    }
                    else
                    {
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6);
                        $lines = 5;
                        $bet = $slotSettings->Bet[0] * 100;
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                    {
                        $_obf_0D3D2721080C3B372A0C403C2A0D1F093124103E1C0422 = 1;
                        $_obf_0D3E242D3C395C18220C29333636375C152728333D0332 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        $fs = 'true';
                        $rd = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        $_obf_0D2207030C311933271F08142B19010D35391119151D22 = $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100;
                    }
                    else
                    {
                        $rd = 0;
                        $fs = 'false';
                        $_obf_0D3D2721080C3B372A0C403C2A0D1F093124103E1C0422 = 0;
                        $_obf_0D3E242D3C395C18220C29333636375C152728333D0332 = 0;
                        $_obf_0D2207030C311933271F08142B19010D35391119151D22 = 0;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"sgr":{"gn":"TRex","lsd":{"sid":' . rand(0, 9999999) . ',"tid":"061db09bc959482288e9452d7eb2bbda","sel":5,"cps":5,"dn":0.01,"nd":0.01,"ncps":0,"atb":0,"v":true,"fs":' . $fs . ',"twg":' . (25 * $bet) . ',"swm":0,"sw":0,"swu":0,"tw":0,"fsw":0,"fsr":' . $_obf_0D3E242D3C395C18220C29333636375C152728333D0332 . ',"tfw":' . $_obf_0D2207030C311933271F08142B19010D35391119151D22 . ',"st":[' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . '],"swi":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"snm":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"ssm":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"sm":[2,1,0,0,0,0,0,0],"acb":' . $_obf_0D3D2721080C3B372A0C403C2A0D1F093124103E1C0422 . ',"rf":0,"as":[],"sp":0,"cr":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['cr'] . '","rd":' . $rd . ',"pbb":0,"obb":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"mb":false,"pwa":0},"drs":[[' . implode(',', $slotSettings->reelStrip1) . '],[' . implode(',', $slotSettings->reelStrip2) . '],[' . implode(',', $slotSettings->reelStrip3) . '],[' . implode(',', $slotSettings->reelStrip4) . '],[' . implode(',', $slotSettings->reelStrip5) . ']],"pt":[[0,0,0,0,0],[0,0,100,1000,3500],[0,0,30,150,700],[0,0,25,100,500],[0,0,25,100,450],[0,0,15,75,250],[0,0,10,50,150],[0,0,10,50,150],[0,0,5,25,100],[0,0,5,25,75],[0,0,5,20,75],[0,0,5,15,50],[0,0,1,0,0]],"cps":[1,2,3,5,10,15,20,25,30,50,75,100,150,250,500],"e":false,"ec":0,"cc":""},"un":"accessKey|' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['cr'] . '|52967038","bl":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"gn":"TRex","lgn":"The King of Dinosaurs","gv":0,"fs":' . $fs . ',"si":"ac7df4a24f4f441896ec13a994b7b178","dn":[0.01,0.05,0.1,0.25,0.5,1.0,2.0],"cs":"$","cd":2,"cp":true,"gs":",","ds":".","ase":[50],"gm":0,"mi":-1,"cud":0.01,"cup":[' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '],"mm":0,"e":false,"ec":0,"cc":"RU"}';
                    break;
                case 'ping':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"v":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"e":false,"ec":0,"cc":"EN"}';
                    break;
                case 'spin':
                    $lines = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['sel'];
                    $betline = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['cps'] / 100;
                    $allbet = $betline * 25;
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                    }
                    if( $allbet <= 0.0001 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] . '","serverResponse":"invalid bet state"}';
                        exit( $response );
                    }
                    if( $slotSettings->GetBalance() < $allbet ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] . '","serverResponse":"invalid balance"}';
                        exit( $response );
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                    {
                        if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                        {
                            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                        }
                        $slotSettings->SetBalance(-1 * $allbet, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $allbet / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $slotSettings->UpdateJackpots($allbet);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                        $bonusMpl = 1;
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                        $bonusMpl = $slotSettings->slotFreeMpl;
                    }
                    $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $allbet, $lines);
                    $winType = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[0];
                    $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[1];
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                    $linesId = $slotSettings->WaysToLines();
                    $_obf_0D1E1D1E330423230F3B1A16370D031D333625295B2F32 = count($linesId);
                    for( $i = 0; $i <= 2000; $i++ ) 
                    {
                        $totalWin = 0;
                        $lineWins = [];
                        $cWins = [];
                        $_obf_0D243D303F2535360506093008312D1A1A5B022D070232 = [];
                        $_obf_0D11393B38130D38112E2A01373F0A5C34211932123911 = [];
                        $wild = ['0'];
                        $scatter = '12';
                        $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $k = 0;
                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '';
                        for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                        {
                            $_obf_0D011C142C3C37263F351C4012170A074027083F321132 = (string)$slotSettings->SymbolGame[$j];
                            if( $_obf_0D011C142C3C37263F351C4012170A074027083F321132 == $scatter || !isset($slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132]) ) 
                            {
                            }
                            else
                            {
                                $_obf_0D043E0C2F28130E1C141403401A17012B293622292C32 = true;
                                $_obf_0D1A191716130D02332C0A1C3C2E161E190D401E140B22 = [];
                                $_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22 = [];
                                $_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22['reel1'] = [
                                    0, 
                                    0, 
                                    0
                                ];
                                $_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22['reel2'] = [
                                    0, 
                                    0, 
                                    0
                                ];
                                $_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22['reel3'] = [
                                    0, 
                                    0, 
                                    0
                                ];
                                $_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22['reel4'] = [
                                    0, 
                                    0, 
                                    0
                                ];
                                $_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22['reel5'] = [
                                    0, 
                                    0, 
                                    0
                                ];
                                $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22 = [
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0
                                ];
                                $_obf_0D1C2618292C18250E2B2B343324310107010A30361501 = false;
                                $_obf_0D402926032103041B240606403D151305053430233611 = false;
                                for( $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622 = 1; $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622 <= 5; $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622++ ) 
                                {
                                    $_obf_0D043E0C2F28130E1C141403401A17012B293622292C32 = false;
                                    for( $rs = 0; $rs <= 2; $rs++ ) 
                                    {
                                        if( $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622 == 2 && in_array($reels['reel' . $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622][$rs], $wild) ) 
                                        {
                                            $_obf_0D1C2618292C18250E2B2B343324310107010A30361501 = true;
                                        }
                                        if( $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622 == 4 && in_array($reels['reel' . $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622][$rs], $wild) ) 
                                        {
                                            $_obf_0D402926032103041B240606403D151305053430233611 = true;
                                        }
                                        if( $reels['reel' . $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622][$rs] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($reels['reel' . $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622][$rs], $wild) ) 
                                        {
                                            $_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22['reel' . $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622][$rs] = -1;
                                            $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[$_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622]++;
                                            $_obf_0D043E0C2F28130E1C141403401A17012B293622292C32 = true;
                                        }
                                    }
                                    if( !$_obf_0D043E0C2F28130E1C141403401A17012B293622292C32 ) 
                                    {
                                        break;
                                    }
                                }
                                $_obf_0D0E141F34210C271834013D060623402816092A400E11 = 0;
                                $_obf_0D112E082E2B040D3331180A1E193C36362B362B2F3201 = 1;
                                if( $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3] > 0 ) 
                                {
                                    $_obf_0D0E141F34210C271834013D060623402816092A400E11 = ($_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $betline * $bonusMpl) * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3];
                                    $_obf_0D243D303F2535360506093008312D1A1A5B022D070232[$k] = $slotSettings->GetSymPositions($_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22);
                                    $_obf_0D112E082E2B040D3331180A1E193C36362B362B2F3201 = $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3];
                                }
                                if( $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[4] > 0 ) 
                                {
                                    $_obf_0D0E141F34210C271834013D060623402816092A400E11 = ($_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $betline * $bonusMpl) * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[4];
                                    $_obf_0D243D303F2535360506093008312D1A1A5B022D070232[$k] = $slotSettings->GetSymPositions($_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22);
                                    $_obf_0D112E082E2B040D3331180A1E193C36362B362B2F3201 = $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[4];
                                }
                                if( $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[4] > 0 && $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[5] > 0 ) 
                                {
                                    $_obf_0D0E141F34210C271834013D060623402816092A400E11 = ($_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $betline * $bonusMpl) * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[4] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[5];
                                    $_obf_0D243D303F2535360506093008312D1A1A5B022D070232[$k] = $slotSettings->GetSymPositions($_obf_0D2F271A3F332D2B5C013404340B27173C252824250E22);
                                    $_obf_0D112E082E2B040D3331180A1E193C36362B362B2F3201 = $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[1] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[2] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[3] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[4] * $_obf_0D093E0C04250E390E2E2B032D223307091B251B5C0E22[5];
                                }
                                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                                {
                                    if( $_obf_0D1C2618292C18250E2B2B343324310107010A30361501 ) 
                                    {
                                        $bonusMpl = 5;
                                    }
                                    if( $_obf_0D402926032103041B240606403D151305053430233611 ) 
                                    {
                                        $bonusMpl = 5;
                                    }
                                    if( $_obf_0D1C2618292C18250E2B2B343324310107010A30361501 && $_obf_0D402926032103041B240606403D151305053430233611 ) 
                                    {
                                        $bonusMpl = 5;
                                    }
                                }
                                if( $_obf_0D0E141F34210C271834013D060623402816092A400E11 > 0 ) 
                                {
                                    if( $_obf_0D112E082E2B040D3331180A1E193C36362B362B2F3201 == 0 ) 
                                    {
                                        $_obf_0D112E082E2B040D3331180A1E193C36362B362B2F3201 = 1;
                                    }
                                    $_obf_0D11393B38130D38112E2A01373F0A5C34211932123911[$k] = $bonusMpl;
                                    $cWins[$k] = $_obf_0D0E141F34210C271834013D060623402816092A400E11 / $bonusMpl;
                                    $totalWin += $_obf_0D0E141F34210C271834013D060623402816092A400E11;
                                    $k++;
                                }
                            }
                        }
                        $scattersWin = 0;
                        $scattersStr = '';
                        $scattersCount = 0;
                        $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 = 0;
                        $_obf_0D312B19262C083426241E0D392E22282324060B380811 = [];
                        $_obf_0D17160E2B291A250538092F25013526223F0C272E2122 = [
                            0, 
                            1, 
                            2, 
                            4, 
                            8, 
                            16
                        ];
                        $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922 = [
                            0, 
                            0, 
                            0
                        ];
                        for( $p = 2; $p >= 0; $p-- ) 
                        {
                            if( $reels['reel1'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 1;
                            }
                            if( $reels['reel2'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 2;
                            }
                            if( $reels['reel3'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 4;
                            }
                            if( $reels['reel4'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 8;
                            }
                            if( $reels['reel5'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 16;
                            }
                            if( $reels['reel1'][$p] == $scatter && $reels['reel2'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 3;
                            }
                            if( $reels['reel1'][$p] == $scatter && $reels['reel3'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 5;
                            }
                            if( $reels['reel2'][$p] == $scatter && $reels['reel3'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 6;
                            }
                            if( $reels['reel1'][$p] == $scatter && $reels['reel4'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 9;
                            }
                            if( $reels['reel2'][$p] == $scatter && $reels['reel4'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 10;
                            }
                            if( $reels['reel3'][$p] == $scatter && $reels['reel4'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 12;
                            }
                            if( $reels['reel1'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 17;
                            }
                            if( $reels['reel2'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 18;
                            }
                            if( $reels['reel3'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 20;
                            }
                            if( $reels['reel4'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 24;
                            }
                            if( $reels['reel1'][$p] == $scatter && $reels['reel2'][$p] == $scatter && $reels['reel3'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 7;
                            }
                            if( $reels['reel1'][$p] == $scatter && $reels['reel2'][$p] == $scatter && $reels['reel4'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 11;
                            }
                            if( $reels['reel1'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel4'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 13;
                            }
                            if( $reels['reel2'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel4'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 14;
                            }
                            if( $reels['reel1'][$p] == $scatter && $reels['reel2'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 19;
                            }
                            if( $reels['reel1'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 21;
                            }
                            if( $reels['reel2'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 22;
                            }
                            if( $reels['reel1'][$p] == $scatter && $reels['reel4'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 25;
                            }
                            if( $reels['reel2'][$p] == $scatter && $reels['reel4'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 26;
                            }
                            if( $reels['reel3'][$p] == $scatter && $reels['reel4'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 28;
                            }
                            if( $reels['reel1'][$p] == $scatter && $reels['reel2'][$p] == $scatter && $reels['reel4'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 27;
                            }
                            if( $reels['reel1'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel4'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 29;
                            }
                            if( $reels['reel2'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel4'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 30;
                            }
                            if( $reels['reel1'][$p] == $scatter && $reels['reel2'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 23;
                            }
                            if( $reels['reel1'][$p] == $scatter && $reels['reel2'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel4'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 15;
                            }
                            if( $reels['reel1'][$p] == $scatter && $reels['reel2'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel4'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                            {
                                $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[$p] = 31;
                            }
                        }
                        for( $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622 = 1; $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622 <= 5; $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622++ ) 
                        {
                            for( $rs = 0; $rs <= 2; $rs++ ) 
                            {
                                if( $reels['reel' . $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622][$rs] == $scatter ) 
                                {
                                    $scattersCount++;
                                }
                            }
                        }
                        for( $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622 = 1; $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622 <= 5; $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622++ ) 
                        {
                            if( $reels['reel' . $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622][0] == '5' || $reels['reel' . $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622][1] == '5' || $reels['reel' . $_obf_0D0D401E2C11131E3013272F11160B3E0E0D2B1D310622][2] == '5' ) 
                            {
                                $_obf_0D28301D333F2827165C2511011438180336175B1E2A01++;
                            }
                            else
                            {
                                break;
                            }
                        }
                        $scattersWin = $slotSettings->Paytable['SYM_' . $scatter][$scattersCount] * $allbet * $bonusMpl;
                        $totalWin += $scattersWin;
                        if( $i > 1000 ) 
                        {
                            $winType = 'none';
                        }
                        if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($allbet * rand(2, 5)) ) 
                        {
                        }
                        else if( !$slotSettings->increaseRTP && $winType == 'win' && $allbet < $totalWin ) 
                        {
                        }
                        else
                        {
                            if( $i > 1500 ) 
                            {
                                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                                exit( $response );
                            }
                            if( $scattersCount >= 3 && $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 >= 5 && $winType != 'bonus' ) 
                            {
                            }
                            else if( ($scattersCount >= 3 || $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 >= 5) && $winType != 'bonus' ) 
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
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                        $slotSettings->SetBalance($totalWin);
                    }
                    $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    }
                    $fs = 0;
                    $_obf_0D271526050C14371508061C1D40060F233C35263B3B01 = 0;
                    $_obf_0D2722011B2C34273F323035330D123F2706282E131932 = 0;
                    if( $scattersCount >= 3 ) 
                    {
                        $_obf_0D2722011B2C34273F323035330D123F2706282E131932 = $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[2] + (32 * $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[1]) + (1024 * $_obf_0D085C013D3D5C0503393819382A12393D2A182E341922[0]);
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $slotSettings->slotFreeCount[$scattersCount]);
                        }
                        else
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->slotFreeCount[$scattersCount]);
                        }
                        $fs = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $_obf_0D271526050C14371508061C1D40060F233C35263B3B01 = 1;
                    }
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $lineWins);
                    $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                    $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"afterBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 = '';
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '';
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ($reels['reel1'][2] . ',' . $reels['reel2'][2] . ',' . $reels['reel3'][2] . ',' . $reels['reel4'][2] . ',' . $reels['reel5'][2]);
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= (',' . $reels['reel1'][1] . ',' . $reels['reel2'][1] . ',' . $reels['reel3'][1] . ',' . $reels['reel4'][1] . ',' . $reels['reel5'][1]);
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= (',' . $reels['reel1'][0] . ',' . $reels['reel2'][0] . ',' . $reels['reel3'][0] . ',' . $reels['reel4'][0] . ',' . $reels['reel5'][0]);
                    $_obf_0D3D2721080C3B372A0C403C2A0D1F093124103E1C0422 = 0;
                    $_obf_0D380B2515180F1C2C170B075B0A392209351C07312C32 = 'false';
                    if( $winType == 'bonus' ) 
                    {
                        $_obf_0D3D2721080C3B372A0C403C2A0D1F093124103E1C0422 = 1;
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D380B2515180F1C2C170B075B0A392209351C07312C32 = 'true';
                        $_obf_0D3D2721080C3B372A0C403C2A0D1F093124103E1C0422 = 1;
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') > 0 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin'));
                        }
                    }
                    $_obf_0D1432010D2B5B25344012133611322511253B0D401D22 = [];
                    for( $_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01 = 0; $_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01 < count($cWins); $_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01++ ) 
                    {
                        $_obf_0D1432010D2B5B25344012133611322511253B0D401D22[$_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01] = $cWins[$_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01] * 100;
                    }
                    $_obf_0D06130C3D353902081217172123151E250923172E1932 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                    $_obf_0D150303033D3D380F5C0C2B33071E0E1038072F230232 = '';
                    if( $_obf_0D28301D333F2827165C2511011438180336175B1E2A01 >= 3 ) 
                    {
                        $_obf_0D3D2721080C3B372A0C403C2A0D1F093124103E1C0422 = 2;
                        $_obf_0D150303033D3D380F5C0C2B33071E0E1038072F230232 = ',"bpd":{"c":false,"s":false,"lt":0,"np":19,"msb":18,"w":0,"lpw":0,"nfw":0,"m":0,"mk":0,"m2":98000,"m3":98000,"csw":0}';
                        $_obf_0D1E14033728390E26292326040903255B24350D254022 = [
                            1, 
                            1, 
                            1, 
                            1, 
                            1, 
                            2, 
                            2, 
                            2, 
                            2, 
                            3, 
                            3, 
                            3, 
                            4, 
                            4, 
                            4, 
                            5, 
                            5, 
                            5, 
                            5, 
                            10, 
                            10, 
                            10, 
                            10, 
                            15, 
                            15, 
                            15, 
                            20, 
                            20, 
                            20, 
                            25, 
                            25, 
                            50, 
                            50, 
                            100, 
                            100, 
                            1, 
                            1, 
                            1, 
                            2, 
                            2, 
                            2, 
                            2, 
                            3, 
                            3, 
                            3, 
                            4, 
                            4, 
                            4, 
                            5, 
                            5, 
                            5, 
                            5, 
                            10, 
                            10, 
                            10, 
                            10, 
                            15, 
                            15, 
                            15, 
                            20, 
                            20, 
                            20, 
                            25, 
                            25, 
                            50, 
                            50, 
                            100, 
                            100
                        ];
                        $bank = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                        for( $bs = 0; $bs <= 2000; $bs++ ) 
                        {
                            $_obf_0D3E5B231D1413271C2A2C062D013F5B265B263D0F2132 = 0;
                            $PickBonusValue = [
                                0, 
                                0, 
                                0, 
                                0, 
                                0
                            ];
                            shuffle($_obf_0D1E14033728390E26292326040903255B24350D254022);
                            for( $_obf_0D142B27032E0A370E5B1B373B2C27353B3801072F1932 = 0; $_obf_0D142B27032E0A370E5B1B373B2C27353B3801072F1932 < 5; $_obf_0D142B27032E0A370E5B1B373B2C27353B3801072F1932++ ) 
                            {
                                $_obf_0D3D10372B38105B320D0C0D3015221238403C090D2632 = $_obf_0D1E14033728390E26292326040903255B24350D254022[$_obf_0D142B27032E0A370E5B1B373B2C27353B3801072F1932] * $betline;
                                $_obf_0D3E5B231D1413271C2A2C062D013F5B265B263D0F2132 += $_obf_0D3D10372B38105B320D0C0D3015221238403C090D2632;
                                $PickBonusValue[$_obf_0D142B27032E0A370E5B1B373B2C27353B3801072F1932] = $_obf_0D3D10372B38105B320D0C0D3015221238403C090D2632;
                            }
                            if( $_obf_0D3E5B231D1413271C2A2C062D013F5B265B263D0F2132 <= $bank ) 
                            {
                                break;
                            }
                        }
                        if( $_obf_0D3E5B231D1413271C2A2C062D013F5B265B263D0F2132 > 0 ) 
                        {
                            $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $_obf_0D3E5B231D1413271C2A2C062D013F5B265B263D0F2132);
                            $slotSettings->SetBalance($_obf_0D3E5B231D1413271C2A2C062D013F5B265B263D0F2132);
                        }
                        $PickBonusResult[] = -1;
                        $PickBonusResult[] = -1;
                        $PickBonusResult[] = -1;
                        $PickBonusResult[] = -1;
                        $PickBonusResult[] = -1;
                        $PickBonusResult[] = -1;
                        $PickBonusResult[] = -1;
                        $PickBonusResult[] = -1;
                        $PickBonusResult[] = -1;
                        $PickBonusResult[] = -1;
                        $PickBonusResult[] = -1;
                        $PickBonusResult[] = -1;
                        $PickBonusResult[] = -1;
                        $PickBonusResult[] = -1;
                        $PickBonusResult[] = -1;
                        $PickBonusResult[] = -1;
                        $PickBonusResult[] = -1;
                        $PickBonusResult[] = -1;
                        $slotSettings->SetGameData($slotSettings->slotId . 'PickBonusCount', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'PickBonusWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'PickBonusValue', $PickBonusValue);
                        $slotSettings->SetGameData($slotSettings->slotId . 'PickBonusResult', $PickBonusResult);
                        $slotSettings->SaveLogReport($response, 0, 0, $_obf_0D3E5B231D1413271C2A2C062D013F5B265B263D0F2132, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"sid":' . rand(0, 9999999) . ',"md":{"sid":' . rand(0, 9999999) . ',"tid":"f1fe09a17cf24a35a7c300e6b2d77eec","sel":' . $lines . ',"cps":5,"dn":0.01,"nd":0.01,"ncps":0,"atb":0,"v":true,"fs":' . $_obf_0D380B2515180F1C2C170B075B0A392209351C07312C32 . ',"twg":' . (25 * $betline * 100) . ',"swm":' . $_obf_0D2722011B2C34273F323035330D123F2706282E131932 . ',"sw":' . ($scattersWin * 100) . ',"swu":' . $_obf_0D271526050C14371508061C1D40060F233C35263B3B01 . ',"tw":' . ($totalWin * 100) . ',"fsw":' . $fs . ',"fsr":' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')) . ',"tfw":' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . ',"st":[' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . '],"swi":[' . implode(',', $_obf_0D1432010D2B5B25344012133611322511253B0D401D22) . '],"snm":[' . implode(',', $_obf_0D11393B38130D38112E2A01373F0A5C34211932123911) . '],"ssm":[' . implode(',', $_obf_0D243D303F2535360506093008312D1A1A5B022D070232) . ']' . $_obf_0D150303033D3D380F5C0C2B33071E0E1038072F230232 . ',"sm":[1],"acb":' . $_obf_0D3D2721080C3B372A0C403C2A0D1F093124103E1C0422 . ',"rf":0,"sp":1,"cr":"USD","sessionId":"ac7df4a24f4f441896ec13a994b7b178","rd":0,"pbb":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"obb":' . $_obf_0D06130C3D353902081217172123151E250923172E1932 . ',"mb":false,"pwa":0,"pac":{}},"pcr":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"cr":' . $_obf_0D06130C3D353902081217172123151E250923172E1932 . ',"xp":0,"lvl":{"lvl":1,"xp":0,"bc":0,"cps":5,"sc":200,"wb":0},"dl":0,"cps":[1,2,3,5,10,15,20,25,30,50,75,100,150,250,500],"e":false,"ec":0,"cc":"RU"}';
                    $PickAnswer = '{"md":{"sid":2371159497,"tid":"6e60cdc944754acba254b058afafb17d","sel":' . $lines . ',"cps":5,"dn":0.01,"nd":0.01,"ncps":0,"atb":0,"v":true,"fs":false,"twg":' . (25 * $betline * 100) . ',"swm":' . $_obf_0D2722011B2C34273F323035330D123F2706282E131932 . ',"sw":' . ($scattersWin * 100) . ',"swu":' . $_obf_0D271526050C14371508061C1D40060F233C35263B3B01 . ',"tw":' . ($totalWin * 100) . ',"fsw":' . $fs . ',"fsr":' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')) . ',"tfw":' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . ',"st":[' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . '],"swi":[' . implode(',', $_obf_0D1432010D2B5B25344012133611322511253B0D401D22) . '],"snm":[' . implode(',', $_obf_0D11393B38130D38112E2A01373F0A5C34211932123911) . '],"ssm":[' . implode(',', $_obf_0D243D303F2535360506093008312D1A1A5B022D070232) . '],"bpd":{"c":false,"s":true,"lt":0,"np":4,"msb":4,"w":0,"lpw":0,"nfw":0,"m":0,"mk":3,"m2":0,"m3":0,"rv":[-1,-1,-1,-1,-1],"csw":0},"acb":2,"rf":0,"as":[],"sp":40,"cr":"USD","sessionId":"20685ede9e4a4c91ab030dec86cca651","rd":0,"pbb":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"obb":10002743,"mb":false,"pwa":0,"pac":{}},"p":0,"cr":10002743,"cps":[1,2,3,5,10,15,20,25,30,50,75,100,150,250,500],"e":false,"ec":0,"cc":"RU"}';
                    $slotSettings->SetGameData($slotSettings->slotId . 'PickAnswer', $PickAnswer);
                    break;
                case 'bonusPick':
                    $PickBonusCount = $slotSettings->GetGameData($slotSettings->slotId . 'PickBonusCount');
                    $PickBonusWin = $slotSettings->GetGameData($slotSettings->slotId . 'PickBonusWin');
                    $PickBonusValue = $slotSettings->GetGameData($slotSettings->slotId . 'PickBonusValue');
                    $PickBonusResult = $slotSettings->GetGameData($slotSettings->slotId . 'PickBonusResult');
                    $PickAnswer = json_decode($slotSettings->GetGameData($slotSettings->slotId . 'PickAnswer'), true);
                    $_obf_0D26310D36283E152C2B2607322D170A2C211913392E11 = $PickBonusValue[$PickBonusCount] * 100;
                    $PickBonusWin += $_obf_0D26310D36283E152C2B2607322D170A2C211913392E11;
                    $PickBonusResult[$PickBonusCount] = $_obf_0D26310D36283E152C2B2607322D170A2C211913392E11;
                    $c = false;
                    if( $PickBonusCount == 3 ) 
                    {
                        $c = true;
                        $PickBonusResult[4] = 0;
                    }
                    $mk = [
                        1, 
                        3, 
                        7, 
                        15
                    ];
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                    $PickAnswer['md']['obb'] = $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901;
                    $PickAnswer['cr'] = $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901;
                    $PickAnswer['md']['bpd']['mk'] = $mk[$PickBonusCount];
                    $PickAnswer['md']['bpd']['c'] = $c;
                    $PickAnswer['md']['bpd']['s'] = true;
                    $PickAnswer['md']['bpd']['w'] = $PickBonusWin;
                    $PickAnswer['md']['bpd']['lpw'] = $_obf_0D26310D36283E152C2B2607322D170A2C211913392E11;
                    $PickAnswer['md']['bpd']['rv'] = $PickBonusResult;
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = json_encode($PickAnswer);
                    $PickBonusCount++;
                    $slotSettings->SetGameData($slotSettings->slotId . 'PickBonusCount', $PickBonusCount);
                    $slotSettings->SetGameData($slotSettings->slotId . 'PickBonusWin', $PickBonusWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'PickBonusValue', $PickBonusValue);
                    $slotSettings->SetGameData($slotSettings->slotId . 'PickBonusResult', $PickBonusResult);
                    break;
                case 'bonusPick':
                    $PickBonusCount = $slotSettings->GetGameData($slotSettings->slotId . 'PickBonusCount');
                    $PickBonusWin = $slotSettings->GetGameData($slotSettings->slotId . 'PickBonusWin');
                    $PickBonusValue = $slotSettings->GetGameData($slotSettings->slotId . 'PickBonusValue');
                    $PickBonusResult = $slotSettings->GetGameData($slotSettings->slotId . 'PickBonusResult');
                    $PickAnswer = json_decode($slotSettings->GetGameData($slotSettings->slotId . 'PickAnswer'), true);
                    $_obf_0D26310D36283E152C2B2607322D170A2C211913392E11 = $PickBonusValue[$PickBonusCount] * 100;
                    $PickBonusWin += $_obf_0D26310D36283E152C2B2607322D170A2C211913392E11;
                    $PickBonusResult[$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['p']] = $_obf_0D26310D36283E152C2B2607322D170A2C211913392E11;
                    $c = false;
                    if( $PickBonusCount == 4 ) 
                    {
                        $c = true;
                        $PickBonusResult[$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['p']] = 0;
                        $PickBonusResult[$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['p'] + 1] = 0;
                    }
                    $mk = [
                        1, 
                        3, 
                        7, 
                        15, 
                        31
                    ];
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                    $PickAnswer['md']['obb'] = $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901;
                    $PickAnswer['cr'] = $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901;
                    $PickAnswer['md']['bpd']['mk'] = $mk[$PickBonusCount];
                    $PickAnswer['md']['bpd']['c'] = $c;
                    $PickAnswer['md']['bpd']['s'] = true;
                    $PickAnswer['md']['bpd']['w'] = $PickBonusWin;
                    $PickAnswer['md']['bpd']['lpw'] = $_obf_0D26310D36283E152C2B2607322D170A2C211913392E11;
                    $PickAnswer['md']['bpd']['rv'] = $PickBonusResult;
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = json_encode($PickAnswer);
                    $PickBonusCount++;
                    $slotSettings->SetGameData($slotSettings->slotId . 'PickBonusCount', $PickBonusCount);
                    $slotSettings->SetGameData($slotSettings->slotId . 'PickBonusWin', $PickBonusWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'PickBonusValue', $PickBonusValue);
                    $slotSettings->SetGameData($slotSettings->slotId . 'PickBonusResult', $PickBonusResult);
                    break;
                case 'updatePlayerInfo':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{"e":false,"ec":0,"cc":"EN"}';
                    break;
            }
            if( !isset($_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0]) ) 
            {
                $response = '{"responseEvent":"error","responseType":"","serverResponse":"Invalid request state"}';
                exit( $response );
            }
            $response = $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0];
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
