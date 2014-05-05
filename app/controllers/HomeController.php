<?php
class HomeController extends BaseController {

    public function showWelcome()
    {
        return View::make('home');
    }

    public function showSecret()
    {
        return View::make('secret');
    }

}