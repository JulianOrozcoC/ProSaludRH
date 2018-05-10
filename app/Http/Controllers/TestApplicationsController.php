<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TestApplication;
use App\Models\Response;
use App\Models\User;
use Auth;
use Config;
use Session;

class TestApplicationsController extends Controller
{
    public function getTest(TestApplication $testApplication)
    {
        $data=[];
        $data['test'] = $testApplication->test;
        $data['testApplication'] = $testApplication;
        if ($testApplication->completed_on) {
            if (\Auth::user()->hasAnyRole(['admin', 'organization admin'])) {
                return redirect('/completed-test/' . $testApplication->id);
            }
            return redirect('/');
        }
        if ($testApplication->user != Auth::user()) {
            return redirect('/');
        }
        $view = '';
        switch ($testApplication->test->id) {
            case 1:
                $data['questions'] = Config::get('questions')['test1'];
            break;
            case 2:
                $data['questions'] = Config::get('questions')['test2'];
                break;
            case 3:
                $data['questions'] = Config::get('questions')['test3'];
                break;
            case 4:
                $data['questions'] = Config::get('questions')['test4'];
                $data['respuestas'] = Config::get('questions')['test4'];
                break;
            case 5:
                $data['questions'] = Config::get('questions')['test5'];
                break;
            default:
                return redirect('/');
                break;
            }
            
        // dd($data['questions']);
        return view('tests.test' . $testApplication->test->id, $data);
    }
    public function postTest(TestApplication $testApplication, Request $request)
    {
        //dd($request->all());
        $rules = '';
        $questions = '';
        if ($testApplication->completed_on) {
            return view('completed-test', $data);
        }
        $flag = false;
        switch ($testApplication->test->id) {
                case 1:
                $rules = Config::get('questions')['rules1'];
                $questions = Config::get('questions')['test1'];
                $this->validate($request, $rules);
                break;
                case 2:
                $rules = Config::get('questions')['rules2'];
                $questions = Config::get('questions')['test2'];
                $this->validate($request, $rules);
                break;
                case 3:
                $rules = Config::get('questions')['rules3'];
                $questions = Config::get('questions')['test3'];
                $this->validate($request, $rules);
                break;
                case 4:
                $rules = Config::get('questions')['rules4'];
                $questions = Config::get('questions')['test4'];
                $this->validate($request, $rules);
                $flag = 4;
                break;
                case 5:
                $rules = Config::get('questions')['rules5'];
                $questions = Config::get('questions')['test5'];
                $this->validate($request, $rules);
                break;
                
            default:
                return redirect('/');
                break;
        }
        try {
            $counter =1;
            foreach ($questions as $key => $question) {
                if ($testApplication->test->id > 2) {
                    $question = $question['question'];

                }

                if( !$flag ){
                     Response::create([
                        'question_number' => substr($key, 1),
                        'question' => $question,
                        'answer' => $request->get($key),
                        'test_application_id' => $testApplication->id,
                        'user_id' => Auth::user()->id,
                    ]);
                }
                else{
                    switch ($flag) {
                        case 4:
                            
                            foreach ($request->get($key) as $value) {
                                 Response::create([
                                    'question_number' => $counter,
                                    'question' => $question,
                                    'answer' => $value,
                                    'test_application_id' => $testApplication->id,
                                    'user_id' => Auth::user()->id,
                                ]);
                                 $counter ++;
                            }
                            break;
                        
                        default:
                            # code...
                            break;
                    }
                }

            }
            $testApplication->completed_on = \Carbon\Carbon::now();
            $testApplication->save();
        } catch (\Exception $e) {
            Session::flash('flash_message', 'Error saving test!');
        }


        Session::flash('flash_message', 'Test application successfully created!');

        return redirect('/dashboard');
    }

    public function getAllComplete()
    {
        if (\Auth::user()->hasRole('admin')) {
            $data['apps'] = TestApplication::complete()->get();
        } else {
            $users = User::where('organization_id', Auth::user()->organization->id)->pluck('id')->toArray();
            $data['apps'] = TestApplication::complete()->whereIn('user_id', $users)->get();
        }
        return view('completed-tests', $data);
    }
    
    public function getActive()
    {
        if (\Auth::user()->hasRole('admin')) {
            $data['apps'] = TestApplication::active()->get();
        } else {
            $users = User::where('organization_id', Auth::user()->organization->id)->pluck('id')->toArray();
            $data['apps'] = TestApplication::active()->whereIn('user_id', $users)->get();
        }
        return view('active-applications', $data);
    }

