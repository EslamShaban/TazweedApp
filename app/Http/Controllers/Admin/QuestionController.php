<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\QuestionRepository;
use App\Http\Requests\Admin\QuestionRequest;
use App\Models\Question;

class QuestionController extends Controller
{
    private $questionRepository;
    
    public function __construct(QuestionRepository $question)
    {
        $this->middleware('permission:questions-read')->only(['index']);
        $this->middleware('permission:questions-create')->only(['create', 'store']);
        $this->middleware('permission:questions-update')->only(['edit', 'update']);
        $this->middleware('permission:questions-delete')->only(['destroy']);

        $this->questionRepository = $question;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->questionRepository->all();

        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        
        $data = $request->except('_token', '_method');

        $this->questionRepository->create($data);

        return redirect(aurl('questions'))->with('success', 'تم إضافة الحقل بنجاح');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->questionRepository->find($id);

        return view('admin.questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $data = $request->except('_token', '_method');

        $this->questionRepository->update($data, $question->id);

        return redirect(aurl('questions'))->with('success', 'تم تعديل الحقل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                
        $this->questionRepository->delete($id);

        return redirect(aurl('questions'))->with('success', 'تم حذف الحقل بنجاح');
    }
}
