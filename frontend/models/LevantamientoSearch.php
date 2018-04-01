<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Levantamiento;

/**
 * LevantamientoSearch represents the model behind the search form of `frontend\models\Levantamiento`.
 */
class LevantamientoSearch extends Levantamiento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_levantamiento', 'id_unidad', 'activo'], 'integer'],
            [['fecha'], 'safe'],
            [['total'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Levantamiento::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_levantamiento' => $this->id_levantamiento,
            'id_unidad' => $this->id_unidad,
            'fecha' => $this->fecha,
            'total' => $this->total,
            'activo' => $this->activo,
        ]);

        return $dataProvider;
    }
}
