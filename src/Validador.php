<?php

namespace App;

class Validador
{
    public function validarEdad($edad)
    {
        if ($edad < 0) {
            throw new \InvalidArgumentException("La edad no puede ser un numero negativo");
        }
        if ($edad < 18) {
            throw new \InvalidArgumentException("Es menor de edad");
        }
        return true;
    }

    public function validarEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("El email ingresado no es válido");
        }
        return true;
    }
    
    public function validarPassword($password)
    {
        if (!is_string($password) || trim($password) === '') {
            throw new \InvalidArgumentException("La contraseña no puede estar vacía");
        }

        if (strlen($password) < 8) {
            throw new \InvalidArgumentException("La contraseña debe tener al menos 8 caracteres");
        }

        if (!preg_match('/\\d/', $password)) {
            throw new \InvalidArgumentException("La contraseña debe contener al menos un número");
        }

        return true;
    }

    public function validarPasswordNormal($password)
    {
        return $this->validarPassword($password);
    }

    public function validarPasswordCorta($password)
    {
        if (!is_string($password) || trim($password) === '') {
            throw new \InvalidArgumentException("La contraseña no puede estar vacía");
        }

        if (strlen($password) < 8) {
            throw new \InvalidArgumentException("La contraseña debe tener al menos 8 caracteres");
        }

        return true;
    }

    public function validarPasswordSinNumero($password)
    {
        if (!is_string($password) || trim($password) === '') {
            throw new \InvalidArgumentException("La contraseña no puede estar vacía");
        }

        if (!preg_match('/\\d/', $password)) {
            throw new \InvalidArgumentException("La contraseña debe contener al menos un número");
        }

        return true;
    }
}

