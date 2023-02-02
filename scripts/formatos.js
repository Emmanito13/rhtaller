init();

function init() {
    optionsToastR();
}

function optionsToastR() {
    toastr.options = {
        "closeButton": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
    }
}

const modalDepa = async () => {
    $('#selectDep').empty();
    const response = await getDep();
    if (response.length == 0) {
        $('#selectDep').prepend("<option selected>No hay departamentos</option>");
    } else {
        response.forEach(element => {
            $('#selectDep').prepend(`<option value="${element.idDepa}">${element.nombre}</option>`);
        });
        $('#selectDep').prepend("<option selected>Todos</option>");
    }
}

const modalFemenino = async () => {
    $('#selectDepFem').empty();
    const response = await getDep();
    if (response.length == 0) {
        $('#selectDepFem').prepend("<option selected>No hay departamentos</option>");
    } else {        
        response.forEach(element => {            
            $('#selectDepFem').prepend(`<option value="${element.idDepa}">${element.nombre}</option>`);
        });
        $('#selectDepFem').prepend("<option selected>Todos</option>");
    }
}

const modalMasculino = async () => {
    $('#selectDepMasc').empty();
    const response = await getDep();
    if (response.length == 0) {
        $('#selectDepMasc').prepend("<option selected>No hay departamentos</option>");
    } else {        
        response.forEach(element => {            
            $('#selectDepMasc').prepend(`<option value="${element.idDepa}">${element.nombre}</option>`);
        });
        $('#selectDepMasc').prepend("<option selected>Todos</option>");
    }
}

function getDep() {
    const options = {
        method: 'POST',
    };
    return fetch('controller/controller.php?operador=listar_departamentos', options)
        .then(res => res.json())
        .then(data => data);
}

const printFormatDepartamentos = () => {
    if ($('#startDate').val() == '' || $('#endDate').val() == '') {
        toastr["error"]("Eliga un rango de fechas", "No hay rango de fecha");
    }else{
        window.location.href = `formats/ListaAsistenciasPDF.php?dep=${$("#selectDep option:selected").text()}&dateStart=${parseDate($('#startDate').val())}&dateEnd=${parseDate($('#endDate').val())}`;
    }
}

const printFormatMonthBirthday = () => {
    window.location.href = `formats/ListaCumpleMesPDF.php?mes=${$("#selectMonthBirth").val()}`;
}

const printFormatFemale = () => {
    window.location.href = `formats/ListaPersonalFemeninoPDF.php?dep=${$("#selectDepFem option:selected").text()}`;           
}

const printFormatMale = () => {
    window.location.href = `formats/ListaPersonalMasculinoPDF.php?dep=${$("#selectDepMasc option:selected").text()}`;      
}

const parseDate = (date) => {
    var strDate = date.split('-');
    return strDate[2] + "-" + strDate[1] + "-" + strDate[0];
}