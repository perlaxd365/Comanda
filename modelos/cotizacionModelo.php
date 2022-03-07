<?php 
	if ($peticionAjax) {
			require_once '../core/mainModel.php';
		}else{
			require_once './core/mainModel.php';
		}
	class cotizacionModelo extends mainModel{

		protected function agregar_cotizacion_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO Cotizacion (id_cotizacion,id_usuario,id_cliente,
            direccion_servicio_cotizacion,fecha_emision_cot,fecha_limite_cot,estado_cot) 
			VALUES (:id_cotizacion,:id_usuario,:id_cliente,:direccion_servicio_cotizacion,:fecha_emision_cot,:fecha_limite_cot,'Pendiente')");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->bindParam(":id_cotizacion",$datos['id_cotizacion']);
			$sql->bindParam(":id_usuario",$datos['id_usuario']);
			$sql->bindParam(":id_cliente",$datos['id_cliente']);
			$sql->bindParam(":direccion_servicio_cotizacion",$datos['direccion_servicio_cotizacion']);
			$sql->bindParam(":fecha_emision_cot",$datos['fecha_emision_cot']);
			$sql->bindParam(":fecha_limite_cot",$datos['fecha_limite_cot']);
			$sql->execute();
			return $sql;
		}
		
		protected function agregar_detalle_cotizacion_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO DetalleServicio(id_cotizacion,descripcion_detalle,
            cantidad_detalle,unidad_detalle,precio_detalle,piso_detalle) 
			VALUES (:id_cotizacion,:descripcion_detalle,:cantidad_detalle,:unidad_detalle,:precio_detalle,:piso_detalle)");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->bindParam(":id_cotizacion",$datos['id_cotizacion']);
			$sql->bindParam(":descripcion_detalle",$datos['descripcion_detalle']);
			$sql->bindParam(":cantidad_detalle",$datos['cantidad_detalle']);
			$sql->bindParam(":unidad_detalle",$datos['unidad_detalle']);
			$sql->bindParam(":precio_detalle",$datos['precio_detalle']);
			$sql->bindParam(":piso_detalle",$datos['piso_detalle']);
			$sql->execute();
			return $sql;
		}
		 
		protected function eliminar_cotizacion_modelo($id){
			$sql=mainModel::conectar()->prepare("DELETE FROM DetalleServicio WHERE id_cotizacion='$id';
												DELETE FROM Cotizacion WHERE id_cotizacion='$id';");
			$sql->execute();
			return $sql;
		}

    }


?>