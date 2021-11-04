<?php
class AbmCompraEstadoTipo{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return CompraEstadoTipo
     */
    private function cargarObjeto($param){
        //print_r($param);
        $obj = null;
        if( array_key_exists('idcompraestadotipo',$param) and array_key_exists('cetdescripcion',$param) and array_key_exists('cetdetalle',$param)){
            //echo "Crear Obj";
            $obj = new CompraEstadoTipo();
            $obj->setear($param['idcompraestadotipo'], $param['cetdescripcion'],$param['cetdetalle']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return CompraEstadoTipo
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        /* echo "cargarConClave";
        print_r($param); */
        if(isset($param['idcompraestadotipo']) ){
            $obj = new CompraEstadoTipo();
            $obj->setear($param['idcompraestadotipo'],null, null);
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
        if (isset($param['idcompraestadotipo']))
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
        //$param['idcompraestadotipo'] =null;
        $unObjCompraEstadoTipo = $this->cargarObjeto($param);
        /* echo "\nAlta";
        verEstructura($unObjCompraEstadoTipo); */
        if ($unObjCompraEstadoTipo!=null and $unObjCompraEstadoTipo->insertar()){
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
            $unObjCompraEstadoTipo = $this->cargarObjeto($param);
            //verEstructura($unObjCompraEstadoTipo);
            if($unObjCompraEstadoTipo!=null and $unObjCompraEstadoTipo->modificar()){
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
            if  (isset($param['idcompraestadotipo']))
                $where.=" and idcompraestadotipo ='".$param['idcompraestadotipo']."'";
            /* if  (isset($param['cetdescripcion']))
                 $where.=" and cetdescripcion ='".$param['cetdescripcion']."'";
            if  (isset($param['cetdetalle']))
                 $where.=" and cetdetalle ='".$param['cetdetalle']."'"; */
        }
        $arreglo = CompraEstadoTipo::listar($where);  
        return $arreglo; 
    }
}
?>