<?php
class AbmMenuRol{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return MenuRol
     */
    private function cargarObjeto($param){
        //print_r($param);
        $obj = null;
        if( array_key_exists('idmenu',$param) and array_key_exists('idrol',$param)){
            //echo "Crear Obj";
            $obj = new MenuRol();

            /* *
             * $objAbmMenu=new AbmMenu();
             * $lista=$objAbmMenu->buscar($param['idmenu']);
             * 
             * $objAbmRol=new AbmRol();
             * $lista=$objAbmRol->buscar($param['idrol']);
             * 
             */

            $obj->setear($param['idmenu'], $param['idrol']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return MenuRol
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        /* echo "cargarConClave";
        print_r($param); */
        if(isset($param['idmenu']) ){
            $obj = new MenuRol();
            $obj->setear($param['idmenu'],null);
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
        if (isset($param['idmenu']))
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
        //$param['idmenu'] =null;
        $unObjMenuRol = $this->cargarObjeto($param);
        /* echo "\nAlta";
        verEstructura($unObjMenuRol); */
        if ($unObjMenuRol!=null and $unObjMenuRol->insertar()){
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
            $unObjMenuRol = $this->cargarObjeto($param);
            //verEstructura($unObjMenuRol);
            if($unObjMenuRol!=null and $unObjMenuRol->modificar()){
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
            if  (isset($param['idmenu']))
                $where.=" and idmenu ='".$param['idmenu']."'";
            /* if  (isset($param['idrol']))
                 $where.=" and idrol ='".$param['idrol']."'";
                 */
        }
        $arreglo = MenuRol::listar($where);  
        return $arreglo; 
    }
}
?>