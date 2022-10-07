
function_cambiarRango = ()=>{
    var containerShowProductos = document.querySelector("#container-show-producto");
    var inputRange = document.querySelector("#range-precio-producto");
    var precioMinimo = document.querySelector(".precio-minimo-producto");
    var precioMaximo = document.querySelector(".precio-maximo-producto");

    inputRange.onclick = ()=>{
        precioMinimo.textContent = inputRange.value;
        const data = new URLSearchParams("valor1=" + inputRange.value + "&valor2=" + precioMaximo.textContent);
        data.append('between-producto', inputRange.getAttribute("idCategoria"));
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
            if(texto != ""){
                containerShowProductos.innerHTML = "";
                containerShowProductos.innerHTML += texto;
            }
        })
        .catch(function(err) {
            console.log(err);
        });
    }
}

function_comprarMas = ()=>{
    var containerShowProductos = document.querySelector("#container-show-producto");
    var btnComprarMas = document.querySelector("#comprar_mas_productos");

    btnComprarMas.onclick = (e)=>{
        e.preventDefault();
        // console.log(btnComprarMas.getAttribute("idCategoria"));
        const data = new URLSearchParams("btnComprarMas=" + btnComprarMas.getAttribute("idCategoria"));
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
            console.log(texto);
            if(texto != ""){
                containerShowProductos.innerHTML = "";
                containerShowProductos.innerHTML += texto;
            }
        })
        .catch(function(err) {
            console.log(err);
        });
    }
}

window.onload = ()=>{
    function_cambiarRango();
    function_comprarMas();
}