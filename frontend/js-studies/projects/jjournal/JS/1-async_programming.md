Neste tópico, vou tratar de programação assíncrona no JavaScript, entendendo principalmente as `promisses`,  que são um recurso peculiar.

### PROMISES
#### 1. O QUE SÃO PROMISES?
Uma `Promise` é um objeto que representa a eventual finalização (ou falha) de uma operação assíncrona e o resultado dessa operação. Imagine uma `Promise` como um "compromisso" de que uma operação será concluída no futuro.

Existem 3 possíveis **estados** para uma `Promise`:
- **`Pending` (Pendente)**: A operação ainda não foi concluída. Esse é o estado inicial.
- **`Fulfilled` (Resolvida)**: A operação foi concluída com sucesso e a `Promise` tem um valor.
- **`Rejected` (Rejeitada)**: A operação falhou e a `Promise` tem um motivo ou erro associado.

#### 2. SINTAXE BÁSICA

Você cria uma `Promise` usando o construtor `new Promise`, passando uma função chamada de **executor**, que recebe dois argumentos:

- **`resolve`**: uma função a ser chamada quando a operação é concluída com sucesso.
- **`reject`**: uma função a ser chamada se a operação falhar.
```js
const minhaPromise = new Promise((resolve, reject) => {
  // Simula uma operação assíncrona (ex: requisição HTTP)
  setTimeout(() => {
    const sucesso = true; // Altere para false para ver o caso de erro
    if (sucesso) {
      resolve("Operação bem-sucedida!"); // Passa o valor de sucesso
    } else {
      reject("Algo deu errado."); // Passa o erro
    }
  }, 2000); // Aguarda 2 segundos
});
```

#### 3. CONSUMINDO UMA PROMISSE

Para manipular o resultado de uma `Promise`, usamos os métodos:

- **`.then()`**: Executado quando a `Promise` é resolvida com sucesso, recebe o resultado da `Promise`.
- **`.catch()`**: Executado quando a `Promise` é rejeitada, recebe o erro da `Promise`.
- **`.finally()`**: Executado ao final da `Promise`, independentemente do sucesso ou falha (opcional).

Exemplo de consumo:
```js
minhaPromise
  .then((resultado) => { // resolve
    console.log("Sucesso:", resultado);
  })
  .catch((erro) => { // reject
    console.error("Erro:", erro);
  })
  .finally(() => {
    console.log("Finalizado");
  });
```

#### 4. EXEMPLOS PRÁTICOS

##### Exemplo 1: Simulação de Requisição Assíncrona (com `setTimeout`)

Imagine que você está pedindo dados de um servidor, mas demora um pouco para receber a resposta.
```js
function buscarDados() {
  return new Promise((resolve, reject) => {
    setTimeout(() => {
      const sucesso = Math.random() > 0.5; // 50% de chance de sucesso
      if (sucesso) {
        resolve({ data: "Dados recebidos!" });
      } else {
        reject("Erro na requisição.");
      }
    }, 1000); // Simula 1 segundo de atraso
  });
}

buscarDados()
  .then((resposta) => {
    console.log(resposta.data);
  })
  .catch((erro) => {
    console.error(erro);
  });
```

##### Exemplo 2: Chain de Promises (Encadeamento)

Podemos encadear `.then()` para executar múltiplas operações de forma sequencial.
```js
function dobrarNumero(num) {
  return new Promise((resolve) => {
    setTimeout(() => {
      resolve(num * 2);
    }, 500);
  });
}

dobrarNumero(5)
  .then((resultado) => {
    console.log("Primeiro resultado:", resultado); // 10
    return dobrarNumero(resultado); // ação para encadeamento
  })
  .then((resultado) => {
    console.log("Segundo resultado:", resultado); // 20
    return dobrarNumero(resultado);
  })
  .then((resultado) => {
    console.log("Terceiro resultado:", resultado); // 40
  })
  .catch((erro) => {
    console.error(erro);
  });
```

#### 5. MÉTODOS ÚTEIS COM PROMISES

- **`Promise.all()`**: Executa múltiplas `Promises` em paralelo e retorna um `array` com todos os resultados, mas só resolve se **todas** forem resolvidas. Se uma falhar, rejeita tudo.
```js
const promise1 = Promise.resolve(3);
const promise2 = Promise.resolve(42);
const promise3 = new Promise((resolve) => setTimeout(resolve, 1000, 'foo'));

Promise.all([promise1, promise2, promise3]).then((valores) => {
  console.log(valores); // [3, 42, "foo"]
});
```

**`Promise.race()`**: Retorna a primeira Promise que resolver ou rejeitar, o que ocorrer primeiro.
```js
const promise1 = new Promise((resolve) => setTimeout(resolve, 500, 'primeiro'));
const promise2 = new Promise((resolve) => setTimeout(resolve, 100, 'segundo'));

Promise.race([promise1, promise2]).then((valor) => {
  console.log(valor); // "segundo"
});
```
##### SINTAXE DO SETTIMEOUT
```js
setTimeout(callback, tempo, retorno);
```
- **`callback`**: A função que será executada após o tempo especificado.
- **`tempo`**: O tempo em milissegundos a ser aguardado antes de executar o `callback`.
- **`retorno`** (opcional): O valor que será passado como argumento para o `callback` quando ele for executado.
###### Exemplo
Veja como isso funciona na prática:
```js
setTimeout((valor) => {
  console.log("Resultado:", valor);
}, 2000, "Esse é o valor de retorno");
```
Esse último argumento opcional é uma forma prática de passar um valor diretamente para o `callback` após o tempo de espera, evitando a necessidade de variáveis externas.

#### 6. PROGRAMAÇÃO ASSÍNCRONA COM `async/await`

Usar `async/await` simplifica o uso de `Promises`, permitindo escrever código assíncrono que se parece mais com código síncrono.
```js
async function processarDados() {
  try {
    const resultado1 = await dobrarNumero(5);
    console.log("Resultado 1:", resultado1);
    
    const resultado2 = await dobrarNumero(resultado1);
    console.log("Resultado 2:", resultado2);
    
    const resultado3 = await dobrarNumero(resultado2);
    console.log("Resultado 3:", resultado3);
  } catch (erro) {
    console.error("Erro:", erro);
  }
}

processarDados();
```

#### Resumo dos Conceitos Principais

- Uma `Promise` representa uma operação assíncrona com três estados: pendente, resolvida ou rejeitada.
- Use `.then()` para manipular o sucesso, `.catch()` para erros, e `.finally()` para executar no fim de uma `Promise`, independentemente do resultado.
- `Promise.all()` e `Promise.race()` são úteis para gerenciar múltiplas `Promises`.
- `async/await` facilita a leitura de código assíncrono, **mas só funciona com funções que retornam `Promises`.**

#### Observações
- `async/await` é projetado para trabalhar com **Promises**.
- Se você usar `await` com um valor direto (não uma Promise), ele será imediatamente resolvido, mas o `await` não adicionará nenhum comportamento assíncrono útil.
- Para garantir consistência em código assíncrono, você pode envolver valores diretos em `Promise.resolve()`.