<?php

use Illuminate\Database\Seeder;

class EvaluationQuestionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('evaluation_questions')->delete();

        \DB::table('evaluation_questions')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'position' => '১',
                    'question' => 'ধীশক্তি ও মানসিক তৎপরতা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'position' => '২',
                    'question' => 'বিচার ক্ষমতা ও মাত্রাজ্ঞান',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            2 =>
                array(
                    'id' => 3,
                    'position' => '৩',
                    'question' => 'উদ্যোগ ও প্রচেষ্টা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            3 =>
                array(
                    'id' => 4,
                    'position' => '৪',
                    'question' => 'প্রকাশ ক্ষমতা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            4 =>
                array(
                    'id' => 5,
                    'position' => '৪ (ক)',
                    'question' => 'লিখন',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            5 =>
                array(
                    'id' => 6,
                    'position' => '৪ (খ)',
                    'question' => 'বচন',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            6 =>
                array(
                    'id' => 7,
                    'position' => '৫',
                    'question' => 'কাজের পরিকল্পনা, সংগঠন  ও তদারক ক্ষমতা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            7 =>
                array(
                    'id' => 8,
                    'position' => '৬',
                    'question' => 'কাজের মান ও পরিমান',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            8 =>
                array(
                    'id' => 9,
                    'position' => '৭',
                    'question' => 'অধ্যবসায় ও কর্তব্যনিষ্ঠা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            9 =>
                array(
                    'id' => 10,
                    'position' => '৮',
                    'question' => 'অধীনস্থদিগকে পরিচালনা ও প্রশিক্ষণ দানের ক্ষমতা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            10 =>
                array(
                    'id' => 11,
                    'position' => '৯',
                    'question' => 'সহযোগিতা ও বিচক্ষণতা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            11 =>
                array(
                    'id' => 12,
                    'position' => '১০',
                    'question' => 'সততা',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            12 =>
                array(
                    'id' => 13,
                    'position' => '১০ (ক)',
                    'question' => 'বুদ্ধিবৃত্তিক',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            13 =>
                array(
                    'id' => 14,
                    'position' => '১০ (খ)',
                    'question' => 'নৈতিক',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            14 =>
                array(
                    'id' => 15,
                    'position' => '১১',
                    'question' => 'দায়িত্বজ্ঞান',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            15 =>
                array(
                    'id' => 16,
                    'position' => '১১ (ক)',
                    'question' => 'সাধারণ',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            16 =>
                array(
                    'id' => 17,
                    'position' => '১১ (খ)',
                    'question' => 'আর্থিক বিষয়',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            17 =>
                array(
                    'id' => 18,
                    'position' => '১২',
                    'question' => 'ব্যক্তিত্ব',
                    'type' => 'primary',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            18 =>
                array(
                    'id' => 19,
                    'position' => '**১৩',
                    'question' => 'আদেশ পালনে তৎপরতা',
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            19 =>
                array(
                    'id' => 20,
                    'position' => '**১৪',
                    'question' => NULL,
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            20 =>
                array(
                    'id' => 21,
                    'position' => '**১৫',
                    'question' => NULL,
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            21 =>
                array(
                    'id' => 22,
                    'position' => '**১৬',
                    'question' => NULL,
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            22 =>
                array(
                    'id' => 23,
                    'position' => '**১৭',
                    'question' => NULL,
                    'type' => 'special',
                    'optional_answer_1' => NULL,
                    'optional_answer_2' => NULL,
                ),
            23 =>
                array(
                    'id' => 24,
                    'position' => '*১৮',
                    'question' => 'সমাজকল্যাণ আগ্রহ',
                    'type' => 'optional',
                    'optional_answer_1' => 'সমাজকল্যাণ কার্যাবলীতে আগ্রহী',
                    'optional_answer_2' => 'তাঁহার কর্তব্যের এই দিকটিকে রুটিন মাফিক দায়িত্ব হিসাবে গণ্য করার প্রবণতা রহিয়াছে',
                ),
            24 =>
                array(
                    'id' => 25,
                    'position' => '*১৯',
                    'question' => 'অর্থনৈতিক উন্নয়নে আগ্রহ',
                    'type' => 'optional',
                    'optional_answer_1' => 'উন্নয়ন প্রকল্প সমূহের প্রদিকল্পনা প্রণয়ন ও কার্জকারিকরনে আগ্রহী',
                    'optional_answer_2' => 'তাঁহার কর্তব্যের এই দিকটিকে রুটিন মাফিক দায়িত্ব হিসাবে গণ্য করার প্রবণতা রহিয়াছে',
                ),
            25 =>
                array(
                    'id' => 26,
                    'position' => '*২০',
                    'question' => 'জনসাধারণের সহিত ব্যবহার',
                    'type' => 'optional',
                    'optional_answer_1' => 'বিনয়ী  ও সহায়ক',
                    'optional_answer_2' => 'ঔদ্বত্যের প্রবণতা রহিয়াছে',
                ),
            26 =>
                array(
                    'id' => 27,
                    'position' => '২১',
                    'question' => 'জীবনযাত্রার মান',
                    'type' => 'optional',
                    'optional_answer_1' => 'আয়ের জ্ঞাত সামর্থের মধ্যে জীবিকা নির্বাহ করেন',
                    'optional_answer_2' => 'আয়ের জ্ঞাত সামর্থের বাহিরে জীবিকা নির্বাহের রিপোর্ট রহিয়াছে',
                ),
            27 =>
                array(
                    'id' => 28,
                    'position' => '২২',
                    'question' => 'নিরাপত্তা বিধি প্রতিপালন',
                    'type' => 'optional',
                    'optional_answer_1' => 'যুক্তিসঙ্গতভাবে সতর্কতামূলক ব্যবস্থা গ্রহণ করেন',
                    'optional_answer_2' => 'অবহেলার প্রবণতা রহিয়াছে',
                ),
            28 =>
                array(
                    'id' => 29,
                    'position' => '২৩',
                    'question' => 'সময়নিষ্ঠা',
                    'type' => 'optional',
                    'optional_answer_1' => 'সময়নিষ্ঠ',
                    'optional_answer_2' => 'সময়নিষ্ঠ নহেন',
                ),
            29 =>
                array(
                    'id' => 30,
                    'position' => '*২৪',
                    'question' => 'ভ্রমণ',
                    'type' => 'optional',
                    'optional_answer_1' => 'পর্যাপ্ত ও রীতিসম্মত',
                    'optional_answer_2' => 'অপর্যাপ্ত বা রীতিবহির্ভূত',
                ),
        ));


    }
}
