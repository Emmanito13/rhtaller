


function agregaForm(datos) {
    //alert(datos);
    d = datos.split('||');
    $('#id').val(d[0]);
    $('#nombre').val(d[2]);
    $('#apellidos').val(d[3]);
    $('#fechaN').val(d[4]);
    verGenero(d[16]);
    $('#direccion').val(d[17]);
    $('#curp').val(d[19]);
    $('#numeroT').val(d[13]);
    $('#correo').val(d[15]);
    $('#rfc').val(d[20]);
    $('#fechaAImss').val(d[7]);
    $('#numeroLImss').val(d[21]);
    $('#numeroImss').val(d[14]);
    $('#sueldoLImss').val(d[8]);
    $('#numEmpleado').val(d[1]);
    $('#sueldo').val(d[6]);
    verTurno(d[22]);
    $('#fechaIAbarrotera').val(d[5]);
    verContrato(d[23]);
    verEmpresa(d[9]);
    verDepartamento(d[10]);
    verPuesto(d[11]);
    verJefe(d[12]);
    $('#observaciones').val(d[18]);
}

const verGenero = (sexo) => {
    if (sexo == 'M') {
        document.getElementById('radioM').checked = true;

    } else if (sexo == 'F') {
        document.getElementById('radioF').checked = true;
    }
}

const cambiaGenero = () => {
    if (document.getElementById('radioM').checked) {
        return 'M'

    } else if (document.getElementById('radioF').checked) {
        return 'F'
    }
}


const verTurno = async (turno) => {

    const response = await getTurnoByName(turno);    
    document.getElementById('turno').value = response[0].idTurno;    
}


const verContrato = async (contrato) => {

    const response = await getContratoByName(contrato);    
    document.getElementById('contrato').value = response[0].idContrato;   
}

const verEmpresa = async (empresa) => {

    const response = await getEmpresaByName(empresa);    
    document.getElementById('empresa').value = response[0].idEmpresa;
    
}

const verDepartamento = async (depa) => {

    const response = await getDepaByName(depa);    
    document.getElementById('departamento').value = response[0].idDepa;   
}


const verPuesto = async (puesto) => {

    const response = await getPuestoByName(puesto);    
    document.getElementById('puesto').value = response[0].idPuesto;    
}


const verJefe = async (jefe) => {

    const response = await getJefeByName(jefe);    
    document.getElementById('jefe').value = response[0].idJefe;  

}

function getTurnoByName(name) {
    const data = new URLSearchParams(`nombreTurno=${name}`);
    const options = {
        method: 'POST',
        body: data
    };
    return fetch('controller/controller.php?operador=turno_by_name', options)
        .then(res => res.json())
        .then(data => data);
}

function getContratoByName(name) {
    const data = new URLSearchParams(`nombreContrato=${name}`);
    const options = {
        method: 'POST',
        body: data
    };
    return fetch('controller/controller.php?operador=contrato_by_name', options)
        .then(res => res.json())
        .then(data => data);
}

function getEmpresaByName(name) {
    const data = new URLSearchParams(`nombreEmpresa=${name}`);
    const options = {
        method: 'POST',
        body: data
    };
    return fetch('controller/controller.php?operador=empresa_by_name', options)
        .then(res => res.json())
        .then(data => data);
}


function getDepaByName(name) {
    const data = new URLSearchParams(`nombreDepa=${name}`);
    const options = {
        method: 'POST',
        body: data
    };
    return fetch('controller/controller.php?operador=depa_by_name', options)
        .then(res => res.json())
        .then(data => data);
}

function getPuestoByName(name) {
    const data = new URLSearchParams(`nombrePuesto=${name}`);
    const options = {
        method: 'POST',
        body: data
    };
    return fetch('controller/controller.php?operador=puesto_by_name', options)
        .then(res => res.json())
        .then(data => data);
}

function getJefeByName(name) {
    const data = new URLSearchParams(`nombreJefe=${name}`);
    const options = {
        method: 'POST',
        body: data
    };
    return fetch('controller/controller.php?operador=jefe_by_name', options)
        .then(res => res.json())
        .then(data => data);
}

