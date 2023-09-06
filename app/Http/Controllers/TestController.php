<?php

namespace App\Http\Controllers;

use App\Exceptions\TestInsertionFailureException;
use Exception;
use App\Models\Test;
use App\Models\Answer;
use App\Models\Subject;
use App\Models\Question;
use App\Models\TestType;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\TestResource;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreTestRequest;
use App\Http\Requests\UpdateTestRequest;
use Illuminate\Support\Facades\Validator;
use Mockery\CountValidator\Exact;
use PDO;
use PDOException;

class TestController extends Controller
{

    public function show(Request $request)
    {

        $user = $request->user();
        /*if ($user->id !== $test->user_id) {
            return abort(403, 'Увас нет прав для просмотра данного контента');
        }*/
        $tests = TestResource::collection(Test::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10));
        return view('dashboard')->with('tests', $tests);
    }

    public function create()
    {
        return view('test')->with('subjects', Subject::all())->with('test_types', TestType::all());
    }

    public function store(StoreTestRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();

                try {
                    $test = Test::create([
                        'title' => $data['title'],
                        'user_id' => $data['user_id'],
                        'subject_id' => $data['subject'],
                        'test_type_id' => $data['test_type']
                    ]);
                } catch (PDOException $e) {
                    throw new Exception("Тест не был создан. Проверьте, заполнили ли вы все необходимые поля,
                    и попробуйте еще раз.");
                }
                if (!session()->has('questions')) {
                    return redirect()->route('test.create')->with('failure', 'Необходимо ввести хотябы один вопрос');
                }
                if ($test->test_type_id === " ") {
                    // ????????????
                }

                $questions = session()->get('questions');

                foreach ($questions as $question) {

                    $this->createQuestion($question, $test->id);
                }

                session()->forget('questions');
                return redirect()->route('test.create')->with('success', 'Тест был успешно создан');
            });
        } catch (Exception $e) {
            //throw new TestInsertionFailureException($e);
            dd('gkjhkfjhfl');
        }
    }

    private function createQuestion($question, $id): mixed
    {
        $test_id = array('test_id' => $id);
        $validate = array_merge($question, $test_id);

        $validator = Validator::make($validate, [
            'test_id' => 'exists:tests,id',
            'question_text' => 'required|string',
            'image' => 'nullable|string',
            'answers' => 'required|array',
            'answers.answer' => 'required',
            'answers.options' => 'array|nullable'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $return_msg = array();
            foreach ($messages->all() as $message) {
                array_push($return_msg, $message);
            }
            session()->flash('failure',  $return_msg);
            return redirect()->route('test.create');
        }

        try {
            $question = Question::create([
                'test_id' => $validate['test_id'],
                'question_text' => $validate['question_text'],
                'image' => $validate['image'],
            ]);
        } catch (PDOException $e) {

            dd($e);
            throw new Exception("невозможно создать вопрос");
        }

        try {
            $this->createAnswer($question->id, $validate['answers']);
        } catch (PDOException $e) {
            throw new Exception('невозможно сосздать вопрос');
        }
        return true;
    }


    private function createAnswer($id, $answers): mixed
    {
        if (is_array($answers)) {
            $question_id = array('question_id' => $id);
            $answers = array_merge($question_id, $answers);
        }

        if ($answers['answer'])
            try {
                DB::table('answers')->insert([
                    'question_id' => $answers['question_id'],
                    'answer_text' => $answers['answer'],
                    'is_correct' => true
                ]);
            } catch (PDOException $e) {
                throw new Exception("ответ не создан");
            }


        if (!empty(($answers['options']))) {
            foreach ($answers['options'] as $option) {
                if ($option) {
                    try {
                        DB::table('answers')->insert([
                            'question_id' => $answers['question_id'],
                            'answer_text' => $answers['answer'],
                            'is_correct' => false
                        ]);
                    } catch (PDOException $e) {
                        throw new Exception("ответ не создан");
                    }
                }
            }
        }

        return true;
    }

    public function update(UpdateTestRequest $request, Test $test)
    {
        /*$data = $request->validated();

        //проверить, если картинка была обновлена, и сохранить
        if (isset($data['image'])) {
            $relativePath = $this->saveImage($data['image']);
            $data['image'] = $relativePath;

            //если есть старая картинка, удяляем
            if ($test->image) {
                $absolutePath = public_path($test->image);
                File::delete($absolutePath);
            }
        }

        $test->update($data);
        //получаем Id существующих вопросов и
        $existingIds = $test->questions()->pluck('id')->toArray();
        //получаем id новых вопросов
        $newIds = Arr::pluck($data['questions'], 'id');

        $toDelete = array_diff($existingIds, $newIds);

        $toAdd = array_diff($newIds, $existingIds);

        Question::destroy($toDelete);

        foreach ($data['questions'] as $question) {
            if (in_array($question['id'], $toAdd)) {
                $question['test_id'] = $test->id;
                $this->cretaeQuestion($question);
            }
        }

        $questionMap = collect($data['questions'])->keyBy('id');
        foreach ($test->questions as $question) {
            if (isset($questionMap[$question->id])) {
                $this->updateQuestion($question, $questionMap['question->d']);
            }
        }*/

    }

    /**
     * Удалить из базы данных
     *
     * @param  \App\Models\Test  $test
     *
     */
    public function destroy(Test $test, Request $request)
    {
        $user = $request->user();
        if ($user->id !== $test->user_id) {
            return abort(403, 'Увас нет прав на удаление данного контента');
        }
        //$test->delete();
        //вернуть view

    }


    /*private function updateQuestion(Question $question, $questions)
    {
        if (is_array($questions)) {
            $data['data'] = json_encode($data['data']);
        }
        $validator = Validator::make($data, [
            'id' => 'exists:App\Models\Question,id',
            'text' => 'required|string',
            'test_id' => 'exists:tests, id'
            ////Закочи''
        ]);
        return $question->update($validator->validated());
    }*/
}
