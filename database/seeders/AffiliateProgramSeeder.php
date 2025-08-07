<?php

namespace Database\Seeders;

use App\Models\AffiliateProgram;
use Illuminate\Database\Seeder;

class AffiliateProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            // Online Programs
            [
                'name' => 'Kids English Online',
                'type' => 'online',
                'category' => 'Kids',
                'description' => 'Interactive English program specially designed for kids',
                'base_price' => 500000,
                'commission_rate' => 15.00,
            ],
            [
                'name' => 'Teen English Online',
                'type' => 'online',
                'category' => 'Teen',
                'description' => 'Modern English learning for teenagers',
                'base_price' => 750000,
                'commission_rate' => 15.00,
            ],
            [
                'name' => 'TOEFL Preparation Online',
                'type' => 'online',
                'category' => 'TOEFL',
                'description' => 'Comprehensive TOEFL preparation course',
                'base_price' => 1200000,
                'commission_rate' => 20.00,
            ],
            [
                'name' => 'Easy Peasy English',
                'type' => 'online',
                'category' => 'Easy Peasy',
                'description' => 'Simple and fun English learning approach',
                'base_price' => 400000,
                'commission_rate' => 12.00,
            ],
            [
                'name' => 'Private English Tutoring',
                'type' => 'online',
                'category' => 'Private',
                'description' => 'One-on-one personalized English lessons',
                'base_price' => 2000000,
                'commission_rate' => 25.00,
            ],
            [
                'name' => 'General English Online',
                'type' => 'online',
                'category' => 'General English',
                'description' => 'Comprehensive general English course',
                'base_price' => 800000,
                'commission_rate' => 15.00,
            ],
            [
                'name' => 'Speaking Booster',
                'type' => 'online',
                'category' => 'Speaking Booster',
                'description' => 'Intensive speaking skills improvement',
                'base_price' => 600000,
                'commission_rate' => 18.00,
            ],
            [
                'name' => 'Grammar Booster',
                'type' => 'online',
                'category' => 'Grammar Booster',
                'description' => 'Master English grammar fundamentals',
                'base_price' => 500000,
                'commission_rate' => 15.00,
            ],

            // Offline Programs (Kediri)
            [
                'name' => 'English Intensive 2 Weeks',
                'type' => 'offline',
                'category' => '2-week',
                'location' => 'Kediri',
                'description' => 'Intensive 2-week English bootcamp in Kediri',
                'base_price' => 1500000,
                'commission_rate' => 20.00,
            ],
            [
                'name' => 'English Program 1 Month',
                'type' => 'offline',
                'category' => '1-month',
                'location' => 'Kediri',
                'description' => 'Comprehensive 1-month English program',
                'base_price' => 2500000,
                'commission_rate' => 22.00,
            ],
            [
                'name' => 'English Program 2 Months',
                'type' => 'offline',
                'category' => '2-month',
                'location' => 'Kediri',
                'description' => 'Extended 2-month English immersion',
                'base_price' => 4000000,
                'commission_rate' => 25.00,
            ],
            [
                'name' => 'English Program 3 Months',
                'type' => 'offline',
                'category' => '3-month',
                'location' => 'Kediri',
                'description' => 'Complete 3-month English mastery program',
                'base_price' => 5500000,
                'commission_rate' => 28.00,
            ],
            [
                'name' => 'TOEFL Offline Kediri',
                'type' => 'offline',
                'category' => 'TOEFL',
                'location' => 'Kediri',
                'description' => 'TOEFL preparation in Kediri campus',
                'base_price' => 2000000,
                'commission_rate' => 22.00,
            ],
            [
                'name' => 'RPL Software Engineering',
                'type' => 'offline',
                'category' => 'RPL',
                'location' => 'Kediri',
                'description' => 'English for Software Engineering professionals',
                'base_price' => 3000000,
                'commission_rate' => 25.00,
            ],
            [
                'name' => 'Cruise Ship English',
                'type' => 'offline',
                'category' => 'Cruise Ship',
                'location' => 'Kediri',
                'description' => 'Specialized English for cruise ship industry',
                'base_price' => 3500000,
                'commission_rate' => 30.00,
            ],

            // Group Programs
            [
                'name' => 'English Trip for Schools',
                'type' => 'group',
                'category' => 'English Trip',
                'description' => 'Educational English trip for school groups',
                'base_price' => 5000000,
                'commission_rate' => 15.00,
            ],
            [
                'name' => 'Special English Day',
                'type' => 'group',
                'category' => 'Special English Day',
                'description' => 'One-day intensive English event for institutions',
                'base_price' => 2000000,
                'commission_rate' => 18.00,
            ],
            [
                'name' => 'Tutor Visit Program',
                'type' => 'group',
                'category' => 'Tutor Visit',
                'description' => 'On-site English tutoring for institutions',
                'base_price' => 3000000,
                'commission_rate' => 20.00,
            ],

            // Branch Programs - Malang
            [
                'name' => 'Cilukba Pre-school Malang',
                'type' => 'branch',
                'category' => 'Cilukba',
                'location' => 'Malang',
                'description' => 'English for pre-school and kindergarten in Malang',
                'base_price' => 800000,
                'commission_rate' => 15.00,
            ],
            [
                'name' => 'Hompimpa Elementary Malang',
                'type' => 'branch',
                'category' => 'Hompimpa',
                'location' => 'Malang',
                'description' => 'English program for elementary school students in Malang',
                'base_price' => 1000000,
                'commission_rate' => 18.00,
            ],
            [
                'name' => 'Hip Hip Hurray Junior High Malang',
                'type' => 'branch',
                'category' => 'Hip Hip Hurray',
                'location' => 'Malang',
                'description' => 'English program for junior high school students in Malang',
                'base_price' => 1200000,
                'commission_rate' => 20.00,
            ],
            [
                'name' => 'Insight Out Senior High Malang',
                'type' => 'branch',
                'category' => 'Insight Out',
                'location' => 'Malang',
                'description' => 'English program for senior high school students in Malang',
                'base_price' => 1500000,
                'commission_rate' => 22.00,
            ],

            // Branch Programs - Sidoarjo
            [
                'name' => 'Cilukba Pre-school Sidoarjo',
                'type' => 'branch',
                'category' => 'Cilukba',
                'location' => 'Sidoarjo',
                'description' => 'English for pre-school and kindergarten in Sidoarjo',
                'base_price' => 800000,
                'commission_rate' => 15.00,
            ],
            [
                'name' => 'Hompimpa Elementary Sidoarjo',
                'type' => 'branch',
                'category' => 'Hompimpa',
                'location' => 'Sidoarjo',
                'description' => 'English program for elementary school students in Sidoarjo',
                'base_price' => 1000000,
                'commission_rate' => 18.00,
            ],
            [
                'name' => 'Hip Hip Hurray Junior High Sidoarjo',
                'type' => 'branch',
                'category' => 'Hip Hip Hurray',
                'location' => 'Sidoarjo',
                'description' => 'English program for junior high school students in Sidoarjo',
                'base_price' => 1200000,
                'commission_rate' => 20.00,
            ],
            [
                'name' => 'Insight Out Senior High Sidoarjo',
                'type' => 'branch',
                'category' => 'Insight Out',
                'location' => 'Sidoarjo',
                'description' => 'English program for senior high school students in Sidoarjo',
                'base_price' => 1500000,
                'commission_rate' => 22.00,
            ],

            // Branch Programs - Nganjuk
            [
                'name' => 'Cilukba Pre-school Nganjuk',
                'type' => 'branch',
                'category' => 'Cilukba',
                'location' => 'Nganjuk',
                'description' => 'English for pre-school and kindergarten in Nganjuk',
                'base_price' => 800000,
                'commission_rate' => 15.00,
            ],
            [
                'name' => 'Hompimpa Elementary Nganjuk',
                'type' => 'branch',
                'category' => 'Hompimpa',
                'location' => 'Nganjuk',
                'description' => 'English program for elementary school students in Nganjuk',
                'base_price' => 1000000,
                'commission_rate' => 18.00,
            ],
            [
                'name' => 'Hip Hip Hurray Junior High Nganjuk',
                'type' => 'branch',
                'category' => 'Hip Hip Hurray',
                'location' => 'Nganjuk',
                'description' => 'English program for junior high school students in Nganjuk',
                'base_price' => 1200000,
                'commission_rate' => 20.00,
            ],
            [
                'name' => 'Insight Out Senior High Nganjuk',
                'type' => 'branch',
                'category' => 'Insight Out',
                'location' => 'Nganjuk',
                'description' => 'English program for senior high school students in Nganjuk',
                'base_price' => 1500000,
                'commission_rate' => 22.00,
            ],
        ];

        foreach ($programs as $program) {
            AffiliateProgram::create($program);
        }
    }
}