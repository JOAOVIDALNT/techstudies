# REACT OVERVIEW

## INTRO
Inicialmente é essencial entender o papel do react como uma ferramenta de desenvolvimento declarativo, ou seja, não deverão ser passadas instruções imperativas para o DOM, aprenas declarações, facilitando assim o desenvolvimento rápido de aplicações. Além disso vale entender a importância o .jsx e suas regras.

```html
<body>
    <div id="app"></div>
    <!-- React and ReactDOM from CDN -->
    <script src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
    <!-- babel compiler to convert JSX to JavaScript -->
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script> 

    <!-- script needed for using react to manipulate DOM in a declarative way -->
    <script type="text/jsx">
      const domNode = document.getElementById('app');
      const root = ReactDOM.createRoot(domNode);
      root.render(<h1>React.</h1>);
    </script>

    <!-- Same script by manipulating DOM directly on a imperative way -->
    <script type="text/javascript">
    const app = document.getElementById('app');
    const header = document.createElement('h1');
    const text = 'Develop. Preview. Ship.';
    const headerContent = document.createTextNode(text);
    header.appendChild(headerContent);
    app.appendChild(header);
    </script>
</body>
```

## REACT CORE CONCEPTS
Existem 3 conceitos essenciais para se familiarizar no React
- Components
- Props
- State

### COMPONENTS
Fácil de entender e aplicar, componentes tem o objetivo de quebrar a aplicação em pequenos módulos, possibilitando também o reuso.

```html
 <script type="text/jsx">
      const domNode = document.getElementById('app');

      <!-- in react we use functions to create components -->
      function Header() {
        return <h1>Alguém salve o Santos</h1>;
      }
      const root = ReactDOM.createRoot(domNode);
      root.render(<Header />);
 </script>
```

#### NESTING COMPONENTS
Claro, também é possível referenciar um componente dentro de outro:

```jsx
function Header() {
  return <h1>Develop. Preview. Ship.</h1>;
}
 
function HomePage() {
  return (
    <div>
      <Header />
    </div>
  );
}
 
const root = ReactDOM.createRoot(app);
root.render(<HomePage />);
```

Você também pode repetir um componente dentro de outro sob demanda:
```jsx
function Header() {
  return <h1>Develop. Preview. Ship.</h1>;
}
 
function HomePage() {
  return (
    <div>
      <Header />
      <Header />
    </div>
  );
}
```

### PROPS
No desenvolvimento de aplicações é comum ter elementos que mudam de comportamento de acordo com a informação fonecida, por exemplo, no HTML mudando o atributo `src` de uma tag `<img>` altera a imagem a ser exibida. Da mesma forma, alterar o `href` de uma tag `<a>` muda o destino do link.

No React, você também pode passar pedaços de informação para os componentes, o que chamamos de `props`.

#### USING PROPS
As props podem ser passadas pra um componente através da sua instância:
```jsx
function HomePage() {
  return (
    <div>
      <Header title="React" />
    </div>
  );
}
```
E o componente deve aceitar props via parâmetro:
```jsx
function Header(props) {
  console.log(props); // { title: "React" }
  return <h1>Develop. Preview. Ship.</h1>;
}
```
Como props são um objeto, você pode utilizar o `object distruct` pra explicitar o nome dos valores dentro do parâmetro:
```jsx
function Header({ title }) {
  console.log(title); // "React"
  return <h1>{title}</h1>;
}
```
Note que você pode usar chaves `{}` dentro do jsx para escrever codigo regular do js dentro das tags de marcação.

### ITERATING LISTS
É comum listar dados em aplicações você pode utilizar métodos para manipular essa lista e exibir os diferentes tipos de informação de um mesmo modelo.

```jsx
function HomePage() {
  const books = ["Pragmatic programmer", "Grokking Algorithms", "Clean Code"];
  return (
    <div>
        <HeaderComponent title="Favorite programming books"/>
        <ul>
            {books.map((title) => ( 
                <li> {title} </li>
            ))}
        </ul>
    </div>
    );
}
```
No React é notável a usabilidade dos elementos nativos js, como é o caso do array.map(), bastanto abrir chaves para escrever qualquer sintaxe js progressivamente.

O React sempre recomenda utilizar uma `key` ao listar, considerando que nesse caso o nome é único podemos utilizar, mas o recomendado mesmo é algo como referência de ID.

```jsx
function HomePage() {
  const books = ["Pragmatic programmer", "Grokking Algorithms", "Clean Code"];
  return (
    <div>
        <HeaderComponent title="Favorite programming books"/>
        <ul>
            {books.map((title) => ( 
                <li key={title}> {title} </li>
            ))}
        </ul>
    </div>
    );
}
```
Utilizando o indice do próprio array como key identifier:
```jsx
function HomePage() {
  const books = ["Pragmatic programmer", "Grokking Algorithms", "Clean Code"];
  return (
    <div>
        <HeaderComponent title="Favorite programming books"/>
        <ul>
            {books.map((title, index) => ( 
                <li key={index}> {title} </li>
            ))}
        </ul>
    </div>
  );
}
```

### STATE
No React, é possível gerenciar estados com o UseState, assim, de maneira simples podemos gerenciar alterações de valores de elementos. Acompanhe o exemplo:

```jsx
function HomePage() {
  const books = ["Pragmatic programmer", "Grokking Algorithms", "Clean Code"];

  const [likes, setLikes] = React.useState(0); // [property, updateFunction] (initial value)
  const incrementLikes = () => setLikes(likes + 1);
  return (
    <div>
        <HeaderComponent title="Favorite programming books"/>
        <ul>
            {books.map((title, index) => ( 
                <li key={index}> {title} </li>
            ))}
        </ul>
        <button onClick={incrementLikes}>Like {likes}</button>
    </div>
  );
}
```


