<?php

namespace frontend\Models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\Models\Clasificacion;

/**
 * ClasificacionSearch represents the model behind the search form of `frontend\Models\Clasificacion`.
 */
class ClasificacionSearch extends Clasificacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_clasificacion', 'nivel', 'activo', 'padre'], 'integer'],
            [['codigo', 'descripcion', 'detalle'], 'safe'],
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
        $query = Clasificacion::find();

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
            'nivel' => $this->nivel,
            'padre' => $this->padre,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'detalle', $this->detalle]);

        return $dataProvider;
    }
}
