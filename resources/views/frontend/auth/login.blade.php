@extends('frontend.layouts.app')

@section('title', __('Login'))

@section('content')
<div id="page-login">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 85vh;">
            <div class="col-md-5">

            <div class="col-12 text-center">
                <!-- <img id="logo" src="/img/logo_white.svg" alt="eParenting" />   -->
                <h1 class="text-white"><span style="color:gold">e</span>Parenting</h1><br/>
            </div>

            <div class="card">
                <div class="card-body">
                    <x-forms.post :action="route('frontend.auth.login')">
                        <div class="form-group">                    
                            <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autofocus autocomplete="email" />                    
                        </div><!--form-group-->

                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="current-password" />                    
                        </div><!--form-group-->

                        @if(config('boilerplate.access.captcha.login'))
                            <div class="row">
                                <div class="col">
                                    @captcha
                                    <input type="hidden" name="captcha_status" value="true" />
                                </div><!--col-->
                            </div><!--row-->
                        @endif

                        <div class="form-group d-flex align-items-center justify-content-between">
                            <div class="form-check">
                                <input name="remember" id="remember" class="form-check-input" type="checkbox" {{ old('remember') ? 'checked' : '' }} />
                                <label class="form-check-label" for="remember">
                                    @lang('Remember Me')
                                </label>
                            </div><!--form-check--> 
                            <button class="btn" type="submit">@lang('Login')</button>                            
                        </div><!--form-group-->

                        <div class="text-center">
                            @include('frontend.auth.includes.social')
                        </div>
                    </x-forms.post>
                </div>
            </div>            
            
            <div class="col-12 text-center forgotPwdLink">
                <x-utils.link :href="route('frontend.auth.password.request')" class="btn btn-link text-white" :text="__('Forgot Your Password?')" />                    
            </div>

            <div class="col-12 text-center forgotPwdLink">
                <x-utils.link :href="route('frontend.auth.register')" class="btn btn-link text-white" :text="__('Not yet a member? Register here')" />                    
            </div>

            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->
</div>
@endsection
