<?php

namespace frontend\Models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\Models\Cnu;

/**
 * CnuSearch represents the model behind the search form of `frontend\Models\Cnu`.
 */
class CnuSearch extends Cnu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cnu', 'id_unidad', 'id_clasificacion', 'EsServicio'], 'integer'],
            [['id_partida', 'CodItem', 'cuentaC'], 'safe'],
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
        $query = Cnu::find();

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
            'id_cnu' => $this->id_cnu,
            'id_unidad' => $this->id_unidad,
            'id_clasificacion' => $this->id_clasificacion,
            'EsServicio' => $this->EsServicio,
        ]);

        $query->andFilterWhere(['like', 'id_partida', $this->id_partida])
            ->andFilterWhere(['like', 'CodItem', $this->CodItem])
            ->andFilterWhere(['like', 'cuentaC', $this->cuentaC]);

        return $dataProvider;
    }
}
