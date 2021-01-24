<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use DataTables;
use App\DataTables\StudentsDataTable;
use App\DataTables\StudentsDataTableEditor;

class StudentController extends Controller
{
    /*public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = Student::latest()->get();
            return Datatables::of($user)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })

                ->setRowId(function ($user) {
				    return $user->id;
				})
				->setRowClass(function ($user) {
				    return $user->id % 2 == 0 ? 'alert-info' : 'alert-danger';
				})
				->setRowAttr([
				    'align' => 'center'
				])



                ->rawColumns(['action'])
                ->make(true);
        }
      
        return view('yajra.student');
    }*/

    public function index(StudentsDataTable $dataTable){
        return $dataTable->render('yajra.student');
    }

    public function store(StudentsDataTableEditor $editor){
        return $editor->process(\request());
    }
}
