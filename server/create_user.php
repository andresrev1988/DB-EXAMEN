<?php
require ('connector.php');

$con = new ConectorBD($host, $user, $password);
$response['conexion'] = $con->initConexion('');
///crea la base de datos
if ($response['conexion']=='OK') {
    if($con->ejecutarQuery('CREATE DATABASE agenda_db;')){
      $response['msg']="exito en la creacion de la base";
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados";
    }
  }else {
    $response['msg']= "No se pudo conectar a la base de datos";
  }
  $con->cerrarConexion();
  echo json_encode($response);
///crea la tabla usuarios
$response['conexion'] = $con->initConexion('agenda_db');
if ($response['conexion']=='OK') {
    $sql= "CREATE TABLE usuarios (
          id_user int(11) NOT NULL,
          email_user varchar(200) NOT NULL,
          pass_user varchar(255) NOT NULL,
          fecnac_user date NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

    if($con->ejecutarQuery($sql)){
      $response['msg']="exito en la creacion de la tabla";
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados";
    }
  }else {
    $response['msg']= "No se pudo conectar a la base de datos";
  }
  echo json_encode($response);

  ///crea las primary keys
  if ($response['conexion']=='OK') {
      $sql= "ALTER TABLE usuarios ADD PRIMARY KEY (id_user), ADD UNIQUE KEY email_user (email_user);";
      if($con->ejecutarQuery($sql)){
        $response['msg']="exito en agregar primary key";
      }else {
        $response['msg']= "Hubo un error y los datos no han sido cargados";
      }
    }else {
      $response['msg']= "No se pudo conectar a la base de datos";
    }
    echo json_encode($response);
    ///crea autoincrement
    if ($response['conexion']=='OK') {
        $sql= "ALTER TABLE usuarios MODIFY id_user int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13";
        if($con->ejecutarQuery($sql)){
          $response['msg']="exito en agregar autoincrement";
        }else {
          $response['msg']= "Hubo un error y los datos no han sido cargados";
        }
      }else {
        $response['msg']= "No se pudo conectar a la base de datos";
      }
      echo json_encode($response);
    ///crea la tabla eventos
    if ($response['conexion']=='OK') {
        $sql= "CREATE TABLE eventos (
              id_evento int(11) NOT NULL,
              titulo_evento varchar(200) NOT NULL,
              fecini_evento date NOT NULL,
              horaini_evento time DEFAULT NULL,
              fecfin_evento date DEFAULT NULL,
              horafin_evento time DEFAULT NULL,
              diacom_evento boolean NOT NULL,
              fk_id_user int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1";
        if($con->ejecutarQuery($sql)){
          $response['msg']="exito en la creacion de la tabla";
        }else {
          $response['msg']= "Hubo un error y los datos no han sido cargados";
        }
      }else {
        $response['msg']= "No se pudo conectar a la base de datos";
      }
      echo json_encode($response);
      ///crea las primary keys
      if ($response['conexion']=='OK') {
          $sql= "ALTER TABLE eventos ADD PRIMARY KEY (id_evento);";
          if($con->ejecutarQuery($sql)){
            $response['msg']="exito en agregar primary key";
          }else {
            $response['msg']= "Hubo un error y los datos no han sido cargados";
          }
        }else {
          $response['msg']= "No se pudo conectar a la base de datos";
        }
        ///crea las autoincereme
        echo json_encode($response);
        if ($response['conexion']=='OK') {
            $sql= "ALTER TABLE eventos MODIFY id_evento int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13";
            if($con->ejecutarQuery($sql)){
              $response['msg']="exito en agregar autoincrement";
            }else {
              $response['msg']= "Hubo un error y los datos no han sido cargados";
            }
          }else {
            $response['msg']= "No se pudo conectar a la base de datos";
          }
          echo json_encode($response);
//CREA usuarios
$data['email_user'] = "'user@dominio.com'";
$data['pass_user'] = "'".password_hash('clave', PASSWORD_DEFAULT)."'";
$data['fecnac_user'] = "'1988-03-11'";
$data1['email_user'] = "'user1@dominio.com'";
$data1['pass_user'] = "'".password_hash('clave1', PASSWORD_DEFAULT)."'";
$data1['fecnac_user'] = "'1989-04-12'";
$data2['email_user'] = "'user2@dominio.com'";
$data2['pass_user'] = "'".password_hash('clave2', PASSWORD_DEFAULT)."'";
$data2['fecnac_user'] = "'1985-05-02'";

if ($response['conexion']=='OK') {
    if($con->insertData('usuarios', $data)){
      $response['msg']="exito en la inserción";
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados";
    }
  }else {
    $response['msg']= "No se pudo conectar a la base de datos";
  }

if ($response['conexion']=='OK') {
  if($con->insertData('usuarios', $data1)){
    $response['msg']="exito en la inserción";
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados";
    }
  }else {
  $response['msg']= "No se pudo conectar a la base de datos";
  }

if ($response['conexion']=='OK') {
  if($con->insertData('usuarios', $data2)){
    $response['msg']="exito en la inserción";
  }else {
    $response['msg']= "Hubo un error y los datos no han sido cargados";
  }
  }else {
    $response['msg']= "No se pudo conectar a la base de datos";
  }
  echo json_encode($response);
?>
