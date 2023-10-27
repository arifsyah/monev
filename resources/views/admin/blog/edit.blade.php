@extends('layouts.adminapp')

@section('content')
<script type="text/javascript">
    $(document).ready(function(){
        tinymce.init({ 
            selector:'textarea#body',
            height:'300'
        });

        $('.openpopup').click(function(){
            var id_gambar = $('input[name="id_image"]').val();
            if (id_gambar == undefined) {id_gambar = 0};

            $.fancybox.open([{
                type:'iframe',
                width:'85%',
                href:"{{url('/')}}/admin/image/viewlist/ "+id_gambar,
            }]);

            return false;
        })
    })

    function selectimage(id_image){
        $.post("<?php echo url('/').'/admin/image/getDetailImage' ?>",{_token: "{{ csrf_token() }}",id:id_image},function(data,status){
            var detail = JSON.parse(data);
            var htmldata = "";
            // console.log(detail)
            var file = '{{url('/')}}/images/crop/'+detail['path'];

            htmldata += "<div id='boximage"+detail['id']+"'>";
            htmldata += "<input type='hidden' name='id_image' value='"+detail['id']+"' >";
            htmldata += "<input type='hidden' name='path_image' value='"+detail['path']+"' >";
            htmldata += "<div class='col-xs-6'><div class='image border1px'><img src='"+file+"' class='img-responsive'>";
            htmldata += "<br/><a href='javascript:void(0)' class='btn-sm btn-danger' onclick='removeimage("+detail['id']+")'>Delete</a><br/><br/>";
            htmldata += "</div></div></div>";

            $('#list-gambar').html(htmldata); 
        })
    }

    function removeimage(id){
        $('#boximage'+id).remove();
    }
</script>
<div class="page-title">
    <div class="title_left">
        <h3>
            Blog
        </h3>
    </div>

</div>

<div class="x_panel">
    @include('admin.__flash')
    <div class="x_title">
        <h2>Ubah data Blog</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li>
                <a href="{{ route('blog.index') }}" >Back to Blog</a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <br />
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ url('admin/blog/updatedata').'/'.$blog->id }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Kategori</label>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <select name="id_blog_categories" class="form-control" >
                    <?php 
                    if(isset($category) && count($category)>0 ){
                        foreach($category as $key => $value){
                            ?>
                            <option <?php if(isset($blog->id_blog_categories) && $blog->id_blog_categories == $value->id){echo "selected='selected'";} ?> value="{{ $value->id }}"> {{$value->nama}} </option>
                            <?php
                        }
                    }
                    ?>
                    </select>
                </div>
            </div>

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span></label>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="title" value="{{$blog->title}}" name="title" class="form-control col-md-7 col-xs-12">

                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Summary</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="summary" class="form-control col-md-7 col-xs-12">{{$blog->summary}}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Body</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <textarea id="body" name="body" class="form-control col-xs-12">{{$blog->body}}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Status</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="radio">
                        <label>
                            <input type="radio" <?php if(isset($blog->status) && $blog->status == 0){echo 'checked="checked"';} ?> value="0" name="status"> Nonaktif &nbsp;
                        </label>    
                        <label>
                            <input type="radio" <?php if(isset($blog->status) && $blog->status == 1){echo 'checked="checked"';} ?> value="1" name="status"> Aktif    
                        </label>    
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Cover</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <a href="javascript:void(0)" id="btn" class="btn btn-xs btn-primary openpopup" style="margin-top:5px;">Pilih Gambar</a>
                    <br/>
                    <div id="list-gambar" class="row">
                        <?php 
                        if (isset($blog->id_image) && $blog->id_image != 0) {
                            ?>
                            <div id='boximage{{$blog->id_image}}'>";
                                <input type='hidden' name='id_image' value='{{$blog->id_image}}' >
                                <input type='hidden' name='path_image' value='{{$blog->image_path}}' >
                                <div class='col-xs-6'>
                                    <div class='image border1px'>
                                        <img src='{{ url('/') }}/images/crop/{{$blog->image_path}}' class='img-responsive'><br/>
                                        <a href='javascript:void(0)' class='btn-sm btn-danger' onclick='removeimage({{$blog->id_image}})'>Delete</a><br/><br/>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        
                    </div>
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
@endsection