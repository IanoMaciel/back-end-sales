<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller {
    protected User $user;
    public function __construct(User $user) {
        $this->user = $user;
    }

    public function index(): JsonResponse {
        return response()->json([]);
    }

    public function store(StoreUserRequest $request): JsonResponse {
        $validatedData = $request->validated();
        try {
            $user = $this->user->create($validatedData);
            return response()->json($user, 201);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'Erro ao processar a solicitação',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $id): JsonResponse {
        $user = $this->user->query()
            ->with(['userType'])
            ->withTrashed()
            ->find($id);

        if (!$user) {
            return response()->json([
                'error' => 'O usuário informado não existe na base de dados'
            ], 404);
        }
        return response()->json($user, 200);
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse {
        $user = $this->user->query()->with(['userType'])->find($id);

        if (!$user) {
            return response()->json([
                'error' => 'O usuário informado não existe na base de dados'
            ], 404);
        }

        $validatedData = $request->validated();

        $emailExists = $this->user->query()
            ->where('email', $validatedData['email'])
            ->where('id', '!=', $id)
            ->exists();

        if ($emailExists) {
            return response()->json([
                'error' => 'O e-mail informado já está em uso.'
            ], 422);
        }

        try {
            $user->update($validatedData);
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao processo a solicitação.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function softDelete(int $id) {
        $user = $this->user->query()
            ->with(['userType'])
            ->find($id);

        if (!$user) {
            return response()->json([
                'error' => 'O usuário informado não existe na base de dados'
            ], 404);
        }

        try {
            $user->update(['status' => 'Inativo']);
            $user->delete();
            return response()->json([
                'message' => 'Registro desativado com sucesso!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao processar a solicitação',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function restoreUser(int $id) {
        $user = $this->user->query()
            ->with(['userType'])
            ->withTrashed()
            ->find($id);

        if (!$user) {
            return response()->json([
                'error' => 'O usuário informado não existe na base de dados'
            ], 404);
        }

        try {
            $user->update(['status' => 'Ativo']);
            $user->restore();
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao processar a solicitação',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
