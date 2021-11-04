<?php
class AbmUsuarioRol{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return UsuarioRol
     */
    private function cargarObjeto($param){
        //print_r($param);
        $obj = null;
        if( array_key_exists('idusuario',$param) and array_key_exists('idrol',$param)){
            //echo "Crear Obj";
            $obj = new UsuarioRol();

            /* *
             * $objAbmUsuario=new AbmUsuario();
             * $lista=$objAbmUsuario->buscar($param['idusuario']);
             * 
             * $objAbmRol=new AbmRol();
             * $lista=$objAbmRol->buscar($param['idrol']);
             * 
             */
            $obj->setear($param['idusuario'], $param['idrol']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return UsuarioRol
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        /* echo "cargarConClave";
        print_r($param); */
        if(isset($param['idusuario']) ){
            $obj = new UsuarioRol();
            $obj->setear($param['idusuario'],null);
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
        if (isset($param['idusuario']))
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
        //$param['idusuario'] =null;
        $unObjUsuarioRol = $this->cargarObjeto($param);
        /* echo "\nAlta";
        verEstructura($unObjUsuarioRol); */
        if ($unObjUsuarioRol!=null and $unObjUsuarioRol->insertar()){
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
            $unObjUsuarioRol = $this->cargarObjeto($param);
            //verEstructura($unObjUsuarioRol);
            if($unObjUsuarioRol!=null and $unObjUsuarioRol->modificar()){
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
            if  (isset($param['idusuario']))
                $where.=" and idusuario ='".$param['idusuario']."'";
            if  (isset($param['idrol']))
                $where.=" and idrol ='".$param['idrol']."'";
                
        }
        $arreglo = UsuarioRol::listar($where);  
        return $arreglo; 
    }
}
?>