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
			Image
		</h3>
    </div>

</div>

<div class="x_panel">
	@include('admin.__flash')
    <div class="x_title">
        <h2>Ubah data Image</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li>
                <a href="{{ route('image.index') }}" >Back to Image</a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
    	<br />
        <form enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ url('image/updatedata').'/'.$image->id }}">
        	{{ csrf_field() }}
            <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama <span class="required">*</span></label>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="nama" name="nama" value="{{ $image->nama }}" required="required" class="form-control col-md-7 col-xs-12">

                    @if ($errors->has('nama'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nama') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="description" class="form-control col-md-7 col-xs-12">{{ $image->description }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Image</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="path" id="uploadImage" class="col-md-7 col-xs-12" style="margin-top:10px;padding-left:0px;">
                    <br/><br/>
                    <div class="imgpreview">
                        <img src="<?php echo thumb_image($image->path,'480x270') ?>">
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