<script>
  function cerrar_sesion() {
    setTimeout("location.href='../php/cerrar_sesion.php'", 1200);
  }
   function consulta(){
    <?php
    include ('../php/conexion.php');
    $rep = mysqli_query($conn, "SELECT * FROM tmp_reportes WHERE ruta = 0");
    $inst = mysqli_query($conn, "SELECT id_cliente FROM tmp_pendientes WHERE ruta_inst = 0");

    if(mysqli_num_rows($rep) == 0 AND mysqli_num_rows($inst) == 0){
      $No = 0;
    }else{
      $No = 1;
    }
    ?>
   }
   function crear_ruta(es){
    Entra = <?php echo $No; ?>;
    if (Entra == 0) {
        M.toast({html:"Agrege una Reporte o una Instalacion para poder crear la ruta.", classes: "rounded"});
    }else{
      var textoResponsable = $("select#responsable").val();
      var textoAcompañante = $("input#acompañante").val();
      var textoVehiculo = $("input#vehiculo").val();
      if(document.getElementById('bobina').checked==true){
        textoBonina = 1;
      }else{
        textoBonina = 0;
      }
      if(document.getElementById('vale').checked==true){
        textoVale = 1;
      }else{
        textoVale = 0;
      }
      if (es == 1) {
        ir = 'crear_ruta.php';
      }else{
        ir = 'crear_ruta_pedido.php'
      }
      if (textoResponsable == 0) {
        M.toast({html:"Selecciones un responsable de ruta.", classes: "rounded"});
      }else if (textoVehiculo == "") {
        M.toast({html:"El campo Vehiculo(s) no puede ir vacío.", classes: "rounded"});
      }else{
        M.toast({html:"Creando ruta...", classes: "rounded"});
        $.post("../php/"+ir, {
              valorResponsable: textoResponsable,
              valorAcompañante: textoAcompañante,
              valorVehiculo: textoVehiculo,
              valorBobina: textoBonina,
              valorVale: textoVale
            }, function(mensaje) {
                $("#resultado_ruta").html(mensaje);
        });
      }
    }
  };

  function buscar_folio() {
    var textoBusqueda = $("input#buscar_dispositivo").val();
    if (textoBusqueda != "") {
        $.post("../php/buscar_dispositivo.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultado_dispositivo").html(mensaje);
        }); 
    } else { 
        ("#resultado_dispositivo").html('No se encontraron dispositivos.');
  };
};
</script>
<!--Termina script dispositivos-->

<!--Script Buscar clientes-->
<script>
function recargar_usuarios() {
    setTimeout("location.href='usuarios.php'", 800);
  }
function recargar() {
    setTimeout("location.href='instalaciones.php'", 800);
  }
function recargar2() {
    setTimeout("location.href='admin_clientes.php'", 800);
  }
function recargar3() {
    setTimeout("location.href='../views/tel.php'", 800);
  }
function recargar10() {
    setTimeout("location.href='../views/cortes_telefono.php'", 800);
  }

  function admin() {
    setTimeout("location.href='home.php'", 1000);
  }
</script>
<!--Termina Script Buscar clientes-->


<!-- Modal Buscar clientes redes-->
  <div id="buscar_clientes_redes" class="modal modal-fixed-footer">
    <div class="modal-content">
      <nav>
        <div class="nav-wrapper">
          <form>
            <div class="input-field pink lighten-4">
              <input id="buscar_cliente_redes" type="search" placeholder="Buscar Cliente" maxlength="30" value="" autocomplete="off" onKeyUp="PulsarTeclaRedes();" autofocus="true" required>
              <label class="label-icon" for="search"><i class="material-icons">search</i></label>
              <i class="material-icons">close</i>
            </div>
          </form>
        </div>
      </nav>
      <p><div id="resultado_clientes_redes"></div></p>
    </div>
    <div class="modal-footer container">
      <a href="#" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar<i class="material-icons right">close</i></a>
    </div>
  </div>
<!--.....Termina Modal Buscar clientes redes-->

