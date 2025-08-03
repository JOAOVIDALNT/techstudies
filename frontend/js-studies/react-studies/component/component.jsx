const domNode = document.getElementById('app');

// in react we use functions to create components
      function Header() {
        return <h1>Alguém salve o Santos</h1>;
      }
      const root = ReactDOM.createRoot(domNode);
    
root.render(<Header />);