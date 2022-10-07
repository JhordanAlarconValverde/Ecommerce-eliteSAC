/********************************************************************* */
/*  INDEX  */
/********************************************************************* */
// var headerLinkCategory = document.querySelectorAll('.herader_hover_link_category');
// var headerLinkCategory_ = document.querySelectorAll('.header_hover_link_category_');

// headerLinkCategory.forEach((position, i)=>{
//     headerLinkCategory_[i].classList.add("d-none");
//     headerLinkCategory[i].onclick = ()=>{
        
//         headerLinkCategory.forEach((position, i)=>{
//             headerLinkCategory_[i].classList.add("d-none");
//             // headerLinkCategory_[i].style.display = "none";
//         })
//         headerLinkCategory_[i].classList.remove("d-none");
//         // headerLinkCategory_[i].classList.add("d-block");
//         headerLinkCategory_[i].classList.add("d-block");
//         // headerLinkCategory_[i].style.display = "block";
//     }
// })



// console.log("Funciona");


// form-login-usuario
// txt-login-user-Usuario
// txt-login-password-Usuario
// btn-login-IniciarSesion
// var btnComprarMasProductos = document.querySelector("#comprar_mas_productos");
// btnComprarMasProductos.onclick = (e)=>{
//     e.preventDefault();
//     console.log("sbmi xd");
// }


var dropCategoria = document.querySelectorAll(".drop_categoria");
var dropCategoriaDown = document.querySelectorAll(".drop_categoria_down");

dropCategoria.forEach((position, i)=>{
    dropCategoria[i].onclick = ()=>{
        dropCategoriaDown[i].classList.toggle("d-none");
        // dropCategoriaDown[i].style.display="none";
    }
});



// BUSCAR PRODUCTO
// var btnBuscarProducto = document.querySelector("#btnBuscarProductoIndex");
var txtBuscarProducto = document.querySelector("#txtBuscarProductoIndex");
var listaKeyUp = document.querySelector("#listaKeyupProductos");

txtBuscarProducto.onkeyup = ()=>{
    if(txtBuscarProducto.value.trim() != ""){

        // containerProductos.innerHTML = "";
        const data = new URLSearchParams("valor=" + txtBuscarProducto.value);
        data.append('buscar', 'keyup');

        fetch('http://localhost/elitesac/pages/controller/ProductoController.php' , {
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
            listaKeyUp.innerHTML = "";
            listaKeyUp.innerHTML += texto;
        })
        .catch(function(err) {
            console.log(err);
        });
    }else{
        listaKeyUp.innerHTML = "";
    }
}

// btnBuscarProducto.onclick = ()=>{
//     // containerProductos.innerHTML = "";
//     const data = new URLSearchParams("valor=" + txtBuscarProducto.value);
//     data.append('buscar', 'onclick');

//     fetch('http://localhost/elitesac/pages/controller/ProductoController.php' , {
//         method: 'POST',
//         body: data
//     })
//     .then(function(response) {
//         if(response.ok) {
//             return response.text()
//         } else {
//             throw "Error en la llamada Ajax";
//         }
//     })
//     .then(function(texto) {
//             // console.log("si hay xd");
//         // location.href = "http://localhost/elitesac/pages/view/Productos/Productos.php";
//         // var containerProductos = document.querySelector("#container-show-producto");
//         console.log(texto);
//         // containerProductos.innerHTML = "";
//         // containerProductos.innerHTML += texto;
        
//         console.log(texto);
//     })
//     .catch(function(err) {
//         console.log(err);
//     });
// }