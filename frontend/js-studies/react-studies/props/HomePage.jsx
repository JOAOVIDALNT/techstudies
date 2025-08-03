const domNode = document.getElementById('app');

function HomePage() {
  return (
    <div>
        <HeaderComponent title="Titulo 1"/>
        <HeaderComponent title="Titulo 2"/>
    </div> // react needs a div to wrap multiple information
);
}

function HeaderComponent({ title }) { // you can either use props or destructure them
  return (
      <h1>{title}</h1> // when using props, a props.title is used to access the title prop
  );
}

const root = ReactDOM.createRoot(domNode);

root.render(<HomePage />);