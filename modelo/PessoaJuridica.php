<?php
/**
 * Arquivo de declaração de PessoaJuridica
 * @package modelo
 * @author José Berardo
 * @since 1.0
 */
 /**
  * Pessoas Jurídicas da Loja
  * 
  * @package modelo
  * @access public
  */
class PessoaJuridica extends Pessoa {
  // atributos de instância de Pessoa Jurídica
  /**
   * Número do CNPJ
   * @access private
   * @var string
   */
  private $cnpj;
  /**
   * Número da inscrição estadual
   * @access private
   * @var string
   */
  private $inscricaoEstadual;
  /**
   * Número da inscrição municipal
   * @access private
   * @var string
   */
  private $inscricaoMunicipal;
  /**
   * Pessoa Física para contato
   * @access private
   * @var PessoaFisica $contato
   */
  private $contato;
  // ------------ ### ------------- //

  // métodos construtores e destrutores
  /**
   * Construtor da Pessoa Jurídica
   * 
   * Todos os parâmetros são opcionais.
   * Fará uma chamada explícita ao construtor de Pessoa
   * 
   * @access public
   * @param int $id Identificador da Pessoa
   * @param string $nome Nome da Pessoa
   * @param string $email Email da Pessoa
   * @param string $telefone Telefone da Pessoa
   * @param string $login login da Pessoa
   * @param string $senha senha da Pessoa
   * @param Endereco $endereco Endereço inicial a adicionar à Pessoa
   * @param string $cnpj Número do CNPJ da Pessoa Jurídica
   * @param string $inscricaoEstadual Inscrição estadual da Pessoa Jurídica
   * @param string $inscricaoMunicipal Inscrição municipal da Pessoa Jurídica
   * @param PessoaFisica $contato Pessoa Física para contato
   */
  public function __construct($id = "", $nome = "", $email = "", 
                              $telefone = "", $login = "", 
                              $senha = "", $endereco = "",
                              $cnpj = "", $inscricaoEstadual = "", 
                              $inscricaoMunicipal = "", $contato = "") {
    parent::__construct($id, $nome, $email, $telefone, $login, $senha, $endereco);

    $this->setCnpj($cnpj);
    $this->setInscricaoEstadual($inscricaoEstadual);
    $this->setInscricaoMunicipal($inscricaoMunicipal);
    $this->setContato($contato);
  }
  // ------------ ### ------------- //
  // demais métodos de negócio
  /**
   * Implementação do método abstrato em Pessoa.
   * Validará os campos básicos e o CNPJ
   * 
   * @access public
   * @return boolean Verdadeiro se os campos forem válidos
   * @see Pessoa::validarCampos()
   * @see Pessoa::validarCamposBasicos()
   * @todo Implementação da validação do CNPJ
   */
  public function validarCampos() {
    // conferindo métodos comuns de Pessoa
    if (!$this->validarCamposBasicos()) return false;

    // conferindo métodos particulares de PessoaJuridica
    if ($this->validarCnpj()) return true;

    return false;
  }
  /**
   * Método utilitário privado para validação do CNPJ
   *
   * @access private
   * @return boolean Verdadeiro se o CNPJ for válido
   * @todo Não implementado
   */
  public function validarCnpj() {
    // método não implementado
	return $this->cnpj != '';
  }
  // ------------ ### ------------- //
  
  // métodos getters e setters
  /**
   * Recupera o valor de <var>$this->cnpj</var>
   * 
   * @access public
   * @return string
   */
  public function getCnpj() {
	  return $this->cnpj;
  }
  /**
   * Define um valor para <var>$this->cnpj</var>
   * 
   * @access public
   * @param string $cnpj
   */
  public function setCnpj($cnpj) {
    $this->cnpj = $cnpj;
  }
  /**
   * Recupera o valor de <var>$this->inscricaoEstadual</var>
   * 
   * @access public
   * @return string
   */
  public function getInscricaoEstadual() {
	  return $this->inscricaoEstadual;
  }
  /**
   * Define um valor para <var>$this->inscricaoEstadual</var>
   * 
   * @access public
   * @param string $inscricaoEstadual
   */
  public function setInscricaoEstadual($inscricaoEstadual) {
    $this->inscricaoEstadual = $inscricaoEstadual;
  }
  /**
   * Recupera o valor de <var>$this->inscricaoMunicipal</var>
   * 
   * @access public
   * @return string
   */
  public function getInscricaoMunicipal() {
    return $this->inscricaoMunicipal;
  }
  /**
   * Define um valor para <var>$this->inscricaoMunicipal</var>
   * 
   * @access public
   * @param string $inscricaoMunicipal
   */
  public function setInscricaoMunicipal($inscricaoMunicipal) {
	   $this->inscricaoMunicipal = $inscricaoMunicipal;
  }
  /**
   * Recupera o valor de <var>$this->contato</var>
   * 
   * @access public
   * @return PessoaFisica
   */
  public function getContato() {
    return $this->contato;
  }
  /**
   * Define um valor para <var>$this->contato</var>
   * 
   * @access public
   * @param PessoaFisica $contato
   */
    public function setContato(PessoaFisica $contato) {
    $this->contato = $contato;
  }
  // ------------ ### ------------- //
}
?>