<!-- Modal Buscar clientes -->
  <div id="buscar_clientes" class="modal modal-fixed-footer">
    <div class="modal-content">
      <nav>
        <div class="nav-wrapper">
          <form>
            <div class="input-field pink lighten-4">
              <input id="buscar_cliente" type="search" placeholder="Buscar Cliente" maxlength="30" value="" autocomplete="off" onKeyUp="PulsarTecla();" autofocus="true" required>
              <label class="label-icon" for="search"><i class="material-icons">search</i></label>
              <i class="material-icons">close</i>
            </div>
          </form>
        </div>
      </nav>
      <p><div id="resultado_clientes"></div></p>
    </div>
    <div class="modal-footer container">
      <a href="#" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar<i class="material-icons right">close</i></a>
    </div>
  </div>
<!--.....Termina Modal Buscar clientes-->

<!--Ventana modal para la creación de la ruta-->
<div id="rutamodal" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h3 id="resultado_ruta">¿Estás seguro de crear la ruta?</h3>
      <p class="center red-text"><b>Al crear la ruta se mostrará un PDF en una nueva pestaña y se crear la ruta.</b></p><br>
     <h5>Tecnico(s) que ira(n) a la ruta:</h5> 
      <form class="row">
        <div class="input-field col s6 m3 l3">
            <select id="responsable" class="browser-default">
              <option value="0" selected>Responsable:</option>
              <option value="MARCOS">MARCOS</option>
              <option value="RUBEN">RUBEN</option>
              <option value="ULISES">ULISES</option>
              <option value="LUIS">LUIS</option>
              <option value="EDWIN">EDWIN</option>
              <option value="ALFREDO">ALFREDO</option>
              <option value="VICTOR">VICTOR</option>
              <option value="MIGUEL C.">MIGUEL C.</option>
              <option value="CESAR">CESAR</option>
              <option value="CRISTIAN">CRISTIAN</option>
              <option value="FERNANDO">FERNANDO</option>
              <option value="ISELA">ISELA</option>
              <option value="MIGUEL V.">MIGUEL V.</option>
            </select>
        </div>
        <div class="input-field col s6 m6 l6">
            <i class="material-icons prefix">people</i>
            <input id="acompañante" type="text" class="validate" data-length="30" required>
            <label for="acompañante">Acompañante(s): Ej. (MARCOS, MIGUEL)</label>
        </div>
        <div class="col s5 m3 l3">
          <p><br>
            <input type="checkbox" id="bobina"/>
            <label for="bobina">Bobina Nueva</label>
          </p>
        </div>
        <div class="input-field col s10 m4 l4">
            <i class="material-icons prefix">directions_car</i>
            <input id="vehiculo" type="text" class="validate" data-length="30" required>
            <label for="vehiculo">Vehiculo(s): </label>
        </div>
        <div class="col s7 m3 l3">
          <p><br>
            <input type="checkbox" id="vale"/>
            <label for="vale">Vale de Gasolina</label>
          </p>
        </div>
      </form>
    </div>
    <div class="modal-footer container">
    <a class="modal-action modal-close waves-effect waves-green btn-flat" onclick="consulta();crear_ruta(1);">Crear Ruta<i class="material-icons right">done</i></a>
    <a class="modal-action modal-close waves-effect waves-green btn-flat" onclick="consulta();crear_ruta(2);">Crear Ruta y pedido<i class="material-icons right">done</i></a>
      <a href="#" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar<i class="material-icons right">close</i></a>
    </div>
</div>
<!--.....Cierre de ventana modal para la creacion de ruta-->

<!-- Modal Buscar dispositivos-->
  <div id="buscar_dispositivo" class="modal modal-fixed-footer">
    <div class="modal-content">
      <nav>
        <div class="nav-wrapper">
          <form>
            <div class="input-field pink lighten-4">
              <input id="buscar_dispositivo" type="search" placeholder="Folio o nombre del cliente" maxlength="30" value="" autocomplete="off" onKeyUp="PulsarTeclaFolio();" autofocus="true" required>
              <label class="label-icon" for="search"><i class="material-icons">search</i></label>
              <i class="material-icons">close</i>
            </div>
          </form>
        </div>
      </nav>
      <p><div id="resultado_dispositivo"></div></p>
    </div>
    <div class="modal-footer container">
      <a href="#" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar<i class="material-icons right">close</i></a>
    </div>
  </div>
