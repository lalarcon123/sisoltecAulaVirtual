<?php
  require_once('includes/load.php');

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table)." WHERE estado = 1 order by 2");
   }
}

function find_all_trabajadores($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table)." WHERE status = 1 and user_level =5 order by 2");
   }
}

function find_all_responsables($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table)." WHERE status = 1 and user_level = 6 order by 2");
   }
}

/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id_descripcion($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT c.descripcion FROM {$db->escape($table)} c, curso_oferta o WHERE o.id='{$db->escape($id)}' and c.id = o.id_curso LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

function delete_by_id_Material($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "UPDATE  ".$db->escape($table);
    $sql .= " SET estado = 0 WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}

function find_all_responsablesas($table,$id_proyecto,$id_user) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT distinct rp.id_user, 
                                 concat(u.name, ' ', u.last_name) as nombre_trabajador  
                            FROM ".$db->escape($table)." rp, proyectos p, users u 
                           WHERE p.id = rp.id_proyecto 
                             AND u.id =rp.id_user
                             AND rp.id_proyecto ='{$db->escape($id_proyecto)}'
                             AND ((rp.id_user ='{$db->escape($id_user)}' or '{$db->escape($id_user)}' = '1') OR EXISTS (SELECT * FROM proyectos p WHERE p.id = rp.id_proyecto AND p.responsable = '{$db->escape($id_user)}'))");
   }
}

function find_all_prod_x_proveedor($table, $id_proveedor) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT pp.id, pp.id_producto, p.nombre as nombre_producto, pp.id_proveedor,  v.nombre, pp.precio, (case pp.estado WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado FROM ".$db->escape($table)." pp, productos p, proveedores v WHERE p.id = pp.id_producto AND v.id = pp.id_proveedor AND pp.estado = 1 AND pp.id_proveedor = '{$db->escape($id_proveedor)}' and v.estado = 1 ORDER BY 2");
   }
}


function find_by_id_registro($user,$curso)
{
  global $db;
  $user = (int)$user;
  $curso = (int)$curso;
  $sql = $db->query("SELECT * FROM estudiante_curso pc WHERE pc.id_user='{$db->escape($user)}' and pc.id_curso='{$db->escape($curso)}' and pc.estado = 1 LIMIT 1");
  //and NOT EXISTS (select * from pagos p where p.id_user = e.id_user and p.id_curso = e.id_curso ) 
  if($result = $db->fetch_assoc($sql))
    return $result;
  else
    return null;
}
function find_all_materiales($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT p.id, p.nombre, p.descripcion, p.id_tipomedida,tm.descripcion as medida FROM  ".$db->escape($table)." p, tipo_medida tm WHERE tm.id = p.id_tipomedida and p.estado = 1");
   }
}

function find_all_submenu_opciones($table, $group_id) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("select * from ".$db->escape($table)." dm 
                          where NOT EXISTS (select * 
                                              from usuario_menu um 
                                             where um.det_menu_id = dm.det_menu_id 
                                               and um.grupo_id = '{$db->escape($group_id)}') AND dm.estado = '1'");
   }
}


function find_all_materiales_procedimiento($table, $id) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT p.id,
                                p.nombre
                           FROM ".$db->escape($table)." mp,
                                productos p
                          WHERE p.id = mp.id_producto
                            AND mp.id_procedimiento = '{$db->escape($id)}'
                            AND mp.estado = 1 
                            AND p.stock >= p.stock_minimo");
   }
}

function find_by_parametro($table,$nombre_parametro)
{
  global $db;
  if(tableExists($table)){
        $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE descripcion='{$db->escape($nombre_parametro)}' LIMIT 1");
        if($result = $db->fetch_assoc($sql))
          return $result;
        else
          return null;
   }
}


function find_by_alertas_sin_leer($table)
{
  global $db;
  if(tableExists($table)){
        $sql = $db->query("SELECT count(*) as cantidad FROM {$db->escape($table)} WHERE estado = 1");
        if($result = $db->fetch_assoc($sql))
          return $result;
        else
          return null;
   }
}

