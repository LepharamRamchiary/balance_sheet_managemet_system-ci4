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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Dummy data for testing
                        $members = [
                            ['id' => 1, 'name' => 'Alice Johnson', 'email' => 'alice@example.com', 'role' => 'member', 'status' => 'Active'],
                            ['id' => 2, 'name' => 'Bob Smith', 'email' => 'bob@example.com', 'role' => 'member', 'status' => 'Inactive'],
                            ['id' => 3, 'name' => 'Charlie Lee', 'email' => 'charlie@example.com', 'role' => 'admin', 'status' => 'Active'],
                            ['id' => 4, 'name' => 'Diana Prince', 'email' => 'diana@example.com', 'role' => 'member', 'status' => 'Active'],
                            ['id' => 5, 'name' => 'Evan Wright', 'email' => 'evan@example.com', 'role' => 'member', 'status' => 'Inactive'],
                        ];
                        ?>

                        <?php if (!empty($members) && is_array($members)): ?>
                            <?php foreach ($members as $member): ?>
                                <tr>
                                    <td><?= esc($member['id']); ?></td>
                                    <td><?= esc($member['name']); ?></td>
                                    <td><?= esc($member['email']); ?></td>
                                    <td><?= esc($member['role']); ?></td>
                                    <td><?= esc($member['status']); ?></td>
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
