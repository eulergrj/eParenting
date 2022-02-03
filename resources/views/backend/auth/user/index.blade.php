@extends('backend.layouts.app')

@section('title', __('User Management'))

@section('breadcrumbs')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('User Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">               
                <a href="{{route('admin.auth.user.create')}}" class="btn btn-success card-header-action">
                    <i class="fa fa-plus"></i>
                    Create User
                </a>
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.users-table />
        </x-slot>
    </x-backend.card>
@endsection
