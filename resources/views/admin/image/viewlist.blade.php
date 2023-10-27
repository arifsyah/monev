<link href="{{url('/backend')}}/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="{{url('/backend')}}/assets/css/custom.css" rel="stylesheet">

<script src="{{url('/backend')}}/assets/js/jquery.min.js"></script>

<style type="text/css">
	body{
		background: transparent;
	}
	.thumbnail{
		height: auto;
	}
	button{
		border:1px solid lightgrey;
	}
</style>
<script type="text/javascript">
	function selectimage(id){
	    parent.selectimage(id);
	    parent.jQuery.fancybox.close();
	}
</script>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Media Gallery <small> gallery design </small></h2>
                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="row">
                	<div class="col-xs-12">
                		<p>Media gallery design emelents</p>	
                	</div>
                    <?php 
                    if (isset($image) && count($image) > 0) {
                    	foreach ($image as $key => $value) {
                    		?>
                    		<div class="col-md-55">
		                        <div class="thumbnail">
		                            <div class="image view view-first">
		                                <img style="width: 100%; display: block;" src="{{thumb_image($value->path,'480x270')}}" alt="image" />      
		                            </div>
		                            <div class="caption">
		                                <p>{{$value->nama}}</p>
		                                <br/>
		                                <button onclick="selectimage({{$value->id}})" class="btn-info btn-xs">Pilih</button>
		                            </div>
		                        </div>
		                    </div>
                    		<?php
                    	}
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>