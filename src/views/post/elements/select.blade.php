<!-- ATTRIBUTE LIST -->
<div class="form-group">

	<!--===================================================================-->
    <!-- GET USER_ID -->
    <?php 
    $user_id_assigned = $request->get('user_id_assigned') ? $request->get('user_id_assigned') : @$post->user_id_assigned;

    $user_id_reviewer = $request->get('user_id_reviewer') ? $request->get('user_id_reviewer') : @$post->user_id_reviewer;

    $category_id = $request->get('category_id') ? $request->get('category_id') : @$post->category_id;
   	?>
	<!--===================================================================-->
    <!-- CREATE SELECT USER_EMAIL_ASSIGNED -->
    {!! Form::label('user_id_assigned', trans('post::post_admin.user_id_assigned').':') !!}

    {!! Form::select('user_id_assigned', @$users, @$post->user_id_assigned, ['class' => 'form-control'])!!}

	<!--===================================================================-->
    <!-- CREATE SELECT USER_EMAIL_REVIEWERS -->
    {!! Form::label('user_id_reviewer', trans('post::post_admin.user_id_reviewer').':') !!}

    {!! Form::select('user_id_reviewer', @$users, @$post->user_id_reviewer, ['class' => 'form-control'])!!}

    <!--===================================================================-->
    <!-- CREATE SELECT CATEGORIES -->
    {!! Form::label('category_id', trans('post::post_admin.category_id').':') !!}
    
	{!! Form::select('category_id', @$categories, @$post->category_id, ['class' => 'form-control'])!!}
   
</div>
<!-- /CATEGORY LIST -->