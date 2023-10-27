@extends('layouts.adminapp')

@section('content')
<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 350px;
}

</style>


<!-- top tiles -->
<div class="row tile_count">
    <h2>Selamat Datang</h2>
</div>
<!-- /top tiles -->
<hr/>



<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection