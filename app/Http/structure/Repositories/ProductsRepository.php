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
        $id = $request->input("id");
        $tipo_estado = $request->input("tipo_estado");
        $sql = "select * from pos_book where 1 ";
        if($id!=0){ $sql .= " and id = '$id' "; }
        if($id!=0){ $sql .= " and tipo_estado = '$tipo_estado' "; }
        $data = DB::select($sql);
        return $data;
    }

    public static function AddProducts(Request $request)
    {
        $data = new pos_book;
        $data->id_proveedor = $request['id_proveedor'];
        $data->cartera = $request['cartera'];
        $data->user_reg = auth()->user()['id'];
        $data->fecha_reg = date('Y-m-d H:m:s');
        $data->tipo_estado = $request['tipo_estado'];
        $data->especial = $request['especial'];
        $data->predictivo = $request['predictivo'];
        $data->progresivo = $request['progresivo'];
        $data->IVR_Identify = $request['IVR_Identify'];
        $data->user_activa = $request['user_activa'];
        $data->fecha_activa = $request['fecha_activa'];
        $data->id_troncal = $request['id_troncal'];
        $data->aleatorio = $request['aleatorio'];
        $data->tipo_llamada = $request['tipo_llamada'];
        $data->did = $request['did'];
        $data->actualizacion = $request['actualizacion'];
        return $data->save();
    }

    public static function EditProducts($id, Request $request)
    {
        $data=pos_book::where('id','=',$id)->first();

        $data->id = $request['id'];
        $data->id_proveedor = $request['id_proveedor'];
        $data->cartera = $request['cartera'];
        $data->user_modi = auth()->user()['id'];
        $data->fecha_modi = date('Y-m-d');
        $data->tipo_estado = $request['tipo_estado'];
        $data->especial = $request['especial'];
        $data->predictivo = $request['predictivo'];
        $data->progresivo = $request['progresivo'];
        $data->IVR_Identify = $request['IVR_Identify'];
        $data->user_activa = $request['user_activa'];
        $data->fecha_activa = $request['fecha_activa'];
        $data->user_cancela = $request['ser_cancela'];
        $data->fecha_cancela = $request['fecha_cancela'];
        $data->id_troncal = $request['id_troncal'];
        $data->aleatorio = $request['aleatorio'];
        $data->tipo_llamada = $request['tipo_llamada'];
        $data->did = $request['did'];
        $data->actualizacion = $request['actualizacion'];

        return $data->save();
    }

    public static function DeleteProducts($id,Request $request)
    {
        $data = pos_book::where ('id','=',$id)->first();
        $data->tipo_estado = 0;
        return $data->save();
    }


}
