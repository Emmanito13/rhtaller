var typeTable;

const loadDatosNomina = async () => {
  const result = await listNomina();
  var totalFaltantes = 0;
  var subtotal = 0;
  var totalPrestamo = 0;
  var totalInfonavit = 0;
  var total = 0;
  //console.log(result);
  if (result == 'empty') {
    //Load total empleados
    document.getElementById('lbl_empleados').innerHTML = 0;
    //Load total faltantes
    document.getElementById('lbl_faltantes').innerHTML = monedaMX(totalFaltantes);
    //Load subtotal
    document.getElementById('lbl_subtotal').innerHTML = monedaMX(subtotal);
    //load totalPrestamo
    document.getElementById('lbl_prestamos').innerHTML = monedaMX(totalPrestamo);
    //load totalInfonavit
    document.getElementById('lbl_infonavit').innerHTML = monedaMX(totalInfonavit);
    //load total
    document.getElementById('lbl_total').innerHTML = monedaMX(total);
  } else {
    result.forEach(element => {
      //console.log(element.faltantes);
      if (element.pago == 'Aprobado') {
        totalFaltantes += parseFloat(element.faltantes);
        subtotal += parseFloat(element.subtotal);
        totalPrestamo += parseFloat(element.prestamo);
        totalInfonavit += parseFloat(element.infonavit);
        total += parseFloat(element.total);
      }
    });

    //Load total empleados
    document.getElementById('lbl_empleados').innerHTML = result.length;
    //Load total faltantes
    document.getElementById('lbl_faltantes').innerHTML = monedaMX(totalFaltantes);
    //Load subtotal
    document.getElementById('lbl_subtotal').innerHTML = monedaMX(subtotal);
    //load totalPrestamo
    document.getElementById('lbl_prestamos').innerHTML = monedaMX(totalPrestamo);
    //load totalInfonavit
    document.getElementById('lbl_infonavit').innerHTML = monedaMX(totalInfonavit);
    //load total
    document.getElementById('lbl_total').innerHTML = monedaMX(total);
  }
}

init()

function init() {  
  toastr.options = {
    "closeButton": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
  }
  loadTableNomina();
  loadDatosNomina();
}

const monedaMX = (importe) => {
  return new Intl.NumberFormat('es-MX', {
    style: 'currency',
    currency: 'MXN',
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  }).format(importe);
}

function loadTableNomina() {

  tableNomina = $('#tableNomina').DataTable({
    language: {
      "lengthMenu": "Mostrar _MENU_ filas por página",
      "zeroRecords": "No hay elementos que coincidan",
      "info": "Mostrando página _PAGE_ de _PAGES_",
      "infoEmpty": "Mostrando 0 a 0 de 0 filas",
      "infoFiltered": "(filtradas de _MAX_ filas totales)",
      "search": "Buscar:",
      "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
      },
    },

    "searching": true,
    "pageLength": 10,
    "responsive": true,
    "processing": true,
    "info": true,
    "lengthChange": true,
    "paging": true,

    "columnDefs": [
      { "className": "dt-center", "targets": "_all" }
    ],

    ajax: {
      url: 'controller/controller.php?operador=listNomina',
      type: 'post'
    },
    columns: [
      { data: 'Nlista' },
      { data: 'nombre' },
      { data: 'mdia' },
      { data: 'faltantes' },
      { data: 'subtotal' },
      { data: 'prestamo' },
      { data: 'infonavit' },
      { data: 'total' },
      { data: 'pago' }
    ]
  });

}

const changeMDias = (idE) => {
  //  console.log($(`#input-mdays-${idE}`).val());

  if (parseFloat($(`#input-mdays-${idE}`).val()) < 0) {
    toastr["warning"]("No se puede ingresar dias negativos", "Dias invalidos");
    tableNomina.ajax.reload(null, false);
  } else {
    if ($(`#input-mdays-${idE}`).val() == '' || parseFloat($(`#input-mdays-${idE}`).val()) == 0) {
      toastr["warning"]("Campo vacio o igual a cero", "Campo invalido");
      tableNomina.ajax.reload(null, false);
    } else {
      parametros = {
        "idE": idE,
        "mdias": $(`#input-mdays-${idE}`).val()
      }
      $.ajax({
        data: parametros,
        type: 'POST',
        url: 'controller/controller.php?operador=updateMDias',
        beforeSend: function () { },
        success: function (response) {
          //console.log(response);
          switch (response) {

            case 'success':
              toastr["success"]("Se modificaron los medios dias con exito", "Dias modificados");
              tableNomina.ajax.reload(null, false);
              loadDatosNomina();
              break;

            case 'fail':
              toastr["error"]("No se pudo modificar", "Error inesperado");
              tableNomina.ajax.reload(null, false);
              loadDatosNomina();
              break;

            case 'limit':
              toastr["warning"]("No se puede ingresar mas de 12 dias", "Dias superados");
              tableNomina.ajax.reload(null, false);
              loadDatosNomina();
              break;
          }
        }
      });
    }
  }
}