    public function getCompleted(TestApplication $testApplication)
    {
        if (!$testApplication->completed_on) {
            return redirect('/');
        }

        if ($testApplication->test->id == 1) {
            $data['gradings'] = $this->grade1($testApplication);
        }
        elseif ($testApplication->test->id == 2){
            $data['gradings'] = $this->grade2($testApplication);
        }
         elseif ($testApplication->test->id == 4){
            $data['gradings'] = $this->grade4($testApplication);
        } 

        $data['testApplication'] = $testApplication;
        return view('completed-test', $data);
    }

    public function grade1($testApplication)
    {   
        // Psicosocial
        // Categorias de resultados del test
        $gradings["Ambiente de trabajo"] = 0;
        $gradings["Factores propios de la actividad"] = 0;
        $gradings["Organizacion del tiempo de trabajo"] = 0;
        $gradings["Liderazgo y relaciones en el trabajo"] = 0;
        $gradings["Calificacion Final"]=0;

        // Revisar resultados del test
        foreach ($testApplication->responses as $response) {
            if (18 >= $response->question_number && $response->question_number <=33) {
                $toAdd = $response->answer - 1;
            } else {
                switch ($response->answer) {
                    case 1:
                        $toAdd = 4;
                        break;
                    case 2:
                        $toAdd = 3;
                        break;
                    case 3:
                        $toAdd = 2;
                        break;
                    case 4:
                        $toAdd = 1;
                        break;
                    case 5:
                        $toAdd = 0;
                        break;
                }
            }

            if (in_array($response->question_number, Config::get('questions')['grading1'][0])) {
                $gradings["Ambiente de trabajo"] += $toAdd;
            }
            if (in_array($response->question_number, Config::get('questions')['grading1'][1])) {
                $gradings["Factores propios de la actividad"] += $toAdd;
            }
            if (in_array($response->question_number, Config::get('questions')['grading1'][2])) {
                $gradings["Organizacion del tiempo de trabajo"] += $toAdd;
            }
            if (in_array($response->question_number, Config::get('questions')['grading1'][3])) {
                $gradings["Liderazgo y relaciones en el trabajo"] += $toAdd;
            } 
            /*
            if( $response->question_number == 2 or $response->question_number == 1 or $response->question_number == 3)
            {
                 $gradings["Ambiente de trabajo"] += $toAdd;
            }
            elseif (  $response->question_number == 4 or  $response->question_number == 9 or  $response->question_number == 5 or  $response->question_number == 6 or  $response->question_number == 7 or  $response->question_number == 8 or  $response->question_number == 41 or  $response->question_number == 42 or  $response->question_number == 43 or  $response->question_number == 10 or  $response->question_number == 11 or  $response->question_number == 12 or  $response->question_number == 13 or  $response->question_number == 20 or  $response->question_number == 21 or  $response->question_number == 22 or $response->question_number == 18 or $response->question_number == 19 or  $response->question_number == 26 or  $response->question_number == 27 )
            {
                $gradings["Factores propios de la actividad"] += $toAdd;
            }
            elseif ( $response->question_number == 14 or $response->question_number == 15 or $response->question_number == 16 or $response->question_number == 17 )
            {
                 $gradings["Organizacion del tiempo de trabajo"] += $toAdd;
            }
            else {
                $gradings["Liderazgo y relaciones en el trabajo"] += $toAdd;
            } */

        }
        // Calculo de calificacion final del test
        $gradings["Calificacion Final"] = $gradings["Ambiente de trabajo"] + $gradings["Factores propios de la actividad"] + $gradings["Organizacion del tiempo de trabajo"] + $gradings["Liderazgo y relaciones en el trabajo"];

        return $gradings;
    }

