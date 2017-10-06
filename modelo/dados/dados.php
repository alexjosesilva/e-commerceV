<?php
/**
 * Arquivo PHP que simula uma base de dados
 * @package modelo
 * @subpackage dados
 * @author Jose Berardo
 * @since 1.0
 */
use \modelo\Categoria;
use \modelo\Produto;

/**
 * Cole��o dos dados <i>fake</i> da Loja
 * @global array $dados MENTIIIIIRA Dados tem o escopo de quem o chamar (include)
 * @name $dados
 */
$dados = array();

// cria��o das categorias
$dados['categorias'] = array(new Categoria(1, "Eletrodomésticos"), 
                             new Categoria(2, "Móveis"),
                             new Categoria(3, "Telefonia"),
                             new Categoria(4, "Comida"),
                             new Categoria(5, "Vestuário"),
                             new Categoria(6, "Teste"));  

// cria��o dos produtos
$dados['produtos'][] = new Produto(1, "TV 29'", "TV de 29 polegadas, tela plana, do array", 900.25);
$dados['produtos'][] = new Produto(2, "Caixa de som 2.1", "Caixas de som com Subwoofer 1200W - XYZ500 Prata", 139);
$dados['produtos'][] = new Produto(3, "DVDokê", "DVD Player com DivX/Karaokê/MP3/WMA e Foto CD", 349.99);
$dados['produtos'][] = new Produto(4, "Home Theater 6.1", "Home Theater 6.1 1000W com Receiver", 1299);
$dados['produtos'][] = new Produto(5, "Geladeira", "Geladeira Frost Free", 1900);

$dados['produtos'][] = new Produto(6, "Cama Box Casal", "Cama Box Casal 138X188X30cm", 799.99);
$dados['produtos'][] = new Produto(7, "Armário acrílico", "Armário com portas de acrílico deslizantes", 1150);
$dados['produtos'][] = new Produto(8, "Mesa de jantar", "Mesa de jantar ferro e tampo de vidro temperado", 1300);

$dados['produtos'][] = new Produto(9, "Telefone sem fio", "Telefone sem fio 900Mhz + Bina + Secretária", 96.92);
$dados['produtos'][] = new Produto(10, "Celular GSM", "Aparelho celular GSM desbloqueado", 559.90);
$dados['produtos'][] = new Produto(11, "Celular CDMA", "Aparelho celular CDMA desbloqueado", 199);

$dados['produtos'][] = new Produto(12, "Pão de forma", "Caixa de pão de forma", 3.20);
$dados['produtos'][] = new Produto(13, "Ovos", "Bandeija de ovos", 2.5);
$dados['produtos'][] = new Produto(14, "Queijo mussarela 200g", "Queijo Mussarela Importada Fatiada Bandeja 200g", 9);
$dados['produtos'][] = new Produto(15, "Macarrão", "Pacote de macarrão LaMacarrona", 0.72);

$dados['produtos'][] = new Produto(16, "Camisa polo infantil", "Camisa polo infantil - Seninha - amarela", 25.50);
$dados['produtos'][] = new Produto(17, "Short", "Short poliester preto", 15);
$dados['produtos'][] = new Produto(18, "Calça jeans feminina", "Calça jeans feminina - com strass", 85);
$dados['produtos'][] = new Produto(19, "Camisola verde", "Camisola verde chiffon aro e bojo", 29.99);

// relacionamento Categoria X Produto
$dados['categorias'][0]->adicionarProduto($dados['produtos'][0]);
$dados['categorias'][0]->adicionarProduto($dados['produtos'][1]);
$dados['categorias'][0]->adicionarProduto($dados['produtos'][2]);
$dados['categorias'][0]->adicionarProduto($dados['produtos'][3]);
$dados['categorias'][0]->adicionarProduto($dados['produtos'][4]);

$dados['categorias'][1]->adicionarProduto($dados['produtos'][5]);
$dados['categorias'][1]->adicionarProduto($dados['produtos'][6]);
$dados['categorias'][1]->adicionarProduto($dados['produtos'][7]);

$dados['categorias'][2]->adicionarProduto($dados['produtos'][8]);
$dados['categorias'][2]->adicionarProduto($dados['produtos'][9]);
$dados['categorias'][2]->adicionarProduto($dados['produtos'][10]);

$dados['categorias'][3]->adicionarProduto($dados['produtos'][11]);
$dados['categorias'][3]->adicionarProduto($dados['produtos'][12]);
$dados['categorias'][3]->adicionarProduto($dados['produtos'][13]);
$dados['categorias'][3]->adicionarProduto($dados['produtos'][14]);

$dados['categorias'][4]->adicionarProduto($dados['produtos'][15]);
$dados['categorias'][4]->adicionarProduto($dados['produtos'][16]);
$dados['categorias'][4]->adicionarProduto($dados['produtos'][17]);
$dados['categorias'][4]->adicionarProduto($dados['produtos'][18]);

?>