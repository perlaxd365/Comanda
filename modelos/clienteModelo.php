<?php 
	if ($peticionAjax) {
			require_once '../core/mainModel.php';
		}else{
			require_once './core/mainModel.php';
		}
	class clienteModelo extends mainModel{

		protected function agregar_cliente_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO Cliente(dni_cliente,nombres_cliente,apellido_paterno_cliente,
			apellido_materno_cliente,numero_cliente,direccion_cliente,correo_cliente,direccion_trabajo_cliente,estado_cliente) 
			VALUES (:dni_cliente,:nombres_cliente,:apellido_paterno_cliente,:apellido_materno_cliente,:numero_cliente,:direccion_cliente,
			:correo_cliente,:direccion_trabajo_cliente,'Activo')");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->bindParam(":dni_cliente",$datos['dni_cliente']);
			$sql->bindParam(":nombres_cliente",$datos['nombres_cliente']);
			$sql->bindParam(":apellido_paterno_cliente",$datos['apellido_paterno_cliente']);
			$sql->bindParam(":apellido_materno_cliente",$datos['apellido_materno_cliente']);
			$sql->bindParam(":numero_cliente",$datos['numero_cliente']);
			$sql->bindParam(":correo_cliente",$datos['correo_cliente']);
			$sql->bindParam(":direccion_cliente",$datos['direccion_cliente']);
			$sql->bindParam(":direccion_trabajo_cliente",$datos['direccion_trabajo_cliente']);
			$sql->execute();
			return $sql;
		}
		protected function actualizar_cliente_modelo($datos){
			$sql=mainModel::conectar()->prepare("UPDATE Cliente SET dni_cliente=:dni_cliente,
			nombres_cliente=:nombres_cliente,apellido_paterno_cliente=:apellido_paterno_cliente,
			numero_cliente=:numero_cliente,apellido_materno_cliente=:apellido_materno_cliente,correo_cliente=:correo_cliente,
			direccion_cliente=:direccion_cliente,direccion_trabajo_cliente=:direccion_trabajo_cliente WHERE id_cliente=:id_cliente");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->bindParam(":id_cliente",$datos['id_cliente']);
			$sql->bindParam(":dni_cliente",$datos['dni_cliente']);
			$sql->bindParam(":nombres_cliente",$datos['nombres_cliente']);
			$sql->bindParam(":apellido_paterno_cliente",$datos['apellido_paterno_cliente']);
			$sql->bindParam(":apellido_materno_cliente",$datos['apellido_materno_cliente']);
			$sql->bindParam(":numero_cliente",$datos['numero_cliente']);
			$sql->bindParam(":correo_cliente",$datos['correo_cliente']);
			$sql->bindParam(":direccion_cliente",$datos['direccion_cliente']);
			$sql->bindParam(":direccion_trabajo_cliente",$datos['direccion_trabajo_cliente']);
			$sql->execute();
			return $sql;
		}
		
		protected function data_cliente_modelo($id){
			$sql=mainModel::conectar()->prepare("SELECT * FROM Cliente WHERE id_cliente='$id'");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos
			$sql->execute();
			return $sql;
		}
		
		
		protected function eliminar_cliente_modelo($id){
			$sql=mainModel::conectar()->prepare("UPDATE Cliente SET estado_cliente='Inactivo' WHERE id_cliente='$id'");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos
			$sql->execute();
			return $sql;
		}
    }
