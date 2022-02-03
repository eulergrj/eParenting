@extends('backend.layouts.app')

@section('title', __('Role Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Role Management')
        </x-slot>

        <x-slot name="headerActions">            
            <a href="{{route('admin.auth.role.create')}}" class="btn btn-success card-header-action">
                <i class="fa fa-plus"></i>
                Create Role
            </a>
        </x-slot>

        <x-slot name="body">
            <livewire:backend.roles-table />
        </x-slot>
    </x-backend.card>
@endsection
