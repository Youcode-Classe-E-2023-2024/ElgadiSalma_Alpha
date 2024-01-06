let endpoint = 'http://localhost/ElgadiSalma_Alpha/Products/';
const addContainer = document.getElementById('addContainer');
const addButton = document.getElementById('addButton');
const saveButton = document.getElementById('saveButton');
const deleteButton = document.getElementById('deleteButton'); 
const productContainer = document.getElementById('productsContainer');

// console.log("salmaa");

let formIndex = 1;
let productArray = []; // Tableau pour stocker les données des utilisateurs

    addButton.addEventListener('click', function (event) {
        addContainer.insertAdjacentHTML('beforeend', createproductFormHTML(formIndex));
        formIndex++;
    });

    saveButton.addEventListener('click', function (event) {
        addProduct();
        saveProducts(); 
    });

    function addProduct() 
    {
        const titles = document.querySelectorAll('[name^="title"]');
        const descriptions = document.querySelectorAll('[name^="description"]');
        
        const productData = {
            titles: Array.from(titles).map(input => input.value.trim()),
            descriptions: Array.from(descriptions).map(input => input.value.trim()),
        };

        if (productData.titles.every(title => title !== '') && 
            productData.descriptions.every(description => description !== '')
            ) {

            productArray.push(productData);
            
            titles.forEach(title => title.value = '');
            descriptions.forEach(description => description.value = '');

            console.log('product Array:', productArray);
        }
    }

    function saveProducts() {
        if (productArray.length > 0) {
            fetch(endpoint + 'addProducts', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(productArray),
            })
            .then(response => response.json())
            .then(data => { 
                console.log(data);
                productArray = [];
                fetchDataAndDisplay();
    
            })
            .catch(error => {
                console.error('Erreur', error);
            });
        }
    }

    function createproductFormHTML(index) 
    {
        return `
            <br>
            <h2 class="text-center drop-shadow-md font-bold text-2xl uppercase mb-10">Post </h2>
            <div>
                <div class="mb-5">
                    <label for="title" class="block mb-2 font-bold text-gray-600 uppercase">title</label>
                    <input type="text" id="title" name="title${index}" placeholder="title." class="border border-gray-300 shadow p-3 w-full rounded ">
                </div>

                <div class="mb-5">
                    <label for="description" class="block mb-2 font-bold text-gray-600 uppercase">description</label>
                    <input type="text" id="description" name="description${index}" placeholder="description." class="border border-gray-300 shadow p-3 w-full rounded ">
                </div>

            </div>
            <div id="dynamicDivContainer"></div>
            <div class="flex justify-between">
        `;
    }

    function fetchDataAndDisplay(){
    fetch(endpoint+`displayAll`)
        .then(response => response.json())
        .then(data => {
        displayData(data);
    })
        .catch(error => {
        console.error('Error:', error);
        });
    }

    function displayData(data) 
    {
        const rows = data.map((product) => {
            return `
                <div class="product-item px-5 py-3 text-center flex flex-col gap-2" data-productid="${product.id_product}">
                    <input class="text-black uppercase text-2xl font-bold text-center titleInput" value="${product.title}"/>
                    <div>
                        <input class="mt-2 text-blue-500 font-bold p-2 text-center descriptionInput" value="${product.description}"/>
                    </div>
                    <div>
                        <button name="supprimer" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline" onclick="deleteproduct(${product.id_product})">Supprimer</button>
                        <button name="modifier" class="text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline" onclick="editproduct(${product.id_product})">Modifier</button> 
                    </div>   
                </div>
            `;
        });
        productContainer.innerHTML = rows;
    }
    
    function deleteproduct(idProduct) {
        if (idProduct) {
            fetch(endpoint + `deleteProduct/${idProduct}`, {
                method: 'DELETE',
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                fetchDataAndDisplay();

            })
            .catch(error => {
                console.error('Erreur lors de la suppression:', error);
            });
        }
    }



    function editproduct(idProduct) {
        const titleInput = document.querySelector(`.product-item[data-productid="${idProduct}"] .titleInput`);
        const descriptionInput = document.querySelector(`.product-item[data-productid="${idProduct}"] .descriptionInput`);
    
        const productData = {
            title: titleInput.value.trim(),
            description: descriptionInput.value.trim(),
        };
    
        if (idProduct) {
            fetch(endpoint + `editProduct/${idProduct}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(productData),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                fetchDataAndDisplay();
            })
            .catch(error => {
                console.error('Error', error);
            });
        }
    }

    fetchDataAndDisplay();

    