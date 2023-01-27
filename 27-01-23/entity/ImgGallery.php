<?php
    
class ImgGallery {

    const PORTFOLIO_IMG_PATH = "images/index/portfolio/";
    const IMG_GALLERY_PATH = "images/gallery/";

    private string $name;
    private string $description;

    private int $views;

    private int $likes;

    private int $downloads;


    public function __construct(string $name, string $description, int $views = 0, int $likes, int $downloads)
    {
        $this->name = $name;
        $this->description = $description;
        $this->views = $views;
        $this->likes = $likes;
        $this->downloads = $downloads;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setViews(int $views) {
        $this->views = $views;
    }

    public function getViews() {
        return $this->views;
    }

    public function setLikes(int $likes) {
        $this->likes = $likes;
    }

    public function getLikes() {
        return $this->likes;
    }

    public function setdownLoads(int $downloads) {
        $this->downloads = $downloads;
    }

    public function getDownloads() {
        return $this->downloads;
    }

    public function __toString(){
        return $this->getDescription();
    }

    public function getUrlPortfolio() {
        return self::PORTFOLIO_IMG_PATH . $this->getName();
    }

    public function getUrlImgInGallery() {
        return self::IMG_GALLERY_PATH . $this->getName();
    }

    /**
     * Preguntas Ejercicio 1
     * 
     * 1) ¿Cuál es la diferencia entre private, protected y public?
     * - private: Solo tienen acceso a los atributos la misma clase
     * - protected: Solo tienen acceso a los atributos la misma clase y sus herederos
     * - public: Tienen acceso a los atributos de la clase cualquiera
     * 
     * 2) El método __construct es un método mágico en PHP. ¿Qué quiere decir esto? 
     * Visita el siguiente enlace para contestar 
     * https://diego.com.es/metodos-magicos-en-php
     * Los métodos mágicos permiten realizar acciones en objetos cuando 
     * suceden determinados eventos que los activan, suelen denominarse con "__" al inicio
     * del nombre del método. En el caso de construct permite inyectar parámetros y dependecias
     * cuando se construye el objeto.
     * 
     * 3) ¿Una clase en PHP puede tener más de un constructor?
     * No, solo puede poseer un único constructor, por lo que los desarrolladores realizan una
     * serie de técnicas para saltarse está limitación.
     * 
     * 4) Vamos a hacer una prueba. Crea una instancia de la clase ImagenGaleria e imprímela con
     * echo. ¿Qué sucede?
     * Da un error,ya que es un objeto que no tiene definido el método toString
     * y no puede ser parseado.
     * 
     * 5) Crea un método mágico __toString() que devuelva la descripción de la imagen a través del
     * getter y prueba ahora a imprimirla de nuevo con echo. ¿Qué ha sucedido?
     * Definido el toString podemos ver el valor de la descripción en pantalla.
     */

     /**
     * Preguntas Ejercicio 2
     * 
     * 1) ¿Cuál es la diferencia entre self y $this?
     * self nos permite acceder a propiedas de la propia clase, 
     * mientras $this nos permite acceder a propiedades de la instancia u objeto.
     * 
     * 2) ¿Qué hace el operador de resolución de ámbito ::? ¿Cómo funciona?¿Podrías 
     * dar un ejemplo aplicado a esta clase?
     * El operador :: nos permite acceder a constantes, atributos estáticos o funciones
     * estáticas. 
     * Funciona utilizando de la siguiente forma: <nombre_de_la_clase>::<propiedad>
     * Ej: En el método getUrlPortfolio accedemos a la constante PORTFOLIO_IMG_PATH de la 
     * siguiente forma -> self::PORTFOLIO_IMG_PATH
     */

}