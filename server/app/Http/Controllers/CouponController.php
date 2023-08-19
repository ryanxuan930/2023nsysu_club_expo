<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except(['index', 'show', 'showByArray']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Coupon::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'coupon_code' => 'required|string|unique:coupons',
            'coupon_context' => 'required|string',
            'issue_at' => 'required|date',
            'expire_at' => 'required|date',
            'valid' => 'required|boolean',
        ]);
        Coupon::create($data);
        return response()->json(['message' => 'OK'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return Coupon::find($id);
    }

    /**
     * Display the specified resource by array.
     */
    public function showByArray(Request $request) 
    {
        $data = $request->validate([
            'payload' => 'required|array',
        ]);
        return Coupon::whereIn('coupon_code', $data['payload'])->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'coupon_code' => 'required|string|exist:coupons',
            'coupon_context' => 'required|string',
            'issue_at' => 'required|date',
            'expire_at' => 'required|date',
            'valid' => 'required|boolean',
        ]);
        $coupon = Coupon::find($id);
        $coupon->update($data);
        return response()->json(['message' => 'OK'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return response()->json(['message' => 'OK'], 200);
    }
}