const changePrestamo = (idE, subtotal) => {
  // console.log("entro" + idE + subtotal);
  // console.log($(`#input-prestamo-${idE}`).val());
  if (parseFloat($(`#input-prestamo-${idE}`).val()) >= parseFloat(subtotal) || parseFloat($(`#input-prestamo-${idE}`).val()) < 0) {
    toastr["warning"]("No se puede ingresar un monto negativo o mayor o igual al subtotal", "Monto invalido");
    tableNomina.ajax.reload(null, false);
  } else {
    if ($(`#input-prestamo-${idE}`).val() == '') {
      toastr["warning"]("Campo vacio", "Campo vacio");
      tableNomina.ajax.reload(null, false);
    } else {
      parametros = {
        "idE": idE,
        "prestamo": $(`#input-prestamo-${idE}`).val()
      }
      $.ajax({
        data: parametros,
        type: 'POST',
        url: 'controller/controller.php?operador=updatePrestamo',
        beforeSend: function () { },
        success: function (response) {
          //console.log(response);
          switch (response) {

            case 'success':
              toastr["success"]("Se modificó el prestamo con exito", "Prestamo modificado");
              tableNomina.ajax.reload(null, false);
              loadDatosNomina();
              break;

            case 'fail':
              toastr["error"]("No se pudo modificar medios dias", "Error inesperado");
              tableNomina.ajax.reload(null, false);
              loadDatosNomina();
              break;
          }
        }
      });
    }
  }
}

const changeInfonavit = (idE) => {

  if (parseFloat($(`#input-infonavit-${idE}`).val()) < 0) {
    toastr["warning"]("No se puede ingresar un monto negativo", "Monto invalido");
    tableNomina.ajax.reload(null, false);
  } else {
    if ($(`#input-infonavit-${idE}`).val() == '') {
      toastr["warning"]("Campo vacio", "Campo vacio");
      tableNomina.ajax.reload(null, false);
    } else {
      parametros = {
        "idE": idE,
        "infonavit": $(`#input-infonavit-${idE}`).val()
      }
      $.ajax({
        data: parametros,
        type: 'POST',
        url: 'controller/controller.php?operador=updateInfonavit',
        beforeSend: function () { },
        success: function (response) {
          //console.log(response);
          switch (response) {

            case 'success':
              toastr["success"]("Se modificó el infonavit con exito", "Infonavit modificado");
              tableNomina.ajax.reload(null, false);
              loadDatosNomina();
              break;

            case 'fail':
              toastr["error"]("No se pudo modificar infonavit", "Error inesperado");
              tableNomina.ajax.reload(null, false);
              loadDatosNomina();
              break;
          }
        }
      });
    }
  }
}

const changePago = (idE, pago) => {
  newPago = (pago == 'Aprobado') ? 'No hacer sobre' : 'Aprobado';
  parametros = {
    "idE": idE,
    "newPago": newPago
  }

  $.ajax({
    data: parametros,
    type: 'POST',
    url: 'controller/controller.php?operador=updatePago',
    beforeSend: function () { },
    success: function (response) {
      //console.log(response);
      switch (response) {

        case 'success':
          toastr["success"]("Se modificó el pago correctamente", "Pago modificadó");
          tableNomina.ajax.reload(null, false);
          loadDatosNomina();
          break;

        case 'fail':
          toastr["error"]("No se pudo modificar pago", "Error inesperado");
          tableNomina.ajax.reload(null, false);
          loadDatosNomina();
          break;
      }
    }
  });
}

function listNomina() {  
  const options = {
    method: 'POST'
  };
  return fetch('controller/controller.php?operador=getListEmployee', options)
    .then(res => res.json())
    .then(data => data);
}

function existEntryNomina(dateStart, dateEnd) {
  const data = new URLSearchParams(`dateStart=${dateStart}&dateEnd=${dateEnd}`);
  const options = {
    method: 'POST',
    body: data
  };
  return fetch('controller/controller.php?operador=existEntryNomina', options)
    .then(res => res.json())
    .then(data => data);
}


