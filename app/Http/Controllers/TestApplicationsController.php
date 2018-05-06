<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TestApplication;
use App\Models\Response;
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
                Response::create([
                    'question_number' => 1,
                    'question' => $question,
                    'answer' => $request->get($key),
                    'test_application_id' => $testApplication->id,
                    'user_id' => Auth::user()->id,
                ]);
            }
        } catch (\Exception $e) {
            Session::flash('flash_message', 'Error saving test!');
        }


        Session::flash('flash_message', 'Test application successfully created!');

        return redirect('/dashboard');
    }
}
