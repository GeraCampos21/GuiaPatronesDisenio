<?php

// Interfaz que define cómo mostrar un mensaje
interface FormaDeMostrar {
    public function mostrar(string $mensaje): void;
}

// Estrategia 1: mostrar en consola
class MostrarEnConsola implements FormaDeMostrar {
    public function mostrar(string $mensaje): void {
        echo "[Consola] " . $mensaje . PHP_EOL;
    }
}

// Estrategia 2: mostrar en formato JSON
class MostrarEnJson implements FormaDeMostrar {
    public function mostrar(string $mensaje): void {
        echo json_encode(["mensaje" => $mensaje], JSON_PRETTY_PRINT) . PHP_EOL;
    }
}

// Estrategia 3: guardar en un archivo TXT
class GuardarEnTxt implements FormaDeMostrar {
    public function mostrar(string $mensaje): void {
        file_put_contents("mensaje.txt", $mensaje);
        echo "[Archivo TXT] Mensaje guardado en mensaje.txt" . PHP_EOL;
    }
}

// Clase principal que usa la estrategia
class Mensajero {
    private FormaDeMostrar $forma;

    public function __construct(FormaDeMostrar $forma) {
        $this->forma = $forma;
    }

    public function cambiarForma(FormaDeMostrar $nuevaForma): void {
        $this->forma = $nuevaForma;
    }

    public function enviar(string $mensaje): void {
        $this->forma->mostrar($mensaje);
    }
}

// ---------------------------
// Ejemplo de uso
// ---------------------------
$mensaje = "Hola, este es un mensaje de prueba.";

// Mostrar en consola
$mensajero = new Mensajero(new MostrarEnConsola());
$mensajero->enviar($mensaje);

// Mostrar en JSON
$mensajero->cambiarForma(new MostrarEnJson());
$mensajero->enviar($mensaje);

// Guardar en TXT
$mensajero->cambiarForma(new GuardarEnTxt());
$mensajero->enviar($mensaje);

?>
