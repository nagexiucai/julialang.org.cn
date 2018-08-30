<?php

use App\Models\Topic;

/**
 * Created by PhpStorm.
 * User: rex
 * Email: caoliang@simpleedu.com.cn
 * Date: 2018/8/30
 * Time: 1:26 PM
 */

class FreshTopicSeeder extends \Illuminate\Database\Seeder
{

    public function run()
    {
        Topic::insert(self::_data());
    }

    private static function _data() {
        return [
            [
                'title' => 'abc',
                'body' => 'def',
                'user_id' => 1,
                'category_id' => 1,
                'excerpt' => 'abstract',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'abc',
                'body' => 'def',
                'user_id' => 1,
                'category_id' => 1,
                'excerpt' => 'abstract',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];
    }
}