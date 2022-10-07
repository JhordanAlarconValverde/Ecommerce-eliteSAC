F_IniciarSesion = ()=>{
    
    var formulariologin = document.querySelector("#form-login-usuario");
    var btnshowPswUsuario = document.querySelector("#btn-show-password-Usuario");
// let usuario = formulariologin['txt-login-user-Usuario'].value;
        // let password = formulariologin['txt-login-password-Usuario'].value;
        // console.log(usuario + password);
    // console.log(btnLoginUsuario);
    formulariologin.onsubmit = (e)=>{
        e.preventDefault();
        //Forma 1
        const data = new FormData(formulariologin);

        // // Forma2
        // const data = new URLSearchParams("usuario=" + usuario + "&clave=" + password);
        // // Variables que le podemos agregar
        data.append('iniciarSesion', "iniciarSesion");
        // // data.append('clave', password);
        fetch('controller/UsuarioController.php', {
            method: 'POST',
            body: data
        })
        .then(function(response) {
            if(response.ok) {
                return response.text()
            } else {
                throw "Error en la llamada Ajax";
            }
        })
        .then(function(texto) {
            let inputUser = document.querySelector("#txt-login-user-Usuario");
            let innerUser = document.querySelector("#form-validate-login");
            let inputClave = document.querySelector("#txt-login-password-Usuario");
            let innerClave = document.querySelector("#form-validate-clave");
            if(texto == "login-success"){
                location.href = "http://localhost/elitesac/index.php";
            }

            // if(texto == "login-user-empty"){
            //     inputUser.classList.add('border-danger');
            //     innerUser.classList.add("text-danger");
            //     innerUser.classList.add("ps-4");
            //     innerUser.innerHTML = "*Completa este campo";
                // inputClave.classList.add('border-danger');
                // innerClave.classList.add("text-danger");
                // innerClave.classList.add("ps-4");
                // innerClave.innerHTML = "*Completa este campo";
                // location.href = "http://localhost/elitesac/pages/IniciarSesion.php";
            // }
            sessionStorage.num_intentos = 0
            if(texto == "login-failed"){;
                inputUser.classList.add('border-danger');
                innerUser.classList.add("text-danger");
                innerUser.classList.add("ps-4");
                innerUser.innerHTML = "*Usuario o clave incorrectas";
                let num = sessionStorage.num_intentos;
                num++;
                sessionStorage.num_intentos = num;
                console.log(sessionStorage.num_intentos);
            }
            

            
            // console.log(texto);
            // if(texto == "error"){
            //     console.log("Error");
            //     Swal.fire({
            //         icon: 'error',
            //         // title: 'Oops...',
            //         text: 'Los datos no estan registrados',
            //         // showCancelButton: true,
            //         // cancelButtonText: 'Cancelar',
            //         showConfirmButton: false,
            //         // confirmButtonColor: 'red',
            //         focusConfirm: false
            //       })
            // }
            
        })
        .catch(function(err) {
            console.log(err);
        });
    }
    
    btnshowPswUsuario.onclick = ()=>{
        let condicion = btnshowPswUsuario.children[0].className;
        let passwrod = document.querySelector('#txt-login-password-Usuario');
        if(condicion == "fa-solid fa-eye-slash text-muted"){
            passwrod.type = "text";
            btnshowPswUsuario.innerHTML = "<i class='fa-solid fa-eye text-muted'></i>";
        }else{
            passwrod.type = "password";
            btnshowPswUsuario.innerHTML = "<i class='fa-solid fa-eye-slash text-muted'></i>";
        }
    }

}



window.onload = ()=>{
    F_IniciarSesion();
}
    

// btnLoginUsuario.onclick = (e)=>{
//     e.preventDefault();
//     let formulariologin = document.querySelector("#form-login-usuario");
//     let usuario = formulariologin['txt-login-user-Usuario'].value;
//     let password = formulariologin['txt-login-password-Usuario'].value;
//     let datos_login_usuario = [
//         {
//             "Usuario": usuario,
//             "Password": password
//         }
//     ]
//     console.log(JSON.stringify(datos_login_usuario));
// }

// btnshowPswUsuario.onclick = ()=>{
//     let condicion = btnshowPswUsuario.children[0].className;
//     let passwrod = document.querySelector('#txt-login-password-Usuario');
//     if(condicion == "fa-solid fa-eye-slash text-muted"){
//         passwrod.type = "text";
//         btnshowPswUsuario.innerHTML = "<i class='fa-solid fa-eye text-muted'></i>";
//     }else{
//         passwrod.type = "password";
//         btnshowPswUsuario.innerHTML = "<i class='fa-solid fa-eye-slash text-muted'></i>";
//     }
    
// }