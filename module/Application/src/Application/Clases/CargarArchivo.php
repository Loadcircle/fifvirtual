<?php
namespace Application\Clases;

//Se crear la clase para cargar archivos
class CargarArchivo
{


    public $Directorio=null;
    public $Origen=null;
    public $Destino=null;

    public function cargar(){

        return rename ($this->Origen,$this->Directorio."\\".$this->Destino );


    }
    public function existe(){

        return file_exists($this->Directorio."\\".$this->Destino);


    }
    public function borrar(){

        return unlink($this->Directorio."\\".$this->Destino);
    }







}

