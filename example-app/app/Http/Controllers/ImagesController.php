<?php

namespace App\Http\Controllers;

use App\Models\Images;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('images.index', ['images'=>Images::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $filename = $data['image']->getClientOriginalName();
        $name = $data['name'];

        $data['image']->move(Storage::path('/public/image/').'origin/',$filename);

        //миниатюра
        $thumbnail = Image::make(Storage::path('/public/image/').'origin/'.$filename);
        $thumbnail->fit(300, 300);
        $thumbnail->save(Storage::path('/public/image/').'thumbnail/'.$filename);

        //сохраняем в бд
        if (DB::table('images')->where('name', $name)->exists()) {
            $data['image'] = $filename;
            $data['name'] = strval($name).strval(random_int(1,9999999));
            Images::create($data);
        }else{
            $data['image'] = $filename;
            Images::create($data);
        }


        return redirect()->route('images.index');
    }

}
