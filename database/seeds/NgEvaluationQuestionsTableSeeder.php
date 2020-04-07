<?php

use Illuminate\Database\Seeder;

class NgEvaluationQuestionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('ng_evaluation_questions')->delete();

        \DB::table('ng_evaluation_questions')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'position' => '১',
                    'question' => 'বুদ্ধিমত্তা ও মানসিক তৎপরতা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'position' => '২',
                    'question' => 'পেশাগত জ্ঞান',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            2 =>
                array(
                    'id' => 3,
                    'position' => '৩',
                    'question' => 'প্রকাশ ক্ষমতা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            3 =>
                array(
                    'id' => 4,
                    'position' => '৩ (ক)',
                    'question' => 'লিখন',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            4 =>
                array(
                    'id' => 5,
                    'position' => '৩ (খ)',
                    'question' => 'বচন',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            5 =>
                array(
                    'id' => 6,
                    'position' => '৪',
                    'question' => 'উদ্যোগ',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            6 =>
                array(
                    'id' => 7,
                    'position' => '৫',
                    'question' => 'কাজের মান ও পরিমাণ',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            7 =>
                array(
                    'id' => 8,
                    'position' => '৬',
                    'question' => 'সহযোগিতা ও বিচক্ষণতা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            8 =>
                array(
                    'id' => 9,
                    'position' => '৭',
                    'question' => 'আগ্রহ ও পরিশ্রম',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            9 =>
                array(
                    'id' => 10,
                    'position' => '৮',
                    'question' => 'অধীনস্থদিগকে তদারকি, পরিচালনা ও প্রশিক্ষণ দানের ক্ষমতা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            10 =>
                array(
                    'id' => 11,
                    'position' => '৯',
                    'question' => 'দায়িত্ববোধ',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            11 =>
                array(
                    'id' => 12,
                    'position' => '৯ (ক)',
                    'question' => 'সাধারণ',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            12 =>
                array(
                    'id' => 13,
                    'position' => '৯ (খ)',
                    'question' => 'আর্থিক বিষয়ে',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            13 =>
                array(
                    'id' => 14,
                    'position' => '১০',
                    'question' => 'সততা ও সুনাম',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            14 =>
                array(
                    'id' => 15,
                    'position' => '১১',
                    'question' => 'ব্যক্তিত্ব ও চরিত্রবল',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            15 =>
                array(
                    'id' => 16,
                    'position' => '১২',
                    'question' => 'স্বাস্থ্য',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            16 =>
                array(
                    'id' => 17,
                    'position' => '১৩',
                    'question' => 'সময়ানুবর্তিতা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            17 =>
                array(
                    'id' => 18,
                    'position' => '১৪',
                    'question' =>  'শৃংখলাবোধ',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            18 =>
                array(
                    'id' => 19,
                    'position' => '১৫',
                    'question' => 'বাংলা ভাষা ব্যবহারে আগ্রহ ও দক্ষতা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            19 =>
                array(
                    'id' => 20,
                    'position' => '১৬',
                    'question' => NULL,
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            20 =>
                array(
                    'id' => 21,
                    'position' => '১৭',
                    'question' => NULL,
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            21 =>
                array(
                    'id' => 22,
                    'position' => '১৮',
                    'question' => NULL,
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            22 =>
                array(
                    'id' => 23,
                    'position' => '১৯',
                    'question' => NULL,
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
        ));


    }
}
