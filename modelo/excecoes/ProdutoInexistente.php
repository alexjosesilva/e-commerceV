<?php
/**
 * Arquivo PHP que declara a exce��o ProdutoInexistente
 * @package modelo
 * @subpackage excecoes
 * @author Jos� Berardo
 * @since 1.0
 */
namespace modelo\excecoes;

/**
 * Classe de exce��o ProdutoInexistente.
 * Utilizada quando houver uma requisi��o a um produto
 * que n�o seja encontrado nos dados da Loja.
 * @package modelo
 * @subpackage excecoes
 * @access public
 */
class ProdutoInexistente extends \Exception {
  /**
   * Construtor da exce��o.
   * Invocar� o construtor de Exception
   * @access public
   */
  public function __construct() {
    parent::__construct("Produto não encontrado!");
  }
}
?>