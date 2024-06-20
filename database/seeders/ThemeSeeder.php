<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('themes')->insert([
            'name' => 'Default Theme',
            'primary' => json_encode([
                50 => "#eef3ff",
                100 => "#d9e3ff",
                200 => "#bccfff",
                300 => "#8eb1ff",
                400 => "#5986ff",
                500 => "#3d64ff",
                600 => "#1b38f5",
                700 => "#1425e1",
                800 => "#1720b6",
                900 => "#19228f",
                950 => "#141757",
                // Add more shades as needed
            ]),
            'secondary' => json_encode([
                50 => "#f7f3ff",
                100 => "#f1e9fe",
                200 => "#e5d6fe",
                300 => "#d0b5fd",
                400 => "#b48bfa",
                500 => "#955cf6",
                600 => "#7c3aed",
                700 => "#6928d9",
                800 => "#5821b6",
                900 => "#491d95",
                950 => "#2f1065",
            ]),
            'danger' => json_encode([
                50 => "#fef2f2",
                100 => "#fee2e2",
                200 => "#fecaca",
                300 => "#fca5a5",
                400 => "#f87171",
                500 => "#ef4444",
                600 => "#dc2626",
                700 => "#b91c1c",
                800 => "#991b1b",
                900 => "#7f1d1d",
                950 => "#450a0a",
            ]),
            'warning' => json_encode([
                50 => "#fff9eb",
                100 => "#feefc7",
                200 => "#fddd8a",
                300 => "#fccb4d",
                400 => "#fbbf24",
                500 => "#f5b40b",
                600 => "#d99e06",
                700 => "#b48409",
                800 => "#926d0e",
                900 => "#785b0f",
                950 => "#453303",
            ]),
            'success' => json_encode([
                50 => "#eef3ff",
                100 => "#d9e3ff",
                200 => "#bccfff",
                300 => "#8eb1ff",
                400 => "#5986ff",
                500 => "#3d64ff",
                600 => "#1b38f5",
                700 => "#1425e1",
                800 => "#1720b6",
                900 => "#19228f",
                950 => "#141757",
            ]),
        ]);
    }
}
