<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Coupon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Broadcast;

class AdminAuthController extends Controller
{
    // middleware
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['login']]);
    }

    // login with jwt token
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'account' => 'required|string',
            'password' => 'required|string',
        ]);
        $token = auth('admin')->attempt($credentials);
        if(!$token)
        {
            return response()->json(['message' => '帳號或密碼錯誤'], 200);
        }

        $user = Admin::find(auth('admin')->user()->a_id);
        //force to update user model cache 
        auth('admin')->setUser($user);
        // Return the token along with the user info
        return response()->json(['message' => 'OK', 'user' => auth('admin')->user(), 'token' => $token], 200);
    }
    // admin info
    public function admin()
    {
        return response()->json(['message' => 'OK', 'user' => auth('admin')->user()], 200);
    }

    // logout
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'OK'], 200);
    }

    protected function issueCoupon(string $couponCode, string $schoolId, string $type)
    {
        $data = [
            'coupon_code' => $couponCode,
            'coupon_context' => [
                'school_id' => $schoolId,
                'redeem_at' => null,
                'type' => $type,
            ],
            'issued_at' => date('Y-m-d H:i:s', time()),
            'expired_at' => '2023-09-07 21:00:00',
            'valid' => true,
        ];
        Coupon::create($data);
    }

    protected function updateStatus(string $clubCode, string $schoolId)
    {
        $user = User::where('school_id', $schoolId)->first();
        if(!$user) {
            return 'not_found';
        }
        $status = $user->status;
        $size = count($status['matrix']);
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                if ($status['matrix'][$i][$j]['club_code'] == $clubCode) {
                    $status['matrix'][$i][$j]['checked'] = true;
                }
            }
        }

        // bingo
        $bingoCount = 0;
        for ($i = 0; $i < $size; $i++) {
            $allChecked = true;
            for ($j = 0; $j < $size; $j++) {
                if (!$status['matrix'][$i][$j]['checked']) {
                    $allChecked = false;
                    break;
                }
            }
            if ($allChecked) {
                $bingoCount++;
            }
        }
        for ($i = 0; $i < $size; $i++) {
            $allChecked = true;
            for ($j = 0; $j < $size; $j++) {
                if (!$status['matrix'][$j][$i]['checked']) {
                    $allChecked = false;
                    break;
                }
            }
            if ($allChecked) {
                $bingoCount++;
            }
        }
        $allChecked = true;
        for ($i = 0; $i < $size; $i++) {
            if (!$status['matrix'][$i][$i]['checked']) {
                $allChecked = false;
                break;
            }
        }
        if ($allChecked) {
            $bingoCount++;
        }
        $allChecked = true;
        for ($i = 0; $i < $size; $i++) {
            if (!$status['matrix'][$i][$size - 1 - $i]['checked']) {
                $allChecked = false;
                break;
            }
        }
        if ($allChecked) {
            $bingoCount++;
        }

        // coupons
        if (!array_key_exists('lucky_draws', $status['remarks'])) {
            $status['remarks']['lucky_draws'] = [];
        }
        if ($bingoCount == 2 && !array_key_exists('meal_issued', $status['remarks'])) {
            $temp = Hash::make(time().$schoolId);
            $status['remarks']['meal_issued'] = $temp;
            $this->issueCoupon($temp, $schoolId, 'meal');
        }

        if (floor($bingoCount / 2) > count($status['remarks']['lucky_draws'])) {
            $temp = Hash::make(time().$schoolId);
            array_push($status['remarks']['lucky_draws'], $temp);
            $this->issueCoupon($temp, $schoolId, 'lucky_draw');
        }

        $status['lines'] = $bingoCount;
        $user->status = $status;
        $user->save();
        return 'OK';
    }

    // qrcode
    public function decode(Request $request) 
    {
        $credentials = $request->validate([
            'club_code' => 'required',
            'payload' => 'required',
        ]);
        try {
            $content = Crypt::decryptString($credentials['payload']);
        } catch (DecryptException $e) {
            return response()->json(['message' => 'error'], 200);
        }
        try {
            $payload = json_decode($content, true);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 200);
        }
        if (!array_key_exists('timestamp', $payload) || !array_key_exists('school_id', $payload)) {
            return response()->json(['message' => 'error'], 200);
        }
        $currentTimestamp = time();
        if ($currentTimestamp - $payload['timestamp'] > 120) {
            return response()->json(['message' => 'expired'], 200);
        }
        return response()->json(['message' => $this->updateStatus($credentials['club_code'], $payload['school_id'])], 200);
    }

    // input
    public function input(Request $request)
    {
        $credentials = $request->validate([
            'club_code' => 'required',
            'school_id' => 'required',
        ]);
        return response()->json(['message' => $this->updateStatus($credentials['club_code'], $credentials['school_id'])], 200);
    }

    // redeem
    public function redeem(Request $request)
    {
        $credentials = $request->validate([
            'payload' => 'required',
        ]);
        try {
            $payload = json_decode($credentials['payload'], true);
        }catch (Exception $e) {
            return response()->json(['message' => 'error'], 200);
        }
        if ($payload == null) {
            return response()->json(['message' => 'error'], 200);
        }
        if (!array_key_exists('coupon_code', $payload) || !array_key_exists('school_id', $payload) || !array_key_exists('type', $payload)) {
            return response()->json(['message' => 'error'], 200);
        }
        $coupon = Coupon::where('coupon_code', $payload['coupon_code'])->whereJsonContains('coupon_context->school_id', $payload['school_id'])->whereJsonContains('coupon_context->type', $payload['type'])->first();
        if (!$coupon) {
            return response()->json(['message' => 'coupon_not_found'], 200);
        }
        if (!$coupon->valid) {
            return response()->json(['message' => 'redeemed'], 200);
        }
        $couponContext = $coupon->coupon_context;
        $couponContext['redeem_at'] = date('Y-m-d H:i:s', time());
        $coupon->coupon_context = $couponContext;
        $coupon->valid = false;
        $coupon->save();
        return response()->json(['message' => 'OK'], 200);
    }

    public function alert() {
        $broadcast = Broadcast::where('expired_at', '>=', now())->first();
        $data = [
            'broadcast' => $broadcast,
        ];
        return response()->json($data);
    }
}
