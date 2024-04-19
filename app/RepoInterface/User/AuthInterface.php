<?php

namespace App\RepoInterface\User;

interface AuthInterface
{
    public function Register($request);
    public function Login($request);
    public function Logout($request);
}
