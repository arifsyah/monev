@extends('layouts.adminapp')

@section('content')
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
        <h2>Ubah data File</h2>
        <ul class="nav navbar-right panel_toolbox">
            
                <a class="btn btn-small btn-info" href="{{ route('file.index') }}" >Kembali</a>
            
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
    	<br />
        <form id="form2" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="{{ route('file.update',$file->id) }}">
        	{{ csrf_field() }}

            <div class="form-group{{ $errors->has('kategori') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kategori">Kategori <span class="required">*</span></label>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="itemName form-control" style="height:34px;" name="itemName">
                        <option value="{{$data['id_kategori']}}" selected="selected" >{{ $data['kategori']['title'] ?? '' }}</option>
                    </select>
                    <input type="hidden" id="id_kategori" name="id_kategori" value="{{$data['id_kategori']}}">
                    <!-- @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif -->
                    <div class="clearfix"></div>
                    <br/>
                    <a href="javascript:void(0)" onclick="addKategoriPopup()" class="btn btn-xs btn-info">Tambah Kategori</a>
                </div>
                
            </div>

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Judul <span class="required">*</span></label>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="title" name="title" value="{{ $file->title }}" required="required" class="form-control col-md-7 col-xs-12">

                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Deskripsi</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="description" class="form-control col-md-7 col-xs-12">{{ $file->description }}</textarea>
                </div>
            </div>
            
            <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tag">Tag </label>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="itemTag form-control" style="height:34px;" name="itemTag[]" multiple="multiple">
                        @if(count($data['tags']) > 0)
                            @foreach($data['tags'] as $value)
                                <option value="{{$value['id_tag']}}" selected="selected">{{$value['detail']['title'] ?? ''}}</option>
                            @endforeach
                        @endif
                    </select>
                    <input type="hidden" id="id_tags" name="id_tags[]" value="{{$id_tags_fix}}">
                    <!-- @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif -->
                    <div class="clearfix"></div>
                    <br/>
                    <a href="javascript:void(0)" onclick="addTagPopup()" class="btn btn-xs btn-info">Tambah Tag</a>
                </div>
            </div>

            <div class="form-group{{ $errors->has('kategori') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bidang">Bidang </label>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="itemNameBidang form-control" style="height:34px;" name="itemNameBidang">
                        <option value="{{$data['id_bidang']}}" selected="selected" >{{ $data['bidang']['title'] ?? '' }}</option>
                    </select>
                    <input type="hidden" id="id_bidang" name="id_bidang" value="{{$data['id_bidang']}}">
                    <!-- @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif -->
                </div>
                
            </div> 

            <div class="form-group{{ $errors->has('tahun') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun">Tahun </label>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="tahun form-control" style="height:34px;" name="tahun">
                        <option value="2017" <?php if($data['tahun'] == '2017'){echo "selected=selected";} ?> >2017</option>
                        <option value="2018" <?php if($data['tahun'] == '2018'){echo "selected=selected";} ?>>2018</option>
                        <option value="2019" <?php if($data['tahun'] == '2019'){echo "selected=selected";} ?>>2019</option>
                        <option value="2020" <?php if($data['tahun'] == '2020'){echo "selected=selected";} ?>>2020</option>
                        <option value="2021" <?php if($data['tahun'] == '2021'){echo "selected=selected";} ?>>2021</option>
                        <option value="2022" <?php if($data['tahun'] == '2022'){echo "selected=selected";} ?>>2022</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">File</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="path" id="uploadFile" class="col-md-7 col-xs-12" style="margin-top:10px;padding-left:0px;">
                    <br/><br/><br/><div class="clearfix"></div>
                    @if($is_file_exists)
                        <a class="btn btn-default btn-xs" href="{{ route('file.download',$data['id']) }}?time={{time()}}" target="_blank">Download File</a>
                    @endif
                    <a class="btn btn-xs btn-warning" onclick="detailpopupHistory({{$data['id']}})" href="javascript:void(0)">History File</a>
                </div>


            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <input type="submit" style="display:none;">
                </div>
            </div>

        </form>
   	</div>

</div>

