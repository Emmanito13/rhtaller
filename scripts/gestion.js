init();
function init(){
    loadTableGestion();
}

function loadTableGestion () {

    tableGestion = $('#tableGestion').DataTable({
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
          url: 'controller/controllerGestion.php?operador=listUsers',          
          type: 'post'
        },
        columns: [
          { data: 'nombre' },
          { data: 'apellidos' },
          { data: 'username' },
          { data: 'rol' },
          { data: 'editar' },
          { data: 'pass' },
          { data: 'eliminar' }          
        ]
      });
}

const formAddUser = () => {
    let form = $('#form-user').empty();
    let btn =  $('#btn').empty();
    let modal = document.getElementById('modal');
    let modalHeader = document.getElementById('modalHeader');
    let btnClose = document.getElementById('btnClose');
    modalHeader.className = '';
    modalHeader.classList.add('modal-header','bg-danger','text-white');   
    modal.className = '';
    modal.classList.add('modal-dialog','modal-md');
    btnClose.className = "";
    btnClose.classList.add('btn-close','btn-close-bg');
    document.getElementById('titulo_modal').innerHTML='Agregar usuario';    
    $('#modalgestionuser').modal('show');
    form.append(`
                <div class="row justifiy-content-start mb-3">
                    <div class="col text-start">
                        <label for="inputNombre" class="form-label fw-bold">Nombre(s):</label>
                        <input type="text" class="form-control" id="inputNombre" name="inputNombre">                        
                    </div>
                </div>
                <div class="row justifiy-content-start mb-3">
                    <div class="col text-start">
                        <label for="inputApellido" class="form-label fw-bold">Apellidos:</label>
                        <input type="text" class="form-control" id="inputApellido" name="inputApellido">                        
                    </div>
                </div>
                <div class="row justifiy-content-start mb-3">
                    <div class="col text-start">
                        <label for="inputUsername" class="form-label fw-bold">Nombre de usuario:</label>
                        <input type="text" class="form-control" id="inputUserName" name="inputUserName">
                    </div>
                </div>
                <div class="row justifiy-content-start mb-3">
                    <div class="col text-start">
                        <label for="inputRol" class="form-label fw-bold">Rol:</label>
                        <select class="form-select" id="inputRol" name="inputRol"> 
                            <option selected>Elige un rol</option>
                            <option value="SUPERADMIN">SUPERADMIN</option>
                            <option value="ADMIN">ADMIN</option>
                        </select>
                    </div>
                </div>
                <div class="row justifiy-content-start mb-2">
                    <div class="row justifiy-content-start">
                        <div class="col text-start">
                            <label for="inputPass1" class="form-label fw-bold">Contraseña:</label>
                        </div>
                    </div>
                    <div class="col text-start">                        
                        <input type="password" placeholder="Ingrese una contraseña" class="form-control" id="inputPass1" name="inputPass1">
                    </div>
                    <div class="col-auto text-center p-2">                        
                        <img id="viewPass1" class="viewPass" src="pictures/ver.png">
                    </div>
                </div>
                <div class="row justifiy-content-start mb-3">
                    <div class="col text-start">                        
                        <input type="password" placeholder="Ingrese nuevamente la contraseña" class="form-control" id="inputPass2" name="inputPass2">                        
                    </div>
                    <div class="col-auto text-center p-2">                        
                        <img id="viewPass2" class="viewPass" src="pictures/ver.png">
                    </div>
                </div>                
                `);    
    btn.append(`<button type="button" class="btn btn-success" onclick='registerUser()'>Agregar</button>`);
    document.getElementById('viewPass1').onmousedown = function(){        
        document.getElementById('inputPass1').type = 'text';
    };

    document.getElementById('viewPass1').onmouseup = function(){        
        document.getElementById('inputPass1').type = 'password';
    };

    document.getElementById('viewPass2').onmousedown = function(){ 
        document.getElementById('inputPass2').type = 'text';
    };

    document.getElementById('viewPass2').onmouseup = function(){
        document.getElementById('inputPass2').type = 'password';
    };      
}