function find_by_numero_pregunta($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT COUNT(*) as cantidad FROM ".$db->escape($table)." WHERE id_evaluacion='{$db->escape($id)}' and estado = 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return 0;
     }
}

  function find_by_respuesta($pregunta)
  {
    global $db;
    $sql = "SELECT COUNT(*) AS cantidad FROM evaluacion_respuestas WHERE id_pregunta = '{$db->escape($pregunta)}' and estado = 1 and valida = 'SI'";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }

function find_all_detalles($table,$id) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT dp.id, dp.tipo, 
                                dp.id_padre, dp.id_detalle, 
                                t.descripcion, dp.precio 
                           FROM detalle_paquetes dp, titulos t 
                          WHERE t.id = dp.id_padre 
                            AND dp.tipo = 'C' 
                            AND dp.estado = 1 
                            AND dp.id_paquete = '{$db->escape($id)}'
                          UNION
                         SELECT dp.id, dp.tipo, 
                                dp.id_padre, dp.id_detalle, 
                                le.descripcion, dp.precio 
                           FROM detalle_paquetes dp, listado_examenes le 
                          WHERE le.id = dp.id_detalle 
                            AND le.id_examen = dp.id_padre 
                            AND dp.tipo = 'E' 
                            AND dp.estado = 1 
                            AND dp.id_paquete = '{$db->escape($id)}'
                          UNION
                         SELECT dp.id, dp.tipo, 
                                dp.id_padre, dp.id_detalle, 
                                li.descripcion, dp.precio 
                           FROM detalle_paquetes dp, listado_imagenes li 
                          WHERE li.id = dp.id_detalle 
                            AND li.id_imagen = dp.id_padre 
                            AND dp.tipo = 'I' 
                            AND dp.estado = 1 
                            AND dp.id_paquete = '{$db->escape($id)}'");
   }
}
function find_all_alertas($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT id_producto, descripcion, cantidad, estado, fecha
                            FROM alerta
                           where estado = 1  LIMIT 4");
   }
}


/*--------------------------------------------------------------*/
/* Function for find all opciones de menu de un usuario especifico
/*--------------------------------------------------------------*/
function find_all_menu($table, $user) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT distinct m.id_menu, m.descripcion, m.observacion, m.pagina
                            FROM menu m, 
                                 usuario_menu um 
                           where um.usu_menu_id = m.id_menu 
                             and um.grupo_id = (select u.user_level from users u where u.id = '{$db->escape($user)}')
                             and um.estado = 1 
                            order by m.descripcion");
   }
}

/*--------------------------------------------------------------*/
/* Function for find all opciones de sub-menu de menu especifico
/*--------------------------------------------------------------*/
function find_all_submenu($table, $id_menu, $grupo_id) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT dm.det_menu_id, 
                                dm.descripcion, 
                                dm.observacion,
                                dm.pagina
                           FROM det_menu dm, usuario_menu um
                          WHERE dm.det_menu_id =  um.det_menu_id
                            and um.usu_menu_id = '{$db->escape($id_menu)}'
                            and um.grupo_id    = '{$db->escape($grupo_id)}'
                            and um.estado      = 1
                            and dm.estado      = 1 
                       order by dm.det_menu_id ");
   }
}

function find_all_submenu_perfil($table, $id_menu, $grupo_id) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT dm.det_menu_id, 
                                dm.descripcion, 
                                dm.observacion,
                                dm.pagina,
                                nvl(um.estado,0) as estado
                           FROM det_menu dm LEFT JOIN usuario_menu um
                             ON dm.det_menu_id =  um.det_menu_id
                            and um.usu_menu_id = '{$db->escape($id_menu)}'
                            and um.grupo_id    = '{$db->escape($grupo_id)}'
                       order by dm.det_menu_id ");
   }
}

