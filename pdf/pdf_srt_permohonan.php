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
    require_once(dirname(__FILE__).'/../html2pdf/html2pdf.class.php');

    // get the HTML
     ob_start();
     include(dirname('__FILE__').'/res/srt_permohonan.php');
    $content = ob_get_clean();

    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('about.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
