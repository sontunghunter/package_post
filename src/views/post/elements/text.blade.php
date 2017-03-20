<!-- POST NAME -->
<div class="form-group">
	<!-- GET DATA IF EXIST -->
    <?php 
    // GET POST TITLE
    $post_title = $request->get('post_title') ? $request->get('post_title') : @$post->post_title;

    /*======================================================================*/
    // GET POST OVERVIEW
    $post_overview = $request->get('post_overview') ? $request->get('post_overview') : @$post->post_overview;
    
    /*======================================================================*/
    // GET POST DESCRIPTION
    $post_description = $request->get('post_description') ? $request->get('post_description') : @$post->post_description;
    
    /*======================================================================*/
    // GET POST NOTES
    $post_notes = $request->get('post_notes') ? $request->get('post_notes') : @$post->post_notes;

    /*======================================================================*/
    // GET LOGGED USER ID
    $user = Sentry::getUser();
    $user_id = $user['id'];
    ?>
    

    <!--===================================================================-->
    <!--===================================================================-->
    <!-- CREATE FORM -->
    <!--===================================================================-->

    <!-- CREATE TEXT TITLE -->
    {!! Form::label($title, trans('post::post_admin.title').':') !!}
    {!! Form::text($title, $post_title, ['class' => 'form-control', 'placeholder' => trans('post::post_admin.title').'']) !!}

    <!--===================================================================-->
    <!-- CREATE TEXT OVERVIEW -->
    {!! Form::label($overview, trans('post::post_admin.overview').':') !!}
    {!! Form::text($overview, $post_notes, ['class' => 'form-control', 'placeholder' => trans('post::post_admin.overview').'']) !!}
    
    <!--===================================================================-->
    <!-- CREATE TEXT DESCRIPTION -->
    {!! Form::label($description, trans('post::post_admin.description').':') !!}
    {!! Form::text($description, $post_description, ['class' => 'form-control', 'placeholder' => trans('post::post_admin.description').'']) !!}
    
    <!--===================================================================-->
    <!-- CREATE TEXT NOTES -->
    {!! Form::label($notes, trans('post::post_admin.notes').':') !!}
    {!! Form::text($notes, $post_notes, ['class' => 'form-control', 'placeholder' => trans('post::post_admin.notes').'']) !!}
    
    <!--===================================================================-->
    <!-- CREATE HIDDEN USER_ID -->
    {{ Form::hidden("user_id", $user_id) }}

</div>
<!-- /POST NAME -->