function find_all_usuarios($table, $user) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT e.id_usuario as id, concat (u.name, ' ', u.last_name) as nombre
                          FROM ".$db->escape($table)." e INNER JOIN users u ON u.id = e.id_usuario WHERE e.estado = '1' ");
   }
}

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all_activos($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table)." where status = 1 ");
   }
}

function find_all_activos_estado($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table)." where estado = 1 ");
   }
}

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all_doc($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM users where user_level ='2'");
   }
}

function find_all_pacientes($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM users where user_level ='6' and status = 1");
   }
}

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all_consulta($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table));
   }
}
/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name and id
/*--------------------------------------------------------------*/
function find_by_fk($table, $condicion, $id) {
    global $db;
    if(tableExists($table))
    {
        return find_by_sql("SELECT * FROM {$db->escape($table)} WHERE '{$db->escape($condicion)}'='{$db->escape($id)}'");
    }
}
/*--------------------------------------------------------------*/
/* Function for Perform queries
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
 return $result_set;
}
/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}


function find_by_horario($table,$id_medico,$dia,$fecha)
{
    global $db;
    if(tableExists($table))
    {
        return find_by_sql("SELECT hm.* FROM {$db->escape($table)} hm, dias d WHERE hm.id_medico = '{$db->escape($id_medico)}' AND d.dias= '{$db->escape($dia)}' AND hm.id_dia = d.id AND hm.estado = 1 AND NOT EXISTS (SELECT * FROM agenda_medicos am WHERE am.id_horario_medico = hm.id AND am.fecha = '{$db->escape($fecha)}' )");
    }

}

function find_by_agenda($table,$id_medico,$fecha,$titulo)
{
    global $db;
    if(tableExists($table))
    {
        return find_by_sql("SELECT am.id_horario_medico, am.fecha, am.id_paciente, hm.id, hm.id_medico, h.hora_inicio, h.hora_fin FROM {$db->escape($table)} am, 
              horarios_medicos hm, 
              horarios h
        WHERE hm.id = am.id_horario_medico
          AND h.id = hm.id_horario
          AND hm.id_medico = '{$db->escape($id_medico)}'
          AND am.fecha = '{$db->escape($fecha)}'
          AND am.estado = 1
          AND hm.id_titulo =  '{$db->escape($titulo)}'
          AND am.id_paciente IS null");
    }

}
function find_by_detalle_solicitud($table,$id)
{
    global $db;
    if(tableExists($table))
    {
        return find_by_sql("SELECT  dp.id_producto, dp.cantidad, dp.cantidad_despachada, dp.precio FROM detalle_procedimiento dp WHERE dp.id_solicitud_materiales = '{$db->escape($id)}'");
    }

}

function find_by_detalle_solicitud_compra($table,$id)
{
    global $db;
    if(tableExists($table))
    {
        return find_by_sql("SELECT ds.id_producto, ds.cantidad, ds.precio FROM detalle_solicitud_compra ds WHERE ds.id_solicitud_compra ='{$db->escape($id)}'");
    }

}


function find_by_datos_producto($table,$id)
{
    global $db;
    if(tableExists($table))
    {
        return find_by_sql("SELECT id, nombre, descripcion, id_tipomedida, factor, factor_minimo, stock, stock_minimo, precio, estado FROM productos p where id = '{$db->escape($id)}'");
    }

}


function find_by_total_solicitud($table,$id)
{
    global $db;
    if(tableExists($table))
    {
        return find_by_sql("SELECT (dp.cantidad_despachada*dp.precio) as total FROM detalle_procedimiento dp where id = '{$db->escape($id)}'");
    }

}

function Finaliza_by_tarea($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "UPDATE  ".$db->escape($table);
    $sql .= " SET estado = 3 WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}

function find_by_evento($table,$id)
{
    global $db;
    if(tableExists($table))
    {
        return find_by_sql("SELECT am.id, am.motivo as title, am.fecha as start, am.fecha as end, am.color FROM {$db->escape($table)} am, horarios_medicos hm, horarios h
         WHERE hm.id = am.id_horario_medico
          AND h.id = hm.id_horario
          AND hm.id_medico = '{$db->escape($id)}'
          AND am.estado = 1
          AND am.id_paciente IS not null");
    }

}

/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id_contenido($table,$id_contenido,$id_user)
{
  global $db;
  $id_contenido = (int)$id_contenido;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id_contenido='{$db->escape($id_contenido)}' and id_user = '{$db->escape($id_user)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id_user($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT id, username, password, name, last_name, concat(name, ' ', last_name) as nombre_completo, ci, mail, user_level, creation_date, status, last_login, image, start_date, end_date, phone, movil FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_usuario($table,$usuario,$cedula)
{
  global $db;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} 
                                      WHERE (username='{$db->escape($usuario)}' 
                                        OR ci = '{$db->escape($cedula)}') LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return 1;
          else
            return 0;
     }
}

/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_tiene_paquete($table,$id_paciente,$id_horario_medico)
{
  global $db;
    if(tableExists($table)){
          $sql = $db->query("SELECT dpc.id
                              FROM paquete_x_cliente pc, 
                                   det_paquete_cliente dpc 
                             WHERE dpc.id_paquete_cliente = pc.id 
                               AND pc.id_cliente = '{$db->escape($id_paciente)}'
                               AND pc.estado     = '1' 
                               AND pc.pagado     = 'S' 
                               AND pc.consumido  = 'N'
                               AND dpc.tipo      = 'C' 
                               AND dpc.id_padre  = (SELECT hm.id_titulo 
                                                     FROM horarios_medicos hm 
                                                    WHERE hm.id = 
                                                    '{$db->escape($id_horario_medico)}')
                               AND dpc.consumido = 'N'
                               LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return 0;
     }
}


/*--------------------------------------------------------------*/
  /* Find mail
  /*--------------------------------------------------------------*/
  function find_by_mail($user)
  {
    global $db;
    $sql = "SELECT email FROM users WHERE username = '{$db->escape($user)}' LIMIT 1 ";
    $result = $db->query($sql);
    return $result;
  }

