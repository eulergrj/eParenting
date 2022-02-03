@extends('frontend.layouts.app')

@section('title', __('Please confirm your password before continuing.'))

@section('content')
    <div id="page-login">
        <div class="container py-4">
            <div class="row justify-content-center align-items-center" style="height: 85vh;">
                <div class="col-md-8">
                    <x-frontend.card>
                        <x-slot name="header">
                            <h4>@lang('Please confirm your password before continuing.')</h4>
                        </x-slot>
    
                        <x-slot name="body">
                            <x-forms.post :action="route('frontend.auth.password.confirm')">
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">@lang('Password')</label>
    
                                    <div class="col-md-6">
                                        <input type="password" name="password" class="form-control" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="current-password" />
                                    </div>
                                </div><!--form-group-->
    
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button class="btn" type="submit">@lang('Confirm Password')</button>
                                    </div>
                                </div><!--form-group-->
                            </x-forms.post>
                        </x-slot>
                    </x-frontend.card>
                </div><!--col-md-8-->
            </div><!--row-->
        </div><!--container-->
    </div>
@endsection
