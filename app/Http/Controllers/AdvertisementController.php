<?php

namespace App\Http\Controllers;

use App\Models\Advertisements;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Monolog\Handler\collectLogs;
use function Symfony\Component\Mime\Header\all;
use function Symfony\Component\Translation\t;

class AdvertisementController extends Controller
{
    public function index($category = null)
    {

        $categories = Category::all();
        $utility_collection = collect(['category' => $category]);

        if($category == null)
        {
            $utility_collection->put('is_first', false);
        } else
        {
            $utility_collection->put('is_first', true);
            $category = $utility_collection['category'];
        }

        if($utility_collection['is_first'] == true)
        {
            $advertisements = Advertisements::query()->where('category_id','=', $category)->orderBy('updated_at','desc')->get() ;
        } else
       {
           $advertisements = Advertisements::all()->sortByDesc('updated_at') ;
       }

        return view('index',compact('advertisements', 'categories','utility_collection'));

    }

    public function store(Request $request)
    {

           Advertisements::create($request->all());
           return redirect()->route('index');

    }

    public function update(Request $request)
    {
        $id = $request->id;
        $advertisement = Advertisements::where('id','=',$id)->first();
        if(!Advertisements::isDayPast($advertisement->updated_at)){
            $advertisement->update(['updated_at' => Carbon::now()]);
        }
    return redirect()->route('index');
    }
}
