<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Auth extends Controller
{
    public function register(Request $request)
    {
        try {
            $first_name = $request->input('first_name');
            $last_name  = $request->input('last_name');
            $email      = $request->input('email');
            $password   = $request->input('password');
            $phone      = $request->input('phone');

            if (!$first_name || !$last_name || !$email || !$password) {
                return response()->json([
                    'message' => 'First name, last name, email and password are required'
                ], 400);
            }

            $exists = DB::table('users')
                ->select('user_id')
                ->where('email', $email)
                ->get();

            if ($exists->count() > 0) {
                return response()->json([
                    'message' => 'Email is already registered'
                ], 400);
            }

            DB::table('users')->insert([
                'email'         => $email,
                'password_hash' => Hash::make($password),
                'first_name'    => $first_name,
                'last_name'     => $last_name,
                'phone'         => $phone ?: null,
            ]);

            return response()->json([
                'message' => 'User registered successfully'
            ], 201);

        } catch (\Exception $err) {
            \Log::error('Register error: ' . $err->getMessage());

            return response()->json([
                'message' => 'Server error while registering user'
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $email    = $request->input('email');
            $password = $request->input('password');

            if (!$email || !$password) {
                return response()->json([
                    'message' => 'Email and password are required'
                ], 400);
            }

            $user = DB::table('users')
                ->select('user_id', 'email', 'password_hash', 'first_name', 'last_name', 'phone')
                ->where('email', $email)
                ->first();

            if (!$user) {
                return response()->json([
                    'message' => 'Invalid email or password'
                ], 401);
            }

            if (!Hash::check($password, $user->password_hash)) {
                return response()->json([
                    'message' => 'Invalid email or password'
                ], 401);
            }

            $token = $this->createJwt([
                'id'    => $user->user_id,
                'email' => $user->email,
                'exp'   => time() + 3600,
            ]);

            return response()->json([
                'message' => 'Login successful',
                'token'   => $token,
                'user'    => [
                    'user_id'    => $user->user_id,
                    'first_name' => $user->first_name,
                    'last_name'  => $user->last_name,
                    'email'      => $user->email,
                    'phone'      => $user->phone,
                ],
            ]);

        } catch (\Exception $err) {
            \Log::error('Login error: ' . $err->getMessage());

            return response()->json([
                'message' => 'Server error while logging in'
            ], 500);
        }
    }

    public function profile(Request $request)
    {
        try {
            $token = $request->bearerToken();

            if (!$token) {
                return response()->json([
                    'message' => 'No token provided'
                ], 401);
            }

            $payload = $this->verifyJwt($token);

            if (!$payload || empty($payload['id'])) {
                return response()->json([
                    'message' => 'Invalid or expired token'
                ], 401);
            }

            $user = DB::table('users')
                ->select('user_id', 'first_name', 'last_name', 'email', 'phone', 'created_at')
                ->where('user_id', $payload['id'])
                ->first();

            if (!$user) {
                return response()->json([
                    'message' => 'User not found'
                ], 404);
            }

            return response()->json([
                'user' => $user
            ]);

        } catch (\Exception $err) {
            \Log::error('Profile error: ' . $err->getMessage());

            return response()->json([
                'message' => 'Server error while fetching profile'
            ], 500);
        }
    }

    private function createJwt(array $payload): string
    {
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT',
        ];

        $headerEncoded  = $this->base64UrlEncode(json_encode($header));
        $payloadEncoded = $this->base64UrlEncode(json_encode($payload));

        $signature = hash_hmac(
            'sha256',
            $headerEncoded . '.' . $payloadEncoded,
            config('app.key'),
            true
        );

        $signatureEncoded = $this->base64UrlEncode($signature);

        return $headerEncoded . '.' . $payloadEncoded . '.' . $signatureEncoded;
    }

    private function verifyJwt(string $token): ?array
    {
        $parts = explode('.', $token);

        if (count($parts) !== 3) {
            return null;
        }

        [$headerEncoded, $payloadEncoded, $signatureEncoded] = $parts;

        $expectedSignature = $this->base64UrlEncode(
            hash_hmac(
                'sha256',
                $headerEncoded . '.' . $payloadEncoded,
                config('app.key'),
                true
            )
        );

        if (!hash_equals($expectedSignature, $signatureEncoded)) {
            return null;
        }

        $payload = json_decode($this->base64UrlDecode($payloadEncoded), true);

        if (!$payload) {
            return null;
        }

        if (!empty($payload['exp']) && time() > $payload['exp']) {
            return null;
        }

        return $payload;
    }

    private function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function base64UrlDecode(string $data): string
    {
        $remainder = strlen($data) % 4;

        if ($remainder) {
            $data .= str_repeat('=', 4 - $remainder);
        }

        return base64_decode(strtr($data, '-_', '+/'));
    }
}