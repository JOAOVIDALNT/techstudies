## Geração de nota fiscal e conexão com bling



### Campos obrigatórios para geração do xml

#### GERAL
- pedido

codigo STRING(60)

#### CLIENTE
- nome do cliente | STRING(80) [x]
- tipo de pessoa (fisica, juridica ou estrangeiro) | STRING(1) -> J, F ou E [x]
- endereço | STRING(100)
- número (número da casa) | STRING(10)
- bairro | STRING(40)
- cep | STRING(10)
- cidade | STRING(30)
- uf | STRING(2)
- email | STRING(60)

#### PEDIDO
- descrição (Nome do item) | STRING(120)
- un (Tipo de unidade do item) | STRING(6) -> pc, un, cx
- qtde (quantidade do item no pedido) | DECIMAL(11,4)
- vlr_unit (valor unitário do item) | DECIMAL(17,10)
- tipo (tipo do item: Produto/Serviço) | STRING(1) -> P ou S
- origem (código da origem do item) | STRING(1)

#### OBS
- a api sped-nfe trabalha com NAMESPACES, então a única forma de instancia-la é através de OOP.




