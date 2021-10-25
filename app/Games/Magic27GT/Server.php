<?php 
namespace VanguardLTE\Games\Magic27GT
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
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822 = json_decode(trim(file_get_contents('php://input')), true);
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
            if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'getSettings' ) 
            {
                $lastEvent = $slotSettings->GetHistory();
                if( $lastEvent != 'NULL' ) 
                {
                    if( isset($lastEvent->serverResponse->expSymbol) ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'ExpSymbol', $lastEvent->serverResponse->expSymbol);
                    }
                    if( isset($lastEvent->serverResponse->bonusWin) ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->totalWin);
                    }
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                }
                $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 = json_encode($slotSettings);
                $lang = json_encode(\Lang::get('games.' . $game));
                $response = '{"responseEvent":"getSettings","slotLanguage":' . $lang . ',"serverResponse":' . $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 . '}';
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'gamble5GetUserCards' ) 
            {
                $Balance = $slotSettings->GetBalance();
                $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = rand(1, $slotSettings->GetGambleSettings());
                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $slotSettings->GetGameData('Magic27GTDealerCard');
                $totalWin = $slotSettings->GetGameData('Magic27GTTotalWin');
                $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = 0;
                $gambleChoice = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['gambleChoice'] - 2;
                $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = '';
                $_obf_0D111701310A072F5C142524252B302A243F091F172411 = [
                    2, 
                    3, 
                    4, 
                    5, 
                    6, 
                    7, 
                    8, 
                    9, 
                    10, 
                    11, 
                    12, 
                    13, 
                    14
                ];
                $_obf_0D112B16351A0D0D02250E1F401526150C21152B143932 = [
                    'C', 
                    'S', 
                    'D', 
                    'H'
                ];
                $_obf_0D07380D0B2F2F240918081F3F2A042730295C091F2132 = [
                    '', 
                    '', 
                    '2', 
                    '3', 
                    '4', 
                    '5', 
                    '6', 
                    '7', 
                    '8', 
                    '9', 
                    '10', 
                    'J', 
                    'Q', 
                    'K', 
                    'A'
                ];
                $_obf_0D093F0332311B250D5C25022B1E403C26403B330F3511 = 0;
                $_obf_0D3310323F3F07041133133D263014342B230C260D1F11 = $totalWin;
                if( $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : '')) < ($totalWin * 2) ) 
                {
                    $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = 0;
                }
                if( $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 == 1 ) 
                {
                    $_obf_0D093F0332311B250D5C25022B1E403C26403B330F3511 = rand($_obf_0D25035C31183316381216122811401A1F2A17243E2B22, 14);
                }
                else
                {
                    $_obf_0D093F0332311B250D5C25022B1E403C26403B330F3511 = rand(2, $_obf_0D25035C31183316381216122811401A1F2A17243E2B22);
                }
                if( $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 < $_obf_0D093F0332311B250D5C25022B1E403C26403B330F3511 ) 
                {
                    $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = $totalWin;
                    $totalWin = $totalWin * 2;
                    $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'win';
                }
                else if( $_obf_0D093F0332311B250D5C25022B1E403C26403B330F3511 < $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 ) 
                {
                    $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = -1 * $totalWin;
                    $totalWin = 0;
                    $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'lose';
                }
                else
                {
                    $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = $totalWin;
                    $totalWin = $totalWin;
                    $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'draw';
                }
                if( $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 != $totalWin ) 
                {
                    $slotSettings->SetBalance($_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22);
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 * -1);
                }
                $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 = $slotSettings->GetBalance();
                $_obf_0D070A3C372F0137055B310C3816090324041017273C11 = [
                    rand(2, 14), 
                    rand(2, 14), 
                    rand(2, 14), 
                    rand(2, 14)
                ];
                $_obf_0D070A3C372F0137055B310C3816090324041017273C11[$gambleChoice] = $_obf_0D093F0332311B250D5C25022B1E403C26403B330F3511;
                for( $i = 0; $i < 4; $i++ ) 
                {
                    $_obf_0D070A3C372F0137055B310C3816090324041017273C11[$i] = '"' . $_obf_0D07380D0B2F2F240918081F3F2A042730295C091F2132[$_obf_0D070A3C372F0137055B310C3816090324041017273C11[$i]] . $_obf_0D112B16351A0D0D02250E1F401526150C21152B143932[rand(0, 3)] . '"';
                }
                $_obf_0D151B5C293D1C393D0F2F340F2A15032A122618191A32 = implode(',', $_obf_0D070A3C372F0137055B310C3816090324041017273C11);
                $slotSettings->SetGameData('Magic27GTTotalWin', $totalWin);
                $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 = '{"dealerCard":"' . $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 . '","playerCards":[' . $_obf_0D151B5C293D1C393D0F2F340F2A15032A122618191A32 . '],"gambleState":"' . $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 . '","totalWin":' . $totalWin . ',"afterBalance":' . $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 . ',"Balance":' . $Balance . '}';
                $response = '{"responseEvent":"gambleResult","deb":' . $_obf_0D070A3C372F0137055B310C3816090324041017273C11[$gambleChoice] . ',"serverResponse":' . $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 . '}';
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'gamble5GetDealerCard' ) 
            {
                $_obf_0D111701310A072F5C142524252B302A243F091F172411 = [
                    2, 
                    3, 
                    4, 
                    5, 
                    6, 
                    7, 
                    8, 
                    9, 
                    10, 
                    11, 
                    12, 
                    13, 
                    14
                ];
                $_obf_0D07380D0B2F2F240918081F3F2A042730295C091F2132 = [
                    '', 
                    '', 
                    '2', 
                    '3', 
                    '4', 
                    '5', 
                    '6', 
                    '7', 
                    '8', 
                    '9', 
                    '10', 
                    'J', 
                    'Q', 
                    'K', 
                    'A'
                ];
                $_obf_0D112B16351A0D0D02250E1F401526150C21152B143932 = [
                    'C', 
                    'S', 
                    'D', 
                    'H'
                ];
                $_obf_0D1A28330223330201021115084008123B0F213C102922 = $_obf_0D111701310A072F5C142524252B302A243F091F172411[rand(0, 12)];
                $slotSettings->SetGameData('Magic27GTDealerCard', $_obf_0D1A28330223330201021115084008123B0F213C102922);
                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D07380D0B2F2F240918081F3F2A042730295C091F2132[$_obf_0D1A28330223330201021115084008123B0F213C102922] . $_obf_0D112B16351A0D0D02250E1F401526150C21152B143932[rand(0, 3)];
                $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 = '{"dealerCard":"' . $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 . '"}';
                $response = '{"responseEvent":"gamble5DealerCard","serverResponse":' . $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 . '}';
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'slotGamble' ) 
            {
                $Balance = $slotSettings->GetBalance();
                $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = rand(1, $slotSettings->GetGambleSettings());
                $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = '';
                $totalWin = $slotSettings->GetGameData('Magic27GTTotalWin');
                $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = 0;
                $_obf_0D3310323F3F07041133133D263014342B230C260D1F11 = $totalWin;
                if( $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : '')) < ($totalWin * 2) ) 
                {
                    $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 = 0;
                }
                if( $_obf_0D03381F212715073B0D165C28180E2C193C0A19283922 == 1 ) 
                {
                    $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 = 'win';
                    $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 = $totalWin;
                    $totalWin = $totalWin * 2;
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['gambleChoice'] == 'red' ) 
                    {
                        $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301 = [
                            'D', 
                            'H'
                        ];
                        $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301[rand(0, 1)];
                    }
                    else
                    {
                        $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301 = [
                            'C', 
                            'S'
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
                            'C', 
                            'S'
                        ];
                        $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301[rand(0, 1)];
                    }
                    else
                    {
                        $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301 = [
                            'D', 
                            'H'
                        ];
                        $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 = $_obf_0D2B233F1B31290D2D35031A27300A032A11180B050301[rand(0, 1)];
                    }
                }
                $slotSettings->SetGameData('Magic27GTTotalWin', $totalWin);
                $slotSettings->SetBalance($_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22);
                $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22 * -1);
                $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 = $slotSettings->GetBalance();
                $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 = '{"dealerCard":"' . $_obf_0D25035C31183316381216122811401A1F2A17243E2B22 . '","gambleState":"' . $_obf_0D0E2C2E373C171C3B0B2905400E372723283E18043511 . '","totalWin":' . $totalWin . ',"afterBalance":' . $_obf_0D14303C231C032D241D0B0B3536181C110C0D0A2B1932 . ',"Balance":' . $Balance . '}';
                $response = '{"responseEvent":"gambleResult","serverResponse":' . $_obf_0D300C2F21350336261622142A322E0C270C0A1F2F0422 . '}';
                $slotSettings->SaveLogReport($response, $_obf_0D3310323F3F07041133133D263014342B230C260D1F11, 1, $_obf_0D33130E1F150A28331B2F322B291E402639242D2B2D22, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
            }
            else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'bet' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
            {
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
                    3, 
                    3, 
                    3, 
                    2
                ];
                $linesId[6] = [
                    2, 
                    1, 
                    1, 
                    1, 
                    2
                ];
                $linesId[7] = [
                    3, 
                    3, 
                    2, 
                    1, 
                    1
                ];
                $linesId[8] = [
                    1, 
                    1, 
                    2, 
                    3, 
                    3
                ];
                $linesId[9] = [
                    3, 
                    2, 
                    2, 
                    2, 
                    1
                ];
                $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'], 10);
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
                    $slotSettings->SetGameData('Magic27GTBonusWin', 0);
                    $slotSettings->SetGameData('Magic27GTFreeGames', 0);
                    $slotSettings->SetGameData('Magic27GTCurrentFreeGame', 0);
                    $slotSettings->SetGameData('Magic27GTTotalWin', 0);
                    $slotSettings->SetGameData('Magic27GTFreeBalance', 0);
                }
                else
                {
                    $slotSettings->SetGameData('Magic27GTCurrentFreeGame', $slotSettings->GetGameData('Magic27GTCurrentFreeGame') + 1);
                    $bonusMpl = $slotSettings->slotFreeMpl;
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
                        0
                    ];
                    $wild = 'P_1';
                    $scatter = 'SCAT';
                    $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D22231B233B2234020E5C103C342D021B16333F1C0D22 = [];
                    $_obf_0D282B142F1407181316122C3526381B3740213C330232 = false;
                    $_obf_0D051712392E3D021211390136393E0A2126381F3C3401 = [
                        [
                            0, 
                            0, 
                            0
                        ], 
                        [
                            0, 
                            0, 
                            0
                        ], 
                        [
                            0, 
                            0, 
                            0
                        ]
                    ];
                    for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                    {
                        if( $slotSettings->SymbolGame[$j] == $scatter || !isset($slotSettings->Paytable[$slotSettings->SymbolGame[$j]]) ) 
                        {
                        }
                        else
                        {
                            $_obf_0D22231B233B2234020E5C103C342D021B16333F1C0D22[$slotSettings->SymbolGame[$j]] = [
                                0, 
                                0, 
                                0
                            ];
                            $_obf_0D301A050D36301F15050F38140B0731150A0D1F0D0C11 = [
                                [
                                    '', 
                                    '', 
                                    ''
                                ], 
                                [
                                    '', 
                                    '', 
                                    ''
                                ], 
                                [
                                    '', 
                                    '', 
                                    ''
                                ]
                            ];
                            for( $r = 0; $r < 3; $r++ ) 
                            {
                                if( $reels['reel1'][$r] == $slotSettings->SymbolGame[$j] || $reels['reel1'][$r] == $wild ) 
                                {
                                    $_obf_0D22231B233B2234020E5C103C342D021B16333F1C0D22[$slotSettings->SymbolGame[$j]][0]++;
                                    $_obf_0D301A050D36301F15050F38140B0731150A0D1F0D0C11[0][$r] = $reels['reel1'][$r];
                                }
                                if( $reels['reel2'][$r] == $slotSettings->SymbolGame[$j] || $reels['reel2'][$r] == $wild ) 
                                {
                                    $_obf_0D22231B233B2234020E5C103C342D021B16333F1C0D22[$slotSettings->SymbolGame[$j]][1]++;
                                    $_obf_0D301A050D36301F15050F38140B0731150A0D1F0D0C11[1][$r] = $reels['reel2'][$r];
                                }
                                if( $reels['reel3'][$r] == $slotSettings->SymbolGame[$j] || $reels['reel3'][$r] == $wild ) 
                                {
                                    $_obf_0D22231B233B2234020E5C103C342D021B16333F1C0D22[$slotSettings->SymbolGame[$j]][2]++;
                                    $_obf_0D301A050D36301F15050F38140B0731150A0D1F0D0C11[2][$r] = $reels['reel3'][$r];
                                }
                            }
                            if( $_obf_0D22231B233B2234020E5C103C342D021B16333F1C0D22[$slotSettings->SymbolGame[$j]][0] > 0 && $_obf_0D22231B233B2234020E5C103C342D021B16333F1C0D22[$slotSettings->SymbolGame[$j]][1] > 0 && $_obf_0D22231B233B2234020E5C103C342D021B16333F1C0D22[$slotSettings->SymbolGame[$j]][2] > 0 ) 
                            {
                                for( $_obf_0D1B2F243C24082A1D3D0A072A1E0722231E14291D3511 = 0; $_obf_0D1B2F243C24082A1D3D0A072A1E0722231E14291D3511 < 3; $_obf_0D1B2F243C24082A1D3D0A072A1E0722231E14291D3511++ ) 
                                {
                                    if( $_obf_0D301A050D36301F15050F38140B0731150A0D1F0D0C11[0][$_obf_0D1B2F243C24082A1D3D0A072A1E0722231E14291D3511] == '' ) 
                                    {
                                    }
                                    else
                                    {
                                        for( $_obf_0D1B4035342B293C24175C3D13172E0A1A3C311C301E11 = 0; $_obf_0D1B4035342B293C24175C3D13172E0A1A3C311C301E11 < 3; $_obf_0D1B4035342B293C24175C3D13172E0A1A3C311C301E11++ ) 
                                        {
                                            if( $_obf_0D301A050D36301F15050F38140B0731150A0D1F0D0C11[1][$_obf_0D1B4035342B293C24175C3D13172E0A1A3C311C301E11] == '' ) 
                                            {
                                            }
                                            else
                                            {
                                                for( $_obf_0D113E342F143803011A1C1A14132A0E3126041B040732 = 0; $_obf_0D113E342F143803011A1C1A14132A0E3126041B040732 < 3; $_obf_0D113E342F143803011A1C1A14132A0E3126041B040732++ ) 
                                                {
                                                    if( $_obf_0D301A050D36301F15050F38140B0731150A0D1F0D0C11[2][$_obf_0D113E342F143803011A1C1A14132A0E3126041B040732] == '' ) 
                                                    {
                                                    }
                                                    else
                                                    {
                                                        $s1 = $reels['reel1'][$_obf_0D1B2F243C24082A1D3D0A072A1E0722231E14291D3511];
                                                        $s2 = $reels['reel2'][$_obf_0D1B4035342B293C24175C3D13172E0A1A3C311C301E11];
                                                        $s3 = $reels['reel3'][$_obf_0D113E342F143803011A1C1A14132A0E3126041B040732];
                                                        if( $s1 == $wild && $s2 == $wild && $s3 == $wild ) 
                                                        {
                                                            $s1 = 'P_1';
                                                            $s2 = 'P_1';
                                                            $s3 = 'P_1';
                                                        }
                                                        else if( $s1 == $wild || $s2 == $wild || $s3 == $wild ) 
                                                        {
                                                            $_obf_0D1E4033253C1240302E1B0117032B295C0A1619165B22 = '';
                                                            for( $w = 1; $w <= 3; $w++ ) 
                                                            {
                                                                if( ${'s' . $w} != $wild ) 
                                                                {
                                                                    $_obf_0D1E4033253C1240302E1B0117032B295C0A1619165B22 = ${'s' . $w};
                                                                }
                                                            }
                                                            for( $w = 1; $w <= 3; $w++ ) 
                                                            {
                                                                if( ${'s' . $w} == $wild ) 
                                                                {
                                                                    ${'s' . $w} = $_obf_0D1E4033253C1240302E1B0117032B295C0A1619165B22 . '_WILD';
                                                                }
                                                            }
                                                        }
                                                        $_obf_0D0E141F34210C271834013D060623402816092A400E11 = $slotSettings->Paytable[$slotSettings->SymbolGame[$j]][3] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'];
                                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":3,"Line":1,"Win":' . $_obf_0D0E141F34210C271834013D060623402816092A400E11 . ',"stepWin":' . ($_obf_0D0E141F34210C271834013D060623402816092A400E11 + $totalWin) . ',"winReel1":[' . $_obf_0D1B2F243C24082A1D3D0A072A1E0722231E14291D3511 . ',"' . $s1 . '"],"winReel2":[' . $_obf_0D1B4035342B293C24175C3D13172E0A1A3C311C301E11 . ',"' . $s2 . '"],"winReel3":[' . $_obf_0D113E342F143803011A1C1A14132A0E3126041B040732 . ',"' . $s3 . '"],"winReel4":["none","none"],"winReel5":["none","none"]}';
                                                        if( $_obf_0D0E141F34210C271834013D060623402816092A400E11 > 0 && $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 != '' ) 
                                                        {
                                                            array_push($lineWins, $_obf_0D0207283039073919263232090A382F3D26101F0D1E11);
                                                            $totalWin += $_obf_0D0E141F34210C271834013D060623402816092A400E11;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $scattersWin = 0;
                    $scattersStr = '{';
                    $scattersCount = 0;
                    $_obf_0D3D272C173E0D121230303614122810363C1028141911 = 0;
                    $_obf_0D143405240433353C1A013319070C0C250C3730091522 = [
                        false, 
                        false, 
                        false, 
                        false
                    ];
                    for( $r = 1; $r <= 3; $r++ ) 
                    {
                        for( $p = 0; $p <= 3; $p++ ) 
                        {
                            if( $reels['reel' . $r][$p] == $scatter ) 
                            {
                                $_obf_0D143405240433353C1A013319070C0C250C3730091522[$r] = true;
                            }
                        }
                    }
                    for( $r = 1; $r <= 3; $r++ ) 
                    {
                        for( $p = 0; $p <= 3; $p++ ) 
                        {
                            if( $reels['reel' . $r][$p] == $scatter || $reels['reel' . $r][$p] == $wild && !$_obf_0D143405240433353C1A013319070C0C250C3730091522[$r] ) 
                            {
                                $_obf_0D2A082405130D152F3C320E082D140740392F255C3E22 = $reels['reel' . $r][$p];
                                if( $reels['reel' . $r][$p] == $wild ) 
                                {
                                    $_obf_0D3D272C173E0D121230303614122810363C1028141911++;
                                    $_obf_0D2A082405130D152F3C320E082D140740392F255C3E22 = $_obf_0D2A082405130D152F3C320E082D140740392F255C3E22 . '_WILD';
                                }
                                if( $_obf_0D3D272C173E0D121230303614122810363C1028141911 < 3 ) 
                                {
                                    $scattersCount++;
                                }
                                $scattersStr .= ('"winReel' . $r . '":[' . $p . ',"' . $reels['reel' . $r][$p] . '"],');
                            }
                        }
                    }
                    $scattersWin = 0;
                    $_obf_0D3F23371F1A380A1D141E21145B31341504250D093422 = [];
                    $_obf_0D261E2D401B093C2E170F0A393D1C135C2630373C2C11 = 0;
                    $_obf_0D3B351A3112321B2D35213C0717220E0B2C3108381122 = 0;
                    if( $scattersCount >= 3 && $slotSettings->slotBonus ) 
                    {
                        $_obf_0D09222D1801313E12342A04352B0F1C1902403B173132 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'];
                        $_obf_0D3F23371F1A380A1D141E21145B31341504250D093422 = [
                            25 * $_obf_0D09222D1801313E12342A04352B0F1C1902403B173132, 
                            40 * $_obf_0D09222D1801313E12342A04352B0F1C1902403B173132, 
                            55 * $_obf_0D09222D1801313E12342A04352B0F1C1902403B173132, 
                            70 * $_obf_0D09222D1801313E12342A04352B0F1C1902403B173132, 
                            85 * $_obf_0D09222D1801313E12342A04352B0F1C1902403B173132, 
                            100 * $_obf_0D09222D1801313E12342A04352B0F1C1902403B173132
                        ];
                        $_obf_0D261E2D401B093C2E170F0A393D1C135C2630373C2C11 = rand(0, 5);
                        $_obf_0D3B351A3112321B2D35213C0717220E0B2C3108381122 = $_obf_0D3F23371F1A380A1D141E21145B31341504250D093422[$_obf_0D261E2D401B093C2E170F0A393D1C135C2630373C2C11] * $_obf_0D09222D1801313E12342A04352B0F1C1902403B173132;
                        $scattersStr .= '"scattersType":"bonus",';
                    }
                    else if( $scattersWin > 0 ) 
                    {
                        $scattersStr .= '"scattersType":"win",';
                    }
                    else
                    {
                        $scattersStr .= '"scattersType":"none",';
                    }
                    $scattersStr .= ('"scattersWin":' . $scattersWin . '}');
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
                        else if( $totalWin + $_obf_0D3B351A3112321B2D35213C0717220E0B2C3108381122 <= $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 && $winType == 'bonus' ) 
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
                        else if( $totalWin + $_obf_0D3B351A3112321B2D35213C0717220E0B2C3108381122 > 0 && $totalWin + $_obf_0D3B351A3112321B2D35213C0717220E0B2C3108381122 <= $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 && $winType == 'win' ) 
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
                        else if( $totalWin + $_obf_0D3B351A3112321B2D35213C0717220E0B2C3108381122 == 0 && $winType == 'none' ) 
                        {
                            break;
                        }
                    }
                }
                if( $totalWin + $_obf_0D3B351A3112321B2D35213C0717220E0B2C3108381122 > 0 ) 
                {
                    $slotSettings->SetBalance($totalWin + $_obf_0D3B351A3112321B2D35213C0717220E0B2C3108381122);
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * ($totalWin + $_obf_0D3B351A3112321B2D35213C0717220E0B2C3108381122));
                }
                $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                $slotSettings->SetGameData('Magic27GTTotalWin', $totalWin + $_obf_0D3B351A3112321B2D35213C0717220E0B2C3108381122);
                $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $lineWins);
                $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"slotLines":' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'] . ',"slotBet":' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'] . ',"mysteryWinCredit":' . $_obf_0D3B351A3112321B2D35213C0717220E0B2C3108381122 . ',"mysteryWin":' . $_obf_0D261E2D401B093C2E170F0A393D1C135C2630373C2C11 . ',"mysteryWins":[' . implode(',', $_obf_0D3F23371F1A380A1D141E21145B31341504250D093422) . '],"totalFreeGames":' . $slotSettings->GetGameData('Magic27GTFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('Magic27GTCurrentFreeGame') . ',"Balance":' . $Balance . ',"afterBalance":' . $slotSettings->GetBalance() . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"bonusInfo":' . $scattersStr . ',"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                $slotSettings->SaveLogReport($response, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotBet'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotLines'], $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
            }
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
