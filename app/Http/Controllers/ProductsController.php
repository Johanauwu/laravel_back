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
            "isbn" => "string|nullable", 
            "nombre" => "string|nullable", 
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
            "isbn" => "string",
            "name" => "string", 
            "stock" => "int", 
            "current_price" => "string", 
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

    public function editProducts($book_id,Request $request): object 
    {
        $validator = Validator::make($request->all(),[
            "isbn" => "string",
            "name" => "string", 
            "stock" => "int", 
            "current_price" => "string", 
        ]);

        if($validator->fails()){
            return (object) ResponseHelper::json_fail_puts($validator);
        }

        $response = ProductsRepository::EditProducts($book_id,$request);
        if(!$response){
            return (object) ResponseHelper::json_fail($response);
        }
        return (object) ResponseHelper::json_success(array(),"");

    }

    public function deleteProducts($id): object 
    { 

        $response = ProductsRepository::DeleteProducts($id);
        if(!$response){
            return (object) ResponseHelper::json_fail($response);
        }
        return (object) ResponseHelper::json_success(array(),"");
    }
}
