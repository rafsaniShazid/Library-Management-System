<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index(){
        return view('borrow.index');
    }

    public function store(string $bookId){
        return back();
    }

    public function destroy(string $borrowId){
        return back();
}
