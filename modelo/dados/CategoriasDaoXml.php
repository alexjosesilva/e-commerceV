<?php
/**
 * Arquivo de declara��o da classe CategoriasDAOXML
 * @package modelo
 * @subpackage dados
 * @author Jos� Berardo
 * @since 1.0
 */

/**
 * Implementa��o de CategoriasDAO em XML atrav�s da SimpleXML.
 */
class CategoriasDaoXml implements CategoriasDao {
	/**
	 * Elemento do SimpleXML que carregar� a �rvore do arquivo XML
	 *
	 * @var SimpleXMLElement
	 */
	private $xmlElement;
	
	public function __construct() {
		$this->xmlElement = simplexml_load_file("modelo/dados/dados.xml");
	}

	public function buscarPeloId($id) {
/*		foreach ($this->xmlElement->categoria as $categoriaAtual) {
			if ($categoriaAtual["codigo"] == $id) {
				return $this->montarObjeto($categoriaAtual);
			}
		}
*/
		$xCategoria = $this->xmlElement->xpath("//categoria[@codigo=$id]");
		return $this->montarObjeto($xCategoria[0]);
	}

	/**
	 * M�todo interno para montagem do objeto Categoria.
	 * Refactoring Extract Method para reutiliza��o da rotina
	 *
	 * @param SimpleXMLElement $SimpleXMLElement
	 */
	private function montarObjeto($SimpleXMLElement) {
		$categoria = CachePool::get("Categoria", (int)$SimpleXMLElement['codigo']);

		if (empty($categoria)) {
			$categoria = new Categoria((int)$SimpleXMLElement['codigo'],
										utf8_decode($SimpleXMLElement->nome));
			CachePool::inserir($categoria);
			if (count($SimpleXMLElement->produto) > 0) {
				foreach ($SimpleXMLElement->produto as $xProduto) {
					$produto = CachePool::get("Produto", (int)$xProduto['codigo']);
					if (empty($produto)) {
						$produto = new Produto((int)$xProduto['codigo'],
												utf8_decode($xProduto->nome),
												utf8_decode($xProduto->descricao),
												(float)$xProduto->preco);
						$categoria->adicionarProduto($produto);
						CachePool::inserir($produto);
					}
				}
			}
		}
		
		return $categoria;
	}
	public function listarCategorias() {
		$lista = array();
		//$xCategorias = $this->xmlElement->children();
		$xCategorias = $this->xmlElement->categoria;
		//$xCategorias = $this->xmlElement->xpath("//categoria");
		if (count($xCategorias)==0) {
			throw new ListaVazia(ListaVazia::CATEGORIAS);
		}
		$cont = 0;
		foreach ($xCategorias as $xCategoria) {
			$categoria = $this->montarObjeto($xCategoria);
			$lista[] = $categoria;
		}

		return $lista;
	}

	
	public function salvar(Categoria $categoria) {
		$dom = new DOMDocument("1.0", "UTF-8");
		$dom->formatOutput = true;
		$dom->load("modelo/dados/dados.xml");
		$raiz = $dom->documentElement;
		if ($categoria->getId() == 0) { // Inserir quando nenhum ID foi informado

			$categoriaDom = $dom->createElement('categoria');
			$categoriaDom->setAttribute("codigo", $categoria->getId());
			$categoriaDom->appendChild(new DOMElement('nome', $categoria->getNome()));
			$categoriaDom->appendChild(new DOMElement('produto'));
			$raiz->appendChild($categoriaDom);
			
		} else { // Atualizar a do ID correspondente
			$nos = new DOMXPath($dom);
			$resultadoNome = $nos->query("//categoria[@codigo=" . $categoria->getId() . "]/nome");
			$resultadoNome->replaceChild($dom->createElement("nome", $categoria->getNome()),
													$resultadoNome->item(0));
		}
		
		$dom->save("modelo/dados/dados.xml");
	}
	
	public function excluir($id) {
		$dom = new DOMDocument("1.0");
		$dom->formatOutput = true;
		$dom->load("modelo/dados/dados.xml");
		$raiz = $dom->documentElement;

		$nos = new DOMXPath($dom);
		$resultadoNome = $nos->query("//categoria[@codigo=$id]");
		$resultadoNome->item(0)->parentNode->removeChild($resultadoNome->item(0));
		
		$dom->save("modelo/dados/dados.xml");
	}
}
?>