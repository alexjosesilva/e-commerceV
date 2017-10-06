<?php
/**
 * Arquivo de declaração da classe Cliente
 * @package modelo
 * @author José Berardo
 * @since 1.0
 */

/**
 * Clientes da Loja
 * 
 * @package modelo
 * @access public
 */
class Cliente extends Agente {
  // atributos de instância de Cliente
  /**
   * Coleção de compras do Cliente
   * @access private
   * @var array
   */
  private $compras;
  // ------------ ### ------------- //

  // métodos construtores e destrutores
  /**
   * Construtor do Cliente.
   * Parâmetros são utilizados para carregar
   * todo o estado do Cliente no momento da instância.
   * Fará uma chamada explícita ao construtor de Agente
   * @access public
   * @param Pessoa $pessoa Único campo obrigatório
   * @param int $dataCadastro Timestamp de cadastro
   * @param Compra $compra Uma primeira compra já sugerida
   */
  public function __construct($pessoa, $dataCadastro = "", $compra = "") {
    parent::__construct($pessoa, $dataCadastro);

    $this->compra = array();
    if ($compra != "") {
      $this->adicionarCompra($compra);
    }
  }
  // ------------ ### ------------- //
  
  // demais métodos de negócio
  /**
   * Método que adiciona compras ao Cliente.
   * Determina o objeto corrente ($this) como
   * Cliente da $compra passada.
   * @access public
   * @param Compra $compra Compra a ser adicionada
   * @see Compra::setCliente()
   */
  public function adicionarCompra(Compra $compra) {
    $compra->setCliente($this);
    $this->compras[] = $compra;
  }
  // ------------ ### ------------- //
  
  // métodos getters e setters
  /**
   * Recupera o valor de <var>$this->compras</var>
   * 
   * @access public
   * @return array Lista de compras
   */
  public function getCompras() {
    return $this->compras;
  }
  /**
   * Define um valor para <var>$this->compras</var>
   * 
   * @access public
   * @param array $compras lista de compras
   * @see Compra
   */
  public function setCompras($compras) {
    $this->compras = $compras;
  }
  // ------------ ### ------------- //
}
?>