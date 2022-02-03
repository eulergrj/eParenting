@extends('frontend.layouts.app')

@section('title', __('Reset Password'))

@section('content')
<div id="page-login">
    <div class="container py-4">
        <div class="row justify-content-center align-items-center" style="height: 85vh;">
            <div class="col-md-5">
                
                <div class="col-12 text-center">
                    <h3 class="text-white"><span style="color:gold">e</span>Parenting</h3><br/>
                </div>

                <x-frontend.card>
                    <x-slot name="body">
                        <x-forms.post :action="route('frontend.auth.password.email')">
                            <div class="form-group row">                                
                                <div class="col-12">
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="{{ __('E-mail Address') }}" maxlength="255" required autofocus autocomplete="email" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <div class="col-12 text-center">
                                    <button class="btn" type="submit">@lang('Send Password Reset Link')</button>
                                </div>
                            </div><!--form-group-->
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
                <div class="col-12 text-center forgotPwdLink">                    
                    <a href="{{route('frontend.auth.login')}}" class="btn btn-link text-white">< Back to login</a>                  
                </div>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->
</div>
@endsection
