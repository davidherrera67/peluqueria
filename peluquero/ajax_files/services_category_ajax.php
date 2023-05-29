<?php include '../connect.php'; ?>
<?php include '../Includes/functions/functions.php'; ?>


<?php
	
	if(isset($_POST['accion']) && $_POST['accion'] == "Agregar")
	{
        $nombre_categoria = ajustar_texto_introducido($_POST['nombre_categoria']);
        $cuenta = buscarDato("nombre_categoria","services_category",$nombre_categoria);

        if($cuenta != 0)
        {
            $data['alerta'] = "Advertencia";
            $data['mensaje'] = "El nombre de esta categoria ya existe";
            echo json_encode($data);
            exit();
        }
        elseif($cuenta == 0)
        {
            $stmt = $con->prepare("insert into services_category(nombre_categoria) values(?) ");
            $stmt->execute(array($nombre_categoria));

            $data['alerta'] = "Exito";
            $data['mensaje'] = "La categoría ha sido insertada exitosamente en la base de datos de Peluquería dacor";
            echo json_encode($data);
            exit();
        }
            
	}

    if(isset($_POST['accion']) && $_POST['accion'] == "Borrar")
	{
        $id_categoria = $_POST['id_categoria'];
        
        try
        {
            $con->beginTransaction();

            $stmt_servicios = $con->prepare("select id from services where id_categoria = ?");
            $stmt_servicios->execute(array($id_categoria));
            $servicios = $stmt_servicios->fetchAll();
            $servicios_cuenta = $stmt_servicios->rowCount();

            if($servicios_cuenta > 0)
            {
                $stmt_servicio_sincategorizar = $con->prepare("select id_categoria from services_category where LOWER(nombre_categoria) = ?");
                $stmt_servicio_sincategorizar->execute(array("sincategorizar"));
                $sincategorizar_id = $stmt_servicio_sincategorizar->fetch();

                foreach($servicios as $service)
                {
                    $stmt_actualizar_servicio = $con->prepare("UPDATE services set id_categoria = ? where id = ?");
                    $stmt_actualizar_servicio->execute(array($sincategorizar_id["id_categoria"], $service["id"]));
                }
            }

            $stmt = $con->prepare("DELETE from services_category where id_categoria = ?");
            $stmt->execute(array($id_categoria));
            $con->commit();

            $data['alerta'] = "Exito";
            $data['mensaje'] = "La categoría ha sido eliminada exitosamente de la base de datos de la peluquería dacor";
            
            echo json_encode($data);
            exit();
            
        }
        catch(Exception $exp)
        {
            echo $exp->getMessage() ;
            $con->rollBack();
            
            $data['alerta'] = "Advertencia";
            $data['mensaje'] =  $exp->getMessage() ;
            
            echo json_encode($data);
            exit();
        }

    }
    
    if(isset($_POST['accion']) && $_POST['accion'] == "Editar")
	{
        $id_categoria = $_POST['id_categoria'];
        $nombre_categoria = ajustar_texto_introducido($_POST['nombre_categoria']);
        $cuenta = buscarDato("nombre_categoria","services_category",$nombre_categoria);

        if($cuenta != 0)
        {
            $data['alerta'] = "Advertencia";
            $data['mensaje'] = "Este nombre de categoria ya está registrado en la base de datos";
            
            echo json_encode($data);
            exit();
        }
        elseif($cuenta == 0)
        {

            try
            {
                $stmt = $con->prepare("UPDATE services_category set nombre_categoria = ? where id_categoria = ?");
                $stmt->execute(array($nombre_categoria, $id_categoria));

                $data['alerta'] = "Exito";
                $data['mensaje'] = "La categoría ha sido actualizada";
                
                echo json_encode($data);
                exit();
            }   
            catch(Exception $e)
            {
                $data['alerta'] = "Advertencia";
                $data['mensaje'] = $e->getMessage();
                
                echo json_encode($data);
                exit();
            }

            
        }
    }
	
?>