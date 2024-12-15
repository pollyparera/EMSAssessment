@extends('layouts.ReviewerDashboard')

@section('content')
<!-- Main Content -->
<style>
.submit_rating{
    background-color:#88270b !important;
}
.btn-icon-css {
    height: 37px !important;
}
.submit_review{
    background-color:#88270b !important;
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
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <select name="tags" id="tags" class="form-control">
                        <option value="">Select Tag</option>
                        <?php foreach($tags as $key=>$val){ ?>
                        <option value="{{$val->id}}">{{$val->name}}</option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                    <select name="speakers" id="speakers" class="form-control">
                        <option value="">Select Speaker</option>
                        <?php foreach($speakers as $key=>$val){ ?>
                        <option value="{{$val->id}}">{{$val->name}}</option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="text" name="date_submitted" id="date_submitted" class="form-control" placeholder="Date Submitted"/>
                </div>
            </div>
            <div style="clear:both;">&nbsp;</div>
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
                                        <th>Speaker</th>
                                        <th>Description</th>
                                        <th>PDF Uploaded</th>
                                        <th>Overall Rating</th>
                                        <th>Submitted Rating</th>
                                        <th>Submitted Review</th>
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

<div class="modal fade" id="modelWindow" role="dialog">
    <div class="modal-dialog modal-lg vertical-align-center">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Rating for <span id="title"></span></h4>
            </div>
            <hr/>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group make_main_div col-md-12 col-sm-12">
                        <label for="rating"><strong>Enter Rating number Upto 5</strong></label>
                        <input type="number" id="rating" name="rating" class="form-control"/> 
                    </div>
                </div>

                <div class="row">
                    <div class="form-group make_main_div col-md-12 col-sm-12">
                        <label for="review"><strong>Enter Review</strong></label>
                        <textarea name="review" id="review" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="proposal_id" id="proposal-id"/>
                <button id="submit_review" class="btn btn-primary submit_review">Submit Review</button>
                <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $(function () {
    new FroalaEditor('#review', {
        attribution: false
    });

    var table = $('#manage_talk_proposals').DataTable({
        processing: false,
        serverSide: true,
        ordering: false,
        searching: false,
        ajax: {
            url: "{{ route('reviewer-dashboard') }}",
            data: function (d) {
                d.tags = $('#tags').val();
                d.speakers = $('#speakers').val();
                d.date_submitted = $('#date_submitted').val();
            }
        },
        columns: [
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'tag', name: 'tag'},
            {data: 'title', name: 'title'},
            {data: 'speaker', name: 'speaker'},
            {data: 'description', name: 'description'},
            {data: 'uploaded_document', name: 'uploaded_document'},
            {data: 'overall_rating', name: 'overall_rating'},
            {data: 'submitted_rating', name: 'submitted_rating'},
            {data: 'submitted_review', name: 'submitted_review'}
        ]
    }); 

    $("#tags").change(function(){
        $('.table').DataTable().draw();
    })

    $("#speakers").change(function(){
        $('.table').DataTable().draw();
    })
    
    $(document).on("click",".submit_rating",function(event){
        event.preventDefault();
        $("#title").html($(this).data('title'));
        $("#proposal-id").val($(this).data('proposel-id'));
        $("#rating").val($(this).data('submitted-rating'));
        $("#review").val($(this).data('submitted-review'));
        $('#modelWindow').modal('show');
    })

    $("#submit_review").click(function(){
        var rating=$("#rating").val();

        var review=$("#review").val();

        var proposal_id=$("#proposal-id").val();

        if(rating=='' || review==''){
            alert("Please submit both rating and review");
            return false;
        }

        if(rating > 5){
            alert("Rating should be under 5");
            return false;
        }


        $(".submit_review").text("Please Wait...");

        $(".submit_review").prop("disabled",true);

        $.ajax({
                url : "{{ route('submit-review') }}",
                data : {"_token": "{{ csrf_token() }}",'rating':rating,'review':review,'proposal_id':proposal_id},
                type : 'POST',
                success : function(result){
                    $(".submit_review").text("Submit Review");
                    $(".submit_review").prop("disabled",false);
                    $("#modelWindow").modal("hide");
                    table.draw();
                }
            });
    })

    $("#date_submitted").datepicker({
        dateFormat: 'dd-M-yy',
        changeMonth: true,
        changeYear: true,
        maxDate: 0, // Maximum date is today
        yearRange: "2000:+0", // Show years from 2000 onwards
        beforeShow: function(input, inst) {
            $(input).prop('readonly', true);
        },
        onSelect: function(dateText, datePickerInstance) {
            $('.table').DataTable().draw();
        },
        defaultDate:new Date(), // Set default date to January 1, 2024
    });
});
</script>
@endsection