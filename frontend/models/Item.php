<?php
//Ferdinand Anggris Winarko
namespace frontend\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $price
 * @property int|null $category_id
 *
 * @property ItemCategory $category
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::class,
            \yii\behaviors\BlameableBehavior::class,
        ];
    }


    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'category_id'], 'integer'],
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
            'price' => 'Price',
            'category_id' => 'Category',
            'category.name' => 'Category',
            'image' => 'Image'
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
}
