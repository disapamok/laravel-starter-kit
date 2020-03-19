@extends('layouts.master')

@section('css')
    <link href="{{ URL::asset('plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title">Sliders</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home Page</a></li>
        <li class="breadcrumb-item active">Slider</li>
    </ol>
</div>
@endsection

@section('content')



<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="mt-0 header-title">Front page sliders</h4>
                            <p class="text-muted m-b-30">Use action buttons to add/edit or remove an item.</p>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-primary float-right waves-effect waves-light" data-toggle="modal" data-target="#{{$modal->id}}">{{$modal->title}}</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Slider Caption</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <th scope="row">{{$row->id}}</th>
                                        <td>{{$row->title}}</td>
                                        <td>{{$row->caption}}</td>
                                        <td class="zoom-gallery">
                                            <a class="float-left" title="{{$row->title}}" href="{{$row->img}}">Show Image</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('layouts.modal',['modal' => $modal])
@endsection

@section('script')

@endsection
