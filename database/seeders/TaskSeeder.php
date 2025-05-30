<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Subtask;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = [
            [
                'title' => 'Menyelesaikan Proyek Website',
                'notes' => 'Proyek pengembangan website untuk klien ABC dengan fitur e-commerce',
                'priority' => 'high',
                'status' => 'pending',
                'deadline' => Carbon::now()->addDays(7),
                'subtasks' => [
                    'Desain mockup halaman utama',
                    'Implementasi sistem login',
                    'Integrasi payment gateway',
                    'Testing dan debugging'
                ]
            ],
            [
                'title' => 'Presentasi Laporan Bulanan',
                'notes' => 'Menyiapkan presentasi laporan kinerja tim untuk meeting bulanan',
                'priority' => 'medium',
                'status' => 'pending',
                'deadline' => Carbon::now()->addDays(3),
                'subtasks' => [
                    'Mengumpulkan data statistik',
                    'Membuat slide presentasi',
                    'Review dengan supervisor'
                ]
            ],
            [
                'title' => 'Belajar Framework Laravel',
                'notes' => 'Memperdalam pengetahuan Laravel untuk project mendatang',
                'priority' => 'low',
                'status' => 'pending',
                'deadline' => Carbon::now()->addDays(14),
                'subtasks' => [
                    'Membaca dokumentasi Laravel',
                    'Mengikuti tutorial online',
                    'Membuat project latihan'
                ]
            ],
            [
                'title' => 'Meeting dengan Tim Marketing',
                'notes' => 'Diskusi strategi pemasaran produk baru untuk Q2',
                'priority' => 'high',
                'status' => 'completed',
                'deadline' => Carbon::now()->subDays(1),
                'completed_at' => Carbon::now()->subDays(1),
                'subtasks' => [
                    'Menyiapkan agenda meeting',
                    'Review hasil riset pasar',
                    'Presentasi strategi'
                ]
            ],
            [
                'title' => 'Update Dokumentasi API',
                'notes' => 'Memperbarui dokumentasi API setelah penambahan fitur baru',
                'priority' => 'medium',
                'status' => 'overdue',
                'deadline' => Carbon::now()->subDays(2),
                'subtasks' => [
                    'Review endpoint baru',
                    'Update Swagger documentation',
                    'Testing API endpoints'
                ]
            ]
        ];

        foreach ($tasks as $taskData) {
            $subtasks = $taskData['subtasks'];
            unset($taskData['subtasks']);
            
            $task = Task::create($taskData);
            
            foreach ($subtasks as $index => $subtaskTitle) {
                Subtask::create([
                    'task_id' => $task->id,
                    'title' => $subtaskTitle,
                    'is_completed' => $task->status === 'completed' && $index < 2
                ]);
            }
        }
    }
}