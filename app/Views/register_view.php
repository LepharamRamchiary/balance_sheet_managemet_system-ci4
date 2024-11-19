<?= $this->extend('layouts/base'); ?>
<?= $this->section('content') ?>



<!-- Register Form -->
<div class="container-fluid vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100">
        <div class="col-md-6 col-lg-4 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">

                    <!-- Display Success Message -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div id="success-alert" class="alert alert-success">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Display Error Message -->
                    <?php if (session()->getFlashdata('error')): ?>
                        <div id="error-alert" class="alert alert-danger">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <h2 class="text-center mb-4">Register</h2>

                    <?php if (isset($validation)): ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors(); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Form -->
                    <?php echo form_open(); ?>
                    <div class="mb-3">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?= set_value('username') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= set_value('email') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="conf_password">Confirm Password</label>
                        <input type="password" class="form-control" name="conf_password" id="conf_password" required>
                    </div>

                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-primary btn-block" value="Register" name="register">
                    </div>
                    <?php echo form_close(); ?>

                    <p class="text-center mt-3">Already have an account? <a href="<?= base_url() ?>loginboth">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        const successAlert = document.getElementById('success-alert');
        const errorAlert = document.getElementById('error-alert');
        if (successAlert) successAlert.style.display = 'none';
        if (errorAlert) errorAlert.style.display = 'none';
    }, 3000);
</script>

<?= $this->endSection() ?>