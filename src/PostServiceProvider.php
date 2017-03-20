<?php

namespace Group\Post;

use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;

use URL, Route;
use Illuminate\Http\Request;


class PostServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request) {
        /**
         * Publish
         */
         $this->publishes([
            __DIR__.'/config/post_admin.php' => config_path('post_admin.php'),
        ],'config');

        $this->loadViewsFrom(__DIR__ . '/views', 'post');


        /**
         * Translations
         */
         $this->loadTranslationsFrom(__DIR__.'/lang', 'post');


        /**
         * Load view composer
         */
        $this->postViewComposer($request);

         $this->publishes([
                __DIR__.'/../database/migrations/' => database_path('migrations')
            ], 'migrations');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        include __DIR__ . '/routes.php';

        /**
         * Load controllers
         */
        $this->app->make('Group\Post\Controllers\Admin\PostAdminController');

         /**
         * Load Views
         */
        $this->loadViewsFrom(__DIR__ . '/views', 'post');
    }

    /**
     *
     */
    public function postViewComposer(Request $request) {

        view()->composer('post::post*', function ($view) {
            global $request;
            $post_id = $request->get('id');
            $is_action = empty($post_id)?'page_add':'page_edit';

            $view->with('sidebar_items', [

                /**
                 * Posts
                 */
                //list
                trans('post::post_admin.page_list') => [
                    'url' => URL::route('admin_post'),
                    "icon" => '<i class="fa fa-users"></i>'
                ],
                //add
                trans('post::post_admin.'.$is_action) => [
                    'url' => URL::route('admin_post.edit'),
                    "icon" => '<i class="fa fa-users"></i>'
                ]
            ]);
            //
        });
    }

}
