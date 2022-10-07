var form = document.forms['admin-form'];

form.onsubmit = (e)=>{
    e.preventDefault();

    let rol = form.getAttribute("rol");
    
    // REGISTRAR
    if(rol == 0){
        let data = new FormData(form);
        data.append("role", rol);
        fetch("controller/adminController.php",{
            method: "POST",
            body: data
        }).then(function(response) {
            if(response.ok){ return response.text();}
            else{ return "Error en la llamada Ajax";}
        }).then(function(texto) {
            if(texto == "Registro agregado"){
                form.reset();
                location.href = "dashboard.php";
            }

            console.log(texto);
        }).catch(function(err) {
            console.log(err);
        })
    }

    // INICIAR SESION
    if(rol == 1){
        let data = new FormData(form);
        data.append("role", rol);
        fetch("controller/adminController.php",{
            method: "POST",
            body: data
        }).then(function(response) {
            if(response.ok){ return response.text();}
            else{ return "Error en la llamada Ajax";}
        }).then(function(texto) {
            if(texto == "success"){
                form.reset();
                location.href = "view/dashboard.php";
            }

            console.log(texto);
        }).catch(function(err) {
            console.log(err);
        })
    }

    
    // switch (rol) {
    //     case 0:
    //         console.log(rol);
    //         // let reg = new FormData(form);
    //         // reg.append("role", rol);
    //         // fetch("controller/adminController.php",{
    //         //     method: "POST",
    //         //     body: reg
    //         // }).then(function(response) {
    //         //     if(response.ok){ return response.text();}
    //         //     else{ return "Error en la llamada Ajax";}
    //         // }).then(function(texto) {


    //         //     console.log(texto);
    //         // }).catch(function(err) {
    //         //     console.log(err);
    //         // })
    //         break;
    //     case 1:
    //         // let login = new FormData(form);
    //         // login.append("role", rol);
    //         // fetch("controller/adminController.php",{
    //         //     method: "POST",
    //         //     body: login
    //         // }).then(function(response) {
    //         //     if(response.ok){ return response.text();}
    //         //     else{ return "Error en la llamada Ajax";}
    //         // }).then(function(texto) {


    //         //     console.log(texto);
    //         // }).catch(function(err) {
    //         //     console.log(err);
    //         // })  
    //         break;
    //     default:
    //         break;
    // }
    
}

