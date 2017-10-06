<?php
namespace controlador;

use \modelo\dados\CategoriasDaoArray;
use \modelo\dados\ProdutosDaoArray;
use \modelo\dados\FabricaDao;
        
class Home extends Modulo {
    /**
     *
     * @var CategoriasDaoArray
     */
    private $daoCategorias;
    
    public function __construct() {
        parent::__construct();
        
        $this->daoCategorias = FabricaDao::getCategoriasDao();
        $this->daoProdutos = FabricaDao::getProdutosDao();
        Controlador::setar('categorias', $this->daoCategorias->listarCategorias());
    }
    
    public function index() {
        $produtos = $this->daoProdutos->
            listarProdutos(ProdutosDaoArray::PRODUTOS_HOME);

        Controlador::setar('produtos', $produtos);
        Controlador::despachar("index");
    }
    
    public function listarProdutos($categoria) {
        $categoria = $this->daoCategorias->buscarPeloId($categoria);
        $produtos = $this->daoProdutos->listarProdutos(null, $categoria);
        
        Controlador::setar('produtos', $produtos);
        Controlador::despachar("index");
    }
    
    public function buscarProdutos() {
        $categoria = null;
        if (!empty($_GET['categoria'])) {
            $categoria = $this->daoCategorias->buscarPeloId($_GET['categoria']);
        }
        $produtos = $this->daoProdutos->listarProdutos($_GET['termo'], $categoria);
        
        Controlador::setar('produtos', $produtos);
        Controlador::despachar("index");
        
    }

    public function carrinho() {
        Controlador::despachar("carrinho");
    }
}