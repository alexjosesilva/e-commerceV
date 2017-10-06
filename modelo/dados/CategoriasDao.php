<?php
namespace modelo\dados;

use modelo\Categoria;

interface CategoriasDao {
    public function listarCategorias();
    public function buscarPeloId($id);
    public function salvar(Categoria $categoria);
}
?>