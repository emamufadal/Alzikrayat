<?php

// Handles the public pages of the application.
class HomeController extends Controller
{
// Render the home page.
    public function index(): void
    {
        $this->render('home');
    }

// Render the About Us page.
    public function about(): void
    {
        $this->render('about');
    }

// Render the successful registration page.
    public function registered(): void
    {
        $this->render('auth/registered');
    }
}
