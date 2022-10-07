function_agregarCarrito = ()=>{
    var btnAgregarCarrito = document.getElementById("btn-agregar-carrito");


    btnAgregarCarrito.onclick = ()=>{
        var idProducto = document.querySelector("#txtID-producto");
        var cantidad = document.querySelector("#txtCant-producto");

        const data = new URLSearchParams("idProducto=" + idProducto.value + "&cantidad=" + cantidad.value);
        data.append('agregar-carrito', 'agregar-carrito');
        fetch('http://localhost/elitesac/pages/controller/ProductoController.php', {
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
            
            if(texto.trim() == "producto agregado"){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Producto agregado al carrito',
                    showConfirmButton: false,
                    timer: 1500
                })
            }

            if(texto.trim() == "ya existe"){
                Swal.fire({
                    text: "Este producto ya esta en el carrito",
                    icon: 'warning',
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1500
                })
            }

            if(texto.trim() == "no logueado"){
                location.href = "http://localhost/elitesac/pages/IniciarSesion.php";
            }
        })
        .catch(function(err) {
            console.log(err);
        });
    }
}

window.onload = ()=>{
    function_agregarCarrito();
}