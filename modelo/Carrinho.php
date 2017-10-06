<?
/**
 * Arquivo de declaração da classe Carrinho
 * @package modelo
 * @author José Berardo
 * @since 1.0
 */

/**
 * Objeto facilitador do processo de escolha dos produtos para compras
 * 
 * Será manipulado durante toda a sessão do usuário
 * 
 * @package modelo
 * @access public
 * @see Compra
 */
class Carrinho {
  // variáveis de classe
  /**
   * Instância única do Carrinho.
   * Implementação do padrão de projeto Singleton
   * @static
   * @access private
   * @var Carrinho
   */
  private static $instancia;
  // ------------ ### ------------- //

  // atributos de instância de Carrinho
  /**
   * Identificador manipulado pela SESSION.
   * Hash MD5 correspondente ao PHPSESSID
   * @access private
   * @var string
   */
  private $identificador;
  /**
   * Array de ítens adicionados ao Carrinho
   * @access private
   * @var array
   * @see Item
   */
  private $itens;
  // ------------ ### ------------- //

  // métodos construtores e destrutores
  /**
   * Método de criação de objetos carrinho.
   * Estensão do padrão de projeto criacional 
   * [GoF] Singleton.
   * O Carrinho não será único por requisição do Cliente,
   * mas por sessão, assim, se o carrinho não estiver
   * carregado, mas salvo na sessão, este será retornado
   * no lugar da criação de um novo.
   * 
   * @access public
   * @static 
   * @see Carrinho::$instancia
   * @return Carrinho Carrinho único por toda sessão do usuário
   */
  public static function getCarrinhoAtual() {
    if (!isset(Carrinho::$instancia)) {
      Carrinho::$instancia = (isset($_SESSION['carrinho'])) ?
                             $_SESSION['carrinho'] : new Carrinho();
    }
    return Carrinho::$instancia;
  }
  /**
   * Construtor privado do Carrinho.
   * Carrinhos só são criados através de
   * <code>Carrinho::getCarrinhoAtual()</code>.
   * Inicia o <code>$this->identificador</code>
   * com a session_id() e <code>$this->itens</code>
   * com um novo array
   * @access private
   * @link http://www.php.net/manual/pt_BR/function.session-id.php
   */
  private function __construct() {
    $this->setIdentificador(session_id());
	$this->itens = array();
  }
  /**
   * Destrutor do Carrinho.
   * Ao final do script, antes da instância (única)
   * do carrinho ser apagada, ele será serializado
   * e salvo na sessão.
   * @access public
   */
  public function __destruct() {
    $_SESSION['carrinho'] = Carrinho::$instancia;
  }
  // ------------ ### ------------- //
  
  // demais métodos de negócio
  /**
   * Método que recupera o custo total do Carrinho.
   * Recupera e soma o resultado do calculo do 
   * custo de cada item do carrinho.
   * @access public
   * @see Item::calcularPreco()
   */
  public function calcularTotal() {
    $total = 0;
	foreach ($this->itens as $item) {
	  $total += $item->calcularPreco();
	}
    return $total;
  }
  /**
   * Método que adiciona itens ao Carrinho.
   * Se o item ainda não existir, será adicionado.
   * Se já existir, sua quantidade será incrementada.
   *
   * @access public
   * @param Produto $produto
   */
  public function adicionarProduto(Produto $produto) {
    $item_encontrado = $this->pesquisarItem($produto->getId());
    // adicionar se ele não estiver adicionado
    if (!$item_encontrado) {
      $item = new Item($produto, 1, $produto->getPreco());
      $this->itens[] = $item;
    // somar a quantidade se o item já estiver adicionado
    } else {
      $quantidade = $item_encontrado->getQuantidade();
      $item_encontrado->setQuantidade(++$quantidade);
    }
  }
  /**
   * Método privado para auxiliar na busca pelo item.
   * Retorna o Item ou false se não existir.
   *
   * @access private
   * @param int $id Identficador do Produto
   * @see Item
   * @return Item|boolean Item encontrado ou false
   */
  private function pesquisarItem($id) {
    foreach ($this->itens as $item) {
      if ($item->getProduto()->getId() == $id) {
        return $item;
      }
    }
    return false;
  }
  /**
   * Método para remover um item do Carrinho
   *
   * @access public
   * @param int $id Identificador do Produto
   * @link http://www.php.net/manual/pt_BR/function.array-splice.php
   */
  public function removerProduto($id) {
    for ($x = 0; $x < count($this->itens); $x++) {
      if ($this->itens[$x]->getProduto()->getId() == $id){
        break;
      }
    }
    array_splice($this->itens, $x, 1);
  }
  /**
   * Método para recalcular o conteúdo do Carrinho.
   * Os ítens com $novaQuantidade zero,
   * serão excluídos.
   * 
   * @access public
   * @param array $itens array de Ids de Produto
   * @param array $novasQuantidades array de quantidades
   */
  public function recalcular($itens, $novasQuantidades) {
    for ($x = 0; $x < count($itens); $x++) {
      $item_encontrado = $this->pesquisarItem($itens[$x]);
	  if ($item_encontrado) {
        if ($novasQuantidades[$x] > 0) {
          $item_encontrado->setQuantidade($novasQuantidades[$x]);
        } else {
          $this->removerProduto($item_encontrado->getProduto()->getId());
        }
      }
    }
  }
  // ------------ ### ------------- //
  
  // métodos getters e setters
  /**
   * Recupera o valor de <var>$this->identificador</var>
   * 
   * @access public
   * @return string Identificador do carrinho na sessão
   */
  public function getIdentificador() {
    return $this->identificador;
  }

  /**
   * Define um valor para <var>$this->identificador</var>
   * 
   * @access public
   * @param string $identificador
   */
  public function setIdentificador($identificador) {
    $this->identificador = $identificador;
  }

  /**
   * Recupera o valor de <var>$this->itens</var>
   * 
   * @access public
   * @see Item
   * @return array Array de itens
   * @throws ListaVazia
   */
  public function getItens() {
    if (count($this->itens) == 0) {
      throw new ListaVazia(ListaVazia::ITENS);
    }
    return $this->itens;
        }

  /**
   * Define um valor para <var>$this->itens</var>
   * 
   * @access public
   * @param array $itens
   * @see Item
   */
  public function setItens($itens) {
    $this->itens = $itens;
  }
  // ------------ ### ------------- //
}
?>