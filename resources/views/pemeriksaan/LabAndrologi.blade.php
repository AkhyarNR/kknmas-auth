@extends('layouts.master')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Lab Andrologi</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <form id="msform" action="{{url('pemeriksaan/andrologilab/createperiksa')}}" method="POST">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="pasien"><strong>Data Pasien</strong></li>
                                <li id="umum"><strong>Pemeriksaan</strong></li>
                                <li id="catatan"><strong>Catatan</strong></li>
                            </ul> 
                            @csrf
                            @method('POST')
                                <input type="text" value="{{ $val->No_Perawatan }}" name="No_Perawatan" hidden>
                                <input type="text" value="{{ $val->Pasien_Id }}" name="Pasien_Id" hidden>
                                <input type="text" value="{{ $val->Pasien_Lab_Id }}" name="Pasien_Lab_Id" hidden>
                                <input type="text" value="{{ $val->Prosedur_Medis_Biaya_Id }}" name="Prosedur_Medis_Biaya_Id" hidden>

                            <fieldset>  
                                <br>
                                <div class="form-card">              
                                    @include('pemeriksaan.labandrologi.Form_DetailAndrologi')
                                </div>
                
                                <button type="button" name="batal1" onclick="batal({{ $val->Pasien_Lab_Id }})" class="batal action-button-previous">Batal</button>
                                <input type="button" name="next" class="next action-button" value="Next Step" />

                            </fieldset>

                            <fieldset>
                                <br>
                                <div class="form-card">
                                    @include('pemeriksaan.labandrologi.Form_Andrologi')
                                </div>
                                
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                <input type="button" name="next" class="next action-button" value="Next Step" />
                            </fieldset>

                            <fieldset>
                                <br>
                                <div class="form-card">
                                    @include('pemeriksaan.labandrologi.Form_CatatanAndrologi')
                                </div>
                                
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                <input type="submit" class="action-button" value="Simpan">     
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
#grad1 {
    background-color: : #9C27B0;
    background-image: linear-gradient(120deg, #FF4081, #81D4FA)
}

#msform {
    text-align: center;
    position: relative;
    font-size: 14px;
    margin-top: 20px
}

#msform fieldset .form-card {
    background: white;
    text-align: left;
    border: 0 none;
    border-radius: 0px;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    padding: 20px 40px 30px 40px;
    box-sizing: border-box;
    width: 94%;
    margin: 0 3% 20px 3%;
    position: relative
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative
}

#msform fieldset:not(:first-of-type) {
    display: none
}

#msform fieldset .form-card {
    text-align: left;
    color: #9E9E9E
}


#msform input:focus,
#msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: none;
    font-weight: bold;
    outline-width: 0;
}

#msform .action-button {
    width: 100px;
    background: #2a3f53;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px
}

#msform .action-button:hover,
#msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #2a3f53
}

#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px
}

#msform .action-button-previous:hover,
#msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #616161
}

select.list-dt {
    border: none;
    outline: 0;
    border-bottom: 1px solid #ccc;
    padding: 2px 5px 3px 5px;
    margin: 2px
}

select.list-dt:focus {
    border-bottom: 2px solid #2a3f53
}

.card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative
}

.fs-title {
    font-size: 25px;
    color: #2C3E50;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey
}

#progressbar .active {
    color: #000000
}

#progressbar li {
    list-style-type: none;
    font-size: 12px;
    width: 33%;
    float: left;
    position: relative
}
#progressbar #pasien:before {
    font-family: FontAwesome;
    content: "\f007"
}
#progressbar #umum:before {
    font-family: FontAwesome;
    content: "\f0f0"
}

#progressbar #catatan:before {
    font-family: FontAwesome;
    content: "\f040"
}

#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #2a3f53
}

.radio-group {
    position: relative;
    margin-bottom: 25px
}

.radio {
    display: inline-block;
    width: 204;
    height: 104;
    border-radius: 0;
    background: lightblue;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    box-sizing: border-box;
    cursor: pointer;
    margin: 8px 2px
}

.radio:hover {
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
}

.radio.selected {
    box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
}

.fit-image {
    width: 100%;
    object-fit: cover
}

</style>

<script>

    function batal(id) {
    $.ajax({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      url: "{{ route('batal') }}",
      type: "POST",
      data: {
        Pasien_Lab_Id: id
      },
      success : function(){
            window.open('{{ url("pemeriksaan/labandrologi") }}/','_self');
        }
    });
}

</script>



<script type="text/javascript">
$(document).ready(function(){
    

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;


    $(".next").click(function(){


    current_fs = $(this).parent();
    next_fs = $(this).parent().next();


    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");


    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;


    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    next_fs.css({'opacity': opacity});
    },
    duration: 600
    });
    });


    $(".previous").click(function(){


    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();


    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");


    //show the previous fieldset
    previous_fs.show();


    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;


    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    previous_fs.css({'opacity': opacity});
    },
    duration: 600
    });
    });


    $('.radio-group .radio').click(function(){
    $(this).parent().find('.radio').removeClass('selected');
    $(this).addClass('selected');
    });
});

</script>
@endsection