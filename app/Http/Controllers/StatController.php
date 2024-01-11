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

        $totalArticlesUntilToday = Article::where('created_at', '<=', $currentDate)->count();
        $last30DaysArticles = Article::where('created_at', '>', $currentDate->subDays(30))->count();
        $ratio = ($totalArticlesUntilToday > 0) ? ($last30DaysArticles / $totalArticlesUntilToday) * 100 : 0;
        
        $last30DaysViewArticles = Article::where('created_at', '>', $currentDate->subDays(30))->sum('view_count');
        $totalViewRatio = ($totalView > 0) ? ($last30DaysArticles / $totalView) * 100 : 0;

        $totalCategoryUntilToday = Category::where('created_at', '<=', $currentDate)->count();
        $last30DaysCategory = Category::where('created_at', '>', $currentDate->subDays(30))->count();
        $ratioCategory = ($totalCategoryUntilToday > 0) ? ($last30DaysCategory / $totalCategory) * 100 : 0;
        

        return view('admin.home', compact('articlesView', 'totalView', 'gallery', 'goals', "totalCategory", "totalArticle", "ratio","ratioCategory","totalViewRatio"));
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
        $validatedData = $request->validate([
            'process_id' => 'required|integer',
            ]);
        $data = $request->except("_token");
        // $processId = $data['process_id'];
        $data['title'] = $this->getGoalTitle($validatedData['process_id']);

        Goal::create($data);
        alert()->success("başarılı", "Hedef başarıyla oluşturuldu.")->showConfirmButton("TAMAM")->autoClose(5000);
        return redirect()->back();
    }

    private function getGoalTitle($processId)
    {
        $titles = [
            1 => 'Blog Sayısı',
            2 => 'Kategori Sayısı',
            3 => 'Toplam Okunma Sayısı',
        ];
        return $titles[$processId] ?? 'Belirsiz';
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

    public function update(Request $request)
    {
        $data = $request->except("_token");
        $processId = $data['process_id'];
        $data['title'] = $this->getGoalTitle($processId);
        $goalQuery = Goal::query()->where("id", $request->id);
        $goalQuery->update($data);
        alert()->success("başarılı", "makala güncelleme işlemi başarılı")->showConfirmButton("TAMAM")->autoClose(5000);
        return redirect()->back();
    }
}
