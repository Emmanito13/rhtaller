const login = async () => {
    const resp = await getLogin($('#user').val(), $('#pass').val());
    console.log(resp);
    if (resp == 'requerid') {
        M.toast({ html: "Verifique que los campos esten llenos", classes: "rounded yellow darken-4" });
    } else {
        if (resp == 'empty') {
            M.toast({ html: "Usuario y/o contrasela incorrectos", classes: "rounded red darken-4" });
        } else {
            window.location.href = 'indexMenu.php';
        }
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