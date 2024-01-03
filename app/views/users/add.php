<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<div class="bg-white-100 h-full overflow-y-auto w-full">
    <h2 class="text-center mt-16 drop-shadow-md font-bold text-6xl uppercase mb-10">new posts</h2>
    <div class="bg-white p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2">
        <div>
            <div class="mb-5">
                <label for="username" class="block mb-2 font-bold text-gray-600 uppercase">username</label>
                <input type="text" id="username" name="username[]" placeholder="UserName." class="border border-gray-300 shadow p-3 w-full rounded " required>
            </div>
            <div class="mb-5">
                <label for="email" class="block mb-2 font-bold text-gray-600 uppercase">Email</label>
                <input type="email" id="email" name="email[0]" placeholder="Email." class="border border-gray-300 shadow p-3 w-full rounded " required>
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 font-bold text-gray-600 uppercase">password</label>
                <input type="password" id="password" name="password[0]" placeholder="password." class="border border-gray-300 shadow p-3 w-full rounded " required>
            </div>
        </div>
        <div id="addContainer"></div>
        <div class="flex justify-between">
            <button type="button" id="addButton" class="flex justify-center w-1/3 bg-blue-500 text-white font-bold p-4 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                more post
            </button>
            <button type="button" id="addUser" class="flex justify-center w-1/3 bg-green-500 text-white font-bold p-4 rounded-lg" name="addUser" onclick="addUser()" >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                Save
            </button>
        </div>
    </div>
</div>

<script>
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
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>