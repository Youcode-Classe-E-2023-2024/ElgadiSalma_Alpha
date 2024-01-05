<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<div class="bg-white-100 h-full overflow-y-auto w-full">
    <h2 class="text-center mt-16 py-4 drop-shadow-md font-bold text-4xl text-yellow-500 uppercase mb-10">new Products</h2>
    <div class="bg-white p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2">
        <div>
            <div class="mb-5">
                <label for="title" class="block mb-2 font-bold text-gray-600 uppercase">title</label>
                <input type="text" id="title" name="title[0]" name placeholder="Title." class="border border-gray-300 shadow p-3 w-full rounded " required>
            </div>
            <div class="mb-5">
                <label for="description" class="block mb-2 font-bold text-gray-600 uppercase">description</label>
                <input type="description" id="description" name="description[0]" description placeholder="description." class="border border-gray-300 shadow p-3 w-full rounded " required>
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
            <button type="button" id="saveButton" class="flex justify-center w-1/3 bg-green-500 text-white font-bold p-4 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                Save
            </button>

        </div>
    </div>

    <!-- display products -->
    <div class="py-10">
        <h1 class="text-3xl text-center ">
            Produit
        </h1>

        <div id="productsContainer" class="px-3 py-4 flex flex-col gap-2 text-center items-center justify-center">
        </div>

    </div>
    <!--  -->
    
</div>

</script><script src="<?php echo URLROOT ; ?>/js/products.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>


