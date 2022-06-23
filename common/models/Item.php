<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $image
 * @property int|null $price
 * @property int|null $category_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property ItemCategory $category
 * @property OrderItem[] $orderItems
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */


    public static function tableName()
    {
        return 'item';
    }


    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::class,
            \yii\behaviors\BlameableBehavior::class,
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'image' => 'Image',
            'price' => 'Price',
            'category_id' => 'Category ID',
            'category.name' => 'Category',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ItemCategory::className(), ['id' => 'category_id']);
    }


    public function getUploadedPath()
    {
        $path = Yii::getAlias("@frontend") . '/web/uploads/item/';
        if (file_exists($path) == false) {
            // var_dump($path);
            // die;
            mkdir($path, 0755, true);
        }
        return $path;
    }

    public function getUploadedUrl()
    {
        $path = Yii::$app->urlManagerFrontend->createUrl('/uploads/item');
        return $path;
    }

    public function getImageUrl()
    {
        $realpath = $this->getUploadedPath() . $this->image();
        $path = $this->getUploadedUrl() . "/" . $this->image();
        if (file_exists($realpath) && $realpath != $this->getUploadedPath()) {
            return $path;
        } else {
            return Yii::$app->urlManagerFrontend->createUrl('/uploads/no-image.jpg');
        }
    }
    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
}
