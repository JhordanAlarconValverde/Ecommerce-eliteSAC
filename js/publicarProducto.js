var formulario = document.forms['form-public-product-usuario'];

formulario.onsubmit = (e)=>{
    e.preventDefault();
    
    const data = new FormData(formulario);
    data.append("publicar-producto", "publicar-producto");
    fetch('http://localhost/elitesac/pages/Controller/UsuarioController.php',{
        method: "POST",
        body: data
    }).then(function (response) { if(response.ok){ return response.text();}else{ return "Error en la llamada ajax";}})
    .then(function (texto) {

        if(texto == "success"){
            formulario.reset();
            document.querySelector("#prevImg").src = "";
            Swal.fire({
                // position: 'top-end',
                icon: 'success',
                // title: 'Your work has been saved',
                text: 'Producto subido exitosamente, su publicacion sera revisada por el sistema para ser publicada en la aplicacion web',
                showConfirmButton: false,
                // timer: 1500
              })
        }

        if(texto == "failed"){
            Swal.fire({text: 'Al precer algo salio mal intentelo en un rato',timer: 1500 })
        }
        console.log(texto);
    })
    .catch(function (err) {
        console.log(err);
    })
    
    // console.log("submitxd");
}


const input = document.querySelector('#public-product-imagen');
const contain_prev = document.querySelector("#prevImg");
// input.style.opacity = 0;
input.addEventListener('change', ()=>{
    const curFiles = input.files;
    if (curFiles.length != 0) {
        for (const file of curFiles) {
            var reader = new FileReader();
            reader.addEventListener("load", (event) => {
                contain_prev.src = event.target.result;
            });
            reader.readAsDataURL(file);
        }
    }
})

// changeSizeImg = (number)=> {
//     if (number < 1024) { return number + 'bytes'; }
//     else if (number >= 1024 && number < 1048576){
//         return (number / 1024).toFixed(1) + 'KB';
//     } else if (number >= 1048576) {
//         return (number / 1048576).toFixed(1) + 'MB';
//     }
// }
