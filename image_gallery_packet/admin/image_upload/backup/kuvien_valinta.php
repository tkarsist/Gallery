<?php
include ('/srv/www/htdocs/login/login.php');
if (!isset($_SESSION['hiiripippeli'])){
	die();
}
include ('functions.php');
$_SESSION['temphakemisto_short']=getTempDir();
$short=$_SESSION['temphakemisto_short'];
$_SESSION['temphakemisto']=create_temp_dir($_SESSION['temphakemisto_short']);
$long=$_SESSION['temphakemisto'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<link href="css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/swfupload.js"></script>
<script type="text/javascript" src="js/swfupload.queue.js"></script>
<script type="text/javascript" src="js/fileprogress.js"></script>
<script type="text/javascript" src="js/handlers.js"></script>
<script type="text/javascript">
                var swfu;

                window.onload = function() {
                        var settings = {
                                flash_url : "swfupload_f9.swf",
                                upload_url: "upload.php?<?php echo "HAKEMISTO=".$_SESSION['temphakemisto_short']; ?>",// Relative to the SWF file
                                post_params: {"HAKEMISTO" : "<?php echo $_SESSION['temphakemisto_short']; ?>"},
                                file_size_limit : "100 MB",
                                file_types : "*.*",
                                file_types_description : "All Files",
                                file_upload_limit : 100,
                                file_queue_limit : 0,
                                custom_settings : {
                                        progressTarget : "fsUploadProgress",
                                        cancelButtonId : "btnCancel"
                                },
                                debug: false,

                                // The event handler functions are defined in handlers.js
                                file_queued_handler : fileQueued,
                                file_queue_error_handler : fileQueueError,
                                file_dialog_complete_handler : fileDialogComplete,
                                upload_start_handler : uploadStart,
                                upload_progress_handler : uploadProgress,
                                upload_error_handler : uploadError,
                                upload_success_handler : uploadSuccess,
                                upload_complete_handler : uploadComplete,
                                queue_complete_handler : queueComplete  // Queue plugin event
                        };

                        swfu = new SWFUpload(settings);
             };
        </script>

<head>
  <meta content="text/html; charset=ISO-8859-1"
 http-equiv="content-type">
  <title>Kuvien_valinta</title>
</head>
<body>
<table style="text-align: left; width: 100%;" cellpadding="2"
 cellspacing="2">
  <tbody>
    <tr>
      <td style="height: 70px; width: 100px;"></td>
      <td
 style="text-align: center; background-color: rgb(0, 102, 0); color: rgb(153, 153, 0); height: 70px; width: 929px;"><big><big><big>Kuvagalleria
pulautin</big></big></big></td>
      <td style="height: 70px; width: 50px;">&nbsp;</td>
    </tr>
    <tr>
      <td style="height: 64px; width: 100px;"></td>
      <td style="height: 64px; width: 929px;">
      <table style="text-align: left; width: 100%;" border="1"
 cellpadding="2" cellspacing="2">
        <tbody>
          <tr>
            <td style="width: 160px;"><big>
1. Albumin nimi</big><br>
            <big
 style="font-style: italic; background-color: transparent; color: rgb(51, 204, 0);"><span
 style="font-weight: bold;">2. Kuvien valinta</span></big><br>
            <big>
3. Ulkoasun valinta
            </big></td>
            <td style="width: 491px;">
<div id="content">
        <form id="form1" action="kuvien_valinta.php" method="post" enctype="multipart/form-data">
                <fieldset class="flash" id="fsUploadProgress">
                        <legend>Ylöslataus-pötkö</legend>
                        </fieldset>
                <div id="divStatus">0 Tiedostoa ylösladattu</div>
                        <div>
                                <input type="button" value="Lataa filuja" onclick="swfu.selectFiles()" style="font-size: 8pt;" />
                                <input id="btnCancel" type="button" value="Peruuta kaikki ylöslataukset" onclick="swfu.cancelQueue();" disabled="disabled" style="font-size: 8pt;" />
                        </div>
 

        </form>

</div>
<form method="get" action="duunaa.php" name="duunaa">
<input name="duunaa" value="Viedääs kikkareet tsydeemiin..." type="submit">
</form><br><br>
HUOM! Mene eteenpäin vasta kun kuvat on uploadattu....

            </td>
            <td style="width: 200px;">
Tässä vaiheessa valitaan albumin kuvat.
            </td>
          </tr>
        </tbody>
      </table>
      </td>
      <td>
&nbsp;
      </td>
    </tr>
  </tbody>
</table>
<br>
</body>
</html>
