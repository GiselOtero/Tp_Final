<?php
class AbmCompraEstado{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjeto($param){
        //print_r($param);
        $obj = null;
        if( array_key_exists('idcompraestado',$param) and array_key_exists('idcompra',$param) and array_key_exists('idcompraestadotipo',$param) and array_key_exists('cefechaini',$param) and array_key_exists('cefechafin',$param)){
            //echo "Crear Obj";
            $obj = new CompraEstado();

            /* *
             * $objAbmCompra=new AbmCompra();
             * $lista=$objAbmCompra->buscar($param['idcompra']);
             * 
             * $objAbmCompraEstadoTipo=new AbmCompraEstadoTipo();
             * $lista=$objAbmCompraEstadoTipo->buscar($param['idcompraestadotipo']);
             * 
             */

            $obj->setear($param['idcompraestado'], $param['idcompra'],$param['idcompraestadotipo'],$param['cefechaini'],$param['cefechafin']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        /* echo "cargarConClave";
        print_r($param); */
        if(isset($param['idcompraestado']) ){
            $obj = new CompraEstado();
            $obj->setear($param['idcompraestado'],null, null,null,null);
            //verEstructura($obj);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        /* echo "seteandoClaves";
        print_r($param); */
        $resp = false;
        if (isset($param['idcompraestado']))
            $resp = true;
        return $resp;
    }


    /* **** */

    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        //$param['idcompraestado'] =null;
        $unObjCompraEstado = $this->cargarObjeto($param);
        /* echo "\nAlta";
        verEstructura($unObjCompraEstado); */
        if ($unObjCompraEstado!=null and $unObjCompraEstado->insertar()){
            $resp = true;
        }
        return $resp;
        
    }


     /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        /* print_r($param);
        echo " Modificacion()"; */
        if ($this->seteadosCamposClaves($param)){
            $unObjCompraEstado = $this->cargarObjeto($param);
            //verEstructura($unObjCompraEstado);
            if($unObjCompraEstado!=null and $unObjCompraEstado->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param){
        $where = " true ";
        //print_r($param);
        if ($param<>NULL){
            if  (isset($param['idcompraestado']))
                $where.=" and idcompraestado ='".$param['idcompraestado']."'";
            /* if  (isset($param['idcompra']))
                 $where.=" and idcompra ='".$param['idcompra']."'";
                if  (isset($param['idcompraestadotipo']))
                 $where.=" and idcompraestadotipo ='".$param['idcompraestadotipo']."'"; 
                if  (isset($param['cefechafin']))
                 $where.=" and cefechafin ='".$param['cefechafin']."'"; 
                 */
        }
        $arreglo = CompraEstado::listar($where);  
        return $arreglo; 
    }
}
?>