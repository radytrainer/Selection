<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\Ngo;
use App\Candidate;
use DB;


class CandidateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){


        $candidate= Candidate::all();

        $grade = Candidate::orderBy('grade', 'asc')->pluck('grade');
        $current = null;
        $grade_labels = array();
        $grade_number = array();
        $num_A = 0;
        $num_A_plus = 0;
        $num_A_minus = 0;
        $num_B = 0;
        $num_B_plus = 0;
        $num_B_minus = 0;
        $num_Fail = 0;
        if(! empty ($grade)) {
            foreach ($grade as $item) {
                // return $item;
                if ($item == "A+") {
                    $num_A_plus++;
                }
                if ($item == "A") {
                    $num_A++;
                }
                if ($item == "A-") {
                    $num_A_minus++;
                }
                if ($item == "B+") {
                    $num_B_plus++;
                }
                if ($item == "B") {
                    $num_B++;
                }
                if ($item == "B-") {
                    $num_B_minus++;
                }
                if ($item == "Fail") {
                    $num_Fail++;
                }
            }
            // return $num_A;

            if( $num_A_plus >= 0 ) {
                array_push( $grade_labels, "A+" );
                array_push( $grade_number, $num_A_plus );
            }
            if( $num_A >= 0 ) {
                array_push( $grade_labels, "A" );
                array_push( $grade_number, $num_A );
            }
            if( $num_A_minus >= 0 ) {
                array_push( $grade_labels, "A-" );
                array_push( $grade_number, $num_A_minus );
            }
            if( $num_B_plus >= 0 ) {
                array_push( $grade_labels, "B+" );
                array_push( $grade_number, $num_B_plus );
            }
            if( $num_B >= 0 ) {
                array_push( $grade_labels, "B" );
                array_push( $grade_number, $num_B );
            }
            if( $num_B_minus >= 0 ) {
                array_push( $grade_labels, "B-" );
                array_push( $grade_number, $num_B_minus );
            }
            if( $num_Fail >= 0 ) {
                array_push( $grade_labels, "Fail" );
                array_push( $grade_number, $num_Fail );
            }

            $grade_candidates = array(
                'labels' => $grade_labels,
                'datas' => $grade_number,
            );
            // return $grade_candidates;
        }

        $age = Candidate::orderBy('age', 'asc')->pluck('age');
        // $current = null;
        $age_labels = array();
        $age_number = array();
        $num_17_to_20 = 0;
        $num_21_to_24 = 0;
        if(! empty ($age)) {
            foreach ($age as $item) {

                if( $item <= 20 && $item >= 17 ) {
                    $num_17_to_20++;
                }

                if ( $item <= 24 && $item >= 21 ) {
                    $num_21_to_24++;
                }

            }

            if ( $num_17_to_20 >= 0) {
                array_push( $age_labels, "17 - 20" );
                array_push( $age_number, $num_17_to_20 );
            }

            if ( $num_21_to_24 >= 0) {
                array_push( $age_labels, "21 - 24" );
                array_push( $age_number, $num_21_to_24 );
            }

            $age_candidates = array(
                'labels' => $age_labels,
                'datas' => $age_number,
            );
            // return $age_candidates;
        }

        $ngo_id = Candidate::orderBy('ngo_id', 'asc')->pluck('ngo_id');
        $current = null;
        $ngo_labels = array();
        $ngo_number = array();
        $number_no = 0;
        $number_yes = 0;
        // return $ngo_id;
        if(! empty ($ngo_id)) {
            foreach ($ngo_id as $item) {
                if( $item != "" ) {
                    $number_yes++;
                } else {
                    $number_no++;
                }
            }
            // return $number_yes;
            if( $number_yes >= 0) {
                array_push( $ngo_labels, "Yes" );
                array_push( $ngo_number, $number_yes );
            }
            if ( $number_no >= 0 ) {
                array_push( $ngo_labels, "No" );
                array_push( $ngo_number, $number_no );
            }

            $ngo_candidates = array(
                'labels' => $ngo_labels,
                'datas' => $ngo_number,
            );
            // return $ngo_candidates;
        }

