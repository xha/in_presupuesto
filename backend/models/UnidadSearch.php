<?php

namespace backend\Models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\Models\Unidad;

/**
 * UnidadSearch represents the model behind the search form of `backend\Models\Unidad`.
 */
class UnidadSearch extends Unidad
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_unidad', 'nivel', 'padre', 'activo'], 'integer'],
            [['descripcion', 'responsable'], 'safe'],
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
        $query = Unidad::find();

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
            'id_unidad' => $this->id_unidad,
            'nivel' => $this->nivel,
            'padre' => $this->padre,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'responsable', $this->responsable]);

        return $dataProvider;
    }
}