<!--.....Termina Modal Buscar dispositivos-->

<!--Modal cortes-->
<div id="corte" class="modal">
  <div class="modal-content">
    <h4 class="red-text center">! Advertencia !</h4>
    <h6 ><b>Una vez generado el corte se comenzara una nueva lista de pagos para el siguinete corte. </b></h6><br>
    <h5 class="red-text darken-2">¿DESEA CONTINUAR?</h5>
    <div class="row">
      <div class="input-field col s12 m5 l5">
        <i class="material-icons prefix">lock</i>
        <input type="password" name="clave" id="clave">
        <label for="clave">Ingresar Clave</label>
      </div>
      <div class="input-field row col s12 m5 l5">
          <i class="col s1"> <br></i>
          <select id="recibio" class="browser-default col s10" >
            <option value="0" selected >Recibio</option>
            <option value="Camila">Camila</option>
            <option value="Gabriel">Gabriel</option>
          </select>
      </div>
    </div>
    <h5 class="red-text darken-2">Corte del SAN (efectivo)</h5>
    <form class="row">
      <div class="input-field col s12 m6 l4">
          <i class="material-icons prefix">attach_money</i>
          <input id="cantidadSAN" type="number" class="validate" data-length="30" value="0" required>
          <label for="cantidadSAN">Cantidad:</label>
      </div>
      <div class="input-field col s12 m6 l6">
          <i class="material-icons prefix">edit</i>
          <input id="descripcionSAN" type="text" class="validate" data-length="30" required>
          <label for="descripcionSAN">Descripcion:(ej: Venta de..) </label>
      </div>
    </form>
    <h5>¿Desea agregar algun deducible?</h5>
    <form class="row">
      <div class="input-field col s12 m6 l4">
          <i class="material-icons prefix">attach_money</i>
          <input id="cantidadD" type="number" class="validate" data-length="30" value="0" required>
          <label for="cantidadD">Cantidad:</label>
      </div>
      <div class="input-field col s12 m6 l6">
          <i class="material-icons prefix">edit</i>
          <input id="descripcionD" type="text" class="validate" data-length="30" required>
          <label for="descripcionD">Descripcion:(ej: Viaticos para Marcos y Luis) </label>
      </div>
    </form>
  </div>
  <div class="modal-footer">
      <a onclick="recargar_corte()" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
      <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat">Cerrar<i class="material-icons right">close</i></a>
  </div><br>
</div>
<!--Cierre modal Cortes-->

<!--MODALES DE LOS BOTONES DEL CATALOGO-->
<!-- Modal SubirCatalogo Structure -->
<div id="SubirCatalogo1" class="modal">
  <div class="modal-content">
    <h5>Seleccionar Documento Nuevo PDF:</h5> 
    <h6 class="red-text"><b>ATENCION!! seleccionar un archivo PDF ya que solo acepta archivos con extención PDF</b></h6> 
    <form action="../php/subir_catalogo.php" method="post" enctype="multipart/form-data">
      <div class="input-field col s12 m6 l6">
        <div class="file-field input-field">
          <div class="btn">
            <span>SELECCIONAR PDF</span>
            <input type="file" name="documento" id = "documento" required>
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Subir Documento PDF">
          </div>
        </div>
      </div><br><br><br><br>
      <a href="#" class="modal-action modal-close waves-effect waves-green btn red accent-2">Cancelar<i class="material-icons right">close</i></a>
      <button class="btn waves-effect waves-light pink right" type="submit" name="action">Subir<i class="material-icons right">file_upload</i></button>
    </form>
  </div>
