<?php
/**
 * Arquivo de declara��o da classe abstrata Pessoa
 * @package modelo
 * @author Jos� Berardo
 * @since 1.0
 */

/**
 * Classe abstrata que representa as pessoas da Loja.
 * 
 * Ser� herdada por <b>PessoaFisica</b> e 
 * <b>PessoaJur�dica</b>, s� podendo haver inst�ncias de uma 
 * dessas duas classes, como abaixo:
 * 
 * - Pessoa F�sica
 * <code>
 * $pessoa_fisica = new PessoaFisica();
 * </code>
 * - Pessoa Jur�dica
 * <code>
 * $pessoa_juridica = new PessoaJuridica();
 * </code>
 * 
 * Tanto <var>$pessoa_fisica</var> quanto
 * <var>$pessoa_juridica</var> ser�
 * inst�ncias v�lidas de Pessoa.
 * 
 * @package modelo
 * @access public
 * @abstract
 */
class Pessoa implements IteratorAggregate, ArrayAccess {
  // atributos de inst�ncia de Pessoa
  /**
   * Array dos demais atributos a serem acessados via __get()/__set().
   * <b>Atributos:</b>
   * - id
   * - nome
   * - email
   * - telefone
   * - login
   * - senha
   * - endereco
   *
   * @see Pessoa::__get()
   * @see Pessoa::__set()
   * @access private
   * @var array 
   */
  private $atributos;
  // ------------ ### ------------- //

  // m�todos construtores e destrutores
  /**
   * Construtor da Pessoa.
   * Todos os par�metros s�o opcionais. S�o utilizados para
   * carregar todo o estado da Pessoa no momento da inst�ncia.
   * @access public
   * @param int $id Identificador da Pessoa
   * @param string $nome Nome da Pessoa
   * @param string $email Email da Pessoa
   * @param string $telefone Telefone da Pessoa
   * @param string $login login da Pessoa
   * @param string $senha senha da Pessoa
   * @param Endereco $endereco Endere�o inicial a adicionar � Pessoa
   */
  public function __construct($id = "", $nome = "", $email = "", 
                              $telefone = "", $login = "", 
                              $senha = "", $endereco = "") {

    $this->id        = $id;
    $this->nome      = $nome;
    $this->email     = $email;
    $this->telefone  = $telefone;
    $this->login     = $login;
    $this->senha     = $senha;

    $this->enderecos = array();

    if ($endereco != "") {
      $this->adicionarEndereco($endereco);
    } 
  }
  /**
   * Destrutor da Pessoa.
   * Apenas apaga o endere�o
   * 
   * @access public
   */
  public function __destruct() {
    unset($this->enderecos);
  } 
  // ------------ ### ------------- //
  // demais m�todos de neg�cio
  /**
   * M�todo de neg�cio para adicionar endere�os � Pessoa.
   * Recebe um objeto Endereco e adiciona ao array
   * 
   * @access public
   * @param Endereco $endereco Endere�o a ser adicionado
   * 
   */
  public function adicionarEndereco($endereco){
  	error_reporting(E_ALL);
    $this->enderecos[] = $endereco;
    var_dump($this->enderecos);
  }

  /**
   * M�todo auxiliar para valida��o dos campos gen�ricos de Pessoa.
   * Utilizado para promovendo reutiliza��o de c�digo
   * 
   * @access protected
   * @return boolean Verdadeiro se os campos forem v�lidos
   */
  protected function validarCamposBasicos() {
    // conferindo m�todos comuns de Pessoa
    if (trim($this->getNome()) == "" ||
      trim($this->getEmail()) == "" ||
      trim($this->getLogin()) == "" ||
      strlen(trim($this->getSenha())) < 6) {
      return false;
    }
    return true;
  }

  /**
   * M�todo para valida��o de todos os atributos.
   * Abstrato devido a Pessoa ainda n�o saber quais
   * campos ser�o avaliados
   * 
   * @abstract
   * @access public
   * @return boolean Verdadeiro se os campos forem v�lidos
   * @see Pessoa::validarCamposBasicos()
   */
//  public abstract function validarCampos();
  
  // ------------ ### ------------- //
  // M�todos SPL
  /**
   * M�todo redefinido de IteratorAggregate
   * @see IteratorAggregate
   * @return ArrayIterator Objeto para iterar sobre os atributos da Pessoa
   */
  public function getIterator() {
  	return new ArrayIterator($this);
  }

