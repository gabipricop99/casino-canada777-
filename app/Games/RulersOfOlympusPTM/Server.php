<?php 
namespace VanguardLTE\Games\RulersOfOlympusPTM
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
            if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['umid']) ) 
            {
                $umid = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['umid'];
                if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID']) && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'] == 40041 ) 
                {
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"jackpotUpdates":{"mrj":[{"coinSize":400,"jackpot":' . ($slotSettings->slotJackpot[3] * 100) . '},{"coinSize":300,"jackpot":' . ($slotSettings->slotJackpot[2] * 100) . '},{"coinSize":200,"jackpot":' . ($slotSettings->slotJackpot[1] * 100) . '},{"coinSize":100,"jackpot":' . ($slotSettings->slotJackpot[0] * 100) . '}]}},"ID":40042,"umid":10}';
                }
                else if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID']) ) 
                {
                    $umid = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID'];
                }
            }
            else
            {
                if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['ID']) ) 
                {
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"ID":18}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"jackpotUpdates":{"mrj":[{"coinSize":400,"jackpot":' . ($slotSettings->slotJackpot[3] * 100) . '},{"coinSize":300,"jackpot":' . ($slotSettings->slotJackpot[2] * 100) . '},{"coinSize":200,"jackpot":' . ($slotSettings->slotJackpot[1] * 100) . '},{"coinSize":100,"jackpot":' . ($slotSettings->slotJackpot[0] * 100) . '}]}},"ID":40042,"umid":10}';
                }
                $umid = 0;
            }
            if( isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType']) ) 
            {
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] == 'regular' ) 
                {
                    $umid = '0';
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    $bonusMpl = 1;
                    $slotSettings->SetGameData('RulersOfOlympusPTMBonusWin', 0);
                    $slotSettings->SetGameData('RulersOfOlympusPTMFreeGames', 0);
                    $slotSettings->SetGameData('RulersOfOlympusPTMCurrentFreeGame', 0);
                    $slotSettings->SetGameData('RulersOfOlympusPTMTotalWin', 0);
                    $slotSettings->SetGameData('RulersOfOlympusPTMFreeBalance', 0);
                    $slotSettings->SetGameData('RulersOfOlympusPTMFreeStartWin', 0);
                    $slotSettings->SetGameData('RulersOfOlympusPTMBonusType', '');
                    $slotSettings->SetGameData('RulersOfOlympusPTMOlympusFreeWilds', []);
                }
                else if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] == 'free' ) 
                {
                    $umid = '0';
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                    $slotSettings->SetGameData('RulersOfOlympusPTMCurrentFreeGame', $slotSettings->GetGameData('RulersOfOlympusPTMCurrentFreeGame') + 1);
                    $slotSettings->SetGameData('RulersOfOlympusPTMIncreaseMpl', $slotSettings->GetGameData('RulersOfOlympusPTMIncreaseMpl') + 1);
                    $bonusMpl = 1;
                }
                $linesId = [];
                if( $slotSettings->GetGameData('RulersOfOlympusPTMBonusType') == 'olympus' ) 
                {
                    $linesId[0] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[1] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[2] = [
                        1, 
                        1, 
                        1, 
                        1, 
                        1
                    ];
                    $linesId[3] = [
                        4, 
                        4, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[4] = [
                        2, 
                        3, 
                        4, 
                        3, 
                        2
                    ];
                    $linesId[5] = [
                        3, 
                        2, 
                        1, 
                        2, 
                        3
                    ];
                    $linesId[6] = [
                        1, 
                        1, 
                        2, 
                        3, 
                        4
                    ];
                    $linesId[7] = [
                        4, 
                        4, 
                        3, 
                        2, 
                        1
                    ];
                    $linesId[8] = [
                        2, 
                        1, 
                        1, 
                        1, 
                        2
                    ];
                    $linesId[9] = [
                        3, 
                        4, 
                        4, 
                        4, 
                        3
                    ];
                    $linesId[10] = [
                        1, 
                        2, 
                        3, 
                        4, 
                        4
                    ];
                    $linesId[11] = [
                        4, 
                        3, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[12] = [
                        2, 
                        1, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[13] = [
                        3, 
                        4, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[14] = [
                        1, 
                        2, 
                        1, 
                        2, 
                        1
                    ];
                    $linesId[15] = [
                        4, 
                        3, 
                        4, 
                        3, 
                        4
                    ];
                    $linesId[16] = [
                        2, 
                        3, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[17] = [
                        3, 
                        2, 
                        3, 
                        4, 
                        2
                    ];
                    $linesId[18] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[19] = [
                        4, 
                        3, 
                        3, 
                        3, 
                        4
                    ];
                    $linesId[20] = [
                        2, 
                        2, 
                        3, 
                        4, 
                        4
                    ];
                    $linesId[21] = [
                        3, 
                        3, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[22] = [
                        2, 
                        2, 
                        1, 
                        2, 
                        2
                    ];
                    $linesId[23] = [
                        3, 
                        3, 
                        4, 
                        3, 
                        3
                    ];
                    $linesId[24] = [
                        2, 
                        3, 
                        3, 
                        3, 
                        4
                    ];
                    $linesId[25] = [
                        3, 
                        2, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[26] = [
                        1, 
                        1, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[27] = [
                        4, 
                        4, 
                        3, 
                        4, 
                        4
                    ];
                    $linesId[28] = [
                        1, 
                        2, 
                        3, 
                        3, 
                        4
                    ];
                    $linesId[29] = [
                        4, 
                        3, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[30] = [
                        1, 
                        1, 
                        1, 
                        2, 
                        3
                    ];
                    $linesId[31] = [
                        4, 
                        4, 
                        4, 
                        3, 
                        2
                    ];
                    $linesId[32] = [
                        2, 
                        1, 
                        1, 
                        2, 
                        3
                    ];
                    $linesId[33] = [
                        3, 
                        4, 
                        4, 
                        3, 
                        2
                    ];
                    $linesId[34] = [
                        1, 
                        2, 
                        2, 
                        3, 
                        4
                    ];
                    $linesId[35] = [
                        4, 
                        3, 
                        3, 
                        2, 
                        1
                    ];
                    $linesId[36] = [
                        2, 
                        1, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[37] = [
                        3, 
                        4, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[38] = [
                        1, 
                        2, 
                        3, 
                        4, 
                        3
                    ];
                    $linesId[39] = [
                        4, 
                        3, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[40] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        3
                    ];
                    $linesId[41] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[42] = [
                        1, 
                        2, 
                        3, 
                        2, 
                        1
                    ];
                    $linesId[43] = [
                        4, 
                        3, 
                        2, 
                        3, 
                        4
                    ];
                    $linesId[44] = [
                        1, 
                        1, 
                        1, 
                        1, 
                        2
                    ];
                    $linesId[45] = [
                        4, 
                        4, 
                        4, 
                        4, 
                        3
                    ];
                    $linesId[46] = [
                        1, 
                        1, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[47] = [
                        4, 
                        4, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[48] = [
                        2, 
                        2, 
                        1, 
                        1, 
                        1
                    ];
                    $linesId[49] = [
                        3, 
                        3, 
                        4, 
                        4, 
                        4
                    ];
                }
                else
                {
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
                        1, 
                        1, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[6] = [
                        3, 
                        3, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[7] = [
                        2, 
                        1, 
                        1, 
                        1, 
                        2
                    ];
                    $linesId[8] = [
                        2, 
                        3, 
                        3, 
                        3, 
                        2
                    ];
                    $linesId[9] = [
                        2, 
                        1, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[10] = [
                        2, 
                        3, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[11] = [
                        1, 
                        2, 
                        1, 
                        2, 
                        1
                    ];
                    $linesId[12] = [
                        3, 
                        2, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[13] = [
                        2, 
                        2, 
                        1, 
                        2, 
                        2
                    ];
                    $linesId[14] = [
                        2, 
                        2, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[15] = [
                        1, 
                        2, 
                        2, 
                        2, 
                        1
                    ];
                    $linesId[16] = [
                        3, 
                        2, 
                        2, 
                        2, 
                        3
                    ];
                    $linesId[17] = [
                        1, 
                        3, 
                        1, 
                        3, 
                        1
                    ];
                    $linesId[18] = [
                        3, 
                        1, 
                        3, 
                        1, 
                        3
                    ];
                    $linesId[19] = [
                        3, 
                        3, 
                        1, 
                        3, 
                        3
                    ];
                    $linesId[20] = [
                        1, 
                        1, 
                        3, 
                        1, 
                        1
                    ];
                    $linesId[21] = [
                        1, 
                        3, 
                        3, 
                        3, 
                        1
                    ];
                    $linesId[22] = [
                        3, 
                        1, 
                        1, 
                        1, 
                        3
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
                }
                $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] / 100;
                for( $i = 0; $i < count($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['lines']); $i++ ) 
                {
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['lines'][$i] > 0 ) 
                    {
                        $lines = $i + 1;
                    }
                    else
                    {
                        break;
                    }
                }
                $betLine = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] / 25;
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'bet' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'respin' ) 
                {
                    if( $lines <= 0 || $betLine <= 0.0001 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid bet state"}';
                        exit( $response );
                    }
                    if( $slotSettings->GetBalance() < ($lines * $betLine) ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid balance"}';
                        exit( $response );
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') < $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"invalid bonus state"}';
                        exit( $response );
                    }
                }
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                {
                    if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    }
                    $slotSettings->SetBalance(-1 * $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] / 100 * $slotSettings->GetPercent();
                    $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D262A401E2428360E103910312E0E2A2D04280B345B11 = $slotSettings->UpdateJackpots($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet']);
                    $slotSettings->SetGameData($slotSettings->slotId . 'JackWinID', $_obf_0D262A401E2428360E103910312E0E2A2D04280B345B11['isJackId']);
                }
                $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'], $lines);
                $winType = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[0];
                $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[1];
                if( isset($_obf_0D262A401E2428360E103910312E0E2A2D04280B345B11) && $_obf_0D262A401E2428360E103910312E0E2A2D04280B345B11['isJackPay'] ) 
                {
                    $_obf_0D02241D2C2A085C253B1B1137140C2E37242C38121D32 = 1;
                    $winType = 'bonus';
                }
                else
                {
                    $_obf_0D02241D2C2A085C253B1B1137140C2E37242C38121D32 = 0;
                }
                $_obf_0D13130B0E39142D0E3F1F193D1B2227112531260A1E01 = '';
                if( $_obf_0D02241D2C2A085C253B1B1137140C2E37242C38121D32 == 1 && $winType == 'bonus' ) 
                {
                    $_obf_0D13130B0E39142D0E3F1F193D1B2227112531260A1E01 = 'bonus2';
                    $winType = 'none';
                }
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $totalWin = 0;
                    $lineWins = [];
                    $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11 = [
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
                    $_obf_0D3F04271B051D32160C2A2413012B090110320A331E11 = $slotSettings->GetGameData('RulersOfOlympusPTMShiftingWilds');
                    $wild = [
                        '22', 
                        '23', 
                        '19'
                    ];
                    $scatter = '26';
                    $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $slotSettings->GetGameData('RulersOfOlympusPTMBonusType'));
                    $_obf_0D0C353C231930293E1C32222A282208283E03311D0C01 = $reels;
                    $isBonusStart = false;
                    $_obf_0D35071815173013080A0C282D07323C1C110D02143911 = 0;
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' && $slotSettings->GetGameData('RulersOfOlympusPTMBonusType') == 'olympus' ) 
                    {
                        $_obf_0D35071815173013080A0C282D07323C1C110D02143911 = 12;
                        $_obf_0D241B2516103E01062C1C130C3B3B1215352E15192C22 = $slotSettings->GetGameData('RulersOfOlympusPTMOlympusFreeWilds');
                        $_obf_0D322B1E350C21080616182E065B1838380A0832183C01 = 0;
                        for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 3; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                        {
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                if( $_obf_0D241B2516103E01062C1C130C3B3B1215352E15192C22[$_obf_0D322B1E350C21080616182E065B1838380A0832183C01] == 1 ) 
                                {
                                    $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = 19;
                                }
                                $_obf_0D322B1E350C21080616182E065B1838380A0832183C01++;
                            }
                        }
                    }
                    if( $slotSettings->GetGameData('RulersOfOlympusPTMBonusType') != 'olympus' ) 
                    {
                        for( $_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01 = 0; $_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01 < count($_obf_0D3F04271B051D32160C2A2413012B090110320A331E11); $_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01++ ) 
                        {
                            $_obf_0D342A0C36271E1B1A1240140D2111220D171E1D170A11 = $_obf_0D3F04271B051D32160C2A2413012B090110320A331E11[$_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01];
                            if( $_obf_0D342A0C36271E1B1A1240140D2111220D171E1D170A11[2] == '23' ) 
                            {
                                $_obf_0D3F04271B051D32160C2A2413012B090110320A331E11[$_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01][0]--;
                            }
                            else if( $_obf_0D342A0C36271E1B1A1240140D2111220D171E1D170A11[2] == '22' ) 
                            {
                                $_obf_0D3F04271B051D32160C2A2413012B090110320A331E11[$_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01][0]++;
                            }
                            $_obf_0D342A0C36271E1B1A1240140D2111220D171E1D170A11 = $_obf_0D3F04271B051D32160C2A2413012B090110320A331E11[$_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01];
                            if( $_obf_0D3F04271B051D32160C2A2413012B090110320A331E11[$_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01][0] < 1 || $_obf_0D3F04271B051D32160C2A2413012B090110320A331E11[$_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01][0] > 5 ) 
                            {
                                unset($_obf_0D3F04271B051D32160C2A2413012B090110320A331E11[$_obf_0D31151A0E335C2508332E0524283F012C1927132D5B01]);
                            }
                            else
                            {
                                $reels['reel' . $_obf_0D342A0C36271E1B1A1240140D2111220D171E1D170A11[0]][$_obf_0D342A0C36271E1B1A1240140D2111220D171E1D170A11[1]] = $_obf_0D342A0C36271E1B1A1240140D2111220D171E1D170A11[2];
                            }
                        }
                        $_obf_0D3F04271B051D32160C2A2413012B090110320A331E11 = array_values($_obf_0D3F04271B051D32160C2A2413012B090110320A331E11);
                        $_obf_0D05353612242A29071A1511241210092E05370F120501 = false;
                        for( $r = 1; $r <= 5; $r++ ) 
                        {
                            for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 2; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                            {
                                if( rand(1, 100) == 1 && $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] != '22' && $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] != '23' && $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] != '26' && count($_obf_0D3F04271B051D32160C2A2413012B090110320A331E11) < 4 ) 
                                {
                                    $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] = $wild[rand(0, 1)];
                                    $_obf_0D3F04271B051D32160C2A2413012B090110320A331E11[] = [
                                        $r, 
                                        $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32, 
                                        $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32]
                                    ];
                                    $_obf_0D05353612242A29071A1511241210092E05370F120501 = false;
                                    break;
                                }
                                if( $_obf_0D05353612242A29071A1511241210092E05370F120501 ) 
                                {
                                    break;
                                }
                            }
                        }
                    }
                    for( $k = 0; $k < $lines; $k++ ) 
                    {
                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '';
                        for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                        {
                            $_obf_0D011C142C3C37263F351C4012170A074027083F321132 = $slotSettings->SymbolGame[$j];
                            if( $_obf_0D011C142C3C37263F351C4012170A074027083F321132 == $scatter || !isset($slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132]) ) 
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
                                    $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][1] * $betLine * $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 * $bonusMpl;
                                    if( $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":1,"Line":' . $k . ',"Win":' . $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] . ',"stepWin":' . ($_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] + $totalWin + $slotSettings->GetGameData('RulersOfOlympusPTMBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":["none","none"],"winReel3":["none","none"],"winReel4":["none","none"],"winReel5":["none","none"]}';
                                    }
                                }
                                if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) ) 
                                {
                                    $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                    if( in_array($s[0], $wild) && in_array($s[1], $wild) ) 
                                    {
                                        $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                    }
                                    else if( in_array($s[0], $wild) || in_array($s[1], $wild) ) 
                                    {
                                        $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = $slotSettings->slotWildMpl;
                                    }
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][2] * $betLine * $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 * $bonusMpl;
                                    if( $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":2,"Line":' . $k . ',"Win":' . $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] . ',"stepWin":' . ($_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] + $totalWin + $slotSettings->GetGameData('RulersOfOlympusPTMBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":[' . ($linesId[$k][1] - 1) . ',"' . $s[1] . '"],"winReel3":["none","none"],"winReel4":["none","none"],"winReel5":["none","none"]}';
                                    }
                                }
                                if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) ) 
                                {
                                    $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                    if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) ) 
                                    {
                                        $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                    }
                                    else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) ) 
                                    {
                                        $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = $slotSettings->slotWildMpl;
                                    }
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $betLine * $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 * $bonusMpl;
                                    if( $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":3,"Line":' . $k . ',"Win":' . $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] . ',"stepWin":' . ($_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] + $totalWin + $slotSettings->GetGameData('RulersOfOlympusPTMBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":[' . ($linesId[$k][1] - 1) . ',"' . $s[1] . '"],"winReel3":[' . ($linesId[$k][2] - 1) . ',"' . $s[2] . '"],"winReel4":["none","none"],"winReel5":["none","none"]}';
                                    }
                                }
                                if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) && ($s[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[3], $wild)) ) 
                                {
                                    $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                    if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) && in_array($s[3], $wild) ) 
                                    {
                                        $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                    }
                                    else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) || in_array($s[3], $wild) ) 
                                    {
                                        $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = $slotSettings->slotWildMpl;
                                    }
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $betLine * $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 * $bonusMpl;
                                    if( $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":4,"Line":' . $k . ',"Win":' . $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] . ',"stepWin":' . ($_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] + $totalWin + $slotSettings->GetGameData('RulersOfOlympusPTMBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":[' . ($linesId[$k][1] - 1) . ',"' . $s[1] . '"],"winReel3":[' . ($linesId[$k][2] - 1) . ',"' . $s[2] . '"],"winReel4":[' . ($linesId[$k][3] - 1) . ',"' . $s[3] . '"],"winReel5":["none","none"]}';
                                    }
                                }
                                if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) && ($s[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[3], $wild)) && ($s[4] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[4], $wild)) ) 
                                {
                                    $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                    if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) && in_array($s[3], $wild) && in_array($s[4], $wild) ) 
                                    {
                                        $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = 1;
                                    }
                                    else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) || in_array($s[3], $wild) || in_array($s[4], $wild) ) 
                                    {
                                        $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 = $slotSettings->slotWildMpl;
                                    }
                                    $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $betLine * $_obf_0D1016073B15193E060D2D0C262328020129171D232A32 * $bonusMpl;
                                    if( $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                    {
                                        $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                        $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{"Count":5,"Line":' . $k . ',"Win":' . $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] . ',"stepWin":' . ($_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] + $totalWin + $slotSettings->GetGameData('RulersOfOlympusPTMBonusWin')) . ',"winReel1":[' . ($linesId[$k][0] - 1) . ',"' . $s[0] . '"],"winReel2":[' . ($linesId[$k][1] - 1) . ',"' . $s[1] . '"],"winReel3":[' . ($linesId[$k][2] - 1) . ',"' . $s[2] . '"],"winReel4":[' . ($linesId[$k][3] - 1) . ',"' . $s[3] . '"],"winReel5":[' . ($linesId[$k][4] - 1) . ',"' . $s[4] . '"]}';
                                    }
                                }
                            }
                        }
                        if( $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k] > 0 && $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 != '' ) 
                        {
                            array_push($lineWins, $_obf_0D0207283039073919263232090A382F3D26101F0D1E11);
                            $totalWin += $_obf_0D1F171A1F35063716213837072F111B1E0D042E1B1A11[$k];
                        }
                    }
                    $scattersWin = 0;
                    $scattersStr = '{';
                    $scattersCount = 0;
                    for( $r = 1; $r <= 5; $r++ ) 
                    {
                        for( $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 = 0; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 <= 3; $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32++ ) 
                        {
                            if( $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == $scatter || $reels['reel' . $r][$_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32] == '21' ) 
                            {
                                $scattersCount++;
                                $scattersStr .= ('"winReel' . $r . '":[' . $_obf_0D13090C3F3C3624123E1A2C091F31232304270B023B32 . ',"' . $scatter . '"],');
                            }
                        }
                    }
                    $scattersWin = 0;
                    if( $scattersCount >= 1 && $slotSettings->slotBonus ) 
                    {
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
                    $totalWin += $scattersWin;
                    if( $i > 1000 ) 
                    {
                        $winType = 'none';
                    }
                    if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] * rand(2, 5)) ) 
                    {
                    }
                    else if( !$slotSettings->increaseRTP && $winType == 'win' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] < $totalWin ) 
                    {
                    }
                    else
                    {
                        if( $i > 1500 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                            exit( $response );
                        }
                        if( $scattersCount >= 1 && ($winType != 'bonus' || $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin') ) 
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
                    $slotSettings->SetGameData('RulersOfOlympusPTMBonusWin', $slotSettings->GetGameData('RulersOfOlympusPTMBonusWin') + $totalWin);
                    $slotSettings->SetGameData('RulersOfOlympusPTMTotalWin', $totalWin);
                }
                else
                {
                    $slotSettings->SetGameData('RulersOfOlympusPTMTotalWin', $totalWin);
                }
                $slotSettings->SetGameData('RulersOfOlympusPTMBonusStart', false);
                $_obf_0D5B3213010C3628041C29342A332F281A142929085C11 = '';
                if( $scattersCount >= 1 ) 
                {
                    $slotSettings->SetGameData('RulersOfOlympusPTMFreeGames', $slotSettings->slotFreeCount);
                    $slotSettings->SetGameData('RulersOfOlympusPTMFreeStartWin', $totalWin);
                    $slotSettings->SetGameData('RulersOfOlympusPTMBonusWin', 0);
                    $slotSettings->SetGameData('RulersOfOlympusPTMBonusType', 'olympus');
                    $_obf_0D0C0213291D021D051D381B195B0D2B1B34080B212822 = [
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
                    $_obf_0D2C17022122290C3822262A364038232E1C0B30180522 = rand(1, 2);
                    for( $i = 0; $i <= $_obf_0D2C17022122290C3822262A364038232E1C0B30180522; $i++ ) 
                    {
                        $_obf_0D0C0213291D021D051D381B195B0D2B1B34080B212822[rand(0, 19)] = 1;
                    }
                    $_obf_0D5B3213010C3628041C29342A332F281A142929085C11 = ',"wildsPattern":[' . implode(',', $_obf_0D0C0213291D021D051D381B195B0D2B1B34080B212822) . ']';
                    $slotSettings->SetGameData('RulersOfOlympusPTMOlympusFreeWilds', $_obf_0D0C0213291D021D051D381B195B0D2B1B34080B212822);
                }
                $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                $_obf_0D2C3832163F282A5C100B120D1405400B1F0A131C1201 = 'REGULAR';
                if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['spinType'] == 'free' ) 
                {
                    $_obf_0D2C3832163F282A5C100B120D1405400B1F0A131C1201 = 'FREE';
                }
                $_obf_0D5C39151E192A0D0C273E041A211E31150B2201231D01 = 'false';
                if( $slotSettings->GetGameData('RulersOfOlympusPTMBonusStart') ) 
                {
                    $_obf_0D5C39151E192A0D0C273E041A211E31150B2201231D01 = 'true';
                }
                $slotSettings->SetGameData('RulersOfOlympusPTMShiftingWilds', $_obf_0D3F04271B051D32160C2A2413012B090110320A331E11);
                $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $lineWins);
                $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"OlympusFreeWilds":' . json_encode($slotSettings->GetGameData('RulersOfOlympusPTMOlympusFreeWilds')) . ',"BonusType":"' . $slotSettings->GetGameData('RulersOfOlympusPTMBonusType') . '","linesArr":[' . implode(',', $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['lines']) . '],"slotLines":' . $lines . ',"slotBet":' . $betLine . ',"totalFreeGames":' . $slotSettings->GetGameData('RulersOfOlympusPTMFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('RulersOfOlympusPTMCurrentFreeGame') . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData('RulersOfOlympusPTMBonusWin') . ',"freeStartWin":' . $slotSettings->GetGameData('RulersOfOlympusPTMFreeStartWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"bonusInfo":' . $scattersStr . ',"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                $slotSettings->SaveLogReport($response, $betLine, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                $rSym = $reels['reel1'][0] . ',' . $reels['reel2'][0] . ',' . $reels['reel3'][0] . ',' . $reels['reel4'][0] . ',' . $reels['reel5'][0] . ',';
                $rSym .= ($reels['reel1'][1] . ',' . $reels['reel2'][1] . ',' . $reels['reel3'][1] . ',' . $reels['reel4'][1] . ',' . $reels['reel5'][1] . ',');
                $rSym .= ($reels['reel1'][2] . ',' . $reels['reel2'][2] . ',' . $reels['reel3'][2] . ',' . $reels['reel4'][2] . ',' . $reels['reel5'][2]);
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"ww":' . $totalWin . ',"wt":' . json_encode($slotSettings->GetGameData('RulersOfOlympusPTMShiftingWilds')) . ',"balance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"results":[' . implode(',', $reels['rp']) . '],"spinType":"' . $_obf_0D2C3832163F282A5C100B120D1405400B1F0A131C1201 . '","symbols":[3,1,8,1,6,6,1,9,2,2,6,6,3,5],"windowId":"qkpJt6"},"ID":40022,"umid":36}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"reelSet":' . $_obf_0D35071815173013080A0C282D07323C1C110D02143911 . ',"display":[' . $rSym . ']' . $_obf_0D5B3213010C3628041C29342A332F281A142929085C11 . ',"windowId":"NXY2mU"},"ID":49301,"umid":71}';
                $slotSettings->SetGameData('RulersOfOlympusPTMreelSetIndex', $_obf_0D35071815173013080A0C282D07323C1C110D02143911);
                $slotSettings->SetGameData('RulersOfOlympusPTMresults', $reels['rp']);
                $slotSettings->SetGameData('RulersOfOlympusPTMrSym', $rSym);
                if( $_obf_0D13130B0E39142D0E3F1F193D1B2227112531260A1E01 == 'bonus2' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                {
                    $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622 = [
                        1, 
                        1, 
                        1, 
                        1, 
                        1, 
                        2, 
                        2, 
                        2, 
                        2, 
                        2, 
                        3, 
                        3, 
                        3, 
                        3, 
                        3, 
                        4, 
                        4, 
                        4, 
                        4, 
                        4
                    ];
                    $_obf_0D130B26400A371321033126022F0C1722252E24131B22 = [
                        0, 
                        0, 
                        0, 
                        0, 
                        0
                    ];
                    $jid = 0;
                    $JackWinID = $slotSettings->GetGameData($slotSettings->slotId . 'JackWinID') + 1;
                    shuffle($_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622);
                    for( $i = 0; $i < 20; $i++ ) 
                    {
                        if( $_obf_0D130B26400A371321033126022F0C1722252E24131B22[$_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622[$i]] == 2 ) 
                        {
                            $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622[$i] = $JackWinID;
                        }
                        $_obf_0D130B26400A371321033126022F0C1722252E24131B22[$_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622[$i]]++;
                        if( $_obf_0D130B26400A371321033126022F0C1722252E24131B22[$_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622[$i]] >= 3 ) 
                        {
                            $jid = $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622[$i];
                            break;
                        }
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"jackpotUpdates":{"mrj":[{"coinSize":400,"jackpot":' . ($slotSettings->slotJackpot[3] * 100) . '},{"coinSize":300,"jackpot":' . ($slotSettings->slotJackpot[2] * 100) . '},{"coinSize":200,"jackpot":' . ($slotSettings->slotJackpot[1] * 100) . '},{"coinSize":100,"jackpot":' . ($slotSettings->slotJackpot[0] * 100) . '}]}},"ID":40042,"umid":60}';
                    $slotSettings->SetBalance($slotSettings->slotJackpot[$jid - 1]);
                    $_obf_0D39160B0D33353B062C3507331D40271C01101D1E2B01 = $slotSettings->slotJackpot[$jid - 1] * 100;
                    $_obf_0D2F362210232735111D2E28162E08075B05221C071011 = $slotSettings->slotJackpot[$jid - 1];
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"startTime":1,"winningLevel":' . $jid . ',"totalWin":' . $_obf_0D39160B0D33353B062C3507331D40271C01101D1E2B01 . ',"reelInfo":[' . implode(',', $_obf_0D3C1B030139220A3D23373C5B21240710300D2B5C2622) . '],"windowId":"33zr6v"},"ID":40071,"umid":40}';
                    $slotSettings->SaveLogReport($response, $betLine, $lines, $_obf_0D2F362210232735111D2E28162E08075B05221C071011, 'JPG');
                }
                else
                {
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"jackpotUpdates":{"mrj":[{"coinSize":400,"jackpot":' . ($slotSettings->slotJackpot[3] * 100) . '},{"coinSize":300,"jackpot":' . ($slotSettings->slotJackpot[2] * 100) . '},{"coinSize":200,"jackpot":' . ($slotSettings->slotJackpot[1] * 100) . '},{"coinSize":100,"jackpot":' . ($slotSettings->slotJackpot[0] * 100) . '}]}},"ID":40042,"umid":60}';
                }
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"windowId":"Hr1cOy"},"ID":40072,"umid":44}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":1},"ID":40085}';
                $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"balanceInfo":{"clientType":"casino","totalBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"currency":"' . $slotSettings->slotCurrency . '","balanceChange":0},"ID":10006,"umid":45}';
                $response = implode('------', $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01);
                $slotSettings->SaveGameData();
                \DB::commit();
                return $response;
            }
            switch( $umid ) 
            {
                case '31031':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"urlList":[{"urlType":"mobile_login","url":"https://login.loc/register","priority":1},{"urlType":"mobile_support","url":"https://ww2.loc/support","priority":1},{"urlType":"playerprofile","url":"","priority":1},{"urlType":"playerprofile","url":"","priority":10},{"urlType":"gambling_commission","url":"","priority":1},{"urlType":"cashier","url":"","priority":1},{"urlType":"cashier","url":"","priority":1}]},"ID":100}';
                    break;
                case '10001':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40083,"umid":3}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40083,"umid":4}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"commandId":13218,"params":["0","null"]},"ID":50001,"umid":5}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"token":{"secretKey":"","currency":"USD","balance":0,"loginTime":""},"ID":10002,"umid":7}';
                    break;
                case '40294':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"nicknameInfo":{"nickname":""},"ID":10022,"umid":8}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"commandId":10713,"params":["0","ba","bj","ct","gc","grel","hb","po","ro","sc","tr"]},"ID":50001,"umid":9}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"jackpotUpdates":{"mrj":[{"coinSize":400,"jackpot":' . ($slotSettings->slotJackpot[3] * 100) . '},{"coinSize":300,"jackpot":' . ($slotSettings->slotJackpot[2] * 100) . '},{"coinSize":200,"jackpot":' . ($slotSettings->slotJackpot[1] * 100) . '},{"coinSize":100,"jackpot":' . ($slotSettings->slotJackpot[0] * 100) . '}]}},"ID":40042,"umid":10}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"commandId":11666,"params":["0","0","0"]},"ID":50001,"umid":11}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"commandId":13981,"params":["0","1"]},"ID":50001,"umid":12}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"commandId":14080,"params":["0","0"]},"ID":50001,"umid":14}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"keyValueCount":5,"elementsPerKey":1,"params":["10","1","11","500","12","1","13","0","14","0"]},"ID":40716,"umid":15}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40083,"umid":16}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"balanceInfo":{"clientType":"casino","totalBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"currency":"' . $slotSettings->slotCurrency . '","balanceChange":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '},"ID":10006,"umid":17}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{},"ID":40292,"umid":18}';
                    break;
                case '10010':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"urls":{"casino-cashier-myaccount":[],"regulation_pt_self_exclusion":[],"link_legal_aams":[],"regulation_pt_player_protection":[],"mobile_cashier":[],"mobile_bank":[],"mobile_bonus_terms":[],"mobile_help":[],"link_responsible":[],"cashier":[{"url":"","priority":1},{"url":"","priority":1}],"gambling_commission":[{"url":"","priority":1},{"url":"","priority":1}],"desktop_help":[],"chat_token":[],"mobile_login_error":[],"mobile_error":[],"mobile_login":[{"url":"","priority":1}],"playerprofile":[{"url":"","priority":1},{"url":"","priority":10}],"link_legal_half":[],"ngmdesktop_quick_deposit":[],"external_login_form":[],"mobile_main_promotions":[],"mobile_lobby":[],"mobile_promotion":[],{"url":"","priority":1},{"url":"","priority":10}],"mobile_withdraw":[],"mobile_funds_trans":[],"mobile_quick_deposit":[],"mobile_history":[],"mobile_deposit_limit":[],"minigames_help":[],"link_legal_18":[],"mobile_responsible":[],"mobile_share":[],"mobile_lobby_error":[],"mobile_mobile_comp_points":[],"mobile_support":[{"url":"","priority":1}],"mobile_chat":[],"mobile_logout":[],"mobile_deposit":[],"invite_friend":[]}},"ID":10011,"umid":19}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"brokenGames":[],"windowId":"SuJLru"},"ID":40037,"umid":20}';
                    break;
                case '40066':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = $slotSettings->Bet;
                    for( $i = 0; $i < count($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] = $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[$i] * 100;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"funNoticeGames":0,"funNoticePayouts":0,"gameGroup":"aogroo","minBet":0,"maxBet":0,"minPosBet":0,"maxPosBet":50000,"coinSizes":[' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . ']},"ID":40025,"umid":21}';
                    break;
                case '40036':
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    if( !$slotSettings->HasGameData('RulersOfOlympusPTMShiftingWilds') ) 
                    {
                        $slotSettings->SetGameData('RulersOfOlympusPTMShiftingWilds', []);
                    }
                    $lastEvent = $slotSettings->GetHistory();
                    $slotSettings->SetGameData($slotSettings->slotId . 'brokenGames', '');
                    if( $lastEvent != 'NULL' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $lastEvent->serverResponse->freeStartWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                        $slotSettings->SetGameData($slotSettings->slotId . 'LinesArr', $lastEvent->serverResponse->linesArr);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $lastEvent->serverResponse->slotBet);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusType', $lastEvent->serverResponse->BonusType);
                        $slotSettings->SetGameData($slotSettings->slotId . 'OlympusFreeWilds', $lastEvent->serverResponse->OlympusFreeWilds);
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'brokenGames', 'aogroo');
                        }
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"brokenGames":["' . $slotSettings->GetGameData($slotSettings->slotId . 'brokenGames') . '"],"windowId":"SuJLru"},"ID":40037,"umid":22}';
                    break;
                case '49149':
                    $_obf_0D35071815173013080A0C282D07323C1C110D02143911 = $slotSettings->GetGameData('RulersOfOlympusPTMreelSetIndex');
                    $reels = $slotSettings->GetGameData('RulersOfOlympusPTMresults');
                    $rSym = $slotSettings->GetGameData('RulersOfOlympusPTMrSym');
                    if( !is_array($reels) ) 
                    {
                        $reels = [
                            0, 
                            0, 
                            0, 
                            0, 
                            0
                        ];
                    }
                    if( strlen($rSym) <= 0 ) 
                    {
                        $rSym = '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0';
                    }
                    if( !is_numeric($_obf_0D35071815173013080A0C282D07323C1C110D02143911) ) 
                    {
                        $_obf_0D35071815173013080A0C282D07323C1C110D02143911 = 0;
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"bet":' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['bet'] . ',"walkersPositions":[' . $rSym . '],"reelset":8,"reelstops":[' . implode(',', $reels) . '],"windowId":"Uliwrq"},"ID":49152,"umid":32}';
                    break;
                case '40020':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":1,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"windowId":"SuJLru"},"ID":40026,"umid":28}';
                    break;
                case '40030':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":1,"balanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"deltaBalanceInCents":0},"ID":40085}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"credit":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"windowId":"SuJLru"},"ID":40026,"umid":28}';
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'brokenGames') != '' ) 
                    {
                        $_obf_0D0A100E222F353718313B181106313D102F393C3E1732 = '';
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'BonusType') == 'power' ) 
                        {
                            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"freeSpinsData":{"numFreeSpins":1,"coinsize":' . ($slotSettings->GetGameData($slotSettings->slotId . 'Bet') * 100) . ',"rows":[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],"gamewin":' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeStartWin') * 100) . ',"freespinwin":' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . ',"freespinTriggerReels":[21,6,21,0,28],"coins":1,"multiplier":1,"mode":0,"startBonus":1},"lpReelSet":8,"tgReelSet":8,"bonusType":"POWER_FREEGAMES","display":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"playedFG":0,"jackpotWin":0,"reelinfo":[21,6,21,0,28],"windowId":"DHaqVt"},"ID":49303,"umid":31}';
                        }
                        else
                        {
                            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"freeSpinsData":{"numFreeSpins":' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')) . ',"coinsize":' . ($slotSettings->GetGameData($slotSettings->slotId . 'Bet') * 100) . ',"rows":[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],"gamewin":' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeStartWin') * 100) . ',"freespinwin":' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . ',"freespinTriggerReels":[5,41,44,49,35],"coins":1,"multiplier":1,"mode":0,"startBonus":1},"lpReelSet":0,"tgReelSet":0,"bonusType":"OLYMPUS_FREEGAMES","wildsPattern":[' . implode(',', $slotSettings->GetGameData($slotSettings->slotId . 'OlympusFreeWilds')) . '],"jackpotWin":0,"reelinfo":[5,41,44,49,35],"windowId":"hWKwC2"},"ID":49303,"umid":29}';
                        }
                    }
                    break;
                case '48300':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"balanceInfo":{"clientType":"casino","totalBalance":' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . ',"currency":"' . $slotSettings->slotCurrency . '","balanceChange":0},"ID":10006,"umid":30}';
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[] = '3:::{"data":{"waitingLogins":[],"waitingAlerts":[],"waitingDialogs":[],"waitingDialogMessages":[],"waitingToasterMessages":[]},"ID":48301,"umid":31}';
                    break;
            }
            $response = implode('------', $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01);
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
