### Método GET

- Dados são passado pela URL, deve ser usado quando o intuito é RECUPERAR DADOS.

datasdeaniversario.com.br/?nome=João&Idade=23

A variável $_GET no PHP nada mais é do que um array vazio que vai receber os dados passados
via url de preferência. Também é possível enviar dados com o método e exibi-los da mesma forma


### Método POST

- Quando se usa GET os dados ficam visiveis na URL, com POST os dados são eviados através do form data e diferente do que aconteceria no GET, não vão atualizar sempre que se atualiza a página.

A única diferença no envio e recuperação de dados é a utilização do method="POST" para envir e do $_POST para recuperar

## RECOMENDAÇÃO
- Utiliza-se GET apenas para navegação de conteúdo, para formulários e inserção de dados utiliza-se sempre POST