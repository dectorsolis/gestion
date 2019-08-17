 <?php 

	class Bitacora extends Db{

		public function get_cambios($id){
			if( $id != 0){
				return $this->select("	SELECT b.id, b.id_empleado, b.id_cliente, b.fecha, b.mensaje, e.nombre, e.ap_paterno, c.dominio 
										FROM bitacora b INNER JOIN empleado e ON e.id_empleado = b.id_empleado INNER JOIN cliente c ON c.id_cliente = b.id_cliente
										WHERE c.id_cliente = $id ORDER BY b.fecha ASC");
			}
		}
		
	}
?>