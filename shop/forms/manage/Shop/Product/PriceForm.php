<?php

namespace shop\forms\manage\Shop\Product;

use shop\forms\manage\MetaForm;
use shop\forms\manage\Shop\CategoryForm;
use yii\base\Model;

/**
 * @property MetaForm $meta
 * @property CategoryForm $categories
 * @property TagsForm $tags
 * @property ValueForm[] $values
 */
class PriceForm extends Model
{
    public $old;
    public $new;

    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->old = $product->price_old;
            $this->new = $product->price_new;
        }

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['new'], 'required'],
            [['old', 'new'], 'integer', 'min' => 0],
        ];
    }
}
