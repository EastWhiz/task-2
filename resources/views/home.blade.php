@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    
                        @csrf
                        <div class="form-group">
                            <label>Dropdown 1</label>
                            <select class="form-control" name="drop1">
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dropdown 2</label>
                            <select class="form-control" name="drop2">
                                <option value="11">Step 11</option>
                                <option value="12">Step 12</option>
                                <option value="13">Step 13</option>
                                <option value="14">Step 14</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success submit_btn">
                            Submit
                        </button>
                   
                    {{-- @if($drop1!="")
                        <p class="alert alert-info">
                            Dropdown 1:- {{$drop1}}<br>
                            Dropdown 2:- {{$drop2}}<br>
                        </p>
                    @else
                        <p class="alert alert-warning">Form has not triggered yet.</p>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.form-group label{display:block; margin:10px 0px; font-size:14px; font-weight:bold;}
.form-group .btn{margin-top:20px; margin-bottom:20px;}
</style>
<script>
function setOption(v){
    let html = "";
        if (v == "1"){
            for(n = 1; n <= 4; n++){
                let vl = "1"+n;
                html += "<option value='"+vl+"'>Step "+vl+"</option>";
            }
        }else  if (v == "2"){
            for(n = 1; n <= 4; n++){
                let vl = "2"+n;
                html += "<option value='"+vl+"'>Step "+vl+"</option>";
            }
        }
        $("select[name='drop2']").html(html);
}
$(document).ready(function(){
    $("select[name='drop1']").change(function(){
        let v = $(this).val();
        setOption(v);
    });
    $(".submit_btn").click(function(){
        window.axios.post('/socket?drop1='+$("select[name='drop1']").val());
    });
});
</script>
@vite('resources/js/app.js?v=1')
<script>
setTimeout(function(){
    Echo.channel('testing')
    .listen('.App\\Events\\TestingEvent', (e) => {
        $("select[name='drop1']").val(e.message);
        setOption(e.message);
    })
}, 2000);

</script>
@endsection
