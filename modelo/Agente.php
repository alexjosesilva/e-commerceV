<?php
/**
 * Arquivo de declaração da classe abstrata Agente
 * @package modelo
 * @author José Berardo
 * @since 1.0
 */
/**
 * Classe abstrata Agente que representa
 * todos os personagens do sistema
 * 
 * Todo agente terá em sua composição uma
 * referência a uma determinada pessoa.
 * 
 * @package modelo
 * @access public
 * @abstract
 */
abstract class Agente {
  // atributos de instância de Agente
  /**
   * Pessoa que compõe o agente
   * @access private
   * @var Pessoa 
   */
  private $pessoa;
  /**
   * Timestamp da data de cadastro do Agente
   * @access private
   * @var int
   */
  private $dataCadastro;
  // ------------ ### ------------- //

  // métodos construtores e destrutores
  /**
   * Construtor do Agente.
   * Agente serve apenas para reutilização de uma pessoa como
   * mais de uma personagem (agente) do sistema.
   * Sendo assim, a pessoa, elemento principal, é obrigatória
   * para a construção de qualquer agente.
   * 
   * @access public
   * @param Pessoa $pessoa Referência à pessoa do Agente
   * @param int $dataCadastro timestamp opcional de cadastro
   */
  public function __construct($pessoa, $dataCadastro = "") {
    $this->pessoa       = $pessoa;
    $this->dataCadastro = $dataCadastro;
  }
  // ------------ ### ------------- //
  
  // demais métodos de negócio
  // ------------ ### ------------- //
  
  // métodos getters e setters
  /**
   * Recupera o valor de <var>$this->pessoa</var>
   * 
   * @access public
   * @return Pessoa
   */
  public function getPessoa() {
    return $this->pessoa;
  }

  /**
   * Define um valor para <var>$this->pessoa</var>
   * 
   * @access public
   * @param Pessoa $pessoa
   */
  public function setPessoa(Pessoa $pessoa) {
    $this->pessoa = $pessoa;
  }

  /**
   * Recupera o valor de <var>$this->dataCadastro</var>
   * 
   * @access public
   * @return int
   */
  public function getDataCadastro() {
    return $this->dataCadastro;
  }

  /**
   * Define um valor para <var>$this->dataCadastro</var>
   * 
   * @access public
   * @param int $dataCadastro
   */
  public function setDataCadastro($dataCadastro) {
    $this->dataCadastro = $dataCadastro;
  }
  // ------------ ### ------------- //
}
?>