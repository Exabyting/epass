<?php

use Illuminate\Database\Seeder;

class GcoEvaluationQuestionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('gco_evaluation_questions')->delete();

        \DB::table('gco_evaluation_questions')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'position' => '২.১',
                    'question' => 'শৃঙ্খলাবোধ',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'position' => '২.২',
                    'question' => 'বিচার ও মাত্রাজ্ঞান',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            2 =>
                array(
                    'id' => 3,
                    'position' => '২.৩',
                    'question' => 'বুদ্ধিমত্তা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            3 =>
                array(
                    'id' => 4,
                    'position' => '২.৪',
                    'question' => 'উদ্যম ও উদ্যোগ',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            4 =>
                array(
                    'id' => 5,
                    'position' => '২.৫',
                    'question' => 'ব্যক্তিত্ব',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            5 =>
                array(
                    'id' => 6,
                    'position' => '২.৬',
                    'question' => 'সহযোগিতা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            6 =>
                array(
                    'id' => 7,
                    'position' => '২.৭',
                    'question' => 'সময়ানুবর্তিতা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            7 =>
                array(
                    'id' => 8,
                    'position' => '২.৮',
                    'question' => 'নির্ভরযোগ্যতা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            8 =>
                array(
                    'id' => 9,
                    'position' => '২.৯',
                    'question' => 'দায়িত্ববোধ',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' =>NULL,
                ),
            9 =>
                array(
                    'id' => 10,
                    'position' => '২.১০',
                    'question' => 'কাজে আগ্রহ',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            10 =>
                array(
                    'id' => 11,
                    'position' => '২.১১',
                    'question' => 'ব্যবস্থা গ্রহণে ও আদেশ পালনে তৎপরতা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            11 =>
                array(
                    'id' => 12,
                    'position' => '২.১২',
                    'question' => 'নিরাপত্তা সচেতনতা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            12 =>
                array(
                    'id' => 13,
                    'position' => '২.১৩',
                    'question' => 'জনসাধারণের সহিত ব্যবহার',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            13 =>
                array(
                    'id' => 14,
                    'position' => '৩.১',
                    'question' => 'পেশাগত জ্ঞান',
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            14 =>
                array(
                    'id' => 15,
                    'position' => '৩.২ ',
                    'question' => 'কাজের মান',
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            15 =>
                array(
                    'id' => 16,
                    'position' => '৩.৩',
                    'question' => 'সম্পাদিত কাজের পরিমাণ',
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            16 =>
                array(
                    'id' => 17,
                    'position' => '৩.৪',
                    'question' => 'তদারকি ও পরিচালনায় সামর্থ্য',
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            17 =>
                array(
                    'id' => 18,
                    'position' => '৩.৫',
                    'question' =>  'সহকর্মীদের সহিত সম্পর্ক',
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            18 =>
                array(
                    'id' => 19,
                    'position' => '৩.৬',
                    'question' => 'সিদ্ধান্ত গ্রহণের দক্ষতা',
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            19 =>
                array(
                    'id' => 20,
                    'position' => '৩.৭',
                    'question' => 'সিদ্ধান্ত বাস্তবায়নের সামর্থ্য',
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            20 =>
                array(
                    'id' => 21,
                    'position' => '৩.৮',
                    'question' => 'অধীনস্থদের প্রশিক্ষণ দানে আগ্রহ ও দক্ষতা',
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            21 =>
                array(
                    'id' => 22,
                    'position' => '৩.৯',
                    'question' => 'প্রকাশ ক্ষমতা (লিখন)',
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            22 =>
                array(
                    'id' => 23,
                    'position' => '৩.১০',
                    'question' => 'প্রকাশ ক্ষমতা (বাচনিক)',
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            23 =>
                array(
                    'id' => 24,
                    'position' => '৩.১১',
                    'question' => 'বার্ষিক গোপনীয় অনুবেদন লিখন ও প্রতিস্বাক্ষরকরণে তৎপরতা',
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            24 =>
                array(
                    'id' => 25,
                    'position' => '৩.১২',
                    'question' => 'কর্তব্যনিষ্ঠা',
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
        ));


    }
}
