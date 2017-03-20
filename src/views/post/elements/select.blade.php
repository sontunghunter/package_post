<!-- CATEGORY LIST -->
<div class="form-group">

    <?php 
    $user_id_assigned = $request->get('user_id_assigned') ? $request->get('user_id_assigned') : @$post->user_id_assigned;
    $user_id_reviewer = $request->get('user_id_reviewer') ? $request->get('user_id_reviewer') : @$post->user_id_reviewer;
   	?>

    {!! Form::label('user_id_assigned', trans('post::post_admin.user_id_assigned').':') !!}
    {!! Form::select('user_id_assigned', @$users, @$users->id, ['class' => 'form-control'])!!}
    {!! Form::label('user_id_reviewer', trans('post::post_admin.user_id_reviewer').':') !!}
    {!! Form::select('user_id_reviewer', @$users, @$users->id, ['class' => 'form-control'])!!}
</div>
<!-- /CATEGORY LIST -->