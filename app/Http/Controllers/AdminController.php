<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            $isAdmin = DB::table('user_roles')
                ->join('roles', 'user_roles.role_id', '=', 'roles.role_id')
                ->where('user_roles.user_id', Auth::user()->user_id)
                ->where('roles.role_name', 'admin')
                ->exists();

            if ($isAdmin) {
                return redirect()->route('admin.dashboard');
            }
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'email' => 'Invalid login details.',
            ])->withInput();
        }

        $request->session()->regenerate();

        $isAdmin = DB::table('user_roles')
            ->join('roles', 'user_roles.role_id', '=', 'roles.role_id')
            ->where('user_roles.user_id', Auth::user()->user_id)
            ->where('roles.role_name', 'admin')
            ->exists();

        if (!$isAdmin) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'You are not an admin.',
            ])->withInput();
        }

        return redirect()->route('admin.dashboard');
    }

    public function dashboard()
    {
        $orders = DB::table('orders')
            ->orderByDesc('order_id')
            ->limit(20)
            ->get();

        $users = DB::table('users')
            ->orderByDesc('user_id')
            ->limit(20)
            ->get();

        return view('admin.dashboard', compact('orders', 'users'));
    }

    public function inventory()
    {
        $products = Product::orderBy('name')->get();

        return view('admin.inventory', compact('products'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Admin logged out.');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'category_id' => 'required|string|max:36',
        ]);

        DB::table('products')->insert([
            'product_id' => (string) Str::uuid(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'image_url' => $request->image_url,
            'base_price' => $request->base_price,
            'is_active' => 1,
            'product_url' => null,
        ]);

        return redirect()->route('admin.inventory')->with('success', 'Product added successfully.');
    }

    public function editProduct($id)
    {
        $product = Product::where('product_id', $id)->firstOrFail();

        return view('admin.edit-product', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::where('product_id', $id)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->product_id . ',product_id',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'category_id' => 'required|string|max:36',
        ]);

        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'image_url' => $request->image_url,
            'base_price' => $request->base_price,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.inventory')->with('success', 'Product updated successfully.');
    }

    public function deleteProduct($id)
    {
        $product = Product::where('product_id', $id)->firstOrFail();
        $product->delete();

        return redirect()->route('admin.inventory')->with('success', 'Product deleted successfully.');
    }
}