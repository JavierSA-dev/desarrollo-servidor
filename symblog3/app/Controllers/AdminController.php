<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function adminDashboard()
    {
        return $this->renderHTML('admin.twig');
    }
}