<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Validador;

class ValidadorTest extends TestCase
{
    private $validador;

    protected function setUp(): void
    {
        $this->validador = new Validador();
    }

    //============PROVEEDORES (DEBEN SER STATIC) =========

    public static function proveedorEdadNormal(): array
    {
        return [
            [32, true],
        ];
    }

    public static function proveedorEdadNegativa(): array
    {
        return [
            [-30, false, 'La edad no puede ser un numero negativo'],
        ];
    }

    public static function proveedorEdadMenor(): array
    {
        return [
            [13, false, 'Es menor de edad'],
        ];
    }

    public static function proveedorEmailNormal(): array
    {
        return [
            ['yordy_sjb@hotmail.com', true],
        ];
    }
    public static function proveedorEmailInvalido(): array
    {
        return [
            ['yordy..gmail.co', 'El email ingresado no es válido']
        ];
    }
    public static function proveedorPasswordNormal(): array
    {
        return [
            ['Abc12345', true],
        ];
    }

    public static function proveedorPasswordCorta(): array
    {
        return [
            ['Ab1', false, 'La contraseña debe tener al menos 8 caracteres'],
        ];
    }

    public static function proveedorPasswordSinNumero(): array
    {
        return [
            ['Abcdefgh', false, 'La contraseña debe contener al menos un número'],
        ];
    }

    #[DataProvider('ProveedorEdadNormal')]
    public function testValidarEdadNormal($edad, $esperado)
    {
        $resultado = $this->validador->validarEdad($edad);
        $this->assertEquals($esperado, $resultado);
    }

    #[DataProvider('ProveedorEdadNegativa')]
    public function testValidarEdadNegativa($edad, $expectException, $mensaje)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage($mensaje);

        $this->validador->validarEdad($edad);
    }

    #[DataProvider('ProveedorEdadMenor')]
    public function testValidarEdadMenor($edad, $expectException, $mensaje)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage($mensaje);

        $this->validador->validarEdad($edad);
    }

    #[DataProvider('ProveedorEmailNormal')]
    public function testValidarEmailNormal($email, $esperado)
    {
        $resultado = $this->validador->validarEmail($email);
        $this->assertEquals($esperado, $resultado);
    }

    #[DataProvider('ProveedorEmailInvalido')]
    public function testValidarEmailInvalido($email, $mensaje)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage($mensaje);

        $this->validador->validarEmail($email);
    }

    #[DataProvider('ProveedorPasswordNormal')]
    public function testValidarPasswordNormal($password, $esperado)
    {
        $resultado = $this->validador->validarPassword($password);
        $this->assertEquals($esperado, $resultado);
    }

    #[DataProvider('ProveedorPasswordCorta')]
    public function testValidarPasswordCorta($password, $expectException, $mensaje)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage($mensaje);

        $this->validador->validarPassword($password);
    }

    #[DataProvider('ProveedorPasswordSinNumero')]
    public function testValidarPasswordSinNumero($password, $expectException, $mensaje)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage($mensaje);

        $this->validador->validarPassword($password);
    }
}

