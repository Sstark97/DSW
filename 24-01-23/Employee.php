<?php 

class Employee {
    private $name;
    private $salary;

    public function __construct ($name, $salary) {
        $this->name = $name;
        $this->salary = $salary;
    }

    public function showName () {
        $to_pay = $this->salary > 3000 ? "Debe pagar impuestos" : "No debe pagar impuestos";
        $name = $this->name;
        
        return "$name $to_pay";
    }

    public function setName (string $name) {
        $this->name = $name;
    }
}