<?php

use Illuminate\Session\TokenMismatchException;

/**
 * FRONT
 */
Route::get('post', [
    'as' => 'post',
    'uses' => 'Group\Post\Controllers\Front\PostFrontController@index'
]);


/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////SAMPLES ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('admin/post', [
            'as' => 'admin_post',
            'uses' => 'Group\Post\Controllers\Admin\PostAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/post/edit', [
            'as' => 'admin_post.edit',
            'uses' => 'Group\Post\Controllers\Admin\PostAdminController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/post/edit', [
            'as' => 'admin_post.post',
            'uses' => 'Group\Post\Controllers\Admin\PostAdminController@up_post'
        ]);

        /**
         * delete
         */
        Route::get('admin/post/delete', [
            'as' => 'admin_post.delete',
            'uses' => 'Group\Post\Controllers\Admin\PostAdminController@delete'
        ]);
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////SAMPLES ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////




        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
         Route::get('admin/post_category', [
            'as' => 'admin_post_category',
            'uses' => 'Group\Post\Controllers\Admin\PostCategoryAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/post_category/edit', [
            'as' => 'admin_post_category.edit',
            'uses' => 'Group\Post\Controllers\Admin\PostCategoryAdminController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/post_category/edit', [
            'as' => 'admin_post_category.post',
            'uses' => 'Group\Post\Controllers\Admin\PostCategoryAdminController@post'
        ]);
         /**
         * delete
         */
        Route::get('admin/post_category/delete', [
            'as' => 'admin_post_category.delete',
            'uses' => 'Group\Post\Controllers\Admin\PostCategoryAdminController@delete'
        ]);
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
    });
});
