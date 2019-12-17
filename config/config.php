<?php

return array(
    'verif_badge' => array(
           0 => array('badge'=>'secondary','label'=>'Belum Terverifikasi'),
           1 => array('badge'=>'primary','label'=>'Terverifikasi'),
           2 => array('badge'=>'warning','label'=>'Dalam Proses Verifikasi'),
           3 => array('badge'=>'danger','label'=>'Ditolak')
    ),
    'cust_iscomplete_badge' => array(
           0 => array('badge'=>'secondary','label'=>'Belum Lengkap'),
           1 => array('badge'=>'primary','label'=>'Data Lengkap')
    ),
    'cust_sex' => array(
      1 => 'Laki - laki',
      2 => 'Perempuan'
    ),
    'productstat_badge' => array(
    	1 => array('badge'=>'new','label'=>'ACTIVE'),
    	2 => array('badge'=>'sale','label'=>'SUSPENDED'),
    	3 => array('badge'=>'sale','label'=>'DELETED'),
      4 => array('badge'=>'new','label'=>'NEW'),
    	5 => array('badge'=>'outstock','label'=>'DRAFT')
    ),
    'txstat_badge' => array(
      0 => array('badge'=>'primary','label'=>'SELESAI'),
      1 => array('badge'=>'warning','label'=>'MENUNGGU PEMBAYARAN'),
      2 => array('badge'=>'secondary','label'=>'MENUNGGU KONFIRMASI'),
      3 => array('badge'=>'warning','label'=>'DIPROSES'),
      4 => array('badge'=>'success','label'=>'DIKIRIM'),
      5 => array('badge'=>'success','label'=>'SAMPAI TUJUAN'),
      6 => array('badge'=>'warning','label'=>'DALAM PENGGUNAAN'),
      71 => array('badge'=>'danger','label'=>'KOMPLAIN DARI PENYEWA'),
      72 => array('badge'=>'danger','label'=>'KOMPLAIN DARI PEMILIK'),
      8 => array('badge'=>'danger','label'=>'DIBATALKAN'),
      9 => array('badge'=>'danger','label'=>'CARI PENGGANTI'),
      10 => array('badge'=>'secondary','label'=>'DIHAPUS'),
      11 => array('badge'=>'warning','label'=>'BELUM CHECKOUT'),
      12 => array('badge'=>'warning','label'=>'PEMBAYARAN DIPROSES'),
      13 => array('badge'=>'warning','label'=>'DIKIRIM KEMBALI'),
      14 => array('badge'=>'danger','label'=>'TERLAMBAT KEMBALI')
    ),
    //follow up pemilik --> COD
    'followup_2_1' => array(
      2 => array(3,8),
      3 => array(4,8),
      #5 => array(7),
      13 => array(0,72)
    ),
    //follow up pemilik --> EKSPEDISI
    'followup_2_2' => array(
      2 => array(3,8),
      3 => array(4,8),
      4 => array(8),
      #5 => array(7),
      13 => array(0,72)
    ),
    //follow up penyewa --> COD
    'followup_1_1' => array(
      #3 => array(7),
      #5 => array(7),
      4 => array(5,71),
      5 => array(13,71)
    ),
    //follow up penyewa --> EKSPEDISI
    'followup_1_2' => array(
      #3 => array(7),
      #5 => array(7),
      4 => array(5),
      5 => array(13,71)
    ),
    'courier_logo' => array(
      'jne' => 'resources/images/icons/JNE.png',
      'pos' => 'resources/images/icons/POS.png',
      'tiki' => 'resources/images/icons/tiki.jpg'
    ),
    'shipment_method' => array(
      1 => array('badge'=>'primary','label'=>'COD'),
      2 => array('badge'=>'success','label'=>'COURIER'),
    ),
    'productimageurl' => 'public/resources/fileUploads/productImages/',
    'rajaongkir_url' => 'https://pro.rajaongkir.com/api/',
    'rajaongkir_key' => array( 'key' => '4ddca6dc7e97703ca0a5a7aae3fe35f9' )
);