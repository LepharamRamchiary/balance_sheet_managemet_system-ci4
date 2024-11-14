<?= $this->extend('layouts/base'); ?>
<?= $this->section('content') ?>

<!-- Login Form -->
<div class="container-fluid vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100">
        <div class="col-md-6 col-lg-4 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="text-center mb-4">Login</h2>

                    <?php if (isset($validation)): ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Form -->
                    <?php echo form_open(); ?>
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= set_value('email') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-primary btn-block" name="login" value="Login">
                    </div>
                    <?php echo form_close(); ?>

                    <p class="text-center mt-3">Don't have an account? <a href="<?= base_url() ?>register">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>