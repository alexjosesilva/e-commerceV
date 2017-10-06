<?php
/**
 * Arquivo PHP que declara a exceзгo DadosException
 * @package modelo
 * @subpackage dados
 * @author Josй Berardo
 * @since 1.0
 */

/**
 * Classe de exceзгo DadosException.
 * Utilizada sempre que houver problemas no
 * acesso ao mecanismo de persistкncia de dados.
 * @package modelo
 * @subpackage dados
 * @access public
 */
class DadosException extends Exception {
  
  /**
   * Exceзгo que foi causa do problema no acesso aos dados
   *
   * @var Exception
   */
  private $causa;
  
  /**
   * Construtor da exceзгo.
   * Invocarб o construtor de Exception
   * @param Exception $causa
   * @access public
   */
  public function __construct(Exception $causa) {
    $this->causa = $causa;
    parent::__construct("Problemas no acesso aos dados!",
                        $causa->getCode());
  }
  
  public function getCausa() {
  	return $this->causa;
  }
}

?>