<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Assist;

class ApiController extends Controller
{
    public function conditionStudent(Student $student,$id){
        
        //$estu = Student::All();
        $students = Student::with('assists')->find($id);
        //$estu= Student::->find($id);
        if ($students) {
            $asistencias = $students->assists->count();
            //$jsonStudent= json_decode($students);
            
            if ($asistencias >= 3) {
                echo "El estudiante Promociona. El total de asistencias del alumno es: $asistencias";
            } elseif ($asistencias == 2) {
                echo "El estudiante Regulariza. El total de asistencias del alumno es: $asistencias";
            } else {
                echo "El estudiante Desaprueba. El total de asistencias del alumno es: $asistencias";
            }
        } else {
            echo "No se encontró ningún estudiante con el ID especificado.";
        }    
    }
}
