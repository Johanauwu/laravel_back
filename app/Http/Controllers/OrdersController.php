<?php

namespace App\Http\Controllers;

use App\Http\structure\Helpers\ResponseHelper;
use App\Http\structure\Repositories\OrdersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    public function getOrders(Request $request): object 
    {
        $validator = Validator::make($request->all(),[
            "id" => "int",
            "tipo_estado" => "nullable|int", 
        ]);

        if($validator->fails()){
            return (object) ResponseHelper::json_fail($validator);
        }
        $response = OrdersRepository::getOrders($request);

        return (object) ResponseHelper::json_success($response);

    }

    public function addOrders(Request $request): object 
    {
        $validator = Validator::make($request->all(),[
            "client_id" => "int",  
            "doc_type" => "int",  
        ]);

        if($validator->fails()){
            return (object) ResponseHelper::json_fail($validator);
        }
        $response = OrdersRepository::AddOrders($request);
        if (!$response) {
            return (object) ResponseHelper::json_fail($response);
        }
        return (object) ResponseHelper::json_success(array(),"");
    }

    public function editOrders($id,Request $request): object 
    {
        $validator = Validator::make($request->all(),[
            "client_id" => "int", 
            "total" => "string", 
            "doc_type" => "int", 
            "doc_number" => "int",
        ]);

        if($validator->fails()){
            return (object) ResponseHelper::json_fail_puts($validator);
        }

        $response = OrdersRepository::EditOrders($id,$request);
        if(!$response){
            return (object) ResponseHelper::json_fail($response);
        }
        return (object) ResponseHelper::json_success(array(),"");

    }

    public function deleteOrders($id): object 
    {
        $response = OrdersRepository::DeleteOrders($id);
        if(!$response){
            return (object) ResponseHelper::json_fail($response);
        }
        return (object) ResponseHelper::json_success(array(),"");
    }

}
