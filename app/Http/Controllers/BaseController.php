<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Http\Requests;
use URL;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $routeBase;

    protected function backWithError($validator, $params = null) {
        if($params) {
            $params = ends_with(URL::previous(), $params) ? '' : $params;
        }
        return redirect()->to(URL::previous().$params)->withErrors($validator);
    }

    protected function indexRedirectWithFlash($msg, $params = [], $class = 'success') {
        return redirect()->route($this->routeBase . '.index', $params)
            ->with('flash-msg', $msg)
            ->with('flash-class', $class);
    }

    protected function routeRedirectWithFlash($route, $routeParams, $msg, $class = 'success') {
        return redirect()->route($route, $routeParams)
            ->with('flash-msg', $msg)
            ->with('flash-class', $class);
    }

    protected function withFlash($msg, $class = 'success') {
        return with('flash-msg', $msg)
            ->with('flash-class', $class);
    }

    protected function logoutWithFlash($route, $msg, $class = 'success') {
        Auth::logout();
        return redirect()->route($route)
            ->with('flash-msg', $msg)
            ->with('flash-class', $class);
    }

    protected function backWithFlash($msg, $class = 'success', $params = '') {
        if($params) {
            $params = ends_with(URL::previous(), $params) ? '' : $params;
        }
        return redirect()->to(URL::previous() . $params)
            ->with('flash-msg', $msg)
            ->with('flash-class', $class);
    }

}
