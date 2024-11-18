<?= $this->extend('layouts/base'); ?>
<?= $this->section('content') ?>

<!-- Full-Screen Layout -->
<div class="container-fluid vh-100 d-flex">
    <div class="row w-100">
        <!-- Sidebar -->
        <?= $this->include('partials/sidebar'); ?>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4 d-flex flex-column">
            <h2>Member Report</h2>

            <!-- Member Data Table -->
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users) && is_array($users)): ?>
                            <?php $count = 1; ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $count++; ?></td>
                                    <td><?= $user->username; ?></td>
                                    <td><?= $user->email; ?></td>
                                    <td><?= $user->role; ?></td>
                                    <td><?= $user->status; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No members found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>