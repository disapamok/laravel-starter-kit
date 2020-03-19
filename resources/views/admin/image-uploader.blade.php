@extends('layouts.master')

@section('css')
    <link href="{{ URL::asset('plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title">Customer Logos</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home Page</a></li>
        <li class="breadcrumb-item active">Customers</li>
    </ol>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                {!! $component->get() !!}

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection
