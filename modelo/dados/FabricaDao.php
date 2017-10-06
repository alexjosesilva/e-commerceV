<?php
namespace modelo\dados;

class FabricaDao {
    // array, pdo, pgsql, mysql, xml, etc, tec
    private static $implementacao = "Array";

    public static function getCategoriasDao() {
        $classe = "\modelo\dados\CategoriasDao" . self::$implementacao;
        return new $classe();
    }
    public static function getProdutosDao() {
        $classe = "\modelo\dados\ProdutosDao" . self::$implementacao;
        return new $classe();
    }
}
?>