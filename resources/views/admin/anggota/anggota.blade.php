@extends('partials.main')

@section('container')

<div class="container-fluid" style="margin-top: 1.5rem;">
    <div>
        <a href="/anggota/tambah" class="btn btn-primary mb-3">Tambahkan Anggota Baru</a>
    </div>
    <h3 class="text-center" style="background-color: #55595c; color: #ffffff; height: 3rem; padding: 5px;">Daftar Anggota Perpustakaan SMA NU AL MA'RUF</h3>    
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">ID Anggota</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">No. Hp</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">keterangan</th>
                    <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                
                @foreach ($user as $users)

                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $users->id }}</td>
                        <td>{{ $users->username}}</td>
                        <td style="width: 10rem;">{{ $users->name}}</td>
                        <td style="width: 15rem;">{{ $users->address}}</td>
                        <td>{{ $users->phone}}</td>
                        <td class="text-center">{{ $users->status}}</td>              
                        <td>{{ $users->keterangan}}</td>              
                        <td class="text-center">
                            <div class="icon-container" style="justify-content: center;">
                                <a href="/anggota/active/{{ $users->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" enable-background="new 0 0 512 512" viewBox="0 0 512 512" id="right">
                                        <rect width="512" height="512" fill="#008000"/>
                                        <path fill="#ffffff" d="M193.6,435.3c-10.3,0-20.6-3.9-28.5-11.8L11.8,270.2c-15.7-15.7-15.7-41.2,0-56.9c15.7-15.7,41.2-15.7,56.9,0
                                            l124.9,124.9L443.3,88.4c15.7-15.7,41.2-15.7,56.9,0c15.7,15.7,15.7,41.2,0,56.9L222,423.5C214.2,431.3,203.9,435.3,193.6,435.3z"></path>
                                    </svg>
                                </a>

                                <a href="/anggota/inactive/{{ $users->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48" id="block">
                                        <rect width="48" height="48" fill="#ff8c00"/>
                                        <path fill="none" d="M0 0h48v48H0z"/>
                                        <path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zM8 24c0-8.84 7.16-16 16-16 3.7 0 7.09 1.27 9.8 3.37L11.37 33.8C9.27 31.09 8 27.7 8 24zm16 16c-3.7 0-7.09-1.27-9.8-3.37L36.63 14.2C38.73 16.91 40 20.3 40 24c0 8.84-7.16 16-16 16z" fill="#ffffff"/>
                                    </svg>
                                </a>

                                <a href="/anggota/ubah/{{ $users->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" id="edit">
                                        <rect width="24" height="24" fill="#005eff"/>
                                        <path fill="none" d="M0 0h24v24H0V0z"/>
                                        <path d="M3 17.46v3.04c0 .28.22.5.50.5h3.04c.13 0 .26-.05.35-.15L17.81 9.94l-3.75-3.75L3.15 17.10c-.10.10-.15.22-.15.36zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" fill="#ffffff"/>
                                    </svg>
                                </a>

                                <a href="/anggota/hapus/{{ $users->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 512 512" id="trash">
                                        <rect width="512" height="512" fill="#ff0000"/>    
                                        <path d="M413.7 133.4c-2.4-9-4-14-4-14-2.6-9.3-9.2-9.3-19-10.9l-53.1-6.7c-6.6-1.1-6.6-1.1-9.2-6.8-8.7-19.6-11.4-31-20.9-31h-103c-9.5 0-12.1 11.4-20.8 31.1-2.6 5.6-2.6 5.6-9.2 6.8l-53.2 6.7c-9.7 1.6-16.7 2.5-19.3 11.8 0 0-1.2 4.1-3.7 13-3.2 11.9-4.5 10.6 6.5 10.6h302.4c11 .1 9.8 1.3 6.5-10.6zM379.4 176H132.6c-16.6 0-17.4 2.2-16.4 14.7l18.7 242.6c1.6 12.3 2.8 14.8 17.5 14.8h207.2c14.7 0 15.9-2.5 17.5-14.8l18.7-242.6c1-12.6.2-14.7-16.4-14.7z" fill="#ffffff"></path>
                                    </svg>
                                </a>

                            </div>
                        </td>              
                    </tr>
                    
                @endforeach

                </tbody>
            </table>
        </div>
</div>

@endsection