/*--------------------------------------------------------------*/
/* Function for Delete data from table by id
/*--------------------------------------------------------------*/
function delete_by_id($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}

function delete_by_id_estado($table,$condicion)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "UPDATE  ".$db->escape($table);
    $sql .= " SET estado = 0 WHERE ". $db->escape($condicion);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
function rechaza_prorroga($table,$condicion)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "UPDATE  ".$db->escape($table);
    $sql .= " SET estado = 0 WHERE ". $db->escape($condicion);
    $sql .= " LIMIT 1";
    $db->query($sql);    
    return ($db->affected_rows() === 1) ? true : false;
   }
}
function Activa_by_id_estado($table,$condicion)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "UPDATE  ".$db->escape($table);
    $sql .= " SET estado = 1 WHERE id=". $db->escape($condicion);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}

function Aprueba_prorroga($table,$condicion)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "UPDATE  ".$db->escape($table);
    $sql .= " SET estado = 2 WHERE ". $db->escape($condicion);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}

function Recep_by_id_estado($table,$condicion)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "UPDATE  ".$db->escape($table);
    $sql .= " SET estado = 3 WHERE ". $db->escape($condicion);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
function Actualiza_by_id_estado($table,$condicion,$estado,$total)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "UPDATE  ".$db->escape($table);
    $sql .= " SET estado = ". $db->escape($estado).", total = ". $db->escape($total)." WHERE ". $db->escape($condicion);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
function Actualiza_by_id_estado_sc($table,$condicion,$estado)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "UPDATE  ".$db->escape($table);
    $sql .= " SET estado = ". $db->escape($estado)." WHERE ". $db->escape($condicion);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
function Actualiza_by_id_actualiza($table,$condicion)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "UPDATE  ".$db->escape($table);
    $sql .= " SET pagado = 'S' WHERE ". $db->escape($condicion);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
function Actualiza_by_id_finaliza($table,$condicion)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "UPDATE  ".$db->escape($table);
    $sql .= " SET estado = 3 WHERE ". $db->escape($condicion);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
