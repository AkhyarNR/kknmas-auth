<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" content="2; url=<?php url('antrian_poli/cetak/'.$id);?>">
<textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
 window.focus();
 window.print();
//}
</script>
</head>
<body>
<div id="print_antrian">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<center>
<table style="width:300px;">
<tr>
<td class="text-center">
<div class="container text-center">
  <div class="row">
    <div class="col-md bg-success" style="padding:10px;text-align:center">
      <div style="border-top:1px solid gray;width: 230px;margin-left: auto;margin-right: auto;"></div>
      <div style="padding:5px;font-weight:bold;font-size:15px;">RS Asri Medical Center (AMC)</br>Yogyakarta</div> 
      <div style="border-bottom:2px dashed gray;width: 230px;margin-left: auto;margin-right: auto;"></div>
      <div style="font-size:9px;float:left;margin-left: 10%;">{{date('D, d F Y')}}</div> 
      <div style="font-size:9px;float:right;margin-right: 10%;">{{date('H:i:s')}}</div> 

      <div style="font-size:50px;font-weight:bold;padding:5px;">
       {{$data->No_Urut}}
      </div>
      <div style="font-size:10px;font-weight:bold;padding:5px;">
       ANTRIAN POLI : {{$data->Work_Unit_Name}}
      </div>
      <div style="padding-top:5px;font-size:13px;">
            Total Antrian : {{$total_antrian}}
      </div>
      <hr/>
      </div>
  </div>
</div>  
</td>
</tr>
</table>
</center>
</div>
</body>