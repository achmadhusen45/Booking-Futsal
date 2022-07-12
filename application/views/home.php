<?php
$this->load->view('template/head');
?>

<!--tambahkan custom css disini-->
<!-- iCheck -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/flat/blue.css') ?>" rel="stylesheet" type="text/css" />
<!-- Morris chart -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/morris/morris.css') ?>" rel="stylesheet" type="text/css" />
<!-- jvectormap -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>" rel="stylesheet" type="text/css" />
<!-- Date Picker -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
<!-- Daterange picker -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker-bs3.css') ?>" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Home
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<div class="box-body">
						<button type="submit" class="btn btn-primary" onclick="add_book()" >Tambah Pesanan</button>
						<table id="pesanan" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th>Tanggal</th>
									<th>Jam</th>
									<th>Lapangan</th>
									<th>Metode Pembayaran</th>
									<th>Action</th>
								</tr>
							</thead>
								<tbody>
								<?php foreach($read as $key => $p){?>
								<tr>
				    				<td><?php echo $key+1;?></td>
				    				<td><?php echo $p->tanggal;?></td>
									<td><?php echo $p->jam;?></td>
									<td><?php echo $p->lapangan;?></td>
									<td><?php echo $p->metodepembayaran;?></td>
									<td>
										<button type="button" class="btn btn-primary" onclick="pesan(<?= $p->id_pesan ?>)"> Pesan</button>
									</td>
								</tr>
								<?php }?>
								</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

</section><!-- /.content -->



<?php
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->
<!-- Sparkline -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/sparkline/jquery.sparkline.min.js') ?>" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker.js') ?>" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js') ?>" type="text/javascript"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/chartjs/Chart.min.js') ?>" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/pages/dashboard2.js') ?>" type="text/javascript"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/demo.js') ?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js') ?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/js/dataTables.bootstrap4.min.js') ?>" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

      $('#id_pesan').DataTable();
      $('.datepicker').datepicker({
      	    format: 'Y-m-d',
      });

    });
    
    var save_method;
    var table;

    function add_book(){
      save_method = 'add';
      $('#form')[0].reset();
      $('#modal_form').modal('show');
    }

    function edit_book(id){
      save_method = 'update';
      $('#form')[0].reset();
      $.ajax({
        url : "<?php echo site_url('user/ajax_edit/')?>/" + id, type: "GET", dataType: "JSON", success: function(data)
        {
            $('[name="id_member"]').val(data.id_member);
            $('[name="nama"]').val(data.nama);
            $('[name="jeniskel"]').val(data.jeniskel);
            $('[name="alamat"]').val(data.alamat);
            $('[name="no_telp"]').val(data.no_telp);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit Book');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
      });
    }

    function save(){
      var url;
      console.log($('#form').serialize())
      if(save_method == 'add')
      {
          url = "<?php echo site_url('home/aksi_tambah')?>";
      }
      else
      {
        url = "<?php echo site_url('home/book_update')?>";
      }
            $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
              $('#modal_form').modal('hide');
              location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
            });
    }

    function delete_book(id){
      if(confirm('Are you sure delete this data?'))
      {
          $.ajax({
            url : "<?php echo site_url('user/book_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
          });
      }
    }

    function pesan(id) {
    	$.ajax({
    		url : "<?php echo site_url('home/pesan') ?>/"+id,
    		type: "POST",
    		dataType: "JSON",
    		success: function(data)
            {
           
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
    	});
    }

  </script>

<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Tambah Lapangan</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <div class="form-body">

          <div class="form-group">
          <label class="control-label col-md-3">Tanggal</label>
          <div class="col-md-9">
          <div class="input-group date" data-provide="datepicker"  data-date-format="yyyy-m-d">
			    <input name="tanggal" type="text" class="form-control datepicker" placeholder="Tanggal">
			    <div class="input-group-addon">
			        <span class="glyphicon glyphicon-th"></span>
			    </div>
			</div>
			</div>
			</div>
            
            <div class="form-group">
              <label class="control-label col-md-3">Jam</label>
              <div class="col-md-9">
                <input name="jam" placeholder="Jam" class="form-control" type="text">
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-md-3">Lapangan</label>
              <div class="col-md-9">
				<input name="lapangan" placeholder="Lapanagn" class="form-control" type="text">
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-md-3">Metode Pembayaran</label>
              <div class="col-md-9">
				<input name="metodepembayaran" placeholder="Metode Pembayaran" class="form-control" type="text">
              </div>
            </div>

            
					

          </div>
        </form>
      </div>
          
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        
    </div>
  </div>
</div>


<?php
$this->load->view('template/foot');
?>