function preguntarSiNo(id, name, motivo, fechaB, observa, liquida) {
    alertify.confirm('Eliminar datos', '¿Está seguro de eliminar a ' + name +'?',
        function () { bajaEmpleado(id, motivo, fechaB, observa, liquida) }
        , function () { alertify.error('Proceso cancelado') });
}


function reporteBaja(id, nombre, apellidos) {

    $('#id').val(id);
    $('#nombre').val(nombre + " " + apellidos);
}

function bajaEmpleado(id, motivo, fechaB, observa, liquida) {

    cadena = "id=" + id +
        "&motivo=" + motivo +
        "&fechaB=" + fechaB +
        "&observa=" + observa +
        "&liquida=" + liquida;

    $.ajax({
        type: "POST",
        url: "darBajaEmpleado.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#tabla').load('tables/TablaDarBaja.php');
                alertify.success("Eliminado con exito");
            } else {
                alertify.error("La operacion no se concretó");
            }
        }
    });
}

const agregaEmpleado = (nombre, apellidos, fNacimiento, sexo, direccion, curp, nTelefono, correo, rfc, fAltaImss, noListaImss, nImss, sueldoImss, noEmpleado, sueldo, turno, fIngreso, contrato, empresa, departamento, puesto, jefe, observaciones) => {
    cadena = `nombre=${nombre.toUpperCase()}&apellidos=${apellidos.toUpperCase()}&fNacimiento=${fNacimiento}&sexo=${sexo}&direccion=${direccion}&curp=${curp.toUpperCase()}&nTelefono=${nTelefono}&correo=${correo}&rfc=${rfc.toUpperCase()}&fAltaImss=${fAltaImss}&noListaImss=${noListaImss}&nImss=${nImss}&sueldoImss=${sueldoImss}&noEmpleado=${noEmpleado}&sueldo=${sueldo}&turno=${turno}&fIngreso=${fIngreso}&contrato=${contrato}&empresa=${empresa}&departamento=${departamento}&puesto=${puesto}&jefe=${jefe}&observaciones=${observaciones}`;

    $.ajax({
        type: "POST",
        url: "altaEmpleado.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                alertify.success("Empleado ingresado exitosamente");
                limpiar();
                // window.location.href = "archivo.php";
                // setTimeout(() => {
                //     alertify.success("Empleado ingresado exitosamente");                            
                // },3000);                        
            } else {
                alertify.error("Algo mal ocurrio al insertar");
                alert(r);
            }
        }
    });
}



const actualizaDatos = () => {
    idE = $('#id').val();
    nombre = $('#nombre').val();
    apellidos = $('#apellidos').val();
    fechaN = $('#fechaN').val();
    sexo = cambiaGenero();
    direccion = $('#direccion').val();
    curp = $('#curp').val();
    numeroT = $('#numeroT').val();
    correo = $('#correo').val();
    rfc = $('#rfc').val();
    fechaAImss = $('#fechaAImss').val();
    noLImss = $('#numeroLImss').val();
    sueldoImss = $('#sueldoLImss').val();
    noImss = $('#numeroImss').val();
    Nlista = $('#numEmpleado').val();
    sueldo = $('#sueldo').val();
    turno = $('#turno').val();
    fechaIAbarrotera = $('#fechaIAbarrotera').val();
    contrato = $('#contrato').val();
    empresa = $('#empresa').val();
    departamento = $('#departamento').val();
    puesto = $('#puesto').val();
    jefe = $('#jefe').val();
    observaciones = $('#observaciones').val();



    cadena = `idE=${idE}&nombre=${nombre.toUpperCase()}&apellidos=${apellidos.toUpperCase()}&fechaN=${fechaN}&sexo=${sexo}&direccion=${direccion}&curp=${curp.toUpperCase()}&numeroT=${numeroT}&correo=${correo}&rfc=${rfc.toUpperCase()}&fechaAImss=${fechaAImss}&noLImss=${noLImss}&noImss=${noImss}&sueldoImss=${sueldoImss}&Nlista=${Nlista}&sueldo=${sueldo}&turno=${turno}&fechaIAbarrotera=${fechaIAbarrotera}&contrato=${contrato}&empresa=${empresa}&departamento=${departamento}&puesto=${puesto}&jefe=${jefe}&observaciones=${observaciones}`
    $.ajax({
        type: "POST",
        url: "editaEmpleado.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                alertify.success("Datos actualizados exitosamente");
                $('#tabla').load('tables/TablaGeneral.php');
            } else {
                alertify.error("Algo mal ocurrio al actualizar");
                alert(r);
            }
        }
    });
}

