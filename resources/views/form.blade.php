{{-- <!DOCTYPE html>
<html>

<head>
    <title>Client Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Client Project Entry</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('form.submit') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3 w-25">
                <label for="date" class="form-label">Date</label>
                <input type="text" id="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
            </div>

            <div class="mb-3 w-25">
                <label for="project_name" class="form-label">Project Name</label>
                <input type="text" id="project_name" name="project_name" class="form-control" required>

            <div class="mb-3 w-25">
                <label for="client" class="form-label">Client Name</label>
                <input type="text" id="client" name="client" class="form-control">
            </div>

            <div class="mb-3 w-25">
                <label for="number" class="form-label">WhatsApp Number</label>
                <input type="text" id="number" name="number" class="form-control mb-2" placeholder="8801XXXXXXXXX">
                <a id="whatsapp-link" href="#" target="_blank" class="btn btn-success">Send via WhatsApp</a>
            </div>

            <div class="mb-3 w-25">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-control mb-2" placeholder="Enter email address">
                <a href="https://mail.google.com" target="_blank" class="btn btn-danger">Send via Gmail</a>
            </div>

            <div class="mb-3 w-50">
                <label for="company_address" class="form-label">Company Address</label>
                <input type="text" id="company_address" name="company_address" class="form-control">
            </div>
            <div class="mb-3 w-50">
                <label for="client_requirement_text" class="form-label">Client Requirement (Text)</label>
                <textarea id="client_requirement_text" name="client_requirement_text" class="form-control"></textarea>
            </div>

            <div class="mb-3 w-50">
                <label for="client_requirement_file" class="form-label">Client Requirement (File)</label>
                <input type="file" id="client_requirement_file" name="client_requirement_file" class="form-control" accept=".pdf,.doc,.docx">
            </div>

            <div class="mb-3 w-50">
                <label>Project Details</label>
                <textarea name="details" class="form-control"></textarea>
            </div>

            <div class="mb-3 w-25">
                <label>Upload Proposal (PDF/DOC/DOCX)</label>
                <input type="file" name="proposal[]" class="form-control" accept=".pdf,.doc,.docx" multiple>
            </div>


            <div class="mb-3 w-25">
                <label>Project Budget (BDT)</label>
                <input type="number" name="budget" class="form-control" step="0.01">
            </div>

            <div class="mb-3 w-25">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option value="processing">processing</option>
                    <option value="pipeline">pipeline</option>
                    <option value="confrom">confrom</option>
                    <option value="cancel">cancel</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit Full Project</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#date", { dateFormat: "Y-m-d" });

        document.getElementById('number').addEventListener('input', function () {
            let number = this.value.replace(/[^0-9]/g, '');
            document.getElementById('whatsapp-link').href = `https://wa.me/${number}`;
        });
    </script>
</body>
</html> --}}


