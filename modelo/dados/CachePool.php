<?php
/**
 * Arquivo de declara��o do cache de objetos em mem�ria
 */

/**
 * Classe pool de objetos salvos em cache
 * Implementação do padrão de projeto Register
 */
class CachePool {
	private static $pool = array();
	
	public static function inserir($objeto) {
		$chaves = self::obterChaves($objeto);
		self::$pool[$chaves['classe']][$chaves['id']] = $objeto;
	}
	
	public static function remover($objeto) {
		$chaves = self::obterChaves($objeto);
		if (self::existe($chaves['classe'], $chaves['id'])) {
			unset(self::$pool[$chaves['classe']][$chaves['id']]);
		}
	}
	
	public static function get($classe, $id) {
		if (self::existe($classe, $id)) {
			return self::$pool[$classe][$id]; 
		}
	}

	private static function existe($classe, $id) {
		if (!array_key_exists($classe, self::$pool)) {
			self::$pool[$classe] = array();
			return false;
		}

		return !empty(self::$pool[$classe][$id]);
	}
	
	private static function obterChaves($objeto) {
		$classe = get_class($objeto);
		$reflect = new ReflectionClass($classe);
		try {
//			 $id = $objeto->getId();
			$id = $reflect->getMethod("getId")->invoke($objeto);
			return array ("classe" => $classe, "id" => $id);
		} catch (ReflectionException $e) {
			throw new DadosException($e);
		}
	}
	
	public static function getPool() {
		return self::$pool;
	}
}
?>