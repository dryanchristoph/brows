@include('includes/head')
@include('includes/menu')

<div class="page-content">
    <div class="holder mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><span>FAQ</span></li>
            </ul>
        </div>
    </div>
    <div class="holder mt-0 global-width">
        <div class="container">
            <div class="simple-filter js-simple-filter">
                <div class="text-center">
                    <h2 class="h1-style">FAQ</h2>
                    <div class="simple-filter-tabs js-simple-filters-tabs"><span class="js-simple-filter-label" data-filter=".category1">GENERAL QUESTIONS</span></div>
                </div>
                <div class="faq-wrapper simple-filter-wrap">
                    <div class="faq-item js-simple-filter-item category1">
                        <div class="panel">
                            <div class="panel-heading"><a data-toggle="collapse" href="#faq1" class="collapsed">
                                    <div class="panel-title">Apa itu <b>BROWS?</b></div>
                                </a></div>
                            <div id="faq1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p><b>BROWS</b> adalah sebuah marketplace sewa-menywa, aplikasi untuk meminjam atau meminjamkan barang dengan mudah dan aman. Menyadari bahwa tidak semua barang harus dibeli, platform aplikasi BROWS menyediakan pencarian toko maupun produk bagi mereka yang ingin meminjam barang, dan membuka peluang bagi mereka yang memiliki barang untuk dipinjamkan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-item js-simple-filter-item category1">
                        <div class="panel">
                            <div class="panel-heading"><a data-toggle="collapse" href="#faq2" class="collapsed">
                                    <div class="panel-title">Apa itu <b>Pemilik Barang?</b></div>
                                </a></div>
                            <div id="faq2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p><b>Pemilik Barang</b> (alias pihak yang menyewakan) adalah pengguna yang menyewakan barang miliknya melalui <b>BROWS</b>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-item js-simple-filter-item category1">
                        <div class="panel">
                            <div class="panel-heading"><a data-toggle="collapse" href="#faq3" class="collapsed">
                                    <div class="panel-title">Apa itu <b>Penyewa?</b></div>
                                </a></div>
                            <div id="faq3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p><b>Penyewa</b> (alias peminjam) adalah pengguna yang menyewa barang melalui <b>BROWS</b>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-item js-simple-filter-item category1">
                        <div class="panel">
                            <div class="panel-heading"><a data-toggle="collapse" href="#faq4" class="collapsed">
                                    <div class="panel-title">Apa yang bisa dilakukan oleh <b>Pemilik Barang</b>?</div>
                                </a></div>
                            <div id="faq4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p><b>Pemilik Barang</b> dapat mencantumkan barang untuk dipinjamkan kepada pengguna <b>BROWS</b> dengan cara mengupload foto dan deskripsi barang tersebut. <b>Pemilik Barang</b> kemudian menentukan biaya peminjaman barang per hari.</p>
                                    <p><b>Pemilik Barang</b> dapat mengirimkan permintaan informasi mengenai <b>Penyewa</b> kepada <b>BROWS</b> dengan melampirkan alasan permintaan dan tujuan penggunaan informasi. <b>BROWS</b> akan menindaklanjuti permintaan tersebut sesuai dengan kebijakan privasi yang dimiliki <b>BROWS</b>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-item js-simple-filter-item category1">
                        <div class="panel">
                            <div class="panel-heading"><a data-toggle="collapse" href="#faq5" class="collapsed">
                                    <div class="panel-title">Bagaimana cara menjadi <b>Pemilik Barang</b>?</div>
                                </a></div>
                            <div id="faq5" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>Pengguna dapat mendaftar di <b>BROWS</b> dengan menggunakan email pribadi dan melakukan verifikasi email pribadi, nomor ponsel, dan nomor kartu identitas (KTP). Setelah terdaftar dan terverifikasi, pengguna dapat memilih menjadi <b>Pemilik Barang</b> pada bagian profil dan mulai mendaftarkan barang untuk disewakan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-item js-simple-filter-item category1">
                        <div class="panel">
                            <div class="panel-heading"><a data-toggle="collapse" href="#faq6" class="collapsed">
                                    <div class="panel-title">Kategori barang apa saja yang ada di <b>BROWS</b>?</div>
                                </a></div>
                            <div id="faq6" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>1.	  Otomotif dan Industri</p>
                                    <p>2.	  Buku</p>
                                    <p>3.	  Pakaian & Kecantikan</p>
                                    <p>4.	  Elektronik & Gadget</p>
                                    <p>5.	  Game & Mainan</p>
                                    <p>6.	  Rumah & Taman</p>
                                    <p>7.	  Anak-anak & Bayi</p>
                                    <p>8.	  Musik & Audio</p>
                                    <p>9.	  Perlengkapan Kantor & Alat Tulis</p>
                                    <p>10.  Pesta & Acara</p>
                                    <p>11.	Fotografi & Videografi</p>
                                    <p>12.	Olahraga & Outdoor</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-item js-simple-filter-item category1">
                        <div class="panel">
                            <div class="panel-heading"><a data-toggle="collapse" href="#faq7" class="collapsed">
                                    <div class="panel-title">Barang apa saja yang dilarang untuk dicantumkan untuk dipinjam melalui <b>BROWS</b>?</div>
                                </a></div>
                            <div id="faq7" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>Barang yang mengandung konten perjudian, kekerasan, menyebarkan kebencian, narkotika dan obat-obatan terlarang. <b>BROWS</b> juga melarang pencantuman konten atas barang dan layanan yang melanggar peraturan perundang-undangan seperti pelanggaran hak kekayaan intelektual, jasa peretasan, jasa pemalsuan dokumen, dan lain sebagainya. Selengkapnya mengenai barang yang dilarang dapat dilihat di <a href="{{url('tnc')}}"> Syarat & Ketentuan</a> penggunaan aplikasi <b>BROWS</b>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-item js-simple-filter-item category1">
                        <div class="panel">
                            <div class="panel-heading"><a data-toggle="collapse" href="#faq8" class="collapsed">
                                    <div class="panel-title">Bagaimana arus transaksi pinjam-meminjam di <b>BROWS?</b></div>
                                </a></div>
                            <div id="faq8" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>1.	<b>Penyewa</b> memilih barang yang ingin disewa.</p>
                                    <p>2.	<b>Penyewa</b> memilih lama durasi peminjaman, jaminan (deposito), dan metode pengiriman barang.</p>
                                    <p>3.	<b>Pemilik Barang</b> memberivifikasi order: Menyetujui/Membatalkan.</p>
                                    <p>4.	<b>Penyewa</b> melakukan pembayaran.</p>
                                    <p>5.	Pembayaran diverifikasi oleh <b>BROWS</b>.</p>
                                    <p>6.	<b>Pemilik Barang</b> mengirim barang kepada <b>Penyewa</b>.</p>
                                    <p>7.	<b>Penyewa</b> memverifikasi kedatangan barang.</p>
                                    <p>8.	<b>Pemilik Barang</b> menerima pembayaran dari <b>BROWS</b>.</p>
                                    <p>9.	<b>Penyewa menyewa</b> barang selama masa waktu yang telah ditentukan.</p>
                                    <p>10.	<b>Penyewa</b> mengembalikan barang yang disewa setelah masa waktu berakhir sesuai dengan yang telah ditentukan.</p>
                                    <p>11.	<b>Pemilik Barang</b> konfirmasi pengembalian barang.</p>
                                    <p>12.	Deposit dikembalikan ke <b>Penyewa</b> (Apabila Ada).</p>
                                    <p>13.	<b>Pemilik Barang</b> dan <b>Penyewa</b> memberi review satu sama lain.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-item js-simple-filter-item category1">
                        <div class="panel">
                            <div class="panel-heading"><a data-toggle="collapse" href="#faq9" class="collapsed">
                                    <div class="panel-title">Bagaimana cara sistem pembayaran di <b>BROWS?</b></div>
                                </a></div>
                            <div id="faq9" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p><b>BROWS</b> akan meneruskan pembayaran harga peminjaman barang kepada <b>Pemilik Barang</b> selambatnya 2 x 24 jam setelah konfirmasi “Barang Diterima” diberikan oleh <b>Penyewa</b> melalui transfer bank/bank online/dompet online.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-item js-simple-filter-item category1">
                        <div class="panel">
                            <div class="panel-heading"><a data-toggle="collapse" href="#faq10" class="collapsed">
                                    <div class="panel-title">Apa itu Deposit?</div>
                                </a></div>
                            <div id="faq10" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>Deposit adalah harga yang ditentukan oleh <b>BROWS</b> sesuai dengan perhitungan dari harga sewa per hari sebagai jaminan. Deposit yang dibayarkan Penyewa akan ditahan oleh <b>BROWS</b> dan kemudian dikembalikan kepada <b>Penyewa</b> setelah <b>Pemilik Barang</b> mengkonfirmasi kepada <b>BROWS</b> bahwa barangnya sudah dikembalikan dalam kondisi baik yang wajar.</p>
                                    <p>Apabila terjadi sesuatu kepada barang tersebut atau terjadi keterlambatan pada masa pengembalian dan/atau penyewaan deposit akan diberikan kepada <b>Pemilik Barang</b> oleh <b>BROWS</b> dengan persetujuan perundingan di Pusat Resolusi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-item js-simple-filter-item category1">
                        <div class="panel">
                            <div class="panel-heading"><a data-toggle="collapse" href="#faq11" class="collapsed">
                                    <div class="panel-title">Bagaimana cara sistem pembayaran di <b>BROWS?</b></div>
                                </a></div>
                            <div id="faq11" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>Penyewaan barang dapat dibatalkan apabila terjadi kesalahan pengiriman barang oleh <b>Pemilik Barang</b> dan/atau barang yang dikirim tidak sesuai dengan data, informasi, dan deskripsi barang yang tercantum di <b>BROWS</b>.</p>
                                    <p><b>Pemilik Barang</b> berhak menolak pengembalian barang apabila tidak sesuai dengan kondisi di atas. Selengkapnya mengenai pembatalan peminjaman dan proses pengembalian uang sewa dapat dilihat di syarat & ketentuan <b>BROWS</b>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('includes/foot')
