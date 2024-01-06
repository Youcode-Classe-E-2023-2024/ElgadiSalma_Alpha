<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<div class="ml-20 pl-20 mt-6 pt-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">
    
<h1 class="text-4xl text-purple-400  py-6 text-center font-bold">Statistiques</h1>

    <!-- graphe -->
    <div class="pt-6 2xl:container">
    <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">
        <div class="md:col-span-2 lg:col-span-1">
            <div class="h-full py-6 px-6 rounded-xl border border-gray-200 bg-white">
                <h5 class="text-xl text-gray-700">Utilisateurs</h5>
                <div class="my-8">
                    <span class="text-gray-500">Compared to last week $13,988</span>
                </div>
                <canvas id="userChart" class="w-full" height="150"></canvas> <!-- Ajoutez cette balise canvas pour le graphique -->
    
            </div>          
    </div>
    

    <div class="md:col-span-2 lg:col-span-1">
        <div class="h-full py-6 px-6 rounded-xl border border-gray-200 bg-white">
            <h5 class="text-xl text-gray-700">Products</h5>
            <div class="my-8">
                <span class="text-gray-500">Compared to last week $13,988</span>
            </div>
            <canvas id="productChart" class="w-full" height="150"></canvas> <!-- Ajoutez cette balise canvas pour le graphique -->

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
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

