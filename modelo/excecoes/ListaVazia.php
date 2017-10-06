<?php
/**
 * Arquivo PHP que declara a exce��o ListaVazia
 * @package modelo
 * @subpackage excecoes
 * @author Jos� Berardo
 * @since 1.0
 */
namespace modelo\excecoes;

/**
 * Classe de exce��o gen�rica sobre listas vazias.
 * Utilizada sempre que for necess�rio listar uma
 * (sub) cole��o de dados que n�o retorne nada.
 * @package modelo
 * @subpackage excecoes
 * @access public
 */
class ListaVazia extends \Exception {
  /**#@+
   * @var int
   */
  const PRODUTOS   = 1;
  const CATEGORIAS = 2;
  /**#@-*/
  const ITENS      = 3;
    
  /**
   * Construtor da exce��o.
   * Invocar� o construtor de Exception
   * @access public
   * @param int $tipo Tipo da lista requerida
   */
  public function __construct($tipo) {
    switch ($tipo) {
      case self::PRODUTOS:
        parent::__construct("Nenhum produto foi encontrado!", $tipo);
        break;
      case self::CATEGORIAS:
        parent::__construct("Nenhuma categoria cadastrada até o momento!", $tipo);
        break;
      case self::ITENS:
        parent::__construct("Nenhum item adicionado ao carrinho até o momento!", $tipo);
        break;
    }
  }
}
?>