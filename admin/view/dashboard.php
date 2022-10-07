<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="../../images/images-interface/logo.png"></link>
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/fontawesome/css/all.min.css">
</head>
<body style="background:#eee;">
    <?php 
        session_start(); 
        if(!isset($_SESSION['empleado'])){
            header("location: http://localhost/elitesac/admin/");
        }

        if($_SESSION['empleado']['idTurno'] != 4){
            header("location: http://localhost/elitesac/admin/view/prodRevision.php");
        }

        require '../../bd/conexion.php';
        require '../model/administrador/Administrador.php';
        $admin = new Administrador();
        $prodMasVendidos10 = $admin->admin_listarProductosMasVendidos();
        $userregistrados10 = $admin->admin_listarUltimosUsuariosRegistrados();

        // echo "<pre>";
        // // print_r($admin->admin_ventasPorFecha(2022));
        // echo "</pre>";
        // foreach ($admin->admin_ventasPorFecha('2019-01-01','2019-12-30') as $dato) {

        //     $mes = date('F', strtotime($dato->fechaDePago));
        
        //     $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        //     $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        //     $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        //     echo $nombreMes;

        // }

       
        

        // echo date('m', strtotime($fecha1)) . "<br>"; //month
        // echo date('d', strtotime($fecha1)) . "<br>"; 
        // echo date('y', strtotime($fecha1));

        // $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        // echo $meses[$mes-1];

        // echo $month . "<br>";
        // echo $dia . "<br>";
        // echo $año . "<br>";

        // foreach ($admin->admin_ventasPorFecha('2019-01-01','2019-12-30') as $dato) {
            
        //     // echo $dato->total . "<br>";
        //     $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        //     $mes = date("m",strtotime(date($dato->fechaDePago)));
        //     $dia = date("d",strtotime(date($dato->fechaDePago)));
        //     $año = date("y",strtotime(date($dato->fechaDePago)));
            
        //     echo $meses[$mes-1];
        // }

        

    ?>
    <div class="container-fluid p-0">
        <div class="d-flex">
            <?php include 'navegacion.php'; ?>
            <div class="float-end w-100 p-4" style="margin-left:11rem">
                
                <h5 class="">Bienvenido administrador <b><?=$_SESSION['empleado']['nombre'] . " " . $_SESSION['empleado']['apellido']?></b></h5>


                <div class="mt-5">
                    <div class="row">
                        <div class="col">
                            <div class="bg-light text-center rounded-4 p-3">
                                <span class="fs-4">Usuarios Registrados</span><br>
                                <span><?=$admin->admin_UsuariosRegistrados();?></span>
                            </div>
                        </div>
                        <div class="col">
                             <div class="bg-light text-center rounded-4 p-3">
                                <span class="fs-4">Compras Realizadas</span><br>
                                <span><?=$admin->admin_ComprasRealizadas();?></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="bg-light text-center rounded-4 p-3">
                                <span class="fs-4">Productos Vendidos</span><br>
                                <span><?=$admin->admin_productosVendidos();?></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="bg-light text-center rounded-4 p-3">
                                <span class="fs-4">Productos Disponibles</span><br>
                                <span><?=$admin->admin_productosDisponibles();?></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="bg-light text-center rounded-4 p-3">
                                <span class="fs-4">Categoria mas Vendida</span><br>
                                <span><?=$admin->admin_categoriaMasVendida();?></span>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="mt-4">
                    <div class="row">
                        <div class="col bg-light rounded-4 p-3 mx-1">

                            <h4 class="h4">Productos mas vendidos</h4>
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Estado</th>
                                    <th>Precio</th>
                                    <th>P. Desc</th>
                                    <th>Condicion</th>
                                </tr>
                                <?php
                                    foreach($prodMasVendidos10 as $dato){
                                        echo "
                                            <tr>
                                                <td>{$dato->id}</td>
                                                <td>{$dato->producto}</td>
                                                <td>{$dato->estado}</td>
                                                <td>S/{$dato->precio}</td>
                                                <td>S/{$dato->precioDescuento}</td>
                                                <td>Vendida</td> 
                                            </tr>
                                        ";
                                    }
                                ?>
                            </table>

                        </div>
                        <div class="col bg-light rounded-4 p-3 mx-1">
                            <table class="table table-hover">
                                <h4 class="h4">Usuarios registrados</h4>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th>Usuario</th>
                                </tr>

                                <?php
                                    foreach($userregistrados10 as $dato){
                                        echo "
                                            <tr>
                                                <td>{$dato->id}</td>
                                                <td>{$dato->nombre}</td>
                                                <td>{$dato->apellido}</td>
                                                <td>{$dato->telefono}</td>
                                                <td>{$dato->correo}</td>
                                                <td>{$dato->usuario}</td>
                                            </tr>
                                        ";
                                    }
                                ?>

                            </table>
                        </div>
                    </div>
                </div>
            
                <div class="mt-4">
                    
                    <div class="row">


                        <div class="col bg-light p-3 rounded-4 mx-1">
                            <h4 class="h4 mb-3">Ventas por año</h4>

                            <!-- 
                                if(isset($_POST["btnMostrarVentas"])){
                                    echo "si xd";  
                                    print_r($_POST);
                                    echo $_POST['select_ventas'];
                                }
                             -->

                            <!-- <form action="dashboard.php" id="formVenta" name="formVenta" method="post" class="d-flex mb-3">
                                    <select name="select_ventas" id="select_ventas" class="form-select shadow-none">
                                    </select>
                                    <button type="submit" class="btn btn-primary shadow-none rounded-0 rounded-end" name="btnMostrarVentas" id="btnMostrarVentas">Calcular</button>
                            </form> -->
                            
                            <canvas id="myChart" content="ventas_año" class="w-100 mx-auto grafico_content_link"></canvas>
                            <!-- <canvas id="myChart3" content="ventas_mes" class="w-100 mx-auto grafico_content_link"></canvas> -->
                            
                            <!-- <div class="mt-4">
                                <button class="btn btn-success shadow-none grafico_link">Filtrar por Año</button>
                                <button class="btn btn-warning shadow-none grafico_link">Filtrar por Mes</button>
                            </div> -->
                        </div>



                        <div class="col bg-light p-3 rounded-4 mx-1">
                            <h4 class="h4 mb-3">Venta por categorias</h4>

                            <canvas id="myChart2" class="w-75 mx-auto"></canvas>
                        </div>
                    </div>
                </div>

              
            </div>
        </div>
    </div>


    <script src="../../js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

       
        // graficoLink.forEach((posicion, index) => {
            //     graficoContent[index].style.display = "none";
            //     graficoContent[0].style.display = "block";
                
            //     graficoLink[index].onclick = ()=>{
            //         graficoContent.forEach((posicion, index) => {
            //             // console.log(graficoContent[index][0]);
            //             graficoContent[index].style.display = "none";
            //         });
            //         graficoContent[index].style.display = "block";
            //     }
        // });

        graficoCategoria = ()=>{
             const data_venta_categoria = {
                labels: [
                    <?php
                        foreach ($admin->admin_categoriasVendidas() as $dato) {
                        echo "'".$dato->nombre."',";
                    }  ?>
                ],
                datasets: [{
                    // label: 'My First Dataset',
                    data: [
                        <?php
                        foreach ($admin->admin_categoriasVendidas() as $dato) {
                        echo $dato->cantidad.",";
                    }  ?>
                    ],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(0, 255, 0)',
                        'rgb(150, 12, 150)'
                    ],
                    hoverOffset: 5
                }]
            };

            const chart_categoria = document.getElementById('myChart2').getContext('2d');
            const myChart2 = new Chart(chart_categoria, {
                type: 'doughnut',
                data: data_venta_categoria
            });
        }
        graficoCategoria();


        

        graficoFecha = ()=>{
            // var graficoContent = document.querySelectorAll(".grafico_content_link");
                // var graficoLink = document.querySelectorAll(".grafico_link");
                // var selectVentas = document.querySelector("#select_ventas");

                // const añoActual = new Date();
                // for(let x = añoActual.getFullYear(); x >= 2000; x--){
                //     selectVentas.innerHTML += `
                //         <option value="${x}">${x}</option> 
                //     `; 
                // }

                // var json = '';
                // document.querySelector("#formVenta").onsubmit = (e)=>{
                //     e.preventDefault();
                //     json = JSON.stringify(document.querySelector("#select_ventas").value);
            // }

            const ctx = document.getElementById('myChart').getContext('2d');

            const labels = [
                <?php
                    foreach ($admin->admin_ventasPorFecha(2022) as $dato) {
                                $mes = date('F', strtotime($dato->fecha));
                            
                                $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                                $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                                $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
                                echo "'" . $nombreMes."'," ;

                            }
                    
                    // foreach ($admin->admin_ventasPorFecha('2019-01-01','2019-12-30') as $dato) {
                
                        //     // echo $dato->total . "<br>";
                        //     $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                
                        //     $mes = date("m",strtotime(date($dato->fechaDePago)));
                        //     $dia = date("d",strtotime(date($dato->fechaDePago)));
                        //     $año = date("y",strtotime(date($dato->fechaDePago)));
                            
                        //     echo "'" . $meses[$mes-1] . "',";
                    // }
                ?>
            ]

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Ventas por año',
                    data: [
                        <?php
                            foreach ($admin->admin_ventasPorFecha(2022) as $dato) {
                                echo $dato->total . ",";
                        } ?>
                    ],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            };

            const myChart = new Chart(ctx, {
                type: 'line',
                data: data,
            });
        }
        graficoFecha();
    </script>
</body>
</html>