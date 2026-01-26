<?php include("../includes/header.php"); ?>

<div class="container mt-5">
    <h2 class="mb-4">View Reports</h2>

    <!-- Filter Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Filter Reports</h5>
            <form id="reportFilterForm">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="reportType" class="form-label">Report Type</label>
                        <select class="form-select" id="reportType">
                            <option value="all" selected>All Reports</option>
                            <option value="sales">Sales Report</option>
                            <option value="users">User Activity</option>
                            <option value="system">System Performance</option>
                            <option value="financial">Financial Summary</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="dateRange" class="form-label">Date Range</label>
                        <select class="form-select" id="dateRange">
                            <option value="today">Today</option>
                            <option value="week" selected>This Week</option>
                            <option value="month">This Month</option>
                            <option value="quarter">This Quarter</option>
                            <option value="year">This Year</option>
                            <option value="custom">Custom Range</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status">
                            <option value="all" selected>All Status</option>
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Reports Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Generated Reports</h5>
            <div>
                <button class="btn btn-success btn-sm me-2" id="generateReportBtn">
                    <i class="fas fa-plus"></i> Generate New Report
                </button>
                <button class="btn btn-outline-secondary btn-sm" id="exportBtn">
                    <i class="fas fa-download"></i> Export
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="form-check-input" id="selectAll">
                            </th>
                            <th>Report Name</th>
                            <th>Type</th>
                            <th>Generated On</th>
                            <th>Period</th>
                            <th>Status</th>
                            <th>Size</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" class="form-check-input"></td>
                            <td>Q3 2024 Sales Report</td>
                            <td><span class="badge bg-primary">Sales</span></td>
                            <td>Oct 15, 2024</td>
                            <td>Jul - Sep 2024</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>2.4 MB</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-download"></i></button>
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="form-check-input"></td>
                            <td>User Activity - October</td>
                            <td><span class="badge bg-info">User Activity</span></td>
                            <td>Nov 2, 2024</td>
                            <td>Oct 2024</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>1.8 MB</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-download"></i></button>
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="form-check-input"></td>
                            <td>System Performance Q4</td>
                            <td><span class="badge bg-warning">System</span></td>
                            <td>Dec 1, 2024</td>
                            <td>Oct - Dec 2024</td>
                            <td><span class="badge bg-secondary">Pending</span></td>
                            <td>Processing</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" disabled><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-outline-secondary" disabled><i class="fas fa-download"></i></button>
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <nav aria-label="Report pagination">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Reports</h5>
                    <h2 class="card-text">24</h2>
                    <p class="card-text"><small>This month: 3</small></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Completed</h5>
                    <h2 class="card-text">18</h2>
                    <p class="card-text"><small>75% success rate</small></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Pending</h5>
                    <h2 class="card-text">4</h2>
                    <p class="card-text"><small>Avg. processing: 2h</small></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Total Size</h5>
                    <h2 class="card-text">48.2 MB</h2>
                    <p class="card-text"><small>Avg. size: 2 MB</small></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for interactivity -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all checkbox functionality
    document.getElementById('selectAll').addEventListener('change', function(e) {
        const checkboxes = document.querySelectorAll('tbody .form-check-input');
        checkboxes.forEach(checkbox => {
            checkbox.checked = e.target.checked;
        });
    });

    // Filter form submission
    document.getElementById('reportFilterForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Here you would typically make an AJAX request to filter reports
        alert('Filters applied! This would typically refresh the report list.');
    });

    // Generate report button
    document.getElementById('generateReportBtn').addEventListener('click', function() {
        // Here you would typically show a modal or redirect to report generation
        alert('Redirecting to report generation wizard...');
    });

    // Export functionality
    document.getElementById('exportBtn').addEventListener('click', function() {
        const selectedReports = Array.from(document.querySelectorAll('tbody .form-check-input:checked'))
            .map(cb => cb.closest('tr').querySelector('td:nth-child(2)').textContent);
        
        if (selectedReports.length === 0) {
            alert('Please select at least one report to export.');
            return;
        }
        
        // Here you would typically trigger an export/download
        alert(`Exporting selected reports: ${selectedReports.join(', ')}`);
    });
});
</script>

<style>
.table th {
    font-weight: 600;
    border-top: none;
}
.badge {
    font-size: 0.75em;
    padding: 0.4em 0.8em;
}
.card {
    border: none;
}
.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}
</style>

<?php include("../includes/footer.php"); ?>