let currentPage = 1;

function fetchHeroes(page) {
    fetch(`heroes_list.php?page=${page}`)
        .then(response => response.json())
        .then(data => {
            displayHeroes(data.heroes);
            updatePagination(data.pagination);
        })
        .catch(error => console.error('Erro ao buscar heróis:', error));
}

function displayHeroes(heroes) {
    const heroList = document.getElementById('hero-list');
    heroList.innerHTML = heroes.map(hero => `
        <div class="hero-card">
            <h2>${hero.name}</h2>
            <p>Inteligência: ${hero.intelligence}</p>
            <p>Força: ${hero.strength}</p>
        </div>
    `).join('');
}

function updatePagination(pagination) {
    currentPage = pagination.current_page;
    document.getElementById('prev-page').disabled = currentPage === 1;
}

document.getElementById('prev-page').addEventListener('click', () => {
    if (currentPage > 1) {
        fetchHeroes(currentPage - 1);
    }
});

document.getElementById('next-page').addEventListener('click', () => {
    fetchHeroes(currentPage + 1);
});

fetchHeroes(currentPage);
