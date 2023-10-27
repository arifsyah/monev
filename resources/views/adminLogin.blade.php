@extends('layouts.adminlogin')
@section('content')
<div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper" style="max-width:500px !important;">
        <div id="login" class="animate form">

            <?php 
            if (session('status_reset_password') == 1) {
                ?>
                <div class="alert alert-info">
                    <ul>
                        <?php echo session('success_reset_password'); ?>
                    </ul>
                </div>
                <?php
            }
            ?>
            @include('admin.__flash')
            <section class="login_content">
                <form  class="form-horizontal" role="form" method="POST" action="{{ route('admin.auth') }}">
                {!! csrf_field() !!}
                    
                    <h1>Login</h1>
                    <div><img src="{{url('/images')}}/logo_dpkp_sm.png" style="max-width:75px;"></div>
                    <h1>Monitoring dan Evaluasi</h1>
                    <h1>Dinas Perumahan dan Kawasan Permukiman <br/><br/>Kota Bandung</h1>
                    <div>
                        <!-- <img src="{{url('/backend')}}/assets/images/dpkp3.png" alt="" style="max-width:200px;"> -->
                    </div>
                    <div style="max-width:300px !important;margin:0px auto;" class="form-group{{ $errors->has('nip') ? ' has-error' : '' }}">
                        
                        <div class="col-md-12">
                            <input placeholder="NIP" type="text" class="form-control" name="nip" value="{{ old('nip') }}">
                            @if ($errors->has('nip'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nip') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div style="max-width:300px !important;margin:0px auto;" class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        
                        <div class="col-md-12">
                            <input type="password" placeholder="Password" class="form-control" name="password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div>
                        <a href="{{url('forgotpassword')}}">Lupa Password</a>
                    </div>
                    <div class="separator">
                        <div class="clearfix"></div>
                        <br />
                        <div>
                            <p>©<?php echo date('Y') ?> All Rights Reserved. </p>
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