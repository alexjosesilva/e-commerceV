<?php
/**
 * Arquivo de declaração da classe Produto
 * @package modelo
 * @author Jose Berardo
 * @since 1.0
 */
namespace modelo;

/**
 * Classe que representa os produtos da Loja
 * 
 * @package modelo
 * @access public
 */
class Produto {
  // atributos de inst�ncia de Produto
  /**
   * Identificador do Produto
   * @access public
   * @var int
   */
  public $id;
  /**
   * Nome do produto
   * @access public
   * @var string
   */
  public $nome;
  /**
   * Descri��o mais detalhada sobre o produto
   * @access public
   * @var string
   */
  public $descricao;
  /**
   * Pre�o unit�rio do produto
   * @access public
   * @var double
   */
  public $preco;
  /**
   * Categoria do produto
   * @access public
   * @var Categoria
   */
  public $categoria;
  // ------------ ### ------------- //
	
  // m�todos construtores e destrutores
  /**
   * Construtor do Produto.
   * Todos os par�metros s�o opcionais. S�o utilizados para
   * carregar todo o estado do Produto no momento da inst�ncia.
   * @access public
   * @param int $id
   * @param string $nome
   * @param string $descricao
   * @param double $preco
   * @param Categoria $categoria
   */
  public function __construct($id = "", $nome = "", $descricao = "",
                              $preco = "", $categoria = "") {
    $this->id        = $id;
    $this->nome      = $nome;
    $this->descricao = $descricao;
    $this->preco     = $preco;
    if ($categoria != "") {
      $this->categoria = $categoria;
    }
  }
  // ------------ ### ------------- //

  // demais m�todos de neg�cio
  // ------------ ### ------------- //
  
  // m�todos getters e setters

  // ------------ ### ------------- //
}
?>
