<?php
  require('./connector.php');
  session_start();
  if (isset($_SESSION['username'])) {
    $con = new ConectorBD($host, $user, $password);
    if ($con->initConexion('agenda_db')=='OK') {
      $resultado = $con->consultar(['eventos'], ['id_evento', 'titulo_evento','fecini_evento','horaini_evento','fecfin_evento','horafin_evento', 'diacom_evento']);
      $i=0;
      while ($fila = $resultado->fetch_assoc()) {
        $response['eventos'][$i] = $fila['id_evento']." (".$fila['titulo_evento']." ".$fila['fecini_evento']." ".$fila['horaini_evento']." ".$fila['fecfin_evento']." ".$fila['horafin_evento']." ".$fila['diacom_evento'].")";
        $i++;
      }
      $response['msg']= 'OK';
    }else {
      $response['msg']= 'No se pudo conectar a la base de datos';
    }
  }else {
    $response['msg']= 'No se ha iniciado una sesión';
  }
  echo json_encode($response);
 ?>
