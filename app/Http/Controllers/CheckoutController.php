<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutUpdateRequest;
use App\Http\Requests\CheckoutCreateRequest;
use App\Http\Resources\CheckoutResource;
use App\Models\Checkout;
use App\Models\CheckoutDetail;
use Illuminate\Http\JsonResponse;

class CheckoutController extends Controller
{
    // Menampilkan semua checkout
    public function index(): JsonResponse
    {
        $checkouts = Checkout::with('details')->get();

        return response()->json([
            'message' => 'Checkout list retrieved successfully',
            'data' => CheckoutResource::collection($checkouts),
        ]);
    }

    // Menampilkan detail checkout
    public function show($id): JsonResponse
    {
        $checkout = Checkout::with('details')->find($id);

        if (!$checkout) {
            return response()->json(['message' => 'Checkout not found'], 404);
        }

        return response()->json([
            'message' => 'Checkout retrieved successfully',
            'data' => new CheckoutResource($checkout),
        ]);
    }

    // Membuat transaksi checkout baru
    public function store(CheckoutCreateRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $checkout = Checkout::create([
            'user_id' => $validated['user_id'],
            'total_amount' => 0,
            'status' => 'pending',
        ]);

        $totalAmount = 0;

        foreach ($validated['details'] as $detail) {
            $subtotal = $detail['quantity'] * $detail['price'];
            $totalAmount += $subtotal;

            CheckoutDetail::create([
                'checkout_id' => $checkout->id,
                'product_id' => $detail['product_id'],
                'quantity' => $detail['quantity'],
                'price' => $detail['price'],
                'subtotal' => $subtotal,
            ]);
        }

        $checkout->update(['total_amount' => $totalAmount]);

        return response()->json([
            'message' => 'Checkout created successfully',
            'data' => new CheckoutResource($checkout->load('details')),
        ]);
    }

    // Mengupdate status checkout
    public function update(CheckoutUpdateRequest $request, $id): JsonResponse
    {
        if ($request->status === 'completed') {
            CheckoutDetail::where('checkout_id', $id)->delete();
        }
        $checkout = Checkout::find($id);

        if (!$checkout) {
            return response()->json(['message' => 'Checkout not found'], 404);
        }

        $checkout->update($request->validated());

        return response()->json([
            'message' => 'Checkout updated successfully',
            'data' => new CheckoutResource($checkout),
        ]);
    }

    public function destroy($id): JsonResponse
    {
        Checkout::find($id)->delete();
        return response()->json([
            'message' => 'Checkout deleted successfully',
        ]);
    }
}
