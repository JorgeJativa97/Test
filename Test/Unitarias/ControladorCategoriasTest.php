<?php

require_once 'C:\xampp\htdocs\pos\controladores\categorias.controlador.php';
use PHPUnit\Framework\TestCase;
use Mockery as m;


class ControladorCategoriasTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
        // Limpiar variables globales
        unset($_POST);
        unset($_GET);
    }

    public function testCtrCrearCategoriaSuccess()
    {
        // Simular entrada válida en $_POST
        $_POST['nuevaCategoria'] = 'Nueva Categoria';

        // Mockear el modelo estático
        $mockModeloCategorias = Mockery::mock('alias:ModeloCategorias');
        $mockModeloCategorias->shouldReceive('mdlIngresarCategoria')
                             ->with('categorias', 'Nueva Categoria')
                             ->once()
                             ->andReturn('ok');

        // Capturar la salida
        ob_start();
        ControladorCategorias::ctrCrearCategoria();
        $output = ob_get_clean();

        // Verificar que la salida contiene el mensaje de éxito
        $this->assertStringContainsString('La categoría ha sido guardada correctamente', $output);
    }

    public function testCtrCrearCategoriaInvalidInput()
    {
        // Simular entrada inválida en $_POST
        $_POST['nuevaCategoria'] = 'Categoría Inválida @#';

        // Capturar la salida
        ob_start();
        ControladorCategorias::ctrCrearCategoria();
        $output = ob_get_clean();

        // Verificar que la salida contiene el mensaje de error
        $this->assertStringContainsString('¡La categoría no puede ir vacía o llevar caracteres especiales!', $output);
    } 

    public function testCtrMostrarCategorias()  
    {
    // Datos de prueba
    $item = 'id';
    $valor = 1;

    // Mockear el modelo
    $mockModeloCategorias = Mockery::mock('alias:ModeloCategorias');
    $mockModeloCategorias->shouldReceive('mdlMostrarCategorias')
                         ->with('categorias', $item, $valor)
                         ->once()
                         ->andReturn(['id' => 1, 'categoria' => 'Electrónica']);

    // Ejecutar el método
    $resultado = ControladorCategorias::ctrMostrarCategorias($item, $valor);

    // Verificar el resultado
    $this->assertEquals(['id' => 1, 'categoria' => 'Electrónica'], $resultado);
    }
    public function testCtrEditarCategoriaSuccess()
    {
    // Simular entrada válida en $_POST
    $_POST['editarCategoria'] = 'Categoría Editada';
    $_POST['idCategoria'] = 1;

    // Mockear el modelo
    $mockModeloCategorias = Mockery::mock('alias:ModeloCategorias');
    $mockModeloCategorias->shouldReceive('mdlEditarCategoria')
                         ->with('categorias', ['categoria' => 'Categoría Editada', 'id' => 1])
                         ->once()
                         ->andReturn('ok');

    // Capturar la salida
    ob_start();
    ControladorCategorias::ctrEditarCategoria();
    $output = ob_get_clean();

    // Verificar que la salida contiene el mensaje de éxito
    $this->assertStringContainsString('La categoría ha sido cambiada correctamente', $output);
    }
}
