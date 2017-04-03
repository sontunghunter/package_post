@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: {{ trans('post::post_admin.page_edit') }}
@stop

@section('head_css')
<script src="/posts/ckeditor/ckeditor.js"></script>
<script src="/posts/js/post_desription.js"></script>

@stop

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!! !empty($post->post_id) ? '<i class="fa fa-pencil"></i>'.trans('post::post_admin.form_edit') : '<i class="fa fa-users"></i>'.trans('post::post_admin.form_add') !!}
                    </h3>
                </div>
                <!-- ERRORS NAME  -->
                {{-- model general errors from the form --}}
                @if($errors->has('post_title') )
                    <div class="alert alert-danger">{!! $errors->first('post_title') !!}</div>
                @endif
                <!-- /END ERROR NAME -->
                
                <!-- LENGTH NAME  -->
                @if($errors->has('name_unvalid_length') )
                    <div class="alert alert-danger">{!! $errors->first('name_unvalid_length') !!}</div>
                @endif
                <!-- /END LENGTH NAME -->

                {{-- successful message --}}
                <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                <div class="alert alert-success">{{$message}}</div>
                @endif

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <!-- POST ID -->
                            <h4>{!! trans('post::post_admin.form_heading') !!}</h4>
                            {!! Form::open(['route'=>['admin_post.post', 'id' => @$post->post_id],  'files'=>true, 'method' => 'post'])  !!}

                            <!--END POST ID  -->

                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#home">
                                        {!! trans('post::post_admin.tab_overview') !!}
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#menu1">
                                        {!! trans('post::post_admin.tab_attributes') !!}
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#menu2">
                                        {!! trans('post::post_admin.tab_post_content') !!}
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">

                                <!--TEMPLATE OVERVIEW-->
                                <div id="home" class="tab-pane fade in active">
                                    
                                    <!-- POST TEXT-->
                                    @include('post::post.elements.text', [
                                    'title' => 'post_title',
                                    'overview' => 'post_overview',
                                    'description' => 'post_description',
                                    'notes' => 'post_notes'])
                                    <!-- /END POST TEXT -->

                                </div>

                                <!--TEMPLATE ATTRIBUTES-->
                                <div id="menu1" class="tab-pane fade">
                                    <!-- POST ATTRIBUTES-->

                                    @include('post::post.elements.select', ['user_id' => 'user_id'])
                                    <!-- /END POST ATTRIBUTES -->
                                </div>

                                <div id="menu2" class="tab-pane fade">
                                    <!-- POST CONTENT-->

                                    @include('post::post.elements.content', [
                                    'description' => 'post_description'])
                                    <!-- /END POST CONTENT -->
                                </div>

                            </div>

                            
                            {!! Form::hidden('id',@$post->post_id) !!}

                            <!-- DELETE BUTTON -->
                            <a href="{!! URL::route('admin_post.delete',['id' => @$post->id, '_token' => csrf_token()]) !!}"
                               class="btn btn-danger pull-right margin-left-5 delete">
                                Delete
                            </a>
                            <!-- DELETE BUTTON -->

                            <!-- SAVE BUTTON -->
                            {!! Form::submit('Save', array("class"=>"btn btn-info pull-right ")) !!}
                            <!-- /SAVE BUTTON -->

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class='col-md-4'>
            @include('post::post.admin.post_search')
        </div>

    </div>
</div>
@stop