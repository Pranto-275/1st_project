@extends('Layout.app')

@section('content')

<div id="mainDiv" class="container d-none">
    <div class="row">
    <div class="col-md-12 p-5">

        <button id="addNewBtnId" class="btn btn-sm my-3 btn-danger">Add New</button>

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



    <div class="modal fade"  id="deleteModal"  tabindex="-1"  aria-labelledby="exampleModalLabel"  aria-hidden="true">
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
        <button  id="serviceDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<!-- edit modal -->

<div class="modal fade"  id="editModal"  tabindex="-1"  aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body deleteModal p-3 text-center">
            <h5 id="serviceEditID" class="mt-4"></h5>

            <div id="serviceEditForm" class="d-none" class="w-100">

         <input id="serviceNameID" type="text" class="form-control mb-4" placeholder="Service Name">
         <input id="serviceDesID" type="text" class="form-control mb-4" placeholder="Service Desciption">
         <input id="serviceImgID" type="text" class="form-control mb-4" placeholder="Service Image Link">

            </div>
         <img id="serviceEditLoader" class="loading-icon m-5 " src="{{ asset('images/loader.svg') }}" alt="">

         <h5 id="serviceEditWrong" class="d-none">Something Went Wrong!!!!</h5>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">
            Cancel
          </button>
          <button  id="serviceEditConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
        </div>
      </div>
    </div>
  </div>



  <!-- Add New modal -->

<div class="modal fade"  id="addModal"  tabindex="-1"  aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body  p-3 text-center">


        <div id="serviceAddForm"  class="w-100">
            <h6 class="mb-4">Add New Service</h6>
         <input id="serviceNameAddID" type="text" class="form-control mb-4" placeholder="Service Name">
         <input id="serviceDesAddID" type="text" class="form-control mb-4" placeholder="Service Desciption">
         <input id="serviceImgAddID" type="text" class="form-control mb-4" placeholder="Service Image Link">
        </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">
            Cancel
          </button>
          <button  id="serviceAddConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
        </div>
      </div>
    </div>
  </div>

@endsection


@section('script')
<script type="text/javascript">

getServiceData();


//for services table
function getServiceData() {
    axios.get('/getServiceData')
        .then(function(response) {


            if (response.status == 200) {
                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

                $('#service_table').empty();




                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td><img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                        "<td>" + jsonData[i].service_name + "</td>" +
                        "<td>" + jsonData[i].service_des + "</td>" +
                        "<td><a  class='serviceEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                        "<td><a data-toggle='modal' data-target='#deleteModal'  class='serviceDeleteBtn'  data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#service_table');

                });

                //services table delete iconclick
                $('.serviceDeleteBtn').click(function() {
                    var id = $(this).data('id')
                    $('#serviceDeleteID').html(id);

                });

                //service table edit iconclick
                $('.serviceEditBtn').click(function() {
                    var id = $(this).data('id')
                    $('#serviceEditID').html(id);
                    SeviceUpdateDetails(id)
                    $('#editModal').modal('show')

                });



            } else {


                $('#loaderDiv').addClass('d-none');
                $('#WrongDiv').removeClass('d-none');

            }

        })
        .catch(function(error) {
            $('#loaderDiv').addClass('d-none');
            $('#WrongDiv').removeClass('d-none');

        })

}

//service modal yes button
$('#serviceDeleteConfirmBtn').click(function() {
    var id = $('#serviceDeleteID').html();
    ServiceDelete(id)
});


