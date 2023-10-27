@extends('layouts.adminapp')

@section('content')
<style type="text/css">
    .select2-selection{
        height: 34px;
    }
</style>
<div class="page-title">
    <div class="title_left">
        <h3>
			File / Dokumen
		</h3>
    </div>
</div>

<div class="x_panel">
	@include('admin.__flash')
    <div class="x_title">
        
        <div class="col-xs-2 pull-right">
            <ul class="nav navbar-right panel_toolbox">
                
                    <a class="btn btn-small btn-info" href="{{ route('file.create') }}" >Tambah File</a>
                
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-xs-3">
        <div class="x_title">
            <form method="post" id="searchform" onsubmit="return searchThis();">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <h4>Pencarian</h4>
                <hr/>

                <div class="form-group">
                    <select class="id_kategori form-control" id="id_kategori" style="height:34px;" name="id_kategori"></select>
                </div>

                <div class="form-group">
                    <input type="text" id="title-search" name="title" class="form-control" placeholder="Judul" value="{{ Request::input('title') }}" >
                </div>

                <div class="form-group">
                    <input type="text" id="description-search" name="title" class="form-control" placeholder="Deskripsi" value="{{ Request::input('description') }}" >
                </div>

                <div class="form-group">
                    <select class="id_tag form-control" id="id_tag" style="height:34px;" name="id_tag"></select>
                </div>

                <div class="form-group">
                    <select class="id_bidang form-control" id="id_bidang" style="height:34px;" name="id_bidang"></select>
                </div>

                <div class="form-group">
                    <select class="tahun form-control" id="tahun_search" name="tahun_search" style="height:34px;" >
                        <option value="">Pilih Tahun</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                    </select>
                </div>

                <div class="form-group">
                    <br/>
                    <input type="submit" onclick="return searchThis();" value="Search" class="btn btn-small btn-info">
                    <a href="javascript:void(0)" onclick="reset();return false;" class="btn btn-small btn-danger">Reset</a>
                </div>
                
            </form>
        </div>
    </div>
    <div class="col-xs-9">
        <div class="x_content">
        
        
        </div>    
    </div>
    
</div>

<div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Detail File</h3>
            </div>
            <div class="modal-body">
                <table class="table table-striped responsive-utilities jambo_table  bulk_action">
                    <tr>
                        <td>Kategori</td>
                        <td>:</td>
                        <td><span id="kategori"></span></td>
                    </tr>
                    <tr>
                        <td>Judul</td>
                        <td>:</td>
                        <td><span id="judul"></span></td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>:</td>
                        <td><span id="deskripsi"></span></td>
                    </tr>
                    <tr>
                        <td>Tahun</td>
                        <td>:</td>
                        <td><span id="tahun"></span></td>
                    </tr>

                    <tr>
                        <td>File</td>
                        <td>:</td>
                        <td><span id="file"></span></td>
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

