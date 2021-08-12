@extends('Layout.app')

@section('content')

<div id="mainDiv" class="container d-none">
    <div class="row">
    <div class="col-md-12 p-5">
        <table id="serviceDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="th-sm">Image</th>
                <th class="th-sm">Name</th>
                <th class="th-sm">Description</th>
                <th class="th-sm">Edit</th>
                <th class="th-sm">Delete</th>
              </tr>
            </thead>
            <tbody id="service_table">

            </tbody>
          </table>

    </div>
    </div>
    </div>

    <div id="loaderDiv" class="container">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <img class="loading-icon m-5" src="{{ asset('images/loader.svg') }}" alt="">
            </div>
        </div>
    </div>

    <div id="WrongDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <h3>Something Went Wrong!!!!</h3>
            </div>
        </div>
    </div>



    <div
  class="modal fade"  id="deleteModal"  tabindex="-1"  aria-labelledby="exampleModalLabel"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body deleteModal p-3 text-center">
          <h5 class="mt-4">Do You Wanna Delete??</h5>
          <h5 id="serviceDeleteID" class="mt-4"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">
          No
        </button>
        <button data-id=" " id="serviceDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



@endsection


@section('script')
<script type="text/javascript">

    getServiceData();

    function getServiceData() {




axios.get('/getServiceData')
    .then(function(response) {


    if (response.status==200) {
    var jsonData = response.data;
     $.each(jsonData, function(i, item) {

    $('#mainDiv').removeClass('d-none');
    $('#loaderDiv').addClass('d-none');

      $('<tr>').html(
      "<td><img class='table-img' src=" + jsonData[i].service_img + "></td>" +
      "<td>" + jsonData[i].service_name + "</td>" +
       "<td>" + jsonData[i].service_des + "</td>" +
        "<td><a  class='serviceEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
      "<td><a data-toggle='modal' data-target='#deleteModal'  class='serviceDeleteBtn'  data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
       ).appendTo('#service_table');

                });

                $('.serviceDeleteBtn').click(function () {
                   var id =  $(this).data('id')
                    $('#serviceDeleteID').html(id);
                    $('#serviceDeleteConfirmBtn').attr('data-id',id)
                });


        }else{


             $('#loaderDiv').addClass('d-none');
             $('#WrongDiv').removeClass('d-none');

        }

    })
    .catch(function(error) {
             $('#loaderDiv').addClass('d-none');
             $('#WrongDiv').removeClass('d-none');

    })

}


    $('#serviceDeleteConfirmBtn').click(function () {
        var id = $(this).data('id')
        getSeviceDelete(id)
    });



function getSeviceDelete(deleteID){
    axios.post('/ServiceDelete',{
        id:deleteID
    })
    .then(function (response) {
        if(response.data ==1){
            alert('success')
        }else{
            alert('failed')
        }
    })
    .catch(function (error) {
    })
}


</script>
@endsection
