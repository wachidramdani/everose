<?php

class Toolset {

    function rupiah($angka){

	

        $hasil_rupiah = "Rp " . number_format($angka);

        return $hasil_rupiah;

    }    



    function tourl($string) {

        $name = strtolower(str_replace(" ","-",$string));

        $name = preg_replace('/[^\w-]/', '', $name);



        return $name;

    }



    function rupiah_short($angka) {

        if($angka < 1000000) {

            $hasil = $angka / 1000;

            $hasil .= ".000";

        } else {

            $hasil = $angka / 1000000;

            $hasil .= ".000.000";

        }

        

        $hasil = "Rp ".$hasil;



        return $hasil;

    }



    function rating($angka) {

        $span = "";

        for($i=0;$i<5;$i++) {

            $span .= '<span class="fa fa-stack">';

            $span .= '<i class="fa fa-star-o fa-stack-2x"></i>';

            if($i < $angka) {

                $span .= '<i class="fa fa-star fa-stack-2x"></i>';

            }

            $span .= '</span>';

        }



        return $span;

    }



    function order_status($var) {

        if($var == 1) {

            $status = '<span style="padding: 5px; background-color: #f52200; border-radius: 5px;">Belum Dibayar</span>';

        } else if($var == 2) {

            $status = '<span style="padding: 5px; background-color: #00b1f5; border-radius: 5px;">Sudah Dibayar';

        } else if($var == 3) {

            $status = '<span style="padding: 5px; background-color: #c3c3c3; border-radius: 5px;">Dikemas</span>';

        } else if($var == 4) {

            $status = '<span class="style="padding: 5px; background-color: #ceff8b; border-radius: 5px;">Dikirim</span>';

        } else {

            $status = '<span style="padding: 5px; background-color: #04bb23c2; border-radius: 5px;">Selesai</span>';

        }



        return $status;

    }

}