<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): JsonResponse
{
    $users = User::query()->get();

    return response()->json([
        'success' => true,
        'message' => 'Users retrieved successfully',
        'data' => $users
    ]);
}

    public function store(Request $request): JsonResponse
{
    $data = $request->validate([
        'name' => ['required'],
        'email' => ['required'],
        'phone' => ['required'],
        'password' => ['required'],
    ]);

    $data['password'] = bcrypt($data['password']);

    $user = User::query()->create($data);

    return response()->json([
        'success' => true,
        'message' => 'User created successfully',
        'data' => $user
    ], 201);
}

    public function show(int $id): JsonResponse
    {
        $user = User::query()->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => "Get user detail with id $id",
            'data' => $user
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $user = User::query()->findOrFail($id);

        $data = $request->validate([
            'name' => ['sometimes'],
            'email' => ['sometimes'],
            'phone' => ['sometimes'],
        ]);

        $user->update($data);

        return response()->json([
            'success' => true,
            'message' => "User updated successfully",
            'data' => $user
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $user = User::query()->findOrFail($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => "User deleted successfully"
        ]);
    }
}