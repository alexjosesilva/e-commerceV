<?php

namespace modelo\dados;

use \modelo\Categoria;

interface ProdutosDao {
    const PRODUTOS_HOME = "!!!!o valor é o que menos interessa!!!!";
    public function buscarPeloId($id);
    public function listarProdutos($termoFiltro = "", Categoria $categoria = null, $limite = 10, $pagina = 1);
    public function getTotalProdutos($termoFiltro = "", Categoria $categoria = null);
}
?>