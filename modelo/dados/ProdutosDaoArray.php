<?php
namespace modelo\dados;

use \modelo\excecoes\ProdutoInexistente;
use \modelo\excecoes\ListaVazia;
use \modelo\Categoria;
use \modelo\Produto;

class ProdutosDaoArray implements ProdutosDao {
    public function buscarPeloId($id) {
        include MODELO . DS . 'dados' . DS . 'dados.php';
        foreach ($dados['produtos'] as $produto) {
            if ($produto->id == $id) return $produto;
        }
        throw new ProdutoInexistente();
    }
    public function listarProdutos($termoFiltro = "", Categoria $categoria = null, $limite = 10, $pagina = 1) {
        include MODELO . DS . 'dados' . DS . 'dados.php';
        $lista = array();

        $contOffset = 0;
        if (empty($pagina) || $pagina == 0) {
            $pagina = 1;
        }
        $offset = ($pagina - 1) * $limite;

        if ($termoFiltro == ProdutosDao::PRODUTOS_HOME) {
            $produtos_home = $dados['produtos'];
            shuffle($produtos_home);
            return array_slice($produtos_home, 0, 10);			
        }
        foreach ($dados['produtos'] as $produto){
          $filtro_ok = true;
          $categoria_ok= true;
          // verificando se o produto corrente passa no filtro do termo buscado
          if (!empty($termoFiltro) &&
              !stristr($produto->nome, $termoFiltro) &&
              !stristr($produto->descricao, $termoFiltro)) {
              $filtro_ok = false;
          }
          // verificando se o produto corrente é da categoria selecionada
          if (isset($categoria) && ($produto->categoria->id != $categoria->id)){
              $categoria_ok = false;
          }
          // adicionando o produto � lista
          if ($filtro_ok && $categoria_ok) {
            if ($contOffset++ < $offset) {
              continue;
            }
            $lista[] = $produto;
            if (count($lista) == $limite) break;
          }
        }
        // Levantar exce��o se a lista estiver vazia
        if (count($lista)==0) {
            throw new ListaVazia(ListaVazia::PRODUTOS);
        }
        return $lista;
    }

    public function getTotalProdutos($termoFiltro = "", Categoria $categoria = null) {
        return count(self::listarProdutos($termoFiltro, $categoria, 0, 0));
    }
}
?>