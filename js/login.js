toastr.options = {
    "closeButton": true,
    "positionClass": "toast-top-rigth",
    "preventDuplicates": false,
}

const login = async () => {
    const resp = await getLogin($('#user').val(),$('#pass').val());    
    switch(resp){
        case 'successs':
            window.location.href = 'views/indexMenu.php';
            break;
        case 'fail':
            toastr["error"]("Usuario y/o contrasela incorrectos", "Datos incorrectos");                    
            break;
        case 'error':            
        toastr["error"]("No hay conexion a internet, o servidores en mantenimiento. Vuelve a intentarlo mas tarde.", "Error inesperado");
            break;
        case 'requerid':
            toastr["warning"]("Verifique que los campos esten llenos", "Campos vacios");
            break;
    }
}

function getLogin(user, pass) {
    const data = new URLSearchParams(`user=${user}&pass=${pass}`);
    const options = {
      method: 'POST',
      body: data
    };
    return fetch('controller/controllerLogin.php', options)
      .then(res => res.json())
      .then(data => data);
}