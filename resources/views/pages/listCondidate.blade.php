@extends('template')
@section('pageTitle', 'Selection-Committee - List Candidate')
@section('content')

<style>
    #listCandidates tbody tr {
        cursor: pointer;
    }

    #tableSelected tbody tr {
        cursor: pointer;
    }

    .buttons-excel {
        border: none;
        background: none;
        position: absolute;
    }
</style>

{{-- {{dd($grade_candidates_selected)}} --}}

<div class="container-fluid mt-5">

    <h1 class="text-center mb-1" id="title_list">List of all Candidates</h1>
    <br>
    <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link btn-outline-primary active" id="list_all_candidates" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                <i class="fas fa-users"></i> List of all candidates
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn-outline-primary" id="list_selected_candidates" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                <i class="fas fa-filter"></i> List of all selected candidate
            </a>
        </li>
    </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="list_all_candidates">

            {{-- list of all candidates --}}
                <div class="row">

                    <div class="col-sm-12 col-md-12 col-lg-7">
                        @auth
                            @if(Auth::user()->role_id==1)
                                <a href="{{route('candidates.create')}}" class="btn btn-primary mb-4"
                                    data-toggle="tooltip" data-placement="left" title="Create a New Candidate">
                                    <i class="fas fa-briefcase-medical"></i>  Add a candidate
                                </a>
                            @endif
                        @endauth

                        {{-- table of candidate --}}
                        <div class="table-responsive">

                            <table id="listCandidates" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Year</th>
                                        <th>Province</th>
                                        <th>Gender</th>
                                        <th>Global Grade</th>
                                        <th>Selected</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidate as $item)
                                        <tr data-href='{{url("candidates/".$item['id'])}}'
                                            data-toggle="tooltip" data-placement="left"
                                            title="Click">
                                            <td>{{$item->Candidate_Name}}</td>
                                            <td>{{$item->years}}</td>
                                            <td>{{$item->province}}</td>
                                            <td>{{$item->gender}}</td>
                                            <td>{{$item->grade}}</td>
                                            <td>{{$item->select}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                    {{-- end table of candidate --}}

                    {{-- ====== pie chart ====== --}}
                    <div class="col-sm-12 col-md-12 col-lg-5 mt-4">

                        <h3 class="text-center">Among all of candidates</h3>
                        <div class="row">
                            <canvas id="candidates" width="900" height="550"></canvas>
                        </div>

                        <div class="row">
                            <canvas class="col-sm-12 col-md-6 col-lg-6" width="900" height="550" id="gender"></canvas>
                            <canvas class="col-sm-12 col-md-6 col-lg-6" width="900" height="550" id="chart_ngo"></canvas>

                            <canvas class="col-sm-12 col-md-6 col-lg-6" width="900" height="550" id="age"></canvas>
                            <canvas class="col-sm-12 col-md-6 col-lg-6" width="900" height="550" id="province"></canvas>
                        </div>
                    </div>
                </div>
            {{-- end list of all candidates --}}
        </div>

        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="list_selected_candidates">

        {{-- list of all selected candidates --}}
            <div class="row">

                <div class="col-sm-12 col-md-12 col-lg-7">

                    <div class="table-responsive">

                        <table id="tableSelected" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Year</th>
                                    <th>Province</th>
                                    <th>Gender</th>
                                    <th>Global Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $selected=\DB::table('candidates')->where('select',"Yes")->get();
                            ?>
                                @foreach ( $selected as $item)
                                    <tr data-href='{{url("candidates/".$item->id)}}'
                                        data-toggle="tooltip" data-placement="left"
                                        title="Click">
                                        <td>{{$item->Candidate_Name}}</td>
                                        <td>{{$item->years}}</td>
                                        <td>{{$item->province}}</td>
                                        <td>{{$item->gender}}</td>
                                        <td>{{$item->grade}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- ====== pie chart ====== --}}
                <div class="col-sm-12 col-md-12 col-lg-5">

                    <h3 class="text-center">Among selected candidates</h3>
                    <div class="row">
                        <canvas id="candidates_selected" width="900" height="550"></canvas>
                    </div>


                    <div class="row">
                        <canvas class="col-sm-12 col-md-6 col-lg-6" width="900" height="550" id="gender_candidates_selected"></canvas>
                        <canvas class="col-sm-12 col-md-6 col-lg-6" width="900" height="550" id="chart_ngo_candidates_selected"></canvas>

                        <canvas class="col-sm-12 col-md-6 col-lg-6" width="900" height="550" id="age_candidates_selected"></canvas>
                        <canvas class="col-sm-12 col-md-6 col-lg-6" width="900" height="550" id="province_candidates_selected"></canvas>
                    </div>


                </div>
                </div>

            </div>

            {{-- end list of all selected candidates --}}
        </div>
    </div>

