<!--ADD SAMPLE CATEGORY ITEM-->
<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('admin_post.edit') !!}" class="btn btn-info pull-right">
            <i class="fa fa-plus"></i>{{trans('post::post_admin.post_add_button')}}
        </a>
    </div>
</div>
<!--/END ADD SAMPLE CATEGORY ITEM-->

@if( ! $posts->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>
                {{ trans('post::post_admin.order') }}
            </td>

            <th style='width:10%'>
                {{ trans('post::post_admin.post_id') }}
            </th>

            <th style='width:25%'>
                {{ trans('post::post_admin.post_title') }}
            </th>
            
            <th style='width:10%'>
                {{ trans('post::post_admin.user_id') }}
            </th>

            <th style='width:10%'>
                {{ trans('post::post_admin.user_id_assigned') }}
            </th>

            <th style='width:10%'>
                {{ trans('post::post_admin.user_id_reviewer') }}
            </th>

            <th style='width:10%'>
                {{ trans('post::post_admin.operations') }}
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
            $nav = $posts->toArray();
            $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($posts as $post)
        <tr>
            <!--COUNTER-->
            <td>
                <?php echo $counter; $counter++ ?>
            </td>
            <!--/END COUNTER-->

            <!--POST ID-->
            <td>
                {!! $post->post_id !!}
            </td>
            <!--/END POST ID-->

            <!--POST TITLE-->
            <td>
                {!! $post->post_title !!}
            </td>
            <!--/END POST TITLE-->

            <!--USER ID-->
            <td>
                {!! $post->user_id !!}
            </td>
            <!--/END USER ID-->

            <!--ASSIGNED ID-->
            <td>
                {!! $post->user_id_assigned !!}
            </td>
            <!--/END ASSIGNED ID-->

            <!--REVIEWER ID-->
            <td>
                {!! $post->user_id_reviewer !!}
            </td>
            <!--/END REVIEWER ID-->

            <!--OPERATOR-->
            <td>
                <a href="{!! URL::route('admin_post.edit', ['id' => $post->post_id]) !!}">
                    <i class="fa fa-edit fa-2x"></i>
                </a>
                <a href="{!! URL::route('admin_post.delete',['id' =>  $post->post_id, '_token' => csrf_token()]) !!}"
                   class="margin-left-5 delete">
                    <i class="fa fa-trash-o fa-2x"></i>
                </a>
                <span class="clearfix"></span>
            </td>
            <!--/END OPERATOR-->
        </tr>
        @endforeach
    </tbody>
</table>
@else
    <!-- FIND MESSAGE -->
    <span class="text-warning">
        <h5>
            {{ trans('post::post_admin.message_find_failed') }}
        </h5>
    </span>
    <!-- /END FIND MESSAGE -->
@endif
<div class="paginator">
    {!! $posts->appends($request->except(['page']) )->render() !!}
</div>