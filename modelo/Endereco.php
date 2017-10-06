<?php
/**
 * Arquivo de declaração da classe Endereco
 * @package modelo
 * @author José Berardo
 * @since 1.0
 */

/**
 * Composição dos dados do endereço das pessoas
 * 
 * @package modelo
 * @access public
 */
final class Endereco {
  // atributos de instância de Endereço
  /**
   * Descrição do logradouro. Ex: Rua Tal n. 54/apto. 202
   * @access private
   * @var string
   */
  private $logradouro;
  /**
   * CEP 
   * @access private
   * @var string
   */
  private $cep;
  /**
   * Bairro
   * @access private
   * @var string
   */
  private $bairro;
  /**
   * Cidade
   * @access private
   * @var string
   */
  private $cidade;
  /**
   * Estado
   * @access private
   * @var Uf
   */
  private $uf;
  // ------------ ### ------------- //

  // métodos construtores e destrutores
  /**
   * Construtor do Endereço.
   * Todos os parâmetros são opcionais. São utilizados para
   * carregar todo o estado do Endereço no momento da instância.
   * @access public
   * @param string $logradouro
   * @param string $cep
   * @param string $bairro
   * @param string $cidade
   * @param Uf $uf Estado da Pessoa
   * @param Endereco $endereco Endereço inicial a adicionar à Pessoa
   */
  public function __construct($logradouro = "", $cep = "", $bairro = "",
                              $cidade = "", $uf = "") {
    $this->logradouro = $logradouro;
    $this->cep        = $cep;
    $this->bairro     = $bairro;
    $this->cidade     = $cidade;

    if ($uf != "") {
      $this->setUf($uf);
    }
  }
  // ------------ ### ------------- //

  // métodos getters e setters
  /**
   * Recupera o valor de <var>$this->logradouro</var>
   * 
   * @access public
   * @return string
   */
  public function getLogradouro() {
    return $this->logradouro;
  }
  /**
   * Define um valor para <var>$this->logradouro</var>
   * 
   * @access public
   * @param string $logradouro
   */
  public function setLogradouro($logradouro) {
    $this->logradouro = $logradouro;
  }
  /**
   * Recupera o valor de <var>$this->cep</var>
   * 
   * @access public
   * @return string
   */
  public function getCep() {
    return $this->cep;
  }
  /**
   * Define um valor para <var>$this->cep</var>
   * 
   * @access public
   * @param string $cep
   */
  public function setCep($cep) {
    $this->cep = $cep;
  }
  /**
   * Recupera o valor de <var>$this->bairro</var>
   * 
   * @access public
   * @return string
   */
  public function getBairro() {
    return $this->bairro;
  }
  /**
   * Define um valor para <var>$this->bairro</var>
   * 
   * @access public
   * @param string $bairro
   */
  public function setBairro($bairro) {
    $this->bairro = $bairro;
  }
  /**
   * Recupera o valor de <var>$this->cidade</var>
   * 
   * @access public
   * @return string
   */
  public function getCidade() {
    return $this->cidade;
  }
  /**
   * Define um valor para <var>$this->cidade</var>
   * 
   * @access public
   * @param string $cidade
   */
  public function setCidade($cidade) {
    $this->cidade = $cidade;
  }
  /**
   * Recupera o valor de <var>$this->uf</var>
   * 
   * @access public
   * @return Uf
   */
  public function getUf() {
    return $this->uf;
  }
  /**
   * Define um valor para <var>$this->uf</var>
   * 
   * @access public
   * @param Uf $uf
   */
  public function setUf(Uf $uf) {
    $this->uf = $uf;
  }
  // ------------ ### ------------- //
}
?>