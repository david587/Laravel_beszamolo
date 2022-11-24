<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Perfume;

class PerfumeController extends Controller
{
    public function getPerfumes() {
        $perfumes = Perfume::all();
        return view( "/perfumes",[
            "perfumes" => $perfumes
        ] );
    }


    public function newPerfume() {

        return view( "new_perfume" );
    }

    public function storePerfume( Request $request ) {
        $formFields = $request->validate([
            "name" => "required",
            "type" => "required",
            "price" => "required",
        ]);
        $perfume = new Perfume;
        $perfume->name = $request->name;
        $perfume->type = $request->type;
        $perfume->price = (int)$request->price;

        $perfume->save($formFields);
        // Listing::create($formFields);


        return redirect( "/perfumes" );
    }

    public function editPerfume( $id ) {

        $perfume = Perfume::find( $id );

        return view( "edit_perfume", [
            "perfume" => $perfume
        ]);
    }

    public function updatePerfume( Request $request ) {
        $perfume = Perfume::where("id",$request->id)->first();
        $perfume->name = $request->name;
        $perfume->type = $request->type;
        $perfume->price = $request->price;

        $perfume->save();
        return redirect("/perfumes");

    }

    public function deletePerfume( $id ) {

        $perfume = Perfume::find( $id );
        $perfume->delete();

        return redirect( "/perfumes" );
    }

    public function insertPerfumes(){
        DB::table("perfumes")->insert([
            ["name"=> "Coco", "type" => "Ibolya", "price"=>234],
            ["name"=> "Miss dior", "type" => "Tuberózsa", "price"=>213],
            ["name"=> "Tom taylor", "type" => "Jázmin", "price"=>216],
            ["name"=> "Axe", "type" => "Rozsa", "price"=>222],
            ["name"=> "Chanel", "type" => "Ciprus", "price"=>735]
        ]);
    }
}
