<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
class UserController extends Controller
{
			public function index()
		{
			$users = User::with('role')->paginate(10);
			return view('auth.users.index', compact('users'));
		}
		   
    public function store(Request $request)
{
     $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'role_id' => 'required|exists:roles,id',
        'password' => 'required|confirmed|min:8',
    ]);

    $user = User::create($validated);

    

    return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
}
 public function create()
    {
		 $roles = Role::all(); // or whatever your Role model is
         return view('auth.users.create', compact('roles'));
       
    }

     public function show(User $user)
    {
        return view('auth.users.show', compact('user'));
    }

    /** Edit form */
    public function edit(User $user)
    {
		$roles = Role::all();
    
        return view('auth.users.edit', compact('user', 'roles'));
    }

    /** Handle update */
   public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role_id' => 'required|exists:roles,id',
        'password' => 'nullable|confirmed|min:8',
    ]);

    // Remove password from update if not provided
    if (empty($validated['password'])) {
        unset($validated['password']);
    }

    $user->update($validated);

    return redirect()->route('admin.users.index')
        ->with('success', 'User updated successfully.');
}
    
	 // Profile Methods (Add these new methods)
    public function profile()
    {
        $user = auth()->user();
        return view('auth.profile.show', compact('user'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('auth.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Update basic info
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Update password if provided
        if ($request->filled('password')) {
            // Verify current password
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }

            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}
