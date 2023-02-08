init();

function init() {
  toastr.options = {
    "closeButton": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
  }
  loadTableContratos();
}


function loadTableContratos() {

  tableContratos = $('#tableContratos').DataTable({
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
      url: 'controller/controllerContratos.php?opc=listUsersContracts',
      type: 'post'
    },
    columns: [
      { data: 'Nlista' },
      { data: 'name' },
      { data: 'Fingreso' },
      { data: 'duracion' },
      { data: 'diast' },
      { data: 'diasp' },
      { data: 'cambiar' },
      { data: 'documentos' }
    ]
  });

}

const renewContract = (idE, duracion) => {
  let newDuracion;
  switch (duracion) {
    case 90:
      newDuracion = 180;
      break;

    case 180:
      newDuracion = 'PLANTA'
      break;
  }

  const data = new URLSearchParams(`idE=${idE}&duracion=${newDuracion}`);
      const options = {
        method: 'POST',
        body: data
      };

      fetch('controller/controllerContratos.php?opc=updateContract', options)
        .then(res => res.text())
        .then(data => {
          //console.log(data);
          switch (data) {

            case 'success':      
              tableContratos.ajax.reload(null, false);
              toastr["success"]("Se renovó el contrato exitosamente", "Contrato renovado");
              break;

            case 'error':
              toastr["error"]("No se pudo renovar el contrato, intentelo mas tarde", "Error inesperado");
              break;
          }
        })
        .catch(err => {
          Swal.fire(
            'Error',
            err,
            'error'
          );
        });

}

const documentsDelivered = async (id) => {
  const res = await getDocumentsById(id);
  //console.log(res);
  $('#modalDocumentos').modal('show');

  $('#id').val(id);

  if (res[0].CR1 == 1) {
    document.getElementById('checkCarta1').checked = true;
  }else{
    document.getElementById('checkCarta1').checked = false;
  }
  if (res[0].CR2 == 1) {
    document.getElementById('checkCarta2').checked = true;
  }else{
    document.getElementById('checkCarta2').checked = false;
  }
  if (res[0].NoAImss == 1) {
    document.getElementById('checkImss').checked = true;
  }else{
    document.getElementById('checkImss').checked = false;
  }
  if (res[0].actaN == 1) {
    document.getElementById('checkActa').checked = true;
  }else{
    document.getElementById('checkActa').checked = false;
  }
  if (res[0].cANP == 1) {
    document.getElementById('checkANP').checked = true;
  }else{
    document.getElementById('checkANP').checked = false;
  }
  if (res[0].comprobanteD == 1) {
    document.getElementById('checkDomicilio').checked = true;
  }else{
    document.getElementById('checkDomicilio').checked = false;
  }
  if (res[0].comprobanteE == 1) {
    document.getElementById('checkEstudios').checked = true;
  }else{
    document.getElementById('checkEstudios').checked = false;
  }
  if (res[0].credencialE == 1) {
    document.getElementById('checkElector').checked = true;
  }else{
    document.getElementById('checkElector').checked = false;
  }
  if (res[0].curp == 1) {
    document.getElementById('checkCurp').checked = true;
  }else{
    document.getElementById('checkCurp').checked = false;
  }
  if (res[0].solicitudE == 1) {
    document.getElementById('checkEmpleo').checked = true;
  }else{
    document.getElementById('checkEmpleo').checked = false;
  }
}

function getDocumentsById(id) {
  const data = new URLSearchParams(`id=${id}`);
  const options = {
    method: 'POST',
    body: data
  };
  return fetch('controller/controllerContratos.php?opc=getDocumentsById', options)
    .then(res => res.json())
    .then(data => data);
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
            toastr["success"]("Se actualizaron los documentos exitosamente", "Documentos actualizados");              
          } else {
            toastr["error"]("No se pudo actualizar los documentos, vuelva a intentarlo mas tarde", "Error inesperado");
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