<?php

include 'conexao.php';

if (count($_POST) > 0) {

    $nomeBanco = $_POST['Nome'];
    $enderecoBanco = $_POST['Endereco'];
    $codigoProduto = $_POST['codigoProduto'];

    $description = buscar_produto($conn, $codigoProduto);


    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->formatOutput = true; // FORMATA A SAÍDA DO XML


    // NÓ ITENS -> Possui atributos de item dinâmicos

    $i = 0;

    $itens = $dom->createElement('itens');
    // LAÇO PARA OS ITENS -> COM OS DADOS DO BANCO DEVE SER UM FOREACH
    while ($i < 5) {

        $origem = $dom->createElement('origem');
        $origemValue = $dom->createTextNode('origem' . $i);
        $origem->appendChild($origemValue);

        $tipo = $dom->createElement('tipo');
        $tipoValue = $dom->createTextNode('tipo' . $i);
        $tipo->appendChild($tipoValue);

        $vlr_unit = $dom->createElement('vlr_unit');
        $vlr_unitValue = $dom->createTextNode('vlr_unit' . $i);
        $vlr_unit->appendChild($vlr_unitValue);

        $qtde = $dom->createElement('qtde');
        $qtdeValue = $dom->createTextNode('qtde' . $i);
        $qtde->appendChild($qtdeValue);

        $un = $dom->createElement('un');
        $unValue = $dom->createTextNode('un' . $i);
        $un->appendChild($unValue);

        $descricao = $dom->createElement('descricao');
        $descricaoValue = $dom->createTextNode($description);
        $descricao->appendChild($descricaoValue);

        $codigo = $dom->createElement('codigo');
        $codigoValue = $dom->createTextNode('codigo' . $i);
        $codigo->appendChild($codigoValue);

        // NÓ DE ITEM
        $item = $dom->createElement('item');
        $item->appendChild($codigo);
        $item->appendChild($descricao);
        $item->appendChild($un);
        $item->appendChild($qtde);
        $item->appendChild($vlr_unit);
        $item->appendChild($tipo);
        $item->appendChild($origem);

        $itens->appendChild($item);

        $i++;
    }


    // FIM DO NÓ DE CLIENTE

    // EMAIL
    $email = $dom->createElement('email');
    $emailValue = $dom->createTextNode('joao@gmail.com');
    $email->appendChild($emailValue);

    // UF
    $uf = $dom->createElement('uf');
    $ufValue = $dom->createTextNode('SP');
    $uf->appendChild($ufValue);

    // CIDADE
    $cidade = $dom->createElement('cidade');
    $cidadeValue = $dom->createTextNode('São Paulo');
    $cidade->appendChild($cidadeValue);

    // CEP
    $cep = $dom->createElement('cep');
    $cepValue = $dom->createTextNode(02765000);
    $cep->appendChild($cepValue);

    // BAIRRO
    $bairro = $dom->createElement('bairro');
    $bairroValue = $dom->createTextNode('Vila do Chaves');
    $bairro->appendChild($bairroValue);

    // NÚMERO
    $numero = $dom->createElement('numero');
    $numeroValue = $dom->createTextNode(00);
    $numero->appendChild($numeroValue);

    // ENDEREÇO
    $endereco = $dom->createElement('endereco');
    $enderecoValue = $dom->createTextNode($enderecoBanco);
    $endereco->appendChild($enderecoValue);

    // TIPO DE PESSOA
    $tipoPessoa = $dom->createElement('tipoPessoa');
    $tipoPessoaValue = $dom->createTextNode('F');
    $tipoPessoa->appendChild($tipoPessoaValue);

    // NOME
    $nome = $dom->createElement('nome');
    $nomeValue = $dom->createTextNode($nomeBanco);
    $nome->appendChild($nomeValue);

    // INICIO DO NÓ DE CLIENTE !!!
    $cliente = $dom->createElement('cliente');
    $cliente->appendChild($nome);
    $cliente->appendChild($tipoPessoa);
    $cliente->appendChild($endereco);
    $cliente->appendChild($numero);
    $cliente->appendChild($bairro);
    $cliente->appendChild($cep);
    $cliente->appendChild($cidade);
    $cliente->appendChild($uf);
    $cliente->appendChild($email);



    // NÓ PRINCIPAL
    $pedido = $dom->createElement('pedido'); // INSTÂNCIA DO NÓ PEIDO
    $dom->appendChild($pedido); // ADICIONA O NÓ PEDIDO NO XML
    $pedido->appendChild($cliente); // ADICIONA O NÓ NOME DENTRO DE PEDIDO
    $pedido->appendChild($itens);


    // SALVA O CONTEÚDO EM UMA VARIÁVEL
    $xml = $dom->saveXML();
    echo $xml;
    
    // SALVA O CONTEÚDO EM UM ARQUIVO
    $dom->save(__DIR__ . '/arquivo.xml');

}


function buscar_produto($conn, $codigoProduto) {
    
    $consultaSelect = "SELECT descricao FROM itens WHERE codigo = $codigoProduto";

    $result = $conn->query($consultaSelect);
    
    $produto = $result->fetch_assoc();
    return $produto;
}

unset($_POST);


?>

<form method="POST">
    <input type="text" name="Nome">
    <input type="text" name="Endereco">
    <input type="text" name="codigoProduto">
    <input type="submit">Enviar</input>
</form>