<!-- Modal -->
<div class="modal fade" id="modalListaAsistencia" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Lista de asistencias</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-auto text-center">
                            <label class="form-label fw-bold">
                                Elige un departamento
                            </label>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto text-center">
                            <select id="selectDep" class="form-select" aria-label="Default select example">
                                <!-- <option selected>Seleccione un departamento</option>           -->
                            </select>
                        </div>
                    </div>

                    <hr class="navbar-divider">

                    <div class="row justify-content-center">
                        <div class="col-auto text-center">
                            <label class="form-label fw-bold">
                                Elige una rango de fecha
                            </label>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <input id="startDate" type="date" class="form-control">
                        </div>
                        <div class="col-auto">
                            <input id="endDate" type="date" class="form-control">
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="printFormatDepartamentos()"><i class="fa-regular fa-file-pdf"></i> DESCARGAR FORMATO</button>
            </div>
        </div>
    </div>
</div>