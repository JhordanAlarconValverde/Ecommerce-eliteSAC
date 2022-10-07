
function_carrito = ()=>{
    // var idProductoCarrito = document.querySelector(".id-producto-carrito");
    var btnProductoCarrito = document.querySelectorAll(".btn-producto-carrito-eliminar");
    var containerElement = document.querySelector(".div-container-producto");
    var divElement = document.querySelectorAll(".div-delete-producto");
    var cantidadCarrito = document.querySelectorAll(".cantidad-producto-carrito");
    var precioDescuento = document.querySelectorAll(".prec-descuento-carrito");
    var subtotalProducto = document.querySelectorAll(".subtotal_carrito_producto");

    function_carritoEliminar = ()=>{
        btnProductoCarrito.forEach((posicion, i) => {
            btnProductoCarrito[i].onclick = ()=>{
                var idProducto = btnProductoCarrito[i].getAttribute("id_producto");
               
                const data = new URLSearchParams("idProducto=" + idProducto);
                data.append('idProductoEliminar', 'idProductoEliminar');
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
                    let decodeJSON = JSON.parse(texto);
                    if(decodeJSON[0] == "eliminado"){
                        containerElement.removeChild(divElement[i]);
                        document.querySelector("#subtotal_carrito").textContent = decodeJSON[1];
                        document.querySelector("#total_carrito").textContent = decodeJSON[1];
                    }
                })
                .catch(function(err) {
                    console.log(err);
                });        
            }
        });
    }

    function_carritoEditar = ()=>{
        cantidadCarrito.forEach((posicion, i)=>{
            cantidadCarrito[i].onchange = ()=>{
                let idProducto = btnProductoCarrito[i].getAttribute("id_producto");
                let cantidad = cantidadCarrito[i].value;
        
                const data = new URLSearchParams("idProducto=" + idProducto + "&cantidad=" + cantidad);
                data.append("cambiarCantidad", "cambiarCantidad");
        
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
                    // console.log(texto);
                })
                .catch(function(err) {
                    console.log(err);
                });
        
                subtotalProducto[i].textContent = cantidad * precioDescuento[i].textContent;
        
                let subtotal_total = 0;
                subtotalProducto.forEach((posicion, i)=>{
                    subtotal_total += parseFloat(subtotalProducto[i].textContent);
                })
        
                document.querySelector("#subtotal_carrito").textContent = subtotal_total;
                document.querySelector("#total_carrito").textContent = subtotal_total;
            }
        })
    }

    function_carritoEliminar();
    function_carritoEditar();
}

function_finalizarCompra = ()=>{
    var btnFinalizarcompra = document.querySelector("#btn-finalizar-compra");

    btnFinalizarcompra.onclick = ()=>{
        location.href = "http://localhost/elitesac/pages/controller/ProductoController.php?btnFinalizarCompra=" + "btnFinalizarCompra";
    }
}

window.onload = ()=>{
    function_carrito();
    function_finalizarCompra();
}