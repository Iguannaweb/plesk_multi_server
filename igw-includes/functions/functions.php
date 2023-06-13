<?php
# Listado de Servidores
function igw_plesk_server_list($datos, $servidor=''){
	if($servidor==""){ $servidor="9999"; }
	foreach($datos as $k=>$s){
		echo '<li class="nav-item">
			<a href="index.php?go=servidores&serv='.$k.'" class="nav-link '; 
			if($servidor==$k){ echo 'active'; }
			echo '">
			  <i class="far fa-circle nav-icon"></i>
			  <p>'.$s[0].'</p>
			</a>
		  </li>';
	}	
}

# Listado de Servidores tabla
function igw_plesk_server_list_table($datos,$server_id=''){
	if($server_id!=""){
		$data = unserialize(file_get_contents('./igw-content/data/server/server'.$server_id.'.data'));
		$datadomains = unserialize(file_get_contents('./igw-content/data/domains/domains'.$server_id.'.data'));
		$dataclients = unserialize(file_get_contents('./igw-content/data/clients/clients'.$server_id.'.data'));
		$datastatus = unserialize(file_get_contents('./igw-content/data/status/status'.$server_id.'.data'));
	}else{
		$data = unserialize(file_get_contents('./igw-content/data/server/server.data'));
	}
	
	//echo '<pre>';print_r($data);echo '</pre>';
	
	/*usort($data, function($a1, $a2) {
	   $v1 = strtotime($a1['panel_update_version']);
	   $v2 = strtotime($a2['panel_update_version']);
	   return $v1 - $v2; // $v2 - $v1 to reverse direction
	});*/
	
	$tabla = '<table class="table table-hover text-nowrap">
	  <thead>
		<tr>
		  <th>ID</th>
		  <th>Servidor</th>
		  <th>Sistema</th>
		  <th>Host</th>
		  <th>Plesk version</th>
		  <th>Actualización</th>	  
		  <th>Dominios</th>
		  <th>Subdominios</th>
		  <th>Clientes</th>
		  <th>Fecha</th>
		</tr>
	  </thead>
	  <tbody>';
	if($server_id!=""){
		foreach($datos as $k=>$s){
			if(($server_id!="") && ($server_id==$k)){
				
				$server_data=@json_decode($data,true);
				//echo '<pre>';print_r($server_data);echo '</pre>';
				$tabla .= '<tr>';
				$tabla .= '<td><a href="index.php?go=servidores&serv='.$k.'">'.$k.'</a></td>';
				$tabla .= '<td><span class="badge badge-primary"><a style="color: #ffffff;" target="_blank" href="https://'.$s[1].':8443">'.$s[0].'</a></span></td>';
				if(!empty($server_data['platform'])){ $tabla .= '<td><span class="badge badge-danger">'.$server_data['platform'].'</span></td>'; }
				if(!empty($server_data['hostname'])){ $tabla .= '<td>'.$server_data['hostname'].'</td>'; }
				if(!empty($server_data['panel_version'])){ $tabla .= '<td><span class="badge badge-warning">'.$server_data['panel_version'].'</span></td>'; }
				if(!empty($server_data['panel_update_version'])){ $tabla .= '<td>'.$server_data['panel_update_version'].'</td>'; }
				
				$tabla .= '<td>'.count_domains($k,'d').'</td>';
				$tabla .= '<td>'.count_domains($k,'s').'</td>';
				$tabla .= '<td>'.count_clients($k).'</td>';
				if(!empty($server_data['panel_build_date'])){ $tabla .= '<td>'.$server_data['panel_build_date'].'</td>'; }
				$tabla .= '</tr>';
			
			}
		}
	}else{
		foreach($datos as $k=>$s){
			
				$server_data=@json_decode($data[$k],true);
				//echo '<pre>';print_r($server_data);echo '</pre>';
				$tabla .= '<tr>';
				$tabla .= '<td><a href="index.php?go=servidores&serv='.$k.'">'.$k.'</a></td>';
				$tabla .= '<td><span class="badge badge-primary"><a style="color: #ffffff;" target="_blank" href="https://'.$s[1].':8443">'.$s[0].'</a></span></td>';
				if(!empty($server_data['platform'])){ $tabla .= '<td><span class="badge badge-danger">'.$server_data['platform'].'</span></td>'; }
				if(!empty($server_data['hostname'])){ $tabla .= '<td>'.$server_data['hostname'].'</td>'; }
				if(!empty($server_data['panel_version'])){ $tabla .= '<td><span class="badge badge-warning">'.$server_data['panel_version'].'</span></td>'; }
				if(!empty($server_data['panel_update_version'])){ $tabla .= '<td>'.$server_data['panel_update_version'].'</td>'; }
				
				$tabla .= '<td>'.count_domains($k,'d').'</td>';
				$tabla .= '<td>'.count_domains($k,'s').'</td>';
				$tabla .= '<td>'.count_clients($k).'</td>';
				if(!empty($server_data['panel_build_date'])){ $tabla .= '<td>'.$server_data['panel_build_date'].'</td>'; }
				$tabla .= '</tr>';
				
				
			
		}
	}
	$tabla .='</tbody>
	</table>';
	
	return $tabla;
}

