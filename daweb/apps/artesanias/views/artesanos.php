<?php

class ArtesanosView  {

    public function agregar($list=[]){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/artesanos_agregar.html"); 
        $html = Template($str)->render_regex('LISTADO_ARTENSANOS', $list);
        print Template('Agregar artesanos')->show($html);
    } 

    public function editar($artesanos){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/artesanos_editar.html"); 
            print Template('Editar artesanos')->show($html);
    } 

    public function listar($list=array()) {
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/artesanos_listar.html"); 
        $html = Template($str)->render_regex('LISTADO_ARTESANOS', $list);
        print Template('Listado de artesanos')->show($html);
    }



}

?>