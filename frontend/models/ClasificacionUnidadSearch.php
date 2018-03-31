<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ClasificacionUnidad;

/**
 * ClasificacionUnidadSearch represents the model behind the search form of `frontend\models\ClasificacionUnidad`.
 */
class ClasificacionUnidadSearch extends ClasificacionUnidad
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_clasificacion', 'id_unidad'], 'integer'],
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
        $query = ClasificacionUnidad::find();

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
            'id_clasificacion' => $this->id_clasificacion,
            'id_unidad' => $this->id_unidad,
        ]);

        return $dataProvider;
    }
}
