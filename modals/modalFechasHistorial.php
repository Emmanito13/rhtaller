<!-- Modal -->
<div class="modal fade bg-m" id="modalFechasHistorial" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">¿En que rango de fecha quieres imprimir el historial?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->
            <div class="modal-body">
                <div class="row justify-content-end">
                    <div class="col-auto text-center">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <div class="col-auto text-center">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">¿En que rango de fecha quieres imprimir el historial?</h1>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="col-auto text-center">
                        <label class="form-label fw-bold">Inicio: </label>
                    </div>
                    <div class="col-auto text-center">
                        <input id="inputDateStartRecord" type="date" class="form-control">
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <div class="col-auto text-center">
                        <label class="form-label fw-bold">Fin: </label>
                    </div>
                    <div class="col-auto text-center">
                        <input id="inputDateEndRecord" type="date" class="form-control">
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="col-auto text-center">
                        <div class="form-check">
                            <input class="form-check-input check-todo" type="checkbox" value="" id="checkHistorialTodo">
                            <label class="form-check-label" for="checkHistorialTodo">
                                Todo
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="printRecordNomina()"><i class="fa-solid fa-file-pdf"></i> Imprimir</button>
            </div>
        </div>
    </div>
</div>