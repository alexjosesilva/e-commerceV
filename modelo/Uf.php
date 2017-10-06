<?php
/**
 * Arquivo de declaração da classe Uf
 * @package modelo
 * @author José Berardo
 * @since 1.0
 */

/**
 * Interning flyweights de Estados (Unidades Federativas)
 * 
 * @package modelo
 * @access public
 */
class Uf {
  /**#@+
   * Constantes dos Estados
   * @access public
   * @final 
   * @var string
   */
  const AC = "AC";
  const AL = "AL";
  const AM = "AM"; const AP = "AP";
  const BA = "BA"; const CE = "CE";
  const DF = "DF"; const ES = "ES";
  const GO = "GO"; const MA = "MA";
  const MG = "MG"; const MS = "MS";
  const MT = "MT"; const PA = "PA";
  const PB = "PB"; const PE = "PE";
  const PI = "PI"; const PR = "PR";
  const RJ = "RJ"; const RN = "RN";
  const RO = "RO"; const RS = "RS";
  const SC = "SC"; const SE = "SE";
  const SP = "SP";
  /**#@-*/
  const TO = "TO";

  /**
   * Sigla do Estado
   * @access private
   * @var string
   */
  private $sigla;
  /**
   * Nome do Estado
   * @access private
   * @var string
   */
  private $nome;

  /**
   * Construtor dos Estados.
   * Parâmetro sigla opcional obrigatório.
   * @access public
   * @param string $sigla Sigla do Estado
   */
  public function __construct($sigla) {
    $this->setSigla($sigla);
  }

  /**
   * Recupera o valor de <var>$this->sigla</var>
   * 
   * @access public
   * @return string Sigla da Uf
   */
  public function getSigla() {
    return $this->sigla;
  }
  /**
   * Define um valor para <var>$this->sigla</var>
   * 
   * @access private
   * @param string $sigla
   */
    private function setSigla($sigla) {
    $this->sigla = $sigla;
    switch($this->sigla) {
      case "AC":
        $this->setNome("Acre");
        break;
      case "AL":
        $this->setNome("Alagoas");
        break;
      case "AM":
        $this->setNome("Amazonas");
        break;
      case "AP":
        $this->setNome("Amapá");
        break;
      case "BA":
        $this->setNome("Bahia");
        break;
      case "CE":
        $this->setNome("Ceará");
        break;
      case "DF":
        $this->setNome("Distrito Federal");
        break;
      case "ES":
        $this->setNome("Espírito Santo");
        break;
      case "GO":
        $this->setNome("Goiás");
        break;
      case "MA":
        $this->setNome("Maranhão");
        break;
      case "MG":
        $this->setNome("Minas Gerais");
        break;
      case "MS":
        $this->setNome("Mato Grosso do Sul");
        break;
      case "MT":
        $this->setNome("Mato Grosso");
        break;
      case "PA":
        $this->setNome("Pará");
        break;
      case "PB":
        $this->setNome("Paraíba");
        break;
      case "PE":
        $this->setNome("Pernambuco");
        break;
      case "PI":
        $this->setNome("Piauí");
        break;
      case "PR":
        $this->setNome("Paraná");
        break;
      case "RJ":
        $this->setNome("Rio de Janeiro");
        break;
      case "RN":
        $this->setNome("Rio Grande do Norte");
        break;
      case "RO":
        $this->setNome("Rondônia");
        break;
      case "RS":
        $this->setNome("Rio Grande do Sul");
        break;
      case "SC":
        $this->setNome("Santa Catarina");
        break;
      case "SE":
        $this->setNome("Sergipe");
        break;
      case "SP":
        $this->setNome("São Paulo");
        break;
      case "TO":
        $this->setNome("Tocantins");
        break;
    }
  }
  /**
   * Recupera o valor de <var>$this->nome</var>
   * 
   * @access public
   * @return string Nome da Uf
   */
  public function getNome() {
    return $this->nome;
  }
  /**
   * Define um valor para <var>$this->nome</var>
   * 
   * @access private
   * @param string $nome
   */
  private function setNome($nome) {
    $this->nome = $nome;
  }
}
?>