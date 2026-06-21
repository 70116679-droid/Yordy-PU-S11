<?php

namespace App;

class Calculadora
{
    public function dividir($a, $b)
    {
        if ($b == 0) {
            throw new \InvalidArgumentException("No se puede dividir por cero");
        }
            return $a / $b;
    }
    public function raizCuadrada($numero)
    {
        if ($numero < 0) {
            throw new \InvalidArgumentException("No se puede calcular la raiz cuadrada de un numero negativo");
        }
        return sqrt($numero);
    }
    public function factorial($numero)
    {
        if (!is_int($numero)) {
            throw new \InvalidArgumentException("El factorial solo está definido para enteros");
        }

        if ($numero < 0) {
            throw new \InvalidArgumentException("No se puede calcular el factorial de un numero negativo");
        }

        if ($numero === 0) {
            return 1;
        }else {

        $resultado = 1;
        for ($i = 1; $i <= $numero; $i++) {
            $resultado *= $i;
        }
        }
        return $resultado;
    }
}

