<?php

if (!function_exists('authAdmin')) {
    function authAdmin()
    {
        return auth()->guard('admin')->user();
    }
}

if (!function_exists('authAdminId')) {
    function authAdminId(): ?int
    {
        return data_get(authAdmin(), 'id');
    }
}

if (!function_exists('authUser')) {
    function authUser()
    {
        return auth()->user();
    }
}

if (!function_exists('authUserId')) {
    function authUserId(): ?int
    {
        return data_get(authUser(), 'id');
    }
}
