<?php

namespace App\Http\Controllers;

use App\Http\structure\Helpers\ResponseHelper;
use App\Http\structure\Repositories\ClientsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientsController extends Controller
{
    public function getClients($dni): object 
    { 
        $response = ClientsRepository::getClients($dni);

        return (object) ResponseHelper::json_success($response);

    }

    public function addClients(Request $request): object 
    {
        $validator = Validator::make($request->all(),[ 
            "doc_number" => "string", 
            "doc_type" => "int", 
            "email" => "string", 
            "first_name" => "string", 
            "last_name" => "string", 
            "phone" => "string",  
        ]);

        if($validator->fails()){
            return (object) ResponseHelper::json_fail($validator);
        }
        $response = ClientsRepository::AddClients($request);
        if (!$response) {
            return (object) ResponseHelper::json_fail($response);
        }
        return (object) ResponseHelper::json_success(array(),"success");
    }

    public function editClientes(Request $request): object 
    {
        $validator = Validator::make($request->all(),[
            "doc_number" => "string", 
            "doc_type" => "int", 
            "email" => "string", 
            "first_name" => "string", 
            "last_name" => "string", 
            "phone" => "string",  
        ]);

        if($validator->fails()){
            return (object) ResponseHelper::json_fail_puts($validator);
        }

        $response = ClientsRepository::EditClients($request);
        if(!$response){
            return (object) ResponseHelper::json_fail($response);
        }
        return (object) ResponseHelper::json_success(array(),"");

    }

    public function deleteClients($id): object 
    {

        $response = ClientsRepository::DeleteClients($id);
        if(!$response){
            return (object) ResponseHelper::json_fail($response);
        }
        return (object) ResponseHelper::json_success(array(),"");
    }

}
