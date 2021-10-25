<?php 
namespace VanguardLTE\Games\VirtualRouletteEGT
{
    class SlotSettings
    {
        public $playerId = null;
        public $splitScreen = null;
        public $reelStrip1 = null;
        public $reelStrip2 = null;
        public $reelStrip3 = null;
        public $reelStrip4 = null;
        public $reelStrip5 = null;
        public $reelStrip6 = null;
        public $reelStripBonus1 = null;
        public $reelStripBonus2 = null;
        public $reelStripBonus3 = null;
        public $reelStripBonus4 = null;
        public $reelStripBonus5 = null;
        public $reelStripBonus6 = null;
        public $slotId = '';
        public $slotDBId = '';
        public $Line = null;
        public $scaleMode = null;
        public $numFloat = null;
        public $gameLine = null;
        public $Bet = null;
        public $isBonusStart = null;
        public $Balance = null;
        public $SymbolGame = null;
        public $GambleType = null;
        public $lastEvent = null;
        public $Jackpots = [];
        public $keyController = null;
        public $slotViewState = null;
        public $hideButtons = null;
        public $slotReelsConfig = null;
        public $slotFreeCount = null;
        public $slotFreeMpl = null;
        public $slotWildMpl = null;
        public $slotExitUrl = null;
        public $slotBonus = null;
        public $slotBonusType = null;
        public $slotScatterType = null;
        public $slotGamble = null;
        public $Paytable = [];
        public $slotSounds = [];
        public $jpgs = null;
        private $Bank = null;
        private $Percent = null;
        private $WinLine = null;
        private $WinGamble = null;
        private $Bonus = null;
        private $shop_id = null;
        public $licenseDK = null;
        public $currency = null;
        public $user = null;
        public $game = null;
        public $shop = null;
        public $credits = null;
        public function __construct($sid, $playerId, $credits = null)
        {/*
            /* if( config('LicenseDK.APL_INCLUDE_KEY_CONFIG') != 'wi9qydosuimsnls5zoe5q298evkhim0ughx1w16qybs2fhlcpn' ) 
            {
                return false;
            }
            if( md5_file(base_path() . '/config/LicenseDK.php') != '27f30d89977203af2f6822e48707425d' ) 
            {
                return false;
            }
            if( md5_file(base_path() . '/app/Lib/LicenseDK.php') != '22dde427cc10243ac0c7a3a625518e6f' ) 
            {
                return false;
            }
            $this->licenseDK = true;
            $checked = new \VanguardLTE\Lib\LicenseDK();
            $license_notifications_array = $checked->aplVerifyLicenseDK(null, 0);
            if( $license_notifications_array['notification_case'] != 'notification_license_ok' ) 
            {
                $this->licenseDK = false;
            }*/
            $this->slotId = $sid;
            $this->playerId = $playerId;
            $this->credits = $credits;
            $user = \VanguardLTE\User::lockForUpdate()->find($this->playerId);
            $user->balance = $credits != null ? $credits : $user->balance;
            $this->user = $user;
            $this->shop_id = $user->shop_id;
            $game = \VanguardLTE\Game::where([
                'name' => $this->slotId, 
                'shop_id' => $this->shop_id
            ])->lockForUpdate()->first();
            $this->shop = \VanguardLTE\Shop::find($this->shop_id);
            $this->game = $game;
            $this->increaseRTP = rand(0, 1);
            $this->CurrentDenomGame = $this->game->denomination;
            $this->Denominations = array_combine(\VanguardLTE\Game::$values['denomination'], \VanguardLTE\Game::$values['denomination']);
            $this->CurrentDenom = $this->game->denomination;
            $this->scaleMode = 0;
            $this->numFloat = 0;
            $this->NumbersId[144] = [0];
            $this->NumbersId[97] = [1];
            $this->NumbersId[99] = [4];
            $this->NumbersId[101] = [7];
            $this->NumbersId[103] = [10];
            $this->NumbersId[105] = [13];
            $this->NumbersId[107] = [16];
            $this->NumbersId[109] = [19];
            $this->NumbersId[111] = [22];
            $this->NumbersId[113] = [25];
            $this->NumbersId[115] = [28];
            $this->NumbersId[117] = [31];
            $this->NumbersId[119] = [34];
            $this->NumbersId[49] = [2];
            $this->NumbersId[51] = [5];
            $this->NumbersId[53] = [8];
            $this->NumbersId[55] = [11];
            $this->NumbersId[57] = [14];
            $this->NumbersId[59] = [17];
            $this->NumbersId[61] = [20];
            $this->NumbersId[63] = [23];
            $this->NumbersId[65] = [26];
            $this->NumbersId[67] = [29];
            $this->NumbersId[69] = [32];
            $this->NumbersId[71] = [35];
            $this->NumbersId[1] = [3];
            $this->NumbersId[3] = [6];
            $this->NumbersId[5] = [9];
            $this->NumbersId[7] = [12];
            $this->NumbersId[9] = [15];
            $this->NumbersId[11] = [18];
            $this->NumbersId[13] = [21];
            $this->NumbersId[15] = [24];
            $this->NumbersId[17] = [27];
            $this->NumbersId[19] = [30];
            $this->NumbersId[21] = [33];
            $this->NumbersId[23] = [36];
            $this->NumbersId[0] = [
                0, 
                3
            ];
            $this->NumbersId[48] = [
                0, 
                2
            ];
            $this->NumbersId[96] = [
                0, 
                1
            ];
            $this->NumbersId[98] = [
                1, 
                4
            ];
            $this->NumbersId[100] = [
                1, 
                7
            ];
            $this->NumbersId[102] = [
                7, 
                10
            ];
            $this->NumbersId[104] = [
                10, 
                13
            ];
            $this->NumbersId[106] = [
                13, 
                16
            ];
            $this->NumbersId[108] = [
                16, 
                19
            ];
            $this->NumbersId[110] = [
                19, 
                22
            ];
            $this->NumbersId[112] = [
                22, 
                25
            ];
            $this->NumbersId[114] = [
                25, 
                28
            ];
            $this->NumbersId[116] = [
                28, 
                31
            ];
            $this->NumbersId[118] = [
                31, 
                34
            ];
            $this->NumbersId[50] = [
                2, 
                5
            ];
            $this->NumbersId[52] = [
                5, 
                8
            ];
            $this->NumbersId[54] = [
                8, 
                11
            ];
            $this->NumbersId[56] = [
                11, 
                14
            ];
            $this->NumbersId[58] = [
                14, 
                17
            ];
            $this->NumbersId[60] = [
                17, 
                20
            ];
            $this->NumbersId[62] = [
                20, 
                23
            ];
            $this->NumbersId[64] = [
                23, 
                26
            ];
            $this->NumbersId[66] = [
                26, 
                29
            ];
            $this->NumbersId[68] = [
                29, 
                32
            ];
            $this->NumbersId[70] = [
                32, 
                35
            ];
            $this->NumbersId[2] = [
                3, 
                6
            ];
            $this->NumbersId[4] = [
                6, 
                9
            ];
            $this->NumbersId[6] = [
                9, 
                12
            ];
            $this->NumbersId[8] = [
                12, 
                15
            ];
            $this->NumbersId[10] = [
                15, 
                18
            ];
            $this->NumbersId[12] = [
                18, 
                21
            ];
            $this->NumbersId[14] = [
                21, 
                24
            ];
            $this->NumbersId[16] = [
                24, 
                27
            ];
            $this->NumbersId[18] = [
                27, 
                30
            ];
            $this->NumbersId[20] = [
                30, 
                33
            ];
            $this->NumbersId[22] = [
                33, 
                36
            ];
            $this->NumbersId[73] = [
                1, 
                2
            ];
            $this->NumbersId[75] = [
                4, 
                5
            ];
            $this->NumbersId[77] = [
                7, 
                8
            ];
            $this->NumbersId[79] = [
                10, 
                11
            ];
            $this->NumbersId[81] = [
                13, 
                14
            ];
            $this->NumbersId[83] = [
                16, 
                17
            ];
            $this->NumbersId[85] = [
                19, 
                20
            ];
            $this->NumbersId[87] = [
                22, 
                23
            ];
            $this->NumbersId[89] = [
                25, 
                26
            ];
            $this->NumbersId[91] = [
                28, 
                29
            ];
            $this->NumbersId[93] = [
                31, 
                32
            ];
            $this->NumbersId[95] = [
                34, 
                35
            ];
            $this->NumbersId[25] = [
                2, 
                3
            ];
            $this->NumbersId[27] = [
                5, 
                6
            ];
            $this->NumbersId[29] = [
                8, 
                9
            ];
            $this->NumbersId[31] = [
                11, 
                12
            ];
            $this->NumbersId[33] = [
                14, 
                15
            ];
            $this->NumbersId[35] = [
                17, 
                18
            ];
            $this->NumbersId[37] = [
                20, 
                21
            ];
            $this->NumbersId[39] = [
                23, 
                24
            ];
            $this->NumbersId[41] = [
                26, 
                27
            ];
            $this->NumbersId[43] = [
                29, 
                30
            ];
            $this->NumbersId[45] = [
                32, 
                33
            ];
            $this->NumbersId[47] = [
                35, 
                36
            ];
            $this->NumbersId[24] = [
                0, 
                2, 
                3
            ];
            $this->NumbersId[72] = [
                1, 
                2, 
                0
            ];
            $this->NumbersId[121] = [
                1, 
                2, 
                3
            ];
            $this->NumbersId[123] = [
                4, 
                5, 
                6
            ];
            $this->NumbersId[125] = [
                7, 
                8, 
                9
            ];
            $this->NumbersId[127] = [
                10, 
                11, 
                12
            ];
            $this->NumbersId[129] = [
                13, 
                14, 
                15
            ];
            $this->NumbersId[131] = [
                16, 
                17, 
                18
            ];
            $this->NumbersId[133] = [
                19, 
                20, 
                21
            ];
            $this->NumbersId[135] = [
                22, 
                23, 
                24
            ];
            $this->NumbersId[137] = [
                25, 
                26, 
                27
            ];
            $this->NumbersId[139] = [
                28, 
                29, 
                30
            ];
            $this->NumbersId[141] = [
                31, 
                32, 
                33
            ];
            $this->NumbersId[143] = [
                34, 
                35, 
                36
            ];
            $this->NumbersId[120] = [
                0, 
                1, 
                2, 
                3
            ];
            $this->NumbersId[74] = [
                1, 
                2, 
                4, 
                5
            ];
            $this->NumbersId[76] = [
                4, 
                5, 
                7, 
                8
            ];
            $this->NumbersId[78] = [
                7, 
                8, 
                10, 
                11
            ];
            $this->NumbersId[80] = [
                10, 
                11, 
                13, 
                14
            ];
            $this->NumbersId[82] = [
                13, 
                14, 
                16, 
                17
            ];
            $this->NumbersId[84] = [
                16, 
                17, 
                19, 
                20
            ];
            $this->NumbersId[86] = [
                19, 
                20, 
                22, 
                23
            ];
            $this->NumbersId[88] = [
                22, 
                23, 
                25, 
                26
            ];
            $this->NumbersId[90] = [
                25, 
                26, 
                28, 
                29
            ];
            $this->NumbersId[92] = [
                28, 
                29, 
                31, 
                32
            ];
            $this->NumbersId[94] = [
                31, 
                32, 
                34, 
                35
            ];
            $this->NumbersId[26] = [
                2, 
                3, 
                5, 
                6
            ];
            $this->NumbersId[28] = [
                5, 
                6, 
                8, 
                9
            ];
            $this->NumbersId[30] = [
                8, 
                9, 
                11, 
                12
            ];
            $this->NumbersId[32] = [
                11, 
                12, 
                14, 
                15
            ];
            $this->NumbersId[34] = [
                14, 
                15, 
                17, 
                18
            ];
            $this->NumbersId[36] = [
                17, 
                18, 
                20, 
                21
            ];
            $this->NumbersId[38] = [
                20, 
                21, 
                23, 
                24
            ];
            $this->NumbersId[40] = [
                23, 
                24, 
                26, 
                27
            ];
            $this->NumbersId[42] = [
                26, 
                27, 
                29, 
                30
            ];
            $this->NumbersId[44] = [
                29, 
                30, 
                32, 
                33
            ];
            $this->NumbersId[46] = [
                32, 
                33, 
                35, 
                36
            ];
            $this->NumbersId[122] = [
                1, 
                2, 
                3, 
                4, 
                5, 
                6
            ];
            $this->NumbersId[124] = [
                4, 
                5, 
                6, 
                7, 
                8, 
                9
            ];
            $this->NumbersId[126] = [
                7, 
                8, 
                9, 
                10, 
                11, 
                12
            ];
            $this->NumbersId[128] = [
                10, 
                11, 
                12, 
                13, 
                14, 
                15
            ];
            $this->NumbersId[130] = [
                13, 
                14, 
                15, 
                16, 
                17, 
                18
            ];
            $this->NumbersId[132] = [
                16, 
                17, 
                18, 
                19, 
                20, 
                21
            ];
            $this->NumbersId[134] = [
                19, 
                20, 
                21, 
                22, 
                23, 
                24
            ];
            $this->NumbersId[136] = [
                22, 
                23, 
                24, 
                25, 
                26, 
                27
            ];
            $this->NumbersId[138] = [
                25, 
                26, 
                27, 
                28, 
                29, 
                30
            ];
            $this->NumbersId[140] = [
                28, 
                29, 
                30, 
                31, 
                32, 
                33
            ];
            $this->NumbersId[142] = [
                31, 
                32, 
                33, 
                34, 
                35, 
                36
            ];
            $this->NumbersId[151] = [
                1, 
                4, 
                7, 
                10, 
                13, 
                16, 
                19, 
                22, 
                25, 
                28, 
                31, 
                34
            ];
            $this->NumbersId[152] = [
                2, 
                5, 
                8, 
                11, 
                14, 
                17, 
                20, 
                23, 
                26, 
                29, 
                32, 
                35
            ];
            $this->NumbersId[153] = [
                3, 
                6, 
                9, 
                12, 
                15, 
                18, 
                21, 
                24, 
                27, 
                30, 
                33, 
                36
            ];
            $this->NumbersId[154] = [
                1, 
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
                12
            ];
            $this->NumbersId[155] = [
                13, 
                14, 
                15, 
                16, 
                17, 
                18, 
                19, 
                20, 
                21, 
                22, 
                23, 
                24
            ];
            $this->NumbersId[156] = [
                25, 
                26, 
                27, 
                28, 
                29, 
                30, 
                31, 
                32, 
                33, 
                34, 
                35, 
                36
            ];
            $this->NumbersId[145] = [
                1, 
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
                14, 
                15, 
                16, 
                17, 
                18
            ];
            $this->NumbersId[146] = [
                19, 
                20, 
                21, 
                22, 
                23, 
                24, 
                25, 
                26, 
                27, 
                28, 
                29, 
                30, 
                31, 
                32, 
                33, 
                34, 
                35, 
                36
            ];
            $this->NumbersId[147] = [
                2, 
                4, 
                6, 
                8, 
                10, 
                12, 
                14, 
                16, 
                18, 
                20, 
                22, 
                24, 
                26, 
                28, 
                30, 
                32, 
                34, 
                36
            ];
            $this->NumbersId[148] = [
                1, 
                3, 
                5, 
                7, 
                9, 
                11, 
                13, 
                15, 
                17, 
                19, 
                21, 
                23, 
                25, 
                27, 
                29, 
                31, 
                33, 
                35
            ];
            $this->NumbersId[149] = [
                1, 
                3, 
                5, 
                7, 
                9, 
                12, 
                14, 
                16, 
                18, 
                19, 
                21, 
                23, 
                25, 
                27, 
                30, 
                32, 
                34, 
                36
            ];
            $this->NumbersId[150] = [
                2, 
                4, 
                6, 
                8, 
                11, 
                10, 
                13, 
                15, 
                17, 
                20, 
                22, 
                24, 
                26, 
                28, 
                29, 
                31, 
                33, 
                35
            ];
            $reel = new GameReel();
            foreach( [
                'reelStrip1', 
                'reelStrip2', 
                'reelStrip3', 
                'reelStrip4', 
                'reelStrip5', 
                'reelStrip6'
            ] as $reelStrip ) 
            {
                if( count($reel->reelsStrip[$reelStrip]) ) 
                {
                    $this->$reelStrip = $reel->reelsStrip[$reelStrip];
                }
            }
            $this->keyController = [
                '13' => 'uiButtonSpin,uiButtonSkip', 
                '49' => 'uiButtonInfo', 
                '50' => 'uiButtonCollect', 
                '51' => 'uiButtonExit2', 
                '52' => 'uiButtonLinesMinus', 
                '53' => 'uiButtonLinesPlus', 
                '54' => 'uiButtonBetMinus', 
                '55' => 'uiButtonBetPlus', 
                '56' => 'uiButtonGamble', 
                '57' => 'uiButtonRed', 
                '48' => 'uiButtonBlack', 
                '189' => 'uiButtonAuto', 
                '187' => 'uiButtonSpin'
            ];
            $this->slotReelsConfig = [
                [
                    425, 
                    142, 
                    3
                ], 
                [
                    669, 
                    142, 
                    3
                ], 
                [
                    913, 
                    142, 
                    3
                ], 
                [
                    1157, 
                    142, 
                    3
                ], 
                [
                    1401, 
                    142, 
                    3
                ]
            ];
            $this->slotBonusType = 1;
            $this->slotScatterType = 0;
            $this->splitScreen = false;
            $this->slotBonus = false;
            $this->slotGamble = true;
            $this->slotFastStop = 1;
            $this->slotExitUrl = '/';
            $this->slotWildMpl = 1;
            $this->GambleType = 1;
            $this->slotFreeCount = 20;
            $this->slotFreeMpl = 3;
            $this->slotViewState = ($game->slotViewState == '' ? 'Normal' : $game->slotViewState);
            $this->hideButtons = [];
            $this->jpgs = \VanguardLTE\JPG::where('shop_id', $this->shop_id)->lockForUpdate()->get();
            $this->slotJackPercent = [];
            $this->slotJackpot = [];
            for( $jp = 0; $jp < 4; $jp++ ) 
            {
                if( $this->jpgs[$jp]->balance != '' ) 
                {
                    $this->slotJackpot[$jp] = sprintf('%01.4f', $this->jpgs[$jp]->balance);
                    $this->slotJackpot[$jp] = substr($this->slotJackpot[$jp], 0, strlen($this->slotJackpot[$jp]) - 2);
                    $this->slotJackPercent[] = $this->jpgs[$jp]->percent;
                }
            }
            $this->Line = [
                1, 
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
                14, 
                15
            ];
            $this->gameLine = [
                1, 
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
                14, 
                15
            ];
            $this->Bet = explode(',', $game->bet);
            $this->Bet = array_slice($this->Bet, 0, 5);
            $this->Balance = $user->balance;
            $this->SymbolGame = [
                '0', 
                '1', 
                2, 
                3, 
                4, 
                5, 
                6, 
                7, 
                8
            ];
            $this->Bank = $game->get_gamebank();
            $this->Percent = $this->shop->percent;
            $this->WinGamble = $game->rezerv;
            $this->slotDBId = $game->id;
            $this->slotCurrency = $user->shop->currency;
            if( $user->count_balance == 0 ) 
            {
                $this->Percent = 100;
                $this->slotJackPercent = 0;
                $this->slotJackPercent0 = 0;
            }
            if( !isset($this->user->session) || strlen($this->user->session) <= 0 ) 
            {
                $this->user->session = serialize([]);
            }
            $this->gameData = unserialize($this->user->session);
            if( count($this->gameData) > 0 ) 
            {
                foreach( $this->gameData as $key => $vl ) 
                {
                    if( $vl['timelife'] <= time() ) 
                    {
                        unset($this->gameData[$key]);
                    }
                }
            }
        }
        public function GetFieldName($fieldId)
        {
            $_obf_0D211E3E5B1A2C1D053F37120232222230303939291332 = [];
            $_obf_0D211E3E5B1A2C1D053F37120232222230303939291332['zero'] = [144];
            $_obf_0D211E3E5B1A2C1D053F37120232222230303939291332['straight'] = [
                144, 
                97, 
                99, 
                101, 
                103, 
                105, 
                107, 
                109, 
                111, 
                113, 
                115, 
                117, 
                119, 
                49, 
                51, 
                53, 
                55, 
                57, 
                59, 
                61, 
                63, 
                65, 
                67, 
                69, 
                71, 
                1, 
                3, 
                5, 
                7, 
                9, 
                11, 
                13, 
                15, 
                17, 
                19, 
                21, 
                23
            ];
            $_obf_0D211E3E5B1A2C1D053F37120232222230303939291332['split'] = [
                0, 
                48, 
                96, 
                98, 
                100, 
                102, 
                104, 
                106, 
                108, 
                110, 
                112, 
                114, 
                116, 
                118, 
                50, 
                52, 
                54, 
                56, 
                58, 
                60, 
                62, 
                64, 
                66, 
                68, 
                70, 
                2, 
                4, 
                6, 
                8, 
                10, 
                12, 
                14, 
                16, 
                18, 
                20, 
                22, 
                73, 
                75, 
                77, 
                79, 
                81, 
                83, 
                85, 
                87, 
                89, 
                91, 
                93, 
                95, 
                25, 
                27, 
                29, 
                31, 
                33, 
                35, 
                37, 
                39, 
                41, 
                43, 
                45, 
                47
            ];
            $_obf_0D211E3E5B1A2C1D053F37120232222230303939291332['street'] = [
                24, 
                72, 
                121, 
                123, 
                125, 
                127, 
                129, 
                131, 
                133, 
                135, 
                137, 
                139, 
                141, 
                143
            ];
            $_obf_0D211E3E5B1A2C1D053F37120232222230303939291332['corner'] = [
                120, 
                74, 
                76, 
                78, 
                80, 
                82, 
                84, 
                86, 
                88, 
                90, 
                92, 
                94, 
                26, 
                28, 
                30, 
                32, 
                34, 
                36, 
                38, 
                40, 
                42, 
                44, 
                46
            ];
            $_obf_0D211E3E5B1A2C1D053F37120232222230303939291332['line'] = [
                122, 
                124, 
                126, 
                128, 
                130, 
                132, 
                134, 
                136, 
                138, 
                140, 
                142
            ];
            $_obf_0D211E3E5B1A2C1D053F37120232222230303939291332['column'] = [
                151, 
                152, 
                153
            ];
            $_obf_0D211E3E5B1A2C1D053F37120232222230303939291332['twelve'] = [
                154, 
                155, 
                156
            ];
            $_obf_0D211E3E5B1A2C1D053F37120232222230303939291332['low'] = [145];
            $_obf_0D211E3E5B1A2C1D053F37120232222230303939291332['high'] = [146];
            $_obf_0D211E3E5B1A2C1D053F37120232222230303939291332['red'] = [149];
            $_obf_0D211E3E5B1A2C1D053F37120232222230303939291332['black'] = [150];
            $_obf_0D211E3E5B1A2C1D053F37120232222230303939291332['odd'] = [148];
            $_obf_0D211E3E5B1A2C1D053F37120232222230303939291332['even'] = [147];
            foreach( $_obf_0D211E3E5B1A2C1D053F37120232222230303939291332 as $key => $vl ) 
            {
                if( in_array($fieldId, $vl) ) 
                {
                    return $key;
                }
            }
            return 'NULL';
        }
        public function SetGameData($key, $value)
        {
            $_obf_0D3809171D170D2A39270A191B211D273D3E2F01080132 = 86400;
            $this->gameData[$key] = [
                'timelife' => time() + $_obf_0D3809171D170D2A39270A191B211D273D3E2F01080132, 
                'payload' => $value
            ];
        }
        public function GetGameData($key)
        {
            if( isset($this->gameData[$key]) ) 
            {
                return $this->gameData[$key]['payload'];
            }
            else
            {
                return 0;
            }
        }
        public function FormatFloat($num)
        {
            $str0 = explode('.', $num);
            if( isset($str0[1]) ) 
            {
                if( strlen($str0[1]) > 4 ) 
                {
                    return round($num * 100) / 100;
                }
                else if( strlen($str0[1]) > 2 ) 
                {
                    return floor($num * 100) / 100;
                }
                else
                {
                    return $num;
                }
            }
            else
            {
                return $num;
            }
        }
        public function SaveGameData()
        {
            $this->user->session = serialize($this->gameData);
            $this->user->save();
            $this->user->refresh();
        }
        public function CheckBonusWin()
        {
            $_obf_0D0726215B3F0E0A162A310A40052D021C2E5C18075B01 = 0;
            $_obf_0D101E1F2C0C35313D371B162C0A051E081E07272A2401 = 0;
            foreach( $this->Paytable as $vl ) 
            {
                foreach( $vl as $_obf_0D2234210521342C1F253E5C0C350B0D290D011E0E3C32 ) 
                {
                    if( $_obf_0D2234210521342C1F253E5C0C350B0D290D011E0E3C32 > 0 ) 
                    {
                        $_obf_0D0726215B3F0E0A162A310A40052D021C2E5C18075B01++;
                        $_obf_0D101E1F2C0C35313D371B162C0A051E081E07272A2401 += $_obf_0D2234210521342C1F253E5C0C350B0D290D011E0E3C32;
                        break;
                    }
                }
            }
            return $_obf_0D101E1F2C0C35313D371B162C0A051E081E07272A2401 / $_obf_0D0726215B3F0E0A162A310A40052D021C2E5C18075B01;
        }
        public function HasGameData($key)
        {
            if( isset($this->gameData[$key]) ) 
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        public function GetHistory()
        {
            $history = \VanguardLTE\GameLog::whereRaw('game_id=? and user_id=? ORDER BY id DESC LIMIT 10', [
                $this->slotDBId, 
                $this->playerId
            ])->get();
            $this->lastEvent = 'NULL';
            foreach( $history as $log ) 
            {
                if( $log->str == 'NONE' ) 
                {
                    return 'NULL';
                }
                $_obf_0D1C182417322707301D3D0523132F1D092E3316302332 = json_decode($log->str);
                if( $_obf_0D1C182417322707301D3D0523132F1D092E3316302332->responseEvent != 'gambleResult' && $_obf_0D1C182417322707301D3D0523132F1D092E3316302332->responseEvent != 'jackpot' ) 
                {
                    $this->lastEvent = $log->str;
                    break;
                }
            }
            if( isset($_obf_0D1C182417322707301D3D0523132F1D092E3316302332) ) 
            {
                return $_obf_0D1C182417322707301D3D0523132F1D092E3316302332;
            }
            else
            {
                return 'NULL';
            }
        }
        public function ClearJackpot($jid)
        {
            $this->jpgs[$jid]->balance = sprintf('%01.4f', 0);
            $this->jpgs[$jid]->save();
        }
        public function UpdateJackpots($bet)
        {
            $bet = $bet * $this->CurrentDenom;
            $count_balance = $this->GetCountBalanceUser();
            $_obf_0D0F3334103F22035B2A2D1E1F30231906330229183232 = [];
            $game = $this->game;
            $isJackPay = 0;
            $isJackId = 0;
            for( $jp = 1; $jp <= 4; $jp++ ) 
            {
                if( $this->jpgs[$jp - 1]->balance != '' ) 
                {
                    $this->slotJackpot[$jp - 1] = number_format($this->jpgs[$jp - 1]->balance, 4, '.', '');
                    if( $count_balance == 0 ) 
                    {
                        $_obf_0D0F3334103F22035B2A2D1E1F30231906330229183232[$jp - 1] = $this->slotJackpot[$jp - 1];
                    }
                    else if( $count_balance < $bet ) 
                    {
                        $_obf_0D0F3334103F22035B2A2D1E1F30231906330229183232[$jp - 1] = number_format($count_balance / 100 * $this->slotJackPercent[$jp - 1] + $this->slotJackpot[$jp - 1], 4, '.', '');
                    }
                    else
                    {
                        $_obf_0D0F3334103F22035B2A2D1E1F30231906330229183232[$jp - 1] = number_format($bet / 100 * $this->slotJackPercent[$jp - 1] + $this->slotJackpot[$jp - 1], 4, '.', '');
                    }
                    $_obf_0D01302528181B3B1B11285C03281F22162B0828071901 = $_obf_0D0F3334103F22035B2A2D1E1F30231906330229183232[$jp - 1];
                    if( $this->jpgs[$jp - 1]->pay_sum <= $this->slotJackpot[$jp - 1] && !$isJackPay && $this->jpgs[$jp - 1]->pay_sum > 0 ) 
                    {
                        $isJackPay = 1;
                        $isJackId = $jp - 1;
                    }
                    $this->slotJackpot[$jp - 1] = sprintf('%01.2f', $_obf_0D0F3334103F22035B2A2D1E1F30231906330229183232[$jp - 1]);
                    $this->jpgs[$jp - 1]->balance = sprintf('%01.4f', $_obf_0D01302528181B3B1B11285C03281F22162B0828071901);
                    $this->jpgs[$jp - 1]->save();
                }
            }
            $game->save();
            for( $jp = 0; $jp < 4; $jp++ ) 
            {
                if( $this->jpgs[$jp]->balance != '' && $this->jpgs[$jp]->balance < $this->jpgs[$jp]->start_balance ) 
                {
                    $summ = $this->jpgs[$jp]->start_balance - $this->jpgs[$jp]->balance;
                    if( $summ > 0 ) 
                    {
                        $game->add_jps(false, $jp, $summ);
                    }
                }
            }
            return [
                'isJackPay' => $isJackPay, 
                'isJackId' => $isJackId
            ];
        }
        public function GetBank($slotState = '')
        {
            if( $this->isBonusStart || $slotState == 'bonus' || $slotState == 'freespin' || $slotState == 'respin' ) 
            {
                $slotState = 'bonus';
            }
            else
            {
                $slotState = '';
            }
            $game = $this->game;
            $game->refresh();
            $this->Bank = $game->get_gamebank($slotState);
            return $this->Bank / $this->CurrentDenom;
        }
        public function GetPercent()
        {
            return $this->Percent;
        }
        public function GetCountBalanceUser()
        {
            $this->user->session = serialize($this->gameData);
            $this->user->save();
            $this->user->refresh();
            $this->gameData = unserialize($this->user->session);
            return $this->user->count_balance;
        }
        public function InternalError($errcode)
        {
            $_obf_0D173D2C0F0E1039243839032714070829293F01115C01 = '';
            $_obf_0D173D2C0F0E1039243839032714070829293F01115C01 .= "\n";
            $_obf_0D173D2C0F0E1039243839032714070829293F01115C01 .= ('{"responseEvent":"error","responseType":"' . $errcode . '","serverResponse":"InternalError"}');
            $_obf_0D173D2C0F0E1039243839032714070829293F01115C01 .= "\n";
            $_obf_0D173D2C0F0E1039243839032714070829293F01115C01 .= ' ############################################### ';
            $_obf_0D173D2C0F0E1039243839032714070829293F01115C01 .= "\n";
            $_obf_0D090F3326352D250E1F112D1A401618142216405B1122 = '';
            if( file_exists(storage_path('logs/') . $this->slotId . 'Internal.log') ) 
            {
                $_obf_0D090F3326352D250E1F112D1A401618142216405B1122 = file_get_contents(storage_path('logs/') . $this->slotId . 'Internal.log');
            }
            file_put_contents(storage_path('logs/') . $this->slotId . 'Internal.log', $_obf_0D090F3326352D250E1F112D1A401618142216405B1122 . $_obf_0D173D2C0F0E1039243839032714070829293F01115C01);
            exit( '{"responseEvent":"error","responseType":"' . $errcode . '","serverResponse":"InternalError"}' );
        }
        public function SetBank($slotState = '', $sum, $slotEvent = '')
        {
            if( $this->isBonusStart || $slotState == 'bonus' || $slotState == 'freespin' || $slotState == 'respin' ) 
            {
                $slotState = 'bonus';
            }
            else
            {
                $slotState = '';
            }
            if( $this->GetBank($slotState) + $sum < 0 ) 
            {
                $this->InternalError('Bank_   ' . $sum);
            }
            $sum = $sum * $this->CurrentDenom;
            $game = $this->game;
            $_obf_0D323B0D0232233E2124360A363D01253E350E3E141722 = 0;
            if( $sum > 0 && $slotEvent == 'bet' ) 
            {
                $this->toGameBanks = 0;
                $this->toSlotJackBanks = 0;
                $this->toSysJackBanks = 0;
                $this->betProfit = 0;
                $_obf_0D13010B0811332E0B132C3D3835050735343B1D132311 = $this->GetPercent();
                $_obf_0D091C1B3E353301251C272A22120618372D2B3F291B32 = 10;
                $count_balance = $this->GetCountBalanceUser();
                $_obf_0D4007282C1E26152E0C32061432401D32032D2D360232 = $sum / $this->GetPercent() * 100;
                if( $count_balance < $_obf_0D4007282C1E26152E0C32061432401D32032D2D360232 && $count_balance > 0 ) 
                {
                    $_obf_0D260D232111221E272723050C121A2A1133112B353511 = $count_balance;
                    $_obf_0D1F2913360707183C1B330B232D5B193631140E113301 = $_obf_0D4007282C1E26152E0C32061432401D32032D2D360232 - $_obf_0D260D232111221E272723050C121A2A1133112B353511;
                    $_obf_0D2A0526273612293511363C26193E1C130B2719192611 = $_obf_0D260D232111221E272723050C121A2A1133112B353511 / 100 * $this->GetPercent();
                    $sum = $_obf_0D2A0526273612293511363C26193E1C130B2719192611 + $_obf_0D1F2913360707183C1B330B232D5B193631140E113301;
                    $_obf_0D323B0D0232233E2124360A363D01253E350E3E141722 = $_obf_0D260D232111221E272723050C121A2A1133112B353511 / 100 * $_obf_0D091C1B3E353301251C272A22120618372D2B3F291B32;
                }
                else if( $count_balance > 0 ) 
                {
                    $_obf_0D323B0D0232233E2124360A363D01253E350E3E141722 = $_obf_0D4007282C1E26152E0C32061432401D32032D2D360232 / 100 * $_obf_0D091C1B3E353301251C272A22120618372D2B3F291B32;
                }
                for( $jp = 1; $jp <= 4; $jp++ ) 
                {
                    if( $this->jpgs[$jp - 1]->balance != '' ) 
                    {
                        if( $count_balance < $_obf_0D4007282C1E26152E0C32061432401D32032D2D360232 && $count_balance > 0 ) 
                        {
                            $this->toSlotJackBanks += ($count_balance / 100 * $this->jpgs[$jp - 1]->percent);
                        }
                        else if( $count_balance > 0 ) 
                        {
                            $this->toSlotJackBanks += ($_obf_0D4007282C1E26152E0C32061432401D32032D2D360232 / 100 * $this->jpgs[$jp - 1]->percent);
                        }
                    }
                }
                $this->toGameBanks = $sum;
                $this->betProfit = $_obf_0D4007282C1E26152E0C32061432401D32032D2D360232 - $this->toGameBanks - $this->toSlotJackBanks - $this->toSysJackBanks;
            }
            if( $sum > 0 ) 
            {
                $this->toGameBanks = $sum;
            }
            if( $_obf_0D323B0D0232233E2124360A363D01253E350E3E141722 > 0 ) 
            {
                $sum -= $_obf_0D323B0D0232233E2124360A363D01253E350E3E141722;
                $game->set_gamebank($_obf_0D323B0D0232233E2124360A363D01253E350E3E141722, 'inc', 'bonus');
            }
            $game->set_gamebank($sum, 'inc', $slotState);
            $game->save();
            return $game;
        }
        public function SetBalance($sum, $slotEvent = '')
        {
            if( $this->GetBalance() + $sum < 0 ) 
            {
                $this->InternalError('Balance_   ' . $sum);
            }
            $sum = $sum * $this->CurrentDenom;
            $user = $this->user;
            if( $sum < 0 && $slotEvent == 'bet' ) 
            {
$user->wager = $user->wager + ($sum * $this->game->getCategoryWagerPercent() / 100);
                $user->wager = $this->FormatFloat($user->wager);
                $user->count_balance = $user->count_balance + $sum;
                $user->count_balance = $this->FormatFloat($user->count_balance);
            }
            $user->balance = $user->balance + $sum;
            $user->balance = $this->FormatFloat($user->balance);
            $this->user->session = serialize($this->gameData);
            $this->user->save();
            $this->user->refresh();
            $this->gameData = unserialize($this->user->session);
            if( $user->balance == 0 ) 
            {
                $user->update([
                    'wager' => 0, 
                    'bonus' => 0
                ]);
            }
            if( $user->wager == 0 ) 
            {
                $user->update(['bonus' => 0]);
            }
            if( $user->wager < 0 ) 
            {
                $user->update([
                    'wager' => 0, 
                    'bonus' => 0
                ]);
            }
            if( $user->count_balance < 0 ) 
            {
                $user->update(['count_balance' => 0]);
            }
            return $user;
        }
        public function GetBalance()
        {
            $this->user->session = serialize($this->gameData);
            $this->user->save();
            $this->user->refresh();
            $this->gameData = unserialize($this->user->session);
            $user = $this->user;
            $this->Balance = $user->balance / $this->CurrentDenom;
            return $this->Balance;
        }
        public function SaveLogReport($spinSymbols, $bet, $lines, $win, $slotState)
        {
            $_obf_0D09321428053235180C062C0D08240E3E23031A161222 = $this->slotId . ' ' . $slotState;
            if( $slotState == 'freespin' ) 
            {
                $_obf_0D09321428053235180C062C0D08240E3E23031A161222 = $this->slotId . ' FG';
            }
            else if( $slotState == 'bet' ) 
            {
                $_obf_0D09321428053235180C062C0D08240E3E23031A161222 = $this->slotId . '';
            }
            else if( $slotState == 'slotGamble' ) 
            {
                $_obf_0D09321428053235180C062C0D08240E3E23031A161222 = $this->slotId . ' DG';
            }
            $game = $this->game;
            $game->increment('stat_in', $bet * $this->CurrentDenom);
            $game->increment('stat_out', $win * $this->CurrentDenom);
            if( !isset($this->betProfit) ) 
            {
                $this->betProfit = 0;
                $this->toGameBanks = 0;
                $this->toSlotJackBanks = 0;
                $this->toSysJackBanks = 0;
            }
            if( !isset($this->toGameBanks) ) 
            {
                $this->toGameBanks = 0;
            }
            $this->game->increment('bids');
            $this->game->refresh();
            \VanguardLTE\GameLog::create([
                'game_id' => $this->slotDBId, 
                'user_id' => $this->playerId, 
                'ip' => $_SERVER['REMOTE_ADDR'], 
                'str' => $spinSymbols, 
                'shop_id' => $this->shop_id
            ]);
            \VanguardLTE\StatGame::create([
                'user_id' => $this->playerId, 
                'balance' => $this->Balance * $this->CurrentDenom, 
                'bet' => $bet * $this->CurrentDenom, 
                'win' => $win * $this->CurrentDenom, 
                'game' => $_obf_0D09321428053235180C062C0D08240E3E23031A161222, 
                'percent' => $this->toGameBanks, 
                'percent_jps' => $this->toSysJackBanks, 
                'percent_jpg' => $this->toSlotJackBanks, 
                'profit' => $this->betProfit, 
                'denomination' => $this->CurrentDenom, 
                'shop_id' => $this->shop_id
            ]);
        }
        public function GetSpinSettings($bet, $lines)
        {
            $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01 = 10;
            switch( $lines ) 
            {
                case 10:
                    $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01 = 10;
                    break;
                case 9:
                case 8:
                    $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01 = 9;
                    break;
                case 7:
                case 6:
                    $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01 = 7;
                    break;
                case 5:
                case 4:
                    $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01 = 5;
                    break;
                case 3:
                case 2:
                    $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01 = 3;
                    break;
                case 1:
                    $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01 = 1;
                    break;
                default:
                    $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01 = 10;
                    break;
            }
            $bonusWin = 0;
            $spinWin = 0;
            $game = $this->game;
            $_obf_0D27111A2B40090B2C060F37133809022E40252F0B3722 = $game->{'garant_win' . $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01};
            $_obf_0D392C283D240A26380A031629073F300329283E053311 = $game->{'garant_bonus' . $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01};
            $_obf_0D3339401713061A1325101E1207131535275B37352B32 = $game->{'winbonus' . $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01};
            $_obf_0D4017081018211A25381C2229342C02092B272F152222 = $game->{'winline' . $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01};
            $_obf_0D27111A2B40090B2C060F37133809022E40252F0B3722++;
            $_obf_0D392C283D240A26380A031629073F300329283E053311++;
            $return = [
                'none', 
                0
            ];
            if( $_obf_0D3339401713061A1325101E1207131535275B37352B32 <= $_obf_0D392C283D240A26380A031629073F300329283E053311 ) 
            {
                $bonusWin = 1;
                $_obf_0D392C283D240A26380A031629073F300329283E053311 = 0;
                $game->{'winbonus' . $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01} = $this->getNewSpin($game, 0, 1, $lines);
            }
            else if( $_obf_0D4017081018211A25381C2229342C02092B272F152222 <= $_obf_0D27111A2B40090B2C060F37133809022E40252F0B3722 ) 
            {
                $spinWin = 1;
                $_obf_0D27111A2B40090B2C060F37133809022E40252F0B3722 = 0;
                $game->{'winline' . $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01} = $this->getNewSpin($game, 1, 0, $lines);
            }
            $game->{'garant_win' . $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01} = $_obf_0D27111A2B40090B2C060F37133809022E40252F0B3722;
            $game->{'garant_bonus' . $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01} = $_obf_0D392C283D240A26380A031629073F300329283E053311;
            $game->save();
            if( $bonusWin == 1 && $this->slotBonus ) 
            {
                $this->isBonusStart = true;
                $garantType = 'bonus';
                $_obf_0D032F402A0310171A2D1E3F3124380424340540192122 = $this->GetBank($garantType);
                $return = [
                    'bonus', 
                    $_obf_0D032F402A0310171A2D1E3F3124380424340540192122
                ];
                if( $_obf_0D032F402A0310171A2D1E3F3124380424340540192122 < ($this->CheckBonusWin() * $bet) ) 
                {
                    $return = [
                        'none', 
                        0
                    ];
                }
            }
            else if( $spinWin == 1 || $bonusWin == 1 && !$this->slotBonus ) 
            {
                $_obf_0D032F402A0310171A2D1E3F3124380424340540192122 = $this->GetBank($garantType);
                $return = [
                    'win', 
                    $_obf_0D032F402A0310171A2D1E3F3124380424340540192122
                ];
            }
            if( $garantType == 'bet' && $this->GetBalance() <= (1 / $this->CurrentDenom) ) 
            {
                $_obf_0D3B01080A3C1F322D3B2B342102213F1D093038391932 = rand(1, 2);
                if( $_obf_0D3B01080A3C1F322D3B2B342102213F1D093038391932 == 1 ) 
                {
                    $_obf_0D032F402A0310171A2D1E3F3124380424340540192122 = $this->GetBank('');
                    $return = [
                        'win', 
                        $_obf_0D032F402A0310171A2D1E3F3124380424340540192122
                    ];
                }
            }
            return $return;
        }
        public function getNewSpin($game, $spinWin = 0, $bonusWin = 0, $lines)
        {
            $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01 = 10;
            switch( $lines ) 
            {
                case 10:
                    $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01 = 10;
                    break;
                case 9:
                case 8:
                    $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01 = 9;
                    break;
                case 7:
                case 6:
                    $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01 = 7;
                    break;
                case 5:
                case 4:
                    $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01 = 5;
                    break;
                case 3:
                case 2:
                    $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01 = 3;
                    break;
                case 1:
                    $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01 = 1;
                    break;
                default:
                    $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01 = 10;
                    break;
            }
            if( $spinWin ) 
            {
                $win = explode(',', $game->game_win->{'winline' . $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01});
            }
            if( $bonusWin ) 
            {
                $win = explode(',', $game->game_win->{'winbonus' . $_obf_0D0E230615050C285B14160C26213C3F35361B0C102E01});
            }
            $number = rand(0, count($win) - 1);
            return $win[$number];
        }
        public function GetRandomScatterPos($rp)
        {
            $_obf_0D341A3417182E3C3706123C162827152E2C0E13102632 = [];
            for( $i = 0; $i < count($rp); $i++ ) 
            {
                if( $rp[$i] == '7' ) 
                {
                    if( isset($rp[$i + 1]) && isset($rp[$i - 1]) ) 
                    {
                        array_push($_obf_0D341A3417182E3C3706123C162827152E2C0E13102632, $i);
                    }
                    if( isset($rp[$i - 1]) && isset($rp[$i - 2]) ) 
                    {
                        array_push($_obf_0D341A3417182E3C3706123C162827152E2C0E13102632, $i + 1);
                    }
                    if( isset($rp[$i + 1]) && isset($rp[$i + 2]) ) 
                    {
                        array_push($_obf_0D341A3417182E3C3706123C162827152E2C0E13102632, $i - 1);
                    }
                }
            }
            shuffle($_obf_0D341A3417182E3C3706123C162827152E2C0E13102632);
            if( !isset($_obf_0D341A3417182E3C3706123C162827152E2C0E13102632[0]) ) 
            {
                $_obf_0D341A3417182E3C3706123C162827152E2C0E13102632[0] = rand(2, count($rp) - 3);
            }
            return $_obf_0D341A3417182E3C3706123C162827152E2C0E13102632[0];
        }
        public function GetGambleSettings()
        {
            $spinWin = rand(1, $this->WinGamble);
            return $spinWin;
        }
        public function GetReelStrips($winType, $slotEvent)
        {
            $game = $this->game;
            if( $slotEvent == 'freespin' ) 
            {
                $reel = new GameReel();
                $_obf_0D2D341D071730363C13332D2A23032434230B0F110A32 = $reel->reelsStripBonus;
                foreach( [
                    'reelStrip1', 
                    'reelStrip2', 
                    'reelStrip3', 
                    'reelStrip4', 
                    'reelStrip5', 
                    'reelStrip6'
                ] as $reelStrip ) 
                {
                    $_obf_0D3812112408132F3C340B1C0B112A112C181302341B11 = array_shift($_obf_0D2D341D071730363C13332D2A23032434230B0F110A32);
                    if( count($_obf_0D3812112408132F3C340B1C0B112A112C181302341B11) ) 
                    {
                        $this->$reelStrip = $_obf_0D3812112408132F3C340B1C0B112A112C181302341B11;
                    }
                }
            }
            if( $winType != 'bonus' ) 
            {
                $_obf_0D1F1D041B280532291A2C2B223C14135C2427303D0811 = [];
                foreach( [
                    'reelStrip1', 
                    'reelStrip2', 
                    'reelStrip3', 
                    'reelStrip4', 
                    'reelStrip5', 
                    'reelStrip6'
                ] as $index => $reelStrip ) 
                {
                    if( is_array($this->$reelStrip) && count($this->$reelStrip) > 0 ) 
                    {
                        $_obf_0D1F1D041B280532291A2C2B223C14135C2427303D0811[$index + 1] = mt_rand(0, count($this->$reelStrip) - 3);
                    }
                }
            }
            else
            {
                $_obf_0D1402241D140F0A0D2414233E341B2C0A0A242C052601 = [];
                foreach( [
                    'reelStrip1', 
                    'reelStrip2', 
                    'reelStrip3', 
                    'reelStrip4', 
                    'reelStrip5', 
                    'reelStrip6'
                ] as $index => $reelStrip ) 
                {
                    if( is_array($this->$reelStrip) && count($this->$reelStrip) > 0 ) 
                    {
                        $_obf_0D1F1D041B280532291A2C2B223C14135C2427303D0811[$index + 1] = $this->GetRandomScatterPos($this->$reelStrip);
                        $_obf_0D1402241D140F0A0D2414233E341B2C0A0A242C052601[] = $index + 1;
                    }
                }
                $_obf_0D2E231302321E2F343D3B3E320D03190C0A0923342F01 = rand(3, count($_obf_0D1402241D140F0A0D2414233E341B2C0A0A242C052601));
                shuffle($_obf_0D1402241D140F0A0D2414233E341B2C0A0A242C052601);
                for( $i = 0; $i < count($_obf_0D1402241D140F0A0D2414233E341B2C0A0A242C052601); $i++ ) 
                {
                    if( $i < $_obf_0D2E231302321E2F343D3B3E320D03190C0A0923342F01 ) 
                    {
                        $_obf_0D1F1D041B280532291A2C2B223C14135C2427303D0811[$_obf_0D1402241D140F0A0D2414233E341B2C0A0A242C052601[$i]] = $this->GetRandomScatterPos($this->{'reelStrip' . $_obf_0D1402241D140F0A0D2414233E341B2C0A0A242C052601[$i]});
                    }
                    else
                    {
                        $_obf_0D1F1D041B280532291A2C2B223C14135C2427303D0811[$_obf_0D1402241D140F0A0D2414233E341B2C0A0A242C052601[$i]] = rand(0, count($this->{'reelStrip' . $_obf_0D1402241D140F0A0D2414233E341B2C0A0A242C052601[$i]}) - 3);
                    }
                }
            }
            $reel = [
                'rp' => []
            ];
            foreach( $_obf_0D1F1D041B280532291A2C2B223C14135C2427303D0811 as $index => $value ) 
            {
                $key = $this->{'reelStrip' . $index};
                $cnt = count($key);
                $key[-1] = $key[$cnt - 1];
                $key[$cnt] = $key[0];
                $reel['reel' . $index][0] = $key[$value - 1];
                $reel['reel' . $index][1] = $key[$value];
                $reel['reel' . $index][2] = $key[$value + 1];
                $reel['reel' . $index][3] = '';
                $reel['rp'][] = $value;
            }
            return $reel;
        }
    }

}