        // ========= selected candidates ===========

        $grade_candidates_selected = Candidate::orderBy('grade', 'asc')->where('select',"Yes")->pluck('grade');
        $current = null;
        $grade_labels = array();
        $grade_number = array();
        $num_A = 0;
        $num_A_plus = 0;
        $num_A_minus = 0;
        $num_B = 0;
        $num_B_plus = 0;
        $num_B_minus = 0;
        if(! empty ($grade_candidates_selected)) {
            foreach ($grade_candidates_selected as $item) {
                // return $item;
                if ($item == "A+") {
                    $num_A_plus++;
                }
                if ($item == "A") {
                    $num_A++;
                }
                if ($item == "A-") {
                    $num_A_minus++;
                }
                if ($item == "B+") {
                    $num_B_plus++;
                }
                if ($item == "B") {
                    $num_B++;
                }
                if ($item == "B-") {
                    $num_B_minus++;
                }
            }
            // return $num_A;

            if( $num_A_plus >= 0 ) {
                array_push( $grade_labels, "A+" );
                array_push( $grade_number, $num_A_plus );
            }
            if( $num_A >= 0 ) {
                array_push( $grade_labels, "A" );
                array_push( $grade_number, $num_A );
            }
            if( $num_A_minus >= 0 ) {
                array_push( $grade_labels, "A-" );
                array_push( $grade_number, $num_A_minus );
            }
            if( $num_B_plus >= 0 ) {
                array_push( $grade_labels, "B+" );
                array_push( $grade_number, $num_B_plus );
            }
            if( $num_B >= 0 ) {
                array_push( $grade_labels, "B" );
                array_push( $grade_number, $num_B );
            }
            if( $num_B_minus >= 0 ) {
                array_push( $grade_labels, "B-" );
                array_push( $grade_number, $num_B_minus );
            }

            $grade_candidates_selected = array(
                'labels' => $grade_labels,
                'datas' => $grade_number,
            );
            // return $grade_candidates;
        }

        $age_candidates_selected = Candidate::orderBy('age', 'asc')->where('select',"Yes")->pluck('age');
        // $current = null;
        $age_labels = array();
        $age_number = array();
        $num_17_to_20 = 0;
        $num_21_to_24 = 0;
        if(! empty ($age_candidates_selected)) {
            foreach ($age_candidates_selected as $item) {

                if( $item <= 20 && $item >= 17 ) {
                    $num_17_to_20++;
                }

                if ( $item <= 24 && $item >= 21 ) {
                    $num_21_to_24++;
                }

            }

            if ( $num_17_to_20 >= 0) {
                array_push( $age_labels, "17 - 20" );
                array_push( $age_number, $num_17_to_20 );
            }

            if ( $num_21_to_24 >= 0) {
                array_push( $age_labels, "21 - 24" );
                array_push( $age_number, $num_21_to_24 );
            }

            $age_candidates_selected = array(
                'labels' => $age_labels,
                'datas' => $age_number,
            );
            // return $age_candidates;
        }

        $ngo_id_candidates_selected = Candidate::orderBy('ngo_id', 'asc')->where('select',"Yes")->pluck('ngo_id');
        $current = null;
        $ngo_labels = array();
        $ngo_number = array();
        $number_no = 0;
        $number_yes = 0;
        // return $ngo_id;
        if(! empty ($ngo_id_candidates_selected)) {
            foreach ($ngo_id_candidates_selected as $item) {
                if( $item != "" ) {
                    $number_yes++;
                } else {
                    $number_no++;
                }
            }
            // return $number_yes;
            if( $number_yes >= 0) {
                array_push( $ngo_labels, "Yes" );
                array_push( $ngo_number, $number_yes );
            }
            if ( $number_no >= 0 ) {
                array_push( $ngo_labels, "No" );
                array_push( $ngo_number, $number_no );
            }

            $ngo_candidates_selected = array(
                'labels' => $ngo_labels,
                'datas' => $ngo_number,
            );
            // return $ngo_candidates;
            // return $ngo_labels;
        }

        // ======= end selected candidates =========