const limpiar = () => {

    $('#idempleado').val('');
    $('#nombre').val('');
    $('#apellidos').val('');
    $('#fechaN').val('');
    document.getElementById('radioM').checked = true;
    $('#direccion').val('');
    $('#curp').val('');
    $('#numeroT').val('');
    $('#correo').val('');
    $('#rfc').val('');
    $('#fechaAImss').val('');
    $('#numeroLImss').val('');
    $('#sueldoLImss').val('');
    $('#numeroImss').val('');
    $('#numEmpleado').val('');
    $('#sueldo').val('');
    $('#turno').val('');
    $('#fechaIAbarrotera').val('');
    $('#contrato').val('');
    $('#empresa').val('');
    $('#departamento').val('');
    $('#puesto').val('');
    $('#jefe').val('');
    $('#observaciones').val('');
}

const guardaDoc = () => {

    cadena = "idE=" + $('#id').val() + "&checkEmpleo=" + checkDoc($("#checkEmpleo").prop("checked")) +
        "&checkCurp=" + checkDoc($("#checkCurp").prop("checked")) +
        "&checkDomicilio=" + checkDoc($("#checkDomicilio").prop("checked")) +
        "&checkANP=" + checkDoc($("#checkANP").prop("checked")) +
        "&checkCarta1=" + checkDoc($("#checkCarta1").prop("checked")) +
        "&checkActa=" + checkDoc($("#checkActa").prop("checked")) +
        "&checkElector=" + checkDoc($("#checkElector").prop("checked")) +
        "&checkEstudios=" + checkDoc($("#checkEstudios").prop("checked")) +
        "&checkImss=" + checkDoc($("#checkImss").prop("checked")) +
        "&checkCarta2=" + checkDoc($("#checkCarta2").prop("checked"));
    $.ajax({
        type: "POST",
        url: "agregaDoc.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                alertify.success("Documentos actualizados exitosamente");
                $('#tabla').load('tables/TablaGeneral.php');
            } else {
                alertify.error("Algo mal ocurrio al actualizar");
                alert(r);
            }
        }
    });
}

const checkDoc = (check) => {
    if (check) {
        return 1;
    } else {
        return 'null';
    }
}

const rellenaDoc = (check, dato) => {
    if (dato == 1) {
        check.prop("checked", true);
    } else {
        check.prop("checked", false);
    }
}

const agregaFormDoc = (documentos) => {
    doc = documentos.split('||');
    $('#id').val(doc[0]);
    rellenaDoc($('#checkEmpleo'), doc[1]);
    rellenaDoc($('#checkCurp'), doc[2]);
    rellenaDoc($('#checkDomicilio'), doc[3]);
    rellenaDoc($('#checkANP'), doc[4]);
    rellenaDoc($('#checkCarta1'), doc[5]);
    rellenaDoc($('#checkActa'), doc[6]);
    rellenaDoc($('#checkElector'), doc[7]);
    rellenaDoc($('#checkEstudios'), doc[8]);
    rellenaDoc($('#checkImss'), doc[9]);
    rellenaDoc($('#checkCarta2'), doc[10]);
}
const agregaFoto = (fotos) => {
    f = fotos.split('||');
    $('#id').val(f[0]);
    $('#imgFrente').prop("src", 'fotos/' + f[1]);
    $('#imgPerfil').prop("src", 'fotos/' + f[2]);
    $('#imgINE').prop("src", 'fotos/' + f[3]);
    $('#rutaFrente').val(f[1]);
    $('#rutaPerfil').val(f[2]);
    $('#rutaINE').val(f[3]);
}

