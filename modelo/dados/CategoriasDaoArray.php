<?php
namespace modelo\dados;

use \modelo\excecoes\ListaVazia;
use \modelo\excecoes\CategoriaInexistente;
use \modelo\Categoria;

/**
 * Classe que carregar os dados a partir de um array
 */
class CategoriasDaoArray implements CategoriasDao {
    
    public function listarCategorias() {
        include MODELO . DS . 'dados' . DS . 'dados.php';
        if (count($dados['categorias'])==0) {
            throw new ListaVazia(ListaVazia::CATEGORIAS);
        }
        return $dados['categorias'];
    }

    public function buscarPeloId($id) {
        include MODELO . DS . 'dados' . DS . 'dados.php';
        foreach ($dados['categorias'] as $categoria) {
          if ($categoria->id == $id) return $categoria;
            }
        throw new CategoriaInexistente();
    }

    public function salvar(Categoria $categoria) {
            // TODO - Operacao de salvar (inserir ou editar) uma categoria 
    }
}
?>