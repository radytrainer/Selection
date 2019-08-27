@extends('template')
@section('pageTitle', 'Selection-Committee - Information Candidate')
@section('content')
<div class="content">
<h1 class="text-center">Information of candidate</h1>

    <div class="card mt-4">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6 mt-4">
                    <div class="row">
                        <div class="col-lg-4 col-md-5 col-sm-12">
                            @if ($candidate->profile==Null)
                                <img src="{{url('../storage/app/public/img/male.png')}}" class="img-thumbnail" alt="Cinque Terre" width="150" height="100">
                            @else
                                <img src="{{url('../storage/app/public/img/'.$candidate->profile)}}" class="img-thumbnail" alt="Cinque Terre" width="150" height="100">
                            @endif
                        </div>
                        <div class="col-lg-8 col-md-7 col-sm-12">
                            <b>Student Name : </b>{{$candidate->Candidate_Name}}<br>
                            <b>Gender : </b>{{$candidate->gender}}</span><br>
                            <b>Age : </b>{{$candidate->age}}</span><br>
                            <b>Province : </b>{{$candidate['province']}}</span><br>
                            <b>Year : </b>{{$candidate['years']}}</span><br>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-4">

                </div>
                <div class="col-sm-3 mt-4">
                    <p><b>Global Grade:</b> {{$candidate['grade']}}</p>

                    <p><b>NGO: </b>
                        @if ( DB::table('ngos')->Where('id',$candidate['ngo_id'])->get()->pluck('name') != "[]")
                            @foreach ( DB::table('ngos')->Where('id',$candidate['ngo_id'])->get()->pluck('name') as $record )
                                {{$record}}
                            @endforeach
                        @else
                            None
                        @endif
                    </p>
                    @if ($candidate->Fill_By!=Null)
                    <input type="checkbox" name='fil' value="Information is filled by PNC employee"  checked>Information is filled by PNC employee
                    @else
                    <input type="checkbox" name='fil' value="Information is filled by PNC employee " > Information is filled by PNC employee
                    @endif
                </div>
            </div>
            <hr>
            <div >
                <div class="shadow-lg p-3 mb-2 bg-white rounded"><h5>Student profile summary</h5>
                    <p>
                        @foreach (array(DB::table('answer_candidate')->Where('candidate_id',$candidate['id'])->get()->pluck('summary')) as $record)
                            {{$record->get(0)}}
                        @endforeach
                    </p>
                </div>
                <div class="shadow-lg p-3 mb-2 bg-white rounded"><h5>Parental information</h5>
                    <p>
                        @foreach (array(DB::table('answer_candidate')->Where('candidate_id',$candidate['id'])->get()->pluck('summary')) as $record)
                            {{$record->get(1)}}
                        @endforeach
                    </p>
                </div>
                <div class="shadow-lg p-3 mb-2 bg-white rounded"><h5>Family members summary</h5>
                    <p>
                        @foreach (array(DB::table('answer_candidate')->Where('candidate_id',$candidate['id'])->get()->pluck('summary')) as $record)
                            {{$record->get(2)}}
                        @endforeach
                    </p>
                </div>
                <div class="shadow-lg p-3 mb-2 bg-white rounded"><h5>Children imformation summary</h5>
                    @foreach (array(DB::table('answer_candidate')->Where('candidate_id',$candidate['id'])->get()->pluck('summary')) as $record)
                        {{$record->get(3)}}
                    @endforeach
                </div>
                <div class="shadow-lg p-3 mb-2 bg-white rounded"><h5>Health condition summary</h5>
                    <p>
                        @foreach (array(DB::table('answer_candidate')->Where('candidate_id',$candidate['id'])->get()->pluck('summary')) as $record)
                            {{$record->get(4)}}
                        @endforeach
                    </p>
                </div>
                <div class="shadow-lg p-3 mb-2 bg-white rounded"><h5>Household monthly income summary</h5>
                    <p>
                        @foreach (array(DB::table('answer_candidate')->Where('candidate_id',$candidate['id'])->get()->pluck('summary')) as $record)
                            {{$record->get(5)}}
                        @endforeach
                    </p>
                </div>
                <div class="shadow-lg p-3 mb-2 bg-white rounded"><h5>Residential and appliant assets summary</h5>
                    <p>
                        @foreach (array(DB::table('answer_candidate')->Where('candidate_id',$candidate['id'])->get()->pluck('summary')) as $record)
                            {{$record->get(6)}}
                        @endforeach
                    </p>
                </div>
                <div class="shadow-lg p-3 mb-2 bg-white rounded"><h5>Family self production summary</h5>
                    <p>
                        @foreach (array(DB::table('answer_candidate')->Where('candidate_id',$candidate['id'])->get()->pluck('summary')) as $record)
                            {{$record->get(7)}}
                        @endforeach
                    </p>
                </div>
                <div class="shadow-lg p-3 mb-2 bg-white rounded"><h5>Debt summary</h5>
                    <p>
                        @foreach (array(DB::table('answer_candidate')->Where('candidate_id',$candidate['id'])->get()->pluck('summary')) as $record)
                            {{$record->get(8)}}
                        @endforeach
                    </p>
                </div>
                <div class="shadow-lg p-3 mb-2 bg-white rounded"><h5>Household monthly expense summary</h5>
                    <p>
                        @foreach (array(DB::table('answer_candidate')->Where('candidate_id',$candidate['id'])->get()->pluck('summary')) as $record)
                            {{$record->get(9)}}
                        @endforeach
                    </p>

                </div>
                <div class="shadow-lg p-3 mb-2 bg-white rounded"><h5>Poverty card summary</h5>
                    <p>
                        @foreach (array(DB::table('answer_candidate')->Where('candidate_id',$candidate['id'])->get()->pluck('summary')) as $record)
                            {{$record->get(10)}}
                        @endforeach
                    </p>
                </div>
                <div class="shadow-lg p-3 mb-2 bg-white rounded" style="width:100%;height:200px"><h5>Investigator is conclustion</h5>
                <p>{{$candidate['summary']}}</p>
                </div>

                <div class="mt-4">
                    <a href="{{url('/candidates')}}"><button class="btn btn-primary btn-sm">Go back to candidates list</button></a>
                    <div class="float-right">
                        @auth
                            @if(Auth::user()->role_id==1)
                                <a href="#!"  data-toggle="modal" data-target="#deleteCandidate" data-id="{{$candidate['id']}}"
                                    class="btn btn-danger btn-sm">Delete profile
                                </a>
                            @endif
                        @endauth
                        <a href="{{url('CandidateDetial/'.$candidate['id']."")}}" class="btn btn-success btn-sm">See profile details</a>
                        @auth
                            @if(Auth::user()->role_id==1)
                                <a href="{{url('candidates/'.$candidate['id']."/edit")}}" class="btn btn-primary btn-sm">Edit</a>
                            @endif
                        @endauth
                    </div>
                </div>

            </div>
        </div>
        <br>
    </div>
    <br>
</div>
@endsection
    <div class="modal fade" tabindex="-1" role="dialog" id="deleteCandidate">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete a Candidate</h5>
              <button type="button" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure?.</p>
              <small id="users"></small>
            </div>
            <div class="modal-footer">
                <form action="" id="fid" method="post">
                    @csrf
                    @method('delete')
              <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
              <button type="submit" class="btn btn-primary">Yes</button>
            </form>
            </div>
          </div>
        </div>
    </div>

