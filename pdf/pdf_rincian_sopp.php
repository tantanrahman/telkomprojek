<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

    // get the HTML
	$kolom = $_GET["kolom"];
	$nilai = $_GET["nilai"];
    ob_start();
    include(dirname(__FILE__).'/res/export_rincian_sopp.php');
    $content = ob_get_clean();

    // convert in PDF
    require_once(dirname(__FILE__).'/../html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('rincian_sopp.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
