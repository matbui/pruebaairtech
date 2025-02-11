document.getElementById('clientForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const city = document.getElementById('city').value;
    const telephone = document.getElementById('phone').value;

    fetch('http://localhost:8000/api-rest/create_client.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name, email, city, telephone }),
    })
    .then(response => response.json())
    .then(data => {
        alert('Cliente creado con éxito');
        loadClients();
    })
    .catch(error => console.error('Error:', error));
});

function loadClients() {
    fetch('http://localhost:8000/api-rest/get_all_client.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#clientTable tbody');
            tbody.innerHTML = '';
            data.forEach(client => {
                const row = `<tr>
                    <td>${client.name}</td>
                    <td>${client.email}</td>
                    <td>${client.city}</td>
                    <td>${client.telephone}</td>
                    <td>
                        <button onclick="deleteClient(${client.id})">Eliminar</button>
                    </td>
                </tr>`;
                tbody.innerHTML += row;
            });
        })
        .catch(error => {
            console.error('Error:', error); 
        });
}

function deleteClient(id) {
    fetch(`http://localhost:8000/api-rest/delete_client.php?id=${id}`, {
        method: 'DELETE',
    })
    .then(response => response.json())
    .then(data => {
        alert('Cliente eliminado con éxito');
        loadClients();
    })
    .catch(error => console.error('Error:', error));
}

loadClients();