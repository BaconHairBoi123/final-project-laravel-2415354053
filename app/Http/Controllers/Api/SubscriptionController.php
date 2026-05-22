<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(): JsonResponse
    {
        $subscriptions = Subscription::query()->get();

        return response()->json([
            'success' => true,
            'message' => 'Subscriptions retrieved successfully',
            'data' => $subscriptions
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'customer_id' => ['required'],
            'service_id' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'status' => ['required'],
        ]);

        $subscription = Subscription::query()->create($data);

        return response()->json([
            'success' => true,
            'message' => 'Subscription created successfully',
            'data' => $subscription
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $subscription = Subscription::query()->find($id);

        if (!$subscription) {

            return response()->json([
                'success' => false,
                'message' => 'Subscription not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Subscription retrieved successfully',
            'data' => $subscription
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $subscription = Subscription::query()->find($id);

        if (!$subscription) {

            return response()->json([
                'success' => false,
                'message' => 'Subscription not found',
            ], 404);
        }

        $data = $request->validate([
            'customer_id' => ['sometimes'],
            'service_id' => ['sometimes'],
            'start_date' => ['sometimes'],
            'end_date' => ['sometimes'],
            'status' => ['sometimes'],
        ]);

        $subscription->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Subscription updated successfully',
            'data' => $subscription
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $subscription = Subscription::query()->find($id);

        if (!$subscription) {

            return response()->json([
                'success' => false,
                'message' => 'Subscription not found',
            ], 404);
        }

        $subscription->delete();

        return response()->json([
            'success' => true,
            'message' => 'Subscription deleted successfully',
        ]);
    }
}