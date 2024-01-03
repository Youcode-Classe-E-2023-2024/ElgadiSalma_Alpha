    console.log("saaa");
    let endpoint = 'http://localhost/ElgadiSalma_Alpha/Users/';
    const addContainer = document.getElementById('addContainer');
    const addButton = document.getElementById('addButton');

    let formIndex = 1;

    addButton.addEventListener('click', function (event) {
        addContainer.insertAdjacentHTML('beforeend', createUserFormHTML(formIndex));
        formIndex++;
    });

    function addUser() {
        const username = document.getElementById('username').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();

        const userData = {
            username: username,
            email: email,
            password: password,
        };

        if (username !== '' && email !== '' && password !== '') {

            fetch(endpoint + `addUsers`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(userData),
            })
                .then(response => response.json())
                .then(data => { 
                    console.log(data);
                })
                .catch(error => {
                    console.error('Erreur', error);
                });
        }
    }

    function createUserFormHTML(index) {
        return `
            <br>
            <h2 class="text-center drop-shadow-md font-bold text-2xl uppercase mb-10">Post </h2>
            <div>
                <div class="mb-5">
                    <label for="username" class="block mb-2 font-bold text-gray-600 uppercase">username</label>
                    <input type="text" id="username" name="username[]" placeholder="UserName." class="border border-gray-300 shadow p-3 w-full rounded ">
                </div>

                <div class="mb-5">
                    <label for="email" class="block mb-2 font-bold text-gray-600 uppercase">Email</label>
                    <input type="email" id="email" name="email[0]" placeholder="Email." class="border border-gray-300 shadow p-3 w-full rounded ">
                </div>

                <div class="mb-5">
                    <label for="password" class="block mb-2 font-bold text-gray-600 uppercase">password</label>
                    <input type="password" id="password" name="password[0]" placeholder="password." class="border border-gray-300 shadow p-3 w-full rounded ">
                </div>
            </div>
            <div id="dynamicDivContainer"></div>
            <div class="flex justify-between">
        `;
    }

