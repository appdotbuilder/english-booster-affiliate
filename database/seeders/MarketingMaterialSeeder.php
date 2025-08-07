<?php

namespace Database\Seeders;

use App\Models\MarketingMaterial;
use Illuminate\Database\Seeder;

class MarketingMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            // Banners
            [
                'title' => 'English Booster Banner - General',
                'type' => 'banner',
                'format' => 'jpg',
                'content' => null,
                'file_path' => '/banners/english-booster-general.jpg',
                'dimensions' => ['width' => 1200, 'height' => 400],
                'program_types' => ['online', 'offline'],
                'description' => 'General English Booster promotional banner',
            ],
            [
                'title' => 'TOEFL Program Banner',
                'type' => 'banner',
                'format' => 'jpg',
                'content' => null,
                'file_path' => '/banners/toefl-program.jpg',
                'dimensions' => ['width' => 1200, 'height' => 400],
                'program_types' => ['online', 'offline'],
                'description' => 'TOEFL preparation program banner',
            ],
            [
                'title' => 'Kids English Square Banner',
                'type' => 'banner',
                'format' => 'jpg',
                'content' => null,
                'file_path' => '/banners/kids-english-square.jpg',
                'dimensions' => ['width' => 800, 'height' => 800],
                'program_types' => ['online', 'branch'],
                'description' => 'Instagram-ready square banner for kids programs',
            ],
            [
                'title' => 'Branch Programs Banner',
                'type' => 'banner',
                'format' => 'jpg',
                'content' => null,
                'file_path' => '/banners/branch-programs.jpg',
                'dimensions' => ['width' => 1200, 'height' => 400],
                'program_types' => ['branch'],
                'description' => 'Promotional banner for all branch programs',
            ],

            // Captions
            [
                'title' => 'Instagram Caption - General English',
                'type' => 'caption',
                'format' => 'text',
                'content' => '🎯 Mau jago bahasa Inggris? Join English Booster sekarang!

✅ Metode pembelajaran terbukti efektif
✅ Instruktur berpengalaman
✅ Materi up-to-date
✅ Sertifikat resmi

📍 Jl. Asparaga No.100, Tegalsari, Tulungrejo, Pare, Kediri
📞 0822-3105-0500
📱 @kampunginggrisbooster

#EnglishBooster #BelajarBahasaInggris #KampungInggris #PareKediri #EnglishCourse #TOEFL #SpeakingClass

Daftar sekarang dan dapatkan promo menarik! 🔥',
                'file_path' => null,
                'dimensions' => null,
                'program_types' => ['online', 'offline'],
                'description' => 'General Instagram caption for English programs',
            ],
            [
                'title' => 'Facebook Caption - Kids Program',
                'type' => 'caption',
                'format' => 'text',
                'content' => '👶 Program English Booster untuk Anak-Anak! 👶

Biarkan si kecil belajar bahasa Inggris dengan cara yang menyenangkan:
🌟 Metode bermain sambil belajar
🌟 Materi yang disesuaikan untuk anak
🌟 Guru yang sabar dan berpengalaman
🌟 Suasana kelas yang ceria dan interaktif

Program tersedia:
📱 Online Class (fleksibel dari rumah)
🏫 Offline Class di berbagai cabang

Info dan pendaftaran:
📞 0822-3105-0500
📍 Jl. Asparaga No.100, Tegalsari, Tulungrejo, Pare, Kediri

#EnglishForKids #BelajarBahasaInggrisAnak #EnglishBooster #KampungInggris',
                'file_path' => null,
                'dimensions' => null,
                'program_types' => ['online', 'branch'],
                'description' => 'Facebook caption specifically for kids programs',
            ],
            [
                'title' => 'WhatsApp Story - TOEFL Prep',
                'type' => 'caption',
                'format' => 'text',
                'content' => '🎯 TARGET SKOR TOEFL TINGGI?

English Booster punya program TOEFL Preparation yang tepat untuk kamu!

✅ Materi lengkap (Reading, Listening, Speaking, Writing)
✅ Try Out berkala
✅ Tips dan trik mengerjakan soal
✅ Garansi peningkatan skor

📞 Info: 0822-3105-0500
📱 @kampunginggrisbooster

#TOEFLPrep #EnglishBooster #BelajarTOEFL',
                'file_path' => null,
                'dimensions' => null,
                'program_types' => ['online', 'offline'],
                'description' => 'WhatsApp story caption for TOEFL preparation',
            ],
            [
                'title' => 'LinkedIn Caption - Professional',
                'type' => 'caption',
                'format' => 'text',
                'content' => '🚀 Boost Your Career with Better English Skills!

English Booster offers professional English courses designed for working professionals:

✅ Business English Communication
✅ Presentation Skills
✅ Industry-Specific Vocabulary
✅ Flexible Schedule (Online & Offline)
✅ Experienced Native & Local Instructors

Special Programs:
🛳️ Cruise Ship English
💻 RPL Software Engineering English
🎓 TOEFL Preparation

Contact us:
📞 0822-3105-0500
📧 info@englishbooster.com
📍 Jl. Asparaga No.100, Tegalsari, Tulungrejo, Pare, Kediri

#ProfessionalEnglish #CareerDevelopment #EnglishBooster #BusinessEnglish',
                'file_path' => null,
                'dimensions' => null,
                'program_types' => ['online', 'offline'],
                'description' => 'Professional LinkedIn caption for career-focused programs',
            ],

            // Posters
            [
                'title' => 'English Booster Course Poster',
                'type' => 'poster',
                'format' => 'jpg',
                'content' => null,
                'file_path' => '/posters/course-poster.jpg',
                'dimensions' => ['width' => 600, 'height' => 800],
                'program_types' => ['online', 'offline', 'branch'],
                'description' => 'General course information poster',
            ],
            [
                'title' => 'Group Program Poster',
                'type' => 'poster',
                'format' => 'jpg',
                'content' => null,
                'file_path' => '/posters/group-program.jpg',
                'dimensions' => ['width' => 600, 'height' => 800],
                'program_types' => ['group'],
                'description' => 'Poster for school and institutional group programs',
            ],

            // Videos
            [
                'title' => 'English Booster Introduction Video',
                'type' => 'video',
                'format' => 'mp4',
                'content' => null,
                'file_path' => '/videos/introduction.mp4',
                'preview_image' => '/videos/previews/introduction-preview.jpg',
                'dimensions' => ['width' => 1920, 'height' => 1080],
                'program_types' => ['online', 'offline', 'branch', 'group'],
                'description' => 'General introduction video about English Booster',
            ],
            [
                'title' => 'Student Testimonials Video',
                'type' => 'video',
                'format' => 'mp4',
                'content' => null,
                'file_path' => '/videos/testimonials.mp4',
                'preview_image' => '/videos/previews/testimonials-preview.jpg',
                'dimensions' => ['width' => 1920, 'height' => 1080],
                'program_types' => ['online', 'offline', 'branch'],
                'description' => 'Success stories and testimonials from students',
            ],

            // Landing Pages
            [
                'title' => 'TOEFL Landing Page Template',
                'type' => 'landing_page',
                'format' => 'html',
                'content' => '<div class="toefl-landing">
    <h1>🎯 TOEFL Preparation Program</h1>
    <p>Achieve your target TOEFL score with English Booster comprehensive preparation program!</p>
    <ul>
        <li>✅ Complete materials (Reading, Listening, Speaking, Writing)</li>
        <li>✅ Regular practice tests</li>
        <li>✅ Expert tips and strategies</li>
        <li>✅ Score improvement guarantee</li>
    </ul>
    <a href="#register" class="cta-button">Register Now!</a>
</div>',
                'file_path' => null,
                'dimensions' => null,
                'program_types' => ['online', 'offline'],
                'description' => 'Dedicated landing page template for TOEFL programs',
            ],
            [
                'title' => 'Kids Program Landing Page',
                'type' => 'landing_page',
                'format' => 'html',
                'content' => '<div class="kids-landing">
    <h1>👶 Fun English Learning for Kids! 👶</h1>
    <p>Let your children learn English through fun and interactive methods!</p>
    <ul>
        <li>🌟 Learning through games and activities</li>
        <li>🌟 Age-appropriate materials</li>
        <li>🌟 Patient and experienced teachers</li>
        <li>🌟 Fun and interactive classroom environment</li>
    </ul>
    <a href="#register" class="cta-button">Enroll Your Child Today!</a>
</div>',
                'file_path' => null,
                'dimensions' => null,
                'program_types' => ['online', 'branch'],
                'description' => 'Landing page template specifically for children programs',
            ],
        ];

        foreach ($materials as $material) {
            MarketingMaterial::create($material);
        }
    }
}