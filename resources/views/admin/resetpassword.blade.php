@extends('layouts.adminlogin')
@section('content')
<div class="">
    <div id="wrapper">
        <div id="login" class="animate form">
            <section class="login_content">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('resetpasswordpost') }}">
                {!! csrf_field() !!}
                    <h1>Reset Password</h1>
                    <h1>Monitoring dan Evaluasi Kinerja Berkala</h1>
                    <div>
                        <img src="{{url('/backend')}}/assets/images/dpkp3.png" alt="" style="max-width:200px;">
                    </div>
                    <input type="hidden" name="token" value="{{$token}}">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" >
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <?php 
                        if (session('status_reset_password') == 1) {
                            ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php echo session('success_reset_password'); ?>
                                </ul>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="col-md-12">
                            <input placeholder="Password Baru" type="password" class="form-control" name="password">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <input placeholder="Konfirmasi Password Baru" type="password" class="form-control" name="password_confirmation">
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