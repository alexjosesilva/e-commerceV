<?php
/**
 * Arquivo de declara��o da classe ProdutosDAOXML
 *
 * @package modelo
 * @subpackage dados
 * @author Jos� Berardo
 * @since 1.0
 */

/**
 * Defini��o da classe de acesso a dados dos Produtos em XML atrav�s da SimpleXML.
 */
class ProdutosDaoXml implements ProdutosDao {
	/**
	 * Elemento do SimpleXML que carregar� a �rvore do arquivo XML
	 *
	 * @var SimpleXMLElement
	 */
	private $xmlElement;
	
	public function ProdutosDAOXML() {
		$this->xmlElement = simplexml_load_file("modelo/dados/dados.xml");
	}
	public function listarProdutos($termoFiltro = "", Categoria $categoria = NULL, $limite = 10, $pagina = 1) {
		$lista = array();
		// Verificando se o filtro é para os produtos da home
		$filtro_home = false;
		if ($termoFiltro == ProdutosDao::PRODUTOS_HOME) {
			$filtro_home = true;
			$termoFiltro = "";
		} else {
			$termoFiltro = strtolower($termoFiltro);
		}
		
		$xpath  = "//";
		// Adicionando o filtro por categoria
		$xpath .= (empty($categoria))
					? "categoria"
					: "categoria[@codigo=" . $categoria->getId() . "]";

		// Adicionando o filtro pelo nome do produto
		$xpath .= (empty($termoFiltro))
					? "/produto"
					: "/produto[contains(nome,'$termoFiltro') or contains(descricao,'$termoFiltro')]";
		$xProdutos = $this->xmlElement->xpath($xpath);
		// //categoria[@codigo=1]/produto[contains(nome, 'TV') or contains(descricao, 'TV')]
		if (count($xProdutos)==0) {
			throw new ListaVazia(ListaVazia::PRODUTOS);
		}
		
		foreach ($xProdutos as $xProduto) {
			$xCategoria = $xProduto->xpath("..");
			$produto = $this->montarObjeto($xProduto, $xCategoria[0]);
			$lista[] = $produto;
		}

		if ($filtro_home) {
			shuffle($lista);
			return array_slice($lista, 0, 10);
		}

		return $lista;
	}

	public function buscarPeloId($id) {
		$xProduto = $this->xmlElement->xpath("//categoria/produto[@codigo=$id]");
		$xCategoria = $xProduto[0]->xpath("..");
		//$xCategoria = $xproduto[0]->parentNode;
		return $this->montarObjeto($xProduto[0], $xCategoria[0]);
	}

	/**
	 * M�todo interno para montagem do objeto Produto.
	 * Refactoring Extract Method para reutiliza��o da rotina
	 *
	 * @param SimpleXMLElement $SimpleXMLElement
	 */
	private function montarObjeto($xProduto, $xCategoria) {
		$produto = CachePool::get("Produto", (int)$xProduto['codigo']);
		if (empty($produto)) {
			$produto = new Produto (
									(int)$xProduto['codigo'],
									utf8_decode($xProduto->nome),
									utf8_decode($xProduto->descricao),
									(float)$xProduto->preco
								   );
			CachePool::inserir($produto);
			$categoria = CachePool::get("Categoria", (int)$xCategoria['codigo']);
			if (empty($categoria)) {
				$categoria = new Categoria((int)$xCategoria['codigo'],
											utf8_decode($xCategoria->nome));
		
				$categoria->adicionarProduto($produto);
				
				CachePool::inserir($categoria);
			}
		}
		return $produto;
	}
	public function getTotalProdutos($termoFiltro = "", Categoria $categoria = null) {
		
	}
}
?>