@extends('front-end.layouts.main')
@section('container')
<div class="container">
    <div class="row" style="margin-top:50px">
        <div class="col-sm-6 col-sm-offset-3">
            <h2 class="module-title font-alt"> STRUKTUR KURIKULUM <br> MAN 2 KOTA TASIKMALAYA <br>TAHUN PELAJARAN {{
                tahun_aktif() }}</h2>
        </div>
        <div class="col-sm-12">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h2>Kelas X</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-bordered" style="border-radius: 5px">
                    <thead class="bg-dark">
                        <tr>
                            <th>Komponen</th>
                            <th>Pertahun Reguler</th>
                            <th>Pertahun Proyek PPPP</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light">
                        <tr>
                            <td>Kelompok Mata Pelajaran Umum:</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;1. Pendidikan Agama Islam:</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;a. Al Qur’an Hadis</td>
                            <td>72 (2)</td>
                            <td>36 (1)</td>
                            <td>108 (3)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;b. Akidah Akhlak</td>
                            <td>72 (2)</td>
                            <td>36 (1)</td>
                            <td>108 (3)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;c. Fikih</td>
                            <td>72 (2)</td>
                            <td>36 (1)</td>
                            <td>108 (3)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;d. Sejarah Kebudayaan Islam</td>
                            <td>72 (2)</td>
                            <td>36 (1)</td>
                            <td>108 (3)</td>
                        </tr>
                        <tr>
                            <td>2. Bahasa Arab</td>
                            <td>144 (4)</td>
                            <td>36 (1)</td>
                            <td>162 (5)</td>
                        </tr>
                        <tr>
                            <td>3. Pendidikan Pancasila</td>
                            <td>54 (2)</td>
                            <td>18 (0,5)</td>
                            <td>72 (2,5)</td>
                        </tr>
                        <tr>
                            <td>4. Bahasa Indonesia</td>
                            <td>108 (3)</td>
                            <td>36 (1)</td>
                            <td>144 (4)</td>
                        </tr>
                        <tr>
                            <td>5. Matematika</td>
                            <td>108 (3)</td>
                            <td>36 (1)</td>
                            <td>144 (4)</td>
                        </tr>
                        <tr>
                            <td>6. Ilmu Pengetahuan Alam:</td>
                            <td>216 (6)</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;a. Fisika</td>
                            <td>72 (2)</td>
                            <td>36 (1)</td>
                            <td>108 (3)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;b. Kimia</td>
                            <td>72 (2)</td>
                            <td>36 (1)</td>
                            <td>108 (3)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;c. Biologi</td>
                            <td>72 (2)</td>
                            <td>36 (1)</td>
                            <td>108 (3)</td>
                        </tr>
                        <tr>
                            <td>7. Ilmu Pengetahuan Sosial:</td>
                            <td>288 (8)</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;a. Sosiologi</td>
                            <td>72 (2)</td>
                            <td>36 (1)</td>
                            <td>108 (3)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;b. Ekonomi</td>
                            <td>72 (2)</td>
                            <td>36 (1)</td>
                            <td>108 (3)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;c. Sejarah</td>
                            <td>72 (2)</td>
                            <td>36 (1)</td>
                            <td>108 (3)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;d. Geografi</td>
                            <td>72 (2)</td>
                            <td>36 (1)</td>
                            <td>108 (3)</td>
                        </tr>
                        <tr>
                            <td>3. Bahasa Inggris</td>
                            <td>54 (2)</td>
                            <td>18 (0,5)</td>
                            <td>72 (2,5)</td>
                        </tr>
                        <tr>
                            <td>4. Penjasorkes</td>
                            <td>72 (2)</td>
                            <td>36 (1)</td>
                            <td>108 (3)</td>
                        </tr>
                        <tr>
                            <td>5. Informatika</td>
                            <td>72 (2)</td>
                            <td>36 (1)</td>
                            <td>108 (3)</td>
                        </tr>
                        <tr>
                            <td>6. Seni dan Prakarya</td>
                            <td>54 (2)</td>
                            <td>18 (0,5)</td>
                            <td>72 (2,5)</td>
                        </tr>
                        <tr>
                            <td>7. Bahasa Sunda</td>
                            <td>72 (2)</td>
                            <td></td>
                            <td>72 (2)</td>
                        </tr>
                        <tr>
                            <td>E. Pengembangan Diri:</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;1. Olah Raga</td>
                            <td rowspan="13" colspan="3">2*)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- BKC</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Footsal</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Bola Voly</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Bulutangkis</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;2. Teater</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;3. Nasyid/Paduan Suara</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;4. KIR</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;5. PMR</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;6. Pramuka</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;7. Paskibra</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;8. Polsis</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;9. English club</td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>1530 (2)</td>
                            <td>630 (1)</td>
                            <td>2160 (3)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12">
            <h2>Kelas XI Ilmu Pengetahuan Alam</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-bordered" style="border-radius: 5px">
                    <thead class="bg-dark">
                        <tr>
                            <th>Komponen</th>
                            <th>Alokasi Waktu Semester 1</th>
                            <th>Alokasi Waktu Semester 2</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light">
                        <tr>
                            <td>A. Kelompok A (Wajib)</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;1. Pendidikan Agama</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;a. Al- Qur’an Hadist</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;b. Fikih</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;c. Aqidah Akhlak</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;d. Sejarah Kebudayaan Islam</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>2. Pendidikan Kewarganegaraan</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>3. Bahasa Indonesia</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>4. Bahasa Arab</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>5. Matematika</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>6. Sejarah Indonesia</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>7. Bahasa Inggris</td>
                            <td>3</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>B. Kelompok B (Wajib)</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>8. Seni Budaya</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>9. Penjasorkes</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>10. Prakarya dan Kewirausahaan</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>11. Bahasa Sunda</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>C. Kelompok C (Peminatan)</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>12. Matematika</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>13. Biologi</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>14. Fisika</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>15. Kimia</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>D. Lintas Minat</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>16. Tehnik Informatika</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>E. Pengembangan Diri</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;1. Olah Raga</td>
                            <td rowspan="14">2*)</td>
                            <td rowspan="14">2*)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- BKC</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Footsal</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Pencak Silat</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Bola Voly</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Badminton</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;2. Theater</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;3. Nasyid/Paduan Suara</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;4. KIR</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;5. PMR</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;6. Pramuka</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;7. Paskibra</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;8. Polsis</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;9. English club</td>
                        </tr>
                        <tr>
                            <td>Bimbingan Konseling/Bimbingan TIK</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>53</td>
                            <td>53</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12">
            <h2>Kelas XI Ilmu Pengetahuan Sosial</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-bordered" style="border-radius: 5px">
                    <thead class="bg-dark">
                        <tr>
                            <th>Komponen</th>
                            <th>Alokasi Waktu Semester 1</th>
                            <th>Alokasi Waktu Semester 2</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light">
                        <tr>
                            <td>A. Kelompok A (Wajib)</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;1. Pendidikan Agama</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;a. Al- Qur’an Hadist</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;b. Fikih</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;c. Aqidah Akhlak</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;d. Sejarah Kebudayaan Islam</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>2. Pendidikan Kewarganegaraan</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>3. Bahasa Indonesia</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>4. Bahasa Arab</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>5. Matematika</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>6. Sejarah Indonesia</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>7. Bahasa Inggris</td>
                            <td>3</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>B. Kelompok B (Wajib)</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>8. Seni Budaya</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>9. Penjasorkes</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>10. Prakarya dan Kewirausahaan</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>11. Bahasa Sunda</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>C. Kelompok C (Peminatan)</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>12. Geografi</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>13. Sejarah</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>14. Sosiologi</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>15. Ekonomi</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>D. Kelompok Lintas Minat</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>16. Tehnik Informatika</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>E. Pengembangan Diri</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;1. Olah Raga</td>
                            <td rowspan="14">2*)</td>
                            <td rowspan="14">2*)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- BKC</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Footsal</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Pencak Silat</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Bola Voly</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Badminton</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;2. Theater</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;3. Nasyid/Paduan Suara</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;4. KIR</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;5. PMR</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;6. Pramuka</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;7. Paskibra</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;8. Polsis</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;9. English club</td>
                        <tr>
                            <td>Bimbingan Konseling/Bimbingan TIK</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>53</td>
                            <td>53</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12">
            <h2>Kelas XII Ilmu Pengetahuan Alam</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-bordered" style="border-radius: 5px">
                    <thead class="bg-dark">
                        <tr>
                            <th>Komponen</th>
                            <th>Alokasi Waktu Semester 1</th>
                            <th>Alokasi Waktu Semester 2</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light">
                        <tr>
                            <td>A. Kelompok A (Wajib)</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;1. Pendidikan Agama</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;a. Al- Qur’an Hadist</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;b. Fikih</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;c. Aqidah Akhlak</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;d. Sejarah Kebudayaan Islam</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>2. Pendidikan Kewarganegaraan</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>3. Bahasa Indonesia</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>4. Bahasa Arab</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>5. Matematika</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>6. Sejarah Indonesia</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>7. Bahasa Inggris</td>
                            <td>3</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>B. Kelompok B (Wajib)</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>8. Seni Budaya</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>9. Penjasorkes</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>10. Prakarya dan Kewirausahaan</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>11. Bahasa Sunda</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>C. Kelompok C (Peminatan)</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>12. Matematika</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>13. Biologi</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>14. Fisika</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>15. Kimia</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>D. Lintas Minat</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>16. Tehnik Informatika</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>E. Pengembangan Diri</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;1. Olah Raga</td>
                            <td rowspan="14">2*)</td>
                            <td rowspan="14">2*)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- BKC</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Footsal</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Pencak Silat</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Bola Voly</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Badminton</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;2. Theater</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;3. Nasyid/Paduan Suara</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;4. KIR</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;5. PMR</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;6. Pramuka</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;7. Paskibra</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;8. Polsis</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;9. English club</td>
                        </tr>
                        <tr>
                            <td>Bimbingan Konseling/TIK</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>53</td>
                            <td>53</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-12">
            <h2>Kelas XII Ilmu Pengetahuan Sosial</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-bordered" style="border-radius: 5px">
                    <thead class="bg-dark">
                        <tr>
                            <th>Komponen</th>
                            <th>Alokasi Waktu Semester 1</th>
                            <th>Alokasi Waktu Semester 2</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light">
                        <tr>
                            <td>A. Kelompok A (Wajib)</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;1. Pendidikan Agama</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;a. Al- Qur’an Hadist</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;b. Fikih</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;c. Aqidah Akhlak</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;d. Sejarah Kebudayaan Islam</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>2. Pendidikan Kewarganegaraan</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>3. Bahasa Indonesia</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>4. Bahasa Arab</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>5. Matematika</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>6. Sejarah Indonesia</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>7. Bahasa Inggris</td>
                            <td>3</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>B. Kelompok B (Wajib)</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>8. Seni Budaya</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>9. Penjasorkes</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>10. Prakarya dan Kewirausahaan</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>11. Bahasa Sunda</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>C. Kelompok C (Peminatan)</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>12. Geografi</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>13. Sejarah</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>14. Sosiologi</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>15. Ekonomi</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>D. Kelompok Lintas Minat</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>16. Tehnik Informatika</td>
                            <td>4</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>E. Pengembangan Diri</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;1. Olah Raga</td>
                            <td rowspan="14">2*)</td>
                            <td rowspan="14">2*)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- BKC</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Footsal</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Pencak Silat</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Bola Voly</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;- Badminton</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;2. Theater</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;3. Nasyid/Paduan Suara</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;4. KIR</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;5. PMR</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;6. Pramuka</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;7. Paskibra</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;8. Polsis</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;9. English club</td>
                        </tr>
                        <tr>
                            <td>Bimbingan Konseling/TIK</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>53</td>
                            <td>53</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
