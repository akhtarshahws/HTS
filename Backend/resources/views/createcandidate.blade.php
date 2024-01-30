@extends('layout.app')



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Candidate</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/api/createcandidate')}}">

                            @csrf

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="father_name">Father's Name:</label>
                                <input type="text" name="father_name" id="father_name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" name="phone" id="phone" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="post_applied_for">Post Applied For:</label>
                                <select name="post_applied_for" id="post_applied_for" class="form-control" required>
                                    <option value="1">Frontend Developer</option>
                                    <option value="2">Backend Developer</option>
                                    <option value="3">Android Developer</option>
                                    <!-- Add other options as needed -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="skills">Skills:</label>
                                <input type="text" name="skills" id="skills" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="interviewer">Interviewer:</label>
                                <input type="text" name="interviewer" id="interviewer" class="form-control" required>
                            </div>


                            <button type="submit" class="btn btn-primary">Create Candidate</button>

                        </form>
                        @isset($candidate_id)
                           
                           <a class="btn btn-primary" href="{{ url('/generatequiz', ['id' => $candidate_id ]) }}">Generate Quiz</a>
                          
                        @endisset
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
