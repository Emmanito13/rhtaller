<!-- Modal -->
<div class="modal fade" id="modalRecordNomina" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="title_modal_record"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php include_once 'tables/TablaRecordNomina.php' ?>
      </div>
      <div class="modal-footer">        
        <button type="button" class="btn btn-danger" onclick="showModalFechasHistorial()"><i class="fa-solid fa-file-pdf"></i> Imprimir historial</button>        
      </div>
    </div>
  </div>
</div>