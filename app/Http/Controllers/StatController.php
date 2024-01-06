<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function viewStat(){
        $mostView = Article::orderBy('view_count','DESC')->take(3)->get();
        $suankiTarih = Carbon::now();
        
        foreach ($mostView as $article) {
            $olusturmaTarihi = Carbon::parse($article->created_at);
            $gunFarki = $olusturmaTarihi->diffInDays($suankiTarih);
            $article->gunFarki = $gunFarki;
        }

        $totalView = Article::sum('view_count');
        
        return view('admin.home', compact('mostView','totalView'));
    }
}
