SELECT DISTINCT 
    a.nr_sequencia,
	a.nm_conjunto,
	a.nm_conj_sem_acento,
	SUBSTR(obter_nome_setor(a.cd_setor_atendimento),1,100) ds_setor_atendimento,
	a.cd_estabelecimento,
	a.ie_estoque,
	b.QT_CONJUNTO,
	b.NR_SEQ_CONJUNTO 
from	cm_conjuntos_disponiveis_v a, CM_REQUISICAO_ITEM b
WHERE a.NR_SEQUENCIA = b.NR_SEQ_CONJUNTO 