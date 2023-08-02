<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class courseController extends Controller
{
    public function index()
    {
        $data['courses'] = Course::orderBy('cid', 'asc')->paginate(5);
        return view('courses.index', $data);
    }
    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $req)
    {
        $req->validate([
            'cid' => 'required',
            'cname' => 'required'
        ]);
        $obj = new Course;
        $obj->cid = $req->cid;
        $obj->cname = $req->cname;

        $obj->save();
        
        return redirect()->route('courses.index')->with('success', 'A new course has been created!');
    }

    public function edit(Course $course){
        return view('courses.edit',compact('course'));
    }

    public function update(Request $req,$cid){
        $req->validate([
            'cid'=>'required',
            'cname'=>'required'
        ]);
        $obj = Course::find($cid);
        $obj->cid = $req->cid;
        $obj->cname = $req->cname;
        $obj->save();
        return redirect()->route('courses.index')->with('success','The course has been updated.');
    }
    
}