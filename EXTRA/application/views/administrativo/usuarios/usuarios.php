<div id="page-wrapper">
  <div class="container-fluid">
   <!-- Page Heading -->
   <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header" style="font-size:30px">
        <?= $titulo?>
      </h1>
    </div>
  </div>
  <div id="buscarUsuarios" >
    <?php include('buscarUsuarios.php');?>
  </div><!--buscarUsuarios-->
  
  <div id="catalogoUsuarios" hidden>
    <?php include('catalogoUsuarios.php');?>
  </div><!--catalogoUsuarios-->
  
  <div id="buscadorColonias" hidden>
    <?php include('buscadorColonias.php');?>
  </div><!--buscadorColonias-->

  <div id="agregarColonia" hidden>
    <?php include('agregarColonia.php');?>
  </div><!--agregarColonia-->

 </div><!--container-fluid-->
</div><!--page-wraper-->

<!-- Esta etiqueta se abre en la vista menu.php -->
</div>

<script type="text/javascript" src="<?=base_url()?>js/administrativo/usuarios.js"></script>
<script> $('#tablaus').on('click', 'tbody tr', function(event) 
  {
    $(this).addClass('success').siblings().removeClass('success')
 });</script>
