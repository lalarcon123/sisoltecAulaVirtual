<?php
  $page_title = 'Home Page';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>

<?php include_once('layouts/admin_menu.php'); ?>
 
 <!-- Content Wrapper. Contains page content -->
 <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
      <section class="content">
      <div class="container-fluid">
        <h1> Bienvenido al Sistema</h1> 
      </div><!-- /.container-fluid -->
    </section>
    </div>
  </section>
  <!-- /.content-wrapper -->
  
  <script>
  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });
  </script>

<?php //include_once('layouts/footer.php'); ?>
