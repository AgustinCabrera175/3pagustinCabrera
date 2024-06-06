<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\StudentController;
use App\Models\Student;
use App\Models\Assist;
use App\Models\Parametro;
use Carbon\Carbon;



class AssistController extends Controller
{
    public function mostrarParametros(Assist $assits){
        return view('students.parametros', [
            'parametros' => $parametros =Parametro::All(),
        ]);
    }
    public function editarParametros(Request $request,$id){
        
        $request->validate([
            'parametros' => 'required|integer|between:10,200',
        'porcentajeRegular' => 'required|numeric|between:30,70',
        'porcentajePromocion' => 'required|numeric|between:70,100',
        ]);
        $parametro = Parametro::find($id);

        $parametro->parametros = $request->input('parametros');
        $parametro->porcentajeRegular = $request->input('porcentajeRegular');
        $parametro->porcentajePromocion = $request->input('porcentajePromocion');

        $parametro->save();
    return redirect()->route('parametros')->with('success', 'Parametro editado con exito!');

    }
    public function agregarParametros(Request $request){

        $request->validate([
            'parametros' => 'required|integer|between:10,200',
            'porcentajeRegular' => 'required|numeric|between:30,70',
            'porcentajePromocion' => 'required|numeric|between:70,100',
        ]);

        $parametro = new Parametro();
        $parametro->parametros = $request->input('parametros');
        $parametro->porcentajeRegular = $request->input('porcentajeRegular');
        $parametro->porcentajePromocion = $request->input('porcentajePromocion');

        $parametro->save();
        return redirect()->route('parametros')->with('success', 'Se añadio un nuevo parametro!');
    }
    public function asistencia(Request $request, Student $student){

        $fechaHoy = Carbon::now()->toDateString();

        $asistenciaHoy = Assist::where('students_id', $student->id)->whereDate('created_at', $fechaHoy)
                            ->exists();

        $dni = $request->input('dni');

        if (!$asistenciaHoy) {
        Assist::create([
            'students_id' => $student->id
        ]);

        return redirect()->route('students.index')
                         ->with('success', 'La asistencia se agregó correctamente.');
    } else {
        return redirect()->route('students.index')
                         ->with('error', 'El alumno ya tiene una asistencia hoy.');
    }
        //$assits = $student->assists;
    }
    
   

}
