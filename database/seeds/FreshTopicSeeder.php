<?php

use App\Models\Topic;

class FreshTopicSeeder extends \Illuminate\Database\Seeder
{

    public function run()
    {
        Topic::insert(self::_data());
    }

    private static function _data() {
        return [
            [
                'title' => 'Hi, Julia!',
                'body' => 'Hi, Julia!',
                'user_id' => 1,
                'category_id' => 4,
                'excerpt' => 'abstract',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];
    }
}