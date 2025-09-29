@extends('layouts.app')
@section('title', 'Leads')
@section('content')

<div class="container mt-5">
    <h2 class="mb-4 text-center">Leads Analysis</h2>
    <div class="table-responsive shadow-sm rounded">
        <table id="leadsTable" class="table table-hover align-middle">
            <thead class="table table-striped">
                <tr>
                    <th>Company Name</th>
                    <th>Job Title</th>
                    <th>Website Analysis</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $lead)
                <tr>
                    <td class="fw-bold">{{ $lead->company_name }}</td>
                    <td>{{ $lead->job_title }}</td>
                    <td>{{ $lead->website_analysis }}</td>
                    <td>
                        @php
                            $colors = [
                                'High' => 'badge bg-success',
                                'Medium' => 'badge bg-warning text-dark',
                                'Low' => 'badge bg-danger',
                            ];
                            $colorClass = $colors[$lead->category] ?? 'badge bg-secondary';
                        @endphp
                        <span class="{{ $colorClass }}">
                            {{ $lead->category }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Include jQuery and DataTables CSS/JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#leadsTable').DataTable({
        "pageLength": 5,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "responsive": true
    });
});
</script>

@endsection
