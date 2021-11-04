<?php
class AbmMenu{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Menu
     */
    private function cargarObjeto($param){
        //print_r($param);
        $obj = null;
        if( array_key_exists('idmenu',$param) and array_key_exists('menombre',$param) and array_key_exists('medescripcion',$param) and array_key_exists('idpadre',$param) and array_key_exists('medeshabilitado',$param)){
            //echo "Crear Obj";
            $obj = new Menu();

            /* $objPadre=new Menu();
            $objPadre->buscar($param['idpadre']); */

            $obj->setear($param['idmenu'], $param['menombre'],$param['medescripcion'],$param['idpadre'],$param['medeshabilitado']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Menu
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        /* echo "cargarConClave";
        print_r($param); */
        if(isset($param['idmenu']) ){
            $obj = new Menu();
            $obj->setear($param['idmenu'],null, null,null,null);
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
        $unObjMenu = $this->cargarObjeto($param);
        /* echo "\nAlta";
        verEstructura($unObjMenu); */
        if ($unObjMenu!=null and $unObjMenu->insertar()){
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
            $unObjMenu = $this->cargarObjeto($param);
            //verEstructura($unObjMenu);
            if($unObjMenu!=null and $unObjMenu->modificar()){
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
            /* if  (isset($param['menombre']))
                 $where.=" and menombre ='".$param['menombre']."'";
                if  (isset($param['medescripcion']))
                 $where.=" and medescripcion ='".$param['medescripcion']."'"; 
                if  (isset($param['medeshabilitado']))
                 $where.=" and medeshabilitado ='".$param['medeshabilitado']."'"; 
                 */
        }
        $arreglo = Menu::listar($where);  
        return $arreglo; 
    }
}
?>