</div>
@endsection

<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>


{{-- pie chart --}}
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/mdb.min.js')}}"></script>

@push('scripts')

<script>

//======hany script export file======
$(document).ready(function() {
    $('#tableSelected, #listCandidates').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
            responsive: false,
                extend: 'excel',
                text: '<button class="btn btn-primary"><i class="fas fa-file-export"></i> Export List</button>',
            },
        ]
    });


    // ======= title of candidate =======
    $("#list_all_candidates").click(function() {
        $('#title_list').text("List of all Candidates");
    });

    $("#list_selected_candidates").click(function() {
        $('#title_list').text("List all of Selected Candidates");
    });
});
    // ============== pie chart ==============

    // ========== selected candidate ========

    new Chart(document.getElementById("candidates_selected"), {
            type: 'pie',
            data: {
                labels: {!!json_encode($grade_candidates_selected["labels"])!!},
                datasets: [{
                    backgroundColor: ["#00c853", "#c6ff00", "#eeff41", "#fdd835", "#f9a825", "#e65100"],
                    data: {!!json_encode($grade_candidates_selected['datas'])!!},
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Grade distribution'
                }
            }
        });
    // ============ end selected candidate =============

    // ========== gender ========

    var rows = document.getElementById("tableSelected").getElementsByTagName("tbody")[0].getElementsByTagName("tr"),
            len = rows.length,
            i,
            letters = [],
            cellNum = 3;
        for(i = 0; i < len; i++) {
            letters.push(rows[i].cells[cellNum].innerHTML);
        }
        console.log(len);
        console.log(letters);
        letters.sort();
        var label = [];
        var data = [];
        var current = null;
        var cnt = 0;
        for (var i = 0; i < letters.length; i++) {
            if (letters[i] != current) {
                if (cnt > 0) {
                    label.push(current);
                    data.push(cnt);
                }
                current = letters[i];
                cnt = 1;
            } else {
                cnt++;
            }

        }
        if (cnt > 0) {
            label.push(current);
            data.push(cnt);
        }
        console.log(data);
        console.log(label);

        new Chart(document.getElementById("gender_candidates_selected"), {
            type: 'pie',
            data: {
                labels: label,
                datasets: [{
                    backgroundColor: ["#64dd17", "#01579b"],
                    data: data
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Gender'
                }
            }
        });

        //  ========= end gender ==========

        // ========== ngo ========
        new Chart(document.getElementById("chart_ngo_candidates_selected"), {
            type: 'pie',
            data: {
                labels: {!!json_encode($ngo_candidates_selected['labels'])!!},
                datasets: [{
                    backgroundColor:  ["#00e676", "#d50000"],
                    data: {!!json_encode($ngo_candidates_selected['datas'])!!},
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'NGO Provanance'
                }
            }
        });
        // ============ end ngo =============

        // ========== age ========
        new Chart(document.getElementById("age_candidates_selected"), {
            type: 'pie',
            data: {
                labels: {!!json_encode($age_candidates_selected['labels'])!!},
                datasets: [{
                    backgroundColor:  ["#FDB45C", "#949FB1"],
                    data: {!!json_encode($age_candidates_selected['datas'])!!},
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Age'
                }
            }
        });
        //  ========= end age ==========

        // ========== province ========

    var rows = document.getElementById("tableSelected").getElementsByTagName("tbody")[0].getElementsByTagName("tr"),
            len = rows.length,
            i,
            letters = [],
            cellNum = 2;
        for(i = 0; i < len; i++) {
            letters.push(rows[i].cells[cellNum].innerHTML);
        }
        console.log(len);
        console.log(letters);
        letters.sort();
        var label = [];
        var data = [];
        var current = null;
        var cnt = 0;
        for (var i = 0; i < letters.length; i++) {
            if (letters[i] != current) {
                if (cnt > 0) {
                    label.push(current);
                    data.push(cnt);
                }
                current = letters[i];
                cnt = 1;
            } else {
                cnt++;
            }

        }
        if (cnt > 0) {
            label.push(current);
            data.push(cnt);
        }
        console.log(data);
        console.log(label);

        new Chart(document.getElementById("province_candidates_selected"), {
            type: 'pie',
            data: {
                labels: label,
                datasets: [{
                    backgroundColor: ["#64dd17", "#01bc9b",
                                        "#015cdb", "#bba7a1",
                                        "#917dc7", "#490850",
                                        "#cdcdcd", "#808080",
                                        "#effd43", "#fffffe",
                                        "#d4779b", "#24bc45"],
                    data: data
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Province'
                }
            }
        });

        //  ========= end province ==========
        // ====== end selected candidates =====


        // ================= all candidates =================
        new Chart(document.getElementById("candidates"), {
            type: 'pie',
            data: {
                labels: {!!json_encode($grade_candidates['labels'])!!},
                datasets: [{
                    backgroundColor: ["#00c853", "#c6ff00", "#eeff41", "#fdd835", "#f9a825", "#e65100", "#d50000"],
                    data: {!!json_encode($grade_candidates['datas'])!!}
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Grade distribution'
                }
            }
        });

        // =========== end all candidates =========

        // ========== gender ========

        var rows = document.getElementById("listCandidates").getElementsByTagName("tbody")[0].getElementsByTagName("tr"),
            len = rows.length,
            i,
            letters = [],
            cellNum = 3;
        for(i = 0; i < len; i++) {
            letters.push(rows[i].cells[cellNum].innerHTML);
        }
        console.log(len);
        console.log(letters);
        letters.sort();
        var label = [];
        var data = [];
        var current = null;
        var cnt = 0;
        for (var i = 0; i < letters.length; i++) {
            if (letters[i] != current) {
                if (cnt > 0) {
                    label.push(current);
                    data.push(cnt);
                }
                current = letters[i];
                cnt = 1;
            } else {
                cnt++;
            }

        }
        if (cnt > 0) {
            label.push(current);
            data.push(cnt);
        }
        console.log(data);
        console.log(label);

        new Chart(document.getElementById("gender"), {
            type: 'pie',
            data: {
                labels: label,
                datasets: [{
                    backgroundColor: ["#64dd17", "#01579b"],
                    data: data
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Gender'
                }
            }
        });

        //  ========= end gender ==========

        // ========== ngo ========
        new Chart(document.getElementById("chart_ngo"), {
            type: 'pie',
            data: {
                labels: {!!json_encode($ngo_candidates['labels'])!!},
                datasets: [{
                    backgroundColor:  ["#00e676", "#d50000"],
                    data: {!!json_encode($ngo_candidates['datas'])!!},
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'NGO Provanance'
                }
            }
        });
        //  ========= end ngo ==========

        // ========== age ========
        new Chart(document.getElementById("age"), {
            type: 'pie',
            data: {
                labels: {!!json_encode($age_candidates['labels'])!!},
                datasets: [{
                    backgroundColor:  ["#FDB45C", "#949FB1"],
                    data: {!!json_encode($age_candidates['datas'])!!},
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Age'
                }
            }
        });
        //  ========= end age ==========

        // ========== province ========

        var rows = document.getElementById("listCandidates").getElementsByTagName("tbody")[0].getElementsByTagName("tr"),
            len = rows.length,
            i,
            letters = [],
            cellNum = 2;
        for(i = 0; i < len; i++) {
            letters.push(rows[i].cells[cellNum].innerHTML);
        }
        console.log(len);
        console.log(letters);
        letters.sort();
        var label = [];
        var data = [];
        var current = null;
        var cnt = 0;
        for (var i = 0; i < letters.length; i++) {
            if (letters[i] != current) {
                if (cnt > 0) {
                    label.push(current);
                    data.push(cnt);
                }
                current = letters[i];
                cnt = 1;
            } else {
                cnt++;
            }

        }
        if (cnt > 0) {
            label.push(current);
            data.push(cnt);
        }
        console.log(data);
        console.log(label);

        new Chart(document.getElementById("province"), {
            type: 'pie',
            data: {
                labels: label,
                datasets: [{
                    backgroundColor: ["#64dd17", "#01bc9b",
                                        "#015cdb", "#bba7a1",
                                        "#917dc7", "#490850",
                                        "#cdcdcd", "#808080",
                                        "#effd43", "#fffffe",
                                        "#d4779b", "#24bc45"],
                    data: data
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Province'
                }
            }
        });

        //  ========= end province ==========

    // =========== end pie chart ============


</script>

<!-- ==============click row show detail============== -->

<script>

$("#listCandidates tbody tr").click(function() {
    var $row = $(this).closest("tr");
    var $text = $row.find(".nr").text();
    window.location = $(this).data("href");
});

$("#tableSelected tbody tr").click(function() {
    var $row = $(this).closest("tr");
    var $text = $row.find(".nr").text();
    window.location = $(this).data("href");
});

</script>
@endpush
