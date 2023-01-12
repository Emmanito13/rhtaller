<div class="modal fade" id="modalTurno" tabindex="-1" data-backdrop="true" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document"">
        <div class="modal-content">
            <div class="modal-header" style="background:rgb(208,101,3); color:#FFF">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo turno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="#" method="post">
                        <div class="row justify-content-center">
                            <center>
                                <label>Ingresa un nuevo turno:</label>
                            </center>
                            <input type="text" name="turnoNuevo" id="turnoNuevo" class="form-control input-sm">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" alt="submit" 0 class="btn btn-info" style="background:rgb(208,101,3); color:#FFF; margin: 1px" data-bs-dismiss="modal" id="guardarTurno">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#guardarTurno').click(function() {

            if ($('#turnoNuevo').val() == '') {            
                alert('Campo vacio, ingrese un nuevo turno');
            } else {
                agregaTurno($('#turnoNuevo').val());
            }

        });
    });
</script>