const formEditUser = async (id) => {
    const response = await getUser(id);
    const user = response[0];
    //console.log(user);
    let form = $('#form-user').empty();
    let btn =  $('#btn').empty();
    let modal = document.getElementById('modal');
    let modalHeader = document.getElementById('modalHeader');
    let btnClose = document.getElementById('btnClose');
    modalHeader.className = '';
    modalHeader.classList.add('modal-header','bg-warning');
    modal.className = '';
    modal.classList.add('modal-dialog','modal-md');
    btnClose.className = "";
    btnClose.classList.add('btn-close','btn-close-bg');
    document.getElementById('titulo_modal').innerHTML='Editar usuario';
    $('#modalgestionuser').modal('show');
    form.append(`
                <div class="row justifiy-content-start mb-3">
                    <div class="col text-start">
                        <label for="inputNombre" class="form-label fw-bold">Nombre(s):</label>
                        <input type="text" class="form-control" id="inputNombre" name="inputNombre">                        
                    </div>
                </div>
                <div class="row justifiy-content-start mb-3">
                    <div class="col text-start">
                        <label for="inputApellido" class="form-label fw-bold">Apellidos:</label>
                        <input type="text" class="form-control" id="inputApellido" name="inputApellido">                        
                    </div>
                </div>
                <div class="row justifiy-content-start mb-3">
                    <div class="col text-start">
                        <label for="inputUsername" class="form-label fw-bold">Nombre de usuario:</label>
                        <input type="text" class="form-control" id="inputUserName" name="inputUserName">
                    </div>
                </div>
                <div class="row justifiy-content-start mb-3">
                    <div class="col text-start">
                        <label for="inputRol" class="form-label fw-bold">Rol:</label>
                        <select class="form-select" id="inputRol" name="inputRol"> 
                            <option value="SUPERADMIN">SUPERADMIN</option>
                            <option value="ADMIN">ADMIN</option>
                        </select>
                    </div>
                </div>`);
    btn.append(`<button type="button" class="btn btn-success" onclick='editUser(${id})'>Guardar</button>`);
    $('#inputNombre').val(user.name);
    $('#inputApellido').val(user.lastname);
    $('#inputUserName').val(user.username);
    document.getElementById('inputRol').value = user.rol
}

const formChangeUser = async (id) => {    
    let form = $('#form-user').empty();
    let btn =  $('#btn').empty();
    let modal = document.getElementById('modal');
    let modalHeader = document.getElementById('modalHeader');
    let btnClose = document.getElementById('btnClose');    
    const response = await getUser(id);
    const user = response[0];
    modalHeader.className = '';
    modalHeader.classList.add('modal-header','bg-dark','text-white');
    modal.className = '';
    modal.classList.add('modal-dialog','modal-md');
    btnClose.className = "";
    btnClose.classList.add('btn-close','btn-close-bg');
    document.getElementById('titulo_modal').innerHTML=`Cambiar contraseña a "${user.name} ${user.lastname}"`;
    $('#modalgestionuser').modal('show');
    form.append(`
                <div class="row justifiy-content-start mb-2">
                    <div class="col text-start">                        
                        <input type="password" placeholder="Ingrese nueva contraseña" class="form-control" id="inputPass1" name="inputPass1">
                    </div>
                    <div class="col-auto text-center p-2">                        
                        <img id="viewPass1" class="viewPass" src="pictures/ver.png">
                    </div>
                </div>
                <div class="row justifiy-content-start mb-3">
                    <div class="col text-start">                        
                        <input type="password" placeholder="Ingrese nuevamente la contraseña" class="form-control" id="inputPass2" name="inputPass2">
                        <div id="messageSamePass" class="form-text">La contraseña debe ser distinta a la que ya esta registrada</div>
                    </div>
                    <div class="col-auto text-center p-2">                        
                        <img id="viewPass2" class="viewPass" src="pictures/ver.png">
                    </div>
                </div>`);
    $('#messageSamePass').hide();
    btn.append(`<button type="button" class="btn btn-success" onclick='changePasstUser(${id})'>Guardar</button>`);

    document.getElementById('inputPass1').addEventListener('click', function(e){
        e.preventDefault()        
        $('#messageSamePass').hide();
    },false);

    document.getElementById('inputPass2').addEventListener('click', function(e){
        e.preventDefault()        
        $('#messageSamePass').hide();
    },false);

    document.getElementById('viewPass1').onmousedown = function(){        
        document.getElementById('inputPass1').type = 'text';
    };

    document.getElementById('viewPass1').onmouseup = function(){        
        document.getElementById('inputPass1').type = 'password';
    };

    document.getElementById('viewPass2').onmousedown = function(){        
        document.getElementById('inputPass2').type = 'text';
    };

    document.getElementById('viewPass2').onmouseup = function(){
        document.getElementById('inputPass2').type = 'password';
    };
}

