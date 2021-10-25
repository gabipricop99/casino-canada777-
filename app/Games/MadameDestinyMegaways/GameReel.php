<?php 
namespace VanguardLTE\Games\MadameDestinyMegaways
{
    class GameReel
    {
        public $reelsStrip = [
            'reelStrip1_1' => [], 
            'reelStrip1_2' => [], 
            'reelStrip1_3' => [], 
            'reelStrip1_4' => [], 
            'reelStrip1_5' => [], 
            'reelStrip1_6' => [], 
            'reelStrip1_7' => [],
            'reelStrip2_1' => [], 
            'reelStrip2_2' => [], 
            'reelStrip2_3' => [], 
            'reelStrip2_4' => [], 
            'reelStrip2_5' => [], 
            'reelStrip2_6' => [], 
            'reelStrip2_7' => [],
            'reelStrip3_1' => [], 
            'reelStrip3_2' => [], 
            'reelStrip3_3' => [], 
            'reelStrip3_4' => [], 
            'reelStrip3_5' => [], 
            'reelStrip3_6' => [], 
            'reelStrip3_7' => [],
            'reelStrip4_1' => [], 
            'reelStrip4_2' => [], 
            'reelStrip4_3' => [], 
            'reelStrip4_4' => [], 
            'reelStrip4_5' => [], 
            'reelStrip4_6' => [], 
            'reelStrip4_7' => [],
            'reelStrip5_1' => [], 
            'reelStrip5_2' => [], 
            'reelStrip5_3' => [], 
            'reelStrip5_4' => [], 
            'reelStrip5_5' => [], 
            'reelStrip5_6' => [], 
            'reelStrip5_7' => [],
            'reelStrip6_1' => [], 
            'reelStrip6_2' => [], 
            'reelStrip6_3' => [], 
            'reelStrip6_4' => [], 
            'reelStrip6_5' => [], 
            'reelStrip6_6' => [], 
            'reelStrip6_7' => [],
            'reelStrip7_1' => [], 
            'reelStrip7_2' => [], 
            'reelStrip7_3' => [], 
            'reelStrip7_4' => [], 
            'reelStrip7_5' => [], 
            'reelStrip7_6' => [], 
            'reelStrip7_7' => [],
            'reelStrip8_1' => [], 
            'reelStrip8_2' => [], 
            'reelStrip8_3' => [], 
            'reelStrip8_4' => [], 
            'reelStrip8_5' => [], 
            'reelStrip8_6' => [], 
            'reelStrip8_7' => [],
            'reelStrip9_1' => [], 
            'reelStrip9_2' => [], 
            'reelStrip9_3' => [], 
            'reelStrip9_4' => [], 
            'reelStrip9_5' => [], 
            'reelStrip9_6' => [], 
            'reelStrip9_7' => [],
            'reelStrip10_1' => [], 
            'reelStrip10_2' => [], 
            'reelStrip10_3' => [], 
            'reelStrip10_4' => [], 
            'reelStrip10_5' => [], 
            'reelStrip10_6' => [], 
            'reelStrip10_7' => [],
            'reelStrip11_1' => [], 
            'reelStrip11_2' => [], 
            'reelStrip11_3' => [], 
            'reelStrip11_4' => [], 
            'reelStrip11_5' => [], 
            'reelStrip11_6' => [], 
            'reelStrip11_7' => [],
            'reelStrip12_1' => [], 
            'reelStrip12_2' => [], 
            'reelStrip12_3' => [], 
            'reelStrip12_4' => [], 
            'reelStrip12_5' => [], 
            'reelStrip12_6' => [], 
            'reelStrip12_7' => [],
            'reelStrip13_1' => [], 
            'reelStrip13_2' => [], 
            'reelStrip13_3' => [], 
            'reelStrip13_4' => [], 
            'reelStrip13_5' => [], 
            'reelStrip13_6' => [], 
            'reelStrip13_7' => [],
            'reelStrip14_1' => [], 
            'reelStrip14_2' => [], 
            'reelStrip14_3' => [], 
            'reelStrip14_4' => [], 
            'reelStrip14_5' => [], 
            'reelStrip14_6' => [], 
            'reelStrip14_7' => []
        ];
        public function __construct()
        {
            $temp = file(base_path() . '/app/Games/MadameDestinyMegaways/reels.txt');
            foreach( $temp as $str ) 
            {
                $str = explode('=', $str);
                if( isset($this->reelsStrip[$str[0]]) ) 
                {
                    $data = explode(',', $str[1]);
                    foreach( $data as $elem ) 
                    {
                        $elem = trim($elem);
                        if( $elem != '' ) 
                        {
                            $this->reelsStrip[$str[0]][] = $elem;
                        }
                    }
                }
            }
        }
    }

}
