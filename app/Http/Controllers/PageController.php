<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() { return view('pages.home'); }
    public function calculator() { return view('pages.calculator'); }
    public function campaigns() { return view('pages.campaigns'); }
    public function transparency() { return view('pages.transparency'); }
    public function apply() { return view('pages.apply'); }
    public function faq() { return view('pages.faq'); }
    public function contact() { return view('pages.contact'); }
    public function login() { return view('pages.login'); }
    public function signup() { return view('pages.signup'); }
    public function hadith() { return view('pages.hadith'); }
    public function prayer() { return view('pages.prayer'); }
    public function lectures() { return view('pages.lectures'); }
    public function tasbeeh() { return view('pages.tasbeeh'); }
}
