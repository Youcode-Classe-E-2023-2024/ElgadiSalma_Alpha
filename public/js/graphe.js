// Exemple pour créer un graphique en utilisant les données récupérées
fetch('http://localhost/ElgadiSalma_Alpha/Pages/grapheUser')
        .then(response => response.json())
        .then(data => {
            createChart(data)
        })
        .catch(error => {
        console.error('Error:', error);
        });


function createChart(data) {
    const dates = data.map(entry => entry.user_date);
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
                    type: 'time',
                    time: {
                        unit: 'day' // ajustez ceci en fonction de vos besoins (day, week, month, etc.)
                    }
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// ... (votre code pour récupérer les données du serveur et appeler createChart)
