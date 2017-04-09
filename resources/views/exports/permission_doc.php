<?
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;

try{
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $path = resource_path('views/documents/permission_doc.docx');
    $document = $phpWord->loadTemplate($path);
    $document->setValue('exports_permission_date', date_format(date_create($export->permission_date),'d.m.Y'));
    $document->setValue('exports_permission_num', empty($export->permission_num)?'':$export->institution->region->index.'-'.$export->institution->index.'-'.$export->permission_num);
    $document->setValue('exports_request_date', date_format(date_create($export->request_date),'d.m.Y'));
    $document->setValue('exports_request_num', $export->request_num);
    $document->setValue('institution_name', 'Главное управление "Государственная инспекция по ветеринарии" Тверской области');
    $document->setValue('currdate', date('Y'));
    $document->setValue('organization_name', $export->organization->name);
    $document->setValue('organization_tin', $export->organization->tin);
    $document->setValue('storage_name', $export->storage->name);
    $document->setValue('storage_address', $export->storage->address);
    $document->setValue('purpose_name', $export->purpose->name);
    $document->setValue('district_name', $export->district->name);
    $document->setValue('region_name', $export->region->name);
    $document->setValue('transport_name', $export->transport->name);
    $document->cloneRow('product_type_name', count($exported_products));
    for ($i=0;$i<count($exported_products);$i++)
    {
    	$document->setValue('product_type_name#'.($i+1), $exported_products[$i]->product_type->name);
    	$document->setValue('exported_product_measure#'.($i+1), $exported_products[$i]->measure);
    	$document->setValue('exported_product_count#'.($i+1), $exported_products[$i]->count);
    	$document->setValue('exported_product_manufacturer#'.($i+1), $exported_products[$i]->manufacturer);
    }
    $file = 'Разрешение на вывоз.docx';
    $document->saveAs($file);
    header("Content-Description: File Transfer");
    header('Content-Disposition: attachment; filename="' . $file . '"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');
    readfile($file);
    unlink($file);
} catch (Exception $e)
{
	echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
}
?>
