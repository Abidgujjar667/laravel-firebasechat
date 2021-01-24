<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use DataTables;
use App\DataTables\StudentsDataTable;
use App\DataTables\StudentsDataTableEditor;

class StudentsController extends Controller
{
    public function index(StudentsDataTable $dataTable){
        return $dataTable->render('yajra.index');
    }

    public function store(StudentsDataTableEditor $editor){
        return $editor->process(\request());
    }

    public function show(){
        return view('yajra.index');
    }

    public function getStudent(){
        $data=Student::latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->setRowAttr([
                'align' => 'center'
            ])
            ->make(true);
    }

    public function postStudent(StudentsDataTableEditor $editor){
        return $editor->process(\request());
    }
}
