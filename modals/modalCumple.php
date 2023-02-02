<!-- Modal -->
<div class="modal fade" id="modalListaCumple" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Lista de cumpleaños</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-auto text-center">
                            <label class="form-label fw-bold">
                                Elige un mes:
                            </label>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto text-center">
                            <select id="selectMonthBirth" class="form-select" aria-label="Default select example">                                
                                <option selected value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="printFormatMonthBirthday()"><i class="fa-regular fa-file-pdf"></i> DESCARGAR FORMATO</button>
            </div>
        </div>
    </div>
</div>