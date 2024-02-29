<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $isbn
 * @property string $title
 * @property int $number_of_pages
 * @property string|null $published_at
 *
 * @property Authored[] $authoreds
 * @property GenreOfBook[] $genreOfBooks
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isbn', 'title', 'number_of_pages'], 'required'],
            [['number_of_pages'], 'integer'],
            [['published_at'], 'safe'],
            [['isbn'], 'string', 'max' => 17],
            [['title'], 'string', 'max' => 255],
            [['isbn'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'isbn' => 'Isbn',
            'title' => 'Title',
            'number_of_pages' => 'Number Of Pages',
            'published_at' => 'Published At',
        ];
    }

    /**
     * Gets query for [[Authoreds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Authors::class, ['id' => 'author'])->
            viaTable('authored', ['book' => 'id']);
    }

    /**
     * Gets query for [[Genres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenres()
    {
        return $this->hasMany(Genres::class, ['id' => 'genre'])->
            viaTable('genre_of_book', ['book' => 'id']);
    }
}
