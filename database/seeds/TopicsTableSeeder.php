<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Topic;
use App\Models\User;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        //获取所有用户的 ID 数组, 如:[1,2,3]
        $user_ids = User::all()->pluck('id')->toArray();

        //获取所有分类 ID 数组,如:[1,2,3]
        $category_ids = Category::all()->pluck('id')->toArray();

        //获取faker实例
        $faker = app(Faker\Generator::class);


        $topics = factory(Topic::class)
                    ->times(100)
                    ->make()
                    ->each(function ($topic, $index) use($user_ids,$category_ids,$faker)
                    {
                        // 从用户 ID 数组中随机取出一个并赋值
                        $topic->user_id = $faker->randomElememnt($user_ids);

                        $topic->category_id = $faker->randomElememnt($category_ids);
                    });

        Topic::insert($topics->toArray());
    }

}

