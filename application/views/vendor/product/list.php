<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Product List</h1>
    <span class="message"></span>
    <?php echo $this->session->flashdata('message'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Product</h6>
        </div>

        <div class="card-body">


            <div class="table-responsive">
                <form>
                    <input type="hidden" name="url" id="url" value="<?php echo base_url('vendor/product/index/'); ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="key_word" id="key_word" placeholder="Name/SKU" value="<?php if(!empty($keyWord)){ echo $keyWord; } ?>">
                        </div>
                        <div class="col-md-4">
                            <?php $statusTypes = getNormalStatus(); ?>
                            <select class="form-control" name="status" id="status">
                                <option value="all">All</option>
                                <?php foreach ($statusTypes AS $key => $value): ?>
                                    <option value="<?php echo $key; ?>" <?php if($status != 'all' && $status != ''){ if($key == $status){ echo 'selected'; } } ?>><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" name="filter_button" id="filter_button" class="btn btn-primary">Filter</button>
                            <a class="btn btn-secondary" href="<?php echo base_url('vendor/product/index/'); ?>">Reset</a>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Cost</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Cost</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($products AS $product): ?>
                            <tr id="row_<?php echo $product['product_id']; ?>">
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo getProductType($product['type']); ?></td>
                                <td><?php echo $product['cost']; ?></td>
                                <td><?php echo getNormalStatusName($product['status']); ?></td>
                                <td>
                                    <a href="<?php echo base_url('vendor/product/edit/' . encrypt($product['product_id'])); ?>" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="#" onclick="deleteRecord('product', <?php echo $product['product_id']; ?>)" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(empty($products)): ?>
                            <tr>
                                <td colspan="5">No result found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="text-center pull-right">
                    <ul class="pagination">
                        <?php echo $this->pagination->create_links(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->