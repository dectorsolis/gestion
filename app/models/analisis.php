<?php

	Class Analisis extends Db{

		public function create( $prospecto ){

			if( $this->select("SELECT 1 FROM auditoria_prospecto WHERE id_prospecto = " . $prospecto['id_prospecto']) )
				return false;
			else
			{
				$last_auditoria = $this->select("SELECT id_auditor FROM auditoria_prospecto 
													WHERE id_auditoria = 
														(SELECT MAX(id_auditoria) FROM auditoria_prospecto)");

				$id_last_auditoria = $last_auditoria ? $last_auditoria[0]['id_auditor'] : "''";

				
				$auditor = $this->select("SELECT id_empleado 
											FROM empleado 
											WHERE id_empleado > " . $id_last_auditoria . 
											" 	AND id_departamento IN(13,28,31) 
												ORDER BY id_empleado ASC LIMIT 1");			
				
				if( $auditor )
					$prospecto['id_auditor'] = $auditor[0]['id_empleado'];
				else
				{
					$auditor = $this->select("SELECT id_empleado 
												FROM empleado 
												WHERE id_empleado < " . $id_last_auditoria . 
												" 	AND id_departamento IN(13,28,31) 
													ORDER BY id_empleado ASC LIMIT 1");		
					$prospecto['id_auditor'] = $auditor[0]['id_empleado'];				
				}

				$q = "INSERT INTO auditoria_prospecto(id_prospecto, created_at, id_auditor) VALUES(?,?,?)";
				$t = "isi";
				return $this->preparedQuery($q, $t, $prospecto);
			}
		}

	}