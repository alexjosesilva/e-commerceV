<?php
/**
 * Arquivo de declara��o da classe ConexaoPdo
 * @package modelo
 * @subpackage dados
 * @author Jos� Berardo
 * @since 1.0
 */
/**
 * Classe abstrata ConexaoPdo que
 * representa a conex�o com o SGBD.
 * Ser� implementada como um Singleton.
 * @package modelo
 * @access public
 * @abstract
 */
class ConexaoPdo {
	/**
	 * Inst�ncia �nica da ConexaoPdo.
	 * Implementa��o do padr�o Singleto
	 * @var ConexaoPdo $instancia
	 */
	private static $instancia;

	/**
	 * Objeto que manipular� a conex�o com o SGB
	 * @var PDO
	 */
	private $db;

	/**
	 * Construtor privado.
	 * S� ser� executado uma �nica vez por script.
	 */
	private function __construct() {
		try {
			// Conex�o PDO para Bancos PostgreSQL
			$this->db = new PDO("pgsql:host=localhost port=5432 dbname=especializa user=postgres password=c4f3c0ms4l");
			// Conex�o PDO para Bancos MySQL
			//	    $this->db = new PDO("mysql:host=localhost;dbname=phpdeveloper","root", "root");
			 
			//$this->db->setFetchMode(PDO::FETCHMODE_ASSOC);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			throw new DadosException($e);
		}
	}

	/**
	 * M�todo que recupera a inst�ncia da classe ConexaoPdo
	 * @return ConexaoPdo
	 */
	public static function getInstancia() {
		if (!isset(self::$instancia)) {
			self::$instancia = new ConexaoPdo();
		}
		return self::$instancia;
	}

	/**
	 * Retorna a conex�o com o banco
	 * @return PDO
	 */
	public function getDb() {
		return $this->db;
	}
}
?>