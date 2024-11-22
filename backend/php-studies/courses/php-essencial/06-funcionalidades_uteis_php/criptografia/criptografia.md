# Criptografia

A CRIPTOGRAFIA FOI PENSADA PARA SER IRREVERSÍVEL, OU SEJA, IMPOSSÍVEL DESCRIPTOGRAFAR

```php
<?php 

$senha = "1234";

$md5 = md5($senha); // MÉTODO FRÁGIL

$hash = password_hash($senha, PASSWORD_DEFAULT); // MÉTODO ADEQUADO


echo "<p> Senha criptografada com password_hash -> " . $hash . " (Atualiza sempre)";
// ATUALIZA O HASH A CADA REQUISIÇÃO

echo "<p> Senha criptografada com md5 -> " . $md5 . " (Nunca atualiza)";
// TEM UM VALOR PADRÃO QUE NUNCA MUDA PARA CADA STRING

echo password_verify($senha, $hash);
// RETORNA 1 (TRUE)
```

## Método md5
O MÉTODO MD5 É MUITO FRÁGIL POIS A CRIPTOGRAFIA É PADRÃO PARA O VALOR, OU SEJA, USUÁRIOS COM UMA SENHA IDENTICA POSSUEM CRIPTOGRAFIAS INDENTICAS, E ATRAVÉS DE ALGUMAS BASES DE DADOS É POSSÍVEL DESCRIPTAR FACÍLMENTE UMA CRIPTOGRAFIA MD5.

## Função password_hash
A FUNÇÃO PASSWORD HASH DO PHP CONVERTE A SENHA EM UM HASH QUE NUNCA É IGUAL.

## Função password_verify
A FUNÇÃO PASSWORD VERIFY RECEBE DOIS PARÂMETROS (senha e hash de senha)  E CONSEGUE DEFINIR SE A SENHA COINCIDE COM O HASH.