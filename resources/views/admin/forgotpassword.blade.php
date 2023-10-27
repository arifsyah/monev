@extends('layouts.adminlogin')
@section('content')
<div class="">
    <div id="wrapper">
        <div id="login" class="animate form">
            <section class="login_content">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('forgotpasswordpost') }}">
                    {!! csrf_field() !!}
                    
                    <h1>Lupa Password</h1>
                    <h1>Monitoring dan Evaluasi Kinerja Berkala</h1>
                    <div>
                        <img src="{{url('/backend')}}/assets/images/dpkp3.png" alt="" style="max-width:200px;">
                    </div>

                    <?php 
                    if (session('status') == 'error') {
                        ?><div class="alert alert-warning"><?php echo session('message'); ?></div><?php
                    }else if(session('status') == 'success'){
                        ?><div class="alert alert-info"><?php echo session('message'); ?></div><?php    
                    }
                    
                    ?>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        
                        <div class="col-md-12">
                            <input placeholder="Email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </div>
                    
                </form>
                <!-- form -->
            </section>
            <!-- content -->
        </div>
    </div>
</div>
@endsection