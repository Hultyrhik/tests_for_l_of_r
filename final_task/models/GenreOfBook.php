<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genre_of_book".
 *
 * @property int $id
 * @property int $genre
 * @property int $book
 *
 * @property Books $book0
 * @property Genres $genre0
 */
class GenreOfBook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genre_of_book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['genre', 'book'], 'required'],
            [['genre', 'book'], 'integer'],
            [['genre'], 'exist', 'skipOnError' => true, 'targetClass' => Genres::class, 'targetAttribute' => ['genre' => 'id']],
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
            'genre' => 'Genre',
            'book' => 'Book',
        ];
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

    /**
     * Gets query for [[Genre0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenre0()
    {
        return $this->hasOne(Genres::class, ['id' => 'genre']);
    }
}