const askSaveNomina = async () => {
  if ($('#inputDateStart').val() == '' || $('#inputDateEnd').val() == '') {
    toastr["warning"]("Elige un rango de fechas para guardar la nomina", "Elige un rango de fechas");
  } else {
    const res = await listNomina();

    if (res == 'empty') {
      Swal.fire(
        '¡No hay empleados!',
        'Debe de haber empleados en esta nómina para poder guardarla',
        'warning'
      );
    } else {
      Swal.fire({
        title: '¿Estás seguro de guardar la nómina?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, guarda nómina',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          saveNomina();
        }
      });
    }
  }
}

const saveNomina = async () => {
  const exist = await existEntryNomina($('#inputDateStart').val(), $('#inputDateEnd').val());
  //console.log(exist);
  if (exist != 'empty') {
    Swal.fire({
      title: 'Nomina ya existente',
      text: "Ya existe una nómina guardada con las misma fecha. ¿Deseas sobrescribir los datos?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#198754',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, sobrescribir',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        overwriteNoimina(exist[0].id);
      }
    });
  } else {
    const result = await listNomina();
    var totalBruto = 0;
    var totalFaltantes = 0;
    var subtotal = 0;
    var totalPrestamo = 0;
    var totalInfonavit = 0;
    var totalNeto = 0;
    var totalNoAprobados = 0;
    //Math.round(13.89)    
    //console.log(result);
    result.forEach(ele => {

      totalBruto += parseFloat(ele.sueldo);
      totalFaltantes += parseFloat(ele.faltantes);
      subtotal += parseFloat(ele.subtotal);
      totalPrestamo += parseFloat(ele.prestamo);
      totalInfonavit += parseFloat(ele.infonavit);

      if (ele.pago == 'Aprobado') {
        totalNeto += parseFloat(ele.total);
      } else {
        totalNoAprobados += parseFloat(ele.total);
      }
    });

    parametros = {
      "dateStart": $('#inputDateStart').val(),
      "dateEnd": $('#inputDateEnd').val(),
      'empleados': result.length,
      'totalBruto': totalBruto,
      'totalFaltantes': totalFaltantes.toFixed(2),
      'subtotal': subtotal.toFixed(2),
      'totalInfonavit': totalInfonavit,
      'totalPrestamo': totalPrestamo,
      'totalNoAprobados': totalNoAprobados.toFixed(2),
      'totalNeto': totalNeto.toFixed(2),
    }

    $.ajax({
      data: parametros,
      type: 'POST',
      url: 'controller/controller.php?operador=saveNomina',
      beforeSend: function () { },
      success: function (response) {
        //console.log(response);
        switch (response) {

          case 'success':

            Swal.fire(
              'Guardada',
              'Nómina guardada exitosamente',
              'success'
            );
            tableNomina.ajax.reload(null, false);
            loadDatosNomina();
            break;

          case 'fail':
            Swal.fire(
              '¡Error al guardar!',
              'No se pudo guardar la nómina, intentelo mas tarde',
              'error'
            );
            tableNomina.ajax.reload(null, false);
            loadDatosNomina();
            break;
        }
      }
    });
  }
}

const parseDate = (date) => {
  var strDate = date.split('-');
  return strDate[2] + "-" + strDate[1] + "-" + strDate[0];
}

const printNomina = async () => {
  if ($('#inputDateStart').val() == '' || $('#inputDateEnd').val() == '') {
    toastr["warning"]("Elige un rango de fechas para imprimir la nomina", "Elige un rango de fechas");
  } else {
    const res = await listNomina(typeTable);

    if (res == 'empty') {
      Swal.fire(
        '¡No hay empleados!',
        'Debe de haber empleados en esta nómina para poder imprimirla',
        'warning'
      );
    } else {  
      window.location.href = `formats/imprimirNominaPDF.php?dateStart=${parseDate($('#inputDateStart').val())}&dateEnd=${parseDate($('#inputDateEnd').val())}`;
    }
  }

}

