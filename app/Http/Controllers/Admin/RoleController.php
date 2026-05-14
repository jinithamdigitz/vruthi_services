<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\RoleRoute;

class RoleController extends Controller
{
    // List all roles
    public function index()
    {

       
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    // Show form to create role
    public function create()
    {
        return view('admin.roles.create');
    }

    // Save new role
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        Role::create(['name' => $request->name]);
        return redirect()->route('admin.roles.index')->with('success', 'Role created');
    }

    // Show form to assign routes to a role
    public function editRoutes(Role $role)
    {
        // Get all named routes in the app
        $allRoutes = collect(\Route::getRoutes())
            ->map(fn($r) => $r->getName())
            ->filter() // remove null names
            ->unique()
            ->sort();

        $assignedRoutes = $role->routes->pluck('route_name')->toArray();

        return view('admin.roles.edit_routes', compact('role', 'allRoutes', 'assignedRoutes'));
    }

    public function updateName(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        return response()->json(['success' => true, 'message' => 'Role name updated successfully.']);
    }

    // Save route assignments
    public function updateRoutes(Request $request, Role $role)
    {
        $routes = $request->routes ?? [];

        // Remove old assignments
        RoleRoute::where('role_id', $role->id)->delete();

        // Add new assignments
        foreach ($routes as $routeName) {
            RoleRoute::create([
                'role_id' => $role->id,
                'route_name' => $routeName
            ]);
        }

        return redirect()->route('admin.roles.index')->with('success', 'Routes updated');
    }
}
