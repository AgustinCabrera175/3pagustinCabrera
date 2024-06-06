<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Models\Assist; 
use App\Models\Parametro;
use Carbon\Carbon;

use PDF;


class StudentController extends Controller
{
    public function generatePDF()
    {
      
        $students = Student::all(); // Obtén todos los estudiantes

        $pdf = PDF::loadView('students_pdf', ['students' => $students]);

        //return $pdf->download('students_list.pdf'); // Descarga el PDF
        return $pdf->stream('students_list.pdf'); // Muestra el PDF en el navegador
    }
    public function index() 
{
    $students = Student::paginate(10);
    $parametros = Parametro::first(); // Assuming there's only one set of parameters

    // Initialize an array to hold students and their conditions
    $studentsWithConditions = [];

    foreach ($students as $student) {
        $totalAssists = $student->assists->count();

        
        if ($parametros && $parametros->parametros > 0) {
            $asistenciaPorcentaje = ($totalAssists / $parametros->parametros) * 100;
        } else {
            $asistenciaPorcentaje = 0;
        }

        
        if ($parametros && $asistenciaPorcentaje >= $parametros->porcentajePromocion) {
            $condition = 'Promocionado';
            $colorCondition="text-success";
        } elseif ( $parametros && $asistenciaPorcentaje >= $parametros->porcentajeRegular) {
            $condition = 'Regular';
            $colorCondition="text-warning";
        } else {
            $condition = 'Libre';
            $colorCondition="text-danger";
        }

        // Add the student and their condition to the array
        $studentsCondition[] = [
            'student' => $student,
            'condition' => $condition,
            'colorCondition'=>$colorCondition
        ];
    }

    return view('students.index', [
        'studentsCondition' => $studentsCondition,
        
        'parametros' => $parametros
    ]);
}
    //$student= Student::All();
    //return $student;
    public function cumple(Student $student){
        $studentsCumple = [];
        $students = DB::select('SELECT * FROM students');
        
        
        foreach ($students as $student) {
        
            if (Carbon::parse($student->fechaNacimiento)->isBirthday()) {
                
                $studentsCumple[] = $student;
            }
        }
        
        if (count($studentsCumple) > 0) {

            $message = '¡Feliz cumpleaños a: ';
            foreach ($studentsCumple as $studentCumple) {
                $message .= $studentCumple->nombre . ', ';
            }
            
            $message = rtrim($message, ', ') . '!';
            
            return redirect()->route('students.index')
                ->with('cumple', $message);
        } else {
            
            return redirect()->route('students.index')
                ->with('cumple', 'Hoy no hay ningún cumpleaños.');
        }
    }
    //$jsonStudent= json_decode($student);
    public function mandar($id) {
        $student = Student::find($id);
        return $student;
    }

    public function create() : View
    {
        return view('students.create');
    }

    public function store(StoreStudentRequest $request) : RedirectResponse
    {
        $edad=\Carbon\Carbon::createFromDate($request->fechaNacimiento)->age;
        
        if ($edad >= 18) {
            Student::create($request->all());
            
            
            return redirect()->route('students.index')
            ->withSuccess('New student is added successfully.');
        } else {
            return redirect()->route('students.create')
            ->with('error', 'El aulmno debe ser mayor de edad'.$request->curso);
        }
    }

    public function show(Student $student) : View
    {
        return view('students.show', [
            'student' => $student
        ]);
    }
    public function agregarAsistencia(Request $request){

        $dni = $request->input('dni');
        $student = Student::where('dni', $dni)->first();
    
        if ($student) {
            return view('students.agregarAsistencia', [
                'student' => $student,
                
            ]);
        } else {
            return redirect()->route('students.index')->with('error', 'Estudiante con DNI ' . $dni . ' no encontrado.');
        }
    }
    
        //$student= Student::find('');   
    
    public function assistsView(Student $student) : View
    {
        $assists = $student->assists;
    
        return view('students.assist', [
            'student' => $student,
            'assists' => $assists
        ]);
    }

    public function edit(Student $student) : View
    {
        return view('students.edit', [
            'student' => $student
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student) : RedirectResponse
    {
        $student->update($request->all());
        return redirect()->route('students.index')
            ->withSuccess('Student is updated successfully.');
    }

    public function destroy(Student $student) : RedirectResponse
    {
        $student->delete();
        
        return redirect()->route('students.index')
                ->withSuccess('Student is deleted successfully.');
    }
}
