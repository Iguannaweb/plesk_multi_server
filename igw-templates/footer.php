
<!-- Main Footer -->
  <footer class="main-footer">
	<!-- To the right -->
	<div class="float-right d-none d-sm-inline">
	  With <i class="fas fa-heart"></i> by IguannaWeb
	</div>
	<!-- Default to the left -->
	Copyright &copy; 2023-2023 <strong>Francisco Gálvez</strong>. Todos los derechos reservados.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="./vendor/almasaeed2010/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./vendor/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./vendor/almasaeed2010/adminlte/dist/js/adminlte.min.js"></script>

<script type="text/javascript">
	$('.update').on('click', function() {
		$.ajax({
		  url: "./update_data.php",
		  data: {  
			  serv: $('#update').attr('data-serv')
		  },
		  beforeSend : function(){
			  $('.update i').attr('class','fas fa-sync fa-spin');
		  },
		  complete: function(){
		   	  $('.update i').attr('class','fas fa-sync');
		  }
		  
		}).done(function() {
			
		  $("div.content-wrapper").fadeOut('slow').load(" div.content-wrapper > *").fadeIn('slow');
		  //alert('¡Actualizado!');
		});
	});

</script>
</body>
</html>