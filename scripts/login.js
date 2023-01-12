const login = async () => {
    const resp = await getLogin($('#user').val(),$('#pass').val());    
    switch(resp){
        case 'successs':   
            window.location.href = 'indexMenu.php';
            break;
        case 'fail':
            M.toast({html: "Usuario y/o contrasela incorrectos", classes: "rounded red darken-4"});
            //toastr["error"]("Usuario y/o contrasela incorrectos", "Datos incorrectos");           
            break;
        case 'error':
            M.toast({html: "No hay conexion a internet, o servidores en mantenimiento. Vuelve a intentarlo mas tarde", classes: "rounded red darken-4"});
            //toastr["error"]("No hay conexion a internet, o servidores en mantenimiento. Vuelve a intentarlo mas tarde.", "Error inesperado");
            break;
        case 'requerid':
            M.toast({html: "Verifique que los campos esten llenos", classes: "rounded yellow darken-4"});
            //toastr["warning"]("Verifique que los campos esten llenos", "Campos vacios");
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