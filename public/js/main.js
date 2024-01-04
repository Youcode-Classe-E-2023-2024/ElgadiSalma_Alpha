   console.log("saaa");
let endpoint = 'http://localhost/ElgadiSalma_Alpha/Users/';
const addContainer = document.getElementById('addContainer');
const addButton = document.getElementById('addButton');
const saveButton = document.getElementById('saveButton'); // Ajout du bouton "Save"

let formIndex = 1;
let userArray = []; // Tableau pour stocker les données des utilisateurs

addButton.addEventListener('click', function (event) {
    addContainer.insertAdjacentHTML('beforeend', createUserFormHTML(formIndex));
    formIndex++;
});

saveButton.addEventListener('click', function (event) {
    addUser(); // Appel de la fonction pour ajouter l'utilisateur
});

function addUser() {
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

        userArray.push(userData); // Ajout des données de l'utilisateur dans le tableau

        // Réinitialisation des champs après sauvegarde
        usernames.forEach(username => username.value = '');
        emails.forEach(email => email.value = '');
        passwords.forEach(password => password.value = '');

        console.log('User Array:', userArray);
    }
}

function createUserFormHTML(index) {
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
