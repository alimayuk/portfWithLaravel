<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Goal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatController extends Controller
{
    // ...

    public function viewStat()
    {
        $articlesView = Article::orderBy('view_count', 'DESC')->get();
        $currentDate = Carbon::now();
        $gallery = Gallery::all();
        $totalCategory = Category::count();
        $totalArticle = Article::count();
        $goals = Goal::all();
        $totalView = Article::sum('view_count');

        $results = $this->calculateResults($goals, $totalArticle, $totalCategory, $totalView);

        $this->updateArticlesView($articlesView, $currentDate);

        $this->updateGoals($goals, $results, $currentDate);

        return view('admin.home', compact('articlesView', 'totalView', 'gallery', 'goals'));
    }

    private function calculateResults($goals, $totalArticle, $totalCategory, $totalView)
    {
        $results = [];

        foreach ($goals as $goal) {
            switch ($goal->process_id) {
                case 1:
                    $results[$goal->id] = ($totalArticle / $goal->goalNumber) * 100;
                    break;
                case 2:
                    $results[$goal->id] = ($totalCategory / $goal->goalNumber) * 100;
                    break;
                case 3:
                default:
                    $results[$goal->id] = ($totalView / $goal->goalNumber) * 100;
                    break;
            }
        }

        return $results;
    }

    private function updateArticlesView($articlesView, $currentDate)
    {
        foreach ($articlesView as $article) {
            $createdAt = Carbon::parse($article->created_at);
            $daysDifference = $createdAt->diffInDays($currentDate);
            $article->daysDifference = $daysDifference;
        }
    }

    private function updateGoals($goals, $results, $currentDate)
    {
        foreach ($goals as $goal) {
            $createdAt = Carbon::parse($goal->created_at);
            $daysDifference = $createdAt->diffInDays($currentDate);
            $goal->daysDifference = $daysDifference;
            $goal->result = $results[$goal->id] ?? null;
        }
    }
    public function goalCreate(Request $request)
    {
        $data = $request->except("_token");
        $processId = $data['process_id'];

        switch ($processId) {
            case 1:
                $data['title'] = 'Blog Sayısı';
                break;
            case 2:
                $data['title'] = 'Kategori Sayısı';
                break;
            case 3:
                $data['title'] = 'Toplam Okunma Sayısı';
                break;
            default:
                $data['title'] = 'Belirsiz';
                break;
        }
        Goal::create($data);
        alert()->success("başarılı", "Hedef başarıyla oluşturuldu.")->showConfirmButton("TAMAM")->autoClose(5000);
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $request->validate(['id' => ["required", "integer"]]);
        $goalID = $request->id;
        $goal = Goal::where('id', $goalID)->first();

        $goal->delete();
        alert('Başarılı', 'Silme İşlemi Başarılı', 'success');
        return redirect()->back();
    }

}