        return view('pages.listCondidate',
                compact('candidate',
                        'grade_candidates',
                        'age_candidates',
                        'ngo_candidates',
                        'grade_candidates_selected',
                        'age_candidates_selected',
                        'ngo_candidates_selected'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role_id == 2){
            return redirect('candidates');
        } else {
            // $answer=Answer::all();
            // $question=Question::all();
            $ngo =Ngo::all();
            return view('pages.createCandidate',compact('ngo'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fileName="";

        if( $request->hasFile('inputFile')){
            $fileName=$request->file('inputFile')->getClientOriginalName();
            $request->file('inputFile')->storeAs('/public/img',$fileName);
        }
        $candidate=new Candidate;
        $candidate->Candidate_Name=$request->name;;
        $candidate->province=$request->province;
        $candidate->gender=$request->gender;
        $candidate->years=$request->slectionYears;
        $candidate->ngo_id=$request->ngo;
        $candidate->profile=$fileName;
        $candidate->Fill_By=$request->fil;
        $candidate->age=$request->age;
        $candidate->save();
        $answer=$request->answer;
        $i=0;
        $j=0;
        foreach($answer as $data){
            $candidate->answers()->attach($data);
            $getId=\DB::table('answer_candidate')->get()->last();
            \DB::table('answer_candidate')
            ->where('id',$getId->id)
            ->update(["comment"=>$request->note[$i]]);
            if($j<11){
                if($request->summa[$j]!=""){
                    \DB::table('answer_candidate')
                    ->where('id',$getId->id)
                    ->update(["summary"=>$request->summa[$j]]);
                    ++$j;
            }
            }

            ++$i;
        }
        // $candidate->answers()->sync($answer);
        $score=\DB::table('answer_candidate')->where('candidate_id',$candidate['id'])->get();
        $TotalScore=0;
        $countCoficient=0;
        $ScoreGrade=0;
        foreach($score as $value){
            if(Answer::find($value->answer_id)->label=="A"){
                $countCoficient+=Answer::find($value->answer_id)->score;
                $TotalScore+=Answer::find($value->answer_id)->score*1;
            }
             else if(Answer::find($value->answer_id)->label=="B"){
                $countCoficient+=Answer::find($value->answer_id)->score;
                $TotalScore+=Answer::find($value->answer_id)->score*2;
            }
            else  if(Answer::find($value->answer_id)->label=="C"){
                $countCoficient+=Answer::find($value->answer_id)->score;
                $TotalScore+=Answer::find($value->answer_id)->score*3;

            }
             else {
                $TotalScore+=Answer::find($value->answer_id)->score*0;
            }
        }
        $grade=" ";
        $select=" ";
        if($TotalScore!=0){
            $ScoreGrade=$TotalScore/$countCoficient;
        };

        if($ScoreGrade<1.5){
                  $grade="A";
                  $select="Yes";
          }else if($ScoreGrade<2.5){
                  $grade="B";
                  $select="Yes";
          }else{
              $grade="Fail";
              $select="No";
          }
          $summary=$request->summary;
          $sign=$request->sign;
          $moivation=$request->moivation;
          $cammunication=$request->cammunication;
          $responsible=$request->responsible;
          \DB::table('candidates')
          ->where('id',$candidate['id'])
          ->update(['grade' =>($grade.$sign),
                    'select'=>$select,
                    'summary'=>$summary,
                    'motivation'=>$moivation,
                    'communication'=>$cammunication,
                    'responsibility'=>$responsible
          ]);



        return redirect('/candidates');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidate = Candidate::find($id);
        return view('pages.Infocadidate')->with('candidate',$candidate);
        // return $candidate->id;
        return view('pages.Infocadidate', compact('candidate', 'ngo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role_id == 1){
            $candidate=Candidate::find($id);
            $ngo =Ngo::all();
            return view('pages.editCaniddate',compact('ngo','candidate'));
         } else {
            return "Unauthorise page";
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $fileName="";
        if( $request->hasFile('inputFile')){
            $fileName=$request->file('inputFile')->getClientOriginalName();
            $request->file('inputFile')->storeAs('/public/img',$fileName);
            \DB::table('candidates')
            ->where('id',$id)
            ->update(['profile' =>$fileName]);
        }

       \DB::table('candidates')
       ->where('id',$id)
       ->update(['Candidate_Name' =>$request->name,
                 'province'=>$request->province,
                 'gender'=>$request->gender,
                 'years'=>$request->slectionYears,
                 'ngo_id'=>$request->ngo,
                 'age'=>$request->age,
                 'Fill_By'=>$request->slectionYears
       ]);
    $candidate=Candidate::find($id);
    \DB::table('answer_candidate')
        ->where('candidate_id',$candidate->id)
        ->delete();
    $answer=$request->answer;
    $i=0;
    $j=0;
    foreach($answer as $data){
        $candidate->answers()->attach($data);
        $getId=\DB::table('answer_candidate')->get()->last();
        \DB::table('answer_candidate')
        ->where('id',$getId->id)
        ->update(["comment"=>$request->note[$i]]);
        if($j<11){
            if($request->summa[$j]!=""){
                \DB::table('answer_candidate')
                ->where('id',$getId->id)
                ->update(["summary"=>$request->summa[$j]]);
                $j++;
       }

        }
        ++$i;
    }
    $score=\DB::table('answer_candidate')->where('candidate_id',$candidate['id'])->get();
    $TotalScore=0;
    $countCoficient=0;
    $ScoreGrade=0;
    foreach($score as $value){
        if(Answer::find($value->answer_id)->label=="A"){
            $countCoficient+=Answer::find($value->answer_id)->score;
            $TotalScore+=Answer::find($value->answer_id)->score*1;
        }
         else if(Answer::find($value->answer_id)->label=="B"){
            $countCoficient+=Answer::find($value->answer_id)->score;
            $TotalScore+=Answer::find($value->answer_id)->score*2;
        }
        else  if(Answer::find($value->answer_id)->label=="C"){
            $countCoficient+=Answer::find($value->answer_id)->score;
            $TotalScore+=Answer::find($value->answer_id)->score*3;

        }
         else {
            $TotalScore+=Answer::find($value->answer_id)->score*0;
        }
    }
    $grade=" ";
    $select=" ";
    if($TotalScore!=0){
        $ScoreGrade=$TotalScore/$countCoficient;
    }
      if($ScoreGrade<1.5){
              $grade="A";
              $select="Yes";
      }else if($ScoreGrade<2.5){
              $grade="B";
              $select="Yes";
      }else{
          $grade="Fail";
          $select="No";
      }
      $summary=$request->summary;
      $sign=$request->sign;
      $moivation=$request->moivation;
      $cammunication=$request->cammunication;
      $responsible=$request->responsible;
      \DB::table('candidates')
      ->where('id',$candidate['id'])
      ->update(['grade' =>($grade.$sign),
                'select'=>$select,
                'summary'=>$summary,
                'motivation'=>$moivation,
                'communication'=>$cammunication,
                'responsibility'=>$responsible
      ]);
    return redirect('candidates/'.$candidate['id']);}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->answers()->detach();
        $candidate->delete();
        return redirect()->route('candidates.index');

    }
    // return response()->json(['return' => 'some data']);
    // public function testing() {
    //     $ngo = NGO::all();
    //     return view('pages.test', compact('ngo'));
    // }
    public function chart_data() {
        $grade = Candidate::orderBy('grade', 'asc')->pluck('grade');
        $current = null;
        $grade_labels = array();
        $grade_number = array();
        $number = 0;
        if(! empty ($grade)) {
            foreach ($grade as $item) {
                if($item != $current) {
                    if($number > 0) {
                        array_push( $grade_labels, $current );
                        array_push( $grade_number, $number );
                        // push in to array
                    }
                    $current = $item;
                    $number = 1;
                } else {
                    $number++;
                }
            }

            if( $number > 0 ) {
                array_push( $grade_labels, $current );
                array_push( $grade_number, $number );
            }

            $grade_candidates = array(
                'labels' => $grade_labels,
                'datas' => $grade_number,
            );

        }
        return $grade_candidates['labels'];
    }

}



