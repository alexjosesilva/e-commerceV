<?php
/**
 * Arquivo PHP que declara a exce��o CategoriaInexistente
 * @package modelo
 * @subpackage excecoes
 * @author Jos� Berardo
 * @since 1.0
 */
namespace modelo\excecoes;

/**
 * Classe de exce��o CategoriaInexistente.
 * Utilizada quando houver uma requisi��o a uma categoria
 * que n�o seja encontrada nos dados da Loja.
 * @package modelo
 * @subpackage excecoes
 * @access public
 */
class CategoriaInexistente extends \Exception {
  /**
   * Construtor da exce��o.
   * Invocar� o construtor de Exception
   * @access public
   */
  public function __construct() {
    parent::__construct("Categoria inexistente!");
  }
}
?>