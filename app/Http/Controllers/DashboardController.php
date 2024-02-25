<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\ExpensesChart;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request, ExpensesChart $chart)
    {
       // Ambil nilai tahun dari request jika tersedia, jika tidak, atur default ke tahun sekarang
        $year = $request->input('year', date('Y'));
        
        // Panggil metode build dengan nilai tahun yang telah ditentukan
        return view('admin.dashboard', [
            'chart' => $chart->build($year),
            'tab' => 'Dashboard'
        ]);    
    }

}
