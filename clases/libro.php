<?php
    include_once("basededatos.php");
    include_once("genero.php");
    class Libro{
        private $isbn;
        private $titulo;
        private $preciov;
        private $preciol;
        private $genero;
        private $stock;
        private $sotckmin;
        private $bd;

        public function __construct(){       
            $this->bd = new Conectar();
            $this->bd->conecta();
        }

        //ISBN
        public function setISBN($isbn){
            $this->isbn = $isbn;
        }
        public function getISBN(){
            return $this->isbn;
        }
        // TITULO
        public function setTitulo($titulo){
            $this->titulo = $titulo;
        }
        public function getTitulo(){
            return $this->titulo;
        }
        //PRECIO VENTA
        public function setPrecioV($preciov){
            $this->preciov = $preciov;
        }
        public function getPrecioV(){
            return $this->preciov;
        }
        //PRECIO LISTA
        public function setPrecioL($preciol){
            $this->preciol = $preciol;
        }
        public function getPreciol(){
            return $this->preciol;
        }
        //GENERO
        public function setGenero($genero){
            $this->genero = $genero;
        }
        public function getGenero(){
            return $this->genero;
        }
        //STOCK
        public function setStock($stock){
            $this->stock = $stock;
        }
        public function getStock(){
            return $this->stock;
        }
        //STOCK MINIMO
        public function setStockMin($stockmin){
            $this->stock = $stockmin;
        }
        public function getStockMin(){
            return $this->sotckmin;
        }
        
        public function mostrarLibros(){
            $libros = array();

            $consulta = "select * from libros";
            $result = $this->bd->ejecutar($consulta);
            if($result->num_rows > 0) {

                while($fila = mysqli_fetch_assoc($result)){
                    $genero = new Genero();
                    $libro = array(
                        "isbn" => $fila["isbn"],
                        "titulo" => $fila["titulo"],
                        "preciov" => $fila["preciov"],
                        "preciol" => $fila["preciol"],
                        "genero" => $genero->get_generos($fila["idgenero"]),
                        "stock" => $fila["stock"],
                        "stockmin" => $fila["stockmin"]
                    );
                    array_push($libros, $libro);
                   
                }
                
                return $libros;
            } 
            else { return FALSE; } 
        }

        public function eliminarLibro($isbn){
            $libros = array();
            $consulta = "delete from libros where libros.isbn=".$isbn;
            $result = $this->bd->ejecutar($consulta);
            return $result;
        }

        public function mostrarUnLibro($isbn){
            $libros = array();
            $consulta = "select * from libros where isbn=".$isbn;
            $result = $this->bd->ejecutar($consulta);
            if($result->num_rows > 0) {
                while($fila = mysqli_fetch_assoc($result)){
                    $genero = new Genero();
                    $libro = array(
                        "isbn" => $fila["isbn"],
                        "titulo" => $fila["titulo"],
                        "preciov" => $fila["preciov"],
                        "preciol" => $fila["preciol"],
                        "genero" => $genero->get_generos($fila["idgenero"]),
                        "stock" => $fila["stock"],
                        "stockmin" => $fila["stockmin"]
                    );
                    array_push($libros, $libro);
                }
                return $libro;
            } 
            else { return FALSE; } 
        }
        
        public function agregarLibro($visbn, $vtitulo, $vpreciov, $vpreciol, $vgenero, $vstock, $vstockmin){
            $consulta = "insert into libros values ( '". $visbn ."' , '". $vtitulo ."' , '". $vpreciov ."' , '". $vpreciol ."' , '". $vgenero ."' , '". $vstock ."' , '". $vstockmin ."' );";
            $result = $this->bd->ejecutar($consulta);
            return $result;
        }

        public function modificarLibro($visbn, $vtitulo, $vpreciov, $vpreciol, $vgenero, $vstock, $vstockmin){
            $consulta = "update libros SET titulo='".$vtitulo."', preciov='".$vpreciov."', preciol='".$vpreciol."', idgenero='".$vgenero."', stock='".$vstock."', stockmin='".$vstockmin."' WHERE libros.isbn =".$visbn;
            $result = $this->bd->ejecutar($consulta);
            return $result;
        }
    }
    
?>