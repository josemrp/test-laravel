<?php

use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\Types\Null_;

class ArticlesTableSeeder extends Seeder
{
    private function random_text($limit) {
        $n = rand(1, $limit);
        $txt = $this->random_word();
        for ($i=0; $i < $n; $i++) { 
            $txt .= ' ' . $this->random_word();
        }
        return $txt;
    }
    private function random_word() {
        $n = rand(4, 10);
        return str_random($n);
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 20; $i++) {
            DB::table('articles')->insert([
                'title' => $this->random_text(12),
                'content' => $this->random_text(600)
            ]);
        }
    }
}
