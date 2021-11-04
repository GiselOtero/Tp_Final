<?php
class AbmRol{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Rol
     */
    private function cargarObjeto($param){
        //print_r($param);
        $obj = null;
        if( array_key_exists('idrol',$param) and array_key_exists('rodescripcion',$param)){
            //echo "Crear Obj";
            $obj = new Rol();
            $obj->setear($param['idrol'], $param['rodescripcion']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Rol
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        /* echo "cargarConClave";
        print_r($param); */
        if(isset($param['idrol']) ){
            $obj = new Rol();
            $obj->setear($param['idrol'],null);
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
        if (isset($param['idrol']))
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
        //$param['idrol'] =null;
        $unObjRol = $this->cargarObjeto($param);
        /* echo "\nAlta";
        verEstructura($unObjRol); */
        if ($unObjRol!=null and $unObjRol->insertar()){
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
            $unObjRol = $this->cargarObjeto($param);
            //verEstructura($unObjRol);
            if($unObjRol!=null and $unObjRol->modificar()){
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
            if  (isset($param['idrol']))
                $where.=" and idrol ='".$param['idrol']."'";
            /* if  (isset($param['rodescripcion']))
                 $where.=" and rodescripcion ='".$param['rodescripcion']."'";
                 */
        }
        $arreglo = Rol::listar($where);  
        return $arreglo; 
    }
}
?>