const overwriteNoimina = async (id) => {
  const result = await listNomina();
  var totalBruto = 0;
  var totalFaltantes = 0;
  var subtotal = 0;
  var totalPrestamo = 0;
  var totalInfonavit = 0;
  var totalNeto = 0;
  var totalNoAprobados = 0;
  //Math.round(13.89)    
  //console.log(result);
  result.forEach(ele => {

    totalBruto += parseFloat(ele.sueldo);
    totalFaltantes += parseFloat(ele.faltantes);
    subtotal += parseFloat(ele.subtotal);
    totalPrestamo += parseFloat(ele.prestamo);
    totalInfonavit += parseFloat(ele.infonavit);

    if (ele.pago == 'Aprobado') {
      totalNeto += parseFloat(ele.total);
    } else {
      totalNoAprobados += parseFloat(ele.total);
    }
  });

  parametros = {
    "id": id,
    'empleados': result.length,
    'totalBruto': totalBruto,
    'totalFaltantes': totalFaltantes.toFixed(2),
    'subtotal': subtotal.toFixed(2),
    'totalInfonavit': totalInfonavit,
    'totalPrestamo': totalPrestamo,
    'totalNoAprobados': totalNoAprobados.toFixed(2),
    'totalNeto': totalNeto.toFixed(2)
  }

  $.ajax({
    data: parametros,
    type: 'POST',
    url: 'controller/controller.php?operador=overwriteNoimina',
    beforeSend: function () { },
    success: function (response) {
      //console.log(response);
      switch (response) {

        case 'success':

          Swal.fire(
            'Guardada',
            'Se sobrescribió exitosamente',
            'success'
          );
          tableNomina.ajax.reload(null, false);
          loadDatosNomina();
          break;

        case 'fail':
          Swal.fire(
            '¡Error al guardar!',
            'No se pudo sobrescribir la nómina, intentelo mas tarde',
            'error'
          );
          tableNomina.ajax.reload(null, false);
          loadDatosNomina();
          break;
      }
    }
  });
}

const showRecordNomina = () => {

  $('#modalRecordNomina').modal('show');
  document.getElementById('title_modal_record').innerHTML = `Historial de nóminas`;
  $("#tableRecordNomina").dataTable().fnDestroy();  

  tableRecordNomina = $('#tableRecordNomina').DataTable({
    language: {
      "lengthMenu": "Mostrar _MENU_ filas por página",
      "zeroRecords": "No hay elementos que coincidan",
      "info": "Mostrando página _PAGE_ de _PAGES_",
      "infoEmpty": "Mostrando 0 a 0 de 0 filas",
      "infoFiltered": "(filtradas de _MAX_ filas totales)",
      "search": "Buscar:",
      "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
      },
    },

    "searching": true,
    "pageLength": 5,
    "responsive": true,
    "processing": true,
    "info": true,
    "lengthChange": true,
    "paging": true,

    "columnDefs": [
      { "className": "dt-center", "targets": "_all" }
    ],

    ajax: {
      url: 'controller/controller.php?operador=listRecordNomina',
      type: 'post'
    },
    columns: [
      { data: 'finicio' },
      { data: 'ffinal' },
      { data: 'empleados' },
      { data: 'tbruto' },
      { data: 'tfaltante' },
      { data: 'subtotal' },
      { data: 'infonavit' },
      { data: 'prestamos' },
      { data: 'tnoaprobados' },
      { data: 'tneto' }
    ]
  });
}

const showModalFechasHistorial = () => {
  $('#modalFechasHistorial').modal('show');
  if (document.getElementById('checkHistorialTodo').checked) {
    $("#inputDateStartRecord").prop("disabled", true);
    $("#inputDateEndRecord").prop("disabled", true);
  } else {
    $("#inputDateStartRecord").prop("disabled", false);
    $("#inputDateEndRecord").prop("disabled", false);
  }
}

const printRecordNomina = () => {
  if (document.getElementById('checkHistorialTodo').checked) {
    window.location.href = `formats/ImprimirHistorialNominaPDF.php`;
  } else {
    if ($('#inputDateStartRecord').val() == '' || $('#inputDateEndRecord').val() == '') {
      toastr['warning']("Elige un rango de fechas para imprimir la nomina", "Elige un rango de fechas");
    } else {
      window.location.href = `formats/ImprimirHistorialNominaPDF.php?dateStart=${$('#inputDateStartRecord').val()}&dateEnd=${$('#inputDateEndRecord').val()}`;
    }
  }
}


$('#checkHistorialTodo').click(function () {
  //console.log('click event, checkbox is checked ? ', this.checked);
  if (this.checked) {
    //alert('chekeado');
    $("#inputDateStartRecord").prop("disabled", true);
    $("#inputDateEndRecord").prop("disabled", true);
  } else {
    //alert('no check');
    $("#inputDateStartRecord").prop("disabled", false);
    $("#inputDateEndRecord").prop("disabled", false);
  }
});