const agregarFotos = (id, frente, perfil, ine, rutaF, rutaP, rutaI) => {
    var idE = id;
    var fotoFrente = frente;
    var fotoPerfil = perfil;
    var fotoINE = ine;
    var rutaFrente = rutaF;
    var rutaPerfil = rutaP;
    var rutaINE = rutaI;
    var formData = new FormData();
    formData.append('d', idE);
    formData.append('f', fotoFrente);
    formData.append('p', fotoPerfil);
    formData.append('i', fotoINE);
    formData.append('x', rutaFrente);
    formData.append('y', rutaPerfil);
    formData.append('z', rutaINE);


    $.ajax({
        type: "POST",
        url: "agregaFoto.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function (r) {
            if (r == 1) {
                $('#tabla').load('tables/TablaGeneral.php');
                alertify.success("Foto agregada exitosamente");
            } else {
                alertify.error("Algo mal ocurrio");
                alert(r);
            }
        }
    });
    return false;
}

const agregaTurno = (turno) => {    
    cadena = "horario=" + turno;
    $.ajax({
        type: "POST",
        url: "agregaTurno.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                //alert("Turno ingresado exitosamente");
                //window.location.href = 'indexMenu.php';
                $('#modalTurno').modal('hide');
                alertify.success("Turno ingresado exitosamente");
                llenarTurnos();
            } else {
                alertify.error("Algo mal ocurrio al insertar turno");
                alert(r);
            }
        }
    });
}

const agregaContrato = (contrato) => {
    cadena = "nombre=" + contrato;
    $.ajax({
        type: "POST",
        url: "agregaContrato.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {                                
                $('#modalContrato').modal('hide');
                alertify.success("Contrato ingresado exitosamente");
                llenarContratos();
            } else {
                alertify.error("Algo mal ocurrio al insertar contrato");
                alert(r);
            }
        }
    });
}

const agregaEmpresa = (empresa) => {
    cadena = "nombre=" + empresa;
    $.ajax({
        type: "POST",
        url: "agregaEmpresa.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#modalEmpresa').modal('hide');
                alertify.success("Empresa ingresada exitosamente");
                llenarEmpresas();
            } else {
                alertify.error("Algo mal ocurrio al insertar empresa");
                alert(r);
            }
        }
    });
}

const agregaDepa = (depa) => {
    cadena = "nombre=" + depa;
    $.ajax({
        type: "POST",
        url: "agregaDepa.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#modalDepartamento').modal('hide');                
                alertify.success("Departamento ingresado exitosamente");
                llenarDepartamentos();
            } else {
                alertify.error("Algo mal ocurrio al insertar departamento");
                alert(r);
            }
        }
    });
}

const agregaPuesto = (puesto) => {
    cadena = "nombre=" + puesto.toUpperCase();
    $.ajax({
        type: "POST",
        url: "agregaPuesto.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#modalPuesto').modal('hide');
                alertify.success("Puesto ingresado exitosamente");
                llenarPuestos();                
            } else {
                alertify.error("Algo mal ocurrio al insertar puesto");
                alert(r);
            }
        }
    });
}

const agregaJefe = (jefe) => {
    cadena = "nombre=" + jefe;
    $.ajax({
        type: "POST",
        url: "agregaJefe.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#modalJefe').modal('hide');
                alertify.success("Jefe ingresado exitosamente");
                llenarJefes();
            } else {
                alertify.error("Algo mal ocurrio al insertar jefe");
                alert(r);
            }
        }
    });
}

const agregaFormVacaciones = (idE, fIngreso, nLista, nombre, apellidos, sueldo, depa) => {
    cadena = "idE=" + idE + "&Fingreso=" + fIngreso;
    $.ajax({
        type: "POST",
        url: "verificaVacaciones.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                alertify.success("Se crearon dias de vacaciones");
                window.location = `vacacionesEmpleado.php?idE=${idE}&fIngreso=${fIngreso}&nombre=${nombre}&apellidos=${apellidos}&nLista=${nLista}&sueldo=${sueldo}&depa=${depa}`;
                //$('#contenedor').load('vacacionesEmpleado.php', { idE, fIngreso, nLista, nombre, apellidos, sueldo, depa });
                //alert(r);
            } else {
                alertify.message("Dias de vacaciones encontrados");
                window.location = `vacacionesEmpleado.php?idE=${idE}&fIngreso=${fIngreso}&nombre=${nombre}&apellidos=${apellidos}&nLista=${nLista}&sueldo=${sueldo}&depa=${depa}`;
                //alert(r);
            }
        }
    });


}