<div id="addKategoriModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Tambah Kategori</h3>
            </div>
            <div class="modal-body">
                <form onsubmit="submitKategori();return false;">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title_kategori">Judul <span class="required">*</span></label>
                        <div class=" col-xs-9">
                            <input type="text" id="title_kategori" name="title_kategori" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Deskripsi</label>
                        <div class=" col-xs-9">
                            <textarea name="deskripsi_kategori" id="deskripsi_kategori" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                    </div>
                    <div class="clearfix"></div><br/><br/><br/><br/>                    
                    <div class="text-right" style="margin-top:20px;">
                        <input type="submit" class="btn btn-sm btn-info" value="Simpan">
                        <button class="btn btn-sm btn-danger" onclick="closeModalKategori();return false;">Batal</button>
                    </div>
                    
                </form>
                


            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="addTagModal" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Tambah Tag</h3>
            </div>
            <div class="modal-body">
                <form onsubmit="submitTag();return false;">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title_tag">Judul <span class="required">*</span></label>
                        <div class=" col-xs-9">
                            <input type="text" id="title_tag" name="title_tag" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Deskripsi</label>
                        <div class=" col-xs-9">
                            <textarea name="deskripsi_tag" id="deskripsi_tag" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                    </div>
                    <div class="clearfix"></div><br/><br/><br/><br/>                    
                    <div class="text-right" style="margin-top:20px;">
                        <input type="submit" class="btn btn-sm btn-info" value="Simpan">
                        <button class="btn btn-sm btn-danger" onclick="closeModalTag();return false;">Batal</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
        $('.itemName').select2({
          placeholder: 'Select an item',
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
            allowClear: true,
            cache: true
          }
        })

        $('.itemName').on('select2:select', function (e) {
            var data = e.params.data;
            $('#id_kategori').val(data.id);
        });
        

        $('.itemNameBidang').on('select2:select', function (e) {
            var data = e.params.data;
            $('#id_bidang').val(data.id);
        });

        $('.itemTag').select2({
            placeholder: 'Select an item',
            ajax: {
                url: "{{route('tag.dataselect')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                insertTag: function (data, tag) {
                    // Insert the tag at the end of the results
                    // console.log(tag)
                    data.push(tag.id);
                },
                cache: true
            }
        })

        $('.itemNameBidang').select2({
          placeholder: 'Select an item',
          ajax: {
            url: "{{route('bidang.dataselect')}}",
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
            allowClear: true,
            cache: true
          }
        })

        //loading overlay
        $('#form2').submit(function(){
            $.LoadingOverlay("show");
        });
    })

    function addKategoriPopup(){
        $('#addKategoriModal').modal('show');
    }

    function closeModalKategori(){
        $('#addKategoriModal').modal('hide');
        $('#title_kategori').val('');
        $('#deskripsi_kategori').val('');
    }

    function submitKategori(){
        var title_kategori = $('#title_kategori').val();
        var deskripsi_kategori = $('#deskripsi_kategori').val();

        $.ajax({
            /* the route pointing to the post function */
            url: ' {{ route("category.createpopup") }} ',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {title:title_kategori ,description:deskripsi_kategori },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) { 
                // $(".writeinfo").append(data.msg); 
                // console.log(data)
                alert('Data Berhasil Disimpan')
                // if(data != 'success'){
                //     alert('asdasdasd')
                // }
                // $('.x_content').html(data.html)
                $('#title_kategori').val('');
                $('#deskripsi_kategori').val('');
                $('#addKategoriModal').modal('hide');
            },
            error:function(reject){
                console.log(JSON.parse(reject.responseText).errors.title[0])
                alert(JSON.parse(reject.responseText).errors.title[0])
            }
        }); 

    }

    function addTagPopup(){
        // alert('adasd')
        $('#addTagModal').modal('show');
    }

    function closeModalTag(){
        $('#addTagModal').modal('hide');
        $('#title_tag').val('');
        $('#deskripsi_tag').val('');
    }

    function submitTag(){
        var title_tag = $('#title_tag').val();
        var deskripsi_tag = $('#deskripsi_tag').val();

        $.ajax({
            /* the route pointing to the post function */
            url: ' {{ route("tag.createpopup") }} ',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {title:title_tag ,description:deskripsi_tag },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) { 
                // $(".writeinfo").append(data.msg); 
                // console.log(data)
                alert('Data Berhasil Disimpan')
                // if(data != 'success'){
                //     alert('asdasdasd')
                // }
                // $('.x_content').html(data.html)
                $('#title_tag').val('');
                $('#deskripsi_tag').val('');
                $('#addTagModal').modal('hide');
            },
            error:function(reject){
                console.log(JSON.parse(reject.responseText).errors.title[0])
                alert(JSON.parse(reject.responseText).errors.title[0])
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

@endsection