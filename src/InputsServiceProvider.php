<?php

namespace Vicoders\Input;

use Illuminate\Support\ServiceProvider;
use Vicoders\Input\Abstracts\Input;
use Vicoders\Input\Facades\ThemeOptionManager;

class InputsServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        // All your actions that registered here will be bootstrapped

        $this->app->singleton('ContactFormManager', function ($app) {
            return new Manager;
        });

        if (is_admin()) {
            $this->registerAdminPostAction();
            $this->registerOptionPage(); // it require nf/theme-option package in template
        }
    }

    public function registerCommand()
    {
        // Register your command here, they will be bootstrapped at console
        //
        // return [
        //     PublishCommand::class,
        // ];
    }

    public function registerAdminPostAction()
    {
        add_action('admin_enqueue_scripts', function () {
            wp_enqueue_media();
        });

        add_action('admin_enqueue_scripts', function () {
            wp_enqueue_style(
                'input-style',
                wp_slash(get_stylesheet_directory_uri() . '/vendor/nf/input/assets/dist/app.css'),
                false
            );
            wp_enqueue_script(
                'input-scripts',
                wp_slash(get_stylesheet_directory_uri() . '/vendor/nf/input/assets/dist/app.js'),
                'jquery',
                '1.0',
                true
            );
        });
    }

    public function registerOptionPage()
    {
        // \NightFury\Option\Facades\ThemeOptionManager::add([
            
        // ]);
    }
}
