<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $name
 * @property string $date_of_birth
 * @property string $topics_column
 *
 * @property AuthorTopics[] $authorTopics
 * @property Books[] $books
 */
class Authors extends \yii\db\ActiveRecord
{
    public $topics_column;
    public $author_topics;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'date_of_birth'], 'required'],
            [['date_of_birth'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['author_topics'], 'safe'],
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
            'date_of_birth' => 'Date Of Birth',
            'topics_column' => 'Topics',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorTopics()
    {
        return $this->hasMany(AuthorTopics::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopics()
    {
        return $this->hasMany(Topics::className(), ['id' => 'topic_id'])->via('authorTopics');
    }

    public function afterFind()
    {
        $this->author_topics = $this->topics;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function afterSave($insert, $changedAttributes)
    {
        $this->unlinkAll('topics', true);

        foreach($this->author_topics as $topicId){
            $topic = Topics::findOne($topicId);
            $this->link('topics', $topic);
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
