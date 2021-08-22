@extends('Layout.app')


@section('content')

<div id="manDivCourse" class="container d-none">
    <div class="row">
    <div class="col-md-12 p-5">
    <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">Name</th>
          <th class="th-sm">Fee</th>
          <th class="th-sm">Class</th>
          <th class="th-sm">Enroll</th>
          <th class="th-sm">Details</th>
          <th class="th-sm">Edit</th>
          <th class="th-sm">Delete</th>
        </tr>
      </thead>
      <tbody id="course_table">



      </tbody>
    </table>

    </div>
    </div>
    </div>

    <div id="loaderDivCourse" class="container">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <img class="loading-icon m-5" src="{{ asset('images/loader.svg') }}" alt="">
            </div>
        </div>
    </div>

    <div id="WrongDivCourse" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <h3>Something Went Wrong!!!!</h3>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>

getCoursesData();


//for services table
function getCoursesData() {
    axios.get('/getCoursesData')
        .then(function(response) {


            if (response.status == 200) {
                $('#manDivCourse').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');
                $('#course_table').empty();




                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td>"+ jsonData[i].course_name +"</td>" +

                        "<td>" + jsonData[i].course_fee + "</td>" +

                        "<td>" + jsonData[i].course_coursetotalclass + "</td>" +

                        "<td>" + jsonData[i].course_totalenroll + "</td>" +

                        "<td><a  class='courseViewDetailsBtn' data-id=" + jsonData[i].id + "><i class='fas fa-eye'></i></a></td>" +

                        "<td><a  class='courseEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +

                        "<td><a data-toggle='modal' data-target='#deleteModal'  class='courseDeleteBtn'  data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#course_table');

                });

                // //services table delete iconclick
                // $('.serviceDeleteBtn').click(function() {
                //     var id = $(this).data('id')
                //     $('#serviceDeleteID').html(id);

                // });

                // //service table edit iconclick
                // $('.serviceEditBtn').click(function() {
                //     var id = $(this).data('id')
                //     $('#serviceEditID').html(id);
                //     SeviceUpdateDetails(id)
                //     $('#editModal').modal('show')

                // });



            } else {


                $('#loaderDivCourse').addClass('d-none');
                $('#WrongDivCourse').removeClass('d-none');

            }

        })
        .catch(function(error) {
            $('#loaderDivCourse').addClass('d-none');
            $('#WrongDivCourse').removeClass('d-none');

        })

}


</script>

@endsection
