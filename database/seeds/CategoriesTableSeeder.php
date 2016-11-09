<?php

use Illuminate\Database\Seeder;
use App\Models\Categry;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $php = Categry::create([
            'parent_id' => 0,
            'name'      => 'PHP',
            'sort'      => 0,
            'preview'   => '',
        ]);

        $js = Categry::create([
            'parent_id' => 0,
            'name'      => 'javascript',
            'sort'      => 0,
            'preview'   => '',
        ]);

        $java = Categry::create([
            'parent_id' => 0,
            'name'      => 'Java',
            'sort'      => 0,
            'preview'   => '',
        ]);

        Categry::create([
            'parent_id' => $php->id,
            'name'      => 'Laravel',
            'sort'      => 1,
            'preview'   => '',
        ]);

        Categry::create([
            'parent_id' => $php->id,
            'name'      => 'ThinkPHP',
            'sort'      => 2,
            'preview'   => '',
        ]);

        Categry::create([
            'parent_id' => $php->id,
            'name'      => 'Yii',
            'sort'      => 3,
            'preview'   => '',
        ]);

        Categry::create([
            'parent_id' => $js->id,
            'name'      => 'Angular.js',
            'sort'      => 1,
            'preview'   => '',
        ]);

        Categry::create([
            'parent_id' => $js->id,
            'name'      => 'Vue.js',
            'sort'      => 2,
            'preview'   => '',
        ]);

        Categry::create([
            'parent_id' => $js->id,
            'name'      => 'React.js',
            'sort'      => 3,
            'preview'   => '',
        ]);

        Categry::create([
            'parent_id' => $java->id,
            'name'      => 'Spring',
            'sort'      => 1,
            'preview'   => '',
        ]);

        Categry::create([
            'parent_id' => $java->id,
            'name'      => 'Struts2',
            'sort'      => 2,
            'preview'   => '',
        ]);

        Categry::create([
            'parent_id' => $java->id,
            'name'      => 'Hibernate',
            'sort'      => 3,
            'preview'   => '',
        ]);
    }
}