const preguntarEstatus = (idE, noDia, fecha, estatus) => {

    var idE = $('#idE').val();
    var nLista = $('#nLista').val();
    var nombre = $('#nombre').val();
    var apellidos = $('#apellidos').val();
    var fIngreso = $('#fIngreso').val();
    var sueldo = $('#sueldo').val();
    var depa = $('#depa').val();
    if (fecha == "") {
        alertify
            .alert("No se ha seleccionado una fecha. Por favor selecciona una.", function () {
                alertify.message('OK');
            });
    } else {
        alertify.confirm('Cambiar estatus', '¿Está seguro de activar esta fecha?',
            function () { cambiaEstatus(idE, noDia, fecha, estatus, nLista, nombre, apellidos, fIngreso, sueldo, depa) }
            , function () { alertify.error('Proceso cancelado') });
    }

    // alert(`idE= ${idE}
    //         noDia=${noDia}
    //         fecha=${fecha}
    //         nombre=${nombre}`);
}

const cambiaEstatus = (idE, noDia, fecha, estatus, nLista, nombre, apellidos, fIngreso, sueldo, depa) => {
    cadena = "idE=" + idE + "&noDia=" + noDia + "&fecha=" + fecha + "&estatus=" + estatus;
    $.ajax({
        type: "POST",
        url: "cambiaEstatus.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                window.location = `vacacionesEmpleado.php?idE=${idE}&fIngreso=${fIngreso}&nombre=${nombre}&apellidos=${apellidos}&nLista=${nLista}&sueldo=${sueldo}&depa=${depa}`;
                alertify.success("Se actualizo con exito el estatus");
                //$('#contenedor').load('vacacionesEmpleado.php', { idE, fIngreso, nLista, nombre, apellidos, sueldo, depa });
                //alert(r);
            } else {
                alertify.error("Ocurrió un problema al actualizar estatus");
                alert(r);
            }
        }
    });
}

const verificaDiasVacaciones = (idE,diasV) => {
    cadena = "idE=" + idE;
    $.ajax({
        type: "POST",
        url: "verificaDiasVacaciones.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                window.location = `reciboVacaciones.php?idE=${idE}&diasV=${diasV}`;
                //$('#contenedor').load('vacacionesEmpleado.php', { idE, fIngreso, nLista, nombre, apellidos, sueldo, depa });
                //alert(r);
            } else {
                alertify.error("No hay fechas seleccionadas");
            }
        }
    });
}

const cumpleaños = (idE, fecha) => {
    cadena = "idE=" + idE + "&fecha=" + fecha;
    $.ajax({
        type: "POST",
        url: "verificaCumple.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                window.location = `cumpleEmpleado.php?idE=${idE}&fecha=${fecha}`;
                alertify.message("Dias de vacaciones encontrados");
                //$('#contenedor').load('vacacionesEmpleado.php', { idE, fIngreso, nLista, nombre, apellidos, sueldo, depa });
                //alert(r);
            } else {
                window.location = `cumpleEmpleado.php?idE=${idE}&fecha=${fecha}`;
                alertify.success("Se creó día de cumpleaños");
                // alertify.message("Dias de vacaciones encontrados");
                //window.location = `vacacionesEmpleado.php?idE=${idE}&fIngreso=${fIngreso}&nombre=${nombre}&apellidos=${apellidos}&nLista=${nLista}&sueldo=${sueldo}&depa=${depa}`;
                //alert(r);
            }
        }
    });

}

const verificaCumple = (idE) => {
    if ($("#checkCumple").prop("disabled") == true) {
        alertify.error('El bono de cumpleaños ya se pagó');
    } else {
        window.location = `reciboCumple.php?idE=${idE}`;
    }
}

