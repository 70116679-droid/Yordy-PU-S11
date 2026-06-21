<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Calculadora;

class CalculadoraTest extends TestCase
{
    private $calculadora;

    protected function setUp(): void
    {
        $this->calculadora = new Calculadora();
    }

    // ================ PROVEEDORES (DEBEN SER STATIC) ==================

    public static function proveedorDivisionNormal(): array
    {
        return [
            [4, 2, 2, false],
            [10, 2, 5, false],
            [20, 4, 5, false],

        ];
    }
    public static function proveedorDividirEntreCero(): array
    {
        return [
            [20, 0, null, true],
        ];
    } 
    public static function proveedorRaizCuadradaNormal(): array
    {
        return [
            [25, true ],
        ];
    }
    public static function proveedorRaizCuadradaNegativa(): array
    {
        return [
            [-20, true]
        ];
    }
    public static function proveedorFactorialNormal(): array
    {
        return [
            [5, 120],
        ];
    }
    public static function proveedorFactorialCero(): array
    {
        return [
            [0],
        ];
    }
    public static function proveedorFactorialNegativo(): array
    {
        return [
            [-1, true],
            
        ];
    }

    #[DataProvider('ProveedorDivisionNormal')]
    public function testDividirNormal($a, $b, $esperado, $expectException)
    {
        if ($expectException) {
            $this->expectException(\InvalidArgumentException::class);
            $this->calculadora->dividir($a, $b);
        } else {
            $resultado = $this->calculadora->dividir($a, $b);
            $this->assertEquals($esperado, $resultado);
        }
    }

    #[DataProvider('ProveedorDividirEntreCero')]
    public function testDividirEntreCero($a, $b, $esperado, $expectException)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('No se puede dividir por cero');

        $this->calculadora->dividir($a, $b);
    }

    #[DataProvider('ProveedorRaizCuadradaNormal')]
    public function testRaizCuadradaNormal($numero, $esperado)
    {
        $resultado = $this->calculadora->raizCuadrada($numero);
        $this->assertEquals($esperado, $resultado);
    }

    #[DataProvider('ProveedorRaizCuadradaNegativa')]
    public function testRaizCuadradaNegativa($numero, $esperado)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('No se puede calcular la raiz cuadrada de un numero negativo');

        $this->calculadora->raizCuadrada($numero);
    }

   
    #[DataProvider('ProveedorFactorialNormal')]
    public function testFactorialNormal($numero, $esperado)
    {
        $resultado = $this->calculadora->factorial($numero);
        $this->assertEquals($esperado, $resultado);
    }

    #[DataProvider('ProveedorFactorialCero')]
    public function testFactorialCero($numero)
    {
        $resultado = $this->calculadora->factorial($numero);
        $this->assertEquals(1, $resultado);
    }

    #[DataProvider('ProveedorFactorialNegativo')]
    public function testFactorialNegativo($numero, $expectException)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('No se puede calcular el factorial de un numero negativo');

        $this->calculadora->factorial($numero);
    }
    
}

