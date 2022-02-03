@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@push('after-styles')
    @include('backend.includes.datatables_styles')
@endpush

@section('page-header-content')
    <form id="dateRangeform" method="GET" action="{{route('admin.dashboard')}}">        
        <input id="start_date" type="hidden" name="start_date" value="">
        <input id="end_date" type="hidden" name="end_date" value="">        
    </form>
    <ul class="app-actions d-flex align-items-center">
        <li>        
            <i class="icon-calendar text-danger" style="font-size: 20px; margin-right: 8px"></i>
        </li>
        <li>
            <a href="#" id="dateRange" class="dateRange">
                <span class="range-text"></span>
                <i class="icon-chevron-down"></i>	
            </a>
        </li>
        {{-- <li>
            <a href="#">
                <i class="icon-export"></i>
            </a>
        </li> --}}
    </ul>    
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Dashboard
        </x-slot>

        <x-slot name="body">                        
            <h4>{{$greeting}}, <span style="color: #38BFB3">{{$logged_in_user->name}}</span>!</h4> <br/><br/>
            
            <label>Display Results for: &nbsp;</label>
            <select class="form-select" aria-label="Default select example">
                <option selected>All Members</option>
                @foreach ($fmembers as $member)
                    <option value="{{$member->id}}">{{$member->fname}} {{$member->lname}}</option>
                @endforeach
            </select>
        </x-slot>
    </x-backend.card>

    <div class="row">
        <div class="col-sm-4 col-xs-12">
            <div class="card">
                <div class="card-header">Viewing Time per Member</div>
                <div class="card-body" style="min-height: 200px"></div>
            </div>
        </div>
        
        <div class="col-sm-4 col-xs-12">
            <div class="card">
                <div class="card-header">Most watched Categories</div>
                <div class="card-body" style="min-height: 200px"></div>
            </div>
        </div>

        <div class="col-sm-4 col-xs-12">
            <div class="card">
                <div class="card-header">Most watched Platforms</div>
                <div class="card-body" style="min-height: 200px"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4 col-xs-12">
            <div class="card">
                <div class="card-header">Time Spent per Platform</div>
                <div class="card-body" style="min-height: 200px"></div>
            </div>
        </div>
        
        <div class="col-sm-8 col-xs-12">
            <div class="card">
                <div class="card-header">Latest Viewing History</div>
                <div class="card-body" style="min-height: 200px"></div>
            </div>
        </div>

    </div>
@endsection

@push('after-scripts')      
    @include('backend.includes.datatables_scripts')  
    <script type="text/javascript">    
        
    </script>
@endpush