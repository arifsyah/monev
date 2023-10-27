<table class="table table-striped responsive-utilities jambo_table 	bulk_action">
    <thead>
        <tr class="headings">
            <th style="width:25px;">
            	<!-- <input type="checkbox" id="check-all" class="flat"> -->
            </th>
            <th class="column-title" width="20px;">No </th>
            <th class="column-title">Nama Program </th>
            <th class="column-title" width="30%">Deskripsi</th>
            <th class="column-title" width="">Dibuat oleh</th>
            <th class="column-title">Options</th>
            <th class="bulk-actions" colspan="7">
                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
            </th>
	    </tr>
	</thead>

	<tbody>
		<?php 
		if (isset($program) && count($program)>0) {
			foreach ($program as $key => $value) {
				?>
				<tr class="<?php if($key%2 == 0){echo 'even';}else{echo 'odd';} ?> pointer">
					<td class="a-center ">
		    			<!-- <input type="checkbox" class="flat" name="table_records" > -->
		    		</td>
			        <td class=" "><?php echo $key + 1; ?></td>
			        <td class=" ">{{ $value->title }}</td>
			        <td class=" ">{{ $value->description }}</td>
			        <td class=" ">{{ $value->created->name }}<br/>{{ date_lang_reformat_long($value->created_at) }}</td>
			        
			        <td class=" last">
			        	<!-- <a class="btn btn-sm btn-default" onclick="detailpopup({{$value->id}})" href="javascript:void(0)" title="View Detail"><i class='fa fa-search'></i></a> -->
			        	<a class="btn btn-sm btn-success" onclick="detailProgram({{$value->id}})" href="javascript:void(0)" title="Edit"><i class='fa fa-list'></i></a>
			        	<a class="btn btn-sm btn-info" href="{{ route('program.edit',$value->id) }}" title="Edit"><i class='fa fa-pencil'></i></a>
			        	<a class="deletebutton btn btn-sm btn-danger" onclick="return false;" href="{{ route('program.delete',$value->id) }}" title="Hapus"><i class='fa fa-trash'></i></a>
			        </td>
		        </tr>
				<?php
			}
		}else{
			?>
			<tr>
				<td colspan="10" class="text-center">
					Tidak ada data
				</td>
			</tr>
			<?php
		}
		?>

	</tbody>

