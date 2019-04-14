<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Profile</h1>
    <?php echo $this->session->flashdata('message'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Personal information</h6>
        </div>
        <div class="card-body">
            <form id="change_password" action="<?php echo base_url('admin/profile/save'); ?>" method="POST" autocomplete="off">
                <div class="form-group">
                    <label for="email">Name:</label>
                    <input type="text" class="form-control" placeholder="Enter name" name="name" id="name" value="<?php if(set_value('name')){ echo set_value('name'); }elseif(isset($row['name'])){ echo $row['name']; } ?>">
                    <?php echo form_error('name'); ?>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" placeholder="Enter email" name="email" id="email" value="<?php if(set_value('email')){ echo set_value('email'); }elseif(isset($row['email'])){ echo $row['email']; } ?>">
                    <?php echo form_error('name'); ?>
                </div>
                <a href="#" class="btn btn-primary btn-icon-split" onclick="history.back();">
                    <span class="text">Cancel</span>
                </a>
                <button class="btn btn-success btn-icon-split" type="submit">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Save</span>
                </button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->