//service delete
function ServiceDelete(deleteID) {

    $('#serviceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")

    axios.post('/ServiceDelete', {
            id: deleteID
        })
        .then(function(response) {
            $('#serviceDeleteConfirmBtn').html("Yes")
            if(response.status==200){
                if (response.data == 1) {
                $('#deleteModal').modal('hide')
                toastr.success('Delete Success');
                getServiceData();

            } else {
                $('#deleteModal').modal('hide')
                toastr.error('Delete failed');
                getServiceData();
            }
            }else{
                $('#deleteModal').modal('hide');
             toastr.error('Something Went Wrong !');

            }




        })
        .catch(function(error) {
            $('#deleteModal').modal('hide');
             toastr.error('Something Went Wrong !');
        })
}


//each service update details
function SeviceUpdateDetails(detailsID) {
    axios.post('/ServiceDetails', {
            id: detailsID
        })
        .then(function(response) {

            if(response.status==200){
                $('#serviceEditForm').removeClass('d-none')
                $('#serviceEditLoader').addClass('d-none')

                var jsonData = response.data;
                $('#serviceNameID').val(jsonData[0].service_name)
                $('#serviceDesID').val(jsonData[0].service_des)
                $('#serviceImgID').val(jsonData[0].service_img)
            }else{
                $('#serviceEditLoader').addClass('d-none')
                $('#serviceEditWrong').removeClass('d-none')
            }


        })
        .catch(function(error) {
                $('#serviceEditLoader').addClass('d-none')
                $('#serviceEditWrong').removeClass('d-none')

        })
}



//service update modal save button
$('#serviceEditConfirmBtn').click(function() {
    var id = $('#serviceEditID').html();
    var name = $('#serviceNameID').val();
    var des = $('#serviceDesID').val();
    var img = $('#serviceImgID').val();

    SeviceUpdate(id,name,des,img)
});

//service update
function SeviceUpdate(serviceID,serviceName,serviceDes,serviceImg) {
    $('#serviceEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
 if (serviceName.length==0) {
    toastr.error('Service Name is Empty!');
    }else if (serviceDes.length==0) {
        toastr.error('Service Description is Empty!');

}else if (serviceImg.length==0) {
    toastr.error('Service Image is Empty!');

}else{

    axios.post('/ServiceUpdate', {
            id: serviceID,
            name:serviceName,
            des:serviceDes,
            img:serviceImg
        })
        .then(function(response) {
            $('#serviceEditConfirmBtn').html("Save")
            if(response.status ==200){
                if (response.data ==1) {

$('#editModal').modal('hide')
toastr.success('Update Success');
getServiceData();

}else{
$('#editModal').modal('hide')
toastr.success('Update failed');
getServiceData();

}
            }else{
                $('#editModal').modal('hide')
                toastr.error('Something went Wrong!!');
            }

        })
        .catch(function(error) {
            $('#editModal').modal('hide')
                toastr.error('Something went Wrong!!');

        })

}


}



//add new  button btn clic

$('#addNewBtnId').click(function () {
    $('#addModal').modal('show')

});



//service add modal save button
$('#serviceAddConfirmBtn').click(function() {

    var name = $('#serviceNameAddID').val();
    var des = $('#serviceDesAddID').val();
    var img = $('#serviceImgAddID').val();

    SeviceAdd(name,des,img)
});

//service add method


function SeviceAdd(serviceName,serviceDes,serviceImg) {

 if (serviceName.length==0) {
    toastr.error('Service Name is Empty!');
    }else if (serviceDes.length==0) {
        toastr.error('Service Description is Empty!');

}else if (serviceImg.length==0) {
    toastr.error('Service Image is Empty!');

}else{

    $('#serviceAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")

    axios.post('/ServiceAdd', {
            name:serviceName,
            des:serviceDes,
            img:serviceImg
        })
        .then(function(response) {
            $('#serviceAddConfirmBtn').html("Save")
            if(response.status ==200){
                if (response.data ==1) {

            $('#addModal').modal('hide')
                toastr.success('Add Success');
                    getServiceData();

            }else{
            $('#addModal').modal('hide')
                toastr.success('Add failed');
                    getServiceData();

                }
            }else{
                $('#addModal').modal('hide')
                toastr.error('Something went Wrong!!');
            }

        })
        .catch(function(error) {
            $('#addModal').modal('hide')
                toastr.error('Something went Wrong!!');

        })

}


}




</script>
@endsection
