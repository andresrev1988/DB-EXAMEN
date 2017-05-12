<?php
  require('./connector.php');

  session_start();

  if (isset($_SESSION['username'])) {
    $con = new ConectorBD($host, $user, $password);
    if ($con->initConexion('agenda_db')=='OK') {
      $resultado = $con->consultar(['usuarios'],['id_user'], "WHERE email_user ='" .$_SESSION['username']."'");
      $fila = $resultado->fetch_assoc();
      $data['titulo_evento'] = "'".$_POST['titulo']."'";
      $data['fecini_evento'] = "'".$_POST['start_date']."'";
      $data['horaini_evento'] = "'".$_POST['start_hour']."'";
      $data['fecfin_evento'] = "'".$_POST['end_date']."'";
      $data['horafin_evento'] = "'".$_POST['end_hour']."'";
      $data['diacom_evento'] = $_POST['allDay'];      
      $data['fk_id_user'] = $fila['id_user'];

      if ($con->insertData('eventos', $data)) {
        $response['msg']= 'OK';
      }else {
        $response['msg']= 'No se pudo realizar la inserción de los datos';
      }
    }else {
      $response['msg']= 'No se pudo conectar a la base de datos';
    }
  }else {
    $response['msg']= 'No se ha iniciado una sesión';
  }

  echo json_encode($response);

 ?>
