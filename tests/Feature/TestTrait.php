<?php
/**
 * Created by PhpStorm.
 * User: Hussein Mirzaki
 * Date: 8/19/2018
 * Time: 10:12 PM
 */

namespace Tests\Feature;


use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;

trait TestTrait
{
    private $response;
    private $contains = false;
    use DatabaseMigrations;

    public function __call($name, $arguments)
    {
        collect(scandir(app_path()))->filter(function ($item) {
            return (str_contains($item, '.php'));
        })->each(function ($f) use ($name) {
            if ($this->contains)
                return;
            $this->contains = str_contains($f, studly_case($name));
        });
        if ($this->contains) {
            if ($arguments)
                return $this->create('App\\' . studly_case($name), $arguments[0]);
            return $this->create('App\\' . studly_case($name));
        }
    }

    public function create($model, $mount = null)
    {
        if ($mount > 1) {
            return factory($model, $mount)->create();
        }

        return factory($model)->create();
    }

    public function login($level = 1)
    {
        $user = null;
        if (is_numeric($level)) {
            $user = $this->user();
            $user->level = $level;
            $user->save();
        } else {
            $user = $level;
        }
        Auth::login($user);
    }

    public function tearDown()
    {
        if (isset($this->response->exception))
            if ($exception = $this->response->exception) {
                $this->response = null;
                dd($exception);
            }
    }
}