<script type="text/javascript">
    var data_json = [];
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	$(document).ready(function(){
		//initial
		fetch_data();
	});

	function fetch_data(title = '', id_kategori = '' ,id_tag = '',description = '',tahun='',id_bidang='',page = ''){
        showspinner();
    	$.ajax({
            /* the route pointing to the post function */
            url: ' {{ route("file.alldata") }} ',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {title:title ,id_kategori:id_kategori,description:description,id_tag:id_tag,tahun:tahun,id_bidang:id_bidang,page:page },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) { 
                // $(".writeinfo").append(data.msg); 
                console.log(data)
                $('.x_content').html(data.html)
            }
        }); 
    }

    function searchThis(){

		var frm = document.searchform;
		event.preventDefault(); 
		// alert('adsasd')
        var title = $('#title-search').val();
        var description = $('#description-search').val();
        var tahun = $('#tahun_search').val();
		var id_kategori = "";
        var id_tag = "";
        var id_bidang = "";
        if (typeof $('.id_kategori').select2('data')[0] !== 'undefined') {
            id_kategori =  $('.id_kategori').select2('data')[0].id;
        }

        if (typeof $('.id_tag').select2('data')[0] !== 'undefined') {
            id_tag =  $('.id_tag').select2('data')[0].id;
        }

        if (typeof $('.id_bidang').select2('data')[0] !== 'undefined') {
            id_bidang =  $('.id_bidang').select2('data')[0].id;
        }        
        // console.log($('.itemTag').select2('data').length);
		// return false;
		fetch_data(title,id_kategori,id_tag,description,tahun,id_bidang);
	}

    function reset(){
        
        $('#id_tag').val(null).trigger('change');
        $('#id_kategori').val(null).trigger('change');
        $('#id_bidang').val(null).trigger('change');

        $('#title-search').val('');
        $('#description-search').val('');
        $('#tahun_search').val('');

        fetch_data();
    }
	
    $('.id_kategori').select2({
        placeholder: 'Pilih Kategori',
        allowClear: true,
        ajax: {
            url: "{{route('category.dataselect')}}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
              return {
                results:  $.map(data, function (item) {
                      return {
                          text: item.title,
                          id: item.id
                      }
                  })
              };
            },
            cache: true
        }
    });

    $('.id_tag').select2({
        placeholder: 'Pilih Tag',
        allowClear: true,
        ajax: {
            url: "{{route('tag.dataselectsingle')}}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
              return {
                results:  $.map(data, function (item) {
                      return {
                          text: item.title,
                          id: item.id
                      }
                  })
              };
            },
            cache: true
        }
    });

    $('.id_bidang').select2({
        placeholder: 'Pilih Bidang',
        allowClear: true,
        ajax: {
            url: "{{route('unit_kerja.dataselect')}}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
              return {
                results:  $.map(data, function (item) {
                      return {
                          text: item.title,
                          id: item.id
                      }
                  })
              };
            },
            cache: true
        }
    });

    function detailpopup(id){
        $.ajax({
            /* the route pointing to the post function */
            url: ' {{ route("file.detaildata") }} ',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {id:id},
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) { 
                
                $('#kategori').html(data.kategori.title);
                $('#judul').html(data.title);
                $('#deskripsi').html(data.description);
                $('#user_created').html(data.created.name);
                $('#created_at').html(data.created_at);
                $('#tahun').html(data.tahun);
                
                $('#file').html('<a href="{{ url('/file/download/' ) }}/'+data.id+'?time='+Math.random()+'  " target="_blank" >Link File</a>');
                // $('.x_content').html(data.html)
                $('#detailModal').modal('show');
            }
        }); 
    }

    function detailpopupHistory(id){
        var innerhtml = '';
        var url = '{{url("file/download")}}';
        var url_history = '{{url("file/downloadHistory")}}';
        $.ajax({
            /* the route pointing to the post function */
            url: ' {{ route("file.datahistory") }} ',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {id:id},
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) { 

                innerhtml += '<ul class="list-unstyled timeline widget">';
                $.each(data,function(index,value){
                    innerhtml += '<li>';
                        innerhtml += '<div class="block">';
                            innerhtml += '<div class="class="block_content">';
                                innerhtml += '<h2 class="title">'+value.title+'</h2>';
                                if (index == 0) {
                                    innerhtml += '<div class="byline"><span>'+value.updated_at+' </span> by <a>'+value.created.name+'</a></div>';    
                                }else{
                                    innerhtml += '<div class="byline"><span>'+value.created_at+' </span> by <a>'+value.created.name+'</a></div>';
                                }
                                
                                innerhtml += '<p class="excerpt">'+value.description+'</p>' ;

                                if (index == 0) {
                                    innerhtml += '<div><a href="'+url+'/'+value.id+'?time='+Math.random()+'" target="_blank" >Lihat File</a></div>' ;
                                }else{
                                    innerhtml += '<div><a href="'+url_history+'/'+value.id+'?time='+Math.random()+'" target="_blank" >Lihat File</a></div>' ;    
                                };
                            innerhtml += '</div>';
                        innerhtml += '</div>';
                    innerhtml += '</li>';
                })

                innerhtml  += '</ul>';

                $('#modal-body').html(innerhtml)
                $('#detailHistory').modal('show');
            }
        }); 
    }


</script>

<div id="detailHistory" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Detail File History</h3>
            </div>
            <div class="modal-body" id="modal-body">
                <?php 

                ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection