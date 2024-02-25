@extends('partials.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $isEditMode ? 'Edit' : 'Tambah' }} Buku</h1>
</div>

<div class="row">
    <div class="col-lg-6">
        <form method="post" action="{{ $isEditMode ? '/buku/ubah/'.$books->id : '/buku/tambah' }}" enctype="multipart/form-data" onsubmit="return validateForm()">
            @csrf

            <div class="mb-3">
                <label for="kode_buku" class="form-label">Kode Buku</label>
                <input type="text" class="form-control" id="kode_buku" name="kode_buku" value="{{ $books->book_code }}" readonly>
            </div>
            <div class="mb-3">
                <label for="judul_buku" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="{{ $books->title }}">
            </div>
            <div class="mb-3 d-flex flex-column align-items-start" style="max-height: 200px; overflow-y: auto;">
                <label for="deskripsi_buku" class="form-label">Deskripsi Buku</label>
                <textarea class="form-control" id="deskripsi_buku" name="deskripsi_buku" style="height: 10rem;">{{ $books->sinopsis }}</textarea>
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="longtext" class="form-control" id="penulis" name="penulis" value="{{ $books->author }}">
            </div>
            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $books->publisher }}">
            </div>
            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" value="{{ $books->year }}">
            </div>

            <div class="mb-3">
                <label for="jenis_buku" class="form-label">Jenis Buku</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_buku" id="jenis_digital" value="1" onchange="handleRadioChange()" {{ $books->book_type == 1 ? 'checked' : '' }} {{ $isEditMode ? 'disabled' : '' }}>
                    <label class="form-check-label" for="jenis_digital">Digital</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_buku" id="jenis_fisik" value="2" onchange="handleRadioChange()" {{ $books->book_type == 2 ? 'checked' : '' }} {{ $isEditMode ? 'disabled' : '' }}>
                    <label class="form-check-label" for="jenis_fisik">Fisik</label>
                </div>
            </div>


            <div class="mb-3" id="filePdfSection" style="{{ $books->file_path ? 'display: block;' : 'display: none;' }}">
                <label for="file" class="form-label">Upload File PDF</label>
                <input type="file" class="form-control" id="file" name="file" onchange="previewFile()">
                <small id="fileHelp" class="form-text text-muted">Unggah file .pdf untuk E-Book</small>

                @if ($books->file_path)
                    <p id="filePdfLink">File PDF yang sudah diupload sebelumnya: <a href="{{ $books->file_path }}" target="_blank">{{ $books->file_path }}</a></p>
                @endif
            </div>

            <div class="mb-3" id="fileImageSection" style="{{ $books->cover_path ? 'display: block;' : 'display: none;' }}">
                <label for="fileImage" class="form-label">Upload Cover</label>
                <input type="file" class="form-control" id="fileImage" name="fileImage" onchange="previewImage()">
                <small id="imageHelp" class="form-text text-muted">Unggah file gambar untuk Buku Fisik</small>

                @if ($books->cover_path)
                    <p id="fileImagePreview">Gambar cover yang sudah diupload sebelumnya: </p><img src="{{ $books->cover_path }}" alt="Cover Image" style="height: 300px; width: 200;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="filePreview" class="form-label">Preview</label>
            <div id="filePreviewContainer"></div>
        </div>
    </div>
</div>

<script>
    let fileUploaded = false;
    let isEditMode = {{ $isEditMode ? 'true' : 'false' }};

    function validateForm() {
        const jenisDigitalChecked = document.getElementById('jenis_digital').checked;
        const fileInput = document.getElementById('file');
        const fileImageInput = document.getElementById('fileImage');



        if (jenisDigitalChecked && fileInput.files.length > 0 && fileInput.files[0].type !== 'application/pdf') {
            alert('Invalid file format. Please upload a PDF file for Digital.');
            clearFileInput();
            return false;
        }

        if (jenisDigitalChecked && fileImageInput.files.length > 0 && !fileImageInput.files[0].type.startsWith('image/')) {
            alert('Invalid file format. Please upload an image file for the cover.');
            clearFileInput();
            return false;
        }

        return true;
    }

    function previewFile() {
        const previewContainer = document.getElementById('filePreviewContainer');
        const fileInput = document.getElementById('file');

        previewContainer.innerHTML = '';

        if (fileInput.files.length > 0 && fileInput.files[0].type === 'application/pdf') {
            const pdfPreview = document.createElement('iframe');
            pdfPreview.src = URL.createObjectURL(fileInput.files[0]);
            pdfPreview.width = '100%';
            pdfPreview.height = '500px';
            previewContainer.appendChild(pdfPreview);
        }
    }

    function previewImage() {
        const previewContainer = document.getElementById('filePreviewContainer');
        const fileImageInput = document.getElementById('fileImage');

        previewContainer.innerHTML = '';

        if (fileImageInput.files.length > 0 && fileImageInput.files[0].type.startsWith('image/')) {
            const imgPreview = document.createElement('img');
            imgPreview.src = URL.createObjectURL(fileImageInput.files[0]);
            imgPreview.className = 'img-fluid';
            previewContainer.appendChild(imgPreview);
        }
    }

    function handleRadioChange() {
        const filePdfSection = document.getElementById('filePdfSection');
        const fileImageSection = document.getElementById('fileImageSection');
        const jenisDigitalChecked = document.getElementById('jenis_digital').checked;

        filePdfSection.style.display = jenisDigitalChecked ? 'block' : 'none';
        fileImageSection.style.display = jenisDigitalChecked ? 'none' : 'block';

        if (fileUploaded) {
            alert('File sudah diunggah, mohon ubah jenis buku dengan benar jika ingin mengunggah ulang');
            clearFileInput();
            return;
        }

        const fileInput = document.getElementById('file');
        const fileImageInput = document.getElementById('fileImage');
        const radioDigital = document.getElementById('jenis_digital');
        const radioFisik = document.getElementById('jenis_fisik');

        // Hanya nonaktifkan jika dalam mode edit
        if (isEditMode) {
            radioDigital.disabled = true;
            radioFisik.disabled = true;
        }

        if (fileInput.files.length > 0 || fileImageInput.files.length > 0) {
            const jenisFisikChecked = document.getElementById('jenis_fisik').checked;

            if (jenisFisikChecked) {
                radioDigital.disabled = true;
            } else {
                radioFisik.disabled = true;
            }
        }

        // Tambahkan kondisi untuk menampilkan file yang sudah diupload
        if (jenisDigitalChecked) {
            const filePdfLink = document.getElementById('filePdfLink');
            if (filePdfLink && filePdfLink.href) {
                filePdfLink.innerHTML = `File PDF yang sudah diupload sebelumnya: <a href="${filePdfLink.href}" target="_blank">${filePdfLink.href}</a>`;
            }
        } else {
            const fileImagePreview = document.getElementById('fileImagePreview');
            if (fileImagePreview && fileImagePreview.src) {
                fileImagePreview.src = fileImagePreview.src; // Memperbarui gambar agar terlihat
                fileImagePreview.alt = 'Cover Image';
                fileImagePreview.style.display = 'block';
            }
        }
    }

    function clearFileInput() {
        const fileInput = document.getElementById('file');
        const fileImageInput = document.getElementById('fileImage');
        const radioDigital = document.getElementById('jenis_digital');
        const radioFisik = document.getElementById('jenis_fisik');

        fileInput.value = '';
        fileImageInput.value = '';
        fileUploaded = false;
        radioDigital.disabled = false;
        radioFisik.disabled = false;

        const previewContainer = document.getElementById('filePreviewContainer');
        previewContainer.innerHTML = '';
    }
</script>

@endsection
