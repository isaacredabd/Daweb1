
<?php
importar('core/helpers/utilerias');
importar('apps/artesanias/models/clasificacion');
importar('apps/artesanias/views/clasificacion');

class ClasificacionController extends Controller  {

    public function agregar(){
        $sql = "SELECT * FROM clasificacion";
        
        $data = $this->model->query($sql);

        $this->view->agregar($data);
    }
    /*
    public function editar(){
        $sql = "SELECT * FROM clasificacion";   
        $clasificacionListado = $this->model->query($sql);
        $clasificacionListado = $this->model->getById($id);
        $this->view->agregar($clasificacionListado, $clasificacion)
    }

    public function editar($id=0){
        $sql = "SELECT * FROM clasificacion";
        $clasificacionListado = $this->model->query($sql);
        $clasificacion = $this->model->getById($id);

        $this->view->editar($clasificacionListado,$clasificacion);
    }
    
   public function editar($id=0){
   $sql = "SELECT C.id, if(C.padre =P.id,'selected','') as selected,
    C.descripcion, C.padre FROM clasificacion C LEFT JOIN clasificacion p
    ON C. padre=P.id";
    $clasificacionListado = $clasificacion =$this->model->query($sql);
    $this->view->editar($clasificacionListado, $clasificacion);
}
*/
public function editar($id=0){
    $sql= "SELECT  A.padre 
        FROM clasificacion A WHERE A.id=$id ";

    $sql = "SELECT C.id, C.descripcion, C.padre,
      if(A.padre=C.id,'selected','') as selected
     FROM clasificacion as C, ($sql) as A";
    $clasificacionListado = $this->model->query($sql);
    $clasificacion = $this->model->getById($id);

    $this->view->editar($clasificacionListado, $clasificacion);
}
    
 

public function listar($formato){
    $sql = "SELECT C.id, C.descripcion, 
        IFNULL(P.descripcion, 'Ninguno') as padre 
            FROM clasificacion C LEFT JOIN clasificacion P 
            ON C.padre=P.id";
    $data = $this->model->query($sql);
   if (empty($formato)){
        $this->view->listar($data);
    } else if ($formato=="json"){
        print(json_encode($data));
    }
    else if ($formato=="xml"){
        $xml= Utilerias::toXml($data,"clasificaciones","clasificacion" );
        echo $xml;
    }
    
}
    public function guardar(){
        //print_r()
        $id           = $_POST['id']??0;
        $descripcion = $_POST['descripcion'];
        $padre       = $_POST['padre'];
        //--- validar datos
 
        //--- asociar al modelo
        $this->model->id=$id;
        $this->model->descripcion = $descripcion;
        $this->model->padre       = $padre;
        $this->model->save();
        //--- 
        HTTPHelper::go("/artesanias/clasificacion/listar");
     }

     public function eliminar($id){
        $this->model->delete($id);
        HTTPHelper::go("/artesanias/clasificacion/listar");
    }


}

?>