# Listado de Servidores tabla
function igw_plesk_server_totals($datos){
	$data = unserialize(file_get_contents('./igw-content/data/server/server.data'));
	$total_domains=0;
	$total_subdomains=0;
	$total_clients=0;
	foreach($datos as $k=>$s){
		$server_data=@json_decode($data[$k],true);

		$total_domains=$total_domains+count_domains($k,'d');
		$total_subdomains=$total_subdomains+count_domains($k,'s');
		$total_clients=$total_clients+count_clients($k);
	
	}
	
	return count($data).'|'.$total_domains.'|'.$total_subdomains.'|'.$total_clients;
}

# listado datos individuales
function igw_plesk_server_details($datos,$server_id,$type){
	if($server_id!=""){
		if($type=='server'){ $dataserver = json_decode(unserialize(file_get_contents('./igw-content/data/server/server'.$server_id.'.data')),true); $listadodatos=$dataserver; }
		elseif($type=='domains'){ $datadomains = json_decode(unserialize(file_get_contents('./igw-content/data/domains/domains'.$server_id.'.data')),true); $listadodatos=$datadomains; }
		elseif($type=='clients'){ $dataclients = json_decode(unserialize(file_get_contents('./igw-content/data/clients/clients'.$server_id.'.data')),true); $listadodatos=$dataclients; }
		elseif($type=='status'){ $datastatus = unserialize(unserialize(file_get_contents('./igw-content/data/status/status'.$server_id.'.data'))); $listadodatos_pre=$datastatus; 
		$listadodatos_preb = new SimpleXMLElement($listadodatos_pre);
		$listadodatos=$listadodatos_preb->server->get->result->services_state->srv;
		}
	}
	//echo '<pre>';print_r($listadodatos);echo '</pre>';
	$tabla = '<table class="table table-hover text-nowrap">
	  <thead>
		<tr>
		  <th>Propiedad</th>
		  <th>Valor</th>
		</tr>
	  </thead>
	  <tbody>';
		if($type=='server'){
			foreach($listadodatos as $k=>$ld){
				$tabla .=  '<tr>
		  		<td>'.$k.'</td>
		  		<td>'.$ld.'</td>
				</tr>';
			}
		}elseif($type=='domains'){
			foreach($listadodatos as $k=>$ld){
				$tabla .=  '<tr>
				  <td>'.$ld["created"].'</td>
				  <td>'.$ld["name"].'</td>
				</tr>';
			}
		}elseif($type=='clients'){
			foreach($listadodatos as $k=>$ld){
				$tabla .=  '<tr>
				  <td>'.$ld["created"].'</td>
				  <td>'.$ld["name"].'</td>
				</tr>';
			}
		}elseif($type=='status'){
			foreach($listadodatos as $ld){
				//echo '<pre>';print_r($ld);echo '</pre>';
				$tabla .=  '<tr>
				  <td>'.$ld->title.'</td>
				  <td>'; 
				if($ld->state=="running"){ $tabla.=  '<span class="badge badge-success"><i class="fas fa-check"></i> '.$ld->state.'</span>'; } 
				elseif($ld->state=="none"){ $tabla.=  '<span class="badge badge-danger"><i class="fas fa-times"></i> '.$ld->state.'</span>'; }
				else{ $tabla.=  '<span class="badge badge-primary">'.$ld->state.'</span>'; }
				$tabla.= '</td>
				</tr>';
			}
		}
		
	  $tabla .=  '</tbody>
	</table>';
	return $tabla;
}

