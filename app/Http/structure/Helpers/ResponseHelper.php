<?php

namespace App\Http\structure\Helpers;

class ResponseHelper
{
    public static function json_fail_puts($validator,$mensaje = null)
    {
        $data = [
            "status" =>  false,
            "message" =>  (isset($mensaje)) ? $mensaje : "danger",
            "length" => 0,
            "data" => $validator->errors()->all(),
        ];
        return response()->json($data);
    }

    public static function json_fail($validator,$mensaje = null)
    {
        $data = [
            "status" =>  false,
            "message" =>  (isset($mensaje)) ? $mensaje : "danger",
            "length" => 0,
            "data" =>  $validator->errors(),
        ];
        return response()->json($data);
    }

    public static function json_failnoV($data,$mensaje = null)
    {
        $data = [
            "status" =>  false,
            "message" =>  (isset($mensaje)) ? $mensaje : "danger",
            "length" => 0,
            "data" => $data,
        ];
        return response()->json($data);
    }

    public static function json_successnoV($data,$mensaje = null)
    {
        $data = [
            "status" =>  false,
            "message" =>  (isset($mensaje)) ? $mensaje : "success",
            "length" => 0,
            "data" => $data,
        ];
        return response()->json($data);
    }


    public static function json_success($data,$mensaje = null)
    {
        $response = [
            "status" =>  true,
            "message" =>  (isset($mensaje)) ? $mensaje : "success",
            "length" => count($data),
            "data" => $data,
        ];
        return response()->json($response);
    }

    public static function json_token_login($user,$token,$mensaje)
    {
        return response()->json([
            "status" => true,
            "message" => (isset($mensaje)) ? $mensaje : "success",
            "token" => $token,
            "token_type" => 'Bearer',
            "data" => $user,
        ]);
    }

