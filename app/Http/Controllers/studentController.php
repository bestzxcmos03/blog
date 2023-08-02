<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
class studentController extends Controller
{
    //show all students list
    public function index(){
        $data['students'] = Student::orderBy('stid','asc')->paginate(5);
        return view('students.index',$data);
    }

    public function create(){
        return view('students.create');
    }

    public function store(Request $req){
        $req->validate([
            'stid'=>'required',
            'fname'=>'required',
            'lname'=>'required'
        ]);

        $obj = new Student;
        $obj->stid=$req->stid;
        $obj->fname=$req->fname;
        $obj->lname=$req->lname;

        $obj->save();

        return redirect()->route('students.index')->with('success','The new students has been created.');
    }

    public function edit(Student $student){
        return view('students.edit',compact('student'));
    }

    public function update(Request $req,$stid){
        $req->validate([
            'stid'=>'required',
            'fname'=>'required',
            'lname'=>'required',
        ]);
        $student=Student::find($stid);
        $student->stid=$req->stid;
        $student->fname=$req->fname;
        $student->lname=$req->lname;
        $student->save();
        return redirect()->route('students.index')->with('success','The student has been update successfully!');
    }
    public function destroy(Student $student){
        $temp=$student;
        $student->delete();
        return redirect()->route('students.index')->with('success',($temp->stid." ".$temp->fname." ".$temp->lname." has been delete successfully!"));
    }
}