function Actualiza_by_estado($table,$condicion)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "UPDATE  ".$db->escape($table);
    $sql .= " SET estado = 2 WHERE ". $db->escape($condicion);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
/*--------------------------------------------------------------*/
/* Function for Count id  By table name
/*--------------------------------------------------------------*/

function count_by_id($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table){
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
      if($table_exit) {
        if($db->num_rows($table_exit) > 0)
              return true;
         else
              return false;
      }
  }
 /*--------------------------------------------------------------*/
 /* Login with the data provided in $_POST,
 /* coming from the login form.
/*--------------------------------------------------------------*/
function authenticate($username='', $password='') {
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE status='1' and username ='%s' LIMIT 1", $username);
    $result = $db->query($sql);
    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      $password_request = sha1($password);
      if($password_request === $user['password'] ){
        return $user['id'];
      }
    }
   return false;
  }

/*--------------------------------------------------------------*/
 /* Login with the data provided in $_POST,
 /* coming from the login form.
/*--------------------------------------------------------------*/
  function authenticateV3($email='', $password='') {
    global $db;
    $email = $db->escape($email);
    $password = $db->escape($password);
    $sql  = sprintf("SELECT usuario_id,mail,clave,estado,tipo_usuario_id FROM usuarios WHERE estado='A' and mail ='%s' LIMIT 1", $email);
    $result = $db->query($sql);
    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      $password_request = md5($password);
      if($password_request === $user['clave'] ){
        return $user['usuario_id'];
      }
    }
   return false;
  }
  /*--------------------------------------------------------------*/
  /* Login with the data provided in $_POST,
  /* coming from the login_v2.php form.
  /* If you used this method then remove authenticate function.
 /*--------------------------------------------------------------*/
   function authenticate_v2($username='', $password='') {
     global $db;
     $username = $db->escape($username);
     $password = $db->escape($password);
     $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
     $result = $db->query($sql);
     if($db->num_rows($result)){
       $user = $db->fetch_assoc($result);
       $password_request = sha1($password);
       if($password_request === $user['password'] ){
         return $user;
       }
     }
    return false;
   }


  /*--------------------------------------------------------------*/
  /* Find current log in user by session id
  /*--------------------------------------------------------------*/
  function current_user(){
      static $current_user;
      global $db;
      if(!$current_user){
         if(isset($_SESSION['user_id'])):
             $user_id = intval($_SESSION['user_id']);
             $current_user = find_by_id('users',$user_id);
        endif;
      }
    return $current_user;
  }
  /*--------------------------------------------------------------*/
  /* Find all user by
  /* Joining users table and user gropus table
  /*--------------------------------------------------------------*/
  function find_all_user(){
      global $db;
      $results = array();
      $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,";
      $sql .="g.group_name ";
      $sql .="FROM users u ";
      $sql .="LEFT JOIN user_groups g ";
      $sql .="ON g.group_level=u.user_level ORDER BY u.name ASC";
      $result = find_by_sql($sql);
      return $result;
  }

  function find_all_colaboradores_todos($table,$id) {
   $datos_usuario=find_by_id('users',$id);
   if (!empty($datos_usuario)){
     $division = $datos_usuario['division'];
   }
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT e.id as id, concat (e.name, ' ', e.last_name) as nombre 
                           FROM ".$db->escape($table)." e WHERE e.status = '1'
                            and e.division = ".$db->escape($division));
   }
}


  /*--------------------------------------------------------------*/
  /* Find all Group name
  /*--------------------------------------------------------------*/
  function find_by_groupName($val)
  {
    global $db;
    $sql = "SELECT group_name FROM user_groups WHERE group_name = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }

  /*--------------------------------------------------------------*/
  /* valida usuario
  /*--------------------------------------------------------------*/
  function find_by_user($table, $val)
  {

    global $db;
    if(tableExists($table))
    {
      return find_by_sql("SELECT concat(name,' ',last_name) nombres FROM users where id = '{$db->escape($val)}' LIMIT 1 ");
    }

  }
  /*--------------------------------------------------------------*/
  /* valida usuario
  /*--------------------------------------------------------------*/
  function find_by_username($table, $val)
  {

    global $db;
    if(tableExists($table))
    {
      return find_by_sql("SELECT concat(name,' ',last_name) nombres FROM users where username = '{$db->escape($val)}' LIMIT 1 ");
    }

  }
  /*--------------------------------------------------------------*/
  /* Find group level
  /*--------------------------------------------------------------*/
  function find_by_groupLevel($level)
  {
    global $db;
    $sql = "SELECT group_level FROM user_groups WHERE group_level = '{$db->escape($level)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }

  /*--------------------------------------------------------------*/
  /* Function for cheaking which user level has access to page
  /*--------------------------------------------------------------*/
   function page_require_level($require_level){
     global $session;
     $current_user = current_user();
     $login_level = find_by_groupLevel($current_user['user_level']);
     //if user not login
     if (!$session->isUserLoggedIn(true)):
            $session->msg('d','Por favor Iniciar sesión...');
            redirect('index.php', false);
      //if Group status Deactive
     //elseif ($login_level['group_status']):
           //$session->msg('d','Este nivel de usuario esta inactivo!');
           //redirect('home.php',false);
      //cheackin log in User level and Require level is Less than or equal to
     elseif($current_user['user_level'] <= (int)$require_level):
              return true;
      else:
            $session->msg("d", "¡Lo siento!  no tienes permiso para ver la página.");
            redirect('home.php', false);
        endif;

     }

function find_all_course($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("select c.id_categoria, t.descripcion as categoria, 
                                o.id, c.descripcion as product_name, o.precio as product_price, 
                                c.imagen as product_image, concat(u.name,' ',u.last_name) as docente, 
                                o.fecha_inicio, o.fecha_fin, o.id_docente 
                           from ".$db->escape($table).
                                " c , curso_oferta o, categoria t, users u 
                          where o.id_curso = c.id 
                            and t.id = c.id_categoria 
                            and u.id = o.id_docente and  o.maximo_estudiantes > (select count(*) from estudiante_curso e where e.id_curso = o.id ) 
                            and now() <= o.fecha_inicio and o.estado = 1 ");
                            //and CURRENT_DATE() BETWEEN o.fecha_inicio and o.fecha_fin");
   }
}

function find_by_id_course($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("select c.id_categoria, t.descripcion as categoria, 
                                o.id, c.descripcion as product_name, c.objetivo, o.precio as product_price, 
                                c.imagen as product_image, c.duracion, concat(u.name,' ',u.last_name) as docente, 
                                o.fecha_inicio, o.fecha_fin 
                           from ".$db->escape($table).
                                " c , curso_oferta o, categoria t, users u 
                          where o.id_curso = c.id 
                            and t.id = c.id_categoria 
                            and u.id = o.id_docente 
                            and o.id = '{$db->escape($id)}'");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

function find_all_capitulos($table,$id) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table)." WHERE id_curso='{$db->escape($id)}' and estado = 1 ");
   }
}

