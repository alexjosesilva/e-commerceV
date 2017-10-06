<?php
/**
 * Arquivo de declaração da classe Compra
 * @package modelo
 * @author José Berardo
 * @since 1.0
 */

/**
 * Compras dos clientes
 * 
 * @package modelo
 * @access public
 */
class Compra {
  // atributos de instância de Compra
  /**
   * Identificador da compra
   * @access private
   * @var int
   */
  private $id;
  /**
   * Cliente que comprou
   * @access private
   * @var Cliente
   */
  private $cliente;
  /**
   * Carrinho utilizado na compra
   * @access private
   * @var Carrinho
   */
  private $carrinho;
  /**
   * Endereço do cliente definido para entrega
   * @access private
   * @var Endereco
   */
  private $enderecoEntrega;
  /**
   * Timestamp do momento da compra
   * @access private
   * @var int
   */
  private $data;
  // ------------ ### ------------- //

  // métodos construtores e destrutores
  /**
   * Construtor da Compra.
   * Parâmetros são utilizados para carregar
   * todo o estado da Compra no momento da instância.
   * @access public
   * @param Carrinho $carrinho Único campo obrigatório
   * @param int $id Identificador da compra
   * @param Cliente $cliente Cliente que comprou
   * @param Endereco $enderecoEntrega Endereço de entrega
   * @param int $data Timestamp do momento da compra
   */
  public function __construct($carrinho, $id = "", $cliente = "",
                              $enderecoEntrega = "", $data = "") {
    $this->carrinho        = $carrinho;

    $this->id              = $id;
    $this->cliente         = $cliente;
    $this->enderecoEntrega = $enderecoEntrega;
    $this->data            = $data;
  }
  // ------------ ### ------------- //
  
  // demais métodos de negócio
  /**
   * Método que delega ao objeto carrinho
   * @access public
   * @see Carrinho::calcularTotal()
   */
  public function calcularTotal() {
    return $this->carrinho->calcularTotal();
  }
  // ------------ ### ------------- //
  
  // métodos getters e setters
  /**
   * Recupera o valor de <var>$this->id</var>
   * 
   * @access public
   * @return int
   */
  public function getId() {
    return $this->id;
  }
  /**
   * Define um valor para <var>$this->id</var>
   * 
   * @access public
   * @param int $id
   */
  public function setId($id) {
    $this->id = $id;
  }
  /**
   * Recupera o valor de <var>$this->cliente</var>
   * 
   * @access public
   * @return Cliente
   */
  public function getCliente() {
    return $this->cliente;
  }
  /**
   * Define um valor para <var>$this->cliente</var>
   * 
   * @access public
   * @param Cliente $cliente
   */
  public function setCliente(Cliente $cliente) {
    $this->cliente = $cliente;
  }
  /**
   * Recupera o valor de <var>$this->carrinho</var>
   * 
   * @access public
   * @return Carrinho
   */
  public function getCarrinho() {
    return $this->carrinho;
  }
  /**
   * Define um valor para <var>$this->carrinho</var>
   * 
   * @access public
   * @param Carrinho $carrinho
   */
  public function setCarrinho($carrinho) {
    $this->carrinho = $carrinho;
  }
  /**
   * Recupera o valor de <var>$this->enderecoEntrega</var>
   * 
   * @access public
   * @return Endereco
   */
  public function getEnderecoEntrega() {
    return $this->enderecoEntrega;
  }
  /**
   * Define um valor para <var>$this->enderecoEntrega</var>
   * 
   * @access public
   * @param Endereco $enderecoEntrega
   */
  public function setEnderecoEntrega($enderecoEntrega) {
    $this->enderecoEntrega = $enderecoEntrega;
  }
  /**
   * Recupera o valor de <var>$this->data</var>
   * 
   * @access public
   * @return int Timestamp
   */
  public function getData() {
    return $this->data;
  }
  /**
   * Define um valor para <var>$this->data</var>
   * 
   * @access public
   * @param int $data timestamp
   */
  public function setData($data) {
    $this->data = $data;
  }
  // ------------ ### ------------- //
}
?>