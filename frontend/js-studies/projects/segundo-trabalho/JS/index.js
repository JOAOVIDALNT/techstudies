function loadContent(page) {
    // Lógica para carregar a página padrão na área de conteúdo
    $('#content').load('catalogo/' + page);
}

async function searchCep() {
    const cep = document.getElementById('cep').value;
    const result = document.getElementById('endereco');

    const response = await fetch(`https://brasilapi.com.br/api/cep/v1/${cep}`).then(request => request.json())
    .then((data) => {
        console.log(data);
        result.value = `${data.street} - ${data.neighborhood}, ${data.city}/${data.state}`;
    }).catch((error) => result.textContent = 'Cep não encontrado')
}
