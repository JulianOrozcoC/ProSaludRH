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
        $rules = '';
        $questions = '';
        if ($testApplication->completed_on) {
            return view('completed-test', $data);
        }
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
            foreach ($questions as $key => $question) {
                if ($testApplication->test->id > 2) {
                    $question = $question['question'];
                }
                Response::create([
                    'question_number' => substr($key, 1),
                    'question' => $question,
                    'answer' => $request->get($key),
                    'test_application_id' => $testApplication->id,
                    'user_id' => Auth::user()->id,
                ]);
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
        $data['testApplication'] = $testApplication;
        return view('completed-test', $data);
    }

    public function grade1($testApplication)
    {
        $gradings["Ambiente de trabajo"] = 0;
        $gradings["Factors propios de la actividad"] = 0;
        $gradings["Organizacion del tiempo de trabajo"] = 0;
        $gradings["Liderazgo y relaciones en el trabajo"] = 0;

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
                $gradings["Factors propios de la actividad"] += $toAdd;
            }
            if (in_array($response->question_number, Config::get('questions')['grading1'][2])) {
                $gradings["Organizacion del tiempo de trabajo"] += $toAdd;
            }
            if (in_array($response->question_number, Config::get('questions')['grading1'][3])) {
                $gradings["Liderazgo y relaciones en el trabajo"] += $toAdd;
            }
        }

        return $gradings;
    }
}
