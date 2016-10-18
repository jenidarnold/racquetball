<?php namespace App\Http\Controllers;
use Redirect;
use Socialize;

class AccountController extends Controller {
  // To redirect github
  public function github_redirect() {
    return Socialize::with('github')->redirect();
  }
  // to get authenticate user data
  public function github() {
    $user = Socialize::with('github')->user();
    // Do your stuff with user data.
    print_r($user);die;
  }


  // To redirect facebook
  // Facebook App ID: 707155052773927
  public function facebook_redirect() {
    return Socialize::with('facebook')->redirect();
  }
  // to get authenticate user data
  public function facebook() {
    $user = Socialize::with('facebook')->user();
    // Do your stuff with user data.
    print_r($user);die;
  }
}