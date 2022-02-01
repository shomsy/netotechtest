<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $words = "Cool,Strange,Funny,Laughing,Nice,Awesome,Great,Horrible,Beautiful,PHP,Vegeta,Italy,Joost";
        $allWords = explode(',', $words);

        $lengthOfWords = count($allWords);
        $commentData = [];

        for ($i = 1; $i < (1 << $lengthOfWords); $i++) {
            $combination = '';
            $abbreviations = '';

            for ($j = 0; $j < $lengthOfWords; $j++) {
                if ($i & (1 << $j)) {
                    $word = $allWords[$j];
                    $abbreviations .= Str::lower($word)[0];
                    $combination .= $word.' ';
                    $combination = Str::lower($combination);
                }
            }

            $commentData[] = [
                'post_id' => Post::inRandomOrder()->first()->id,
                'content' => $combination,
                'abbreviation' => $abbreviations
            ];
        }

        Comment::insert($commentData);
    }
}
