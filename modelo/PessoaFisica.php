<?php
/**
 * Arquivo de declaração de PessoaFisica
 * @package modelo
 * @author José Berardo
 * @since 1.0
 */
 /**
  * Pessoas Físicas da Loja
  * 
  * @package modelo
  * @access public
  */
class PessoaFisica extends Pessoa {
  // atributos de instância de Pessoa Física
  /**
   * Número do CPF
   * @access private
   * @var string
   */
  private $cpf;
  /**
   * Número da identidade
   * @access private
   * @var string
   */
  private $rg;
  /**
   * Timestamp da data de nascimento
   * @access private
   * @var int
   */
  private $dataNascimento;
  // ------------ ### ------------- //

  // métodos construtores e destrutores
  /**
   * Construtor da Pessoa Física
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
   * @param string $cpf Número do CPF da Pessoa Física
   * @param string $rg Número da identidade da Pessoa Física
   * @param int $dataNascimento Timestamp da data de nascimento
   */
  public function __construct($id = "", $nome = "", $email = "", 
                              $telefone = "", $login = "", 
                              $senha = "", $endereco = "",
                              $cpf = "", $rg = "", $dataNascimento = "") {
    parent::__construct($id, $nome, $email, $telefone, $login, $senha, $endereco);
    $this->setCpf($cpf);
    $this->setRg($rg);
    $this->setDataNascimento($dataNascimento);
  }
  // ------------ ### ------------- //
  // demais métodos de negócio
  /**
   * Implementação do método abstrato em Pessoa.
   * Validará os campos básicos e o CPF
   * 
   * @access public
   * @return boolean Verdadeiro se os campos forem válidos
   * @see Pessoa::validarCampos()
   * @see Pessoa::validarCamposBasicos()
   * @see PessoaFisica::validarCpf()
   */
  public function validarCampos() {
    // conferindo métodos comuns de Pessoa
    if (!$this->validarCamposBasicos()) return false;

    // conferindo métodos particulares de PessoaFisica
    if ($this->validarCpf()) return true;

    return false;
  }

  /**
   * Método utilitário privado para validação do CPF
   *
   * @access private
   * @return boolean Verdadeiro se o CPF for válido
   */
  private function validarCpf() {
    // recuperando o CPF sem dígitos e hifen
    $cpf = str_replace(array(".", "-"), "", $this->getCpf());
    if (strlen($cpf) < 11) return false;

    // invalidando CPFs como 11111111111
    for ($x = 0; $x <= 9; $x++) {
      if ($cpf == str_repeat($x,11)) return false;
    }

    // recuperando o dígito verificador
    $dvInformado = substr($cpf, 9);

    // verificando os valores para o primeiro dígito verificador
    $valor = 10;
    $soma = 0;
    for ($x = 0; $x < 9; $x++) {
      $soma += $cpf{$x} * $valor--;
    }
    $dv1 = $soma % 11;
    $dv1 = ($dv1 < 2) ? 0 : 11 - $dv1;

    // verificando os valores para o segundo dígito verificador
    $valor = 11;
    $soma = 0;
    for ($x = 0; $x < 10; $x++) {
      $soma += $cpf{$x} * $valor--;
    }

    $dv2 = $soma % 11;
    $dv2 = ($dv2 < 2) ? 0 : 11 - $dv2;
    if ($dvInformado{1} != $dv2) return false;

    // conferindo o dígito verificador final
    $dvFinal = $dv1 * 10 + $dv2;
    if ($dvFinal != $dvInformado) return false;

    return true;
  }
  // ------------ ### ------------- //
  
  // métodos getters e setters
  /**
   * Recupera o valor de <var>$this->cpf</var>
   * 
   * @access public
   * @return string
   */
  public function getCpf() {
	  return $this->cpf;
  }
  /**
   * Define um valor para <var>$this->cpf</var>
   * 
   * @access public
   * @param string $cpf
   */
  public function setCpf($cpf) {
    $this->cpf = $cpf;
  }
  /**
   * Recupera o valor de <var>$this->rg</var>
   * 
   * @access public
   * @return string
   */
  public function getRg() {
	  return $this->rg;
  }
  /**
   * Define um valor para <var>$this->rg</var>
   * 
   * @access public
   * @param string $rg
   */
  public function setRg($rg) {
    $this->rg = $rg;
  }
  /**
   * Recupera o valor de <var>$this->dataNascimento</var>
   * 
   * @access public
   * @return int
   */
  public function getDataNascimento() {
    return $this->dataNascimento;
  }
  /**
   * Define um valor para <var>$this->dataNascimento</var>
   * 
   * @access public
   * @param int $dataNascimento
   */
  public function setDataNascimento($dataNascimento) {
	   $this->dataNascimento = $dataNascimento;
  }
  // ------------ ### ------------- //
}
?>
