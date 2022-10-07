function_cambiarFoto = ()=>{
    const input = document.querySelector('#fileMicuenta');
    const foto = document.querySelector("#fotoMicuenta");

    input.style.opacity = 0;
    input.addEventListener('change', ()=>{
        const curFiles = input.files;
        if (curFiles.length != 0) {
            for (const file of curFiles) {
                var reader = new FileReader();
                reader.addEventListener("load", (event) => {
                    foto.src = event.target.result;
                });
                reader.readAsDataURL(file);
            }
        }
    })
}

function_guardarDatos = ()=>{
    var mcFormulario = document.forms['mc-formulario'];

    mcFormulario.onsubmit = (e)=>{
        e.preventDefault();
    
        const data = new FormData(mcFormulario);
        data.append("actualizar-usuario", "actualizar-usuario");

        fetch('http://localhost/elitesac/pages/controller/UsuarioController.php' , {
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
            // console.log(texto);
            let rpta = JSON.parse(texto);
            if(rpta[0] == 'update-success'){
                
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Los datos se actualizaron correctamente',
                    showConfirmButton: false,
                    timer: 1500
                })

                setTimeout(() => {
                    location.href = "http://localhost/elitesac/pages/view/MiCuenta/MiCuenta.php";
                }, 1500);
            }
            if(rpta[0] == 'update-failed'){
                Swal.fire({
                    icon: 'error',
                    text: 'No se pudieron actualizar los datos'
                  })
            }
            if(rpta[0] == 'update-exists'){
                document.querySelector("#mc-validar-usuario").textContent = "El nombre de usuario ya existe";
            }
        })
        .catch(function(err) {
            console.log(err);
        });
        
    }
}

window.onload = ()=>{
    function_cambiarFoto();
    function_guardarDatos();
}