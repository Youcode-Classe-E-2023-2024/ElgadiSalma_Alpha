<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<div class="ml-20 mt-10 pt-10 pl-20 lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">
    
    <h1 class="text-4xl text-purple-400 py-6 text-center font-bold">Statistiques</h1>
    <div id="statistique">
    <!-- graphe -->
    <div class="pt-6 2xl:container">
        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">
            <div class="md:col-span-2 lg:col-span-1">
                <div class="h-full py-6 px-6 rounded-xl border border-gray-200 bg-white">
                    <h5 class="text-xl text-gray-700">Utilisateurs</h5>
                    <div class="my-8">
                        <span class="text-gray-500">Compared to last week $13,988</span>
                    </div>
                    <canvas id="userChart" class="w-full" height="150"></canvas>
                </div>
            </div>

            <div class="md:col-span-2 lg:col-span-1">
                <div class="h-full py-6 px-6 rounded-xl border border-gray-200 bg-white">
                    <h5 class="text-xl text-gray-700">Products</h5>
                    <div class="my-8">
                        <span class="text-gray-500">Compared to last week $13,988</span>
                    </div>
                    <canvas id="productChart" class="w-full" height="150"></canvas>
                </div>
            </div>

            <!-- end graphe -->
            <div class="md:col-span-2 lg:col-span-1">
                <div class="h-full py-6 px-6 rounded-xl flex flex-col justify-around border border-gray-200 bg-white">
                    <div>
                        <h5 class="text-xl text-yellow-500"><ins>Nombre d'utilisateurs :</ins></h5>
                        <h1 class="text-5xl font-bold text-gray-600"><?php echo $data['numOfUsers']; ?> </h1>
                    </div>

                    <div>
                        <h5 class="text-xl text-yellow-500"><ins>Nombre de produits :</ins></h5>
                        <h1 class="text-5xl font-bold text-gray-600"><?php echo $data['numOfProducts']; ?></h1>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- Ajoutdu bouton d'exportation PDF -->
        <div class="flex justify-center pt-10 mt-6">
            <button id="exportToPDF" class="bg-purple-400 hover:bg-black text-white font-bold py-2 px-4 rounded">Exporter en PDF</button>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
