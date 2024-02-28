<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authored".
 *
 * @property int $id
 * @property int $author
 * @property int $book
 *
 * @property Authors $author0
 * @property Books $book0
 */
class Authored extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authored';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author', 'book'], 'required'],
            [['author', 'book'], 'integer'],
            [['author'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::class, 'targetAttribute' => ['author' => 'id']],
            [['book'], 'exist', 'skipOnError' => true, 'targetClass' => Books::class, 'targetAttribute' => ['book' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author' => 'Author',
            'book' => 'Book',
        ];
    }

    /**
     * Gets query for [[Author0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor0()
    {
        return $this->hasOne(Authors::class, ['id' => 'author']);
    }

    /**
     * Gets query for [[Book0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook0()
    {
        return $this->hasOne(Books::class, ['id' => 'book']);
    }
}
