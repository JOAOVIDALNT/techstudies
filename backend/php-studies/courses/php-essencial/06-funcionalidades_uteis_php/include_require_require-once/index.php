<?php

include('teste.php');
// O INCLUDE TENTA INCLUIR E SE NÃO DER ELE MOSTRA UM AVISO, OU SEJA, SE COLOCASSEMOS inclue('teste1.php') SEGUIDO DE UM echo "Olá Mundo", ele mostraria um aviso de que teste1 não existe e exibiria o "Olá Mundo" em seguida

// Dependendo das configurações do servidor é possível que um erro de include nem notifique em tela e apenas apresente erro em algumas funcionalidades

// O require lança um erro fatal caso não encontre o arquivo e não continua o código
// É RECOMENDADO UTILIZAR O REQUIRE

// Require once define que um arquivo só precisa ser requerido uma vez, por exemplo, se requeremos um arquivo x que requere um arquivo y e queremos requerer o y denovo com require once ele não fara a requisição. 
echo $numero * 3;