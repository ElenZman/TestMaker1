<div class="m-4 border border-indigo-600 flex flex-col md:flex-row gap-5">
    <div id="main" class="w-full md:w-1/2 border border-orange-500">
        <div id="alerts" class="m-4">
            @if (session()->has('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('failure'))
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                    role="alert">
                    {{ session('failure') }}
                </div>
            @endif
        </div>

        <div class="m-4">
            <input type="file" wire:model="image"
                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0 file:text-sm file:font-semibold
            file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
            @error('image')
                <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="m-4">
            <label for="question" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Введите
                вопрос</label>
            <textarea id="question" rows="3" wire:model.lazy="question_text"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300
                focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </textarea>
            @error('question_text')
                <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="m-4">
            <label for="answer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Введите
                ответ</label>
            <input type="text" id="answer" wire:model.lazy="answer"
                class="block p-2.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('answer')
                <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="m-4">
            <label for="option1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Введите опцию
                1 &#40для вопросов с выбором варианта ответа&#41</label>
            <input type="text" id="option1" wire:model.lazy="option1"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                value="{{ $toBeUpdated['options']['option1'] ?? '' }}">
            @error('option1')
                <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="m-4">
            <label for="option2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Введите опцию
                2 &#40для вопросов с выбором варианта ответа&#41</label>
            <input type="text" id="option2" wire:model.lazy="option2"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('option2')
                <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="m-4">
            <label for="option3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Введите опцию
                3 &#40для вопросов с выбором варианта ответа&#41</label>
            <input type="text" id="option3" wire:model.lazy="option3"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('option3')
                <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
            @enderror
        </div>
        @if ($toBeUpdated)
            <button type="button" wire:click="update"
                class="m-4 flex justify-between rounded bg-neutral-800 px-2 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-50 shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] transition duration-150 ease-in-out hover:bg-neutral-800 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-neutral-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:outline-none focus:ring-0 active:bg-neutral-900 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] dark:bg-neutral-900 dark:shadow-[0_4px_9px_-4px_#030202] dark:hover:bg-neutral-900 dark:hover:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:focus:bg-neutral-900 dark:focus:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:active:bg-neutral-900 dark:active:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)]">
                <x-heroicon-o-plus class="mr-2 h-5 w-5" />Обновить
            </button>
        @else
            <button type="button" wire:click="add"
                class="m-4 flex justify-between rounded bg-neutral-800 px-2 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-50 shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] transition duration-150 ease-in-out hover:bg-neutral-800 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-neutral-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:outline-none focus:ring-0 active:bg-neutral-900 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] dark:bg-neutral-900 dark:shadow-[0_4px_9px_-4px_#030202] dark:hover:bg-neutral-900 dark:hover:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:focus:bg-neutral-900 dark:focus:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:active:bg-neutral-900 dark:active:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)]">
                <x-heroicon-o-plus class="mr-2 h-5 w-5" />Добавить
            </button>
        @endif
    </div>

    <div id="preview" class="w-full md:w-1/2 border border-lime-400 overflow-auto">
        @if (!$questions)
            <div class="p-2 m-2 font-medium text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                role="alert">
                Вы еще не создали ни одного вопроса
            </div>
        @else
            <h4 class="p-2 m-2  font-medium text-sm text-blue-800 rounded-lg dark:bg-gray-800 dark:text-blue-400">
                <strong>Пердварительный просмотр</strong>
            </h4>
            <div class="max-h-72 md:max-h-98 border border-indigo-600 flex-none overflow-y-auto p-2">
                @php $counter =1; @endphp
                @foreach ($questions as $index => $question)
                    <div wire:key="item-{{ $index }}">
                        <div class="question" class="border border-gray-200 w-full text-sm m-2">
                            <div class="break-words text-sm font-base mb-2"> {{ $counter }}.{{ $question['question_text'] }}</div>
                            @if ($question['image'])
                            <div class="w-52 m-2">
                                    <img src="{{ asset('question_images/'.$question['image']) }}" alt="question image">
                                </div>
                            @endif
                            <div class="flex items-center mx-4">
                                <input type="radio" value="" name="default-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $question['answer'] }}</label>
                            </div>
                            @if (is_array($question['options']))
                                @foreach ($question['options'] as $key => $option)
                                    <div wire:key="radio-{{ $key }}-{{ $index }}"
                                        class="flex items-center mx-4">
                                        <input type="radio" value="" name="default-radio"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label
                                            class="ml-2 text-sm text-gray-900 dark:text-gray-300">{{ $option }}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="buttons flex m-2">
                            <button type="button" wire:click="edit({{ $index }})"
                                class="center mr-4 rounded-lg bg-blue-500 py-2 px-6 font-sans text-xs font-bold text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                data-ripple-light="true">
                                Изменить
                            </button>
                            <button type="button" wire:click="delete({{ $index }})"
                                class="center mr-4 rounded-lg bg-red-500 py-2 px-6 font-sans text-xs font-bold text-white shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                data-ripple-light="true">
                                Удалить
                            </button>
                        </div>
                    </div>
                    @php $counter++@endphp
                @endforeach
            </div>
        @endif
    </div>
</div>
