<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showSignup()
    {
        return view('signup');
    }

   
    public function showAccount()
{
    $orders = collect();

    if (Auth::check()) {
        $orders = DB::table('orders')
            ->where('user_id', Auth::user()->user_id)
            ->orderBy('order_id', 'desc')
            ->get();
    }

    return view('account', compact('orders'));
}
    public function signup(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|confirmed|unique:users,email',
            'password'   => 'required|min:6|confirmed',
            'phone'      => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'user_id'         => (string) Str::uuid(),
            'email'           => $request->email,
            'password_hash'   => Hash::make($request->password),
            'first_name'      => $request->first_name,
            'last_name'       => $request->last_name,
            'phone'           => $request->phone,
            'profile_picture' => null,
        ]);

        Auth::login($user);

        return redirect('/account')->with('success', 'Account created successfully.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/account')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/account')->with('success', 'Logged out successfully.');
    }

    public function uploadProfilePicture(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/account');
        }

        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $file = $request->file('profile_picture');
        $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
        $destination = public_path('images/profile_pictures');

        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $filename);

        $user = Auth::user();
        $user->profile_picture = 'images/profile_pictures/' . $filename;
        $user->save();

        return redirect('/account')->with('success', 'Profile picture updated successfully.');
    }
}