</div>
<!-- Modal EditarCatalogo Structure -->
<?php 
    $Documento=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM catalogo ORDER BY id DESC LIMIT 1"));
    ?>
    <div id="EditarCatalogo" class="modal modal-fixed-footer">
    <div class="modal-content">
     <h5>Editar PDF de Catalogo:</h5> 
     <h6 class="red-text"><b>Al momento de editar el archivo se reelmplazara por el actualmente seleccionado solo se aceptan archivos PDF</b></h6> 
      <form id="respuesta" action="../php/editar_catalogo.php" method="post" enctype="multipart/form-data">
        <div class="input-field col s12">
        DOCUMENTO: <?php echo $Documento['nombre']?><a href = "../files/catalogo_imagen/<?php echo $Documento['nombre']?>" target = "blank"class="btn-small waves-effect waves-light" target = "blank"><i class="material-icons">file_download</i></a></div>
        <div class="input-field col s12 m6 l6">
            <div class="file-field input-field">
              <div class="btn">
                <span>SUBIR NUEVO CATALOGO</span>
                <input type="file" name="documento" id = "documento" required>
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Subir Documento PDF">
              </div>
            </div>
            <input id="id" name="id" type="hidden" value="<?php echo $Documento['id'] ?>">
            <input id="doc" name="doc" type="hidden" value="<?php echo $Documento['nombre'] ?>">
        </div><br><br><br>
        <a href="#" class="modal-action modal-close waves-effect waves-green btn red accent-2">Cancelar<i class="material-icons right">close</i></a>
        <button class="btn waves-effect waves-light pink right" type="submit" name="action">Subir<i class="material-icons right">file_upload</i></button>
      </form>
    </div>
    </div>
<!-- Modal EliminarCatalogo Structure -->
<?php 
  $Documento=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM catalogo ORDER BY id DESC LIMIT 1"));
?>
    <div id="EliminarCatalogo" class="modal">
      <div class="modal-content text-align: center">
        <h5>Eliminar PDF de Catalogo:</h5> 
        <h6 class="red-text"><b>¡ATENCIÓN! El archivo se eliminará por completo, ¿Está seguro?</b></h6> 
        <form id="respuesta" action="../php/eliminar_catalogo.php" method="post" enctype="multipart/form-data">
          <div class="input-field">
            DOCUMENTO: <?php echo $Documento['nombre']?></div>
              <div class="input-field col s12 m6 l6 text-align: center">
                <button class="btn waves-effect waves-light pink center" type="submit" name="action">Eliminar<i class="material-icons right">delete_forever</i></button>
                <input id="id" name="id" type="hidden" value="<?php echo $Documento['id'] ?>">
                <input id="doc" name="doc" type="hidden" value="<?php echo $Documento['nombre'] ?>">
              </div><br><br>
            <a href="#" class="modal-action modal-close waves-effect waves-green btn red accent-2">Cancelar<i class="material-icons right">close</i></a>
        </form>
      </div>
    </div> 
<!-------------------------------------------------------------------------------------------------------->

<!--Modal cortes PARCIALES-->
<div id="corteP" class="modal">
  <div class="modal-content">
    <h4 class="red-text center">! Advertencia !</h4><br>
    <h6 ><b>Una vez generado el corte se comenzara una nueva lista de pagos para el siguinete corte parcial. </b></h6><br>
    <h5 class="red-text darken-2">¿DESEA CONTINUAR?</h5>
    <div class="row">
    <div class="input-field col s12 m6 l6">
        <i class="material-icons prefix">lock</i>
        <input type="password" name="claveP" id="claveP">
        <label for="claveP">Ingresar Clave</label>
    </div>
    </div>
    <h4>Nombre del cobrador</h4>
      <form class="row">
      <div class="input-field col s12 m6 l6">
          <i class="material-icons prefix">people</i>
          <input id="cobradorP" type="text" class="validate" data-length="30" required>
          <label for="cobradorP">Nombre:(ej: Marcos Santillan) </label>
      </div>
      </form>
  </div>
  <div class="modal-footer">
      <a onclick="recargar_corteP()" class="modal-action modal-close waves-effect waves-green btn-flat right">Aceptar</a>
      <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat">Cerrar<i class="material-icons right">close</i></a>
  </div>
</div>
<!--Cierre modal Cortes PARCIALES-->
