<?php
class CategoriasDaoPdo implements CategoriasDao {

    public function listarCategorias() {
        try {
            $lista = array();
            $pdo = ConexaoPdo::getInstancia()->getDb();
            foreach ($pdo->query("Select * from phpdeveloper.categoria where idmae is null order by idcategoria") as $registro) {
                $categoria = CachePool::get("Categoria", $registro["idcategoria"]);
                if (empty($categoria)) {
                    $categoria = new Categoria($registro["idcategoria"], $registro["nome"]);
                    CachePool::inserir($categoria);
                }

                $lista[] = $categoria;
            }

            return $lista;
        } catch (PDOException $pe) {
            throw new DadosException($pe);
        }
    }
    
    public function buscarPeloId($id) {
        try {
            $pdo = ConexaoPdo::getInstancia()->getDb();
            $registro = $pdo->query("Select * from phpdeveloper.categoria where idcategoria = $id")->fetch();
            $categoria = CachePool::get("Categoria", $registro["idcategoria"]);
            if (empty($categoria)) {
                $categoria =  new Categoria($registro["idcategoria"], $registro["nome"]);
                CachePool::inserir($categoria);
            }

            return $categoria;
        } catch (PDOException $pe) {
            throw new DadosException($pe);
        }
    }
    public function salvar(Categoria $categoria) {
        // TODO implementar a lógica de inserir e atualizar
    }
}
?>