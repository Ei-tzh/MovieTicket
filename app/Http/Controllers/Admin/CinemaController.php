<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CinemaRequest;
use App\Http\Requests\CinemaUpdateRequest;
use App\Cinema;
use App\Township;
use App\Movie_theater;
class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cinemas=Cinema::all();
        foreach($cinemas as $cinema){
            $township=$cinema->township;
            $theaters=$cinema->theaters;
        }
        //return $cinemas;
        return view('admin.cinemas.index',compact('cinemas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $townships=Township::all();
        return view('admin.cinemas.create',compact('townships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CinemaRequest $request)
    {
    
        
        $validated = $request->validated();
        $filename = $request->image->getClientOriginalName();
        $request->image->storeAs('/public/images/cinemas',$filename);
        $url=Storage::url('images/cinemas/'.$filename);
        
        $phone=implode(",",$request->ph_no);
        $cinema=Cinema::create([
            'name' => $request->name,
            'address'=>$request->address,
            'ph_no'=>$phone,
            'image' => $url,
            'township_id'=>$request->township
        ]);
        $cinema_theater=Cinema::find($cinema->id);
       foreach($request->theaters as $theater){
            
            $cinema_theater->theaters()->create([
                'name' =>$theater,
                'location'=>'2nd floor'
            ]);
       }
       
        return redirect()->route('cinemas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cinema=Cinema::find($id);
        $township=$cinema->township;
        $theaters=$cinema->theaters;
        //$movie_theaters=[];
        foreach($theaters as $val){
            $movies=$val->movies;
        } 
        
        return view('admin.cinemas.show',compact('cinema','township','theaters'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cinema=Cinema::find($id);
        $theaters=$cinema->theaters;
        $phone_no=explode(',',$cinema->ph_no);
        $townships=Township::all();
        return view('admin.cinemas.edit',compact('cinema','theaters'))->with('phoneno',$phone_no)->with('townships',$townships);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CinemaUpdateRequest $request, $id)
    {
        $validated = $request->validated();
        // for creating new theaters and deleting existing theaters

        $update_theater=$request->theaters;//theaters by post method
        $cinema=Cinema::find($id);//before updatind theaters
        $theaters=$cinema->theaters;
        $phone=implode(",",$request->ph_no);
        foreach($theaters as $val){
            $name[]=$val->name;
        }

        $remove=$this->removeTheater($name,$update_theater);//for deleting existing theaters

        $update=$this->updateTheater($name,$update_theater);//for creating new theaters
        foreach($remove as $val){
            $cinema->theaters()->where('name',$val)->delete();
        }
        
        foreach($update as $val){
            $cinema->theaters()->create([
                'name'=>$val,
                'location'=>'2nd floor',
                'cinema_id'=>$cinema->id
            ]);
        }
        // for uploading image

        if($request->hasfile('image')){
            if(file_exists(public_path($cinema->image))){
                unlink(public_path($cinema->image));
            }
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('/public/images/cinemas/',$filename);
            $url=Storage::url('images/cinemas/'.$filename);
        }
        Cinema::where('id',$id)->update([
                "name" => $request->name,
                "address"=>$request->address,
                "ph_no" => $phone,
                "image"=>$request->image==''? $cinema->image:$url,
                "township_id"=>$request->township
        ]);
        $request->session()->flash('status','Congratulation,You have updated successfully!');
        return redirect()->route('cinemas.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    protected function removeTheater(array $a,array $b){
        $array1=array_diff($a,$b);
        $array2=array_diff($b,$a);

        $output = array_merge($array1, $array2);
        $remove=array_intersect($a,$output);
        return $remove;
    }
    protected function updateTheater(array $name,array $request){
        $array1=array_diff($name,$request);
        $array2=array_diff($request,$name);

        $output = array_merge($array1, $array2);
        $edit=array_diff($output,$name);
        return $edit;
    }
}
