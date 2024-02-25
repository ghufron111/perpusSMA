@extends('partials.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Buku</h1>
</div>

<div class="row">
    <div class="col-lg-6">
        <form method="post" action="/buku/tambah" enctype="multipart/form-data" onsubmit="return validateForm()">
            @csrf

            <div class="mb-3">
                <label for="kode_buku" class="form-label">Kode Buku</label>
                <input type="text" class="form-control" id="kode_buku" name="kode_buku">
            </div>
            <div class="mb-3">
                <label for="judul_buku" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="judul_buku" name="judul_buku">
            </div>
            <div class="mb-3 d-flex flex-column align-items-start" style="max-height: 200px; overflow-y: auto;">
                <label for="deskripsi_buku" class="form-label">Deskripsi Buku</label>
                <textarea class="form-control" id="deskripsi_buku" name="deskripsi_buku" style="height: 10rem;"></textarea>
            </div>

            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="longtext" class="form-control" id="penulis" name="penulis">
            </div>
            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit">
            </div>
            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit">
            </div>

            <div class="mb-3">
                <label for="model_buku" class="form-label">Model Buku</label>
                <select class="form-select" id="model_buku" name="model_buku">
                    <option value="" disabled selected>Pilih Model Buku</option>
                    <option value="Novel">Novel</option>
                    <option value="Majalah">Majalah</option>
                    <option value="Paket">Paket</option>
                </select>
            </div>


            <div class="mb-3">
                <label for="jenis_buku" class="form-label">Jenis Buku</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_buku" id="jenis_digital" value="1" onchange="handleRadioChange()">
                    <label class="form-check-label" for="jenis_digital">Digital</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_buku" id="jenis_fisik" value="2" onchange="handleRadioChange()">
                    <label class="form-check-label" for="jenis_fisik">Fisik</label>
                </div>
            </div>

            <div class="mb-3" id="filePdfSection" style="display: none;">
                <label for="file" class="form-label">Upload File PDF</label>
                <input type="file" class="form-control" id="file" name="file" onchange="previewFile()">
                <small id="fileHelp" class="form-text text-muted">Unggah file .pdf untuk E-Book</small>
            </div>

            <div class="mb-3" id="fileImageSection" style="display: none;">
                <label for="fileImage" class="form-label">Upload Cover</label>
                <input type="file" class="form-control" id="fileImage" name="fileImage" onchange="previewImage()">
                <small id="imageHelp" class="form-text text-muted">Unggah file gambar untuk Buku Fisik</small>
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

    function validateForm() {
        const jenisDigitalChecked = document.getElementById('jenis_digital').checked;
        const fileInput = document.getElementById('file');
        const fileImageInput = document.getElementById('fileImage');

        if (jenisDigitalChecked && fileInput.files.length === 0 && fileImageInput.files.length === 0) {
            alert('Please select at least one file for Digital.');
            return false;
        }

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
            imgPreview.style.maxHeight = '500px';
            previewContainer.appendChild(imgPreview);
        }
    }

    function handleRadioChange() {
        const filePdfSection = document.getElementById('filePdfSection');
        const fileImageSection = document.getElementById('fileImageSection');
        const jenisDigitalChecked = document.getElementById('jenis_digital').checked;

        filePdfSection.style.display = jenisDigitalChecked ? 'block' : 'none';
        fileImageSection.style.display = jenisDigitalChecked ? 'block' : 'block';

        if (fileUploaded) {
            alert('File sudah diunggah, mohon ubah jenis buku dengan benar jika ingin mengunggah ulang');
            clearFileInput();
            return;
        }

        const fileInput = document.getElementById('file');
        const fileImageInput = document.getElementById('fileImage');
        const radioDigital = document.getElementById('jenis_digital');
        const radioFisik = document.getElementById('jenis_fisik');

        if (fileInput.files.length > 0 || fileImageInput.files.length > 0) {
            radioDigital.disabled = true;
            radioFisik.disabled = true;
        } else {
            radioDigital.disabled = false;
            radioFisik.disabled = false;
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
