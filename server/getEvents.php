<?php
  require('./connector.php');
  session_start();
  if (isset($_SESSION['username'])) {
    $con = new ConectorBD($host, $user, $password);
    if ($con->initConexion('agenda_db')=='OK') {

      $resultado = $con->consultar(['usuarios'],['id_user'], "WHERE email_user ='" .$_SESSION['username']."'");
      $fila = $resultado->fetch_assoc();
      $resultado = $con->consultar(['eventos'], ['id_evento', 'titulo_evento','fecini_evento','horaini_evento','fecfin_evento','horafin_evento', 'diacom_evento'], "WHERE fk_id_user ='".$fila['id_user']."'");
      $i=0;
      while ($fila = $resultado->fetch_assoc()) {
        //$response['eventos'][$i] = $fila['id_evento']." (".$fila['titulo_evento']." ".$fila['fecini_evento']." ".$fila['horaini_evento']." ".$fila['fecfin_evento']." ".$fila['horafin_evento']." ".$fila['diacom_evento'].")";
        if($fila['diacom_evento']==1){
          $todoElDia=true;
        }else {
          $todoElDia=false;
        }
        $response['eventos'][$i] = array(
            "id" => $fila['id_evento'],
            "title" => $fila['titulo_evento'],
            "start" => $fila['fecini_evento']."T".$fila['horaini_evento'],
            "allDay" => $todoElDia,
            "end" => $fila['fecfin_evento']."T".$fila['horafin_evento']
        );
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
