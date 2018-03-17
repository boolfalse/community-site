<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'PHP',
            'description' => 'PHP is a widely used, high-level, dynamic, object-oriented and interpreted scripting language primarily designed for server-side web development.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
            'name' => 'JavaScript',
            'description' => 'JavaScript (not to be confused with Java) is a high-level, dynamic, multi-paradigm, weakly-typed language used for both client-side and server-side scripting. Use this tag for questions regarding ECMAScript and its various dialects/implementations (excluding ActionScript and Google-Apps-Script).',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
            'name' => 'C',
            'description' => 'C is a general-purpose computer programming language used for operating systems, libraries, games and other high performance work. This tag should be used with general questions concerning the C language, as defined in the ISO 9899:2011 standard. ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
            'name' => 'C++',
            'description' => 'C++ is a general-purpose programming language. It was originally designed as an extension to C, and keeps a similar syntax, but is now a completely different language. Use this tag for questions about code (to be) compiled with a C++ compiler.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
            'name' => 'Java',
            'description' => 'Java (not to be confused with JavaScript or JScript) is a general-purpose object-oriented programming language designed to be used in conjunction with the Java Virtual Machine (JVM). "Java platform" is the name for a computing system that has installed tools for developing and running Java programs.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
            'name' => 'HTML',
            'description' => 'HTML (Hyper Text Markup Language) is the standard markup language used for structuring web pages and formatting content. HTML describes the structure of a website semantically along with cues for presentation, making it a markup language, rather than a programming language. ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
            'name' => 'jQuery',
            'description' => 'jQuery is a popular cross-browser JavaScript library that facilitates Document Object Model (DOM) traversal, event handling, animations, and AJAX interactions by minimizing the discrepancies across browsers.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
            'name' => 'CSS',
            'description' => 'CSS (Cascading Style Sheets) is a representation style sheet language used for describing the look and formatting of HTML (Hyper Text Markup Language), XML (Extensible Markup Language) documents and SVG elements including (but not limited to) colors, layout, fonts and animations.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
