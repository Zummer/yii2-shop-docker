<?php

namespace shop\entities\Shop;

use shop\entities\behaviors\MetaBehavior;
use shop\entities\Meta;
use yii\base\Event;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property Meta $meta
 */
class Brand extends ActiveRecord
{
    public $meta;
    const EVENT_EDIT = 'edit';

    public static function create (string $name, string $slug, Meta $meta): self
    {
        $brand = new static();
        $brand->name = $name;
        $brand->slug = $slug;
        $brand->meta = $meta;

        return $brand;
    }

    public function edit($name, $slug, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->meta = $meta;

        $this->trigger(self::EVENT_EDIT, new Event([
            'data' => [
                'name' => $name
            ]
        ]));
    }


    public static function tableName()
    {
        return '{{%shop_brands}}';
    }

    public function behaviors()
    {
        return [
            'class' => MetaBehavior::class,
            'jsonAttribute' => 'meta_json',
        ];
    }
}
