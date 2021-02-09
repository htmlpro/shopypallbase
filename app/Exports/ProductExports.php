<?php

namespace App\Exports;

use App\Models\Core\ProductExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
// use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class ProductExports extends DefaultValueBinder  implements FromCollection,  WithHeadings , WithCustomValueBinder
{
    use Exportable;

    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProductExport::all();
    }


    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_NUMERIC);

            return true;
        }
        // else return default behavior
        return parent::bindValue($cell, $value);
    }


    public function headings(): array
    {
        return [
            'id',
            'products_type',
            'products_id',
			'product_category_id',
			'is_feature',
			'products_status',
			'products_price',
			'tax_class_id',
			'products_min_order',
			'products_max_stock',
			'products_weight',
			'products_weight_unit',
			'products_model',
			'image_id',
			'products_video_link',
			'products_name_1',
			'products_url_1',
			'products_description_1',
			'products_name_2',
			'products_url_2',
			'products_description_2',
			'created_at',
			'updated_at',
        ];
    }

   
}
