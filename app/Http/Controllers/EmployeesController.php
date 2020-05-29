<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sekolah;

class EmployeesController extends Controller
{
   public function index(){
      return view('employees.index');
   }

   /*
   AJAX request
   */
   public function getEmployees(Request $request){

      $search = $request->search;

      if($search == ''){
         $employees = sekolah::orderby('nama_sekolah','asc')->select('nama_sekolah')->limit(5)->get();
      }else{
         $employees = sekolah::orderby('nama_sekolah','asc')->select('nama_sekolah')->where('nama_sekolah', 'like', '%' .$search . '%')->limit(5)->get();
      }

      $response = array();
      foreach($employees as $employee){
         $response[] = $employee->nama_sekolah;
      }

      echo json_encode($response);
      exit;
   }
}