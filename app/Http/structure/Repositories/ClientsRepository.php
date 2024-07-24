<?php

namespace App\Http\structure\Repositories;

use Exception;
use App\Models\Config;
use App\Models\pos_client;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class ClientsRepository
{
    public static function getClients($dni)
    { 
        $sql = "select * from pos_client where 1 ";
        if($dni!=0){ $sql .= " and doc_number = '$dni' "; } 
        $data = DB::select($sql);
        return $data;
    }

    public static function AddClients(Request $request)
    {
        $data = new pos_client;
        $data->doc_type = $request['doc_type'];
        $data->doc_number = $request['doc_number'];
        // $data->user_reg = auth()->user()['id'];
        // $data->fecha_reg = date('Y-m-d H:m:s');
        $data->first_name = $request['first_name'];
        $data->last_name = $request['last_name'];
        $data->phone = $request['phone'];
        $data->email = $request['email']; 
        return $data->save();
    }

    public static function EditClients(Request $request)
    {
        // $data=pos_client::where('client_id','=',$request['id'])->first();
        $client_id = $request['client_id'];
        $doc_type = $request['doc_type'];
        $doc_number = $request['doc_number'];
        // $user_reg = auth()->user()['id'];
        // $fecha_reg = date('Y-m-d H:m:s');
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $phone = $request['phone'];
        $email = $request['email']; 
        
        DB::select("UPDATE pos_client set doc_type='$doc_type',doc_number='$doc_number',first_name='$first_name',last_name='$last_name',phone='$phone',email='$email' where client_id=$client_id");
        return $client_id;
    }

    public static function DeleteClients($id)
    {
        $data = pos_client::find($id); 
        return  $data->delete(); 
    }


}
