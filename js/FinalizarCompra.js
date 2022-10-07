function_finalizar_compra = ()=>{
    var formFinalizarcompra = document.forms['form-finalizar-compra'];

    formFinalizarcompra.onsubmit = (e)=>{
        e.preventDefault();
        
        let tipoPago = formFinalizarcompra['fc-tipo-pago'];
        let codCuenta = formFinalizarcompra['fc-codigo-cuenta'];
        let codCCV = formFinalizarcompra['fc-codigo-ccv'];
        let conCodCCV = formFinalizarcompra['fc-confirmar-codigo-ccv'];
        // console.log(tipoPago);
        // console.log(codCuenta);
        // console.log(codCCV);
        // console.log(conCodCCV);
        const data = new URLSearchParams("tipoPago=" + tipoPago.value + "&codCuenta=" + codCuenta.value + "&codCCV=" + codCCV.value + "&conCodCCV=" + conCodCCV.value);
        data.append("btnComprarPedido", "btnComprarPedido");
        fetch('http://localhost/elitesac/pages/controller/ProductoController.php',{
            method: 'POST',
            body: data
        }).then(function(response){
            if(response.ok) { return response.text() }
            else { throw "Error en la llamada Ajax"; }
        })
        .then(function(texto){
            console.log(texto.trim());
            if(texto.trim() == "compra exitosa"){
                
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'La compra se realizo correctamente',
                    html:
                        '<p>Podras ver tu pedido en la parte derecha superior de la pantala, en el despliegue de menu > ver historial<p> ' +
                        '<p>si necesitas más información dirigete al apartado de Centro de ayuda o haciendo click aqui ' + 
                        '<a href="http://localhost/elitesac/pages/view/info/Ayuda.php">Centro de ayuda</a></p>',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'Cerrar'
                })
                document.querySelector("#fc-total-carrito").textContent = 0;
                formFinalizarcompra.reset();
            }

            if(texto.trim() == "compra fallida"){
                Swal.fire({
                    title: 'Revise bien todos los campos ingresados',
                    icon: 'info',
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    showConfirmButton: false,
                    cancelButtonText:
                      'Cerrar',
                    // cancelButtonAriaLabel: 'Cerrar'
                  })
            }

            if(texto.trim() == "compra vacia"){
                Swal.fire({
                    title: 'Complete todos los datos del formulario',
                    icon: 'info',
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    showConfirmButton: false,
                    cancelButtonText:
                      'Cerrar',
                    // cancelButtonAriaLabel: 'Cerrar'
                  })
            }
        })
        .catch(err => console.log(err));
        
        //  const data = new FormData("btnPagoPedido="+ btnPagoPedido);
        // // data.append('agregar-carrito', 'agregar-carrito');
        // fetch('http://localhost/elitesac/pages/controller/ProductoController.php', {
        //     method: 'POST',
        //     body: data
        // })
        // .then(function(response) {
        //     if(response.ok) {
        //         return response.text()
        //     } else {
        //         throw "Error en la llamada Ajax";
        //     }
        // })
        // .then(function(texto) {
            
        //     console.log(texto);
        // })
        // .catch(function(err) {
        //     console.log(err);
        // });
    // location.href="http://localhost/elitesac/pages/controller/ProductoController.php?btnPagarPedido=" + "btnPagarPedido";
}
}


window.onload = ()=>{
    function_finalizar_compra();
}