const askDeleteUser = async (id) => {
    const response = await getUser(id);
    const user = response[0];
    Swal.fire({
        title: '¿Estás seguro de eliminar este usuario?',
        html: `
                <div class="row justify-content-center">
                    <div class="col-auto text-center">
                        <label class="fw-bold">Nombre(s):</label>
                    </div>
                    <div class="col-auto text-center">
                        <label class="fw-normal">${user.name}</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-auto text-center">
                        <label class="fw-bold">Apellidos:</label>
                    </div>
                    <div class="col-auto text-center">
                        <label class="fw-normal">${user.lastname}</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-auto text-center">
                        <label class="fw-bold">Nombre usuario:</label>
                    </div>
                    <div class="col-auto text-center">
                        <label class="fw-normal">${user.username}</label>
                    </div>
                </div>            
                <div class="row justify-content-center">
                    <div class="col-auto text-center">
                        <label class="fw-bold">Rol:</label>
                    </div>
                    <div class="col-auto text-center">
                        <label class="fw-normal">${user.rol}</label>
                    </div>
                </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminalo',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            deleteUser(id);           
        }
      });
}

const registerUser = () => {

    const data = new FormData(document.getElementById('form-user'));
    const options = {
        method: 'POST',
        body: data
    };

    fetch('controller/controllerGestion.php?operador=registerUser', options)
      .then(res => res.text())
      .then(data => {
        //console.log(data);
        switch (data){
            case 'success':
                $('#modalgestionuser').modal('hide');
                tableGestion.ajax.reload(null, false);
                toastr["success"]("Se agregó el usuario exitosamente", "Usuario registradó");
                break;
                
            case 'error':
                toastr["error"]("No se pudo registrar el usuario, intentelo mas tarde", "Error inesperado");
                break;

            case 'requerid':
                toastr["warning"]("Llene todos los campos", "Campos vacios");
                break;
            
            case 'nosamepass':
                toastr["warning"]("Las contraseñas no coinciden, verifique sus contraseñas", "Contraseñas diferentes");
                break;

        }
      })
      .catch(err =>{
        Swal.fire(
            'Error',
            err,
            'error'
          );        
      });
}

function getUser(id) {
    const data = new URLSearchParams(`id=${id}`);
    const options = {
      method: 'POST',
      body: data
    };
    return fetch('controller/controllerGestion.php?operador=getUser', options)
      .then(res => res.json())
      .then(data => data);
}

const editUser = (id) => {

    const data = new FormData(document.getElementById('form-user'));
    data.append('id',id);
    const options = {
        method: 'POST',
        body: data
    };

    fetch('controller/controllerGestion.php?operador=editUser', options)
      .then(res => res.text())
      .then(data => {
        //console.log(data);
        switch (data){
            case 'success':
                $('#modalgestionuser').modal('hide');
                tableGestion.ajax.reload(null, false);
                toastr["success"]("Se actializo el usuario exitosamente", "Usuario actualizado");
                break;
                
            case 'error':
                toastr["error"]("No se pudo actualizar el usuario, intentelo mas tarde", "Error inesperado");
                break;

            case 'requerid':
                toastr["warning"]("Llene todos los campos", "Campos vacios");
                break;
        }
      })
      .catch(err =>{
        Swal.fire(
            'Error',
            err,
            'error'
          );        
      });
}

const changePasstUser = (id) => {    
    const data = new FormData(document.getElementById('form-user'));
    data.append('id',id);
    const options = {
        method: 'POST',
        body: data
    };

    fetch('controller/controllerGestion.php?operador=changePassUser', options)
      .then(res => res.text())
      .then(data => {
        //console.log(data);
        switch (data){
            case 'success':
                $('#modalgestionuser').modal('hide');
                tableGestion.ajax.reload(null, false);
                toastr["success"]("Se actializo la contraseña exitosamente", "Contraseña actualizada");
                break;
                
            case 'error':
                toastr["error"]("No se pudo actualizar la contraseña, intentelo mas tarde", "Error inesperado");
                break;

            case 'requerid':
                toastr["warning"]("Ingrese una contraseña", "Campos vacios");
                break;
            
            case 'oldpass':
                $('#messageSamePass').show();
                break;
            
            case 'nosamepass':
                toastr["warning"]("Las contraseñas no coinciden, verifique sus contraseñas", "Contraseñas diferentes");
                break;
        }
      })
      .catch(err =>{
        Swal.fire(
            'Error',
            err,
            'error'
          );       
      });
    
}

const deleteUser = (id) => {
    const data = new URLSearchParams(`id=${id}`);    
    const options = {
        method: 'POST',
        body: data
    };

    fetch('controller/controllerGestion.php?operador=deleteUser', options)
      .then(res => res.text())
      .then(data => {
        //console.log(data);
        switch (data){
            case 'success':
                $('#modalgestionuser').modal('hide');
                tableGestion.ajax.reload(null, false);
                 Swal.fire(
                'Eliminado',
                'Se eliminó el usuario exitosamente',
                'success'
                );                
                break;
                
            case 'error':                
                tableGestion.ajax.reload(null, false);
                Swal.fire(
                    'Error',
                    'No se pudo eliminar este usuario, intentelo mas tarde',
                    'error'
                    );
                break;       
        }
      })
      .catch(err =>{
        Swal.fire(
            'Error',
            err,
            'error'
          );       
      });
}

