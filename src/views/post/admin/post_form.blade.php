@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: {{ trans('post::post_admin.page') }}
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin"><i class="fa fa-group"></i> {!! 'Post' !!}</h3>
                </div>
                <div class="panel-body">
                    Admin Post
               </div>
           </div>
        </div>
        <div class="col-md-4">
            @include('post::post.admin.post_search')
        </div>
    </div>
</div>
@stop