<?php

namespace App\Http\Controllers\master;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
    
        if ($user->isIT()) {
            $users = User::all();
        } else {
            $users = User::where('role', '!=', 1)->get();
        }
        return view('master.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|integer|in:1,2,3',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User has been successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::findOrFail($id);
        return view('master.users.edit', compact('user'));
    }

    public function editProfil($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::findOrFail($id);
        return view('master.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $encryptedId = Crypt::decrypt($id);
        $user = User::findOrFail($encryptedId);
        
        if ($request->filled('name')) {
            $user->name = $request->name;
        }
        
        if ($request->filled('email')) {
            $user->email = $request->email;
            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }
        }
        
        if ($request->filled('role') && in_array($request->role, [1, 2, 3])) {
            $user->role = $request->role;
        }
        
        $user->save();
        
        return back()->with('success', 'User data has been successfully updated.');
    }

    public function updateProfil(Request $request, $id)
    {
        $encryptedId = Crypt::decrypt($id);
        $user = User::findOrFail($encryptedId);
        
        if ($request->filled('name')) {
            $user->name = $request->name;
        }
        
        if ($request->filled('email')) {
            $user->email = $request->email;
            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }
        }
        
        if ($request->filled('role') && in_array($request->role, [1, 2, 3])) {
            $user->role = $request->role;
        }
        
        $user->save();
        
        return back()->with('success', 'User data has been successfully updated.');
    }

    public function updatePassword(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ]);
        $user = User::findOrFail($id);
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match.']);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'Password has been successfully updated.');
    }

    public function resetPassword($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::findOrFail($id);
        $format = Carbon::now()->format('my');
        $newPassword = 'Catering' . $format;
        $user->password = Hash::make($newPassword);
        $user->save();
        return back()->with('success', 'Password has been reset to ' . $newPassword);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $id = Crypt::decrypt($id); // Dekripsi ID
            $user = User::findOrFail($id);
    
            // Hindari menghapus diri sendiri (opsional)
            if (auth()->id() == $user->id) {
                return back()->with('error', 'You cannot delete your own account.');
            }

            $user->delete();
            return back()->with('success', 'User has been successfully deleted.');
            } catch (\Exception $e) {
                return back()->with('error', 'An error occurred while deleting the user.');
            }
    }
}
