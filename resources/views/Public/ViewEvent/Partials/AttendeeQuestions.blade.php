@foreach($ticket->questions->where('is_enabled', 1)->sortBy('sort_order') as $question)
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label("ticket_holder_questions[{$ticket->id}][{$i}][$question->id]", $question->title, ['class' => $question->is_required ? 'required' : '']) !!}

            @if($question->question_type_id == config('attendize.question_textbox_single'))
                {!! Form::text("ticket_holder_questions[{$ticket->id}][{$i}][$question->id]", null, ['required' => $question->is_required ? 'required' : '', 'class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}   form-control"]) !!}
            @elseif($question->question_type_id == config('attendize.question_textbox_multi'))
                {!! Form::textarea("ticket_holder_questions[{$ticket->id}][{$i}][$question->id]", null, ['rows'=>5, 'required' => $question->is_required ? 'required' : '', 'class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}  form-control"]) !!}
            @elseif($question->question_type_id == config('attendize.question_dropdown_single'))
                {!! Form::select("ticket_holder_questions[{$ticket->id}][{$i}][$question->id]", array_merge(['' => '-- Please Select --'], $question->options->lists('name', 'name')->toArray()), null, ['required' => $question->is_required ? 'required' : '', 'class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}   form-control"]) !!}
            @elseif($question->question_type_id == config('attendize.question_dropdown_multi'))
                {!! Form::select("ticket_holder_questions[{$ticket->id}][{$i}][$question->id][]",$question->options->lists('name', 'name'), null, ['required' => $question->is_required ? 'required' : '', 'multiple' => 'multiple','class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}   form-control"]) !!}
            @elseif($question->question_type_id == config('attendize.question_checkbox_multi'))
                <br>
                @foreach($question->options as $option)
                    {{$option->name}}
                    {!! Form::checkbox("ticket_holder_questions[{$ticket->id}][{$i}][$question->id][]",$option->name, false,['class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}  "]) !!}<br>
                @endforeach
            @elseif($question->question_type_id == config('attendize.question_radio_single'))
                <br>
                @foreach($question->options as $option)
                    {{$option->name}}
                    {!! Form::radio("ticket_holder_questions[{$ticket->id}][{$i}][$question->id]",$option->name, false, ['class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}  "]) !!}<br>
                @endforeach
            @endif


        </div>
    </div>
@endforeach