    public function grade2($testApplication)
    {   // Indice de Coeficiente Intelectual de Baron
        // Categorias de resultados del test
        $gradings["Intrapersonal"] = 0;
        $gradings["Interpersonal"] = 0;
        $gradings["Adaptabilidad"] = 0;
        $gradings["Manejo de la tension"] = 0;
        $gradings["Estado de animo general"] = 0;
        $gradings["Puntaje directo del cociente emocional"] = 0;
        // Variables auxiliares
        $auxGrades["Subescala 1"] = 0;
        $auxGrades["Subescala 2"] = 0;
        $auxGrades["Subescala 3"] = 0;
        $auxGrades["Subescala 4"] = 0;
        $auxGrades["Subescala 5"] = 0;
        $auxGrades["Subescala 6"] = 0;
        $auxGrades["Subescala 7"] = 0;
        $auxGrades["Subescala 8"] = 0;
        $auxGrades["Subescala 9"] = 0;
        $auxGrades["Subescala 10"] = 0;
        $auxGrades["Subescala 11"] = 0;
        $auxGrades["Subescala 12"] = 0;
        $auxGrades["Subescala 13"] = 0;
        $auxGrades["Subescala 14"] = 0;
        $auxGrades["Subescala 15"] = 0;
        $auxGrades["Interpersonal"] = 0;
        $auxGrades["CocienteEmocional"] = 0;

        // Revisar resultados del test
        foreach ($testApplication->responses as $response) {
            if ( $response->question_number == 2 or $response->question_number == 3 or $response->question_number == 10 or $response->question_number == 13 or $response->question_number == 14 or $response->question_number == 17 or $response->question_number == 18 or $response->question_number == 19 or $response->question_number == 21 or $response->question_number == 22 or $response->question_number == 23 or $response->question_number == 24 or $response->question_number == 27 or $response->question_number == 28 or $response->question_number == 30 or $response->question_number == 32 or $response->question_number == 35 or $response->question_number == 36 or $response->question_number == 38 or $response->question_number == 42 or $response->question_number == 43 or $response->question_number == 46 or $response->question_number == 48 or $response->question_number == 49 or $response->question_number == 51 or $response->question_number == 52 or $response->question_number == 53 or $response->question_number == 56 or $response->question_number == 58 or $response->question_number == 64 or $response->question_number == 66 or $response->question_number == 68 or $response->question_number == 69 or $response->question_number == 70 or $response->question_number == 73 or $response->question_number == 75 or $response->question_number == 76 or $response->question_number == 77 or $response->question_number == 82 or $response->question_number == 83 or $response->question_number == 86 or $response->question_number == 87 or $response->question_number == 91 or $response->question_number == 92 or $response->question_number == 93 or $response->question_number == 97 or $response->question_number == 102 or $response->question_number == 103 or $response->question_number == 107 or $response->question_number == 111 or $response->question_number == 116 or $response->question_number == 117 or $response->question_number == 118 or $response->question_number == 121 or $response->question_number == 122 or $response->question_number == 125 or $response->question_number == 126 or $response->question_number == 127 or $response->question_number == 128 or $response->question_number == 130 or $response->question_number == 131 or $response->question_number == 132) {
                $toAdd = $response->answer;
            } else {
                switch ($response->answer) {
                    case 1:
                        $toAdd = 5;
                        break;
                    case 2:
                        $toAdd = 4;
                        break;
                    case 3:
                        $toAdd = 3;
                        break;
                    case 4:
                        $toAdd = 2;
                        break;
                    case 5:
                        $toAdd = 1;
                        break;
                }
            }
            if (in_array($response->question_number, Config::get('questions')['grading2'][0])) {
                $auxGrades["Subescala 1"] += $toAdd;
            }
            if (in_array($response->question_number, Config::get('questions')['grading2'][1])) {
                $auxGrades["Subescala 2"] += $toAdd;
            }
            if (in_array($response->question_number, Config::get('questions')['grading2'][2])) {
                $auxGrades["Subescala 3"] += $toAdd;
            }
            if (in_array($response->question_number, Config::get('questions')['grading2'][3])) {
                $auxGrades["Subescala 4"] += $toAdd; 
            }
            if (in_array($response->question_number, Config::get('questions')['grading2'][4])) {
                $auxGrades["Subescala 5"] += $toAdd; 
            }
            if (in_array($response->question_number, Config::get('questions')['grading2'][5])) {
                $auxGrades["Subescala 6"] += $toAdd; 
            }
            if (in_array($response->question_number, Config::get('questions')['grading2'][6])) {
                $auxGrades["Subescala 7"] += $toAdd; 
            }
            if (in_array($response->question_number, Config::get('questions')['grading2'][7])) {
                $auxGrades["Subescala 8"] += $toAdd; 
            }
            if (in_array($response->question_number, Config::get('questions')['grading2'][8])) {
                $auxGrades["Subescala 9"] += $toAdd; 
            }
            if (in_array($response->question_number, Config::get('questions')['grading2'][9])) {
                $auxGrades["Subescala 10"] += $toAdd;
            }
            if (in_array($response->question_number, Config::get('questions')['grading2'][10])) {
                $auxGrades["Subescala 11"] += $toAdd;
            }
            if (in_array($response->question_number, Config::get('questions')['grading2'][11])) {
                $auxGrades["Subescala 12"] += $toAdd;
            }
            if (in_array($response->question_number, Config::get('questions')['grading2'][12])) {
                $auxGrades["Subescala 13"] += $toAdd;
            }
            if (in_array($response->question_number, Config::get('questions')['grading2'][13])) {
                $auxGrades["Subescala 14"] += $toAdd;
            }
            if (in_array($response->question_number, Config::get('questions')['grading2'][14])) {
                $auxGrades["Subescala 15"] += $toAdd;
            }
            if (in_array($response->question_number, Config::get('questions')['grading2'][15])) {
                $auxGrades["Interpersonal"] += $toAdd;
            }
            if (in_array($response->question_number, Config::get('questions')['grading2'][16])) {
                $auxGrades["CocienteEmocional"] += $toAdd;
            }

        }
        //Calculo de categorias del test
        $gradings["Intrapersonal"] = $auxGrades["Subescala 1"] + $auxGrades["Subescala 2"] + $auxGrades["Subescala 3"] + $auxGrades["Subescala 4"] + $auxGrades["Subescala 5"];
        $gradings["Interpersonal"] = ($auxGrades["Subescala 6"] + $auxGrades["Subescala 7"] + $auxGrades["Subescala 8"]) - $auxGrades["Interpersonal"];
        $gradings["Adaptabilidad"] = $auxGrades["Subescala 9"] + $auxGrades["Subescala 10"] + $auxGrades["Subescala 11"];
        $gradings["Manejo de la tension"] = $auxGrades["Subescala 12"] + $auxGrades["Subescala 13"];
        $gradings["Estado de animo general"] = $auxGrades["Subescala 14"] + $auxGrades["Subescala 15"];

        // Calculo final del test
        $gradings["Puntaje directo del cociente emocional"] = ($gradings["Intrapersonal"] + $gradings["Interpersonal"] + $gradings["Adaptabilidad"] + $gradings["Manejo de la tension"] + $gradings["Estado de animo general"] ) - $auxGrades["CocienteEmocional"];

        return $gradings;
    }
      public function grade4($testApplication)
    {   
        // Zavic
        // Categorias de resultados del test (Intereses y Valores)
        $gradings["Moralidad"] = 0;
        $gradings["Legalidad"] = 0;
        $gradings["Indiferencia"] = 0;
        $gradings["Corrupcion"] = 0;
        $gradings["Economico"]=0;
        $gradings["Politico"]=0;
        $gradings["Social"]=0;
        $gradings["Religioso"]=0;

        // Revisar resultados del test
        foreach ($testApplication->responses as $response) {
         
            if (in_array($response->question_number, Config::get('questions')['grading4'][0])) {
                $gradings["Moralidad"] += $response->answer;
            }
            if (in_array($response->question_number, Config::get('questions')['grading4'][1])) {
                $gradings["Legalidad"] += $response->answer;
            }
            if (in_array($response->question_number, Config::get('questions')['grading4'][2])) {
                $gradings["Indiferencia"] += $response->answer;
            }
            if (in_array($response->question_number, Config::get('questions')['grading4'][3])) {
                $gradings["Corrupcion"] += $response->answer;
            } 
            if (in_array($response->question_number, Config::get('questions')['grading4'][4])) {
                $gradings["Economico"] += $response->answer;
            } 
            if (in_array($response->question_number, Config::get('questions')['grading4'][5])) {
                $gradings["Politico"] += $response->answer;
            } 
            if (in_array($response->question_number, Config::get('questions')['grading4'][6])) {
                $gradings["Social"] += $response->answer;
            }
            if (in_array($response->question_number, Config::get('questions')['grading4'][7])) {
                $gradings["Religioso"] += $response->answer;
            }  
        }

        $gradings["Moralidad"] = ($gradings["Moralidad"]/40)*100;
        $gradings["Legalidad"] = ($gradings["Legalidad"]/40)*100;
        $gradings["Indiferencia"] = ($gradings["Indiferencia"]/40)*100;
        $gradings["Corrupcion"] = ($gradings["Corrupcion"]/40)*100;
        $gradings["Economico"] = ($gradings["Economico"]/40)*100;
        $gradings["Politico"] = ($gradings["Politico"]/40)*100;
        $gradings["Social"] = ($gradings["Social"]/40)*100;
        $gradings["Religioso"] = ($gradings["Religioso"]/40)*100;


        return $gradings;
    }
}
