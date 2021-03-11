<?php

namespace App\Http\Controllers;

use App\Advertise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class AdvertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $advertises = Advertise::all();
        return view('advertise.index', compact('advertises'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $fairId)
    {
        //
        return view('advertise.crupd', compact('fairId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'imgfile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:256',
        ]);
        $advertise = Advertise::create($request->all());

// $imagename = "";
        if (request()->hasfile('imgfile')) {
            $imagefile = request()->file('imgfile');
            $imagename = time() . "." . $request->imgfile->extension();
            $imagefilepath = public_path('storage/advertises/');
            $imagefile->move($imagefilepath, $imagename);
            $advertise->imgfile = $imagename;
        }
        if (request()->has('active')) {
                $advertise->active = 1;
        } else {
                $advertise->active = 0;
        }
        $advertise->save();

        return redirect(route('advertise.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advertise  $advertise
     * @return \Illuminate\Http\Response
     */
    public function show(Advertise $advertise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advertise  $advertise
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertise $advertise)
    {
        //
        return view('advertise.crupd', compact('advertise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advertise  $advertise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertise $advertise)
    {
        //
        $request->validate([
            'imgfile' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:256',
        ]);
        $advertise->update($request->all());

        if (request()->hasfile('imgfile')) {
            $imagefile = request()->file('imgfile');
            $imagename = time() . "." . $request->imgfile->extension();
            $imagefilepath = public_path('storage/advertises/');
            $imagefile->move($imagefilepath, $imagename);

            if ($advertise->imgfile != null) {
                if (Storage::exists($imagefilepath . $advertise->imgfile)){
                    File::delete($imagefilepath . $advertise->imgfile);
                }

            }
            $advertise->imgfile = $imagename;
        }
        if (!$request->has('active')) {
            $advertise->active = 0;
        }
        $advertise->save();

        return redirect(route('advertise.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advertise  $advertise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertise $advertise)
    {
        //
        $imagefilepath = public_path('/storage/advertises/');
        if ($advertise->imgfile != null) {
            if (Storage::exists($imagefilepath . $advertise->imgfile)){
                File::delete($imagefilepath . $advertise->imgfile);
            }

        }
        $advertise->delete();

    }
}
