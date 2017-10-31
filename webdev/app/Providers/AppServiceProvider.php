<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        \Collective\Html\FormBuilder::macro('datetimeLocale', function($name, $inputValue, $options = []){
            
                        // Get id.
                        if(isset($options['id'])){
                            $id = $optios['id'];
                            unset($options['id']);
                        } else {
                            $id = $name;
                        }
            
                        $attributes = '';
                        if(! empty($options)){
                            foreach($options as $key => $value){
                                $attributes .=" {$key}='{$value}' ";
                            }
                        }
            
                        if(! is_null($inputValue)){
                            $attributes .=" value=".old($name, $inputValue) ." ";
                        }
            
                        return '<input class="form-control" name="'.$name.'" type="datetime-local" id="'.$id.'" '.$attributes.'>';
                    });
    }
}
