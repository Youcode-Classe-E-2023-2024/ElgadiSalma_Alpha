// User Graphe
fetch('http://localhost/ElgadiSalma_Alpha/Pages/grapheUser')
    .then(response => response.json())
    .then(data => {
        createUserChart(data); // Appelle la fonction spécifique pour les utilisateurs
    })
    .catch(error => {
        console.error('Error:', error);
    });

function createUserChart(data) {
    const dates = data.map(entry => entry.date);
    const counts = data.map(entry => entry.user_count);

    const ctx = document.getElementById('userChart').getContext('2d');
    const userChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dates,
            datasets: [{
                label: 'Nombre d\'utilisateurs ajoutés',
                data: counts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Nombre d\'utilisateurs'
                    }
                }
            }
        }
    });
}

// End User Graphe

// Product Graphe
fetch('http://localhost/ElgadiSalma_Alpha/Pages/grapheProduct')
    .then(response => response.json())
    .then(data => {
        createProductChart(data); // Appelle la fonction spécifique pour les produits
    })
    .catch(error => {
        console.error('Error:', error);
    });

function createProductChart(data) {
    const dates = data.map(entry => entry.date);
    const counts = data.map(entry => entry.product_count);

    const ctx = document.getElementById('productChart').getContext('2d');
    const productChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dates,
            datasets: [{
                label: 'Nombre de produits ajoutés',
                data: counts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Nombre de produits'
                    }
                }
            }
        }
    });
}

// End Product Graphe
