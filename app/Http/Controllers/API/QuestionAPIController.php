<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\QuestionRepository;
use App\Http\Resources\QuestionResource;
use App\Models\RequestQuestionAnswer;
use App\Http\Requests\API\QuestionAPIRequest;

class QuestionAPIController extends Controller
{
    private $questionRepository;
    
    public function __construct(QuestionRepository $question)
    {
        
        $this->questionRepository = $question;

    }

        
    public function get_questions()
    {
        $questions = $this->questionRepository->all();

        $data = [
            'questions'  => QuestionResource::collection($questions),   
        ];

        return response()->withData(__('api.questions') , $data);
    }

    public function questions_answer(QuestionAPIRequest $request)
    {
        foreach ($request->questions as $key => $question) {
            RequestQuestionAnswer::create([
                'request_id'    => $request->request_id,
                'question_id'   => $question['question_id'],
                'answer'        => $question['answer']
            ]);
        }

        return response()->withSuccess(__('api.success'), 200);
    }
}