# Cuenta dominios
function count_domains($server_id,$type="d"){
	$i=0;
	$s=0;
	$data = unserialize(file_get_contents('./igw-content/data/domains/domains'.$server_id.'.data'));
	//echo '<pre>';print_r($data);echo '</pre>';
	$datadomains = json_decode($data,true);
	//echo '<pre>';print_r($datadomains);echo '</pre>';
	foreach($datadomains as $domains){
		$count_subdomains=count(explode('.',$domains["ascii_name"]));
		//echo $count_subdomains.'<br>';
		if($count_subdomains>=3){
			$s++;
		}else{
			$i++;
		}
	}
	if($type=="d"){
		return $i;
	}else{
		return $s;
	}
}

# Cuenta clientes
function count_clients($server_id){
	$data = unserialize(file_get_contents('./igw-content/data/clients/clients'.$server_id.'.data'));
	//echo '<pre>';print_r($data);echo '</pre>';
	$dataclients = json_decode($data,true);
	//echo '<pre>';print_r($dataclients);echo '</pre>';
	return count($dataclients);
	
}

#Service status
function service_status($data,$type='status',$request='',$server_id=''){
	$i=0;
	if($server_id!=""){
		$client = new PleskApiClient($data[$server_id][1]);
			$client->setCredentials($data[$server_id][2], $data[$server_id][3]);
			
$request = <<<EOF
<packet>
<server>
<get>
<services_state/>
</get>
</server>
</packet>
EOF;
			
			$response = $client->request($request);
			
			$responsearray[$server_id]=serialize($response);
			file_put_contents('./igw-content/data/'.$type.'/'.$type.''.$server_id.'.data', serialize($responsearray[$server_id]));
			$i++;
			
	}else{
		foreach($data as $dato){
			$client = new PleskApiClient($dato[1]);
			$client->setCredentials($dato[2], $dato[3]);
			
$request = <<<EOF
<packet>
<server>
<get>
<services_state/>
</get>
</server>
</packet>
EOF;
			
			$response = $client->request($request);
			
			$responsearray[$i]=serialize($response);
		
			file_put_contents('./igw-content/data/'.$type.'/'.$type.''.$i.'.data', serialize($responsearray[$i]));
			$i++;
			}
		file_put_contents('./igw-content/data/'.$type.'/'.$type.''.$server_id.'.data', serialize($responsearray));
	}
	
}

# Datos de servidores
function igw_plesk_server_info($datos,$type="server",$server_id=""){
	$i=0;
	if($server_id!=""){
		$ch = curl_init('https://'.$datos[$server_id][1].':8443/api/v2/'.$type.'');
		//curl_setopt($ch, CURLOPT_URL,$URL);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, "".$datos[$server_id][2].":".$datos[$server_id][3]."");
		$result[$server_id]=curl_exec($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
		curl_close ($ch);
		file_put_contents('./igw-content/data/'.$type.'/'.$type.''.$server_id.'.data', serialize($result[$server_id]));
	}else{
		foreach($datos as $dato){
			//echo '<pre>';print_r($dato);echo '</pre>';
	
			$ch = curl_init('https://'.$dato[1].':8443/api/v2/'.$type.'');
			//curl_setopt($ch, CURLOPT_URL,$URL);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, "".$dato[2].":".$dato[3]."");
			$result[]=curl_exec($ch);
			$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
			curl_close ($ch);
			file_put_contents('./igw-content/data/'.$type.'/'.$type.''.$i.'.data', serialize($result[$i]));
			
			$i++;
		}
	 file_put_contents('./igw-content/data/'.$type.'/'.$type.''.$server_id.'.data', serialize($result));
	}
	
}
