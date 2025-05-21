function toggleMenu() {
  alert("Menu toggle clicado! Aqui você pode abrir o menu hambúrguer.");
}

function filtrarCategoria(categoria) {
  const cards = document.querySelectorAll('.pet-card');
  cards.forEach(card => {
    const tipo = card.getAttribute('data-tipo');
    if (tipo && tipo.toLowerCase() === categoria.toLowerCase()) {
      card.style.display = 'block';
    } else {
      card.style.display = 'none';
    }
  });
}



// Funcionalidade da barra de pesquisa
const searchInput = document.querySelector('.search-section input');
searchInput.addEventListener('input', () => {
  const searchText = searchInput.value.toLowerCase();
  const cards = document.querySelectorAll('.pet-card');
  cards.forEach(card => {
    const petName = card.querySelector('.pet-info h4').textContent.toLowerCase();
    const petDetails = card.querySelector('.pet-info p').textContent.toLowerCase();
    if (petName.includes(searchText) || petDetails.includes(searchText)) {
      card.style.display = 'block';
    } else {
      card.style.display = 'none';
    }
  });
});

// Funcionalidade do botão de pesquisa
const searchButton = document.querySelector('.search-section .filter-btn');
searchButton.addEventListener('click', () => {
  const searchText = searchInput.value.toLowerCase();
  const cards = document.querySelectorAll('.pet-card');
  cards.forEach(card => {
    const petName = card.querySelector('.pet-info h4').textContent.toLowerCase();
    const petDetails = card.querySelector('.pet-info p').textContent.toLowerCase();
    if (petName.includes(searchText) || petDetails.includes(searchText)) {
      card.style.display = 'block';
    } else {
      card.style.display = 'none';
    }
  });
});