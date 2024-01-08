let endpoint = 'http://localhost/ElgadiSalma_Alpha/Users/';
const addContainer = document.getElementById('addContainer');
const addButton = document.getElementById('addButton');
const saveButton = document.getElementById('saveButton');
const deleteButton = document.getElementById('deleteButton'); 
const userContainer = document.getElementById('usersContainer');

console.log("salmaa");

let formIndex = 1;
let userArray = []; // Tableau pour stocker les données des utilisateurs

    addButton.addEventListener('click', function (event) {
        addContainer.insertAdjacentHTML('beforeend', createUserFormHTML(formIndex));
        formIndex++;
    });

    saveButton.addEventListener('click', function (event) {
        addUser();
        saveUsers(); 
    });

    function addUser() 
    {
        const usernames = document.querySelectorAll('[name^="username"]');
        const emails = document.querySelectorAll('[name^="email"]');
        const passwords = document.querySelectorAll('[name^="password"]');
        
        const userData = {
            usernames: Array.from(usernames).map(input => input.value.trim()),
            emails: Array.from(emails).map(input => input.value.trim()),
            passwords: Array.from(passwords).map(input => input.value.trim()),
        };

        if (userData.usernames.every(username => username !== '') && 
            userData.emails.every(email => email !== '') && 
            userData.passwords.every(password => password !== '')) {

            userArray.push(userData);
            
            usernames.forEach(username => username.value = '');
            emails.forEach(email => email.value = '');
            passwords.forEach(password => password.value = '');

            console.log('User Array:', userArray);
        }
    }

    function saveUsers() {
        if (userArray.length > 0) {
            fetch(endpoint + 'addUsers', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(userArray),
            })
            .then(response => response.json())
            .then(data => { 
                console.log(data);
                userArray = [];
                    if (data.some(item => item.message === 'email déjà existant')) {
                    alert('Email déjà existant. Veuillez utiliser un autre e-mail.');
                }
                fetchDataAndDisplay();

            })
            .catch(error => {
                console.error('Erreur', error);
            });
        }
    }

    function createUserFormHTML(index) 
    {
        return `
            <br>
            <h2 class="text-center drop-shadow-md font-bold text-2xl uppercase mb-10">Post </h2>
            <div>
                <div class="mb-5">
                    <label for="username" class="block mb-2 font-bold text-gray-600 uppercase">username</label>
                    <input type="text" id="username" name="username${index}" placeholder="UserName." class="border border-gray-300 shadow p-3 w-full rounded ">
                </div>

                <div class="mb-5">
                    <label for="email" class="block mb-2 font-bold text-gray-600 uppercase">Email</label>
                    <input type="email" id="email" name="email${index}" placeholder="Email." class="border border-gray-300 shadow p-3 w-full rounded ">
                </div>

                <div class="mb-5">
                    <label for="password" class="block mb-2 font-bold text-gray-600 uppercase">password</label>
                    <input type="password" id="password" name="password${index}" placeholder="password." class="border border-gray-300 shadow p-3 w-full rounded ">
                </div>
            </div>
            <div id="dynamicDivContainer"></div>
            <div class="flex justify-between">
        `;
    }

    fetch(endpoint+`displayAll`)
        .then(response => response.json())
        .then(data => {
        displayData(data);
    })
        .catch(error => {
        console.error('Error:', error);
        });


        function displayData(data) 
        {
            const rows = data.map((user) => {
                return `
                    <div class="user-item px-5 py-3 text-center flex flex-col gap-2" data-userid="${user.id_user}">
                        <input class="text-black uppercase text-2xl font-bold text-center usernameInput" value="${user.username}"/>
                        <div>
                            <input class="mt-2 text-blue-500 font-bold p-2 text-center emailInput" value="${user.email}"/>
                        </div>
                        <div>
                            <button name="supprimer" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline" onclick="deleteUser(${user.id_user})">Supprimer</button>
                            <button name="modifier" class="text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline" onclick="editUser(${user.id_user})">Modifier</button> 
                        </div>   
                    </div>
                `;
            });
            userContainer.innerHTML = rows;
        }
        
        function deleteUser(idUser) {
            if (idUser) {
                fetch(endpoint + `deleteUser/${idUser}`, {
                    method: 'DELETE',
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
        
                    const userItem = document.querySelector(`.user-item[data-userid="${idUser}"]`);
                    if (userItem) {
                        userItem.style.display = 'none';
                    }
    
                })
                .catch(error => {
                    console.error('Erreur lors de la suppression:', error);
                });
            }
        }


    
        function editUser(idUser) {
            const usernameInput = document.querySelector(`.user-item[data-userid="${idUser}"] .usernameInput`);
            const emailInput = document.querySelector(`.user-item[data-userid="${idUser}"] .emailInput`);
            
            const userData = {
                username: usernameInput.value.trim(),
                email: emailInput.value.trim(),
            };
        
            if (idUser) {
                fetch(endpoint + `editUsers/${idUser}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(userData),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    
                    // Mettez à jour les valeurs des champs de formulaire
                    usernameInput.value = userData.username;
                    emailInput.value = userData.email;
                })
                .catch(error => {
                    console.error('Error', error);
                });
            }
        }
        