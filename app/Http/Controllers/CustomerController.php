<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller {
    protected Customer $customer;
    public function __construct(Customer $customer) {
        $this->customer = $customer;
    }

    public function index(): JsonResponse {
        $customers = $this->customer->query()
            ->orderBy('full_name')
            ->get();
        return response()->json($customers);
    }

    public function store(StoreCustomerRequest $request): JsonResponse {
        $validatedData = $request->validated();

        try {
            $customer = $this->customer->create($validatedData);
            return response()->json($customer, 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao processar a solicitação.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $id): JsonResponse {
        $customer = $this->customer->find($id);

        if (!$customer) {
            return response()->json([
                'error' => 'O cliente informado não existe na base de dados.'
            ], 404);
        }

        return response()->json($customer, 200);
    }

    public function update(UpdateCustomerRequest $request, int $id): JsonResponse {
        $customer = $this->customer->find($id);

        if (!$customer) {
            return response()->json([
                'error' => 'O cliente informado não existe na base de dados.'
            ], 404);
        }

        $validatedData = $request->validated();

        $cpfExists = $this->customer->query()
            ->where('cpf', $validatedData['cpf'])
            ->where('id', '!=', $id)
            ->exists();

        if ($cpfExists) {
            return response()->json([
                'error' => 'O cpf informado já está em uso.'
            ], 422);
        }

        try {
            $customer->update($validatedData);
            return response()->json($customer, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao processar a solicitação.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id): JsonResponse {
        $customer = $this->customer->find($id);

        if (!$customer) {
            return response()->json([
                'error' => 'O cliente informado não existe na base de dados.'
            ], 404);
        }

        try {
            $customer->delete();
            return response()->json([
                'message' => 'Registro excluído com sucesso!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao processar a solicitação.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
