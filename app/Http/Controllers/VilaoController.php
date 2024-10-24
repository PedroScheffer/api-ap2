<?php

namespace App\Http\Controllers;

use App\Models\Vilao;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VilaoController extends Controller
{
    public function exibir()
        {
            $customers = Vilao::all();
            return response()->json([
                'status' => true,
                'message' => 'Vilão recuperado com Sucesso.',
                'data' => $customers
            ], 200);
        }
    
        public function criar(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'nome' => 'required|string|max:200',
                'universo'=> 'required|string|max:100',
                'poder' => 'required|numeric'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'erro na validação',
                    'errors' => $validator->errors()
                ], 422);
            }
    
            $customer = Vilao::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Vilão Criado com Sucesso',
                'data' => $customer
            ], 201);
        }

        public function editar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'universo'=> 'required|string|max:100',
            'poder' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Erro na validação',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Vilao::findOrFail($id);
        $customer->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Vilão editado com Sucesso',
            'data' => $customer
        ], 200);
    }

    public function excluir($id)
    {
        $customer = Vilao::findOrFail($id);
        $customer->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Vilão deletado com Sucesso'
        ], 204);
    }

    public function buscarPorId($id)
    {
        $customer = Vilao::findOrFail($id);
        return JsonResponse::sucess('Vilão achado Com Sucesso', $customer);
    }
}
