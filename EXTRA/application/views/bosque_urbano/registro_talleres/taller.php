<div id="page-wrapper">
  <div class="container-fluid">
  <div class="page-wrapper">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header" style="font-size:30px">
              <?= $titulo?>
            </h2>
          </div>
        </div>

        <div id="catalogoGuardaBosques">
          <?php include('catalogoTalleres.php'); ?>
      </div>
      <br>

      <div id="agregarModificar" hidden>
          <div class="row">
            <div class="col-lg-12">
              <h2 class="page-header">
                Formulario Registro de Talleres
              </h2>
            </div>
          </div>
          <?php include('AgregarModificar.php'); ?>
      </div>
    </div>

    <div id="modalColonias" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Colonias</h4>
          </div>
          <div class="modal-body" style="padding-bottom: 50px;">
             <?php		  $segments = array('general', 'buscadorColonias');		  		  ?>
		  <script>window.closeModal = function(){    $('#modalColonias').modal('hide');};</script>
		  <iframe src="<?=site_url($segments)?>" style="width:100%;height:500px;"></iframe>
        <!--< ?php include('buscadorColonias.php'); ?>-->
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <div id="modalGuarda" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Guardabosque</h4>
          </div>
          <div class="modal-body" style="padding-bottom: 50px;">
             <?php		  $segments = array('bosqueurbano', 'atajoGuardabosque');		  		  ?>
		  <script>window.closeModal = function(){    $('#modalColonias').modal('hide');};</script>
		  
		  <iframe src="<?=site_url($segments)?>" style="width:100%;height:500px;overflow:hidden"></iframe>
        <!--< ?php include('buscadorColonias.php'); ?>-->
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
<!-- Esta etiqueta se abre en la vista menu.php -->
</div>
<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/RegistroTaller.js"></script>
<script type="text/javascript">
  $('#fechaInicio').datepicker({
    format: 'dd/mm/yyyy',
    language: 'esp'
  });
  $('#tablaespecies').on('click', 'tbody tr', function(event) 
  {
    $(this).addClass('success').siblings().removeClass('success')
 });
</script>
