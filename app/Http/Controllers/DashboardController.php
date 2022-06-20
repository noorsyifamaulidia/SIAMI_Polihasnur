<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $audits = Audit::isActive()->latest()->get();
        
        return view('dashboard.index', compact('audits'));
    }
}
