<body onLoad="window.print()">
   <div class="page">
      <div class="page-potrait">
         <div class="nobreak">
               <table width="100%">           
                  <tr>
                     <td style="width: 10%; vertical-align: middle;"><img src="/assets/images/logo_nu.png" alt="logo" style="padding-left: 100px; height: 150px; width: 150px;"/></td>
                     <td align="center" style="vertical-align: middle; padding-left: 0;">
                           <h7>BADAN PELAKSANA PENYELENGGARAAN PENDIDIKAN MA'ARIF NU<br />SUNAN DJA'FAR SHADIQ</h7><br />
                           <h7 style="font-weight: bold; font-size:1.3rem;">SMA NU AL MA'RUF KUDUS</h7><br />
                           <h7>TERAKREDITASI A</h7><br />
                           <h7>NPSN : 20317487 • NIS : 300140 • NDS : C10024001 • NSS : 302031902006</h7><br />
                           <h7>Laman : www.smanualmaruf.sch.id Surel : smanualmarufkds@gmail.com</h7>
                     </td>
                  </tr>            
               </table>
               <table width="100%" style="border-top: 2px solid black; border-bottom: 2px solid black;">
                  <td align="center"><h7>Alamat : Jalan AKBP. R. Agil Kusumadya No. 2 Telp. (0291) 438939 / Fax. (0291) 438939 Kudus, Kode Pos 59348</h7></td>
               </table> <br />

            
               <table class="custom-table" width="100%">
                  <thead>
                     <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">ID Pinjam</th>
                        <th class="text-center">Nama Peminjam</th>
                        <th class="text-center">Buku Yang Dipinjam</th>
                        <th class="text-center">Tanggal Peminjaman</th>
                        <th class="text-center">Lama Peminjaman</th>
                        <th class="text-center">Tanggal Pengembalian</th>
                     </tr>
                  </thead>
                  <tbody>
                  @foreach ($rents as $index => $rent)
                     <tr class="table-row">
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td style="width: 5rem;">{{ $rent->rent_logs_id }}</td>
                        <td style="width: 15rem;">{{ $rent->user->name }}</td>
                        <td style="width: 20rem;">{{ $rent->book->title }}</td>
                        <td class="text-center">{{ $rent->rent_date }}</td>
                        <td class="text-center">{{ $rent->return_date }}</td>
                        <td class="text-center">{{ $rent->actual_return_date }}</td>
                     </tr>
                  @endforeach
                  </tbody>
               </table> <br /> <br /> <br />
               
               <table class="bottom-table" cellpadding="2" cellspacing="0">
               <tr> 
                  <td align="center" width="29%">Mengetahui,</td>
                  <td width="6%">&nbsp;</td>

                  <td width="2%">&nbsp;</td>
                  <td align="center" width="28%">Kudus, {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}</td>
			      </tr>
               <tr> 
                  <td align="center">Kepala SMA NU Al Ma'ruf Kudus</td>
                  <td width="6%">&nbsp;</td>

				      <td width="2%">&nbsp;</td>
                  <td align="center" width="28%">Petugas Perpustakaan</td>
               </tr>
               <tr> 
                  <td align="center">&nbsp;</td>
                  <td width="6%">&nbsp;</td>

				      <td width="2%">&nbsp;</td>
                  <td width="28%">&nbsp;</td>
               </tr>
               <tr> 
                  <td colspan="5" height="70"></td>
               </tr>
               <tr>
                  <td style="font-weight: bold;" align="center">Anas Ma'ruf, S.Ag., M.Pd.I.</td>
                  <td width="6%">&nbsp;</td>

				      <td width="2%">&nbsp;</td>
                  <td align="center" width="28%" align="left">Mien Afrida</td>
               </tr>
            </table>
         </div>
      </div>
   </div>

   <style>
      /* Tabel */
      .custom-table {
         border-collapse: collapse;
         width: 100%;
      }

      /* Sel */
      .custom-table td, .custom-table th {
         border: 1px solid #000000;
         text-align: left;
         padding: 8px;
      }

      /* Baris */
      .custom-table tr:nth-child(even) {
         background-color: #f2f2f2;
      }

      .custom-table .table-row {
         height: 50px;
      }

      .custom-table .table-row .text-center {
         text-align: center;
      }
      
      .custom-table th {
         text-align: center;
      }

      .bottom-table {
         margin-left: 40%;
         bottom: 0;
         width: 60%; /* Sesuaikan lebar tabel sesuai kebutuhan */
         /* Tambahkan properti lain sesuai kebutuhan */
      }
   </style>