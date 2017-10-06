<?php
/**
 * Arquivo de declara��o da classe Categoria
 * @package modelo
 * @author Jos� Berardo
 * @since 1.0
 */
namespace modelo;

/**
 * Categoria de produtos da Loja
 * 
 * @package modelo
 * @access public
 */
class Categoria {
  // atributos de inst�ncia de Categoria
  /**
   * Identificador da Categoria
   * @access public
   * @var int
   */
  public $id;
  /**
   * Nome da categoria
   * @access public
   * @var string 
   */
  public $nome;
  /**
   * Cole��o de produtos pertencentes � Categoria
   * @access public
   * @var array 
   * @see Produto
   */
  public $produtos;
  /**
   * Cole��o de Categorias pertencentes � Categoria atual
   * @access public
   * @var array 
   */
  public $subCategorias;
  /**
   * Categoria cuja a atual pertence
   * @access public
   * @var Categoria 
   */
  public $superCategoria;
  // ------------ ### ------------- //
	
  // m�todos construtores e destrutores
  /**
   * Construtor da Categoria.
   * Todos os par�metros s�o opcionais. S�o utilizados para
   * carregar todo o estado da Categoria no momento da inst�ncia.
   * @access public
   * @param int $id Identificador da Categoria
   * @param string $nome Nome da categoria
   * @param Categoria $superCategoria Categoria
   */
  public function __construct($id = "", $nome = "", $superCategoria = "") {
	$this->id = $id;
	$this->nome = $nome;
	$this->produtos = array();
	$this->subCategorias = array();
	if ($superCategoria != ""){
	  $this->superCategoria = $superCategoria;
	}
  }
  // ------------ ### ------------- //
	
  // demais m�todos de neg�cio
  /**
   * M�todo que adiciona Produtos � Categoria.
   * Determina o objeto corrente ($this) como
   * Categoria do $produto passado.
   * @access public
   * @param Produto $produto Produto a ser adicionado
   * @see Produto::setCategoria()
   */
  public function adicionarProduto(Produto $produto) {
    $produto->categoria = $this;
    $this->produtos[] = $produto;
  }
  /**
   * M�todo que adiciona subcategorias ao objeto corrente.
   * Determina o objeto corrente ($this) como
   * supercategoria da $categoria passada.
   * @access public
   * @param Categoria $categoria
   * @see Categoria::setSuperCategoria()
   */
  public function adicionarSubCategoria(Categoria $categoria) {
    $categoria->superCategoria = $this;
    $this->subCategorias[] = $categoria;
  }
  // ------------ ### ------------- //
  
  // m�todos getters e setters
  
  // ------------ ### ------------- //
}
?>