</table>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Detail Program</h3>
			</div>
		  	<div class="modal-body table-responsive">
		  		<table class="table table-striped responsive-utilities jambo_table table-responsive	bulk_action">
		  			<tr>
		  				<td>Nama Program</td>
		  				<td>:</td>
		  				<td><span id="nama_kategori"></span></td>
		  			</tr>
		  			<tr>
		  				<td>Deskripsi Program</td>
		  				<td>:</td>
		  				<td><span id="deskripsi"></span></td>
		  			</tr>
		  			<tr>
		  				<td>Dibuat Oleh</td>
		  				<td>:</td>
		  				<td><span id="user_created"></span></td>
		  			</tr>
		  			<tr>
		  				<td>Dibuat Pada</td>
		  				<td>:</td>
		  				<td><span id="created_at"></span></td>
		  			</tr>
		  		</table>

		  	</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="modalAttr" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Detail Program</h3>
			</div>
		  	<div class="modal-body">
			  	@include('admin.__flash')
			  	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<i class="more-less glyphicon glyphicon-plus"></i>
									Tambah Kinerja Program
								</a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
							<form id="programdetail" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('program.storedetail') }}" osubmit="return false;">	
								<input type="hidden" id="id_program_modal" name="id_program_modal" value="">
								<div class="panel-body">
									<div class="row form-group"> 
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun">Tahun <span class="required">*</span></label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<select class="form-control" name="tahun">
												<option value="2023">2023</option>
												<option value="2024">2024</option>
											<select>
										</div>
									</div>

									<div class="row form-group{{ $errors->has('indikator_program') ? ' has-error' : '' }}"> 
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="indikator_program">Indikator Program <span class="required">*</span></label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="indikator_program" name="indikator_program" required="required" class="form-control col-xs-12">
										</div>
									</div>
									
									<div class="row form-group{{ $errors->has('target_program') ? ' has-error' : '' }}"> 
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="target_program">Target Program <span class="required">*</span></label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="target_program" name="target_program" required="required" class="form-control col-xs-12">
										</div>
									</div>
									
									<div class="row form-group{{ $errors->has('satuan_program') ? ' has-error' : '' }}"> 
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="satuan_program">Satuan Program <span class="required">*</span></label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<select class="satuan_program form-control" id="satuan_program" style="height:40px;" name="satuan_program">
												@php
													$satuan = Config::get('constants.satuan'); 
												@endphp
												@foreach ($satuan as $value)
													<option value="{{$value}}">{{$value}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="row form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Target Triwulan</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<div class="row">
												<div class="col-md-3 col-sm-3 col-xs-3">
													<input type="text" id="target_program_tw_1" name="target_program_tw_1" placeholder="Triwulan I" required="required" class="form-control col-xs-12">
												</div>

												<div class="col-md-3 col-sm-3 col-xs-3">
													<input type="text" id="target_program_tw_2" name="target_program_tw_2" placeholder="Triwulan II" required="required" class="form-control col-xs-12">
												</div>

												<div class="col-md-3 col-sm-3 col-xs-3">
													<input type="text" id="target_program_tw_3" name="target_program_tw_3" placeholder="Triwulan III" required="required" class="form-control col-xs-12">
												</div>

												<div class="col-md-3 col-sm-3 col-xs-3">
													<input type="text" id="target_program_tw_4" name="target_program_tw_4" placeholder="Triwulan IV" required="required" class="form-control col-xs-12">
												</div>
											</div>
										</div>
									</div>

									<div class="ln_solid"></div>
									<div class="form-group">
										<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
											<button type="submit" id="btnsubmitprogram" class="btn btn-success">Submit</button>
											<input type="submit" style="display:none;">
										</div>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div><!-- panel-group -->
				<hr/>
				<div classs="table-responsive">
					<table class="table table-striped responsive-utilities jambo_table table-responsive	bulk_action">
						<thead>
							<tr class="headings">
								
								<th class="column-title text-center">Nama Program </th>
								<th class="column-title text-center">Tahun</th>
								<th class="column-title text-center">Indikator</th>
								<th class="column-title text-center">Satuan</th>
								<th class="column-title text-center">Target Tahunan</th>
								<th class="column-title text-center">Target TW I</th>
								<th class="column-title text-center">Target TW II</th>
								<th class="column-title text-center">Target TW III</th>
								<th class="column-title text-center">Target TW IV</th>
								<th class="column-title text-center" colspan="2">Opsi</th>
								
							</tr>
						</thead>

						<tbody id="detailprogrambody">
							
						</tbody>
					</table>
				</div>
		  	</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="modalAttrDelete" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title">Apakah anda yakin akan menghapus data ini?</h5>
			</div>
		  	<div class="modal-body text-center">
			  	<input type="hidden" id="id_delete" name="id_delete" value="">
				<a href="javascript:void(0)" class="btn btn-md btn-info" onclick='deletekinerja()'>Ya</a>
				<!-- <button class="btn btn-md btn-info" onclick='deletekinerja()'>Delete</button> -->
				
				<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>


<div id="modalAttrEdit" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title">Edit Kinerja Program</h5>
			</div>
		  	<div class="modal-body text-center">
			  	<form id="editprogramdetail" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('program.editdetail') }}" osubmit="return false;">
					<input type="hidden" name="id_edit" id="id_edit">
				 	<div class="row form-group"> 
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun">Tahun <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12 text-left">
							<div id="tahunedittext" style="padding-top:8px;"></div>
							<input type="hidden" id="tahunedit" name="tahunedit" value="">
						</div>
					</div>

					<div class="row form-group"> 
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="indikator_program_edit">Indikator Program <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" id="indikator_program_edit" name="indikator_program_edit" required="required" class="form-control col-xs-12">
						</div>
					</div>

					<div class="row form-group"> 
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="target_program_edit">Target Program <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" id="target_program_edit" name="target_program_edit" required="required" class="form-control col-xs-12">
						</div>
					</div>
					
					<div class="row form-group"> 
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="satuan_program_edit">Satuan Program <span class="required">*</span></label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select class="satuan_program_edit form-control" id="satuan_program_edit" style="height:40px;" name="satuan_program_edit">
								@php
									$satuan = Config::get('constants.satuan'); 
								@endphp
								@foreach ($satuan as $value)
									<option id="satuan{{$value}}" value="{{$value}}">{{$value}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="row form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Target Triwulan</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<input type="text" id="target_program_tw_1_edit" name="target_program_tw_1_edit" placeholder="Triwulan I" required="required" class="form-control col-xs-12">
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3">
									<input type="text" id="target_program_tw_2_edit" name="target_program_tw_2_edit" placeholder="Triwulan II" required="required" class="form-control col-xs-12">
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3">
									<input type="text" id="target_program_tw_3_edit" name="target_program_tw_3_edit" placeholder="Triwulan III" required="required" class="form-control col-xs-12">
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3">
									<input type="text" id="target_program_tw_4_edit" name="target_program_tw_4_edit" placeholder="Triwulan IV" required="required" class="form-control col-xs-12">
								</div>
							</div>
						</div>
					</div>
					
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3 text-left">
							<button type="submit" id="btnsubmitprogramedit" class="btn btn-success">Submit</button>
							<input type="submit" style="display:none;">
						</div>
					</div>
				</form>
			  	
			</div>
		</div>
	</div>
</div>


<div class="col-xs-6 text-left">
	<?php 
	/*
	<a class="btn btn-xs btn-warning" href="#">Delete Multiple</a>
	*/
	?>
</div>
<div class="col-xs-6 text-right">
	{{ $program->links() }}
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
		function toggleIcon(e) {
			$(e.target)
				.prev('.panel-heading')
				.find(".more-less")
				.toggleClass('glyphicon-plus glyphicon-minus');
		}
		$('.panel-group').on('hidden.bs.collapse', toggleIcon);
		$('.panel-group').on('shown.bs.collapse', toggleIcon);

		var title_bidang = '';
		var description_bidang = '';
		var user_created = '';
		var user_modified = '';
		var date_modified = '';
		var date_created = '';

		$('.pagination li a').click(function(){
			var urlx = $(this).attr('href');
        	event.preventDefault(); 

        	let params = (new URL(urlx)).searchParams;
			let page = params.get("page");
			let title = params.get("title");

        	fetch_data(title,page);
        });

		// var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        function fetch_data(title = '',page = ''){
        	showspinner();
        	$.ajax({
	            /* the route pointing to the post function */
	            url: ' {{ route("program.alldata") }} ',
	            type: 'POST',
	            /* send the csrf-token and the input to the controller */
	            data: {title:title, page:page },
	            dataType: 'JSON',
	            /* remind that 'data' is the response of the AjaxController */
	            success: function (data) { 
	                // $(".writeinfo").append(data.msg); 
	                // console.log(data)
	                $('.x_content').html(data.html)
	            }
	        }); 
        }

        $('.deletebutton').click(function(){
			// console.log($(this).attr('href'));
			if (confirm('Are you sure you want to delete from database ?')) {
			    location.href = $(this).attr('href');
			} else {
			    return false;
			}
		});

		$('#programdetail').submit(function(e){
			e.preventDefault();
			let dataform = $('#programdetail').serialize();
			
			$.ajax({
				url: "{{route('program.storedetail')}}",
				type: "post",
				data: dataform,
				success: function (response) { 
					detailProgram($('#id_program_modal').val());
				},
				error:function(reject){
					
				}
			})
			clear();
		})
		
		$('#editprogramdetail').submit(function(e){
			e.preventDefault();
			let dataform = $('#editprogramdetail').serialize();
			
			$.ajax({
				url: "{{route('program.editdetail')}}",
				type: "post",
				data: dataform,
				success: function (response) { 
					$('#modalAttrEdit').modal('hide');
					detailProgram($('#id_program_modal').val());
				},
				error:function(reject){
					
				}
			})
			clear();
		})
		
		function clear(){
			$('#indikator_program').val('');
			$('#target_program').val('');
			$('#target_program_tw_1').val('');
			$('#target_program_tw_2').val('');
			$('#target_program_tw_3').val('');
			$('#target_program_tw_4').val('');
			// $('#id_program_modal').val('');
			$('#id_delete').val('');
			
		}
		$('#modalAttrDelete').on('hide.bs.modal', function () {
			clear();
		});

		
	});
</script>
<style>
	.panel-group .panel {
        border-radius: 0;
        box-shadow: none;
        border-color: #EEEEEE;
    }

    .panel-default > .panel-heading {
        padding: 0;
        border-radius: 0;
        color: #212121;
        background-color: #FAFAFA;
        border-color: #EEEEEE;
    }

    .panel-title {
        font-size: 14px;
    }

    .panel-title > a {
        display: block;
        padding: 15px;
        text-decoration: none;
    }

    .more-less {
        float: right;
        color: #212121;
    }

    .panel-default > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #EEEEEE;
    }
</style>