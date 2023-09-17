<?= $this->extend('templates/main-admin') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <h4>Dashboard</h4>
        </div>
    </div>
</div>
                
    <script>
        $(document).ready(function () {
            $("#ul-four a").addClass("activex");
        });
    </script>
<?= $this->endSection() ?>
