@extends('layouts.dashboard')

@section('content')
<!-- Main Content -->
<style>
.add_department{
    background-color:#88270b !important;
}
.btn-icon-css {
    height: 37px !important;
}
</style>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Manage Talk Proposals</h2>
                  
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <!-- <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button> -->
                    <a href="{{route('new-talk-proposal')}}"><button class="btn btn-primary btn-icon-css float-right add_department" type="button"><i class="zmdi zmdi-plus"></i> New Talk Proposal</button></a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="card project_list">
                        <div class="table-responsive">
                            <table class="table table-hover c_table theme-color" id="manage_talk_proposals" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Action</th>                                       
                                        <th>Tag</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>PDF Uploaded</th>
                                        <th>Average Rating</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
  $(function () {
    var table = $('#manage_talk_proposals').DataTable({
        processing: false,
        serverSide: true,
        ordering: false,
        searching: false,
        ajax: "{{ route('talk-proposals') }}",
        columns: [
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'tag', name: 'tag'},
            {data: 'title', name: 'title'},
            {data: 'description', name: 'description'},
            {data: 'uploaded_document', name: 'uploaded_document'},
            {data: 'average_rating', name: 'average_rating'}
        ]
    });   
    
    $(document).on("click",".remove_department_button",function(event){
        event.preventDefault()
        var designation_id=$(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover the record!",
            icon: "warning",
            buttons: [
                'No, cancel it!',
                'Yes, I am sure!'
            ],
            dangerMode: true
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : "#",
                    data : {"_token": "{{ csrf_token() }}",'designation_id':designation_id},
                    type : 'POST',
                    success : function(result){
                        table.draw();
                    }
                });
            }
        })
    })
});
</script>
@endsection