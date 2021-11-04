<?php
class AbmCompra{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Compra
     */
    private function cargarObjeto($param){
        //print_r($param);
        $obj = null;
        if( array_key_exists('idcompra',$param) and array_key_exists('cofecha',$param) and array_key_exists('idusuario',$param)){
            //echo "Crear Obj";
            $obj = new Compra();

            
            $objUsuario= new AbmUsuario();
            $listaUsuario= $objUsuario->buscar($param['idusuario']);
            if($listaUsuario>0){
                $obj->setear($param['idcompra'], $param['cofecha'],$listaUsuario[0]);
            }
            
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Compra
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        /* echo "cargarConClave";
        print_r($param); */
        if(isset($param['idcompra']) ){
            $obj = new Compra();
            $obj->setear($param['idcompra'],null, null);
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
        if (isset($param['idcompra']))
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
        //$param['idcompra'] =null;
        $unObjCompra = $this->cargarObjeto($param);
        /* echo "\nAlta";
        verEstructura($unObjCompra); */
        if ($unObjCompra!=null and $unObjCompra->insertar()){
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
            $unObjCompra = $this->cargarObjeto($param);
            //verEstructura($unObjCompra);
            if($unObjCompra!=null and $unObjCompra->modificar()){
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
            if  (isset($param['idcompra']))
                $where.=" and idcompra ='".$param['idcompra']."'";
            /* if  (isset($param['cofecha']))
                 $where.=" and cofecha ='".$param['cofecha']."'";
            if  (isset($param['idusuario']))
                 $where.=" and idusuario ='".$param['idusuario']."'"; */
        }
        $arreglo = Compra::listar($where);  
        return $arreglo; 
    }
}
?>