function find_all_contenido($table,$id) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table)." WHERE id_capitulo='{$db->escape($id)}' and estado = 1");
   }
}

function find_all_mecourse($table, $user) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("select c.id_categoria, t.descripcion as categoria, 
                                o.id, c.descripcion as product_name, o.precio as product_price, 
                                c.imagen as product_image, concat(u.name,' ',u.last_name) as docente, 
                                o.fecha_inicio, o.fecha_fin, o.id_docente 
                           from curso c , curso_oferta o, categoria t, users u, ".$db->escape($table)." e, pagos p  
                          where o.id_curso = c.id
                            and o.estado = 1 
                            and t.id = c.id_categoria 
                            and u.id = o.id_docente
                            and e.id_curso = o.id
                            and e.id_user = '{$db->escape($user)}' 
                            and e.estado= 1
                            and p.id_user = e.id_user
                            and p.id_curso = e.id_curso
                            and p.fecha_pago is NOT null
                            and now() <= o.fecha_inicio ");
   }
}
function find_all_evaluaciones($table,$id) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table)." WHERE id_curso='{$db->escape($id)}' and estado = 1 ");
   }
}
function find_by_count_contenidos($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT COUNT(*) as cantidad FROM ".$db->escape($table)." WHERE id_capitulo='{$db->escape($id)}' and estado = 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return 0;
     }
}

