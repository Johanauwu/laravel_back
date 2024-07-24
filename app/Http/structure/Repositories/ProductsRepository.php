<?php

namespace App\Http\structure\Repositories;

use Exception;
use App\Models\Config;
use App\Models\pos_book;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class ProductsRepository
{
    public static function getProducts($request)
    {
        $isbn = $request["isbn"];
        $nombre = $request["nombre"];
        $sql = "select * from pos_book where 1 ";
        if($isbn!=''){ $sql .= " and isbn = '$isbn' "; } 
        if($nombre!=''){ $sql .= " and name like '%$nombre%' "; } 
        $data = DB::select($sql);
        return $data;
    }

    public static function AddProducts(Request $request)
    {
        $data = new pos_book;
        $data->isbn = $request['isbn'];
        $data->name = $request['name'];
        // $data->user_reg = auth()->user()['id'];
        // $data->fecha_reg = date('Y-m-d H:m:s');
        $data->stock = $request['stock'];
        $data->current_price = $request['current_price']; 
        return $data->save();
    }

    public static function EditProducts($book_id, Request $request)
    { 
        $isbn = $request['isbn'];
        $name = $request['name'];
        // $user_reg = auth()->user()['id'];
        // $fecha_reg = date('Y-m-d H:m:s');
        $stock = $request['stock'];
        $current_price = $request['current_price']; 
        DB::select("UPDATE pos_book set isbn='$isbn',name='$name',stock='$stock',current_price='$current_price' where book_id=$book_id");
        return $isbn;
    }

    public static function DeleteProducts($id)
    {
        DB::select("DELETE FROM pos_book where book_id=$id");
        return  "HOLA"; 
    }


}
