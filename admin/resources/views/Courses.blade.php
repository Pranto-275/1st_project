@extends('Layout.app')


@section('content')

<div id="manDivCourse" class="container d-none">
    <div class="row">
    <div class="col-md-12 p-5">

        <button id="addNewCourseBtnId" class="btn btn-sm my-3 btn-danger">Add New</button>

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


    <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">
     			<input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
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

$('#addNewCourseBtnId').click(function () {

    $('#addCourseModal').modal('show')

});


//course add modal save button
$('#CourseAddConfirmBtn').click(function() {

    var coursename = $('#CourseNameId').val();
    var coursedes = $('#CourseDesId').val();
    var coursefee = $('#CourseFeeId').val();
    var courseeroll = $('#CourseEnrollId').val();
    var courseclass = $('#CourseClassId').val();
    var courselink = $('#CourseLinkId').val();
    var courseimg = $('#CourseImgId').val();

    CourseAdd(coursename, coursedes, coursefee,courseeroll,courseclass,courselink,courseimg)
});

//course add method


function CourseAdd(coursename, coursedes, coursefee,courseeroll,courseclass,courselink,courseimg) {

    if (coursename.length == 0) {
        toastr.error('Course Name is Empty!');
    } else if (coursedes.length == 0) {
        toastr.error('course Description is Empty!');

    } else if (coursefee.length == 0) {
        toastr.error('Course Fee is Empty!');

    }  else if (courseeroll.length == 0) {
        toastr.error('Course Enroll is Empty!');

    }  else if (courseclass.length == 0) {
        toastr.error('Course class is Empty!');

    }  else if (courselink.length == 0) {
        toastr.error('Course Link is Empty!');

    }  else if (courseimg.length == 0) {
        toastr.error('Course Image is Empty!');

    } else {

        $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")

        axios.post('/CoursesAdd', {
            course_name: coursename,
            course_des: coursedes,
            course_fee: coursefee,
            course_totalenroll: courseeroll,
            course_totalclass: courseclass,
            course_link: courselink,
            course_img: courseimg,
            })

            .then(function(response) {

                $('#CourseAddConfirmBtn').html("Save")

                if (response.status == 200) {

                    if (response.data == 1) {

                        $('#addCourseModal').modal('hide')
                        toastr.success('Add Success');
                        getCoursesData();


                    } else {
                        $('#addCourseModal').modal('hide')
                        toastr.error('Add failed');
                        getCoursesData();


                    }
                } else {
                    $('#addCourseModal').modal('hide')
                    toastr.error('Something went Wrong!!');
                }

            })
            .catch(function(error) {
                $('#addCourseModal').modal('hide')
                toastr.error('Something went Wrong!!');


            })

    }


}
</script>

@endsection
