
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('post::post_admin.page_search') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_post','method' => 'get']) !!}

        <!--TITLE-->
		<div class="form-group">
            {!! Form::label('post_title',trans('post::post_admin.post_title_label')) !!}
            {!! Form::text('post_title', @$params['post_title'], ['class' => 'form-control', 'placeholder' => trans('post::post_admin.post_title')]) !!}
        </div>

        {!! Form::submit(trans('post::post_admin.search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>