function agregaFormBus(datos) {
    //alert(datos);
    d = datos.split('||');
    $('#id').val(d[0]);
    $('#Nombre').val(d[2]);
    $('#apellidos').val(d[3]);
    $('#fechaN').val(d[4]);
    verGenero(d[16]);
    $('#direccion').val(d[17]);
    $('#curp').val(d[19]);
    $('#numeroT').val(d[13]);
    $('#correo').val(d[15]);
    $('#rfc').val(d[20]);
    $('#fechaAImss').val(d[7]);
    $('#numeroLImss').val(d[21]);
    $('#numeroImss').val(d[14]);
    $('#sueldoLImss').val(d[8]);
    $('#numEmpleado').val(d[1]);
    $('#sueldo').val(d[6]);
    verTurno(d[22]);
    $('#fechaIAbarrotera').val(d[5]);
    verContrato(d[23]);
    verEmpresa(d[9]);
    verDepartamento(d[10]);
    verPuesto(d[11]);
    verJefe(d[12]);
    $('#observaciones').val(d[18]);
}

function agregaFormBaja(datos) {
    //alert(datos);
    d = datos.split('||');
    $('#id').val(d[0]);
    $('#Nombre').val(d[2]);
    $('#apellidos').val(d[3]);
    $('#fechaN').val(d[4]);
    verGenero(d[16]);
    $('#direccion').val(d[17]);
    $('#curp').val(d[19]);
    $('#numeroT').val(d[13]);
    $('#correo').val(d[15]);
    $('#rfc').val(d[20]);
    $('#fechaAImss').val(d[7]);
    $('#numeroLImss').val(d[21]);
    $('#numeroImss').val(d[14]);
    $('#sueldoLImss').val(d[8]);
    $('#numEmpleado').val(d[1]);
    $('#sueldo').val(d[6]);
    verTurno(d[22]);
    $('#fechaIAbarrotera').val(d[5]);
    verContrato(d[23]);
    verEmpresa(d[9]);
    verDepartamento(d[10]);
    verPuesto(d[11]);
    verJefe(d[12]);
    $('#observaciones').val(d[18]);
    $('#fechaBaja').val(d[24]);
    $('#motivo').val(d[25]);
    $('#observaBaja').val(d[26]);
    $('#liquida').val(d[27]);

}

const numDefault = () => {
    cadena = '#';
    $.ajax({
        type: "POST",
        url: "numDefault.php",
        data: cadena,
        success: function (r) {
            $('#numEmpleado').val(r);
            $('#numEmpleado').css('border-color', 'rgb(84, 247, 52)');
            $('#band').val('verde');       
        }
    });
}


const preguntaRecon = (idE, Nlista, nombre) => {
    alertify.confirm('Recontratación', '¿Está seguro de recontratar a ' + nombre +'?',
        function () { reincorpora(idE, Nlista) }
        , function () { alertify.error('Proceso cancelado') });
}

const reincorpora = (idE,Nlista) =>{
    cadena = `idE=${idE}&Nlista=${Nlista}`;
    $.ajax({
        type: "POST",
        url: "reicorporaEmpleado.php",
        data: cadena,
        success: function (r) {
            // $('#numEmpleado').val(r);
            // $('#numEmpleado').css('border-color', 'rgb(84, 247, 52)');
            if (r == 1) {
                alertify.success("Se recontrató el empleado exitosamente");
                $('#tabla').load('tables/TablaBajas.php');
            //     $('#numEmpleado').css('border-color','rgb(247, 32, 32)');                    
            //     alertify.error("El numero de lista ya existe, cambielo o genere uno nuevo por default");
            //     $('#band').val('rojo');                                          
            } else {
                alertify.error('Algo salió mal al recontratar empleado');
                alert(r);
            //     $('#numEmpleado').val(r);
            //     $('#numEmpleado').css('border-color','rgb(84, 247, 52)');
            //     $('#band').val('verde');                                              
             }
        }
    });

}

const modalTurno = () =>{
    $('#modalTurno').modal("show");    
}

const modalContrato = () =>{
    $('#modalContrato').modal("show");    
}

const modalEmpresa = () =>{
    $('#modalEmpresa').modal("show");    
}

const modalDepartamento = () =>{
    $('#modalDepartamento').modal("show");    
}

const modalPuesto = () =>{
    $('#modalPuesto').modal("show");    
}

