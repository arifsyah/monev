@extends('layouts.adminapp')

@section('content')
<script type="text/javascript">
    
    $(document).ready(function(){
        var oFReader = null;
        var image = null;
        var globalResizedWidth = '<?php echo Config::get("constants.width_resize") ?>';
        var jcrop_api, globalWidth, globalHeight, globalConfDimension;

        $('.image_block').remove();
        $("#uploadImage").val("");

        $("#uploadImage").change(function(){
            $(this).parent().find(".image_block").remove();
            $.when( createImageElement(this) ).done( cropImageElement(this) );
        });
        
        function createImageElement(obj) {
            var html = '<div class="image_block" style="margin-top:20px;">';
            html += '<input type="hidden" class="x1" name="x1" value="0" />';
            html += '<input type="hidden" class="y1" name="y1" value="0" />';
            html += '<input type="hidden" class="x2" name="x2" value="0" />';
            html += '<input type="hidden" class="y2" name="y2" value="0" />';
            html += '<br><img class="image_preview" style="width:'+globalResizedWidth+'px" />';
            html += '</div>';
            $(obj).after(html);
        }

        function cropImageElement(obj) {
            var ext = getExtension($(obj).val());
            if(ext == "jpg" || ext == "jpeg" || ext == "png" || ext == "gif"){
                var dimensionconf = '1000x563';
                var separator = dimensionconf.split("x");
                var dimheight = separator[1];
                var dimwidth = separator[0];
                if(dimwidth != 'undefined' || dimheight != 'undefined'){
                    doLoadCropping(obj, dimwidth, dimheight);
                }
                return false;
            }else{
                alert('Error image ekstensi');
                $('.image_block').remove();
                $("#uploadImage").val("");
                return false;
            }
        }

        function doLoadCropping(obj, dimwidth, dimheight) {
            if(oFReader !=null){
                oFReader = null;
            }
            
            var min_width = dimwidth;
            var min_height = dimheight;
            var objFile = obj.files[0];
            var max_foto_mb = '2';
            var max_foto_byte = parseInt(max_foto_mb)*1048576; //convert MB to Byte
            
            if(objFile.size > max_foto_byte) {
                $(obj).parent().find(".image_block").remove();
                $(obj).val("");
                alert("Error ukuran image");
                $('.image_block').remove();
                $("#uploadImage").val("");
            } else {
                // prepare HTML5 FileReader
                oFReader = new FileReader();
                image  = new Image();
                oFReader.readAsDataURL(objFile);
                
                oFReader.onload = function (_file) {
                    image.src    = _file.target.result;
                    image.onload = function() {
                            globalWidth = this.width;
                            globalHeight = this.height;
                            
                            $(obj).parent().find(".image_preview").attr("src", this.src);

                            if(globalWidth < min_width || globalHeight < min_height) {
                                    $(obj).parent().find(".image_block").remove();
                                    $(obj).val("");
                                    alert("Error dimensi image");
                            } else {
                                cropImage(globalWidth, globalHeight, min_width, min_height, $(obj).parent().find(".image_preview"));
                            }
                    };

                    image.onerror= function() {
                        alert('Invalid file type: '+ objFile.type);
                    };     
                    
                }
            }
        }

        function cropImage(width, height, minwidth, minheight, obj) {
            var resizedWidth = globalResizedWidth;
            var resizedHeight = (resizedWidth * height) / width;
            var resizedMinWidth = (minwidth * resizedWidth) / width;
            var resizedMinHeight = (minheight * resizedHeight) / height;
            
            if(minwidth != '' || minheight != ''){
                $(obj).Jcrop({
                    setSelect: [ 0, 0, resizedMinWidth, resizedMinHeight ],
                    minSize: [ resizedMinWidth, resizedMinHeight ],
                    onSelect: updateCoords,
                    allowSelect: false,
                    bgFade: true,
                    bgOpacity: 0.4,
                    aspectRatio: minwidth / minheight
                },function(){
                    jcrop_api = this;
                });
            }
        }
        function updateCoords(c){
            $('.x1').val(c.x);
            $('.y1').val(c.y);
            $('.x2').val(c.x2);
            $('.y2').val(c.y2);
            $('.w').val(c.w);
            $('.h').val(c.h);
        };
        function getExtension(filename) {
            return filename.split('.').pop().toLowerCase();
        }
    });

    
</script>
<div class="page-title">
    <div class="title_left">
        <h3>
			Pengguna
		</h3>
    </div>

</div>
<div class="x_panel">
	@include('admin.__flash')
    <div class="x_title">
        <h2>Ubah data User</h2>
        <ul class="nav navbar-right panel_toolbox">
            
                <a class="btn btn-small btn-info" href="{{ route('users.index') }}" >Back to Pengguna</a>
            
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
    	<br />
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ url('users/updatedata').'/'.$admin->id }}">
        	{{ csrf_field() }}
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama <span class="required">*</span></label>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12" value="{{ $admin->name }}">
                </div>
            </div>
            
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span></label>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="email" type="email" class="form-control col-md-7 col-xs-12" name="email" value="{{ $admin->email }}" required="required">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role">Role <span class="required">*</span></label>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    
                    <select class="form-control" name="role" id="role">
                        <?php 
                        foreach (Config::get('app.role_user') as $key => $value) {
                            ?>
                            <option value="{{$value}}" <?php if($admin->role == $value){echo "selected='selected'";} ?> >{{ $key }}</option>
                            <?php
                        }
                        ?>
                    </select>
                    @if ($errors->has('role'))
                        <span class="help-block">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password <span class="required">*</span></label>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="password" type="password" class="form-control col-md-7 col-xs-12" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="password-confirm">Confirm Password <span class="required">*</span></label>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="password-confirm" type="password" class="form-control col-md-7 col-xs-12" name="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status <span class="required">*</span></label>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    
                    <select name="status" class="form-control">
                        <option value="0" <?php if($admin->status == '0'){echo "selected='selected'";} ?>>Tidak Aktif</option>
                        <option value="1" <?php if($admin->status == '1'){echo "selected='selected'";} ?>>Aktif</option>
                    </select>
                    
                </div>
            </div>

            <!-- <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Foto</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="path" id="uploadImage" class="col-md-7 col-xs-12" style="margin-top:10px;padding-left:0px;">
                </div>
            </div> -->

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