<?php 

class ComplexNumber {
    private float $real; 
    private float $imagin; 

    /**
     * Class constructor.
     */
    public function __construct(float $real, float $imagin) {
        $this->real = $real;
        $this->imagin = $imagin;
    }

    public function getReal() {
        return $this->real;
    }

    public function getImagin() {
        return $this->imagin;
    }

    public function show () {
        $imagin_format = $this->imagin >= 0 ? " + {$this->imagin}" : $this->imagin;

        return "{$this->real} {$imagin_format}i";
    }

    public function sum (ComplexNumber $complex) {
        $real = $this->real + $complex->getReal();
        $imagin = $this->imagin + $complex->getImagin();
        
        return new ComplexNumber($real, $imagin);
    }
}