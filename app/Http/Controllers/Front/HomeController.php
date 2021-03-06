<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateNewsandUpdateRequest;
use App\Http\Resources\Admin\NewsandUpdateResource;
use App\Imageslide;
use App\NewsandUpdate;
use App\Budget;
use App\Vacancy;
use App\Page;
use App\Aboutuvalu;
use App\Tuvaluconstition;
use App\Tuvaludevelopmentplan;
use App\Holiday;
use App\ServiceCategory;
use App\ServicesSubCategory;

use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\Models\Media;

use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(){
        //Should initialise page to Home

        $page = Page::where('name','=','Home')->get();
        //$pageid = $page[0]->id;
        // $imageslides = Imageslide::where('page_id','=',$pageid);
        $imageslides = Imageslide::all();
        // return $imageslides;
        $newsandupdates = NewsandUpdate::orderBy('created_at','desc')->take(3)->get();

        $servicescategories = ServiceCategory::where('status','Publish')->get();
        $counts = ServiceCategory::where('status','Publish')->count(); 
      
      
        return view('front.home', compact('imageslides','newsandupdates','counts','servicescategories'));

    }

    public function directory(){

        return view('front.directory');
    }

    public function budget(){
        $budgets = Budget::all();
        return view('front.budget',compact('budgets'));
    }

    public function vacancies(){
        $vacancies = Vacancy::all()->where('status','=','Publish')->where('duedate','>',Carbon::now());
        return view('front.vacancies',compact('vacancies'));
    }
    public function showvacancies($id){
        $vacancy = Vacancy::find($id);

        // $vacancies = Vacancy::all()->where('status','=','Publish');
        return view('front.showvacancy',compact('vacancy'));
    }

    public function news(){
        $news = NewsandUpdate::where('type','=','news')->orderBy('created_at','asc')->get();

        return view('front.news',compact('news'));
    }

    public function shownews($id){
        $new = NewsandUpdate::find($id);
        return view('front.shownews',compact('new'));
    }
    public function announcement(){
        // $announcements = DB::table('newsand_updates')
        // ->where('type','=','update')
        // ->orderBy('created_at','desc')
        // ->get();

        $announcements = NewsandUpdate::where('type','=','update')->orderBy('created_at','asc')->get();
        // $announcements = NewsandUpdate::all();
        return view('front.announcement', compact('announcements'));
    }
    public function showannouncement( $id){
        // $announcement = DB::table('newsand_updates')
        // ->where('id','=',$id)
        // ->get();
        $announcement = NewsandUpdate::find($id);
        return view('front.showannouncement', compact('announcement'));
    }

    public function contact(){
        return view('front.contacts');

    }
    public function about(){
        $about = Aboutuvalu::first();
        $constitution = Tuvaluconstition::first();
        $tuvaludevelopmentplan = Tuvaludevelopmentplan::first();
        $holiday = Holiday::first();
       // return $about->description;
        return view('front.about', compact('about','constitution','tuvaludevelopmentplan','holiday'));
    }

    public function showsubcategory($id){
        $subcategories = ServicesSubCategory::all()->where('servicescategory_id',$id)->where('status','Publish');

        return view('front.servicessubcategory', compact('subcategories'));
    }
}
