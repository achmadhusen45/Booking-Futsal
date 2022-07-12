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

<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Member
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
						<table id="pesanan" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Jenis Kelamin</th>
									<th>Alamat</th>
									<th>No.Tlpn</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($books as $book){?>
								<tr>
				    				<td><?php echo $book->nama;?></td>
				    				<td><?php echo $book->jeniskel;?></td>
									<td><?php echo $book->alamat;?></td>
									<td><?php echo $book->no_telp;?></td>
									<td>
						  				<button class="btn btn-warning" onclick="edit_book(<?php echo $book->id_member;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
						  				<button class="btn btn-danger" onclick="delete_book(<?php echo $book->id_member;?>)"><i class="glyphicon glyphicon-remove"></i></button>
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



  <script type="text/javascript">
    $(document).ready(function() {

      $('#id_member').DataTable();
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
      if(save_method == 'add')
      {
          url = "<?php echo site_url('user/book_add')?>";
      }
      else
      {
        url = "<?php echo site_url('user/book_update')?>";
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

  </script>

 
<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Book Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id_member"/>
          <div class="form-body">
            
            <div class="form-group">
              <label class="control-label col-md-3">Nama</label>
              <div class="col-md-9">
                <input name="nama" placeholder="Nama" class="form-control" type="text">
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-md-3">Jenis Kelamin</label>
              <div class="col-md-9">
				<input name="jeniskel" placeholder="Jenis Kelamin" class="form-control" type="text">
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-md-3">Alamat</label>
              <div class="col-md-9">
				<input name="alamat" placeholder="Alamat" class="form-control" type="text">
              </div>
            </div>
						
            <div class="form-group">
			  <label class="control-label col-md-3">No Telp</label>
			  <div class="col-md-9">
			 	<input name="no_telp" placeholder="No Telp" class="form-control" type="text">
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