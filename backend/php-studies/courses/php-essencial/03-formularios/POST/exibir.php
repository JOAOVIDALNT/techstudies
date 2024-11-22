<?php

$email = $_POST['email'];
$idade = intval($_POST['idade']);
//converte o valor de idade de string pra inteiro
//é indicado tratar os dados ao recebe-los


echo "O nome é: " . $_POST['nome'] . "<br>";
echo "O idade é: " . $idade . "<br>";
echo "O email é: " . $email . "<br>";
