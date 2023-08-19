<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clubs = [
            1 => [
              'club_id' => '1',
              'club_type' => 'S',
              'club_code' => 'S03',
              'club_name_ch' => '學園團契',
              'club_name_en' => '學園團契',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            2 => [
              'club_id' => '2',
              'club_type' => 'S',
              'club_code' => 'S04',
              'club_name_ch' => '喜樂團契',
              'club_name_en' => '喜樂團契',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            3 => [
              'club_id' => '3',
              'club_type' => 'S',
              'club_code' => 'S05',
              'club_name_ch' => '中國傳統醫學研習社',
              'club_name_en' => '中國傳統醫學研習社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            4 => [
              'club_id' => '4',
              'club_type' => 'S',
              'club_code' => 'S06',
              'club_name_ch' => '崇德奇蹟青年社',
              'club_name_en' => '崇德奇蹟青年社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            5 => [
              'club_id' => '5',
              'club_type' => 'S',
              'club_code' => 'S07',
              'club_name_ch' => '青年領袖研習社',
              'club_name_en' => '青年領袖研習社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            6 => [
              'club_id' => '6',
              'club_type' => 'S',
              'club_code' => 'S08',
              'club_name_ch' => '天文社',
              'club_name_en' => '天文社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            7 => [
              'club_id' => '7',
              'club_type' => 'S',
              'club_code' => 'S09',
              'club_name_ch' => '晨興社',
              'club_name_en' => '晨興社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            8 => [
              'club_id' => '8',
              'club_type' => 'S',
              'club_code' => 'S10',
              'club_name_ch' => '中山團契',
              'club_name_en' => '中山團契',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            9 => [
              'club_id' => '9',
              'club_type' => 'S',
              'club_code' => 'S12',
              'club_name_ch' => '命學社',
              'club_name_en' => '命學社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            10 => [
              'club_id' => '10',
              'club_type' => 'S',
              'club_code' => 'S14',
              'club_name_ch' => '程式研習社',
              'club_name_en' => '程式研習社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            11 => [
              'club_id' => '11',
              'club_type' => 'S',
              'club_code' => 'S15',
              'club_name_ch' => '資安社',
              'club_name_en' => '資安社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            12 => [
              'club_id' => '12',
              'club_type' => 'S',
              'club_code' => 'S16',
              'club_name_ch' => '外語時事研討社',
              'club_name_en' => '外語時事研討社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            13 => [
              'club_id' => '13',
              'club_type' => 'Y',
              'club_code' => 'Y01',
              'club_name_ch' => '揚門樂社',
              'club_name_en' => '揚門樂社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            14 => [
              'club_id' => '14',
              'club_type' => 'Y',
              'club_code' => 'Y02',
              'club_name_ch' => '室內樂社',
              'club_name_en' => '室內樂社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            15 => [
              'club_id' => '15',
              'club_type' => 'Y',
              'club_code' => 'Y03',
              'club_name_ch' => '吉他社',
              'club_name_en' => '吉他社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            16 => [
              'club_id' => '16',
              'club_type' => 'Y',
              'club_code' => 'Y06',
              'club_name_ch' => '街頭文化社',
              'club_name_en' => '街頭文化社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            17 => [
              'club_id' => '17',
              'club_type' => 'Y',
              'club_code' => 'Y07',
              'club_name_ch' => '吱吱祭音樂社',
              'club_name_en' => '吱吱祭音樂社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            18 => [
              'club_id' => '18',
              'club_type' => 'I',
              'club_code' => 'I01',
              'club_name_ch' => '攝影社',
              'club_name_en' => '攝影社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            19 => [
              'club_id' => '19',
              'club_type' => 'I',
              'club_code' => 'I02',
              'club_name_ch' => '動畫社',
              'club_name_en' => '動畫社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            20 => [
              'club_id' => '20',
              'club_type' => 'I',
              'club_code' => 'I05',
              'club_name_ch' => '創意調酒社',
              'club_name_en' => '創意調酒社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            21 => [
              'club_id' => '21',
              'club_type' => 'F',
              'club_code' => 'F01',
              'club_name_ch' => '高雄圓山扶輪青年服務社',
              'club_name_en' => '高雄圓山扶輪青年服務社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            22 => [
              'club_id' => '22',
              'club_type' => 'K',
              'club_code' => 'K01',
              'club_name_ch' => '舞蹈社',
              'club_name_en' => '舞蹈社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            23 => [
              'club_id' => '23',
              'club_type' => 'K',
              'club_code' => 'K02',
              'club_name_ch' => '勁舞社',
              'club_name_en' => '勁舞社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            24 => [
              'club_id' => '24',
              'club_type' => 'T',
              'club_code' => 'T01',
              'club_name_ch' => '射箭社',
              'club_name_en' => '射箭社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            25 => [
              'club_id' => '25',
              'club_type' => 'T',
              'club_code' => 'T03',
              'club_name_ch' => '八極螳螂拳社',
              'club_name_en' => '八極螳螂拳社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            26 => [
              'club_id' => '26',
              'club_type' => 'T',
              'club_code' => 'T04',
              'club_name_ch' => '山野社',
              'club_name_en' => '山野社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            27 => [
              'club_id' => '27',
              'club_type' => 'T',
              'club_code' => 'T05',
              'club_name_ch' => '風帆社',
              'club_name_en' => '風帆社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            28 => [
              'club_id' => '28',
              'club_type' => 'T',
              'club_code' => 'T06',
              'club_name_ch' => '網球社',
              'club_name_en' => '網球社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            29 => [
              'club_id' => '29',
              'club_type' => 'T',
              'club_code' => 'T07',
              'club_name_ch' => '瑜珈社',
              'club_name_en' => '瑜珈社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            30 => [
              'club_id' => '30',
              'club_type' => 'T',
              'club_code' => 'T08',
              'club_name_ch' => '潛水社',
              'club_name_en' => '潛水社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            31 => [
              'club_id' => '31',
              'club_type' => 'T',
              'club_code' => 'T12',
              'club_name_ch' => '飛盤社',
              'club_name_en' => '飛盤社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            32 => [
              'club_id' => '32',
              'club_type' => 'T',
              'club_code' => 'T13',
              'club_name_ch' => '競技卡牌研究社',
              'club_name_en' => '競技卡牌研究社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            33 => [
              'club_id' => '33',
              'club_type' => 'T',
              'club_code' => 'T15',
              'club_name_ch' => '釣魚社',
              'club_name_en' => '釣魚社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            34 => [
              'club_id' => '34',
              'club_type' => 'T',
              'club_code' => 'T16',
              'club_name_ch' => '二輪機械動力研習社',
              'club_name_en' => '二輪機械動力研習社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            35 => [
              'club_id' => '35',
              'club_type' => 'T',
              'club_code' => 'T17',
              'club_name_ch' => '撞球社',
              'club_name_en' => '撞球社',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
            36 => [
              'club_id' => '36',
              'club_type' => 'T',
              'club_code' => 'X01',
              'club_name_ch' => '學生會',
              'club_name_en' => '學生會',
              'created_at' => '2023-08-14 14:30:00',
              'updated_at' => '2023-08-14 14:30:00',
            ],
        ];
        \DB::table('clubs')->insert($clubs);
    }
}
