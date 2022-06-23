<?php
 //Ferdinand Anggris Winarko
namespace frontend\models;

use Yii;

/**
* This is the model class for table "item_category".
*
    * @property int $id
    * @property string|null $name
    * @property int|null $parent_category
    *
            * @property Item[] $items
    */
class ItemCategory extends \yii\db\ActiveRecord
{
/**
* {@inheritdoc}
*/
public static function tableName()
{
return 'item_category';
}

/**
* {@inheritdoc}
*/
public function rules()
{
return [
            [['parent_category'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
}

/**
* {@inheritdoc}
*/
public function attributeLabels()
{
return [
    'id' => 'ID',
    'name' => 'Name',
    'parent_category' => 'Parent Category',
];
}

    /**
    * Gets query for [[Items]].
    *
    * @return \yii\db\ActiveQuery
    */
    public function getItems()
    {
    return $this->hasMany(Item::className(), ['category_id' => 'id']);
    }
}