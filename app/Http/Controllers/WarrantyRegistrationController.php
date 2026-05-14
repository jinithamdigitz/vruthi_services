<?php
namespace App\Http\Controllers;

use App\Models\WarrantyRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Product;

class WarrantyRegistrationController extends Controller
{
    // --- Frontend Form ---
    public function frontendCreate()
    {
		$products=Product::all();
        return view('warranty.register',compact('products'));
    }

    public function frontendStore(Request $request)
    {
        $request->validate([
		    'product_id'     => 'required',
            'serial_number' => 'required',
            'phone_number'  => 'required',
            'vehicle_number'=> 'required',
            'address'       => 'required',
            'expiry_date'   => 'required|date',
        ]);

        WarrantyRegistration::create($request->all());

        return redirect()->route('warranty.frontend.create')->with('success', 'Warranty registered successfully!');
    }

    // --- Frontend Search ---
  public function searchForm(Request $request)
{
    $results = collect(); // empty by default
       $searched = false;  
    if ($request->serial_number || $request->phone_number || $request->vehicle_number || $request->barcode) {
		  $searched = true;
        $query = DB::table('warranty_registrations as wr')
            ->join('product as p', 'wr.product_id', '=', 'p.id')
            ->select('wr.*', 'p.barcode', 'p.title as product_name')
            ->where(function ($q) use ($request) {
                if ($request->serial_number) {
                    $q->orWhere('wr.serial_number', 'like', "%{$request->serial_number}%");
                }
                if ($request->phone_number) {
                    $q->orWhere('wr.phone_number', 'like', "%{$request->phone_number}%");
                }
                if ($request->vehicle_number) {
                    $q->orWhere('wr.vehicle_number', 'like', "%{$request->vehicle_number}%");
                }
                if ($request->barcode) {
                    $q->orWhere('p.barcode', 'like', "%{$request->barcode}%");
                }
            });

        $results = $query->get();
    }

    return view('warranty.search', compact('results', 'searched'));
}


 public function renewal(Request $request)
    {

    $results = collect(); // empty by default
       $searched = false;  
    if ($request->serial_number || $request->phone_number || $request->vehicle_number || $request->barcode) {
		  $searched = true;
        $query = DB::table('warranty_registrations as wr')
            ->join('product as p', 'wr.product_id', '=', 'p.id')
            ->select('wr.*', 'p.barcode', 'p.title as product_name')
            ->where(function ($q) use ($request) {
                if ($request->serial_number) {
                    $q->orWhere('wr.serial_number', 'like', "%{$request->serial_number}%");
                }
                if ($request->phone_number) {
                    $q->orWhere('wr.phone_number', 'like', "%{$request->phone_number}%");
                }
                if ($request->vehicle_number) {
                    $q->orWhere('wr.vehicle_number', 'like', "%{$request->vehicle_number}%");
                }
                if ($request->barcode) {
                    $q->orWhere('p.barcode', 'like', "%{$request->barcode}%");
                }
            });

        $results = $query->get();
	}

        return view('warranty.renewal', compact('results', 'searched'));
    }

    public function extendSubmit(Request $request, $id)
    {
        $request->validate([
            'warranty_reg_upto' => 'required|date',
        ]);

        $warranty = WarrantyRegistration::findOrFail($id);
        $warranty->warranty_reg_upto = $request->warranty_reg_upto;
        $warranty->save();

        return redirect()->route('warranty.renewal')->with('success', 'Warranty extended successfully!');
    }

   

    // --- Backend CRUD ---
    public function index()
    {
        $warranties = WarrantyRegistration::latest()->paginate(10);
        return view('backend.warranties.index', compact('warranties'));
    }

    public function create()
    {
        return view('backend.warranties.create');
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
        return redirect()->route('warranty-registrations.index')->with('success', 'Created successfully');
    }

    public function edit(WarrantyRegistration $warrantyRegistration)
    {
        return view('backend.warranties.edit', compact('warrantyRegistration'));
    }

    public function update(Request $request, WarrantyRegistration $warrantyRegistration)
    {
        $request->validate([
            'serial_number' => 'required',
            'phone_number'  => 'required',
            'vehicle_number'=> 'required',
            'address'       => 'required',
            'expiry_date'   => 'required|date',
        ]);

        $warrantyRegistration->update($request->all());
        return redirect()->route('warranty-registrations.index')->with('success', 'Updated successfully');
    }

    public function destroy(WarrantyRegistration $warrantyRegistration)
    {
        $warrantyRegistration->delete();
        return redirect()->route('warranty-registrations.index')->with('success', 'Deleted successfully');
    }
}
