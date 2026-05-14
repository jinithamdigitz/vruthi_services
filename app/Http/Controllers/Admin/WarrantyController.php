<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WarrantyRegistration;
use Illuminate\Http\Request;

class WarrantyController extends Controller
{
    public function index()
    {
        $warranties = WarrantyRegistration::latest()->paginate(10);
        return view('admin.warranty.index', compact('warranties'));
    }

    public function create()
    {
        return view('admin.warranty.create');
    } 

    public function store(Request $request)
    {
        $request->validate([
            'serial_number' => 'required',
            'phone_number'  => 'required',
            'vehicle_number'=> 'required',
            'address'       => 'required',
            'expiry_date'   => 'required|date',
        ]);

        WarrantyRegistration::create($request->all());

        return redirect()->route('warranty.index')->with('success', 'Warranty added successfully');
    }

    public function edit($id)
    {
        $warranty = WarrantyRegistration::findOrFail($id);
        return view('admin.warranty.edit', compact('warranty'));
    }

    public function update(Request $request, $id)
    {
        $warranty = WarrantyRegistration::findOrFail($id);
        $warranty->update($request->all());

        return redirect()->route('warranty.index')->with('success', 'Warranty updated successfully');
    }

    public function destroy($id)
    {
        $warranty = WarrantyRegistration::findOrFail($id);
        $warranty->delete();

        return redirect()->route('warranty.index')->with('success', 'Warranty deleted successfully');
    }
}
