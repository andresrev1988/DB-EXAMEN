<?php
  require('./connector.php');
  session_start();
  if (isset($_SESSION['username'])) {
    $con = new ConectorBD($host, $user, $password);
    if ($con->initConexion('agenda_db')=='OK') {
      if ($con->eliminarRegistro('eventos',"id_evento ='" .$_POST['id']."'")) {
        $response['msg']= 'OK';
      }else {
        $response['msg']= 'No se pudo realizar la eliminacion de los datos';
      }
    }else {
      $response['msg']= 'No se pudo conectar a la base de datos';
    }
  }else {
    $response['msg']= 'No se ha iniciado una sesión';
  }
  echo json_encode($response);
 ?>