  /**
   * Define um valor para o atributo $key.
   * M�todo redefinido de ArrayAccess.
   * @param string|integer $key
   * @param mixed $value
   */
  function offsetSet($key, $value) {
    $this->$key = $value;
  } 
  /**
   * Recupera o valor do atributo $key.
   * M�todo redefinido de ArrayAccess.
   * @param string|integer $key
   * @return mixed Valor do atributo
   */
  function offsetGet($key) {
    return $this->$key;
  } 
  /**
   * Deleta o valor do atributo $key.
   * M�todo redefinido de ArrayAccess.
   * @param string|integer $key
   */
  function offsetUnset($key) {
    unset($this->$key);
  } 
  /**
   * Verifica a exist�ncia do atributo $key.
   * M�todo redefinido de ArrayAccess.
   * @param string|integer $key
   * @return boolean Se existe ou n�o o �ndice passado
   */
  function offsetExists($key) {
    return array_key_exists($key,$this->atributos);
  } 
  // ------------ ### ------------- //
  // m�todos getters e setters
  /**
   * M�todo interceptador das atribui��es ao estado da Pessoa.
   * Interceptar� qualquer atribui��o de valor a alguma
   * propriedade de Pessoa que n�o tenha sido declarada.
   * N�o permitir� inser��o de valores inv�lidos no atributo endere�os
   * 
   * @access public
   * @param string $propriedade nome do atributo
   * @param mixed $valor valor a ser atribu�do
   */
  public function __set($propriedade, $valor) {
    if ($propriedade == "enderecos") {
      if (is_array($valor)) {
        $this->atributos['enderecos'] = array();
        foreach ($valor as $endereco) {
          if ($endereco instanceof Endereco) {
          	$this->adicionarEndereco($endereco);
          }
        }
      }
    } else {
      $this->atributos[$propriedade] = $valor;
    }
  }		

  /**
   * M�todo interceptador de consultas a valores
   * dos atributos de Pessoa.
   * Ir� buscar no array <code>$this->atributos</code>
   * a propriedade solicitada no par�metro.
   *
   * @param string $propriedade nome do atributo
   * @return mixed valor atribu�do
   */
  public function & __get($propriedade) {
    return $this->atributos[$propriedade];
  }

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
   * Recupera o valor de <var>$this->nome</var>
   * 
   * @access public
   * @return string
   */
  public function getNome() {
	  return $this->nome;
  }
  /**
   * Define um valor para <var>$this->nome</var>
   * 
   * @access public
   * @param string $nome
   */
  public function setNome($nome) {
    $this->nome = $nome;
  }
  /**
   * Recupera o valor de <var>$this->email</var>
   * 
   * @access public
   * @return string
   */
  public function getEmail() {
    return $this->email;
  }
  /**
   * Define um valor para <var>$this->email</var>
   * 
   * @access public
   * @param string $email
   */
  public function setEmail($email) {
	   $this->email = $email;
  }
  /**
   * Recupera o valor de <var>$this->telefone</var>
   * 
   * @access public
   * @return string
   */
  public function getTelefone() {
    return $this->telefone;
  }
  /**
   * Define um valor para <var>$this->telefone</var>
   * 
   * @access public
   * @param string $telefone
   */
  public function setTelefone($telefone) {
    $this->telefone = $telefone;
  }
  /**
   * Recupera o valor de <var>$this->login</var>
   * 
   * @access public
   * @return string
   */
  public function getLogin() {
    return $this->login;
  }
  /**
   * Define um valor para <var>$this->login</var>
   * 
   * @access public
   * @param string $login
   */
  public function setLogin($login) {
    $this->login = $login;
  }
  /**
   * Recupera o valor de <var>$this->senha</var>
   * 
   * @access public
   * @return string
   */
  public function getSenha() {
    return $this->senha;
  }
  /**
   * Define um valor para <var>$this->senha</var>
   * 
   * @access public
   * @param string $senha
   */
  public function setSenha($senha) {
    $this->senha = $senha;
  }
  /**
   * Recupera o valor de <var>$this->enderecos</var>
   * 
   * @access public
   * @return array array de Endereco
   * @see Endereco
   */
  public function getEnderecos() {
    return $this->enderecos;
  }
  /**
   * Define um valor para <var>$this->enderecos</var>
   * 
   * @access public
   * @param array $enderecos
   */
  public function setEnderecos($enderecos) {
    $this->enderecos = $enderecos;
  }
  // ------------ ### ------------- //
}
include_once 'Endereco.php';
$p1 = new Pessoa();
$p1->setEnderecos(array (new Endereco(1, "bla")));

var_dump($p1);

echo "<br>-------------<br>";
$p = new Pessoa(1, "Fulano");


$iterator = $p->getIterator();
var_dump($iterator);
foreach ($iterator as $chave => $valor) {
	echo "$chave: $valor<br>";
}
echo $p['nome'];
?>
