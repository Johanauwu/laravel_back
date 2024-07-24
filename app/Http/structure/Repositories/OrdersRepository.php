<?php

namespace App\Http\structure\Repositories;

use Exception;
use App\Models\Config;
use App\Models\pos_order;
use App\Models\pos_order_detail;
use Faker\Core\Number;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class OrdersRepository
{
    public static function getOrders($request)
    {
        $id = $request->input("id");
        $tipo_estado = $request->input("tipo_estado");
        $sql = "select * from pos_order where 1 ";
        if($id!=0){ $sql .= " and id = '$id' "; }
        if($id!=0){ $sql .= " and tipo_estado = '$tipo_estado' "; }
        $data = DB::select($sql);
        return $data;
    }

    public function AddOrders(Request $request)
    {
        $doc_type = $request['doc_type'];
        $doc_number =  $this->generateDocNumber($doc_type);
        $data = new pos_order;
        $data->client_id = $request['client_id'];
        $data->total = $request['total'];
        // $data->user_reg = auth()->user()['id'];
        // $data->fecha_reg = date('Y-m-d H:m:s');
        $data->doc_type = $request['doc_type'];
        $data->doc_number = $doc_number;
        $data->created_at = date('Y-m-d H:m:s'); 
        $data->save();
        $order_id=$data->order_id;
        $orders_detail=$request['data_orders'];
        foreach ($orders_detail as $detail) {
            $order_id=$detail['order_id'];
            $book_id=$detail['book_id'];
            $quantity=$detail['quantity'];
            $detail_price=$detail['detail_price']; 
            $data1 = new pos_order_detail;
            $data1->order_id = $order_id;
            $data1->book_id = $book_id;
            // $data->user_reg = auth()->user()['id'];
            // $data->fecha_reg = date('Y-m-d H:m:s');
            $data1->quantity = $quantity;
            $data1->detail_price = $detail_price; 
            $data1->save();
        }
        return $doc_number;
    }
    private function generateDocNumber($doc_type)
    {
        switch ($doc_type) {
            case 1:
                return str_pad(rand(1, 999999999999), 12, '0', STR_PAD_LEFT);
            case 2:
                return str_pad(rand(1, 99999999999999999999), 20, '0', STR_PAD_LEFT);
            default:
                return null;
        }
    }
    public static function EditOrders($id, Request $request)
    {
        $data=pos_order::where('id','=',$id)->first();
        $data->client_id = $request['client_id'];
        $data->total = $request['total'];
        // $data->user_reg = auth()->user()['id'];
        // $data->fecha_reg = date('Y-m-d H:m:s');
        $data->doc_type = $request['doc_type'];
        $data->doc_number = $request['doc_number'];
        $data->created_at = date('Y-m-d H:m:s'); 
        return $data->save();
    }

    public static function DeleteOrders($id)
    { 
        $data = pos_order::find($id); 
        return  $data->delete(); 
    }


}
