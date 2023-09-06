<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class RadioQuestionEditor extends Component
{
    use WithFileUploads;

    public $questions = [];
    public $question_text;
    public $answer;
    public $option1;
    public $option2;
    public $option3;
    public $image;
    public $counter = 1;
    public $toBeUpdated = null;
    public $idToBeUpdated = null;

    protected $listeners = ['updateQuestion'];

    protected $rules = [
        'question_text' => 'required|string',
        'image' => 'nullable|image',
        'answer' => 'required|string',
        'option1' => 'required|string',
        'option2' => 'required|string',
        'option3' => 'required|string',
    ];

    protected $messages = [
        'question_text.required' => 'Это поле является обязательным',
        'answer.required' => 'Это поле является обязательным',
        'image.image' => 'Выберите файл с расширением .jpg, .png, .gif, jpeg, .bmp, .svg  или .webp',
    //'image.max' => 'Файл слишком большой',
        'option1.required' => 'Это поле является обязательным',
        'option2.required' => 'Это поле является обязательным',
        'option3.required' => 'Это поле является обязательным',
    ];

    private function optimizeImage()
    {
        if (!$this->image) {
            return null;
        }

        $destinationPath = storage_path('app/question_images');
        $name = time().'_'. Str::random(12).'.jpg';
        $imgOptimized = Image::make($this->image)->encode('jpg', 50)->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$name);
        return $name;
    }

    public function add()
    {
        $this->validate();
        $this->questions[$this->counter] = array(

            'question_text' => Str::ucfirst($this->question_text),
            'image' => $this->optimizeImage(),
            'answer' => Str::ucfirst($this->answer),
            'options' => [
                'option1' => Str::ucfirst($this->option1),
                'option2' => Str::ucfirst($this->option2),
                'option3' => Str::ucfirst($this->option3),
            ]
        );

        $this->counter++;
        $this->question_text = "";
        $this->answer = "";
        $this->option1 = "";
        $this->option2 = "";
        $this->option3 = "";
        $this->image = null;

        //$questions= json_encode($this->questions);
        session()->put('questions', $this->questions);
    }

    public function delete($id)
    {
        $this->questions = collect($this->questions);
        $this->questions->forget($id);
    }

    public function edit($id)
    {
        $this->toBeUpdated = $this->questions[$id];
        $this->idToBeUpdated = $id;
        $this->question_text = $this->toBeUpdated['question_text'];
        $this->answer = $this->toBeUpdated['answer'];
        $this->option1 = $this->toBeUpdated['options']['option1'];
        $this->option2 = $this->toBeUpdated['options']['option2'];
        $this->option3 = $this->toBeUpdated['options']['option3'];
        $this->image = $this->toBeUpdated['image'];
    }



    public function update()
    {
        $this->validate();
        $this->questions = collect($this->questions);
        if (!$this->idToBeUpdated) {
            session()->put('failure', 'Что-то пошло не так');
            return false;
        }

        $question = array(
            'question_text' => Str::ucfirst($this->question_text),
            'image' => $this->optimizeImage(),
            'answer' => Str::ucfirst($this->answer),
            'options' => [
                'option1' => Str::ucfirst($this->option1),
                'option2' => Str::ucfirst($this->option2),
                'option3' => Str::ucfirst($this->option3),
            ]
        );
        $id = $this->idToBeUpdated;
        $this->questions[$id] = $question;
        $this->toBeUpdated = null;
        $this->idToBeUpdated = null;

        $this->question_text = "";
        $this->answer = "";
        $this->option1 = "";
        $this->option2 = "";
        $this->option3 = "";
        $this->image = null;
    }

    public function render()
    {
        return view('livewire.radio-question-editor', [
            'questions' => $this->questions,
        ]);
    }
}
