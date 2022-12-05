<?php

//function get session user id
function userid()
{
    return session()->get('id');
}

//function get session username
function fullname()
{
    return session()->get('fullname');
}

//function get session user role
function studentid()
{
    return session()->get('studentid');
}

//function get session user email
function useremail()
{
    return session()->get('email');
}

//function get session user role
function role()
{
    return session()->get('role');
}
