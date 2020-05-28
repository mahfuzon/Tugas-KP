<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employees;

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
         $employees = Employees::orderby('name','asc')->select('id','name')->limit(5)->get();
      }else{
         $employees = Employees::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
      }

      $response = array();
      foreach($employees as $employee){
         $response[] = array("value"=>$employee->id,"label"=>$employee->name);
      }

      echo json_encode($response);
      exit;
   }
}