function find_all_titulos($table,$id) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT t.id_titulo, t.descripcion, td.id_titulo_docente, td.codigo_senescyt, ".
                        " td.fecha_incorporacion, td.fecha_registro_senecyt, td.imagen FROM ".$db->escape($table).
                        " td, titulos t WHERE t.id_titulo = td.id_titulo and td.id_usuario='{$db->escape($id)}' ");
   }
}

function find_all_preguntas($table,$id) {
   global $db;
   if(tableExists($table))
   {
    return find_by_sql("select c.descripcion, p.id, p.numero_pregunta, p.pregunta from ".$db->escape($table).
                       " c, evaluacion_preguntas p ".
                       " where c.id = '{$db->escape($id)}'". 
                       " and c.estado =1 and p.id_evaluacion = c.id and  p.estado = 1 ");
   }
}
function find_all_respuestas($table,$id) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("select r.descripcion, r.valida from "
      .$db->escape($table)." p, evaluacion_respuestas r where p.id = '{$db->escape($id)}' and r.id_pregunta = p.id and r.estado = 1");
   }
}

function find_all_curso_est($table, $id_user) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT DISTINCT ec.id_curso,
                                c.descripcion
                           FROM ".$db->escape($table)." ec,
                                curso_oferta co,
                                curso c
                          WHERE co.id = ec.id_curso
                            AND c.id  = co.id_curso
                            AND (ec.id_user ='{$db->escape($id_user)}' OR '{$db->escape($id_user)}' = 1)");
   }
}

function insertar_evaluacion($user_id, $id_evaluacion){
    global $db;
    $sql = "insert into evaluacion_estudiante ";
    $sql = $sql . " (select '{$user_id}', now(), c.id_curso, c.id as id_evaluacion, ";
    $sql = $sql . " p.id as id_pregunta, p.numero_pregunta, p.pregunta,  ";
    $sql = $sql . " r.id as id_respuesta, r.descripcion, r.valida, 'NO', null ";
    $sql = $sql . " from contenido_curso c, evaluacion_preguntas p, evaluacion_respuestas r";
    $sql = $sql . " where c.id = '{$id_evaluacion}' and c.estado =1 and p.id_evaluacion = c.id ";
    $sql = $sql . " and p.estado = 1 and r.id_pregunta = p.id and r.estado = 1 ";
    $sql = $sql . " and not exists (select * from evaluacion_estudiante e where e.id_user = '{$user_id}' and e.id_evaluacion = '{$id_evaluacion}')) ";
    $result = $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
}

function insertar_actividades($user_id, $id_curso){
    global $db;
    $sql = "INSERT INTO actividades_curso_estudiante ";
    $sql = $sql . " (select '{$user_id}', id_curso_oferta, id, descripcion, fecha_maxima, null, now(), null, 0 from actividades_curso ";
    $sql = $sql . " where id_curso_oferta = '{$id_curso}' and estado = 1 and not exists ";
    $sql = $sql . " (select * from actividades_curso_estudiante e where e.id_user = '{$user_id}' and e.id_curso_oferta = '{$id_curso}'))";
     $result = $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
}
   
function graba_respuesta($user_id, $id_evaluacion, $id_pregunta, $id_respuesta){
    global $db;
    $sql  = "update evaluacion_estudiante set respuesta_estudiante = 'SI' where id_user = '{$user_id}' ";
    $sql .= " and id_evaluacion ='{$id_evaluacion}' and id_pregunta = '{$id_pregunta}' and id_respuesta = '{$id_respuesta}' ";
    $result = $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
}

