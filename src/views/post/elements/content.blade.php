<!-- POST NAME -->
<div class="form-group">
    <!-- GET DATA IF EXIST -->
    <?php 
    /*======================================================================*/
    // GET POST DESCRIPTION
    $post_description = $request->get('post_description') ? $request->get('post_description') : @$post->post_description;
    ?>
    

    <!--===================================================================-->
    <!--===================================================================-->
    <!-- CREATE FORM -->
    <!--===================================================================-->
    
    <!--===================================================================-->
    <!-- CREATE TEXT DESCRIPTION -->
    {!! Form::label($description, trans('post::post_admin.description').':') !!}
    {{ Form::textarea('post_description', $post_description, ['id' => 'description', 'placeholder' => 'Comment']) }}
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'description',{
            customConfig: 'custom_config.js',
        } );
    </script>

</div>
<!-- /POST NAME -->