const domNode = document.getElementById('app');

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

function HeaderComponent({ title }) { // you can either use props or destructure them
  return (
      <h1>{title}</h1> // when using props, a props.title is used to access the title prop
  );
}

const root = ReactDOM.createRoot(domNode);

root.render(<HomePage />);