const modalJefe = () =>{
    $('#modalJefe').modal("show");
}


const llenarTurnos = () =>{
    $('#turno').empty();
    $.ajax({        
        type: 'POST',
        url: 'controller/controller.php?operador=listar_turnos',
        beforeSend: function () { },
        success: function (response) {            
            if (JSON.parse(response).length == 0) {                
                $('#turno').prepend("<option selected>Elige un turno</option>");                
            } else {
                //$.each(JSON.parse) 
                $('#turno').prepend("<option selected>Elige un turno</option>");
                $.each(JSON.parse(response), function (id, name) {                 
                    $('#turno').prepend(`<option value="${name.idTurno}">${name.horario} </option>`);                    
                });                                
            }
        }
    });
}

const llenarContratos = () =>{
    $('#contrato').empty();
    $.ajax({        
        type: 'POST',
        url: 'controller/controller.php?operador=listar_contratos',
        beforeSend: function () { },
        success: function (response) {            
            if (JSON.parse(response).length == 0) {                
                $('#contrato').prepend("<option selected>Elige un contrato</option>");                
            } else {
                //$.each(JSON.parse) 
                $('#contrato').prepend("<option selected>Elige un contrato</option>");
                $.each(JSON.parse(response), function (id, name) {                 
                    $('#contrato').prepend(`<option value="${name.idContrato}">${name.nombre} </option>`);                    
                });                                
            }
        }
    });
}

const llenarEmpresas = () =>{
    $('#empresa').empty();
    $.ajax({        
        type: 'POST',
        url: 'controller/controller.php?operador=listar_empresas',
        beforeSend: function () { },
        success: function (response) {            
            if (JSON.parse(response).length == 0) {                
                $('#empresa').prepend("<option selected>Elige una empresa</option>");                
            } else {
                //$.each(JSON.parse) 
                $('#empresa').prepend("<option selected>Elige una empresa</option>");
                $.each(JSON.parse(response), function (id, name) {                 
                    $('#empresa').prepend(`<option value="${name.idEmpresa}">${name.nombre} </option>`);                    
                });                                
            }
        }
    });
}

const llenarDepartamentos = () =>{
    $('#departamento').empty();
    $.ajax({        
        type: 'POST',
        url: 'controller/controller.php?operador=listar_departamentos',
        beforeSend: function () { },
        success: function (response) {            
            if (JSON.parse(response).length == 0) {                
                $('#departamento').prepend("<option selected>Elige un departamento</option>");                
            } else {
                //$.each(JSON.parse) 
                $('#departamento').prepend("<option selected>Elige un departamento</option>");
                $.each(JSON.parse(response), function (id, name) {                 
                    $('#departamento').prepend(`<option value="${name.idDepa}">${name.nombre} </option>`);                    
                });                                
            }
        }
    });
}

const llenarPuestos = () =>{
    $('#puesto').empty();
    $.ajax({        
        type: 'POST',
        url: 'controller/controller.php?operador=listar_puestos',
        beforeSend: function () { },
        success: function (response) {            
            if (JSON.parse(response).length == 0) {                
                $('#puesto').prepend("<option selected>Elige un puesto</option>");                
            } else {
                //$.each(JSON.parse) 
                $('#puesto').prepend("<option selected>Elige un puesto</option>");
                $.each(JSON.parse(response), function (id, name) {                 
                    $('#puesto').prepend(`<option value="${name.idPuesto}">${name.nombre} </option>`);                    
                });                                
            }
        }
    });
}

const llenarJefes = () =>{
    $('#jefe').empty();
    $.ajax({        
        type: 'POST',
        url: 'controller/controller.php?operador=listar_jefes',
        beforeSend: function () { },
        success: function (response) {            
            if (JSON.parse(response).length == 0) {                
                $('#jefe').prepend("<option selected>Elige un jefe</option>");                
            } else {
                //$.each(JSON.parse) 
                $('#jefe').prepend("<option selected>Elige un jefe</option>");
                $.each(JSON.parse(response), function (id, name) {                 
                    $('#jefe').prepend(`<option value="${name.idJefe}">${name.nombre} </option>`);               
                });                                
            }
        }
    });
}
