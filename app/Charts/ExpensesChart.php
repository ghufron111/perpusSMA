<?php

namespace App\Charts;

use App\Models\Laporan;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ExpensesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($year): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $monthlyData = Laporan::selectRaw('COUNT(*) as total_reports, MONTH(rent_date) as month')
        ->whereYear('rent_date', '=', $year) // Filter berdasarkan tahun yang dipilih
        ->groupBy(DB::raw('MONTH(rent_date)'))
        ->orderBy(DB::raw('MONTH(rent_date)'))
        ->get();

    // Inisialisasi array untuk menyimpan data setiap bulan
    $dataFromDatabase = [];

    // Loop melalui hasil query dan mengisi array dengan data setiap bulan
    for ($i = 1; $i <= 12; $i++) {
        $dataFromDatabase[] = $monthlyData->where('month', $i)->first()->total_reports ?? 0;
    }

    // Nama-nama bulan untuk sumbu X
    $months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    return $this->chart->lineChart()
        ->setTitle('Peminjaman Buku Tahun ' . $year)
        ->setSubtitle('Jumlah Peminjaman Buku Berdasarkan Bulan')
        ->addData('Jumlah Peminjam', $dataFromDatabase)
        ->setXAxis($months); // Menggunakan array bulan untuk sumbu X
    }
}