function valida_evaluacion($id_user, $id_curso, $id)
  {
    global $db;
    $sql = "SELECT * FROM estudiante_historial WHERE id_user = '{$id_user}' and id_curso_oferta = '{$id_curso}' and id_evaluacion = '{$id}'";
    $result = $db->query($sql);
    $cantidad = $db->num_rows($result);
    if ($cantidad===0){
        return(0);
    }else{
        return($cantidad);
    }
  }
function muestra_aciertos($id_user, $id_curso, $id)
  {
    global $db;
    $sql = "SELECT * FROM estudiante_historial WHERE id_user = '{$id_user}' and id_curso_oferta = '{$id_curso}' and id_evaluacion = '{$id}'";
    $result = $db->query($sql);
    return $result;
  }

function promedio($id_curso)
  {
    global $db;
    $sql1 = "SELECT * FROM contenido_curso WHERE id_curso = '{$id_curso}' and estado = 1 ";
    $result1 = $db->query($sql1);
    $cantidad_contenido = $db->num_rows($result1);

    $sql2 = "SELECT * FROM actividades_curso WHERE id_curso_oferta = '{$id_curso}' and estado = 1 ";
    $result2 = $db->query($sql2);
    $cantidad_actividades = $db->num_rows($result2);
    
    $cantidad = $cantidad_contenido + $cantidad_actividades;

    $lista = find_by_sql("SELECT ROUND(SUM(calificacion)/'{$cantidad}') as promedio, id_user FROM consolidado_estudiante WHERE id_curso ='{$id_curso}'");
    
    foreach   ($lista as $listado):
        $promedio   = $listado['promedio']; 
        $estudiante = $listado['id_user']; 
        $sql="UPDATE estudiante_curso set calificacion = '{$promedio}' , fecha_finalizacion= now() WHERE id_user = '{$estudiante}' and id_curso = '{$id_curso}'";
        $result = $db->query($sql);
    endforeach;
    
    $sql_finalizar = "UPDATE curso_oferta SET estado = 2 WHERE id = '{$id_curso}'";
    $result_finalizar = $db->query($sql_finalizar);
    if ($cantidad===0){
        return(0);
    }else{
        return($cantidad);
    }
  }

function find_all_evaluacion_estudiante($table,$id,$id_user) {
   global $db;
   if(tableExists($table))
   {
    return find_by_sql("SELECT id_pregunta, numero_pregunta, pregunta FROM ".$db->escape($table)." where id_user = '{$db->escape($id_user)}' and id_evaluacion = '{$db->escape($id)}' and respondida != 'SI' group by 1 LIMIT 1 ");
   }
}

function find_all_evaluacion_estudiante_preg($table,$id,$id_pregunta,$id_user) {
   global $db;
   if(tableExists($table))
   {
    return find_by_sql("SELECT id_pregunta, numero_pregunta, pregunta FROM ".$db->escape($table)." where id_user = '{$db->escape($id_user)}' and id_evaluacion = '{$db->escape($id)}' and id_pregunta = '{$id_pregunta}' group by 1");
   }
}

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all_respuestas_ev_est($table,$id,$id_pregunta,$id_user) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT id_respuesta, respuesta FROM "
      .$db->escape($table)." where id_user = '{$db->escape($id_user)}' and id_evaluacion = '{$db->escape($id)}' and id_pregunta = '{$db->escape($id_pregunta)}'");
   }
}

function find_all_curso_oferta($table, $id, $id_curso, $id_docente) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("select co.id, CONCAT(co.id, ' ', c.descripcion,' ', u.name, ' ', u.last_name) as descripcion from ".$db->escape($table)." co, curso c, users u where co.id_curso = '{$db->escape($id_curso)}' and u.id = co.id_docente and c.id = co.id_curso and co.id = '{$db->escape($id)}' and co.estado in (1,2)");
   }
}

?>
