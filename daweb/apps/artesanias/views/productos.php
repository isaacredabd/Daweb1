<?php

class ProductosView  {
	

	public function agregar($artesanos=[], $clasificacion=[]){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/productos_agregar.html"); 
        $html = Template($str)->render_regex('LISTADO_ARTESANOS', $artesanos);
        $html = Template($html)->render_regex('LISTADO_CLASIFICACION', $clasificacion);
        print Template('Agregar productos')->show($html);
    } 

    public function listar($list=array()) {
        $carouselhtml="";
     
        $carouselstr= file_get_contents(
            STATIC_DIR . "html/artesanias/imprimir.html"); 
            for ($i=0; $i<sizeof($list) ; $i++) {
               
                $arrayimagenes = [];
                $imagenes=[];
                $imagenes= explode( ',', $list[$i]['imagenes']);
                for ($j=0; $j<sizeof($imagenes) ; $j++) {
                    if ($j>0){
                        $carouselhtml=$carouselhtml. " <div class=\"carousel-item  \">
                        <img class=\"d-block w-100 \" src=\"/uploads/".$imagenes[$j]."\" alt=\"First slide\">
                    </div>";
                       
                    }
                    else {
                        $carouselhtml=$carouselhtml. " <div class=\"carousel-item  active\">
                        <img class=\"d-block w-100  \" src=\"/uploads/".$imagenes[$j]."\" alt=\"First slide\">
                    </div>";}
                    
                   
                }
                $list[$i]['carousel'] = $carouselhtml;     
                $carouselhtml="";
               
            }
 
            
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/productos_listar.html"); 
        $html = Template($str)->render_regex('LISTADO_PRODUCTOS', $list);    
        print Template('Listado de productos')->show($html);
    }
	
	 public function editar($list=[], $productos){
        

        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/productos_editar.html"); 
        $html = Template($str)->render_regex('LISTADO_PRODUCTOS', $list);
        $html = Template($html)->render($productos);
        print Template('Editar productos')->show($html);
    } 
    

 

}

?>