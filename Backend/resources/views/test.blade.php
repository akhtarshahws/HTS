@extends('layout.app')

@section('content')
    <div>
    
        <h2>Questions:</h2>
       
            
        <table>
            
            <form method="POST" action="{{ url('startquiz')}}">
                @csrf
                <input type="hidden" name="candidate_id" value="{{ $candidate_id }}">
                <table class="table">
              @foreach($questions as $question)
              
                <tr>
                    <td colspan="4">
                        <b >Question.</b> {{ $question->question }}
                        <input type="hidden" name="ques[]" value="{{ $question->id }}">

                    </td>
                </tr>
                <tr>
                    <td><input type="radio" >{{ $question->opt1 }}</td>
                    <td><input type="radio" >{{ $question->opt2 }}</td>
                    <td><input type="radio" >{{ $question->opt3 }}</td>
                    <td><input type="radio" >{{ $question->opt4 }}</td> 
                </tr>
             @endforeach
            </table> 
         <a class="btn btn-primary" href="{{ url('/generatequiz', ['id' => $candidate_id ]) }}">Reset Test</a>
          <input type="submit" class="btn btn-danger" value="Start Test">
            </form>
        </table>
      


    </div>
@endsection