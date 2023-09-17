<?= $this->extend('templates/main-admin') ?>
<?= $this->section('content') ?>
<div class="main-content">
  <div class="card shadow-lg">
    <div class="card-body">
        <div class="align-items-center justify-content-between m-b-30">
            <div class="row">
                <div class="mt-3 col-12">
                    <h5 class="text-center"><?=$pagetitle?></h5>
                    <p class="text-dark text-center">Please scan QR Code:</p>
                    <div class="alert alert-success" id="alert-success">
                      Attendance confirmation has been registered successfully.
                    </div>
                    <div class="alert alert-warning" id="alert-exists">
                      Attendance data already exists!
                    </div>
                    <div class="alert alert-danger" id="alert-invalid">
                      Invalid QR code!
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <select class="form-control" id="selcameras" onchange="change_camera()"></select>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-12">
                  <video id="preview" class="w-100"></video>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="modal fade bd-example-modal-lg" id="profile-modal">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Confirm Attendance</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body" id="profile-modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="save_attendance()" class="btn btn-danger">Confirm</button>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

    <script type="text/javascript">

      var option = '';
      var defaultcam = 0;
      var contentdata = '';

      $(document).ready(function () {
        $("#alert-success").hide();
        $("#alert-exists").hide();
        $("#alert-invalid").hide();
        $("#ul-two").addClass("open");
        $("#li-food-scanner").addClass("active");

        start_camera();
      });

      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        confirm_attendance(content);
        contentdata = content;
      });

      function confirm_attendance(content){
        $.post("<?=base_url('handa/confirm-attendance')?>",{
          data: content
        },function(data){
          if(data == "INVALID"){
            $("#alert-exists").hide();
            $("#alert-invalid").show().delay(3000).fadeOut();
          }else if(data == "EXISTS"){
            $("#alert-invalid").hide();
            $("#alert-exists").show().delay(3000).fadeOut();
          }else{
            $("#profile-modal-body").html(data);
            $("#profile-modal").modal("show");
          }
        });
      }

      function start_camera(){
        Instascan.Camera.getCameras().then(function (cameras) {
          // for (let i = 0; i < cameras.length; i++) {
          //   option+="<option value="+i+">"+cameras[i].name+"</option>";
          // }
          // $(selcameras).html(option);

          if (cameras.length > 0) {
            // scanner.start(cameras[defaultcam]);
            scanner.start(cameras[cameras.length-1]);

            scanner.mirror = false;
          } else {
            console.error('No cameras found.');
          }
        }).catch(function (e) {
          console.error(e);
        });
      }

      function save_attendance(){
        $.post("<?=base_url('handa/save-attendance')?>",{
          data: contentdata
        },function(data){
          console.log(data);
          if (data == "SUCCESS") {
            $("#profile-modal-body").html();
            $("#profile-modal").modal("hide");
            $("#alert-success").show().delay(3000).fadeOut();
          }
        });
      }

      // function change_camera(){

      //   var cameraorder = $("#selcameras").val();
      //   Instascan.Camera.getCameras().then(function (cameras) {
      //       scanner.start(cameras[cameraorder]);
      //       scanner.mirror = false;
      //     });
      // }



    </script>
<?= $this->endSection() ?>