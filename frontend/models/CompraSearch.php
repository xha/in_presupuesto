<?php

namespace frontend\Models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\Models\Compra;

/**
 * CompraSearch represents the model behind the search form of `frontend\Models\Compra`.
 */
class CompraSearch extends Compra
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodSucu', 'TipoCom', 'NumeroD', 'CodProv', 'NroCtrol', 'CodEsta', 'CodUsua', 'FechaT', 'OTipo', 'ONumero', 'NumeroP', 'NumeroE', 'NumeroC', 'NumeroN', 'NumeroR', 'NroEstable', 'PtoEmision', 'AutSRI', 'FechaP', 'Moneda', 'CodUbic', 'Descrip', 'Direc1', 'Direc2', 'ZipCode', 'Telef', 'ID3', 'FechaI', 'FechaR', 'FechaE', 'FechaV', 'DetalChq', 'OrdenC', 'CodOper', 'Notas1', 'Notas2', 'Notas3', 'Notas4', 'Notas5', 'Notas6', 'Notas7', 'Notas8', 'Notas9', 'Notas10'], 'safe'],
            [['NroUnico', 'Signo', 'TipoSus', 'TipoTraE', 'NGiros', 'NMeses'], 'integer'],
            [['Factor', 'MontoMEx', 'Monto', 'OtrosC', 'MtoTax', 'Fletes', 'TGravable', 'TGravable0', 'TExento', 'DesctoP', 'RetenIVA', 'CancelI', 'CancelE', 'CancelT', 'CancelC', 'CancelA', 'CancelG', 'Contado', 'Credito', 'SaldoAct', 'MtoPagos', 'MtoNCredito', 'MtoNDebito', 'Descto1', 'MtoInt1', 'Descto2', 'MtoInt2', 'MtoFinanc', 'TotalPrd', 'TotalSrv'], 'number'],
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
        $query = Compra::find();

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
            'NroUnico' => $this->NroUnico,
            'Signo' => $this->Signo,
            'FechaT' => $this->FechaT,
            'TipoSus' => $this->TipoSus,
            'TipoTraE' => $this->TipoTraE,
            'FechaP' => $this->FechaP,
            'Factor' => $this->Factor,
            'MontoMEx' => $this->MontoMEx,
            'Monto' => $this->Monto,
            'OtrosC' => $this->OtrosC,
            'MtoTax' => $this->MtoTax,
            'Fletes' => $this->Fletes,
            'TGravable' => $this->TGravable,
            'TGravable0' => $this->TGravable0,
            'TExento' => $this->TExento,
            'DesctoP' => $this->DesctoP,
            'RetenIVA' => $this->RetenIVA,
            'FechaI' => $this->FechaI,
            'FechaR' => $this->FechaR,
            'FechaE' => $this->FechaE,
            'FechaV' => $this->FechaV,
            'CancelI' => $this->CancelI,
            'CancelE' => $this->CancelE,
            'CancelT' => $this->CancelT,
            'CancelC' => $this->CancelC,
            'CancelA' => $this->CancelA,
            'CancelG' => $this->CancelG,
            'Contado' => $this->Contado,
            'Credito' => $this->Credito,
            'SaldoAct' => $this->SaldoAct,
            'MtoPagos' => $this->MtoPagos,
            'MtoNCredito' => $this->MtoNCredito,
            'MtoNDebito' => $this->MtoNDebito,
            'Descto1' => $this->Descto1,
            'MtoInt1' => $this->MtoInt1,
            'Descto2' => $this->Descto2,
            'MtoInt2' => $this->MtoInt2,
            'MtoFinanc' => $this->MtoFinanc,
            'TotalPrd' => $this->TotalPrd,
            'TotalSrv' => $this->TotalSrv,
            'NGiros' => $this->NGiros,
            'NMeses' => $this->NMeses,
        ]);

        $query->andFilterWhere(['like', 'CodSucu', $this->CodSucu])
            ->andFilterWhere(['like', 'TipoCom', $this->TipoCom])
            ->andFilterWhere(['like', 'NumeroD', $this->NumeroD])
            ->andFilterWhere(['like', 'CodProv', $this->CodProv])
            ->andFilterWhere(['like', 'NroCtrol', $this->NroCtrol])
            ->andFilterWhere(['like', 'CodEsta', $this->CodEsta])
            ->andFilterWhere(['like', 'CodUsua', $this->CodUsua])
            ->andFilterWhere(['like', 'OTipo', $this->OTipo])
            ->andFilterWhere(['like', 'ONumero', $this->ONumero])
            ->andFilterWhere(['like', 'NumeroP', $this->NumeroP])
            ->andFilterWhere(['like', 'NumeroE', $this->NumeroE])
            ->andFilterWhere(['like', 'NumeroC', $this->NumeroC])
            ->andFilterWhere(['like', 'NumeroN', $this->NumeroN])
            ->andFilterWhere(['like', 'NumeroR', $this->NumeroR])
            ->andFilterWhere(['like', 'NroEstable', $this->NroEstable])
            ->andFilterWhere(['like', 'PtoEmision', $this->PtoEmision])
            ->andFilterWhere(['like', 'AutSRI', $this->AutSRI])
            ->andFilterWhere(['like', 'Moneda', $this->Moneda])
            ->andFilterWhere(['like', 'CodUbic', $this->CodUbic])
            ->andFilterWhere(['like', 'Descrip', $this->Descrip])
            ->andFilterWhere(['like', 'Direc1', $this->Direc1])
            ->andFilterWhere(['like', 'Direc2', $this->Direc2])
            ->andFilterWhere(['like', 'ZipCode', $this->ZipCode])
            ->andFilterWhere(['like', 'Telef', $this->Telef])
            ->andFilterWhere(['like', 'ID3', $this->ID3])
            ->andFilterWhere(['like', 'DetalChq', $this->DetalChq])
            ->andFilterWhere(['like', 'OrdenC', $this->OrdenC])
            ->andFilterWhere(['like', 'CodOper', $this->CodOper])
            ->andFilterWhere(['like', 'Notas1', $this->Notas1])
            ->andFilterWhere(['like', 'Notas2', $this->Notas2])
            ->andFilterWhere(['like', 'Notas3', $this->Notas3])
            ->andFilterWhere(['like', 'Notas4', $this->Notas4])
            ->andFilterWhere(['like', 'Notas5', $this->Notas5])
            ->andFilterWhere(['like', 'Notas6', $this->Notas6])
            ->andFilterWhere(['like', 'Notas7', $this->Notas7])
            ->andFilterWhere(['like', 'Notas8', $this->Notas8])
            ->andFilterWhere(['like', 'Notas9', $this->Notas9])
            ->andFilterWhere(['like', 'Notas10', $this->Notas10]);

        return $dataProvider;
    }
}