    public static function getCustomConfig(){
        return array (

            'paginate' => "50",
            'url_asterisk_ip_anexo' => 'http://192.168.60.13/ipanexo.php?ip=', //pasar el parametro ip para obtener el anexo
            'url_asterisk_id_llamada' => 'http://192.168.60.13/anexouniqueid.php?anexo=', //pasar el parametro  anexo para obtener el uniqId
            'url_asterisk_call_status' => 'http://192.168.60.13/anexocallstatus.php?anexo=', //pasar el parametro  anexo para obtener el status de la llamada 0, 1
            'url_asterisk_call_in' => 'http://192.168.60.13/callin.php?anexo=', //pasar el parametro  anexo para obtener el status de la llamada 0, 1
            'cookieTimeExpire' => time()+60*60*24*30, //30 dias
            'permissions' => array( //Solo para los que no son Administradores
                'mantenance' => array('index', 'add', 'edit', 'delete', 'indexcrawler'), //Si el usuario tiene acceso a matenimiento puede entrar a estas acciones: tabla: ct_users_ct_permissions, column: mantenance_access = 1
                'notMantenance' => array('index', 'indexcrawler'), //Si el usuario no tiene acceso a matenimiento solo puede entrar a estas acciones : tabla: ct_users_ct_permissions, column: mantenance_access = 0
            ),
            'emailing' => array( //Envio de correos
                'server' => 'smtp.office365.com',
                'from' => 'support@securitec.pe',
                'passw' => '$%2S0p0rtE21',
                'port' => '587',
            ),
            'months' => array(
                '01'   =>  'Enero',
                '02'   =>  'Febrero',
                '03'   =>  'Marzo',
                '04'   =>  'Abril',
                '05'   =>  'Mayo',
                '06'   =>  'Junio',
                '07'   =>  'Julio',
                '08'   =>  'Agosto',
                '09'   =>  'Septiembre',
                '10'  =>  'Octubre',
                '11'  =>  'Noviembre',
                '12'  =>  'Diciembre'
            ),
            // tablas planas
            'tablas_planas_ids' => array(
                //clientes
                'documento'=>1, /*'ubicabilidad'=>2,*/ 'personeria'=>3, 'fuente'=>4, 'origen'=>5, 'origen_direc'=>6, 'origen_email'=>7,
                'estado'=>8, 'cuadrante'=>9, 'validacion'=>10, 'parentesco'=>11, 'parentesco_ripley'=>42,'parentesco_ripley_preventiva'=>68, 'prioridad'=>12, 'cond_laboral'=>13, 'sector_laboral'=>14,
                'calificacion'=>15, 'zona'=>17, 'estado_civil'=>18, 'rentas'=>19, 'cond_vivienda'=>36, 'tipo_telefono'=>37,
                'tipo_direccion'=>38,'parentesco_stnd'=>69,
                //Proveedores
                'segmento'=>20,
                //Usuarios
                'sexo'=>16, 'modalidad'=>21, 'turno'=>22, 'nivel'=>23, 'asignacion'=>25, 'motivo_cese'=>26, 'tipo_usuario'=>39,
                //Importador
                'asignacion_importador'=>27, 'moneda'=>28,
                //Cuentas
                'estado_cuentas'=>29,
                //Gestiones
                'tipo_movimiento'=>30, 'tipo_frecuencia'=>31, 'estado_cuotas'=>32, 'estado_distribuciones'=>33, 'tipo_cuota'=>34, 'tipo_convenio'=>35,'tipo_entrada'=>41,'origen_choices'=>43, 'opcion_satisfaccion'=>44, 'opcion_calidad'=>45, 'opcion_credito'=>46, 'satisfaccion_producto'=>47, 'satisfaccion_obsequio'=>48, 'tipo_andina_encuestado'=>50, 'tipo_andina_tiempo'=>51, 'tipo_andina_empresac'=>52, 'tipo_andina_lineas'=>54, 'tipo_andina_comparacion1'=>55, 'tipo_andina_comparacion2'=>56, 'tipo_andina_opciones'=>59, 'tipo_andina_frecuencia'=>57, 'tipo_andina_representante'=>58, 'tipo_andina_calificiacion'=>60, 'tipo_andina_canal'=>62,
                'tipo_filtro'=>49,
                ),

            'tipo_estado' => array('activo'=>1, 'inactivo'=>2, 'eliminado'=>3, 'gestionado'=>3), //Gestionado es para los estados de cuenta (valor 3 tambien)
            'tipo_asignacion' => array('fijo'=>1, 'temporal'=>2), // Usuarios Carteras
            'tipos_distribucion_cuentas' => array('normal'=>1, 'apoyo'=>2, 'liberadas'=>3), //Para la distribucion de las cuentas TABLA: Usuarios temporales
            'distribuciones_temporales' => array('origen'=>1, 'destino'=>2), //ver de que tipo de bloque provienen TABLA: distribuciones temporales (bloque)
            'asignacion_importador' => array('Adición'=>1, 'Actualización'=>2, 'Asignación'=>3),
            //Parametros para el importador
            'excel_extensions' =>array('xls', 'xlsx'),
            'excel_size_max' => 16000000,

            //Ordenamiento
            'columnas' =>array('ult_gestion'=>'Últ. Gestion', 'cliente'=>'Cliente', 'deuda'=>'Deuda', 'mora'=>'D. Mora'),
            'ordenamiento' => array('ASC'=>'ASC','DESC'=>'DESC'),
            //Supervisores ripley vencido
            'agentes_ripley_recovery' => array('ETANTALEAN'=>'ETANTALEAN','GPOMEZ'=>'GPOMEZ','JALBURQUEQUE'=>'JALBURQUEQUE','MPAZ'=>'MPAZ','NHURTADO'=>'NHURTADO'),
            'agentes_ripley_vencido' => array('MESCALANTE'=>'MESCALANTE','JVALENCIA'=>'JVALENCIA','JALBURQUEQUE'=>'JALBURQUEQUE','MPAZ'=>'MPAZ','NHURTADO'=>'NHURTADO'),
            //confianza ids
            'confianza_ids' => array(23,24,32,39,40,99,100,86,106,118,86,119),
            'grupo_financiero_ids' => array(48,49),
            'venta_ids' => array(41),
            'ripley_ids' => array(33,6,98,108,122,204),
            'mibanco_ids' => array(117,147,167,103,195,196,198,199,200,201,205,206,209,214,240,229,241,216,226),
			'sullana_ids' => array(79,80,134),
            'especial_ids' => array(116,96),
            'santander_ids' => array(112,193,153,197,208,217,218,219,220,221,222),
            'autoplan_ids' => array(202),
            'especial_andina_ids' => array(120),
            'bancom_ids' => array(210,211),
            'oncosalud_ids' => array(224),
            'niubiz_ids' => array(227,228),
            //info cuentas
            'info_cuentas'=>array(
                'cencosud_castigo' =>array('Nro Cuenta','Producto','Capital', 'Vencido', 'Total', 'Campaña','F. Castigo'),
                'cencosud_vigente' =>array('Nro Cuenta','Producto','Capital', 'Saldo Mora', 'S. Facturado', 'Mínimo'),
                'cencosud_vigente_ii' =>array('Nro Cuenta','Producto','Capital', 'Saldo Mora', 'S. Facturado', 'Mínimo'),
                'saga_castigo' =>array('Nro Cuenta','Producto','Capital', 'Vencido', 'Total', 'Mínimo','D. Mora','Dscto',
                                        'F.Vencimiento','Grupo','Ciclo','Nro Tarjeta','Incremental','Tramo'
                                        ),
                'ripley_vencido' =>array('Nro Cuenta','Producto','Capital', 'Vencido', 'Total', 'Mínimo','D. Mora','Dscto',
                                        'F.Vencimiento','Grupo','Ciclo','Observación','Tipo Tarjeta','Tramo'
                                        ),
                'otros' =>array('Nro Cuenta','Producto','Capital', 'Vencido', 'Total', 'Mínimo','D. Mora','Dscto',
                                        'F.Vencimiento','Grupo','Ciclo','Observación','Incremental','Tramo'
                                        ),
            )

        );
    }
}
