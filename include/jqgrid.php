<?php
trait jqgrid {

	function DataTable($id=false){
	 	try{
		 	$post=$_POST;
			$post['id']=$id;
			$data = $this->DataTableView($post,$this->modelo);
			echo json_encode($data);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}
	}

	 function DataTableEdit($idTable=false){
 		try{
			$datos = $_POST;
			if (array_key_exists('id',$datos)){
				if ($datos['id']=="_empty"){
					$id="0";
				}else{
					$id = $datos['id'];	
				}
			}else{
				$id = $datos[$idTable];
			}
			$params=array('id'=>$id,'operacion'=>$datos['oper'],'datos'=>$datos);
			$resultado = $this->modelo->cudData($params);
			echo json_encode($resultado);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}
	}	

	function DataTableView($get,$modelo,$editar=true){
		try{		
			$page =  $get['page']; // get the requested page
			$limit = $get['rows']; // get how many rows we want to have into the grid
			$sidx =  $get['sidx']; // get index row - i.e. user click to sort
			$sord =  $get['sord']; // get the direction
			$id  = $get['id'];
			$searchOn = filter_var($get['_search'], FILTER_VALIDATE_BOOLEAN);
			$where = "";
			if ($searchOn){
				$searchstr = $get['filters'];
				$where = $searchOn;
				$where = $this->constructWhere($searchstr);
			}else{
				$where = 'X';
			}

			if(!$sidx){$sidx = 'asc';}
			
			if($sidx){$orden = $sidx.' '.$sord;}
			
			$post=array();
			$post['tabla']=$modelo->tabla;
			$post['page']=$page;
			$post['limit']=$limit;
			$post['orden']=$orden;
			$post['condicion']=$where;
			
			$resultado = $modelo->datosJQGrid($post);
			
			if($resultado['status']=='ok'){
				$count = $resultado['data']['total'];
				$rows = $resultado['data']['registros'];
				
				if( $count >0 ) {
					$total_pages = ceil($count/$limit);
				} else {
					$total_pages = 0; 
				}
				if ($page > $total_pages){
					$page=$total_pages;
				}

				$response = new stdClass();
				$response->page = $page;
				$response->total = $total_pages;
				$response->records = $count;
				$i=0;
				     
				foreach($rows as $row){
					$response->rows[$i]['id'] = $row[$id];
					if ($editar){
						$response->rows[$i]['cell'][] = null;				
					}
					foreach ($row as $clave=>$element){
						$response->rows[$i]['cell'][] = $element;
					}
					$i++;
				}
				return $response;					
			}else{
				
			}
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}			
	}


	function constructWhere($s){
		try{	
			$qwery = "";
			//['eq','ne','lt','le','gt','ge','bw','bn','in','ni','ew','en','cn','nc']
			$qopers = array(
						  'eq'=>" = ",
						  'ne'=>" <> ",
						  'lt'=>" < ",
						  'le'=>" <= ",
						  'gt'=>" > ",
						  'ge'=>" >= ",
						  'bw'=>" LIKE ",
						  'bn'=>" NOT LIKE ",
						  'in'=>" IN ",
						  'ni'=>" NOT IN ",
						  'ew'=>" LIKE ",
						  'en'=>" NOT LIKE ",
						  'cn'=>" LIKE " ,
						  'nc'=>" NOT LIKE " );
			if ($s) {
				$jsona = json_decode($s,true);
				if(is_array($jsona)){
					$gopr = $jsona['groupOp'];
					$rules = $jsona['rules'];
					$i =0;
					foreach($rules as $key=>$val) {
						$field = $val['field'];
						if (strpos($field,'fecha')!==false){
							$field="date($field)";
						}										

						$op = $val['op'];
						$v = $val['data'];
						$d = $val['data'];
						if($v && $op) {
							$i++;
							if($op=='bw' || $op=='bn') $v = "'" . $v . "%'";
							else if ($op=='ew' || $op=='en') $v= "'%" . $v . "'";
							else if ($op=='cn' || $op=='nc') $v= "'%" . $v . "%'";
							else $v= "'" . $v . "'";
							
							if (is_numeric($d)){
								$v = str_replace("'","",$v);
							}
							if ($i == 1) $qwery = " ";
							else $qwery .= " " .$gopr." ";
							switch ($op) {
								// in need other thing
								case 'in' :
								case 'ni' :
									$qwery .= $field.$qopers[$op]." (".$v.")";
									break;
								default:
									$qwery .= $field.$qopers[$op].$v;
							}
						}
					}
				}
			}
			return $qwery;
		
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}			
	}	
	
}

	
?>
