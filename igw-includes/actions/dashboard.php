<?php
if(($go=="servidores") && ($serv=="")){
	
	$header_page_title="Servidores";
	$header_page_parent_path="Inicio";
	$header_page_parent_path_link="#";
	$header_page_current_path="Listado Servidores";
}elseif(($go=="servidores") && ($serv!="")){
	
	$header_page_title="Servidor";
	$header_page_parent_path="Inicio";
	$header_page_parent_path_link="#";
	$header_page_current_path="Info Servidor";
}else{
	$header_page_title="Servidores";
	$header_page_parent_path="Inicio";
	$header_page_parent_path_link="#";
	$header_page_current_path="Listado Servidores";
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-sm-6">
		<h1 class="m-0"><?php echo $header_page_title; ?></h1>
	  </div><!-- /.col -->
	  <div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
		  <li class="breadcrumb-item"><a href="<?php echo $header_page_parent_path_link; ?>"><?php echo $header_page_parent_path; ?></a></li>
		  <li class="breadcrumb-item active"><?php echo $header_page_current_path; ?></li>
		</ol>
	  </div><!-- /.col -->
	</div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<?php $stats_totals=explode('|',igw_plesk_server_totals($datos)); ?>
<!-- Main content -->
<div class="content">
  <div class="container-fluid">
	<?php if($serv!=""){ }else{ ?>
	<!-- Info boxes -->
	<div class="row">
	  <div class="col-12 col-sm-6 col-md-3">
		<div class="info-box">
		  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-server"></i></span>
	
		  <div class="info-box-content">
			<span class="info-box-text">Servidores</span>
			<span class="info-box-number">
			  <?php echo $stats_totals[0]; ?>
			  <small>unidades</small>
			</span>
		  </div>
		  <!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	  </div>
	  <!-- /.col -->
	  <div class="col-12 col-sm-6 col-md-3">
		<div class="info-box mb-3">
		  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cubes"></i></span>
	
		  <div class="info-box-content">
			<span class="info-box-text">Dominios</span>
			<span class="info-box-number"><?php echo $stats_totals[1]; ?></span>
		  </div>
		  <!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	  </div>
	  <!-- /.col -->
	
	  <!-- fix for small devices only -->
	  <div class="clearfix hidden-md-up"></div>
	
	  <div class="col-12 col-sm-6 col-md-3">
		<div class="info-box mb-3">
		  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cube"></i></span>
	
		  <div class="info-box-content">
			<span class="info-box-text">Subdominios</span>
			<span class="info-box-number"><?php echo $stats_totals[2]; ?></span>
		  </div>
		  <!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	  </div>
	  <!-- /.col -->
	  <div class="col-12 col-sm-6 col-md-3">
		<div class="info-box mb-3">
		  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
	
		  <div class="info-box-content">
			<span class="info-box-text">Clientes</span>
			<span class="info-box-number"><?php echo $stats_totals[3]; ?></span>
		  </div>
		  <!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	  </div>
	  <!-- /.col -->
	</div>
	<!-- /.row -->
	<?php } ?>

	<!-- Listado servidores -->
	<div class="row">
	  <div class="col-12">
		<div class="card">
		  <div class="card-header">
			<h3 class="card-title"><?php 
			if($serv){ echo 'Información del servidor'; }else{ echo 'Todos tus servidores';  } 
			?></h3>
	
			<div class="card-tools">
			  <div class="input-group input-group-sm" style="width: 150px;">
				<input type="text" name="table_search" class="form-control float-right" placeholder="Buscar">
	
				<div class="input-group-append">
				  <button type="submit" class="btn btn-default">
					<i class="fas fa-search"></i>
				  </button>
				</div>
			  </div>
			</div>
		  </div>
		  <!-- /.card-header -->
		  <div class="card-body table-responsive p-0">
			<?php echo igw_plesk_server_list_table($datos,$serv); ?>
		  </div>
		  <!-- /.card-body -->
		</div>
		<!-- /.card -->
	  </div>
	</div>
	<!-- /.row -->
	<?php if($serv!=""){ ?>
	<div class="row">
		<div class="col-md-6">
			<div class="card">
			  <div class="card-header">
				<h3 class="card-title">Datos del servidor</h3>
		
				<?php /*<div class="card-tools">
				  <ul class="pagination pagination-sm float-right">
					<li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
					<li class="page-item"><a class="page-link" href="#">1</a></li>
					<li class="page-item"><a class="page-link" href="#">2</a></li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
					<li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
				  </ul>
				</div> */ ?>
			  </div>
			  <!-- /.card-header -->
			  <div class="card-body p-0">
				<?php echo igw_plesk_server_details($datos,$serv,'server'); ?>
			  </div>
			  <!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<div class="col-md-6">
			<div class="card">
			  <div class="card-header">
				<h3 class="card-title">Estado de los servicios</h3>
		
				<?php /*<div class="card-tools">
				  <ul class="pagination pagination-sm float-right">
					<li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
					<li class="page-item"><a class="page-link" href="#">1</a></li>
					<li class="page-item"><a class="page-link" href="#">2</a></li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
					<li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
				  </ul>
				</div> */ ?>
			  </div>
			  <!-- /.card-header -->
			  <div class="card-body p-0">
				<?php echo igw_plesk_server_details($datos,$serv,'status'); ?>
			  </div>
			  <!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
	
		<div class="col-md-6">
			<div class="card">
			  <div class="card-header">
				<h3 class="card-title">Dominios y Subdominios</h3>
		
			  </div>
			  <!-- /.card-header -->
			  <div class="card-body p-0">
				<?php echo igw_plesk_server_details($datos,$serv,'domains'); ?>
			  </div>
			  <!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<div class="col-md-6">
			<div class="card">
			  <div class="card-header">
				<h3 class="card-title">Clientes</h3>
		
			  </div>
			  <!-- /.card-header -->
			  <div class="card-body p-0">
				<?php echo igw_plesk_server_details($datos,$serv,'clients'); ?>
			  </div>
			  <!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
	</div>
	<?php } ?>
	<div style="width: 100%; height: 150px;">&nbsp;</div>
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->