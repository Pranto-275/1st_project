@extends('Layout.app')

@section('content')

<div class="container">
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

@endsection


@section('script')
<script type="text/javascript">

    getServiceData();

    function getServiceData() {

axios.get('/getServiceData')
    .then(function(response) {
        var jsonData = response.data;
        $.each(jsonData, function(i, item) {

            $('<tr>').html(
                "<td><img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                "<td>" + jsonData[i].service_name + "</td>" +
                "<td>" + jsonData[i].service_des + "</td>" +
                "<td><a  class='serviceEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                "<td><a  class='serviceDeleteBtn'  data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
            ).appendTo('#service_table');

        });


    })
    .catch(function(error) {})

}
</script>
@endsection
