<?php

namespace App\Http\Controllers;

use App\Http\structure\Helpers\ResponseHelper;
use App\Http\structure\Repositories\ProductsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function getProducts(Request $request): object 
    {
        $validator = Validator::make($request->all(),[
            "id" => "int",
            "tipo_estado" => "nullable|int", 
        ]);

        if($validator->fails()){
            return (object) ResponseHelper::json_fail($validator);
        }
        $response = ProductsRepository::getProducts($request);

        return (object) ResponseHelper::json_success($response);

    }

    public function addProducts(Request $request): object 
    {
        $validator = Validator::make($request->all(),[
            "id_proveedor" => "int", 
            "cartera" => "string", 
            "tipo_estado" => "int", 
            "especial" => "nullable|int", 
            "predictivo" => "nullable|int", 
            "progresivo" => "nullable|int", 
            "IVR_Identify" => "nullable|int", 
            "user_activa" => "int|nullable", 
            "fecha_activa" => "date|nullable",
            "id_troncal" => "nullable|int", 
            "aleatorio" => "nullable|int", 
            "tipo_llamada" => "nullable|int", 
            "did" => "nullable|string", 
            "actualizacion" => "nullable|int"
        ]);

        if($validator->fails()){
            return (object) ResponseHelper::json_fail($validator);
        }
        $response = ProductsRepository::AddProducts($request);
        if (!$response) {
            return (object) ResponseHelper::json_fail($response);
        }
        return (object) ResponseHelper::json_success(array(),"");
    }

    public function editProducts($id,Request $request): object 
    {
        $validator = Validator::make($request->all(),[
            "id_proveedor" => "required|int", 
            "cartera" => "required|string", 
            "tipo_estado" => "nullable|int", 
            "especial" => "nullable|int", 
            "predictivo" => "nullable|int", 
            "progresivo" => "nullable|int", 
            "IVR_Identify" => "nullable|int", 
            "user_activa" => "nullable|int", 
            "fecha_activa" => "nullable|date", 
            "user_cancela" => "nullable|int", 
            "fecha_cancela" => "nullable|date", 
            "id_troncal" => "nullable|int", 
            "aleatorio" => "nullable|int", 
            "tipo_llamada" => "nullable|int", 
            "did" => "nullable|string", 
            "actualizacion" => "nullable|int"
        ]);

        if($validator->fails()){
            return (object) ResponseHelper::json_fail_puts($validator);
        }

        $response = ProductsRepository::EditProducts($id,$request);
        if(!$response){
            return (object) ResponseHelper::json_fail($response);
        }
        return (object) ResponseHelper::json_success(array(),"");

    }

    public function deleteProducts($id,Request $request): object 
    {
        $validator = Validator::make($request->all(),[
            "tipo_estado" => "int"
        ]);

        if($validator->fails()){
            return (object) ResponseHelper::json_fail($validator);
        }

        $response = ProductsRepository::DeleteProducts($id,$request);
        if(!$response){
            return (object) ResponseHelper::json_fail($response);
        }
        return (object) ResponseHelper::json_success(array(),"");
    }
}
