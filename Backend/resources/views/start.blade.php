@extends('layout.app')

@section('content')
    <div>
    
        <h4>Select Carefully:</h4>
         
        @isset($data)
             <h2> your result   out of {{ $data->total_marks }} </h2>
        @endisset
            
        <table>
            
            <form method="POST" action="{{ url('storequiz')}}">
                @csrf
                <input type="hidden" name="candidate_id" value="{{ $candidate_id }}">
                <table class="table">
              @foreach($questions as $ques)
              
                <tr>
                    <td colspan="4">
                        <b >Question.</b> {{ $ques->question }}
                        <input type="hidden" name="ques[]" value="{{ $ques->id }}">

                    </td>
                </tr>
                <tr>
                    <td><input type="radio" value="1" name="sel{{ $ques->id }}">{{ $ques->opt1 }}</td>
                    <td><input type="radio" value="2" name="sel{{ $ques->id }}">{{ $ques->opt2 }}</td>
                    <td><input type="radio" value="3" name="sel{{ $ques->id }}">{{ $ques->opt3 }}</td>
                    <td><input type="radio" value="4" name="sel{{ $ques->id }}">{{ $ques->opt4 }}</td> 
                    <td><input type="radio" value="0" name="sel{{ $ques->id }}" checked hidden></td> 
                </tr>
             @endforeach
            </table> 
         {{-- <a class="btn btn-primary" href="{{ url('/generatequiz', ['id' => $candidate_id ]) }}">Reset Test</a> --}}
          <input type="submit" class="btn btn-success" value="Submit">
            </form>
        </table>
      


    </div>
@endsection