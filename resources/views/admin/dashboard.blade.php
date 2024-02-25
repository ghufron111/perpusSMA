@extends('partials.main')

@section('container')

<div class="container-fluid">
    <div class="row">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <!-- Tambahkan input field untuk tahun -->
                    <input type="text" id="yearInput" class="btn btn-sm btn-outline-secondary" placeholder="Masukkan Tahun">
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateChart()">Perbarui Grafik</button>
                </div>
            </div>
        </div>

        <div class="container px-4 mx-auto">
            <div class="p-6 m-20">
                {!! $chart->container() !!}
            </div>
        </div>

        <script>
            function updateChart() {
                var year = document.getElementById('yearInput').value;
                window.location.href = '/dashboard?year=' + year;
            }
        </script>

        <script src="{{ $chart->cdn() }}"></script>
        {{ $chart->script() }}
    </div>
</div>

@endsection
