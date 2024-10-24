<?php

namespace App\Http\Controllers;

use App\Models\Heroi;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HeroiController extends Controller
{
    public function exibir()
        {
            $customers = Heroi::all();
            return response()->json([
                'status' => true,
                'message' => 'Herói recuperado com Sucesso.',
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
    
            $customer = Heroi::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Herói Criado com Sucesso',
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

        $customer = Heroi::findOrFail($id);
        $customer->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Herói editado com Sucesso',
            'data' => $customer
        ], 200);
    }

    public function excluir($id)
    {
        $customer = Heroi::findOrFail($id);
        $customer->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Herói deletado com Sucesso'
        ], 204);
    }

    public function buscarPorId($id)
    {
        $customer = Heroi::findOrFail($id);
        return JsonResponse::sucess('Vilão achado Com Sucesso', $customer);
    }
}
