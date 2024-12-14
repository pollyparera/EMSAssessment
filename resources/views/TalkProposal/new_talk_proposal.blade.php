@extends('layouts.dashboard')

@section('content')
<style>
.ui-datepicker-header select.ui-datepicker-month, .ui-datepicker-header select.ui-datepicker-year {
  padding: 5px!important;
}
</style>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add New Talk Proposal</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <!-- <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button> -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="{{route('create-talk-proposal')}}" method="POST" class="talk_proposal_form" enctype='multipart/form-data'>
                            @csrf
                            <div class="body">
                                <div class="row">
                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                        <label for="tag" class="required"><strong>Tag</strong></label>
                                        <select name="tag" id="tag" class="form-control">
                                            <option value="">Select Tag</option>
                                            <?php foreach($tags as $key=>$val){ ?>
                                            <option value="{{$val->id}}" {{old('tag')==$val->id ? 'selected' : ''}}>{{$val->name}}</option>
                                            <?php } ?>
                                        </select>
                                        @error('tag')
                                            <label class="error help-block">{{ $message }}</label>
                                        @enderror
                                    </div>

                                    <div class="form-group make_main_div col-md-6 col-sm-12">
                                        <label for="title" class="required"><strong>Title</strong></label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{old('title')}}">
                                        @error('title')
                                            <label class="error help-block">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group make_main_div col-md-12 col-sm-12">
                                        <label for="description"><strong>Description</strong></label>
                                        <textarea id="froala-editor" name="description" class="form-control" rows="10"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group make_main_div col-md-12 col-sm-12">
                                        <label for="presentation_pdf" class="required"><strong>Presentation PDF</strong></label>
                                       <input type="file" name="presentation_pdf" id="presentation_pdf" class="form-control" accept="application/pdf"/>
                                       @error('presentation_pdf')
                                            <label class="error help-block">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group text-right mt-2">  
                                    <input type="submit" name="submit" value="Submit" class="btn btn-primary" style="background-color:#88270b"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(function(){
    new FroalaEditor('#froala-editor', {
        attribution: false,
        height: 150    
    });

    $(".talk_proposal_form").validate({
        rules: {
            tag:{
                required: true
            },
            title:{
                required: true
            },
            presentation_pdf:{
                required: true
            }
        },
        messages: {
            tag:{
                required: "Please select tag"
            },
            title:{
                required: "Please select title"
            },
            presentation_pdf:{
                required: "Please select presentation pdf"
            }
        }
    });
});
</script>
@endsection