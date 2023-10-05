<?= $this->extend('templates/main-admin') ?>
<?= $this->section('content') ?>
<div class="main-content">
   <div class="page-header">
      <h2 class="header-title">User Links List</h2>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header border-bottom">
                  <h4 class="card-title">Participants Database</h4>
               </div>
               <div class="card-body p-0">
                  <ul class="list-group list-group-flush">
                     <li class="list-group-item">
                        <div class="d-flex align-items-center">
                           <div class="m-l-10">
                              <div class="mb-2 text-dark font-weight-semibold"><a href="<?=base_url('participants?event='.$_SESSION['eventaccess'])?>">Participants List</a></div>
                              <div class="mb-2 text-dark font-weight-semibold"><a href="<?=base_url('attendance?event='.$_SESSION['eventaccess'])?>">Attendance List</a></div>
                              <div class="mb-2 text-dark font-weight-semibold"><a href="<?=base_url('evaluation/participants?event='.$_SESSION['eventaccess'])?>">Participants' Evaluation List</a></div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="card">
               <div class="card-header border-bottom">
                  <h4 class="card-title">Registration</h4>
               </div>
               <div class="card-body p-0">
                  <ul class="list-group list-group-flush">
                     <li class="list-group-item">
                        <div class="d-flex align-items-center">
                           <div class="m-l-10">
                              <div class="mb-4">
                                 <div class="mb-2 text-dark font-weight-semibold">Pre-registration</div>
                                 <div class="ml-3 mb-2 text-dark"><a class="btn btn-default btn-sm btn-tone btn-primary" href="<?=base_url('registration/event/'.$_SESSION["eventaccess"]); ?>">Link</a></div>
                                 <div class="ml-3 mb-2 text-dark"><a class="btn btn-default btn-sm btn-tone btn-primary" target="_blank" href="<?=base_url('assets/images/programs/'.$_SESSION["eventaccess"].'.png'); ?>">Download QR Code</a></div>
                              </div>
                              <div class="mb-4">
                                 <div class="mb-2 text-dark font-weight-semibold">Walk-in</div>
                                 <div class="ml-3 mb-2 text-dark"><a class="btn btn-default btn-sm btn-tone btn-primary" href="<?=base_url('w-registration/event/'.$_SESSION["eventaccess"]); ?>">Link</a></div>
                              </div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="card">
               <div class="card-header border-bottom">
                  <h4 class="card-title">Attendance</h4>
               </div>
               <div class="card-body p-0">
                  <ul class="list-group list-group-flush">
                     <li class="list-group-item">
                        <div class="d-flex align-items-center">
                           <div class="m-l-10">
                              <div class="mb-4">
                                 <div class="mb-2 text-dark font-weight-semibold"><a href="<?=base_url('attendance/m-scan-qr')?>">QR Scanner</a></div>
                                 <div class="mb-2 text-dark font-weight-semibold"><a href="<?=base_url('attendance/search-user')?>">Search by User</a></div>
                              </div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="card">
               <div class="card-header border-bottom">
                  <h4 class="card-title">Evaluation</h4>
               </div>
               <div class="card-body p-0">
                  <ul class="list-group list-group-flush">
                     <li class="list-group-item">
                        <div class="d-flex align-items-center">
                           <div class="m-l-10">
                              <div class="mb-4">
                                 <div class="mb-2 text-dark"><a class="btn btn-default btn-sm btn-tone btn-primary" href="<?=base_url('evaluation?event='.$event["evallink"]); ?>">Link</a></div>
                                 <div class="mb-2 text-dark"><a class="btn btn-default btn-sm btn-tone btn-primary" target="_blank" href="<?=base_url('assets/images/evaluation/'.$_SESSION["eventaccess"].'.png'); ?>">Download QR Code</a></div>
                              </div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection() ?>