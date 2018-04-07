<?php

namespace frontend\Models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\Models\PartidasCuentas;

/**
 * PartidasCuentasSearch represents the model behind the search form of `frontend\Models\PartidasCuentas`.
 */
class PartidasCuentasSearch extends PartidasCuentas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pc', 'nrolinea', 'relacion', 'activo'], 'integer'],
            [['id_partida', 'descripcion_partida', 'id_cuenta', 'descripcion_cuenta'], 'safe'],
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
        $query = PartidasCuentas::find();

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
            'id_pc' => $this->id_pc,
            'nrolinea' => $this->nrolinea,
            'relacion' => $this->relacion,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'id_partida', $this->id_partida])
            ->andFilterWhere(['like', 'descripcion_partida', $this->descripcion_partida])
            ->andFilterWhere(['like', 'id_cuenta', $this->id_cuenta])
            ->andFilterWhere(['like', 'descripcion_cuenta', $this->descripcion_cuenta]);

        return $dataProvider;
    }
}
