<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Profile::create([
            'name' => 'Muhammad Najwan Busaman',
            'title' => 'Front End Developer and UI UX Enthusiast',
            'bio' => 'Mahasiswa IT tingkat akhir dengan minat mendalam pada pengembangan backend. Berpengalaman memimpin tim sebagai Project Manager dan mengelola sistem administrasi.',
            'github_link' => 'https://github.com/Najwan48',
            'linkedin_link' => 'https://linkedin.com/in/budisantoso',
        ]);

        Experience::create([
            'company_or_organization' => 'Himpunan Mahasiswa Informatika',
            'role' => 'Project Manager',
            'description' => 'Memimpin tim pengembang beranggotakan 5 orang dalam membangun aplikasi manajemen kampus. Mengelola timeline, sprint, dan distribusi tugas.',
            'start_date' => '2024-01-01',
            'end_date' => '2025-01-01',
        ]);

        Experience::create([
            'company_or_organization' => 'Fakultas Ilmu Komputer',
            'role' => 'Staf Administrasi IT',
            'description' => 'Mengelola infrastruktur jaringan, merawat server lokal, dan memberikan dukungan teknis kepada staf dan mahasiswa.',
            'start_date' => '2023-06-01',
            'end_date' => '2023-12-31',
        ]);

        Experience::create([
            'company_or_organization' => 'Tech Solutions Inc.',
            'role' => 'Back End Developer',
            'description' => 'Mengembangkan API, mengelola database relasional, dan mengoptimalkan performa server.',
            'start_date' => '2021-03-01',
            'end_date' => '2023-03-01',
        ]);

        Experience::create([
            'company_or_organization' => 'Creative Studio',
            'role' => 'UI/UX Designer',
            'description' => 'Mendesain antarmuka pengguna web dan aplikasi mobile, serta melakukan riset pengguna untuk meningkatkan pengalaman interaktif.',
            'start_date' => '2020-01-01',
            'end_date' => '2021-02-28',
        ]);

        Experience::create([
            'company_or_organization' => 'Hotel Monalisa',
            'role' => 'Front Office',
            'description' => 'Menangani reservasi tamu, memberikan pelayanan informasi, dan mengelola administrasi resepsionis.',
            'start_date' => '2019-01-01',
            'end_date' => '2020-01-01',
        ]);


        Project::create([
            'title' => 'Absensi Karyawan',
            'description' => 'Sistem manajemen absensi khusus untuk karyawan.',
            'tech_stack' => ['PHP', 'MySQL', 'Bootstrap'],
            'github_link' => 'https://github.com/Najwan48/absensi__karyawan',
            'image' => 'images/absensi_karyawan.jpg',
        ]);

        Project::create([
            'title' => 'Backend Uacademy',
            'description' => 'Sistem backend untuk platform pembelajaran Uacademy.',
            'tech_stack' => ['Laravel', 'REST API', 'MySQL'],
            'github_link' => 'https://github.com/Najwan48/backend-uacademy',
            'image' => 'images/backend_uacademy.jpg',
        ]);

        Project::create([
            'title' => 'Monalisa Resto',
            'description' => 'Aplikasi manajemen restoran Monalisa.',
            'tech_stack' => ['PHP', 'MySQL', 'HTML', 'CSS'],
            'github_link' => 'https://github.com/Najwan48/monalisa_resto',
            'image' => 'images/monalisa_resto.jpg',
        ]);

        $skills = [
            ['name' => 'Laravel', 'category' => 'Backend'],
            ['name' => 'PHP', 'category' => 'Backend'],
            ['name' => 'MySQL', 'category' => 'Database'],
            ['name' => 'PostgreSQL', 'category' => 'Database'],
            ['name' => 'Project Management', 'category' => 'Soft Skills'],
            ['name' => 'Git & GitHub', 'category' => 'Tools'],
            ['name' => 'Server Administration', 'category' => 'Tools'],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
