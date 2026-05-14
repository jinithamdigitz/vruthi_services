<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SolarCalculator;
use Illuminate\Http\Request;

class SolarCalculatorAdminController extends Controller
{
    public function index()
    {
        $solarCalculators = SolarCalculator::latest()->paginate(10);

        return view('admin.solarcalc.index', compact('solarCalculators'));
    }

    public function show($id)
    {
        $solarCalculator = SolarCalculator::findOrFail($id);

        return view('admin.solarcalc.show', compact('solarCalculator'));
    }
}