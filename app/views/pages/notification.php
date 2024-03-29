<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<div class="bg-gray-100 flex flex-col  w-full">

   <div class="px-24 min-h-screen place-items-center bg-slate-900">
   <h1 class="text-4xl text-purple-400 text-center py-24 font-bold">Notifications</h1>
   <?php
   foreach ($data['notifs'] as $notif) : ?>

  <div class=" w-full max-w-3xl border-2 rounded-lg bg-gradient-to-br from-fuchsia-600 to-indigo-500 ">
    <div class="relative m-px overflow-hidden rounded-lg bg-slate-900 px-3 py-3 text-lg">
      <div class="absolute -top-[50px] -left-[15px] z-0 h-[140px] w-[140px] rounded-full border bg-pink-500 opacity-20 blur-[100px]"></div>
      <div class="relative z-10 text-center">
        <p class="text-sm "><?php echo $notif->text ?> <strong class=""> <?php echo $notif->created_by ?></strong> </p>
      </div>
    </div>
  </div>
  <?php endforeach; ?>

</div> 
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
