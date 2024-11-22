### Anotações


#### CONSTANTES
- define("pi", 3,14) -> é a forma correta de definir uma constante no php
- para utilizar o valor da constante não é necessário o sinal de "$".

```php
<?php

define('pi', 3,14);

echo pi;
```

#### Listas
- É simples inserir em listas com php
```php
<?php

$lista = array();

for($i = 0; $i <=10; $i++) {
    $lista[] = $i;
}
// cada loop adiciona um número no fim da lista, de 0 a 10.

// também é possível adicionar um item há um index específico passando ele entre colchetes

$lista[15] = 15; // adiciona o número 15 ao array na posição 15

array_pop; // retira o último item da lista
array_push // insere um ou mais elementos no final do array

```
