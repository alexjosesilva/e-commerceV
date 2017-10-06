<?php
class ProdutosDaoPdo implements ProdutosDao {
	public function buscarPeloId($id) {
		try {
			$pdo = ConexaoPdo::getInstancia()->getDb();
			$registro = $pdo->query("Select p.*, c.nome as categoria
									 From phpdeveloper.produto p inner join phpdeveloper.categoria c using(idcategoria)
									 Where idproduto = $id")->fetch();
			$p = CachePool::get("Produto", $registro["idproduto"]);
			if (empty($p)) {
				$p = new Produto($registro["idproduto"], $registro["nome"], $registro["descricao"], $registro["preco"]);
				CachePool::inserir($p);	
			}
			$c = CachePool::get("Categoria", $registro["idcategoria"]);
			if (empty($c)) {
				$c = new Categoria($registro["idcategoria"], $registro["categoria"]);
				CachePool::inserir($c);
			}
			
			$c->adicionarProduto($p);
			return $p;
		} catch (PDOException $pe) {
			throw new DadosException($pe);
		}
	}
	public function listarProdutos($termoFiltro = "", Categoria $categoria = null, $limite = 10, $pagina = 1){ 
		try {
			$pdo = ConexaoPdo::getInstancia()->getDb();
			$filtros = array();
			$resultado = array();
			
			$sql = "Select p.*, c.nome as categoria
					From phpdeveloper.produto p inner join phpdeveloper.categoria c using (idcategoria)
					Where 1=1 ";
			if ($termoFiltro == ProdutosDao::PRODUTOS_HOME) {
				$sql .= " order by random() ";
				$termoFiltro = "";
			}
			if ($termoFiltro != "") {
				$termoFiltro = '%' . $termoFiltro . '%';
				$sql .= "and (p.nome ilike :nome or p.descricao ilike :descricao) ";
				$filtros[":nome"] = $termoFiltro;
				$filtros[":descricao"] = $termoFiltro;
			}
			if ($categoria != null) {
				$sql .= "and p.idcategoria = :idcategoria";
				$filtros[":idcategoria"] = $categoria->getId();
			}
			if (empty($pagina) || $pagina == 0) {
				$pagina = 1;
			}
			$offset = ($pagina - 1) * $limite;
				
			$preparo = $pdo->prepare($sql . " limit $limite offset $offset");
			
			$preparo->execute($filtros); // Retorna um PDOStatement
			if ($preparo->rowCount() == 0) {
				throw new ListaVazia(ListaVazia::PRODUTOS);
			}
//			foreach ($preparo->execute($filtros) as $registro) { // Tanto essa linha ou a de baixo
			while ($registro = $preparo->fetch()) {
				$p = CachePool::get("Produto", $registro["idproduto"]);
				if (empty($p)) {
					$p = new Produto($registro["idproduto"], $registro["nome"], $registro["descricao"], $registro["preco"]);
					CachePool::inserir($p);	
				}
				$c = CachePool::get("Categoria", $registro["idcategoria"]);
				if (empty($c)) {
					$c = new Categoria($registro["idcategoria"], $registro["categoria"]);
					CachePool::inserir($c);	
				}
				
				$c->adicionarProduto($p);
				$resultado[] = $p;
			}
			return $resultado;
		} catch (PDOException $pe) {
			throw new DadosException($pe);
		}
	}
	public function getTotalProdutos($termoFiltro = "", Categoria $categoria = null) {
		try {
			$pdo = ConexaoPdo::getInstancia()->getDb();
			$filtros = array();
			$resultado = array();
			
			$sql = "Select count(*) as total
					From phpdeveloper.produto p inner join phpdeveloper.categoria c using (idcategoria)
					Where 1=1 ";
			if ($termoFiltro == ProdutosDao::PRODUTOS_HOME) {
				$sql .= " order by random() limit 10";
				$termoFiltro = "";
			}
			if ($termoFiltro != "") {
				$termoFiltro = '%' . $termoFiltro . '%';
				$sql .= "and (p.nome ilike :nome or p.descricao ilike :descricao) ";
				$filtros[":nome"] = $termoFiltro;
				$filtros[":descricao"] = $termoFiltro;
			}
			if ($categoria != null) {
				$sql .= "and p.idcategoria = :idcategoria";
				$filtros[":idcategoria"] = $categoria->getId();
			}
			$preparo = $pdo->prepare($sql);
			
			$preparo->execute($filtros); // Retorna um PDOStatement
			$resultado = $preparo->fetch();
			return $resultado['total'];
		} catch (PDOException $pe) {
			throw new DadosException($pe);
		}
		
	
	
	}
	
}
?>