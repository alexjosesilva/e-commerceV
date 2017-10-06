<?php
/**
 * Arquivo PHP que declara a exce��o UfInexistente
 * @package modelo
 * @subpackage excecoes
 * @author Jos� Berardo
 * @since 1.0
 */
namespace modelo\excecoes;
/**
 * Classe de exce��o UfInexistente.
 * Utilizada quando houver uma requisi��o a uma Uf que n�o
 * seja declarada nas constantes das siglas da classe Uf.
 * @package modelo
 * @subpackage excecoes
 * @access public
 */
class UfInexistente extends \Exception {
  /**
   * Construtor da exce��o.
   * Invocar� o construtor de Exception
   * @access public
   * @param string $sigla Sigla para compor a mensagem
   */
  public function __construct($sigla) {
    parent::__construct("A UF " . $sigla . " n�o existe!");
  }
}
?>