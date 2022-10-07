F_CargarDepartamentos = ()=>{
    var selectDep = document.querySelector("#reg-departamento");
    var selectProv = document.querySelector("#reg-provincia");

    selectDep.onchange = ()=>{
        document.querySelector("#reg-distrito").innerHTML = "<option value='' selected didabled>Selecciona un distrito</option>";
        var codDepartamento = selectDep.value;

        const data = new URLSearchParams("codDepartamento=" + codDepartamento);
        
        fetch('controller/UsuarioController.php', {
            method: 'POST',
            body: data
        })
        .then(function(response) {
            // ACA SE CONTROLA SI SE ENVIA EL AJAX
            if(response.ok) {
                return response.text();
            } else {
                throw "Error en la llamada Ajax";
            }
        })
        .then(function(texto) {
            // ACA SE IMPRIME LA RESPUESTA QUE VIENE DEL SERVIDOR
            document.querySelector("#reg-provincia").innerHTML = texto;
        })
        .catch(function(err) {
            // SI OCURRE UN ERROR CON EL ENVIO
            console.log(err);
        });
    }
    
    selectProv.onchange = ()=>{
        var codProvincia = selectProv.value;

        const data = new URLSearchParams("codProvincia=" + codProvincia);
        
        fetch('controller/UsuarioController.php', {
            method: 'POST',
            body: data
        })
        .then(function(response) {
            // ACA SE CONTROLA SI SE ENVIA EL AJAX
            if(response.ok) {
                return response.text();
            } else {
                throw "Error en la llamada Ajax";
            }
        })
        .then(function(texto) {
            // ACA SE IMPRIME LA RESPUESTA QUE VIENE DEL SERVIDOR
            document.querySelector("#reg-distrito").innerHTML = texto;
        })
        .catch(function(err) {
            // SI OCURRE UN ERROR CON EL ENVIO
            console.log(err);
        });
    }
}

// F_Registrar = ()=>{
//     var formularioregister = document.querySelector("#form-reg-usuario");

//     formularioregister.onsubmit = (e)=>{
//         e.preventDefault();
//         // console.log("submit xd");
//         const data = new FormData(formularioregister);
//         data.append("tipo", "registrar");

//         console.log("Enviando");
//         console.log(formularioregister);

        // fetch(
        //     'controller/UsuarioController.php', 
        //     { method: 'POST', body: data }
        // )
        // .then(function(response) {
        //     if(response.ok) {
        //         return response.text();
        //     } else {
        //         throw "Error en la llamada Ajax";
        //     }
        // })
        // .then(function(texto) {
        //     if(texto == "login-success"){
        //         location.href = "http://localhost/elitesac/index.php";
        //     }

        //     // if(texto == "login-empty"){
        //     //     location.href = "http://localhost/elitesac/pages/IniciarSesion.php";
        //     // }

        //     // if(texto == "login-failed"){
        //     //     location.href = "http://localhost/elitesac/pages/IniciarSesion.php";
        //     // }
        // })
        // .catch(function(err) {
        //     console.log(err);
        // });
    // }

    showPassword = ()=>{
        var checkShow = document.querySelector("#checkShowPasswordUsuario");

        checkShow.onclick = ()=>{
            if(checkShow.checked){
                document.querySelector("#reg-clave").type = "text";
                document.querySelector("#reg-confirmar-cave").type = "text";
            }else{
                document.querySelector("#reg-clave").type = "password";
                document.querySelector("#reg-confirmar-cave").type = "password";
        }
        }
        
        
    }
    showPassword();
// }

window.onload = ()=>{
    F_CargarDepartamentos();
    // F_Registrar();
}